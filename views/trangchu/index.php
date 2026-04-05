<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex flex-col items-start justify-between my-6 gap-y-4 sm:flex-row sm:items-center">
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tổng quan kho hàng
    </h2>
    
    <div class="flex items-center px-4 py-2 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        <div class="p-2 mr-3 text-purple-600 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-600">
            <i class="far fa-clock w-4 h-4 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase dark:text-gray-400 tracking-wider">Cập nhật lúc</p>
            <p class="text-sm font-bold text-gray-700 dark:text-gray-200" id="current-time">
                <?= isset($data['overview']['thoiGian']) ? date('H:i:s', strtotime($data['overview']['thoiGian'])) : '--:--:--' ?>
				<?= isset($data['overview']['thoiGian']) ? date('d/m/Y', strtotime($data['overview']['thoiGian'])) : 'Ngày --/--' ?>
            </p>
        </div>
    </div>
</div>

<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
            <i class="fas fa-temperature-high text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nhiệt độ TB</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-nhietdo">
                <?= number_format($data['overview']['avgTemp'] ?? 0, 1) ?> °C
            </p>
            <p id="stat-nhietdo" class="text-xs font-bold mt-1 text-gray-500">Đang tải...</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <i class="fas fa-tint text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Độ ẩm TB</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-doam">
                <?= number_format($data['overview']['avgHum'] ?? 0, 1) ?> %
            </p>
            <p id="stat-doam" class="text-xs font-bold mt-1 text-gray-500">Đang tải...</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <i class="fas fa-sun text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Ánh sáng TB</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-anhsang">
                <?= number_format($data['overview']['avgLight'] ?? 0, 0) ?> Lux
            </p>
            <p id="stat-anhsang" class="text-xs font-bold mt-1 text-gray-500">Đang tải...</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <i class="fas fa-wind text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nồng độ CO2 TB</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="val-co2">
                <?= number_format($data['overview']['avgCo2'] ?? 0, 0) ?> ppm
            </p>
            <p id="stat-co2" class="text-xs font-bold mt-1 text-gray-500">Đang tải...</p>
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
                <p class="text-xs text-gray-600 dark:text-gray-400" id="modeStatusText">
                    Hệ thống đang chạy <?= ($isManual) ? 'Thủ công' : 'Tự động' ?>
                </p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
				<input type="checkbox" id="masterSwitch" class="sr-only peer" 
					   <?= ($isManual) ? 'checked' : '' ?>
				>
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
					<tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity" id="row-cs">
						<td class="px-4 py-3 text-sm">
							<div class="flex items-center">
								<div class="p-2 mr-3 rounded-full bg-orange-50 dark:bg-orange-900">
									<i class="fas fa-window-maximize text-orange-500" id="icon-cs"></i>
								</div>
								<span class="font-medium">Cửa sổ thông minh</span>
							</div>
						</td>
						<td class="px-4 py-3 text-sm text-right">
							<button disabled id="btn-cs" onclick="controlDevice('cs')" class="btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed">Đang đợi...</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
	<div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
		<h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
			Danh sách thiết bị ESP32 (Nodes)
		</h4>
		
		<div class="space-y-3" id="esp-node-list">
			<?php foreach ($ttTB as $tb): ?>
			<div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 <?= ($tb->trangThai == 1) ? 'border-green-500' : 'border-red-500' ?>" 
				id="node-row-<?= $tb->maThietBi ?>">
				<div>
					<p class="text-sm font-bold text-purple-600">ID: <?= $tb->maThietBi ?></p>
					<p class="text-[10px] text-gray-500 uppercase tracking-tighter"><?= $tb->tenThietBi ?></p>
				</div>
				<span id="node-status-<?= $tb->maThietBi ?>" 
					class="text-xs font-black px-2 py-1 rounded <?= ($tb->trangThai == 1) ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
					<?= ($tb->trangThai == 1) ? 'ONLINE' : 'OFFLINE' ?>
				</span>
			</div>
			<?php endforeach; ?>
		</div>
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
		modeTopic: "kho_iot/system/mode",
		cmdTopic: "kho_iot/TB01/cmd",
		statusTopic: "kho_iot/TB01/status",
		clientId: "Web_Huy_" + Math.random().toString(16).substr(2, 4)
	};

    const client = new Paho.MQTT.Client(MQTT_CONF.broker, MQTT_CONF.port, MQTT_CONF.clientId);
    let deviceStates = { q: 0, a: 0, h: 0, cs: 0 };

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
		client.subscribe(MQTT_CONF.modeTopic);
        console.log("MQTT Connected!");
    }

    function onConnectionLost(res) {
        setTimeout(startConnect, 5000);
    }

    function controlDevice(dev) {
		if (!client.isConnected()) return;
		const isManual = document.getElementById('masterSwitch').checked;
		if (!isManual) return;

		const action = deviceStates[dev] === 1 ? "OFF" : "ON";
		const payload = JSON.stringify({
			device: dev,
			act: action
		});
		
		const message = new Paho.MQTT.Message(payload);
		message.destinationName = MQTT_CONF.cmdTopic;
		client.send(message);
	}
	
	function toggleSystemMode(isManual) {
		if (!client.isConnected()) return;
		const mode = isManual ? "MANUAL" : "AUTO";
		const message = new Paho.MQTT.Message(JSON.stringify({ mode: mode }));
		message.destinationName = MQTT_CONF.modeTopic;
		message.retained = true;
		message.qos = 1;
		client.send(message);
		
		const modeStatusText = document.getElementById('modeStatusText');
		if (modeStatusText) {
			modeStatusText.innerText = `Hệ thống đang chạy ${isManual ? 'Thủ công' : 'Tự động'}`;
		}
		
		updateAllButtons();
	}

    function onMessageArrived(message) {
        try {
            const payload = JSON.parse(message.payloadString);
            
            if (message.destinationName === MQTT_CONF.statusTopic) {
				deviceStates = { 
					q: payload.fan, 
					a: payload.ac, 
					h: payload.hum, 
					cs: payload.win
				};
				updateAllButtons();
				
				const badge = document.getElementById("device-status-badge");
				const detailLwt = document.getElementById("lwt-status-text");
				
				const isOnline = payload.s === 1;
				const statusText = isOnline ? "Online" : "Offline";
				const statusClass = isOnline ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100';

				if (badge) {
					badge.innerText = statusText;
					badge.className = `px-2 py-1 font-semibold leading-tight rounded-full ${statusClass}`;
				}
				
				if (detailLwt) {
					detailLwt.innerText = isOnline ? "CONNECTED" : "LOST CONNECTION";
					detailLwt.className = `text-xs font-bold ${isOnline ? 'text-green-600' : 'text-red-600'}`;
				}
			}

            if (message.destinationName === MQTT_CONF.baseTopic) {
				if (payload.fan !== undefined || payload.ac !== undefined || payload.hum !== undefined || payload.cs !== undefined) {
					deviceStates = { 
						q: payload.fan !== undefined ? payload.fan : deviceStates.q, 
						a: payload.ac !== undefined ? payload.ac : deviceStates.a, 
						h: payload.hum !== undefined ? payload.hum : deviceStates.h,
						cs: payload.cs !== undefined ? payload.cs : deviceStates.cs
					};
					updateAllButtons();
				}
			}
			
			if (message.destinationName === MQTT_CONF.modeTopic) {
				const payload = JSON.parse(message.payloadString);
				const isManual = payload.mode === "MANUAL";
				const masterSwitch = document.getElementById('masterSwitch');
				const modeStatusText = document.getElementById('modeStatusText');

				if (masterSwitch && masterSwitch.checked !== isManual) {
					masterSwitch.checked = isManual; // Chỉ cập nhật nếu trạng thái khác hiện tại
				}

				if (modeStatusText) {
					modeStatusText.innerText = `Hệ thống đang chạy ${isManual ? 'Thủ công' : 'Tự động'}`;
				}
				
				updateAllButtons(); // Cập nhật mờ/sáng các nút thiết bị
			}
        } catch (e) { console.error("JSON Error", e); }
    }

    function updateAllButtons() {
		const isManual = document.getElementById('masterSwitch')?.checked;
		
		['q', 'a', 'h', 'cs'].forEach(dev => {
			const btn = document.getElementById(`btn-${dev}`);
			const row = document.getElementById(`row-${dev}`);
			if (!btn || !row) return;

			const isOn = deviceStates[dev] === 1;
			btn.innerText = isOn ? "Bật" : "Tắt";
			
			if (!isManual) {
				btn.disabled = true;
				btn.className = "btn-device px-3 py-1 text-xs font-medium text-white bg-gray-400 rounded-md cursor-not-allowed";
				row.classList.add('opacity-50');
			} else {
				btn.disabled = false;
				row.classList.remove('opacity-50');
				// Gán màu đỏ/xanh chuẩn xác dựa trên biến isOn
				btn.className = `btn-device px-3 py-1 text-xs font-medium text-white rounded-md ${isOn ? 'bg-green-600' : 'bg-red-600'}`;
			}
		});
	}

	function updateNodeStatusAjax() {
		fetch('index.php?page=api_ttTB')
			.then(response => response.json())
			.then(data => {
				data.forEach(tb => {
					const row = document.getElementById(`node-row-${tb.maThietBi}`);
					const statusBadge = document.getElementById(`node-status-${tb.maThietBi}`);
					
					if (row && statusBadge) {
						const isOnline = (parseInt(tb.trangThai) === 1);
						
						row.className = `flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 ${isOnline ? 'border-green-500' : 'border-red-500'}`;
						
						statusBadge.innerText = isOnline ? 'ONLINE' : 'OFFLINE';
						statusBadge.className = `text-xs font-black px-2 py-1 rounded ${isOnline ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;
					}
				});
			})
			.catch(err => console.error("Lỗi cập nhật thiết bị:", err));
	}

	function updateSensorsFromDb() {
		fetch('index.php?page=api_get_latest_sensors')
			.then(response => response.json())
			.then(data => {
				if (data && data.status) {
					document.getElementById('val-nhietdo').innerText = parseFloat(data.avgTemp).toFixed(1) + " °C";
					document.getElementById('val-doam').innerText = parseFloat(data.avgHum).toFixed(1) + " %";
					document.getElementById('val-anhsang').innerText = parseInt(data.avgLight) + " Lux";
					document.getElementById('val-co2').innerText = parseInt(data.avgCo2) + " ppm";

					const mapStatus = {
						temp: 'stat-nhietdo',
						hum: 'stat-doam',
						light: 'stat-anhsang',
						co2: 'stat-co2'
					};

					Object.keys(mapStatus).forEach(key => {
						const statusEl = document.getElementById(mapStatus[key]);
						if (statusEl && data.status[key]) {
							statusEl.innerText = data.status[key].text;
							statusEl.className = `text-xs font-bold mt-1 ${data.status[key].class}`;
						}
					});

					const timeEl = document.getElementById('current-time');
					if (timeEl && data.thoiGian) {
						timeEl.innerText = data.thoiGian; 
					}
				}
			})
			.catch(err => console.error("Lỗi lấy dữ liệu DB:", err));
	}

    document.addEventListener("DOMContentLoaded", () => {
		document.getElementById('masterSwitch')?.addEventListener('click', function(e) {
			if (!client.isConnected()) {
				e.preventDefault(); // Chặn gạt nếu chưa có mạng
				return;
			}

			const isManual = this.checked;
			const mode = isManual ? "MANUAL" : "AUTO";
			
			// Chỉ thực hiện GỬI tin nhắn
			const message = new Paho.MQTT.Message(JSON.stringify({ mode: mode }));
			message.destinationName = MQTT_CONF.modeTopic;
			message.retained = true;
			message.qos = 1;
			client.send(message);
			
			
		});
        document.getElementById('masterSwitch')?.addEventListener('change', updateAllButtons);
		setInterval(updateNodeStatusAjax, 3000);
		setInterval(updateSensorsFromDb, 3000);
		updateSensorsFromDb();
        startConnect();
    });
</script>