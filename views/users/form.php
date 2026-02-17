<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-dark">Thêm nhân sự mới</h4>
            <p class="text-muted small mb-0 fw-bold">Tạo tài khoản truy cập cho nhân viên vận hành</p>
        </div>
        <a href="index.php?page=users" class="btn btn-white border shadow-sm fw-bold text-secondary">
            <i class="fas fa-chevron-left me-2"></i> Quay lại
        </a>
    </div>

    <form action="" method="POST">
        
        <div class="row g-4">
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-primary-subtle text-primary rounded-circle p-2 me-2">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Thông tin cá nhân</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-xl-row gap-4 align-items-start">
                            
                            <div class="text-center mx-auto mx-xl-0">
                                <div class="position-relative d-inline-block">
                                    <div class="avatar-placeholder rounded-circle bg-light border-2 border-dashed d-flex align-items-center justify-content-center text-secondary" style="width: 110px; height: 110px; border-color: #dee2e6;">
                                        <i class="fas fa-camera fs-3"></i>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary rounded-circle position-absolute bottom-0 end-0 shadow-sm border-2 border-white" style="width: 32px; height: 32px;">
                                        <i class="fas fa-pen small"></i>
                                    </button>
                                </div>
                                <div class="mt-2 small text-muted fw-bold">Ảnh đại diện</div>
                            </div>

                            <div class="flex-grow-1 w-100">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control fw-bold" placeholder="VD: Nguyễn Văn A" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Số điện thoại</label>
                                    <input type="text" class="form-control fw-bold font-monospace" placeholder="09xxxxxxx">
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small fw-bold text-muted">Địa chỉ liên hệ</label>
                                    <textarea class="form-control fw-bold" rows="2" placeholder="VD: 123 Đường ABC..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-success-subtle text-success rounded-circle p-2 me-2">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Tài khoản & Phân quyền</h6>
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email đăng nhập <span class="text-danger">*</span></label>
                                <input type="email" class="form-control fw-bold" placeholder="email@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Mật khẩu khởi tạo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control fw-bold font-monospace" value="12345678">
                                    <button class="btn btn-light border" type="button"><i class="fas fa-eye text-muted"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nhóm quyền (Role)</label>
                                <select class="form-select fw-bold border-2 text-dark" name="role_id" required>
                                    <option value="" disabled selected>-- Chọn nhóm --</option>
                                    <option value="1">👑 Ban quản trị (Admin)</option>
                                    <option value="2">🔧 Vận hành viên (Staff)</option>
                                    <option value="3">👀 Người xem (Viewer)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase">Trạng thái</label>
                                <div class="card bg-light border-0 px-3 py-2 rounded-3 d-flex flex-row align-items-center justify-content-between" style="height: 48px;">
                                    <span class="fw-bold text-dark small">Kích hoạt ngay</span>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input scale-125" type="checkbox" id="statusSwitch" checked style="cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3 small text-muted">
                            <i class="fas fa-info-circle me-1 text-primary"></i> Nhóm quyền sẽ quyết định các menu được hiển thị.
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pb-5 border-top pt-4">
            <button type="reset" class="btn btn-white border fw-bold px-4 py-2 text-secondary">
                <i class="fas fa-undo me-2"></i> Làm mới
            </button>
            <button type="submit" class="btn btn-primary fw-bold px-5 py-2 shadow border-2 border-primary">
                <i class="fas fa-save me-2"></i> Lưu & Tạo mới
            </button>
        </div>

    </form>
</div>

<style>
    /* Style đồng bộ */
    .form-control, .form-select, .input-group-text, .btn {
        border-color: #dee2e6;
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    /* Switch toggle */
    .scale-125 { transform: scale(1.25); }

    /* Background icon */
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; color: #0d6efd !important; }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; color: #198754 !important; }
</style>