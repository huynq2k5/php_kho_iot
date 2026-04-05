document.addEventListener('DOMContentLoaded', async function() {
    const getEl = (id) => document.getElementById(id);
    const scriptForm = getEl('scriptForm');
    const submitBtn = scriptForm.querySelector('button[type="submit"]');

    // 1. Khai báo các phần tử (Bao gồm các trường ẩn và các ô input cũ)
    const elements = {
        tenKichBan: getEl('tenKichBan'),
        loaiKichBan: getEl('loaiKichBan'),
        idThietBiVao: getEl('idThietBiVao'),
        idThietBiRa: getEl('idThietBiRa'),
        idThanhPhanVao: getEl('idThanhPhanVao'),
        idThanhPhanRa: getEl('idThanhPhanRa'),
        dieuKien: document.querySelector('select[name="dieuKien"]'),
        giaTriNguong: document.querySelector('input[name="giaTriNguong"]'),
        hanhDong: document.querySelector('select[name="hanhDong"]'),
        thoiGianBat: document.querySelector('input[name="thoiGianBat"]'),
        thoiGianTat: document.querySelector('input[name="thoiGianTat"]')
    };

    let initialValues = {};

    // 2. Chụp ảnh trạng thái ban đầu để so sánh
    function captureInitialState() {
        initialValues = {
            tenKichBan: elements.tenKichBan.value,
            loaiKichBan: elements.loaiKichBan.value,
            idThietBiVao: elements.idThietBiVao.value,
            idThanhPhanVao: elements.idThanhPhanVao.value,
            idThietBiRa: elements.idThietBiRa.value,
            idThanhPhanRa: elements.idThanhPhanRa.value,
            dieuKien: elements.dieuKien?.value,
            giaTriNguong: elements.giaTriNguong?.value,
            hanhDong: elements.hanhDong?.value,
            thoiGianBat: elements.thoiGianBat?.value,
            thoiGianTat: elements.thoiGianTat?.value
        };
        updateSubmitButton(false);
    }

    // 3. Bật/Tắt nút Submit dựa trên thay đổi
    function updateSubmitButton(isChanged) {
        if (isChanged) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // 4. Kiểm tra thay đổi dữ liệu
    function checkChanges() {
        const hasChanged = 
            elements.tenKichBan.value !== initialValues.tenKichBan ||
            elements.loaiKichBan.value !== initialValues.loaiKichBan ||
            elements.idThietBiVao.value !== initialValues.idThietBiVao ||
            elements.idThanhPhanVao.value !== initialValues.idThanhPhanVao ||
            elements.idThietBiRa.value !== initialValues.idThietBiRa ||
            elements.idThanhPhanRa.value !== initialValues.idThanhPhanRa ||
            (elements.dieuKien && elements.dieuKien.value !== initialValues.dieuKien) ||
            (elements.giaTriNguong && elements.giaTriNguong.value != initialValues.giaTriNguong) ||
            (elements.hanhDong && elements.hanhDong.value !== initialValues.hanhDong) ||
            (elements.thoiGianBat && elements.thoiGianBat.value !== initialValues.thoiGianBat) ||
            (elements.thoiGianTat && elements.thoiGianTat.value !== initialValues.thoiGianTat);

        updateSubmitButton(hasChanged);
    }

    // 5. Logic chuyển Tab
    window.switchTab = function(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        getEl(tab + '-tab-content').classList.remove('hidden');

        document.querySelectorAll('[id$="-tab"]').forEach(el => {
            el.classList.remove('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
            el.classList.add('border-transparent');
        });

        const activeTab = getEl(tab + '-tab');
        if (activeTab) {
            activeTab.classList.add('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
        }
        elements.loaiKichBan.value = tab.toUpperCase();
        checkChanges();
    };

    // 6. Load linh kiện AJAX (Dùng async/await)
    async function loadComponents(idThietBi, loai, targetSelect, selectedId = null) {
        if (!idThietBi) return;
        targetSelect.innerHTML = '<option>Đang tải...</option>';

        try {
            const response = await fetch(`index.php?page=tudong_api_lay_thanh_phan&idThietBi=${idThietBi}&loai=${loai}`);
            const data = await response.json();

            targetSelect.innerHTML = `<option value="">-- Chọn ${loai === 'INPUT' ? 'cảm biến' : 'thiết bị'} --</option>`;
            data.forEach(item => {
                const isSelected = (selectedId && item.idThanhPhan == selectedId) ? 'selected' : '';
                targetSelect.innerHTML += `<option value="${item.idThanhPhan}" ${isSelected}>${item.tenThanhPhan} (${item.maThanhPhan})</option>`;
            });
        } catch (error) {
            targetSelect.innerHTML = '<option value="">Lỗi tải dữ liệu</option>';
        }
    }

    // 7. Lắng nghe các sự kiện thay đổi
    scriptForm.addEventListener('input', checkChanges);
    scriptForm.addEventListener('change', checkChanges);

    elements.idThietBiVao.addEventListener('change', async () => {
        await loadComponents(elements.idThietBiVao.value, 'INPUT', elements.idThanhPhanVao);
        checkChanges();
    });

    elements.idThietBiRa.addEventListener('change', async () => {
        await loadComponents(elements.idThietBiRa.value, 'OUTPUT', elements.idThanhPhanRa);
        checkChanges();
    });

    // 8. LOGIC KIỂM TRA KHI SUBMIT (Toàn bộ logic cũ của Huy)
    if (scriptForm) {
        scriptForm.addEventListener('submit', function(e) {
            // Nếu nút đang bị disable thì không làm gì cả
            if (submitBtn.disabled) {
                e.preventDefault();
                return false;
            }

            let isValid = true;

            // 8.1. Kiểm tra tên kịch bản
            if (elements.tenKichBan.value.trim() === "") {
                elements.tenKichBan.classList.add('border-red-600');
                getEl('tenKichBan_error')?.classList.remove('hidden');
                isValid = false;
            } else {
                elements.tenKichBan.classList.remove('border-red-600');
                getEl('tenKichBan_error')?.classList.add('hidden');
            }

            // 8.2. Kiểm tra theo loại kịch bản
            const loai = elements.loaiKichBan.value;
            if (loai === 'SENSOR') {
                if (!elements.idThanhPhanVao.value) {
                    alert('Vui lòng chọn cảm biến đầu vào!');
                    isValid = false;
                }
            } else if (loai === 'TIMER') {
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

            // 8.3. Kiểm tra thiết bị thực thi
            if (!elements.idThanhPhanRa.value) {
                alert('Vui lòng chọn thiết bị thực thi đầu ra!');
                isValid = false;
            }

            if (!isValid) e.preventDefault();
        });
    }

    const currentLoai = elements.loaiKichBan.value.toLowerCase();
    switchTab(currentLoai);

    const initialVao = elements.idThietBiVao.value;
    const initialRa = elements.idThietBiRa.value;
    const loadTasks = [];

    if (initialVao) {
        loadTasks.push(loadComponents(initialVao, 'INPUT', elements.idThanhPhanVao, '<?= $kichBan->idThanhPhanVao ?? "" ?>'));
    }
    if (initialRa) {
        loadTasks.push(loadComponents(initialRa, 'OUTPUT', elements.idThanhPhanRa, '<?= $kichBan->idThanhPhanRa ?? "" ?>'));
    }

    await Promise.all(loadTasks);
    captureInitialState(); 
});