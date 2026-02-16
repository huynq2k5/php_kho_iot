<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">Cấu hình Node: <span class="text-primary">Node_Sensor_01</span></h4>
        <a href="index.php?page=thietbi" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-chevron-left me-1"></i> Quay lại
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-network-wired me-2"></i>Thông số kết nối</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">MQTT Broker (Host)</label>
                                <input type="text" class="form-control" value="broker.hivemq.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Cổng (Port)</label>
                                <input type="number" class="form-control" value="1883">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Topic MQTT (Publish/Subscribe)</label>
                            <input type="text" class="form-control" value="vlu/kho_iot/sensor01">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Tần suất gửi dữ liệu (Giây)</label>
                            <div class="input-group w-50">
                                <input type="number" class="form-control" value="30">
                                <span class="input-group-text">giây/lần</span>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary px-4">Lưu cấu hình</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold text-secondary"><i class="fas fa-microchip me-2"></i>Thông tin phần cứng</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Phiên bản Firmware</span>
                            <span class="badge bg-light text-dark border">v2.1.0-stable</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Bộ nhớ Flash trống</span>
                            <span class="fw-bold">1.2 MB</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Uptime (Thời gian chạy)</span>
                            <span class="fw-bold">05 ngày 12 giờ</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-soft-danger border-start border-4 border-danger">
                <div class="card-body">
                    <h6 class="fw-bold text-danger mb-2">Vùng nguy hiểm</h6>
                    <p class="small text-muted mb-3">Thao tác này sẽ khởi động lại Node hoặc xóa trắng dữ liệu cấu hình trên ESP32.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-redo me-2"></i>Khởi động lại Node</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-broom me-2"></i>Reset Factory</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>