<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm">
        <div class="d-flex align-items-center">
            <div class="form-check form-switch me-3">
                <input class="form-check-input" type="checkbox" id="masterAutoSwitch" style="width: 3em; height: 1.5em;" checked>
            </div>
            <div>
                <h5 class="mb-0 fw-bold">Chế độ Tự động hóa</h5>
                <small class="text-muted">Gạt tắt để vô hiệu hóa toàn bộ hệ thống tự động</small>
            </div>
        </div>
        <a href="index.php?page=tudong-them" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i> Thêm mới
        </a>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-danger">
                        <i class="fas fa-temperature-high me-2"></i>Điều khiển theo Cảm biến
                    </h6>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">3 Luật đang chạy</span>
                </div>
                
                <div class="list-group list-group-flush">
                    
                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark">Tự động làm mát kho</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="bg-light p-2 rounded d-flex align-items-center justify-content-between">
                            <span class="small text-muted">NẾU Nhiệt độ <span class="fw-bold text-danger">> 30°C</span></span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                            <span class="small fw-bold text-success"><i class="fas fa-fan me-1"></i> BẬT Quạt</span>
                        </div>
                        <div class="d-flex justify-content-end mt-2 gap-2">
                            <a href="index.php?page=tudong-sua" class="text-secondary small"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="text-danger small ms-2"><i class="fas fa-trash"></i> Xóa</a>
                        </div>
                    </div>

                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark">Cấp ẩm tự động</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        <div class="bg-light p-2 rounded d-flex align-items-center justify-content-between">
                            <span class="small text-muted">NẾU Độ ẩm <span class="fw-bold text-primary">< 60%</span></span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                            <span class="small fw-bold text-primary"><i class="fas fa-spray-can me-1"></i> BẬT Phun sương</span>
                        </div>
                        <div class="d-flex justify-content-end mt-2 gap-2">
                            <a href="#" class="text-secondary small"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="text-danger small ms-2"><i class="fas fa-trash"></i> Xóa</a>
                        </div>
                    </div>

                    <div class="list-group-item p-3 opacity-75">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-muted text-decoration-line-through">Cảnh báo CO2 cao</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                        <div class="bg-light p-2 rounded d-flex align-items-center justify-content-between">
                            <span class="small text-muted">NẾU CO2 <span class="fw-bold text-secondary">> 1000 ppm</span></span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                            <span class="small fw-bold text-danger"><i class="fas fa-bell me-1"></i> Cảnh báo</span>
                        </div>
                         <div class="d-flex justify-content-end mt-2 gap-2">
                            <a href="#" class="text-secondary small"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="text-danger small ms-2"><i class="fas fa-trash"></i> Xóa</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-warning">
                        <i class="fas fa-clock me-2"></i>Lịch trình Hẹn giờ
                    </h6>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">2 Lịch đang chạy</span>
                </div>

                <div class="list-group list-group-flush">
                    
                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark">Bật đèn kho tối</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-clock text-warning me-2"></i>
                            <span class="fw-bold fs-5 me-3">18:00 - 06:00</span>
                            <span class="badge bg-light text-dark border">Hàng ngày</span>
                        </div>

                        <div class="bg-light p-2 rounded">
                            <span class="small fw-bold text-warning-emphasis"><i class="fas fa-lightbulb me-1"></i> BẬT Đèn sưởi</span>
                        </div>

                        <div class="d-flex justify-content-end mt-2 gap-2">
                            <a href="#" class="text-secondary small"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="text-danger small ms-2"><i class="fas fa-trash"></i> Xóa</a>
                        </div>
                    </div>

                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark">Tưới nước buổi sáng</strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-2">
                            <i class="far fa-clock text-primary me-2"></i>
                            <span class="fw-bold fs-5 me-3">07:00 - 07:15</span>
                            <div>
                                <span class="badge bg-light text-secondary border">T3</span>
                                <span class="badge bg-light text-secondary border">T5</span>
                                <span class="badge bg-light text-secondary border">T7</span>
                            </div>
                        </div>

                        <div class="bg-light p-2 rounded">
                            <span class="small fw-bold text-primary"><i class="fas fa-water me-1"></i> BẬT Máy bơm</span>
                        </div>

                        <div class="d-flex justify-content-end mt-2 gap-2">
                            <a href="#" class="text-secondary small"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="text-danger small ms-2"><i class="fas fa-trash"></i> Xóa</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>