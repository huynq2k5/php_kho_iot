<div class="row g-4 mb-4" id="sensorDataContainer">
    <div class="col-12 text-center py-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="text-muted mt-2 small fw-bold">Đang tải dữ liệu cảm biến...</p>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- GIẢ LẬP DỮ LIỆU TỪ BACKEND/API ---
        // Trong thực tế, bạn sẽ gọi API: fetch('/api/sensors').then(...)
        // Hoặc PHP sẽ echo dữ liệu này ra biến JS.
        const sensorData = [
            {
                id: 'temp_01',
                name: 'Nhiệt độ không khí',
                value: 32.5,
                unit: '°C',
                type: 'temp', // Dùng để định dạng màu sắc/icon
                status: 'warning', // success, warning, danger
                message: 'Cao hơn mức chuẩn'
            },
            {
                id: 'hum_01',
                name: 'Độ ẩm không khí',
                value: 68,
                unit: '%',
                type: 'hum',
                status: 'success',
                message: 'Ổn định'
            },
            {
                id: 'light_01',
                name: 'Cường độ ánh sáng',
                value: 450,
                unit: 'Lux',
                type: 'light',
                status: 'normal',
                message: 'Trời nắng nhẹ'
            },
            {
                id: 'soil_01',
                name: 'Độ ẩm đất',
                value: 85,
                unit: '%',
                type: 'soil',
                status: 'success',
                message: 'Đất đủ nước'
            },
            {
                id: 'co2_01',
                name: 'Nồng độ CO2',
                value: 410,
                unit: 'ppm',
                type: 'co2',
                status: 'normal',
                message: 'Không khí tốt'
            }
        ];

        // --- CẤU HÌNH GIAO DIỆN CHO TỪNG LOẠI CẢM BIẾN ---
        const config = {
            temp:  { icon: 'fa-temperature-high', color: 'danger',  bg: 'bg-danger-subtle' },
            hum:   { icon: 'fa-tint',             color: 'primary', bg: 'bg-primary-subtle' },
            light: { icon: 'fa-sun',              color: 'warning', bg: 'bg-warning-subtle' },
            soil:  { icon: 'fa-seedling',         color: 'success', bg: 'bg-success-subtle' },
            co2:   { icon: 'fa-wind',             color: 'secondary',bg: 'bg-secondary-subtle' },
            default: { icon: 'fa-microchip',      color: 'info',    bg: 'bg-info-subtle' }
        };

        // --- HÀM RENDER (VẼ GIAO DIỆN) ---
        function renderSensors(data) {
            const container = document.getElementById('sensorDataContainer');
            let html = '';

            data.forEach(sensor => {
                // Lấy style dựa trên loại cảm biến (nếu ko có lấy default)
                const style = config[sensor.type] || config.default;
                
                // Xác định màu chữ status
                let statusColor = 'text-muted';
                let statusIcon = '';
                
                if (sensor.status === 'warning') { 
                    statusColor = 'text-danger'; 
                    statusIcon = '<i class="fas fa-arrow-up me-1"></i>'; 
                } else if (sensor.status === 'success') {
                    statusColor = 'text-success';
                    statusIcon = '<i class="fas fa-check-circle me-1"></i>';
                }

                // Template String HTML (Bold & Clean Style)
                html += `
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            
                            <div>
                                <p class="text-secondary mb-1 fw-bold small text-uppercase">${sensor.name}</p>
                                <h2 class="fw-bold mb-0 text-dark display-6 fs-2">
                                    ${sensor.value} <span class="fs-6 text-muted fw-bold">${sensor.unit}</span>
                                </h2>
                                <small class="${statusColor} fw-bold mt-2 d-block" style="font-size: 0.75rem;">
                                    ${statusIcon} ${sensor.message}
                                </small>
                            </div>

                            <div class="icon-box ${style.bg} text-${style.color} rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                                <i class="fas ${style.icon} fs-3"></i>
                            </div>

                        </div>
                    </div>
                </div>
                `;
            });

            container.innerHTML = html;
        }

        // Gọi hàm render
        // setTimeout giả lập độ trễ mạng để thấy hiệu ứng loading (Bỏ đi khi dùng thật)
        setTimeout(() => {
            renderSensors(sensorData);
        }, 500);
    });
</script>

<style>
    /* CSS Bổ sung cho phần Sensor */
    
    /* Màu nền nhạt cho icon (Bootstrap 5.3 có sẵn, nếu dùng bản cũ thì thêm vào) */
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-secondary-subtle { background-color: rgba(108, 117, 125, 0.1) !important; }
    .bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }

   
</style>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-cogs me-2 text-primary"></i>Chế độ vận hành hệ thống</h5>
            <small class="text-muted" id="modeStatusText">Hệ thống đang chạy tự động theo cảm biến</small>
        </div>
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3 text-secondary" id="modeLabel">TỰ ĐỘNG</span>
            <div class="form-check form-switch mb-0">
                <input class="form-check-input scale-125" type="checkbox" id="masterModeSwitch" style="cursor: pointer;">
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-toggle-on me-2 text-success"></i>Điều khiển thiết bị chấp hành
        </h6>
        <div class="badge bg-light text-dark border">
            <span id="activeDeviceCount">0</span> thiết bị đang chạy
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="deviceTable">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-secondary small fw-bold text-uppercase">Tên thiết bị</th>
                    <th class="py-3 text-secondary small fw-bold text-uppercase">Loại/Vị trí</th>
                    <th class="py-3 text-secondary small fw-bold text-uppercase">Trạng thái</th>
                    <th class="pe-4 py-3 text-secondary small fw-bold text-uppercase text-end">Điều khiển</th>
                </tr>
            </thead>
            <tbody id="deviceTableBody">
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-light text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-fan"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Quạt thông gió 01</div>
                                <div class="small text-muted">ID: FAN_01</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">Khu vực A</span></td>
                    <td><span class="badge bg-secondary status-badge">Đang tắt</span></td>
                    <td class="pe-4 text-end">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input device-switch" type="checkbox" data-id="FAN_01" disabled>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-light text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-spray-can"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Máy phun sương</div>
                                <div class="small text-muted">ID: PUMP_01</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">Toàn kho</span></td>
                    <td><span class="badge bg-success status-badge">Đang chạy</span></td>
                    <td class="pe-4 text-end">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input device-switch" type="checkbox" data-id="PUMP_01" checked disabled>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-light text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">Đèn sưởi Halogen</div>
                                <div class="small text-muted">ID: LIGHT_HV</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">Khu vực B</span></td>
                    <td><span class="badge bg-secondary status-badge">Đang tắt</span></td>
                    <td class="pe-4 text-end">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input device-switch" type="checkbox" data-id="LIGHT_HV" disabled>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const masterSwitch = document.getElementById('masterModeSwitch');
        const modeLabel = document.getElementById('modeLabel');
        const modeText = document.getElementById('modeStatusText');
        const deviceSwitches = document.querySelectorAll('.device-switch');
        const activeCountDisplay = document.getElementById('activeDeviceCount');

        // Hàm cập nhật số lượng thiết bị đang chạy
        function updateActiveCount() {
            let count = 0;
            deviceSwitches.forEach(sw => {
                if(sw.checked) count++;
            });
            activeCountDisplay.textContent = count;
        }

        // 1. Xử lý Chế độ Vận hành (Auto/Manual)
        masterSwitch.addEventListener('change', function() {
            const isManual = this.checked;

            if(isManual) {
                // -> SANG THỦ CÔNG
                modeLabel.textContent = "THỦ CÔNG";
                modeLabel.classList.add('text-primary');
                modeLabel.classList.remove('text-secondary');
                modeText.textContent = "Bạn có toàn quyền điều khiển thiết bị";
                
                // Mở khóa tất cả các nút gạt trong bảng
                deviceSwitches.forEach(sw => {
                    sw.removeAttribute('disabled');
                    sw.closest('tr').classList.remove('opacity-50');
                });
            } else {
                // -> SANG TỰ ĐỘNG
                modeLabel.textContent = "TỰ ĐỘNG";
                modeLabel.classList.remove('text-primary');
                modeLabel.classList.add('text-secondary');
                modeText.textContent = "Hệ thống đang chạy tự động theo cảm biến";
                
                // Khóa tất cả các nút gạt lại
                deviceSwitches.forEach(sw => {
                    sw.setAttribute('disabled', 'true');
                    sw.closest('tr').classList.add('opacity-50');
                });
            }
        });

        // 2. Xử lý Bật/Tắt từng thiết bị trong bảng
        deviceSwitches.forEach(sw => {
            sw.addEventListener('change', function() {
                const row = this.closest('tr');
                const badge = row.querySelector('.status-badge');
                const iconBox = row.querySelector('.icon-box');
                const deviceId = this.getAttribute('data-id');

                if(this.checked) {
                    // Trạng thái ON
                    badge.textContent = "Đang chạy";
                    badge.className = "badge bg-success status-badge";
                    
                    iconBox.classList.remove('bg-light', 'text-secondary');
                    iconBox.classList.add('bg-success-subtle', 'text-success');

                    // Gọi AJAX gửi lệnh xuống Server/MQTT tại đây
                    console.log(`[CMD] Bật thiết bị: ${deviceId}`);

                } else {
                    // Trạng thái OFF
                    badge.textContent = "Đang tắt";
                    badge.className = "badge bg-secondary status-badge";
                    
                    iconBox.classList.remove('bg-success-subtle', 'text-success');
                    iconBox.classList.add('bg-light', 'text-secondary');

                    // Gọi AJAX gửi lệnh tắt
                    console.log(`[CMD] Tắt thiết bị: ${deviceId}`);
                }
                
                updateActiveCount();
            });
        });

        // Khởi chạy đếm lần đầu
        updateActiveCount();
        // Set state ban đầu (Mặc định là Auto -> Disabled table)
        deviceSwitches.forEach(sw => sw.closest('tr').classList.add('opacity-50'));
    });
</script>

<style>
    /* CSS Bổ sung */
    .scale-125 { transform: scale(1.25); transform-origin: right center; }
    
    /* Hiệu ứng mờ khi disable */
    .opacity-50 { opacity: 0.5; transition: opacity 0.3s; pointer-events: none; }
    
    /* Màu nền icon động */
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
</style>