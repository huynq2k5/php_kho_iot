<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card p-4 d-flex align-items-center justify-content-between h-100">
            <div>
                <p class="text-muted mb-1 font-weight-bold">Nhiệt độ</p>
                <h2 class="fw-bold mb-0 text-dark">28°C</h2>
                <small class="text-danger"><i class="fas fa-arrow-up"></i> Cao hơn mức chuẩn</small>
            </div>
            <div class="stat-icon bg-soft-danger rounded-circle">
                <i class="fas fa-temperature-high"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card p-4 d-flex align-items-center justify-content-between h-100">
            <div>
                <p class="text-muted mb-1 font-weight-bold">Độ ẩm</p>
                <h2 class="fw-bold mb-0 text-dark">65%</h2>
                <small class="text-primary"><i class="fas fa-check"></i> Ổn định</small>
            </div>
            <div class="stat-icon bg-soft-primary rounded-circle">
                <i class="fas fa-tint"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card p-4 d-flex align-items-center justify-content-between h-100">
            <div>
                <p class="text-muted mb-1 font-weight-bold">Ánh sáng</p>
                <h2 class="fw-bold mb-0 text-dark">350 <span class="fs-6">Lux</span></h2>
                <small class="text-muted">Trời đang nắng</small>
            </div>
            <div class="stat-icon bg-soft-warning rounded-circle">
                <i class="fas fa-sun"></i>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card p-4 d-flex align-items-center justify-content-between h-100">
            <div>
                <p class="text-muted mb-1 font-weight-bold">Nồng độ CO₂</p>
                <h2 class="fw-bold mb-0 text-dark">420 <span class="fs-6">ppm</span></h2>
                <small class="text-success">Không khí tốt</small>
            </div>
            <div class="stat-icon bg-soft-success rounded-circle">
                <i class="fas fa-wind"></i>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-bold"><i class="fas fa-cogs me-2"></i>Chế độ vận hành</h5>
            <small class="text-muted" id="modeStatusText">Hệ thống đang chạy tự động theo cảm biến</small>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="masterModeSwitch">
            <label class="form-check-label fw-bold ms-2" for="masterModeSwitch" id="modeLabel">TỰ ĐỘNG</label>
        </div>
    </div>
</div>

<h5 class="mb-3 text-secondary">Điều khiển thiết bị</h5>
<div class="row g-4">
    
    <div class="col-12 col-md-4">
        <div class="card device-card h-100 p-3 disabled" id="card-fan"> <div class="d-flex justify-content-between align-items-start">
                <div class="device-icon">
                    <i class="fas fa-fan"></i>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input device-switch" type="checkbox" id="switch-fan" data-target="card-fan">
                </div>
            </div>
            <div class="mt-3">
                <h5 class="fw-bold">Quạt thông gió</h5>
                <span class="badge bg-secondary status-badge">Đang tắt</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card device-card h-100 p-3 disabled" id="card-mist">
            <div class="d-flex justify-content-between align-items-start">
                <div class="device-icon">
                    <i class="fas fa-spray-can"></i>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input device-switch" type="checkbox" id="switch-mist" data-target="card-mist">
                </div>
            </div>
            <div class="mt-3">
                <h5 class="fw-bold">Máy phun sương</h5>
                <span class="badge bg-secondary status-badge">Đang tắt</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card device-card h-100 p-3 disabled" id="card-light">
            <div class="d-flex justify-content-between align-items-start">
                <div class="device-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input device-switch" type="checkbox" id="switch-light" data-target="card-light">
                </div>
            </div>
            <div class="mt-3">
                <h5 class="fw-bold">Đèn sưởi/Sáng</h5>
                <span class="badge bg-secondary status-badge">Đang tắt</span>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const masterSwitch = document.getElementById('masterModeSwitch');
        const modeLabel = document.getElementById('modeLabel');
        const modeText = document.getElementById('modeStatusText');
        const deviceCards = document.querySelectorAll('.device-card');
        const deviceSwitches = document.querySelectorAll('.device-switch');

        // 1. Xử lý khi gạt nút Chuyển chế độ (Auto/Manual)
        masterSwitch.addEventListener('change', function() {
            if(this.checked) {
                // Chuyển sang THỦ CÔNG (MANUAL)
                modeLabel.textContent = "THỦ CÔNG";
                modeLabel.classList.add('text-primary');
                modeText.textContent = "Bạn có toàn quyền điều khiển thiết bị";
                
                // Mở khóa các thẻ thiết bị
                deviceCards.forEach(card => card.classList.remove('disabled'));
            } else {
                // Chuyển sang TỰ ĐỘNG (AUTO)
                modeLabel.textContent = "TỰ ĐỘNG";
                modeLabel.classList.remove('text-primary');
                modeText.textContent = "Hệ thống đang chạy tự động theo cảm biến";
                
                // Khóa các thẻ thiết bị lại
                deviceCards.forEach(card => card.classList.add('disabled'));
            }
        });

        // 2. Xử lý khi bật/tắt từng thiết bị
        deviceSwitches.forEach(sw => {
            sw.addEventListener('change', function() {
                const cardId = this.getAttribute('data-target');
                const card = document.getElementById(cardId);
                const badge = card.querySelector('.status-badge');
                
                if(this.checked) {
                    // Trạng thái BẬT
                    card.classList.add('active');
                    badge.textContent = "Đang chạy";
                    badge.className = "badge bg-success status-badge";
                } else {
                    // Trạng thái TẮT
                    card.classList.remove('active');
                    badge.textContent = "Đang tắt";
                    badge.className = "badge bg-secondary status-badge";
                }
            });
        });
    });
</script>