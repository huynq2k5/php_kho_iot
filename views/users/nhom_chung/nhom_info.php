<div class="grid gap-6 md:grid-cols-12">
    <div class="md:col-span-7">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin chung</h4>
            </div>
            
            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Mã nhóm <span class="text-red-600">*</span></span>
                    <?php if (isset($isEdit) && $isEdit === true): ?>
                        <input type="text" value="<?= $group['maNhom'] ?>" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input bg-gray-100 dark:bg-gray-600 cursor-not-allowed opacity-75 font-mono uppercase" disabled readonly>
                        <input type="hidden" name="group_code" value="<?= $group['maNhom'] ?>">
                        <span class="text-xs text-gray-500 mt-1"><i class="fas fa-lock mr-1"></i> Mã nhóm không thể thay đổi</span>
                    <?php else: ?>
                        <input type="text" id="groupCode" name="group_code" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red font-mono uppercase" placeholder="VD: KE_TOAN" required maxlength="20">
                        <span class="text-xs text-red-600 hidden mt-1" id="groupCode_error"></span>
                        <span class="text-xs text-gray-500 mt-1" id="groupCode_helper">Viết hoa, không dấu, không cách</span>
                    <?php endif; ?>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Tên nhóm vai trò <span class="text-red-600">*</span></span>
                    <input type="text" id="groupNameInput" name="group_name" value="<?= (isset($isEdit) && $isEdit === true) ? $group['tenNhom'] : '' ?>" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red" placeholder="VD: Kế toán kho" required oninput="updatePreview()">
                    <span class="text-xs text-red-600 hidden mt-1" id="groupName_error"></span>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Mô tả chức năng</span>
                    <textarea class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-textarea focus:border-red-400 focus:shadow-outline-red" name="description" rows="3" placeholder="Mô tả quyền hạn..."><?= (isset($isEdit) && $isEdit === true) ? $group['moTa'] : '' ?></textarea>
                </label>
            </div>
        </div>
    </div>

    <div class="md:col-span-5">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Giao diện & Hiển thị</h4>
            </div>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-2">
                    <?php 
                    $colors = ['blue' => 'Xanh dương', 'green' => 'Xanh lá', 'yellow' => 'Vàng', 'red' => 'Đỏ', 'cyan' => 'Xanh nhạt', 'gray' => 'Xám'];
                    foreach ($colors as $val => $label): 
                        $checked = ((isset($isEdit) && $isEdit === true && isset($group['badge_color']) && $group['badge_color'] == $val) || (!isset($isEdit) && $val == 'blue')) ? 'checked' : '';
                    ?>
                    <div class="relative">
                        <input type="radio" class="sr-only peer" name="badge_color" id="color_<?= $val ?>" value="<?= $val ?>" <?= $checked ?> onchange="updatePreview()">
                        <label for="color_<?= $val ?>" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium rounded-lg cursor-pointer border-2 transition-all peer-checked:border-red-600 dark:bg-gray-700">
                            <i class="fas fa-circle text-<?= $val ?>-600 text-xs"></i> <?= $label ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="p-4 mt-2 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 dark:bg-gray-700 dark:border-gray-600 text-center">
                    <p class="text-xs font-medium text-gray-500 mb-3 uppercase">Xem trước</p>
                    <span id="badgePreview" class="inline-flex items-center px-3 py-2 text-sm font-semibold rounded-full shadow-sm transition-all duration-300 border">
                        <i class="fas fa-users mr-1"></i> 
                        <span id="previewText">Tên nhóm...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>