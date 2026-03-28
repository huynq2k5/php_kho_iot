
<div class="pb-10 relative">
    <div id="lock-overlay" class="hidden absolute inset-0 z-50 flex items-center justify-center bg-gray-100/10 dark:bg-gray-900/10 backdrop-blur-[2px] rounded-xl">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl border border-purple-500/50 text-center max-w-xs scale-90">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-lock text-purple-600"></i>
            </div>
            <h3 class="text-lg font-bold dark:text-white mb-1">Nội dung bị khóa</h3>
            <p class="text-xs text-gray-500 mb-4">Chế độ <b>THỦ CÔNG</b> đang bật. Không thể chỉnh sửa kịch bản.</p>
            
            <a href="index.php?page=dashboard" 
            class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors shadow-md active:transform active:scale-95">
                <i class="fas fa-home mr-2"></i>
                Quay lại trang chủ
            </a>
        </div>
    </div>

    <div id="automation-main-content" class="transition-all duration-300">
    <div class="flex flex-col items-start justify-between gap-4 my-6 sm:flex-row sm:items-center">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tự động hóa hệ thống
        </h2>
        <a href="index.php?page=tudong-them" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
            <i class="fas fa-plus mr-2"></i>
            <span>Thêm kịch bản mới</span>
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-1">
        
        <!-- Card Theo Cảm biến -->
        <div class="min-w-0 p-5 bg-white rounded-xl shadow-sm dark:bg-gray-800 ">
            <div class="flex items-center justify-between mb-6">
                <h4 class="font-bold text-black-600 dark:text-white-400 flex items-center text-lg">
                    Danh sách kịch bản
                </h4>
                
            </div>
            
            <div class="space-y-8">
                <?php foreach ($data['sensor'] as $kb): ?>
                <div class="automation-group group">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-700 dark:text-gray-200"><?php echo $kb->tenKichBan; ?></span>
                        <label class="flex items-center cursor-pointer relative">
                            <input type="checkbox" 
                                class="sr-only peer kb-toggle" 
                                data-id="<?php echo $kb->idKichBan; ?>"
                                <?php echo $kb->kichHoat ? 'checked' : ''; ?>
                                onchange="toggleAutomation(<?php echo $kb->idKichBan; ?>, this.checked)">
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-red-600 transition-all duration-300"></div>
                            <div class="absolute left-0.5 top-0.5 bg-white w-4 h-4 rounded-full transition-all duration-300 peer-checked:translate-x-5 shadow-sm"></div>
                        </label>
                    </div>
                    
                    <div class="relative p-3 bg-gray-50 rounded-lg dark:bg-gray-700 border border-gray-100 dark:border-gray-600 flex items-center justify-between overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400 ml-2">
                            <?php echo $kb->getFormattedCondition(); ?>
                        </span>
                        <i class="fas fa-arrow-right text-gray-300 text-xs"></i>
                        <span class="text-xs font-black <?php echo $kb->hanhDong === 'ON' ? 'text-green-600' : 'text-red-500'; ?> uppercase">
                            <?php echo $kb->hanhDong === 'ON' ? 'BẬT' : 'TẮT'; ?> <?php echo $kb->tenThanhPhanRa; ?>
                        </span>
                    </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
        function toggleAutomation(id, isChecked) {
            const status = isChecked ? 1 : 0;
            fetch(`index.php?page=api-tudong-toggle&id=${id}&status=${status}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Lỗi cập nhật trạng thái!');
                    }
                });
        }

        function syncAutomationStatus() {
            fetch('index.php?page=api-tudong-status')
                .then(response => response.json())
                .then(data => {
                    for (const id in data) {
                        const checkbox = document.querySelector(`.kb-toggle[data-id="${id}"]`);
                        if (checkbox) {
                            checkbox.checked = (data[id] == 1);
                        }
                    }
                })
                .catch(err => console.error('Lỗi đồng bộ:', err));
        }

        setInterval(syncAutomationStatus, 5000);
        </script>

    </div>
    </div>
</div>

<style>
    .dot {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .peer:checked ~ .dot {
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    .automation-group {
        border-bottom: 1px solid rgba(0,0,0,0.03);
        padding-bottom: 0.5rem;
    }
    .automation-group:last-child {
        border-bottom: none;
    }
    .dark .automation-group {
        border-bottom-color: rgba(255,255,255,0.03);
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>

<script>
    const MQTT_CONF = {
        broker: "66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud",
        port: 8884,
        user: "huyng",
        pass: "Huy12345",
        modeTopic: "kho_iot/system/mode",
        clientId: "Web_Auto_Page_" + Math.random().toString(16).substr(2, 4)
    };

    const client = new Paho.MQTT.Client(MQTT_CONF.broker, MQTT_CONF.port, MQTT_CONF.clientId);

    const mqttOptions = {
        useSSL: true,
        userName: MQTT_CONF.user,
        password: MQTT_CONF.pass,
        onSuccess: () => {
            client.subscribe(MQTT_CONF.modeTopic);
            console.log("MQTT Connected on Automation Page");
        },
        onFailure: () => setTimeout(() => client.connect(mqttOptions), 5000),
        keepAliveInterval: 30
    };

    client.onMessageArrived = (message) => {
        if (message.destinationName === MQTT_CONF.modeTopic) {
            try {
                const payload = JSON.parse(message.payloadString);
                updatePageLock(payload.mode === "MANUAL");
            } catch (e) { console.error(e); }
        }
    };

    client.connect(mqttOptions);

    function updatePageLock(isManual) {
        const overlay = document.getElementById('lock-overlay');
        const content = document.getElementById('automation-main-content');
        
        if (isManual) {
            overlay.classList.remove('hidden');
            // Chặn click (pointer-events-none) và làm mờ nhẹ
            content.classList.add('pointer-events-none', 'opacity-40', 'grayscale-[0.4]');
        } else {
            overlay.classList.add('hidden');
            content.classList.remove('pointer-events-none', 'opacity-40', 'grayscale-[0.4]');
        }
    }
</script>