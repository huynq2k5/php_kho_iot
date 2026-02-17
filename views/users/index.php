<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-secondary">Hệ thống & Phân quyền</h4>
            <p class="text-muted small fw-bold mb-0">Quản lý Nhân sự, Nhóm vai trò và Định nghĩa quyền hạn</p>
        </div>
        <div id="dynamicActionButton">
            <a href="index.php?page=nguoidung_them" class="btn btn-primary fw-bold shadow-sm">
                <i class="fas fa-user-plus me-2"></i> Thêm nhân sự
            </a>
        </div>
    </div>

    <ul class="nav nav-tabs nav-fill mb-4 border-bottom-0" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold py-3 border-bottom-2 border-transparent" id="users-tab" data-bs-toggle="tab" data-bs-target="#tab-users" type="button" role="tab">
                <i class="fas fa-users me-2"></i> Danh sách nhân sự
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold py-3 border-bottom-2 border-transparent text-success" id="groups-tab" data-bs-toggle="tab" data-bs-target="#tab-groups" type="button" role="tab">
                <i class="fas fa-layer-group me-2"></i> Nhóm vai trò
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold py-3 border-bottom-2 border-transparent text-danger" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#tab-permissions" type="button" role="tab">
                <i class="fas fa-key me-2"></i> Định nghĩa Quyền (SQL)
            </button>
        </li>
    </ul>

    <div class="tab-content" id="userTabsContent">
        
        <div class="tab-pane fade show active" id="tab-users" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group w-auto">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0 fw-bold" placeholder="Tìm tên, email...">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm fw-bold border-2 text-secondary w-auto">
                            <option value="">Tất cả vai trò</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                        <button class="btn btn-white border fw-bold text-secondary btn-sm px-3">
                            <i class="fas fa-filter me-1"></i> Lọc
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 fw-bold text-secondary text-uppercase small" style="width: 35%;">Nhân sự</th>
                                <th class="py-3 fw-bold text-secondary text-uppercase small">Vai trò</th>
                                <th class="py-3 fw-bold text-secondary text-uppercase small">Trạng thái</th>
                                <th class="py-3 fw-bold text-secondary text-uppercase small">Ngày tạo</th>
                                <th class="pe-4 py-3 fw-bold text-secondary text-uppercase small text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 40px; height: 40px;">
                                            A
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">Nguyễn Văn A</div>
                                            <div class="small text-muted fw-bold">admin@khoiot.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded fw-bold">
                                        <i class="fas fa-crown me-1"></i> Administrator
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                    </div>
                                </td>
                                <td class="fw-bold text-secondary small">15/01/2026</td>
                                <td class="pe-4 text-end">
                                    <a href="index.php?page=nguoidung_sua&id=1" class="btn btn-sm btn-light text-primary me-1" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light text-danger" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-groups" role="tabpanel">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="mb-0 fw-bold text-success"><i class="fas fa-users-cog me-2"></i>Các nhóm quyền hiện có</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 fw-bold text-secondary text-uppercase small">Tên nhóm</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase small">Mô tả</th>
                                        <th class="py-3 fw-bold text-secondary text-uppercase small">Thành viên</th>
                                        <th class="pe-4 py-3 fw-bold text-secondary text-uppercase small text-end">Cấu hình</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4 fw-bold">Ban quản trị (Admin)</td>
                                        <td class="text-muted small fw-bold">Full Access</td>
                                        <td><span class="badge bg-light text-dark border fw-bold">3 Users</span></td>
                                        <td class="pe-4 text-end">
                                            <a href="index.php?page=nhom_sua&id=1" class="btn btn-sm btn-outline-dark fw-bold"><i class="fas fa-sliders-h"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-permissions" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-danger"><i class="fas fa-database me-2"></i>Danh sách Permission Keys</h6>
                    <div class="d-flex gap-2">
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">System Level</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 fw-bold text-secondary text-uppercase small">Mã quyền (Key)</th>
                                <th class="py-3 fw-bold text-secondary text-uppercase small">Tên hiển thị</th>
                                <th class="py-3 fw-bold text-secondary text-uppercase small">Module</th>
                                <th class="pe-4 py-3 fw-bold text-secondary text-uppercase small text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4"><code class="fw-bold text-primary bg-light px-2 py-1 rounded border">device.view</code></td>
                                <td class="fw-bold text-dark">Xem danh sách thiết bị</td>
                                <td><span class="badge bg-info text-white fw-bold">Thiết bị</span></td>
                                <td class="pe-4 text-end">
                                    <a href="index.php?page=quyen_sua&id=1" class="btn btn-sm btn-light text-primary"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const usersTab = document.getElementById('users-tab');
        const groupsTab = document.getElementById('groups-tab');
        const permsTab = document.getElementById('permissions-tab');
        const actionBtnContainer = document.getElementById('dynamicActionButton');

        // 1. Tab Nhân sự -> Link đến trang thêm user
        usersTab.addEventListener('shown.bs.tab', function (e) {
            actionBtnContainer.innerHTML = `
                <a href="index.php?page=nguoidung_them" class="btn btn-primary fw-bold shadow-sm">
                    <i class="fas fa-user-plus me-2"></i> Thêm nhân sự
                </a>`;
        });

        // 2. Tab Nhóm -> Link đến trang thêm nhóm
        groupsTab.addEventListener('shown.bs.tab', function (e) {
            actionBtnContainer.innerHTML = `
                <a href="index.php?page=users_them_nhom" class="btn btn-success fw-bold shadow-sm">
                    <i class="fas fa-folder-plus me-2"></i> Tạo nhóm mới
                </a>`;
        });

        // 3. Tab Quyền -> Link đến trang thêm quyền
        permsTab.addEventListener('shown.bs.tab', function (e) {
            actionBtnContainer.innerHTML = `
                <a href="index.php?page=users_them_quyen" class="btn btn-danger fw-bold shadow-sm">
                    <i class="fas fa-key me-2"></i> Thêm quyền mới
                </a>`;
        });
    });
</script>

<style>
    /* CSS Giữ nguyên như cũ */
    .nav-tabs .nav-link { color: #6c757d; border: none; border-bottom: 3px solid transparent; transition: all 0.2s; }
    .nav-tabs .nav-link:hover { background-color: rgba(0,0,0,0.02); }
    .nav-tabs .nav-link.active { background-color: transparent !important; border-bottom: 3px solid var(--bs-primary); color: var(--bs-primary); }
    #groups-tab.active { border-color: var(--bs-success); color: var(--bs-success) !important; }
    #permissions-tab.active { border-color: var(--bs-danger); color: var(--bs-danger) !important; }
    code { font-size: 0.9em; }
</style>