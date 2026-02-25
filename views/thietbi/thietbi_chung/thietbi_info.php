<?php if (isset($tb->idThietBi)): ?>
    <input type="hidden" name="idThietBi" value="<?= $tb->idThietBi ?>">
<?php endif; ?>

<div class="grid gap-6 mb-8 md:grid-cols-12">
    <div class="md:col-span-7">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin cơ bản</h4>
            </div>

            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Mã thiết bị (UID/MAC) <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray <?= (isset($isEdit) && $isEdit) ? 'bg-gray-100 cursor-not-allowed dark:bg-gray-900 opacity-70' : 'dark:bg-gray-700' ?>" 
                           name="maThietBi" 
                           type="text" 
                           id="ma_thiet_bi"
                           placeholder="VD: ESP32_A1B2C3"
                           value="<?= htmlspecialchars($tb->maThietBi ?? '') ?>"
                           <?= (isset($isEdit) && $isEdit) ? 'readonly' : 'required' ?>>
                    
                    <?php if (isset($isEdit) && $isEdit): ?>
                        <span class="text-xs text-orange-500 mt-1 block">
                            <i class="fas fa-lock mr-1"></i> Mã định danh phần cứng không thể thay đổi sau khi tạo.
                        </span>
                    <?php else: ?>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block" id="ma_thiet_bi_helper">
                            Mã duy nhất, không có khoảng trắng.
                        </span>
                    <?php endif; ?>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Tên hiển thị <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                           name="tenThietBi" 
                           type="text" 
                           id="ten_thiet_bi"
                           placeholder="VD: Cảm biến nhiệt độ Kho Lạnh 1"
                           value="<?= htmlspecialchars($tb->tenThietBi ?? '') ?>"
                           required>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="ten_thiet_bi_helper"></span>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Khu vực lắp đặt <span class="text-red-500">*</span></span>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                            name="idKhuVuc" id="id_khu_vuc" required>
                        <option value="">-- Chọn khu vực --</option>
                        <?php 
                        // Biến $danhSachKhuVuc được truyền từ Controller xuống
                        if (!empty($dsKhuVuc)): 
                            foreach ($dsKhuVuc as $kv): 
                                $selected = (isset($kv->idKhuVuc) && $kv->idKhuVuc == $kv->idKhuVuc) ? 'selected' : '';
                        ?>
                            <option value="<?= $kv->idKhuVuc ?>" <?= $selected ?>><?= htmlspecialchars($kv->tenKhuVuc) ?></option>
                        <?php 
                            endforeach; 
                        endif; 
                        ?>
                    </select>
                </label>
            </div>
        </div>
    </div>

    <div class="md:col-span-5 space-y-6">
        
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Cấu hình kết nối</h4>
            </div>

            <div class="space-y-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Topic MQTT <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                           name="topicMQTT" 
                           type="text" 
                           id="topic_mqtt"
                           placeholder="VD: kho_iot/khu_a/sensor_1"
                           value="<?= htmlspecialchars($tb->topicMQTT ?? '') ?>"
                           required>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="topic_mqtt_helper">Kênh giao tiếp để nhận dữ liệu từ thiết bị.</span>
                </label>

                <label class="block text-sm mt-4">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Trạng thái hệ thống</span>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                            name="trangThai" id="trang_thai">
                        <option value="1" <?= (isset($tb->trangThai) && $tb->trangThai == 1) ? 'selected' : (!isset($tb->trangThai) ? 'selected' : '') ?>>Đang hoạt động (Kích hoạt)</option>
                        <option value="0" <?= (isset($tb->trangThai) && $tb->trangThai == 0) ? 'selected' : '' ?>>Tạm ngưng (Vô hiệu hóa)</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200 dark:bg-blue-900/20 dark:border-blue-800">
            <h4 class="mb-2 font-semibold text-blue-700 dark:text-blue-400 text-sm flex items-center">
                <i class="fas fa-lightbulb mr-2"></i> Hướng dẫn kết nối
            </h4>
            <p class="text-xs text-blue-600 dark:text-blue-400 leading-relaxed">
                Sau khi thêm thiết bị thành công, hãy nạp đoạn mã cấu hình vào vi điều khiển ESP32 và đảm bảo thiết bị trỏ đúng về <span class="font-semibold">Topic MQTT</span> đã khai báo ở trên để bắt đầu đồng bộ dữ liệu.
            </p>
        </div>

    </div>
</div>