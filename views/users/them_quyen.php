<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-dark">Thêm quyền hạn (Permission)</h4>
            <p class="text-muted small mb-0 fw-bold">Định nghĩa các chức năng hệ thống được phép truy cập</p>
        </div>
        <a href="index.php?page=users&tab=permissions" class="btn btn-white border shadow-sm fw-bold text-secondary">
            <i class="fas fa-chevron-left me-2"></i> Quay lại
        </a>
    </div>

    <form action="index.php?page=quyen_xulythem" method="POST">
        <div class="row g-4">
            
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-danger-subtle text-danger rounded-circle p-2 me-2">
                            <i class="fas fa-key"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Thông tin quyền hạn</h6>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Mã quyền (Permission Key) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-2 fw-bold text-secondary"><i class="fas fa-code"></i></span>
                                <input type="text" class="form-control fw-bold form-control-lg font-monospace text-danger" name="permission_key" placeholder="module.action" required>
                            </div>
                            <div class="form-text small fw-bold text-secondary mt-2">
                                <i class="fas fa-info-circle me-1"></i> Key dùng để check trong code: <code>if ($user->can('device.create'))</code>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-7">
                                <label class="form-label small fw-bold text-muted">Tên hiển thị (Display Name) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control fw-bold" name="permission_name" placeholder="VD: Thêm thiết bị mới" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-muted">Thuộc Module</label>
                                <select class="form-select fw-bold border-2" name="module_key">
                                    <option value="system">⚙️ Hệ thống (System)</option>
                                    <option value="user">👤 Người dùng (User)</option>
                                    <option value="device" selected>📡 Thiết bị (Device)</option>
                                    <option value="report">📊 Báo cáo (Report)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Mô tả chi tiết</label>
                            <textarea class="form-control fw-bold" name="description" rows="3" placeholder="Mô tả chức năng này làm gì..."></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                    <div class="card-header bg-transparent py-3 border-bottom d-flex align-items-center">
                        <div class="bg-primary-subtle text-primary rounded-circle p-2 me-2">
                            <i class="fas fa-book"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Quy tắc đặt tên (Naming Convention)</h6>
                    </div>
                    
                    <div class="card-body p-4">
                        <p class="small fw-bold text-secondary mb-3">Để hệ thống đồng bộ, vui lòng đặt <strong>Mã quyền</strong> theo cấu trúc:</p>
                        
                        <div class="alert bg-white border-2 border-secondary border-dashed text-center mb-4">
                            <h4 class="fw-bold text-dark mb-0 font-monospace">resource.action</h4>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success-subtle text-success border border-success-subtle me-2 mt-1">Đúng</span>
                                <div>
                                    <div class="fw-bold text-dark font-monospace">device.create</div>
                                    <div class="small text-muted">Rõ ràng: Tài nguyên + Hành động</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success-subtle text-success border border-success-subtle me-2 mt-1">Đúng</span>
                                <div>
                                    <div class="fw-bold text-dark font-monospace">report.export_excel</div>
                                    <div class="small text-muted">Hành động cụ thể</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle me-2 mt-1">Sai</span>
                                <div>
                                    <div class="fw-bold text-dark font-monospace">ThemNguoiDungMoi</div>
                                    <div class="small text-muted">Không dùng Tiếng Việt, CamelCase</div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-25 my-4">

                        <div class="small fw-bold text-secondary">
                            <i class="fas fa-exclamation-triangle text-warning me-1"></i> Lưu ý:
                            <ul class="mt-2 mb-0 ps-3">
                                <li>Mã quyền là duy nhất (Unique).</li>
                                <li>Chỉ Developer hoặc Admin hiểu rõ hệ thống mới nên thêm quyền này.</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
            <button type="reset" class="btn btn-white border fw-bold px-4 py-2 text-secondary">
                <i class="fas fa-undo me-2"></i> Làm mới
            </button>
            <button type="submit" class="btn btn-danger fw-bold px-5 py-2 shadow border-2 border-danger">
                <i class="fas fa-save me-2"></i> Lưu quyền mới
            </button>
        </div>

    </form>
</div>

<style>
    /* Custom Style cho trang Permission (Màu Đỏ chủ đạo) */
    
    /* Input Styling */
    .form-control, .form-select, .input-group-text, .btn {
        border-color: #dee2e6;
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
    }
    
    /* Focus state màu đỏ */
    .form-control:focus, .form-select:focus {
        border-color: #dc3545; /* Bootstrap Danger Color */
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
    }

    /* Icon backgrounds */
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; color: #dc3545 !important; }
    
    /* Dashed border */
    .border-dashed { border-style: dashed !important; }
</style>