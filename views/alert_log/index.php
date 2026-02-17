<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-secondary fw-bold">Cảnh báo & Nhật ký hệ thống</h4>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-danger btn-sm">
                <i class="fas fa-trash-alt me-1"></i> Xóa lịch sử cũ
            </button>
            <button class="btn btn-outline-primary btn-sm">
                <i class="fas fa-file-export me-1"></i> Xuất báo cáo
            </button>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Cảnh báo môi trường
                    </h6>
                    <span class="badge rounded-pill bg-danger">2 Mới</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        
                        <div class="list-group-item list-group-item-action border-0 border-start border-4 border-danger p-3 mb-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1">Nhiệt độ quá cao!</h6>
                                    <p class="mb-1 small text-muted">Giá trị đo được: <span class="text-danger fw-bold">35.5°C</span> (Ngưỡng: 30°C)</p>
                                    <small class="text-secondary"><i class="far fa-clock me-1"></i>2 phút trước</small>
                                </div>
                                <span class="badge bg-danger">Khẩn cấp</span>
                            </div>
                        </div>

                        <div class="list-group-item list-group-item-action border-0 border-start border-4 border-warning p-3 mb-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1">Độ ẩm quá thấp</h6>
                                    <p class="mb-1 small text-muted">Giá trị đo được: <span class="text-warning fw-bold">45%</span> (Ngưỡng: 55%)</p>
                                    <small class="text-secondary"><i class="far fa-clock me-1"></i>15 phút trước</small>
                                </div>
                                <span class="badge bg-warning text-dark">Cảnh báo</span>
                            </div>
                        </div>

                        <div class="list-group-item list-group-item-action border-0 border-start border-4 border-success p-3 opacity-75">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1 text-success">CO2 đã ổn định</h6>
                                    <p class="mb-1 small text-muted">Giá trị hiện tại: 420 ppm</p>
                                    <small class="text-secondary"><i class="far fa-clock me-1"></i>1 giờ trước</small>
                                </div>
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-white text-center py-2">
                    <a href="#" class="small text-decoration-none">Xem tất cả cảnh báo</a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-history me-2"></i>Nhật ký vận hành (Audit Log)
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="small text-muted text-uppercase">
                                    <th class="ps-3">Thời gian</th>
                                    <th>Người dùng</th>
                                    <th>Hành động</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <tr>
                                    <td class="ps-3 text-secondary">21:45:10</td>
                                    <td><span class="fw-bold">Admin (Huy)</span></td>
                                    <td><span class="badge bg-primary-subtle text-primary">Điều khiển</span></td>
                                    <td>Bật <strong class="text-dark">Quạt thông gió</strong> thủ công</td>
                                </tr>
                                <tr>
                                    <td class="ps-3 text-secondary">21:30:05</td>
                                    <td><span class="fw-bold">Huy Nguyen</span></td>
                                    <td><span class="badge bg-warning-subtle text-warning-emphasis">Cấu hình</span></td>
                                    <td>Sửa ngưỡng nhiệt độ: <del>30</del> &rarr; <strong>32.5</strong></td>
                                </tr>
                                <tr>
                                    <td class="ps-3 text-secondary">21:00:00</td>
                                    <td><span class="fw-bold text-success">Hệ thống</span></td>
                                    <td><span class="badge bg-info-subtle text-info">Tự động</span></td>
                                    <td>Kích hoạt kịch bản: <strong class="text-dark">Tưới nước sáng</strong></td>
                                </tr>
                                <tr>
                                    <td class="ps-3 text-secondary">20:45:22</td>
                                    <td><span class="fw-bold">Admin (Huy)</span></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary">Đăng nhập</span></td>
                                    <td>Truy cập từ IP: 192.168.1.15</td>
                                </tr>
                                <tr>
                                    <td class="ps-3 text-secondary">19:20:11</td>
                                    <td><span class="fw-bold">Nhan vien A</span></td>
                                    <td><span class="badge bg-primary-subtle text-primary">Điều khiển</span></td>
                                    <td>Tắt <strong class="text-dark">Đèn sưởi</strong> thủ công</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                    <small class="text-muted">Hiển thị 5 / 100 dòng mới nhất</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>