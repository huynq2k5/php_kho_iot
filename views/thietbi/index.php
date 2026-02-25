<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center min-w-0">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 truncate">
            Thiết bị và Khu vực
        </h2>
    </div>
    
    <div id="dynamicActionButton" class="flex-shrink-0"></div>
</div>

<div class="mb-6 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
        <li class="mr-2">
            <a href="#" data-bs-toggle="tab" data-bs-target="#tab-thietbi" data-tab="thietbi"
               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200">
                <i class="fas fa-microchip mr-2"></i>
                Danh sách thiết bị
            </a>
        </li>
        <li class="mr-2">
            <a href="#" data-bs-toggle="tab" data-bs-target="#tab-khuvuc" data-tab="khuvuc"
               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200">
                <i class="fas fa-layer-group mr-2"></i>
                Quản lý khu vực
            </a>
        </li>
    </ul>
</div>

<div class="tab-content">
    
    <div id="tab-thietbi" style="display: none;">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Thiết bị</th>
                            <th class="px-4 py-3">Khu vực</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Topic MQTT</th>
                            <th class="px-4 py-3 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if (!empty($danhSachThietBi)): ?>
                            <?php foreach ($danhSachThietBi as $tb): ?>
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block flex-shrink-0">
                                                <div class="flex items-center justify-center w-full h-full rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-200">
                                                    <i class="fas fa-microchip"></i>
                                                </div>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-semibold truncate"><?= htmlspecialchars($tb->tenThietBi) ?></p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 font-mono"><?= htmlspecialchars($tb->maThietBi) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-4 py-3 text-sm">
                                        <?= htmlspecialchars($tb->tenKhuVuc ?? 'ID: ' . $tb->idKhuVuc) ?>
                                    </td>
                                    
                                    <td class="px-4 py-3 text-xs">
                                        <?php if (!$tb->isActive()): ?>
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                <i class="fas fa-ban mr-1"></i> Vô hiệu hóa
                                            </span>
                                        <?php elseif ($tb->isOnline()): ?>
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Online
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-600 dark:text-gray-100">
                                                Offline
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="px-4 py-3 text-sm font-mono">
                                        <?= htmlspecialchars($tb->topicMQTT) ?>
                                    </td>
                                    
                                    <td class="px-4 py-3 text-sm text-right">
                                        <a href="index.php?page=thietbi_sua&id=<?= $tb->idThietBi ?>" class="px-3 py-1 mr-1 text-xs font-medium leading-5 text-blue-600 rounded-lg dark:text-blue-400 focus:outline-none focus:shadow-outline-blue hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors duration-150 inline-block">
                                            <i class="fas fa-edit mr-1"></i> Sửa
                                        </a>
                                        <button @click="openModal" 
                                                onclick="triggerModal({
                                                title: 'Xóa thiết bị',
                                                description: 'Bạn đang xóa <?= $tb->tenThietBi ?>. Hành động này không thể hoàn tác!',
                                                confirmUrl: 'index.php?page=thietbi_xuly_xoa&id=<?= $tb->idThietBi ?>',
                                                btnClass: 'bg-red-600 hover:bg-red-700'
                                                })"
                                            class="text-gray-400 hover:text-red-600 transition-colors duration-150">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-4 block"></i>
                                    Chưa có thiết bị nào được đăng ký.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div id="tab-khuvuc" style="display: none;">
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
            <?php 
            if (!empty($danhSachKhuVuc)): 
                foreach ($danhSachKhuVuc as $kv): 
                    // Xử lý logic giao diện dựa trên chế độ hoạt động
                    $isAuto = (isset($kv->cheDo) && $kv->cheDo === 'AUTO');
                    
                    $iconColorClass = $isAuto ? 'text-blue-500 bg-blue-100 dark:text-blue-100 dark:bg-blue-500' : 'text-orange-500 bg-orange-100 dark:text-orange-100 dark:bg-orange-500';
                    $iconClass = $isAuto ? 'fa-layer-group' : 'fa-box-open';
                    $badgeColorClass = $isAuto ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-orange-700 bg-orange-100 dark:bg-orange-700 dark:text-orange-100';
            ?>
                <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex flex-col justify-between hover:shadow-md transition-shadow duration-150">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 mr-4 rounded-full <?= $iconColorClass ?>">
                                    <i class="fas <?= $iconClass ?> text-xl w-5 h-5 flex items-center justify-center"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        <?= htmlspecialchars($kv->tenKhuVuc) ?>
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                        <?= htmlspecialchars($kv->maKhuVuc) ?>
                                    </p>
                                </div>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full <?= $badgeColorClass ?>">
                                <?= htmlspecialchars($kv->cheDo) ?>
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2" title="<?= htmlspecialchars($kv->moTa ?? '') ?>">
                            <?= htmlspecialchars($kv->moTa ?? 'Chưa có mô tả cho khu vực này.') ?>
                        </p>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <i class="fas fa-microchip mr-2 text-red-500"></i>
                            <span>Đang chứa <span class="font-semibold text-gray-700 dark:text-gray-200"><?= intval($kv->soThietBi ?? 0) ?></span> thiết bị</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="index.php?page=khuvuc_sua&id=<?= $kv->idKhuVuc ?>" class="px-3 py-1 text-xs font-medium leading-5 text-blue-600 rounded-lg dark:text-blue-400 focus:outline-none focus:shadow-outline-blue hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors duration-150 flex items-center">
                            <i class="fas fa-edit mr-1"></i> Sửa
                        </a>
                        <button @click="openModal" 
                                onclick="triggerModal({
                                title: 'Xóa khu vực',
                                description: 'Bạn đang xóa <?= $kv->tenKhuVuc ?>. Hành động này không thể hoàn tác!',
                                confirmUrl: 'index.php?page=khuvuc_xuly_xoa&id=<?= $kv->idKhuVuc ?>',
                                btnClass: 'bg-red-600 hover:bg-red-700'
                                })"
                            class="text-gray-400 hover:text-red-600 transition-colors duration-150">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php 
                endforeach; 
            else: 
            ?>
                <div class="col-span-full p-6 text-center bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <i class="fas fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">Chưa có khu vực nào được tạo.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
        const tabPanes = {
            thietbi: document.getElementById('tab-thietbi'),
            khuvuc: document.getElementById('tab-khuvuc')
        };
        const actionBtnContainer = document.getElementById('dynamicActionButton');

        // Hàm xử lý đổi CSS cho nút Tab
        function setActiveTab(activeId) {
            tabs.forEach(tab => {
                const tabId = tab.getAttribute('data-tab');
                const icon = tab.querySelector('i');
                
                // Xóa trạng thái active cũ
                tab.classList.remove('active', 'text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
                tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                icon.classList.add('text-gray-400', 'group-hover:text-gray-500');
                
                // Cấp trạng thái active mới
                if (tabId === activeId) {
                    tab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
                    tab.classList.add('active', 'text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
                    icon.classList.remove('text-gray-400', 'group-hover:text-gray-500');
                }
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-bs-target').replace('#tab-', '');
                
                // 1. Ẩn tất cả nội dung
                Object.values(tabPanes).forEach(pane => {
                    if(pane) pane.style.display = 'none';
                });
                
                // 2. Hiện nội dung được chọn
                if(tabPanes[targetId]) {
                    tabPanes[targetId].style.display = 'block';
                }
                
                // 3. Đổi màu nút Tab
                setActiveTab(targetId);
                
                // 4. (Tính năng nâng cao) Tự động cập nhật URL mà không reload trang
                const url = new URL(window.location);
                url.searchParams.set('tab', targetId);
                window.history.pushState({}, '', url);
                
                // 5. Cập nhật nút Thêm mới
                const actions = {
                    thietbi: { icon: 'plus', text: 'Thêm Thiết bị mới', page: 'thietbi_them', color: 'red' },
                    khuvuc: { icon: 'plus-square', text: 'Thêm Khu vực mới', page: 'khuvuc_them', color: 'red' }
                };
                
                const action = actions[targetId];
                actionBtnContainer.innerHTML = `
                    <a href="index.php?page=${action.page}" 
                       class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-${action.color}-600 border border-transparent rounded-lg active:bg-${action.color}-600 hover:bg-${action.color}-700 focus:outline-none focus:shadow-outline-${action.color} shadow-md">
                        <i class="fas fa-${action.icon} mr-2"></i>
                        <span>${action.text}</span>
                    </a>
                `;
            });
        });

        // Kích hoạt Tab dựa trên URL hoặc mặc định Tab đầu tiên
        const urlParams = new URLSearchParams(window.location.search);
        const activeTabParam = urlParams.get('tab'); 

        if (activeTabParam) {
            const targetTab = document.querySelector(`[data-bs-target="#tab-${activeTabParam}"]`);
            if (targetTab) {
                targetTab.click();
            } else if (tabs.length > 0) {
                tabs[0].click();
            }
        } else if (tabs.length > 0) {
            tabs[0].click();
        }
    });
</script>