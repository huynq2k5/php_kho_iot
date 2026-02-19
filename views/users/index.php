    <!-- Header với tiêu đề và nút action động -->
    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Người dùng và Phân quyền
            </h2>
        </div>
        
        <!-- Dynamic Action Button -->
        <div id="dynamicActionButton">
            <a href="index.php?page=nguoidung_照" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
                <i class="fas fa-user-plus mr-2"></i>
                Thêm nhân sự
            </a>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="userTabs" role="tablist">
            <li class="mr-2">
                <button class="inline-block p-4 border-b-2 rounded-t-lg transition-colors duration-150 focus:outline-none active-tab" 
                        id="users-tab" 
                        data-tab="users"
                        data-bs-toggle="tab" 
                        data-bs-target="#tab-users">
                    <i class="fas fa-users mr-2"></i> Danh sách nhân sự
                </button>
            </li>
            <li class="mr-2">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors duration-150 focus:outline-none" 
                        id="groups-tab" 
                        data-tab="groups"
                        data-bs-toggle="tab" 
                        data-bs-target="#tab-groups">
                    <i class="fas fa-layer-group mr-2 text-green-600"></i> Nhóm vai trò
                </button>
            </li>
            <li class="mr-2">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors duration-150 focus:outline-none" 
                        id="permissions-tab" 
                        data-tab="permissions"
                        data-bs-toggle="tab" 
                        data-bs-target="#tab-permissions">
                    <i class="fas fa-key mr-2 text-red-600"></i> Định nghĩa Quyền
                </button>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="userTabsContent">
        
        <!-- Tab 1: Danh sách nhân sự -->
        <div class="tab-pane fade show active" id="tab-users" role="tabpanel">
            <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                <!-- Card Header với filter -->
                <div class="px-4 py-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <!-- Search box đẹp hơn -->
                        <div class="relative flex-1 max-w-md">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <input type="text" 
                                class="block w-full pl-10 pr-4 py-2.5 text-sm bg-gray-100 border-0 rounded-lg dark:bg-gray-700 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800 transition-all duration-150" 
                                placeholder="Tìm kiếm theo tên, email..."
                                style="min-width: 280px;">
                        </div>
                        
                        <div class="flex gap-2">
                            <!-- Select đẹp hơn -->
                            <div class="relative">
                                <select class="block w-full py-2.5 pl-4 pr-10 text-sm bg-gray-100 border-0 rounded-lg appearance-none dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800 transition-all duration-150 cursor-pointer">
                                    <option value="">Tất cả vai trò</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="viewer">Viewer</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-xs text-gray-400 dark:text-gray-500"></i>
                                </div>
                            </div>
                            
                            <!-- Nút lọc đẹp hơn -->
                            <button class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-red-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-red-800 transition-all duration-150">
                                <i class="fas fa-filter mr-2 text-red-500"></i>
                                <span>Lọc</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Nhân sự</th>
                                <th class="px-4 py-3">Vai trò</th>
                                <th class="px-4 py-3">Trạng thái</th>
                                <th class="px-4 py-3">Ngày tạo</th>
                                <th class="px-4 py-3 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block flex-shrink-0">
                                            <div class="flex items-center justify-center w-full h-full rounded-full bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-200 font-bold">
                                                A
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">Nguyễn Văn A</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">admin@khoiot.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                        <i class="fas fa-crown mr-1"></i> Administrator
                                    </span>
                                </td>
                                <!-- Thay thế dòng cột Trạng thái trong table -->
                                <td class="px-4 py-3">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <!-- Background toggle -->
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-600 peer-focus:ring-2 peer-focus:ring-red-300 dark:bg-gray-700 dark:peer-focus:ring-red-800 transition-all duration-300"></div>
                                        <!-- Nút tròn -->
                                        <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-sm peer-checked:translate-x-5 peer-checked:bg-white transition-all duration-300"></div>
                                        <!-- Trạng thái text (ẩn/hiện khi cần) -->
                                        <span class="ml-3 text-xs font-medium text-gray-600 dark:text-gray-400 peer-checked:text-red-600 dark:peer-checked:text-red-400">
                                            <span class="peer-checked:hidden">Tắt</span>
                                            <span class="hidden peer-checked:inline">Bật</span>
                                        </span>
                                    </label>
                                </td>
                                <td class="px-4 py-3 text-sm">15/01/2026</td>
                                <td class="px-4 py-3 text-sm text-right">
                                    <a href="index.php?page=nguoidung_sua&id=1" 
                                       class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab 2: Nhóm vai trò -->
        <div class="tab-pane fade" id="tab-groups" role="tabpanel" style="display: none;">
            <div class="grid gap-6">
                <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                    <div class="px-4 py-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">
                            Các nhóm quyền hiện có
                        </h4>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Tên nhóm</th>
                                    <th class="px-4 py-3">Mô tả</th>
                                    <th class="px-4 py-3">Thành viên</th>
                                    <th class="px-4 py-3 text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-4 py-3 font-medium">Ban quản trị (Admin)</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">Full Access</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-400">3 Users</span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="index.php?page=sua_nhom" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Định nghĩa Quyền -->
        <div class="tab-pane fade" id="tab-permissions" role="tabpanel" style="display: none;">
            <div class="w-full overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
                <div class="px-4 py-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300">
                        Danh sách quyền
                    </h4>
                    
                </div>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Mã quyền (Key)</th>
                                <th class="px-4 py-3">Tên hiển thị</th>
                                <th class="px-4 py-3">Module</th>
                                <th class="px-4 py-3 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3">
                                    <code class="px-2 py-1 text-xs font-mono bg-gray-100 rounded dark:bg-gray-700 text-red-600 dark:text-red-400">device.view</code>
                                </td>
                                <td class="px-4 py-3 text-sm">Xem danh sách thiết bị</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                        Thiết bị
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="index.php?page=sua_quyen" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-150 mx-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
        const tabPanes = {
            users: document.getElementById('tab-users'),
            groups: document.getElementById('tab-groups'),
            permissions: document.getElementById('tab-permissions')
        };
        const actionBtnContainer = document.getElementById('dynamicActionButton');

        // Style cho active tab
        function setActiveTab(activeId) {
            tabs.forEach(tab => {
                const tabId = tab.getAttribute('data-tab');
                tab.classList.remove('active', 'text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
                
                if (tabId === activeId) {
                    tab.classList.add('active', 'text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
                } else {
                    tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                }
            });
        }

        // Xử lý khi click tab
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-bs-target').replace('#tab-', '');
                
                // Ẩn tất cả tab panes
                Object.values(tabPanes).forEach(pane => {
                    pane.style.display = 'none';
                    pane.classList.remove('show', 'active');
                });
                
                // Hiện tab được chọn
                tabPanes[targetId].style.display = 'block';
                tabPanes[targetId].classList.add('show', 'active');
                
                // Set active style
                setActiveTab(targetId);
                
                // Thay đổi nút action
                const actions = {
                    users: {
                        icon: 'user-plus',
                        text: 'Thêm nhân sự',
                        page: 'nguoidung_them',
                        color: 'red'
                    },
                    groups: {
                        icon: 'folder-plus',
                        text: 'Tạo nhóm mới',
                        page: 'users_them_nhom',
                        color: 'green'
                    },
                    permissions: {
                        icon: 'key',
                        text: 'Thêm quyền mới',
                        page: 'users_them_quyen',
                        color: 'red'
                    }
                };
                
                const action = actions[targetId];
                actionBtnContainer.innerHTML = `
                    <a href="index.php?page=${action.page}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-${action.color}-600 border border-transparent rounded-lg hover:bg-${action.color}-700 focus:outline-none focus:shadow-outline-${action.color} shadow-md">
                        <i class="fas fa-${action.icon} mr-2"></i>
                        ${action.text}
                    </a>
                `;
            });
        });

        // Kích hoạt tab đầu tiên
        if (tabs.length > 0) {
            tabs[0].click();
        }
    });
</script>

<style>
    /* Style cho tabs */
    [data-bs-toggle="tab"] {
        color: #6b7280;
        border-bottom: 2px solid transparent;
    }
    [data-bs-toggle="tab"].active {
        color: #dc2626;
        border-bottom-color: #dc2626;
    }
    .dark [data-bs-toggle="tab"].active {
        color: #f87171;
        border-bottom-color: #f87171;
    }
    [data-bs-toggle="tab"]:hover {
        color: #4b5563;
        border-bottom-color: #d1d5db;
    }
    .dark [data-bs-toggle="tab"]:hover {
        color: #e5e7eb;
        border-bottom-color: #4b5563;
    }
    
    /* Switch toggle style */
    .peer:checked ~ div:last-child {
        transform: translateX(100%);
    }
</style>