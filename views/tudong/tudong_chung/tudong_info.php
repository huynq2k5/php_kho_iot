<input type="hidden" name="loaiKichBan" id="loaiKichBan" value="<?= $kichBan->loaiKichBan ?? 'SENSOR' ?>">

<div class="grid gap-6 mb-8 md:grid-cols-2">
    <div class="md:col-span-2">
        <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Cấu hình chung</h4>
            </div>
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400 font-medium">Tên kịch bản <span class="text-red-600">*</span></span>
                <input type="text" name="tenKichBan" id="tenKichBan"
                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400" 
                    value="<?= $kichBan->tenKichBan ?? '' ?>" placeholder="Ví dụ: Tự động làm mát kho" required>
                <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="tenKichBan_error">Vui lòng nhập tên kịch bản</span>
            </label>
        </div>
    </div>

    <div class="md:col-span-1">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-red-600 dark:text-red-400">NẾU... (ĐIỀU KIỆN)</h4>
            </div>

            <div id="sensor-tab-content" class="tab-content space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Trạm điều khiển</span>
                    <select id="idThietBiVao" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400">
                        <option value="">-- Chọn thiết bị --</option>
                        <?php foreach ($danhSachThietBi as $tb): ?>
                            <option value="<?= $tb->idThietBi ?>" 
                                <?= (isset($kichBan) && $kichBan->idThietBiVao == $tb->idThietBi) ? 'selected' : '' ?>>
                                <?= $tb->tenThietBi ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Cảm biến <span class="text-red-600">*</span></span>
                    <select name="idThanhPhanVao" id="idThanhPhanVao" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400">
                        <?php if(isset($kichBan) && $kichBan->idThanhPhanVao): ?>
                            <option value="<?= $kichBan->idThanhPhanVao ?>" selected><?= $kichBan->tenThanhPhanVao ?></option>
                        <?php else: ?>
                            <option value="">-- Chọn cảm biến --</option>
                        <?php endif; ?>
                    </select>
                </label>

                <div class="grid grid-cols-2 gap-4">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">So sánh</span>
                        <select name="dieuKien" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400">
                            <?php foreach(['>', '<', '=', '>=', '<='] as $op): ?>
                                <option value="<?= $op ?>" <?= (isset($kichBan) && $kichBan->dieuKien == $op) ? 'selected' : '' ?>><?= $op ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Ngưỡng</span>
                        <input type="number" step="0.1" name="giaTriNguong" class="block w-full mt-1 text-sm dark:bg-gray-700 form-input focus:border-red-400" value="<?= $kichBan->giaTriNguong ?? 0 ?>">
                    </label>
                </div>
            </div>

        </div>
    </div>

    <div class="md:col-span-1">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-green-600 dark:text-green-400">THÌ... (HÀNH ĐỘNG)</h4>
            </div>

            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Trạm thực thi</span>
                    <select id="idThietBiRa" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400">
                        <option value="">-- Chọn thiết bị --</option>
                        <?php foreach ($danhSachThietBi as $tb): ?>
                            <option value="<?= $tb->idThietBi ?>" 
                                <?= (isset($kichBan) && $kichBan->idThietBiRa == $tb->idThietBi) ? 'selected' : '' ?>>
                                <?= $tb->tenThietBi ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Thiết bị chấp hành <span class="text-red-600">*</span></span>
                    <select name="idThanhPhanRa" id="idThanhPhanRa" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400">
                        <?php if(isset($kichBan) && $kichBan->idThanhPhanRa): ?>
                            <option value="<?= $kichBan->idThanhPhanRa ?>" selected><?= $kichBan->tenThanhPhanRa ?></option>
                        <?php else: ?>
                            <option value="">-- Chọn thiết bị --</option>
                        <?php endif; ?>
                    </select>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Hành động thực hiện</span>
                    <select name="hanhDong" class="block w-full mt-1 text-sm dark:bg-gray-700 form-select focus:border-red-400 font-bold text-red-600">
                        <option value="ON" <?= (isset($kichBan) && $kichBan->hanhDong == 'ON') ? 'selected' : '' ?>>BẬT (ON)</option>
                        <option value="OFF" <?= (isset($kichBan) && $kichBan->hanhDong == 'OFF') ? 'selected' : '' ?>>TẮT (OFF)</option>
                    </select>
                </label>
            </div>
        </div>
    </div>
</div>