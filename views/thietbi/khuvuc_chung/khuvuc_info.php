<?php if (isset($kv->idKhuVuc)): ?>
    <input type="hidden" name="idKhuVuc" value="<?= $kv->idKhuVuc?>">
<?php endif; ?>

<div class="grid gap-6 mb-8 md:grid-cols-12">
    <div class="md:col-span-7">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin Khu vực</h4>
            </div>

            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Mã khu vực <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray <?= (isset($isEdit) && $isEdit) ? 'bg-gray-100 cursor-not-allowed dark:bg-gray-900 opacity-70' : 'dark:bg-gray-700' ?>" 
                           name="maKhuVuc" 
                           type="text" 
                           id="ma_khu_vuc"
                           placeholder="VD: KHO_A"
                           value="<?= htmlspecialchars($kv->maKhuVuc ?? '') ?>"
                           <?= (isset($isEdit) && $isEdit) ? 'readonly' : 'required' ?>>
                    
                    <?php if (isset($isEdit) && $isEdit): ?>
                        <span class="text-xs text-orange-500 mt-1 block">
                            <i class="fas fa-lock mr-1"></i> Mã định danh khu vực không thể thay đổi sau khi tạo.
                        </span>
                    <?php else: ?>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block" id="ma_khu_vuc_helper">
                            Mã duy nhất, viết liền không dấu.
                        </span>
                    <?php endif; ?>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Tên khu vực <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                           name="tenKhuVuc" 
                           type="text" 
                           id="ten_khu_vuc"
                           placeholder="VD: Kho Lạnh số 1"
                           value="<?= htmlspecialchars($kv->tenKhuVuc ?? '') ?>"
                           required>
                </label>
            </div>
        </div>
    </div>

    <div class="md:col-span-5 space-y-6">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Cấu hình hoạt động</h4>
            </div>

            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Chế độ vận hành mặc định</span>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                            name="cheDo" id="che_do">
                        <option value="AUTO" <?= (isset($kv->cheDo) && $kv->cheDo == 'AUTO') ? 'selected' : (!isset($kv->cheDo) ? 'selected' : '') ?>>Tự động (AUTO)</option>
                        <option value="MANUAL" <?= (isset($kv->cheDo) && $kv->cheDo == 'MANUAL') ? 'selected' : '' ?>>Thủ công (MANUAL)</option>
                    </select>
                </label>

                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Mô tả chi tiết</span>
                    <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                              name="moTa" 
                              id="mo_ta"
                              rows="2" 
                              placeholder="Nhập thông tin mô tả khu vực..."><?= htmlspecialchars($kv->moTa ?? '') ?></textarea>
                </label>
            </div>
        </div>
    </div>
</div>