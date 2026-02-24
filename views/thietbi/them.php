<div>
    <div class="flex items-center justify-between my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Thêm Node thiết bị mới
        </h2>
        <a href="index.php?page=thietbi" 
           class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-chevron-left mr-2"></i> Quay lại danh sách
        </a>
    </div>

    <form action="index.php?page=thietbi_xu_ly_them" method="POST" id="addNodeForm">
        <div class="grid gap-6 mb-8 md:grid-cols-12">
            
            <!-- Cột trái: Thông tin cơ bản -->
            <div class="md:col-span-7">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        <i class="fas fa-info-circle text-red-600 dark:text-red-400 mr-2"></i>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin cơ bản</h4>
                    </div>

                    <div class="space-y-4">
                        <!-- Tên Node với validation -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Tên Node (ID)</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   name="device_name" 
                                   type="text" 
                                   placeholder="Ví dụ: Node_Sensor_02" 
                                   id="device_name"
                                   required>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="device_name_helper">
                                Tối thiểu 3 ký tự, không dấu cách
                            </span>
                        </label>

                        <!-- Loại phần cứng với validation -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Loại phần cứng</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   name="device_type" 
                                   type="text" 
                                   placeholder="Ví dụ: ESP32 DEVKIT" 
                                   id="device_type"
                                   required>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nhập chính xác model phần cứng</span>
                        </label>
                    </div>
                </div>

                <!-- Note box -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200 dark:bg-blue-900/20 dark:border-blue-800">
                    <h4 class="mb-2 font-semibold text-blue-700 dark:text-blue-400 text-sm flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i> Lưu ý
                    </h4>
                    <p class="text-xs text-blue-600 dark:text-blue-400 leading-relaxed">
                        Sau khi thêm, hệ thống sẽ cấp một <span class="font-semibold">Access Key</span> riêng cho Node này để xác thực dữ liệu gửi lên server.
                    </p>
                </div>
            </div>

            <!-- Cột phải: Thông số kết nối -->
            <div class="md:col-span-5">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        <i class="fas fa-wifi text-red-600 dark:text-red-400 mr-2"></i>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông số kết nối mặc định</h4>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- MQTT Broker với validation -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">MQTT Broker</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   name="mqtt_host" 
                                   type="text" 
                                   value="broker.hivemq.com"
                                   id="mqtt_host"
                                   required>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Địa chỉ broker MQTT</span>
                        </label>

                        <!-- Topic mặc định với validation -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Topic mặc định</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   name="mqtt_topic" 
                                   type="text" 
                                   placeholder="vlu/kho_iot/device_name"
                                   id="mqtt_topic"
                                   required>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Có thể thay đổi sau khi tạo</p>
                            <span class="text-xs text-red-600 dark:text-red-400 hidden" id="mqtt_topic_error">Topic phải bắt đầu bằng vlu/kho_iot/</span>
                        </label>

                        <!-- Tần suất với validation -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Tần suất gửi dữ liệu</span>
                            <div class="relative mt-1">
                                <input class="block w-full pr-16 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                       name="interval" 
                                       type="number" 
                                       value="30"
                                       min="5"
                                       max="3600"
                                       id="interval">
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none bg-gray-100 dark:bg-gray-700 rounded-r-md border-l dark:border-gray-600">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">giây</span>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Từ 5 - 3600 giây (1 giờ)</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" 
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
                            <i class="fas fa-plus-circle mr-2"></i> Khởi tạo thiết bị
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    /* Đồng bộ Shadow đỏ khi focus */
    .focus\:shadow-outline-red:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.45);
    }
    
    /* Dark mode focus shadow */
    .dark .dark\:focus\:shadow-outline-gray:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    }

    /* Validation styles */
    .input-invalid {
        border-color: #dc2626 !important;
        background-color: rgba(220, 38, 38, 0.02);
    }
    .input-valid {
        border-color: #16a34a !important;
    }
    .dark .input-invalid {
        border-color: #ef4444 !important;
        background-color: rgba(239, 68, 68, 0.05);
    }
    .dark .input-valid {
        border-color: #4ade80 !important;
    }

    /* Highlight cho helper text lỗi */
    .text-red-600 {
        color: #dc2626;
        font-weight: 500;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addNodeForm');
    const deviceName = document.getElementById('device_name');
    const deviceType = document.getElementById('device_type');
    const mqttHost = document.getElementById('mqtt_host');
    const mqttTopic = document.getElementById('mqtt_topic');
    const interval = document.getElementById('interval');
    const mqttTopicError = document.getElementById('mqtt_topic_error');

    // Helper text elements
    const deviceNameHelper = document.getElementById('device_name_helper');

    // Hàm validate device name (ĐÃ SỬA LỖI DẤU CÁCH)
    function validateDeviceName() {
        const value = deviceName.value; // Giữ nguyên để kiểm tra dấu cách ở đầu/cuối
        const trimmedValue = value.trim();
        const helper = deviceNameHelper;
        
        // Xóa hết
        if (value === '') {
            deviceName.classList.remove('input-valid');
            deviceName.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.classList.remove('text-green-600', 'dark:text-green-400', 'text-gray-500', 'dark:text-gray-400');
            helper.textContent = '❌ Tên Node không được để trống';
            return false;
        }
        // Kiểm tra độ dài sau khi trim
        else if (trimmedValue.length < 3) {
            deviceName.classList.remove('input-valid');
            deviceName.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.classList.remove('text-green-600', 'dark:text-green-400', 'text-gray-500', 'dark:text-gray-400');
            helper.textContent = '❌ Tên Node phải có ít nhất 3 ký tự';
            return false;
        } 
        // KIỂM TRA DẤU CÁCH - PHÁT HIỆN MỌI KHOẢNG TRẮNG
        else if (value.includes(' ')) {
            deviceName.classList.remove('input-valid');
            deviceName.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.classList.remove('text-green-600', 'dark:text-green-400', 'text-gray-500', 'dark:text-gray-400');
            
            // Phân tích lỗi cụ thể
            if (value.startsWith(' ') || value.endsWith(' ')) {
                helper.textContent = '❌ Tên Node không được có khoảng trắng ở đầu hoặc cuối';
            } else {
                helper.textContent = '❌ Tên Node không được chứa dấu cách';
            }
            return false;
        } 
        // Kiểm tra ký tự đặc biệt (tùy chọn)
        else if (!/^[a-zA-Z0-9_-]+$/.test(value)) {
            deviceName.classList.remove('input-valid');
            deviceName.classList.add('input-invalid');
            helper.classList.add('text-red-600', 'dark:text-red-400');
            helper.classList.remove('text-green-600', 'dark:text-green-400', 'text-gray-500', 'dark:text-gray-400');
            helper.textContent = '❌ Tên Node chỉ được chứa chữ cái, số, gạch dưới (_) và gạch ngang (-)';
            return false;
        }
        // Hợp lệ
        else {
            deviceName.classList.remove('input-invalid');
            deviceName.classList.add('input-valid');
            helper.classList.remove('text-red-600', 'dark:text-red-400', 'text-gray-500', 'dark:text-gray-400');
            helper.classList.add('text-green-600', 'dark:text-green-400');
            helper.textContent = '✓ Hợp lệ';
            return true;
        }
    }

    // Hàm validate MQTT topic
    function validateMqttTopic() {
        const value = mqttTopic.value;
        const trimmedValue = value.trim();
        
        if (value === '') {
            mqttTopic.classList.remove('input-valid');
            mqttTopic.classList.add('input-invalid');
            mqttTopicError.classList.remove('hidden');
            mqttTopicError.textContent = '❌ Topic không được để trống';
            return false;
        }
        else if (value.includes(' ')) {
            mqttTopic.classList.remove('input-valid');
            mqttTopic.classList.add('input-invalid');
            mqttTopicError.classList.remove('hidden');
            mqttTopicError.textContent = '❌ Topic không được chứa dấu cách';
            return false;
        }
        else if (!trimmedValue.startsWith('vlu/kho_iot/')) {
            mqttTopic.classList.remove('input-valid');
            mqttTopic.classList.add('input-invalid');
            mqttTopicError.classList.remove('hidden');
            mqttTopicError.textContent = '❌ Topic phải bắt đầu bằng vlu/kho_iot/';
            return false;
        } else {
            mqttTopic.classList.remove('input-invalid');
            mqttTopic.classList.add('input-valid');
            mqttTopicError.classList.add('hidden');
            return true;
        }
    }

    // Hàm validate interval
    function validateInterval() {
        const value = parseInt(interval.value);
        
        if (isNaN(value) || interval.value === '') {
            interval.classList.remove('input-valid');
            interval.classList.add('input-invalid');
            return false;
        }
        else if (value < 5) {
            interval.classList.remove('input-valid');
            interval.classList.add('input-invalid');
            return false;
        }
        else if (value > 3600) {
            interval.classList.remove('input-valid');
            interval.classList.add('input-invalid');
            return false;
        }
        else {
            interval.classList.remove('input-invalid');
            interval.classList.add('input-valid');
            return true;
        }
    }

    // Hàm validate device type
    function validateDeviceType() {
        const value = deviceType.value.trim();
        
        if (value === '') {
            deviceType.classList.remove('input-valid');
            deviceType.classList.add('input-invalid');
            return false;
        } else {
            deviceType.classList.remove('input-invalid');
            deviceType.classList.add('input-valid');
            return true;
        }
    }

    // Hàm validate MQTT host
    function validateMqttHost() {
        const value = mqttHost.value.trim();
        
        if (value === '') {
            mqttHost.classList.remove('input-valid');
            mqttHost.classList.add('input-invalid');
            return false;
        } else {
            mqttHost.classList.remove('input-invalid');
            mqttHost.classList.add('input-valid');
            return true;
        }
    }

    // Gán sự kiện cho các input
    deviceName.addEventListener('input', validateDeviceName);
    deviceName.addEventListener('blur', validateDeviceName);

    deviceType.addEventListener('input', validateDeviceType);
    deviceType.addEventListener('blur', validateDeviceType);

    mqttHost.addEventListener('input', validateMqttHost);
    mqttHost.addEventListener('blur', validateMqttHost);

    mqttTopic.addEventListener('input', validateMqttTopic);
    mqttTopic.addEventListener('blur', validateMqttTopic);

    interval.addEventListener('input', validateInterval);
    interval.addEventListener('blur', validateInterval);

    // Form submit validation
    form.addEventListener('submit', function(e) {
        const isDeviceNameValid = validateDeviceName();
        const isDeviceTypeValid = validateDeviceType();
        const isMqttHostValid = validateMqttHost();
        const isMqttTopicValid = validateMqttTopic();
        const isIntervalValid = validateInterval();

        if (!isDeviceNameValid || !isDeviceTypeValid || !isMqttHostValid || !isMqttTopicValid || !isIntervalValid) {
            e.preventDefault();
            
            if (!isDeviceNameValid) deviceName.focus();
            else if (!isDeviceTypeValid) deviceType.focus();
            else if (!isMqttHostValid) mqttHost.focus();
            else if (!isMqttTopicValid) mqttTopic.focus();
            else if (!isIntervalValid) interval.focus();
            
            alert('Vui lòng kiểm tra lại các trường bị lỗi!');
        }
    });

    // Validate lần đầu khi load trang
    validateDeviceName();
    validateDeviceType();
    validateMqttHost();
    validateMqttTopic();
    validateInterval();
});
</script>