<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold text-dark">Tạo nhóm vai trò mới</h4>
            <p class="text-muted small mb-0 fw-bold">Thiết lập nhóm người dùng và định danh vai trò</p>
        </div>
        <a href="index.php?page=users&tab=groups" class="btn btn-white border shadow-sm fw-bold text-secondary">
            <i class="fas fa-chevron-left me-2"></i> Quay lại
        </a>
    </div>

    <form action="index.php?page=nhom_xulythem" method="POST">
        
        <div class="row g-4">
            
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-success-subtle text-success rounded-circle p-2 me-2">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Thông tin chung</h6>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Tên nhóm vai trò <span class="text-danger">*</span></label>
                            <input type="text" class="form-control fw-bold form-control-lg" id="groupNameInput" name="group_name" placeholder="VD: Kế toán kho" required oninput="updatePreview()">
                            <div class="form-text small fw-bold text-success mt-2">
                                <i class="fas fa-check-circle me-1"></i> Tên nhóm là duy nhất trong hệ thống.
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Mô tả chức năng</label>
                            <textarea class="form-control fw-bold" name="description" rows="5" placeholder="Mô tả chi tiết về quyền hạn và trách nhiệm của nhóm này..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-warning-subtle text-warning rounded-circle p-2 me-2">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h6 class="mb-0 fw-bold text-dark">Giao diện & Hiển thị</h6>
                    </div>
                    
                    <div class="card-body p-4">
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted mb-3">Màu sắc nhận diện (Badge Color)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_primary" value="primary" checked onchange="updatePreview()">
                                    <label class="btn btn-outline-primary border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_primary">
                                        <i class="fas fa-circle text-primary small"></i> Xanh dương
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_success" value="success" onchange="updatePreview()">
                                    <label class="btn btn-outline-success border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_success">
                                        <i class="fas fa-circle text-success small"></i> Xanh lá
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_warning" value="warning" onchange="updatePreview()">
                                    <label class="btn btn-outline-warning border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_warning">
                                        <i class="fas fa-circle text-warning small"></i> Cam
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_danger" value="danger" onchange="updatePreview()">
                                    <label class="btn btn-outline-danger border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_danger">
                                        <i class="fas fa-circle text-danger small"></i> Đỏ
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_info" value="info" onchange="updatePreview()">
                                    <label class="btn btn-outline-info border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_info">
                                        <i class="fas fa-circle text-info small"></i> Xanh nhạt
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="badge_color" id="color_dark" value="dark" onchange="updatePreview()">
                                    <label class="btn btn-outline-dark border-2 fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2" for="color_dark">
                                        <i class="fas fa-circle text-dark small"></i> Đen
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light rounded-3 border border-dashed p-4 text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 120px;">
                            <p class="small text-muted fw-bold mb-3 text-uppercase">Xem trước hiển thị</p>
                            
                            <span id="badgePreview" class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-bold fs-6 shadow-sm transition-all">
                                <i class="fas fa-users me-1"></i> <span id="previewText">Tên nhóm...</span>
                            </span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end gap-3 mt-4 pt-4 border-top">
            <button type="reset" class="btn btn-white border fw-bold px-4 py-2 text-secondary" onclick="setTimeout(updatePreview, 10)">
                <i class="fas fa-undo me-2"></i> Làm mới
            </button>
            <button type="submit" class="btn btn-success fw-bold px-5 py-2 shadow border-2 border-success">
                <i class="fas fa-save me-2"></i> Lưu & Tạo nhóm
            </button>
        </div>

    </form>
</div>

<script>
    function updatePreview() {
        const nameInput = document.getElementById('groupNameInput').value;
        const previewText = document.getElementById('previewText');
        const badge = document.getElementById('badgePreview');
        
        // Update text
        previewText.textContent = nameInput ? nameInput : "Tên nhóm...";

        // Define colors
        const colors = ['primary', 'success', 'warning', 'danger', 'info', 'dark'];
        const selectedColor = document.querySelector('input[name="badge_color"]:checked').value;

        // Reset classes
        colors.forEach(c => {
            badge.classList.remove(`bg-${c}-subtle`, `text-${c}`, `border-${c}-subtle`);
        });

        // Add new classes
        badge.classList.add(`bg-${selectedColor}-subtle`, `text-${selectedColor}`, `border-${selectedColor}-subtle`);
    }
</script>

<style>
    /* Input Styling */
    .form-control, .btn {
        border-color: #dee2e6;
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
    }
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
    }

    /* Radio Button Grid Styling */
    .btn-check:checked + .btn-outline-primary { background: rgba(13, 110, 253, 0.1); color: #0d6efd; border-color: #0d6efd; }
    .btn-check:checked + .btn-outline-success { background: rgba(25, 135, 84, 0.1); color: #198754; border-color: #198754; }
    .btn-check:checked + .btn-outline-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; border-color: #ffc107; }
    .btn-check:checked + .btn-outline-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; border-color: #dc3545; }
    .btn-check:checked + .btn-outline-info { background: rgba(13, 202, 240, 0.1); color: #0dcaf0; border-color: #0dcaf0; }
    .btn-check:checked + .btn-outline-dark { background: rgba(33, 37, 41, 0.1); color: #212529; border-color: #212529; }

    /* Icons */
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; color: #198754 !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; color: #ffc107 !important; }

    /* Preview Box */
    .border-dashed { border: 2px dashed #e9ecef !important; }
    .transition-all { transition: all 0.3s ease; }
</style>