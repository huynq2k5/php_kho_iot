<div class="container-fluid py-4">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-dark">Thêm thiết bị mới</h4>
            <p class="text-muted small mb-0 fw-bold">Đăng ký Node ESP32 hoặc cảm biến vào hệ thống</p>
        </div>
        <a href="index.php?page=thietbi" class="btn btn-white border shadow-sm fw-bold">
            <i class="fas fa-chevron-left me-2"></i> Quay lại
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="mb-0 fw-bold text-primary">
                <i class="fas fa-layer-group me-2"></i>Thông tin cấu hình
            </h6>
        </div>
        
        <div class="card-body p-4">
            <form action="index.php?page=thietbi_xulythem" method="POST">
                
                <div class="row g-5">
                    
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase small">1. Thông tin định danh</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Tên thiết bị (Node ID) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control fw-bold" name="device_name" placeholder="VD: Node_Sensor_01" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Vị trí lắp đặt</label>
                                    <input type="text" class="form-control fw-bold" name="location" placeholder="VD: Kho Lạnh A">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-dark">Mô tả</label>
                                    <textarea class="form-control fw-bold" name="description" rows="2" placeholder="Ghi chú về thiết bị..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase small">2. Cấu hình MQTT</label>
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-dark">MQTT Topic Gốc <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border fw-bold text-primary">vlu/kho_iot/</span>
                                                <input type="text" class="form-control fw-bold text-primary font-monospace" name="mqtt_topic" placeholder="device_id" required>
                                            </div>
                                            <div class="form-text small"><i class="fas fa-info-circle me-1"></i> Topic này dùng để gửi/nhận lệnh điều khiển.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-dark">IP Address (Optional)</label>
                                            <input type="text" class="form-control fw-bold font-monospace" name="ip_address" placeholder="192.168.1.xxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-dark">Port</label>
                                            <input type="number" class="form-control fw-bold font-monospace" value="1883" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase small">3. Loại thiết bị</label>
                            
                            <div class="mb-2">
                                <input type="radio" class="btn-check" name="device_type" id="type_sensor" value="sensor" checked>
                                <label class="custom-radio-card d-flex align-items-center p-3 border rounded-3 cursor-pointer w-100" for="type_sensor">
                                    <div class="icon-box bg-primary-subtle text-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fas fa-temperature-high fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold text-dark">Cảm biến (Sensor)</h6>
                                        <small class="text-muted">Thu thập dữ liệu môi trường</small>
                                    </div>
                                    <div class="check-mark text-primary"><i class="fas fa-check-circle fs-4"></i></div>
                                </label>
                            </div>

                            <div class="mb-2">
                                <input type="radio" class="btn-check" name="device_type" id="type_control" value="control">
                                <label class="custom-radio-card d-flex align-items-center p-3 border rounded-3 cursor-pointer w-100" for="type_control">
                                    <div class="icon-box bg-success-subtle text-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fas fa-toggle-on fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold text-dark">Điều khiển (Control)</h6>
                                        <small class="text-muted">Relay, Quạt, Đèn, Bơm...</small>
                                    </div>
                                    <div class="check-mark text-success"><i class="fas fa-check-circle fs-4"></i></div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase small">4. Model Chipset</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="chipset" id="chip_esp32" value="esp32" checked>
                                    <label class="custom-radio-card text-center p-3 border rounded-3 cursor-pointer w-100 h-100" for="chip_esp32">
                                        <i class="fas fa-microchip fs-2 text-secondary mb-2"></i>
                                        <div class="fw-bold text-dark">ESP32</div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="chipset" id="chip_esp8266" value="esp8266">
                                    <label class="custom-radio-card text-center p-3 border rounded-3 cursor-pointer w-100 h-100" for="chip_esp8266">
                                        <i class="fas fa-microchip fs-2 text-secondary mb-2"></i>
                                        <div class="fw-bold text-dark">ESP8266</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> Lưu & Thêm thiết bị
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS Tùy chỉnh để tạo hiệu ứng Radio Button đẹp như Tailwind */
    
    /* 1. Mặc định ẩn dấu check */
    .custom-radio-card .check-mark {
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s ease;
    }

    /* 2. Trạng thái hover */
    .custom-radio-card:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd !important;
    }

    /* 3. Khi Radio được chọn (Checked) */
    .btn-check:checked + .custom-radio-card {
        background-color: #fff;
        border-color: var(--bs-primary) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-width: 2px !important; /* Viền đậm hơn khi chọn */
    }

    /* Hiệu ứng riêng cho loại Control (Màu xanh lá) */
    #type_control:checked + .custom-radio-card {
        border-color: var(--bs-success) !important;
    }

    /* Hiển thị dấu check khi chọn */
    .btn-check:checked + .custom-radio-card .check-mark {
        opacity: 1;
        transform: scale(1);
    }

    /* Đổi màu icon khi chọn */
    .btn-check:checked + .custom-radio-card .icon-chip {
        color: var(--bs-primary) !important;
    }

    /* Ép viền đậm cho Input trên Linux */
    .form-control, .input-group-text {
        border: 1px solid #ced4da;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>