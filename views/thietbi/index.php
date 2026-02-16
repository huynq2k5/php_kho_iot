<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="text-secondary fw-bold">Hạ tầng thiết bị</h4>
            <p class="text-muted small mb-0">Giám sát Node ESP32 và các trạm cảm biến</p>
        </div>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Thêm Node</button>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr class="small text-muted text-uppercase">
                            <th class="ps-3 text-start">Tên thiết bị</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ IP</th>
                            <th>Tín hiệu Wifi</th>
                            <th>Năng lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3 text-start">
                                <div class="fw-bold">Node_Sensor_01</div>
                                <div class="small text-muted">ESP32 DevKit</div>
                            </td>
                            <td><span class="badge rounded-pill bg-success">Online</span></td>
                            <td><code>192.168.1.50</code></td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-wifi text-success me-2"></i>
                                    <div class="progress w-50" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                    <span class="ms-2 small">-55dBm</span>
                                </div>
                            </td>
                            <td><i class="fas fa-battery-full text-success me-1"></i>90%</td>
                            <td>
                                <a href="index.php?page=thietbi_config&id=1" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-tools"></i> Cấu hình
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>