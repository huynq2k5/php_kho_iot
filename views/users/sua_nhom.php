<?php
$isEdit = true;
$groupId = $group['idNhom'];

$allPermissions = [
    ['module' => 'device', 'name' => '📡 Quản lý thiết bị', 'items' => [
        ['id' => 1, 'key' => 'device.view', 'name' => 'Xem thiết bị'],
        ['id' => 2, 'key' => 'device.create', 'name' => 'Thêm thiết bị'],
        ['id' => 3, 'key' => 'device.edit', 'name' => 'Sửa thiết bị'],
        ['id' => 4, 'key' => 'device.delete', 'name' => 'Xóa thiết bị'],
        ['id' => 5, 'key' => 'device.control', 'name' => 'Điều khiển thiết bị'],
    ]],
    ['module' => 'user', 'name' => '👤 Quản lý người dùng', 'items' => [
        ['id' => 6, 'key' => 'user.view', 'name' => 'Xem người dùng'],
        ['id' => 7, 'key' => 'user.create', 'name' => 'Thêm người dùng'],
        ['id' => 8, 'key' => 'user.edit', 'name' => 'Sửa người dùng'],
        ['id' => 9, 'key' => 'user.delete', 'name' => 'Xóa người dùng'],
    ]],
    ['module' => 'scenario', 'name' => '⚙️ Kịch bản tự động', 'items' => [
        ['id' => 10, 'key' => 'scenario.view', 'name' => 'Xem kịch bản'],
        ['id' => 11, 'key' => 'scenario.create', 'name' => 'Tạo kịch bản'],
        ['id' => 12, 'key' => 'scenario.edit', 'name' => 'Sửa kịch bản'],
        ['id' => 13, 'key' => 'scenario.delete', 'name' => 'Xóa kịch bản'],
    ]],
    ['module' => 'report', 'name' => '📊 Báo cáo & Thống kê', 'items' => [
        ['id' => 14, 'key' => 'report.view', 'name' => 'Xem báo cáo'],
        ['id' => 15, 'key' => 'report.export', 'name' => 'Xuất báo cáo'],
    ]],
];

$assignedPermissions = [1, 2, 3, 6, 7, 10, 11, 14];

$currentMembers = [
    ['id' => 1, 'name' => 'Nguyễn Văn A', 'email' => 'a@khoiot.com', 'avatar' => 'A', 'color' => 'red'],
    ['id' => 2, 'name' => 'Trần Thị B', 'email' => 'b@khoiot.com', 'avatar' => 'B', 'color' => 'blue'],
    ['id' => 3, 'name' => 'Lê Văn C', 'email' => 'c@khoiot.com', 'avatar' => 'C', 'color' => 'green'],
];

$availableUsers = [
    ['id' => 4, 'name' => 'Phạm Thị D', 'email' => 'd@khoiot.com', 'avatar' => 'D', 'color' => 'yellow'],
    ['id' => 5, 'name' => 'Hoàng Văn E', 'email' => 'e@khoiot.com', 'avatar' => 'E', 'color' => 'purple'],
    ['id' => 6, 'name' => 'Vũ Thị F', 'email' => 'f@khoiot.com', 'avatar' => 'F', 'color' => 'cyan'],
];
?>

<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
    <div>
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Sửa nhóm người dùng: <span class="text-green-600" id="groupNameDisplay"><?= $group['tenNhom'] ?></span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Chỉnh sửa thông tin nhóm, phân quyền và quản lý thành viên
        </p>
    </div>
    
    <a href="index.php?page=users&tab=groups" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
        <i class="fas fa-chevron-left mr-2"></i> Quay lại
    </a>
</div>

<div class="mb-6 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="groupTabs" role="tablist">
        <li class="mr-2">
            <button class="inline-block p-4 border-b-2 rounded-t-lg transition-colors duration-150 active-tab text-red-600 border-red-600" 
                    id="info-tab" 
                    onclick="switchTab('info')">
                <i class="fas fa-info-circle mr-2"></i> Thông tin chung
            </button>
        </li>
        <li class="mr-2">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors duration-150" 
                    id="permissions-tab" 
                    onclick="switchTab('permissions')">
                <i class="fas fa-key mr-2"></i> Phân quyền
            </button>
        </li>
        <li class="mr-2">
            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors duration-150" 
                    id="members-tab" 
                    onclick="switchTab('members')">
                <i class="fas fa-users mr-2"></i> Thành viên
            </button>
        </li>
    </ul>
</div>

<form action="index.php?page=nhom_xulycapnhat" method="POST" id="mainForm">
    <input type="hidden" name="id" value="<?= $group['idNhom'] ?>">
    
    <div id="info-tab-content" class="tab-content">
        <?php include 'nhom_chung/nhom_info.php'; ?>
    </div>

    <div id="permissions-tab-content" class="tab-content hidden">
        <?php include 'nhom_chung/nhom_quyen.php'; ?>
    </div>

    <div id="members-tab-content" class="tab-content hidden">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                    <i class="fas fa-user-check text-green-600 mr-2"></i> 
                    Thành viên trong nhóm (<?= count($currentMembers) ?>)
                </h4>
                
                <div class="space-y-2 max-h-80 overflow-y-auto pr-2">
                    <?php foreach ($currentMembers as $member): ?>
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-<?= $member['color'] ?>-100 text-<?= $member['color'] ?>-600 flex items-center justify-center font-bold mr-3">
                                <?= $member['avatar'] ?>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200"><?= $member['name'] ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?= $member['email'] ?></p>
                            </div>
                        </div>
                        <button type="button" onclick="removeFromGroup(<?= $member['id'] ?>)" 
                                class="text-gray-400 hover:text-red-600 transition-colors duration-150"
                                title="Xóa khỏi nhóm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                    <i class="fas fa-user-plus text-blue-600 mr-2"></i> Thêm thành viên
                </h4>
                
                <div class="relative mb-3">
                    <input type="text" 
                           id="searchUser"
                           class="block w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:border-red-400 focus:shadow-outline-red dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" 
                           placeholder="Tìm kiếm...">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                
                <div class="space-y-2 max-h-80 overflow-y-auto pr-2" id="availableUsersList">
                    <?php foreach ($availableUsers as $user): ?>
                    <label class="flex items-center p-2 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors duration-150">
                        <input type="checkbox" class="sr-only peer" value="<?= $user['id'] ?>">
                        <div class="w-5 h-5 border-2 border-gray-300 rounded peer-checked:bg-red-600 peer-checked:border-red-600 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs hidden peer-checked:block"></i>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-<?= $user['color'] ?>-100 text-<?= $user['color'] ?>-600 flex items-center justify-center font-bold mr-3">
                            <?= $user['avatar'] ?>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200"><?= $user['name'] ?></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"><?= $user['email'] ?></p>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
                
                <button type="button" onclick="addToGroup()" 
                        class="w-full mt-4 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red transition-colors duration-150">
                    <i class="fas fa-user-plus mr-2"></i> Thêm vào nhóm
                </button>
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="index.php?page=users&tab=groups" 
           class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-times mr-2"></i> Hủy
        </a>
        <button type="submit" 
                class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline-green shadow-md">
            <i class="fas fa-save mr-2"></i> Cập nhật nhóm
        </button>
    </div>
</form>

<script>
    <?php include 'nhom_chung/nhom_validate.js'; ?>

    function removeFromGroup(userId) {
        if (confirm('Xóa người dùng này khỏi nhóm?')) {
            console.log('Remove user:', userId);
            alert('Đã xóa thành viên!');
        }
    }

    function addToGroup() {
        const selected = [];
        document.querySelectorAll('#availableUsersList input:checked').forEach(cb => {
            selected.push(cb.value);
        });
        
        if (selected.length === 0) {
            alert('Vui lòng chọn người dùng!');
            return;
        }
        
        if (confirm('Thêm ' + selected.length + ' người vào nhóm?')) {
            console.log('Add users:', selected);
            alert('Đã thêm thành viên!');
        }
    }

    document.getElementById('searchUser')?.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('#availableUsersList label').forEach(label => {
            const text = label.textContent.toLowerCase();
            label.style.display = text.includes(term) ? 'flex' : 'none';
        });
    });
</script>