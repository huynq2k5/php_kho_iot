<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 fw-bold">Thêm kịch bản tự động mới</h4>
        <a href="index.php?page=tudong" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Quay lại</a>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="" method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">1. Tên kịch bản</label>
                            <input type="text" class="form-control" placeholder="Ví dụ: Tự động bật quạt khi nóng">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">2. Loại điều kiện kích hoạt</label>
                            <div class="d-flex gap-3">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="triggerType" id="typeSensor" value="sensor" checked onchange="toggleForm('sensor')">
                                    <label class="form-check-label" for="typeSensor">
                                        <i class="fas fa-temperature-high text-danger me-2"></i> Theo cảm biến
                                    </label>
                                </div>
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="triggerType" id="typeTimer" value="timer" onchange="toggleForm('timer')">
                                    <label class="form-check-label" for="typeTimer">
                                        <i class="fas fa-clock text-warning me-2"></i> Theo thời gian
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold text-muted mb-3">THIẾT LẬP ĐIỀU KIỆN (NẾU...)</h6>
                                
                                <div id="sensorForm" class="row g-3">
                                    <div class="col-md-4">
                                        <label class="small text-muted">Chọn cảm biến</label>
                                        <select class="form-select">
                                            <option value="temp">Nhiệt độ</option>
                                            <option value="hum">Độ ẩm</option>
                                            <option value="co2">CO2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">So sánh</label>
                                        <select class="form-select">
                                            <option value=">">Lớn hơn (>)</option>
                                            <option value="<">Nhỏ hơn (<)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="small text-muted">Giá trị ngưỡng</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="30">
                                            <span class="input-group-text">đơn vị</span>
                                        </div>
                                    </div>
                                </div>

                                <div id="timerForm" class="row g-3 d-none">
                                    <div class="col-md-6">
                                        <label class="small text-muted">Giờ Bắt đầu (Bật)</label>
                                        <input type="time" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small text-muted">Giờ Kết thúc (Tắt)</label>
                                        <input type="time" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="small text-muted mb-2">Lặp lại vào các thứ:</label>
                                        <div class="btn-group w-100" role="group">
                                            <input type="checkbox" class="btn-check" id="t2"><label class="btn btn-outline-secondary btn-sm" for="t2">T2</label>
                                            <input type="checkbox" class="btn-check" id="t3"><label class="btn btn-outline-secondary btn-sm" for="t3">T3</label>
                                            <input type="checkbox" class="btn-check" id="t4"><label class="btn btn-outline-secondary btn-sm" for="t4">T4</label>
                                            <input type="checkbox" class="btn-check" id="t5"><label class="btn btn-outline-secondary btn-sm" for="t5">T5</label>
                                            <input type="checkbox" class="btn-check" id="t6"><label class="btn btn-outline-secondary btn-sm" for="t6">T6</label>
                                            <input type="checkbox" class="btn-check" id="t7"><label class="btn btn-outline-secondary btn-sm" for="t7">T7</label>
                                            <input type="checkbox" class="btn-check" id="cn"><label class="btn btn-outline-secondary btn-sm" for="cn">CN</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-white border border-success mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3">HÀNH ĐỘNG THỰC THI (THÌ...)</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="small text-muted">Chọn thiết bị</label>
                                        <select class="form-select">
                                            <option value="fan">Quạt thông gió</option>
                                            <option value="pump">Máy phun sương</option>
                                            <option value="light">Đèn</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small text-muted">Hành động</label>
                                        <select class="form-select fw-bold text-primary">
                                            <option value="ON">BẬT (ON)</option>
                                            <option value="OFF">TẮT (OFF)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php?page=tudong" class="btn btn-light">Hủy bỏ</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Lưu Kịch Bản</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm JS đơn giản để chuyển đổi form
    function toggleForm(type) {
        if(type === 'sensor') {
            document.getElementById('sensorForm').classList.remove('d-none');
            document.getElementById('timerForm').classList.add('d-none');
        } else {
            document.getElementById('sensorForm').classList.add('d-none');
            document.getElementById('timerForm').classList.remove('d-none');
        }
    }
</script>