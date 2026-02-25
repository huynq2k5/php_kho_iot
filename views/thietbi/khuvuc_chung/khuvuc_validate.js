document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('zoneForm');
    const maKhuVuc = document.getElementById('ma_khu_vuc');
    const tenKhuVuc = document.getElementById('ten_khu_vuc');
    const maKhuVucHelper = document.getElementById('ma_khu_vuc_helper');

    function validateMaKhuVuc() {
        if (!maKhuVuc || maKhuVuc.readOnly) return true;

        const value = maKhuVuc.value;
        const trimmedValue = value.trim();
        const helper = maKhuVucHelper;
        
        helper.className = 'text-xs mt-1 block';

        if (value === '') {
            maKhuVuc.classList.remove('input-valid');
            maKhuVuc.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã khu vực không được để trống';
            return false;
        } 
        else if (trimmedValue.length < 3) {
            maKhuVuc.classList.remove('input-valid');
            maKhuVuc.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã khu vực phải có ít nhất 3 ký tự';
            return false;
        } 
        else if (value.includes(' ')) {
            maKhuVuc.classList.remove('input-valid');
            maKhuVuc.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã khu vực không được chứa khoảng trắng';
            return false;
        } 
        else if (!/^[a-zA-Z0-9_-]+$/.test(value)) {
            maKhuVuc.classList.remove('input-valid');
            maKhuVuc.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Chỉ chấp nhận chữ cái, số, gạch ngang (-) và gạch dưới (_)';
            return false;
        } 
        else {
            maKhuVuc.classList.remove('input-invalid');
            maKhuVuc.classList.add('input-valid');
            helper.classList.add('text-green-600', 'dark:text-green-400');
            helper.textContent = 'Mã hợp lệ';
            return true;
        }
    }

    function validateTenKhuVuc() {
        if (tenKhuVuc.value.trim() === '') {
            tenKhuVuc.classList.remove('input-valid');
            tenKhuVuc.classList.add('input-invalid');
            return false;
        } else {
            tenKhuVuc.classList.remove('input-invalid');
            tenKhuVuc.classList.add('input-valid');
            return true;
        }
    }

    if (maKhuVuc && !maKhuVuc.readOnly) {
        maKhuVuc.addEventListener('input', validateMaKhuVuc);
        maKhuVuc.addEventListener('blur', validateMaKhuVuc);
    }

    if (tenKhuVuc) {
        tenKhuVuc.addEventListener('input', validateTenKhuVuc);
        tenKhuVuc.addEventListener('blur', validateTenKhuVuc);
    }

    if(form) {
        form.addEventListener('submit', function(e) {
            const isMaValid = validateMaKhuVuc();
            const isTenValid = validateTenKhuVuc();

            if (!isMaValid || !isTenValid) {
                e.preventDefault(); 
                
                if (!isMaValid) {
                    maKhuVuc.focus();
                } else if (!isTenValid) {
                    tenKhuVuc.focus();
                }
                
                alert('Vui lòng kiểm tra lại các trường thông tin bị viền đỏ!');
            }
        });
    }

    if (maKhuVuc && maKhuVuc.value && !maKhuVuc.readOnly) validateMaKhuVuc();
    if (tenKhuVuc && tenKhuVuc.value) validateTenKhuVuc();
});