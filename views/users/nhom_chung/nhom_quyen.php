<div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h4 class="font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                <i class="fas fa-key text-red-600 mr-2"></i> Phân quyền cho nhóm
            </h4>
            <div class="flex gap-2">
                <button type="button" onclick="checkAllPermissions()" class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <i class="fas fa-check-square mr-1"></i> Chọn tất cả
                </button>
                <button type="button" onclick="uncheckAllPermissions()" class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <i class="fas fa-square mr-1"></i> Bỏ chọn
                </button>
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 max-h-96 overflow-y-auto pr-2">
            <?php foreach ($allPermissions as $module): ?>
            <div class="border border-gray-200 rounded-lg dark:border-gray-700 overflow-hidden">
                <div class="px-4 py-2 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" class="module-checkbox sr-only peer" data-module="<?= $module['module'] ?>" onchange="toggleModule('<?= $module['module'] ?>', this.checked)">
                        <div class="w-5 h-5 border-2 border-gray-400 rounded peer-checked:bg-red-600 peer-checked:border-red-600 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs hidden peer-checked:block"></i>
                        </div>
                        <span class="font-medium text-gray-800 dark:text-gray-200"><?= $module['name'] ?></span>
                    </label>
                </div>
                
                <div class="p-3 space-y-2" id="module-<?= $module['module'] ?>">
                    <?php foreach ($module['items'] as $perm): ?>
                    <label class="flex items-center p-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <input type="checkbox" name="permissions[]" value="<?= $perm['id'] ?>" class="perm-checkbox sr-only peer" data-module="<?= $module['module'] ?>" 
                            <?= (isset($assignedPermissions) && in_array($perm['id'], $assignedPermissions)) ? 'checked' : '' ?>
                            onchange="updateModuleCheckbox('<?= $module['module'] ?>')">
                        <div class="w-5 h-5 border-2 border-gray-300 rounded peer-checked:bg-red-600 peer-checked:border-red-600 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-white text-xs hidden peer-checked:block"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-700 dark:text-gray-300"><?= $perm['name'] ?></p>
                            <p class="text-[10px] text-gray-500 font-mono uppercase"><?= $perm['key'] ?></p>
                        </div>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>