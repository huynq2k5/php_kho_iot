<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Tổng quan kho hàng
</h2>

<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
            <i class="fas fa-temperature-high text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nhiệt độ</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-nhietdo">-- °C</p>
            <p class="text-xs font-bold text-red-600 mt-1">Cao hơn chuẩn</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <i class="fas fa-tint text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Độ ẩm</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-doam">-- %</p>
            <p class="text-xs text-gray-500 mt-1">Ổn định</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <i class="fas fa-sun text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Ánh sáng</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-anhsang">-- Lux</p>
            <p class="text-xs text-gray-500 mt-1">Trời nắng</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <i class="fas fa-wind text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nồng độ CO2</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-co2">-- ppm</p>
            <p class="text-xs text-green-600 font-bold mt-1">Không khí tốt</p>
        </div>
    </div>
</div>

<div class="grid gap-6 mb-8 md:grid-cols-2">
    
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Điều khiển hệ thống
        </h4>
        
        <div class="flex items-center justify-between p-4 mb-4 bg-purple-50 rounded-lg border border-purple-100 dark:bg-gray-700 dark:border-gray-600">
			<div>
				<p class="font-semibold text-purple-700 dark:text-purple-300">Chế độ vận hành</p>
				<p class="text-xs text-gray-600 dark:text-gray-400" id="modeStatusText">Hệ thống đang chạy Tự động</p>
			</div>
			<label class="relative inline-flex items-center cursor-pointer">
				<input type="checkbox" id="masterSwitch" class="sr-only peer">
				<div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-purple-600 peer-focus:ring-2 peer-focus:ring-purple-300 dark:bg-gray-700 dark:peer-focus:ring-purple-800 transition-all duration-300"></div>
				<div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-all duration-300"></div>                
			</label>
		</div>

		<div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap">
				<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="controlTable">
					<tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity" id="row-q">
						<td class="px-4 py-3 text-sm">
							<div class="flex items-center">
								<div class="p-2 mr-3 rounded-full bg-gray-100 dark:bg-gray-700">
									<i class="fas fa-fan" id="icon-q"></i>
								</div>
								<span class="font-medium">Quạt thông gió</span>
							</div>
						</td>
						<td class="px-4 py-3 text-sm text-right">
							<button disabled id="btn-q" onclick="controlDevice('q')" class="btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed">Đang đợi...</button>
						</td>
					</tr>
					<tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity" id="row-a">
						<td class="px-4 py-3 text-sm">
							<div class="flex items-center">
								<div class="p-2 mr-3 rounded-full bg-blue-50 dark:bg-blue-900">
									<i class="fas fa-snowflake text-blue-500" id="icon-a"></i>
								</div>
								<span class="font-medium">Máy lạnh</span>
							</div>
						</td>
						<td class="px-4 py-3 text-sm text-right">
							<button disabled id="btn-a" onclick="controlDevice('a')" class="btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed">Đang đợi...</button>
						</td>
					</tr>
					<tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity" id="row-h">
						<td class="px-4 py-3 text-sm">
							<div class="flex items-center">
								<div class="p-2 mr-3 rounded-full bg-teal-50 dark:bg-teal-900">
									<i class="fas fa-droplet-slash text-teal-500" id="icon-h"></i>
								</div>
								<span class="font-medium">Máy hút ẩm</span>
							</div>
						</td>
						<td class="px-4 py-3 text-sm text-right">
							<button disabled id="btn-h" onclick="controlDevice('h')" class="btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed">Đang đợi...</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>

    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Xu hướng môi trường (24h)
        </h4>
        
        <div class="relative w-full h-64">
            <canvas id="lineChart"></canvas>
        </div>

        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-red-500 rounded-full"></span>
                <span>Nhiệt độ</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                <span>Độ ẩm</span>
            </div>
        </div>
    </div>
</div>

<h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
    Trạng thái kết nối
</h2>
<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Thiết bị</th>
                    <th class="px-4 py-3">Loại</th>
                    <th class="px-4 py-3">Trạng thái</th>
                    <th class="px-4 py-3">Lần cuối</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <div class="w-full h-full rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                    <i class="fas fa-microchip"></i>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold">Cảm biến Khu A</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">ESP32</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">Sensor Node</td>
                    <td class="px-4 py-3 text-xs">
                        <span id="device-status-badge" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Online
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">Vừa xong</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    /* CSS cho nút gạt */
    input:checked ~ .toggle-bg { background-color: #7e3af2; border-color: #7e3af2; }
    input:checked ~ .dot { transform: translateX(100%); }
    .opacity-50 { opacity: 0.5; }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

<script>
    const MQTT_CONF = {
        broker: "66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud",
        port: 8884,
        user: "huyng",
        pass: "Huy12345",
        baseTopic: "kho_iot/TB01",
        cmdTopic: "kho_iot/TB01/cmd",
        statusTopic: "kho_iot/TB01/status",
        clientId: "Web_Huy_" + Math.random().toString(16).substr(2, 4)
    };

    const client = new Paho.MQTT.Client(MQTT_CONF.broker, MQTT_CONF.port, MQTT_CONF.clientId);
    let deviceStates = { q: 0, a: 0, h: 0 };

    const mqttOptions = {
        useSSL: true,
        userName: MQTT_CONF.user,
        password: MQTT_CONF.pass,
        onSuccess: onConnect,
        onFailure: (err) => setTimeout(startConnect, 5000),
        keepAliveInterval: 30
    };

    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    function startConnect() {
        if (!client.isConnected()) client.connect(mqttOptions);
    }

    function onConnect() {
        client.subscribe(MQTT_CONF.baseTopic);
        client.subscribe(MQTT_CONF.statusTopic);
        console.log("MQTT Connected!");
    }

    function onConnectionLost(res) {
        setTimeout(startConnect, 5000);
    }

    function controlDevice(dev) {
        if (!client.isConnected()) return;
        const action = deviceStates[dev] === 1 ? "off" : "on";
        const message = new Paho.MQTT.Message(`${dev}_${action}`);
        message.destinationName = MQTT_CONF.cmdTopic;
        client.send(message);
    }

    function onMessageArrived(message) {
        try {
            const payload = JSON.parse(message.payloadString);
            
            if (message.destinationName === MQTT_CONF.statusTopic) {
                deviceStates = { q: payload.q, a: payload.a, h: payload.h };
                updateAllButtons();
                
                const badge = document.getElementById("device-status-badge");
                if (badge) {
                    const isOnline = payload.s === 1;
                    badge.innerText = isOnline ? "Online" : "Offline";
                    badge.className = `px-2 py-1 font-semibold leading-tight rounded-full ${isOnline ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100'}`;
                }
            }

            if (message.destinationName === MQTT_CONF.baseTopic) {
                const map = { t: "val-nhietdo", h: "val-doam", co2: "val-co2", as: "val-anhsang" };
                const units = { t: "°C", h: "%", co2: " ppm", as: " Lux" };
                
                Object.keys(map).forEach(key => {
                    const el = document.getElementById(map[key]);
                    if (el && payload[key] !== undefined) {
                        el.innerText = (typeof payload[key] === 'number' ? payload[key].toFixed(1) : payload[key]) + units[key];
                    }
                });
            }
        } catch (e) { console.error("JSON Error", e); }
    }

    function updateAllButtons() {
        const isManual = document.getElementById('masterSwitch')?.checked;
        
        ['q', 'a', 'h'].forEach(dev => {
            const btn = document.getElementById(`btn-${dev}`);
            const row = document.getElementById(`row-${dev}`);
            const icon = document.getElementById(`icon-${dev}`);
            const statusText = document.getElementById(`status-text-${dev}`);
            
            if (!btn || !row) return;

            const isOn = deviceStates[dev] === 1;
            btn.innerText = isOn ? "Bật" : "Tắt";
            
            if (statusText) {
                statusText.innerText = isOn ? "ON" : "OFF";
                statusText.className = `ml-2 text-xs font-bold ${isOn ? 'text-green-600' : 'text-red-600'}`;
            }

            if (!isManual) {
                btn.disabled = true;
                btn.className = "btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed";
                row.classList.add('opacity-50');
            } else {
                btn.disabled = false;
                row.classList.remove('opacity-50');
                btn.className = `btn-device px-3 py-1 text-xs font-medium text-white rounded-md ${isOn ? 'bg-green-600' : 'bg-red-600'}`;
            }

            if (icon && dev === 'q') icon.className = `fas fa-fan ${isOn ? 'text-green-500 fa-spin' : 'text-gray-500'}`;
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById('masterSwitch')?.addEventListener('change', updateAllButtons);
        startConnect();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- 1. SỬA LỖI BIỂU ĐỒ ---
        const ctx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0h', '4h', '8h', '12h', '16h', '20h'],
                datasets: [
                    {
                        data: [26, 25, 28, 32, 30, 27],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4 // Làm mềm đường vẽ
                    },
                    {
                        data: [70, 72, 68, 60, 62, 68],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // QUAN TRỌNG: Ngăn biểu đồ tự phóng to chiều cao
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: false, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // --- 2. LOGIC NÚT GẠT ---
        const masterSwitch = document.getElementById('masterSwitch');
        const modeLabel = document.getElementById('modeLabel');
        const tableRows = document.querySelectorAll('#controlTable tr');
        const buttons = document.querySelectorAll('.btn-device');

        masterSwitch.addEventListener('change', function() {
            if (this.checked) {
                modeLabel.innerText = "MANUAL";
                tableRows.forEach(r => r.classList.remove('opacity-50'));
                buttons.forEach(btn => {
                    btn.disabled = false;
                    btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    // Gán màu lại
                    if(btn.innerText.trim() === 'Tắt') btn.classList.add('bg-red-600', 'hover:bg-red-700');
                    else btn.classList.add('bg-green-600', 'hover:bg-green-700');
                });
            } else {
                modeLabel.innerText = "AUTO";
                tableRows.forEach(r => r.classList.add('opacity-50'));
                buttons.forEach(btn => {
                    btn.disabled = true;
                    btn.className = "btn-device px-3 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-md cursor-not-allowed";
                });
            }
        });
    });
</script>