document.addEventListener('DOMContentLoaded', function() {
    const getEl = (id) => document.getElementById(id);
    const scriptForm = getEl('scriptForm');

    const elements = {
        tenKichBan: getEl('tenKichBan'),
        loaiKichBan: getEl('loaiKichBan'),
        idThietBiVao: getEl('idThietBiVao'),
        idThietBiRa: getEl('idThietBiRa'),
        idThanhPhanVao: getEl('idThanhPhanVao'),
        idThanhPhanRa: getEl('idThanhPhanRa'),
        thoiGianBat: document.querySelector('input[name="thoiGianBat"]'),
        thoiGianTat: document.querySelector('input[name="thoiGianTat"]')
    };

    window.switchTab = function(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        getEl(tab + '-tab-content').classList.remove('hidden');

        document.querySelectorAll('[id$="-tab"]').forEach(el => {
            el.classList.remove('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
            el.classList.add('border-transparent');
        });

        const activeTab = getEl(tab + '-tab');
        activeTab.classList.add('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
        elements.loaiKichBan.value = tab.toUpperCase();
    };

    async function loadComponents(idThietBi, loai, targetSelect, selectedId = null) {
        if (!idThietBi) return;
        targetSelect.innerHTML = '<option>Đang tải...</option>';

        try {
            const response = await fetch(`index.php?page=tudong_api_lay_thanh_phan&idThietBi=${idThietBi}&loai=${loai}`);
            const data = await response.json();

            targetSelect.innerHTML = `<option value="">-- Chọn ${loai === 'INPUT' ? 'cảm biến' : 'thiết bị'} --</option>`;
            
            data.forEach(item => {
                // Kiểm tra nếu ID trùng với ID đã lưu thì thêm thuộc tính selected
                const isSelected = (selectedId && item.idThanhPhan == selectedId) ? 'selected' : '';
                targetSelect.innerHTML += `<option value="${item.idThanhPhan}" ${isSelected}>${item.tenThanhPhan} (${item.maThanhPhan})</option>`;
            });
        } catch (error) {
            targetSelect.innerHTML = '<option value="">Lỗi tải dữ liệu</option>';
        }
    }

    elements.idThietBiVao.addEventListener('change', () => {
        loadComponents(elements.idThietBiVao.value, 'INPUT', elements.idThanhPhanVao);
    });

    elements.idThietBiRa.addEventListener('change', () => {
        loadComponents(elements.idThietBiRa.value, 'OUTPUT', elements.idThanhPhanRa);
    });

    if (scriptForm) {
        scriptForm.addEventListener('submit', function(e) {
            let isValid = true;

            // 1. Kiểm tra tên kịch bản (Dùng chung)
            if (elements.tenKichBan.value.trim() === "") {
                elements.tenKichBan.classList.add('border-red-600');
                getEl('tenKichBan_error').classList.remove('hidden');
                isValid = false;
            }

            // 2. Kiểm tra theo loại kịch bản
            if (elements.loaiKichBan.value === 'SENSOR') {
                // Kiểm tra cảm biến đầu vào
                if (!elements.idThanhPhanVao.value) {
                    alert('Vui lòng chọn cảm biến đầu vào!');
                    isValid = false;
                }
            } else if (elements.loaiKichBan.value === 'TIMER') {
                // Kiểm tra thời gian (BỔ SUNG TẠI ĐÂY)
                if (!elements.thoiGianBat.value || !elements.thoiGianTat.value) {
                    alert('Vui lòng thiết lập đầy đủ giờ bắt đầu và giờ kết thúc!');
                    isValid = false;
                } else if (elements.thoiGianBat.value === elements.thoiGianTat.value) {
                    alert('Giờ bắt đầu và giờ kết thúc không được trùng nhau!');
                    isValid = false;
                } else if (elements.thoiGianBat.value > elements.thoiGianTat.value) {
                    alert('Giờ bắt đầu không được lớn hơn giờ kết thúc!');
                    isValid = false;
                }
            }

            // 3. Kiểm tra thiết bị thực thi (Dùng chung)
            if (!elements.idThanhPhanRa.value) {
                alert('Vui lòng chọn thiết bị thực thi đầu ra!');
                isValid = false;
            }

            if (!isValid) e.preventDefault();
        });
    }

    const currentLoai = elements.loaiKichBan.value.toLowerCase();
    switchTab(currentLoai);

    // Tự động load linh kiện khi ở chế độ sửa (Edit mode)
    const initialVao = getEl('idThietBiVao').value;
    const initialRa = getEl('idThietBiRa').value;

    if (initialVao) {
        loadComponents(initialVao, 'INPUT', getEl('idThanhPhanVao'), '<?= $kichBan->idThanhPhanVao ?? "" ?>');
    }
    if (initialRa) {
        loadComponents(initialRa, 'OUTPUT', getEl('idThanhPhanRa'), '<?= $kichBan->idThanhPhanRa ?? "" ?>');
    }
});