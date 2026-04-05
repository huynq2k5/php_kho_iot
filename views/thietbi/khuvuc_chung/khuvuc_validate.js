document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('zoneForm');
    const maKhuVuc = document.getElementById('ma_khu_vuc');
    const tenKhuVuc = document.getElementById('ten_khu_vuc');
    const cheDo = document.getElementById('che_do');
    const moTa = document.getElementById('mo_ta');
    const maKhuVucHelper = document.getElementById('ma_khu_vuc_helper');
    const submitBtn = form ? form.querySelector('button[type="submit"]') : null;

    let initialValues = {};

    // 1. Chụp ảnh trạng thái ban đầu
    function captureInitialState() {
        initialValues = {
            ma: maKhuVuc ? maKhuVuc.value : '',
            ten: tenKhuVuc ? tenKhuVuc.value : '',
            cheDo: cheDo ? cheDo.value : '',
            moTa: moTa ? moTa.value : ''
        };
        checkStatus();
    }

    // 2. Logic Validate Mã khu vực
    function validateMaKhuVuc() {
        if (!maKhuVuc || maKhuVuc.readOnly) return true;

        const value = maKhuVuc.value;
        const trimmedValue = value.trim();
        const helper = maKhuVucHelper;
        
        if (helper) helper.className = 'text-xs mt-1 block';

        if (value === '') {
            maKhuVuc.className = maKhuVuc.className.replace('input-valid', '') + ' input-invalid';
            if (helper) {
                helper.classList.add('text-red-600', 'dark:text-red-400');
                helper.textContent = 'Mã khu vực không được để trống';
            }
            return false;
        } 
        else if (trimmedValue.length < 3 || value.includes(' ') || !/^[a-zA-Z0-9_-]+$/.test(value)) {
            maKhuVuc.className = maKhuVuc.className.replace('input-valid', '') + ' input-invalid';
            if (helper) {
                helper.classList.add('text-red-600', 'dark:text-red-400');
                helper.textContent = 'Mã không hợp lệ (ít nhất 3 ký tự, không dấu, không khoảng trắng)';
            }
            return false;
        } 
        else {
            maKhuVuc.className = maKhuVuc.className.replace('input-invalid', '') + ' input-valid';
            if (helper) {
                helper.classList.add('text-green-600', 'dark:text-green-400');
                helper.textContent = 'Mã hợp lệ';
            }
            return true;
        }
    }

    // 3. Logic Validate Tên khu vực
    function validateTenKhuVuc() {
        if (!tenKhuVuc) return true;
        const isValid = tenKhuVuc.value.trim() !== '';
        
        if (!isValid) {
            tenKhuVuc.className = tenKhuVuc.className.replace('input-valid', '') + ' input-invalid';
        } else {
            tenKhuVuc.className = tenKhuVuc.className.replace('input-invalid', '') + ' input-valid';
        }
        return isValid;
    }

    // 4. Hàm tổng hợp kiểm tra Thay đổi + Hợp lệ
    function checkStatus() {
        const hasChanged = 
            (maKhuVuc && maKhuVuc.value !== initialValues.ma) ||
            (tenKhuVuc && tenKhuVuc.value !== initialValues.ten) ||
            (cheDo && cheDo.value !== initialValues.cheDo) ||
            (moTa && moTa.value !== initialValues.moTa);

        const isValid = validateMaKhuVuc() && validateTenKhuVuc();

        if (submitBtn) {
            if (hasChanged && isValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    // 5. Gán sự kiện lắng nghe
    if (form) {
        form.addEventListener('input', checkStatus);
        form.addEventListener('change', checkStatus);
        
        form.addEventListener('submit', function(e) {
            if (submitBtn && submitBtn.disabled) {
                e.preventDefault();
                return false;
            }
        });
    }

    // 6. Khởi chạy ban đầu
    captureInitialState();
});