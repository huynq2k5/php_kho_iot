document.addEventListener('DOMContentLoaded', function() {
    // 1. Lấy các phần tử DOM theo ID mới nhất
    const form = document.getElementById('deviceForm');
    const maThietBi = document.getElementById('ma_thiet_bi');
    const tenThietBi = document.getElementById('ten_thiet_bi');
    const idKhuVuc = document.getElementById('id_khu_vuc');
    const topicMqtt = document.getElementById('topic_mqtt');

    // Các thẻ hiển thị thông báo lỗi/hướng dẫn
    const maThietBiHelper = document.getElementById('ma_thiet_bi_helper');
    const topicMqttHelper = document.getElementById('topic_mqtt_helper');
    const tenTBHelper = document.getElementById('ten_thiet_bi_helper');

    // 2. Hàm validate Mã thiết bị (Định danh cứng)
    function validateMaThietBi() {
        const value = maThietBi.value;
        const trimmedValue = value.trim();
        const helper = maThietBiHelper;
        
        // Reset CSS class của Helper
        helper.className = 'text-xs mt-1';

        if (value === '') {
            maThietBi.classList.remove('input-valid');
            maThietBi.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã thiết bị không được để trống';
            return false;
        } 
        else if (trimmedValue.length < 3) {
            maThietBi.classList.remove('input-valid');
            maThietBi.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã thiết bị phải có ít nhất 3 ký tự';
            return false;
        } 
        else if (value.includes(' ')) {
            maThietBi.classList.remove('input-valid');
            maThietBi.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Mã thiết bị không được chứa khoảng trắng';
            return false;
        } 
        else if (!/^[a-zA-Z0-9_-]+$/.test(value)) {
            maThietBi.classList.remove('input-valid');
            maThietBi.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Chỉ chấp nhận chữ cái, số, gạch ngang (-) và gạch dưới (_)';
            return false;
        } 
        else {
            maThietBi.classList.remove('input-invalid');
            maThietBi.classList.add('input-valid');
            helper.classList.add('text-green-600', 'dark:text-green-400');
            helper.textContent = 'Mã hợp lệ';
            return true;
        }
    }

    // 3. Hàm validate Tên hiển thị
    function validateTenThietBi() {
        const helper = tenTBHelper;
        
        // Reset CSS class của Helper
        helper.className = 'text-xs mt-1';

        if (tenThietBi.value.trim() === '') {
            tenThietBi.classList.remove('input-valid');
            tenThietBi.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Tên không được để trống';
            return false;
        } else {
            tenThietBi.classList.remove('input-invalid');
            tenThietBi.classList.add('input-valid');
            helper.textContent = '';
            return true;
        }
    }

    // 4. Hàm validate Dropdown Khu Vực
    function validateKhuVuc() {
        if (idKhuVuc.value === '') {
            idKhuVuc.classList.remove('input-valid');
            idKhuVuc.classList.add('input-invalid');
            return false;
        } else {
            idKhuVuc.classList.remove('input-invalid');
            idKhuVuc.classList.add('input-valid');
            return true;
        }
    }

    // 5. Hàm validate Topic MQTT
    function validateTopicMqtt() {
        const value = topicMqtt.value;
        const helper = topicMqttHelper;

        helper.className = 'text-xs mt-1';

        if (value === '') {
            topicMqtt.classList.remove('input-valid');
            topicMqtt.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Topic MQTT không được để trống';
            return false;
        } 
        else if (value.includes(' ')) {
            topicMqtt.classList.remove('input-valid');
            topicMqtt.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.textContent = 'Topic MQTT không được chứa khoảng trắng';
            return false;
        } 
        else {
            topicMqtt.classList.remove('input-invalid');
            topicMqtt.classList.add('input-valid');
            helper.classList.add('text-green-600', 'dark:text-green-400');
            helper.textContent = '✓ Topic hợp lệ';
            return true;
        }
    }

    // 6. Gán sự kiện cho các ô Input (Kiểm tra Realtime)
    maThietBi.addEventListener('input', validateMaThietBi);
    maThietBi.addEventListener('blur', validateMaThietBi);

    tenThietBi.addEventListener('input', validateTenThietBi);
    tenThietBi.addEventListener('blur', validateTenThietBi);

    idKhuVuc.addEventListener('change', validateKhuVuc);
    idKhuVuc.addEventListener('blur', validateKhuVuc);

    topicMqtt.addEventListener('input', validateTopicMqtt);
    topicMqtt.addEventListener('blur', validateTopicMqtt);

    // 7. Chốt chặn cuối cùng khi ấn nút Submit
    if(form) {
        form.addEventListener('submit', function(e) {
            const isMaValid = validateMaThietBi();
            const isTenValid = validateTenThietBi();
            const isKhuVucValid = validateKhuVuc();
            const isTopicValid = validateTopicMqtt();

            // Nếu có bất kỳ trường nào sai, chặn không cho gửi
            if (!isMaValid || !isTenValid || !isKhuVucValid || !isTopicValid) {
                e.preventDefault(); 
                
                // Tự động focus vào ô bị lỗi đầu tiên
                if (!isMaValid) maThietBi.focus();
                else if (!isTenValid) tenThietBi.focus();
                else if (!isKhuVucValid) idKhuVuc.focus();
                else if (!isTopicValid) topicMqtt.focus();
                
                alert('Vui lòng kiểm tra lại các trường thông tin bị viền đỏ!');
            }
        });
    }

    // 8. Tự động kiểm tra ngay khi mở trang
    // Điều này cực kỳ quan trọng khi đang mở form SỬA, giúp các ô đã có dữ liệu tự chuyển viền xanh
    if (maThietBi.value) validateMaThietBi();
    if (tenThietBi.value) validateTenThietBi();
    if (idKhuVuc.value) validateKhuVuc();
    if (topicMqtt.value) validateTopicMqtt();
});