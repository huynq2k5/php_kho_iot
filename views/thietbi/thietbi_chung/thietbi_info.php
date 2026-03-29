<?php if (isset($tb->idThietBi)): ?>
    <input type="hidden" name="idThietBi" value="<?= $tb->idThietBi ?>">
<?php endif; ?>

<div class="grid gap-6 mb-8 md:grid-cols-2">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
            <i class="fas fa-microchip mr-2 text-red-500"></i>
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin cơ bản</h4>
        </div>

        <div class="space-y-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400 font-medium">Mã thiết bị (UID/MAC) <span class="text-red-500">*</span></span>
                <input class="block w-full mt-1 text-sm dark:text-gray-300 form-input focus:border-red-400 <?= (isset($isEdit) && $isEdit) ? 'bg-gray-100 cursor-not-allowed dark:bg-gray-900 opacity-70' : 'dark:bg-gray-700' ?>" 
                       name="maThietBi" type="text" id="ma_thiet_bi" placeholder="VD: ESP32_TB01"
                       value="<?= htmlspecialchars($tb->maThietBi ?? '') ?>"
                       <?= (isset($isEdit) && $isEdit) ? 'readonly' : 'required' ?>>
                <span id="ma_thiet_bi_helper" class="text-xs mt-1"></span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400 font-medium">Tên hiển thị thiết bị <span class="text-red-500">*</span></span>
                <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400" 
                       name="tenThietBi" id="ten_thiet_bi" type="text" placeholder="VD: Cảm biến kho A"
                       value="<?= htmlspecialchars($tb->tenThietBi ?? '') ?>" required>
                <span id="ten_thiet_bi_helper" class="text-xs mt-1"></span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400 font-medium">Khu vực lắp đặt <span class="text-red-500">*</span></span>
                <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-select focus:border-red-400" 
                        name="idKhuVuc" id="id_khu_vuc" required>
                    <option value="">-- Chọn khu vực --</option>
                    <?php if (!empty($dsKhuVuc)): foreach ($dsKhuVuc as $kv): ?>
                        <option value="<?= $kv->idKhuVuc ?>" <?= (isset($tb->idKhuVuc) && $tb->idKhuVuc == $kv->idKhuVuc) ? 'selected' : '' ?>><?= htmlspecialchars($kv->tenKhuVuc) ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </label>
        </div>
    </div>

    <div class="space-y-6">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                <i class="fas fa-network-wired mr-2 text-blue-500"></i>
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Cấu hình MQTT</h4>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Topic MQTT <span class="text-red-500">*</span></span>
                    <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400" 
                           name="topicMQTT" id="topic_mqtt" type="text" placeholder="kho_iot/TB01" 
                           value="<?= htmlspecialchars($tb->topicMQTT ?? '') ?>" required>
                    <span id="topic_mqtt_helper" class="text-xs mt-1"></span>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-medium">Trạng thái</span>
                    <select class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-select focus:border-red-400" 
                            name="trangThai" id="trang_thai">
                        <option value="1" <?= (isset($tb->trangThai) && $tb->trangThai == 1) ? 'selected' : '' ?>>Kích hoạt</option>
                        <option value="0" <?= (isset($tb->trangThai) && $tb->trangThai == 0) ? 'selected' : '' ?>>Vô hiệu hóa</option>
                    </select>
                </label>
            </div>
        </div>

        <div class="p-3 bg-orange-50 rounded-lg border border-orange-200 dark:bg-orange-900/20 dark:border-orange-800">
            <h4 class="mb-1.5 font-bold text-orange-700 dark:text-orange-400 text-xs flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i> CHÚ Ý: CẤU HÌNH ESP32
            </h4>
            <p class="text-[10px] text-orange-800 dark:text-orange-300 opacity-90 leading-tight mb-2">
                Admin cần khai báo chính xác các Topic dựa trên mã thiết bị vào code ESP32:
            </p>
            
            <div class="grid grid-cols-2 gap-x-6 gap-y-1 text-[9px] font-mono text-orange-700 dark:text-orange-400">
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Dữ liệu:</span>
                    <span class="font-bold">kho_iot/<?= htmlspecialchars($tb->maThietBi ?? 'maThietBi') ?></span>
                </div>
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Kịch bản:</span>
                    <span class="font-bold">.../kichban/<?= htmlspecialchars($tb->maThietBi ?? 'maThietBi') ?></span>
                </div>
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Điều khiển:</span>
                    <span class="font-bold">.../<?= htmlspecialchars($tb->maThietBi ?? 'maThietBi') ?>/cmd</span>
                </div>
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Phản hồi:</span>
                    <span class="font-bold">.../ack/<?= htmlspecialchars($tb->maThietBi ?? 'maThietBi') ?></span>
                </div>
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Trạng thái:</span>
                    <span class="font-bold">.../<?= htmlspecialchars($tb->maThietBi ?? 'maThietBi') ?>/status</span>
                </div>
                <div class="flex justify-between border-b border-orange-100 dark:border-orange-800/50 pb-0.5">
                    <span class="opacity-80">Chế độ:</span>
                    <span class="font-bold text-blue-600 dark:text-blue-400">kho_iot/system/mode</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <i class="fas fa-project-diagram mr-2 text-purple-500"></i>
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Danh sách thành phần linh kiện</h4>
            </div>
            <button type="button" onclick="addRow()" class="px-4 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all shadow-sm">
                <i class="fas fa-plus mr-1"></i> Thêm linh kiện
            </button>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3" style="width: 15%;">Mã TP (Key)</th>
                        <th class="px-4 py-3" style="width: 25%;">Tên thành phần</th>
                        <th class="px-4 py-3" style="width: 20%;">Loại</th>
                        <th class="px-4 py-3" style="width: 15%;">Đơn vị</th>
                        <th class="px-4 py-3" style="width: 15%;">GPIO</th>
                        <th class="px-4 py-3 text-right">Xóa</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="component-body">
                    <?php 
                    $components = $dsThanhPhan ?? []; 
                    if (!empty($components)): foreach ($components as $cp): 
                    ?>
                    <tr class="text-gray-700 dark:text-gray-400 row-component">
                        <td class="px-4 py-3"><input type="text" name="tp_ma[]" value="<?= htmlspecialchars($cp->maThanhPhan) ?>" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300" required></td>
                        <td class="px-4 py-3"><input type="text" name="tp_ten[]" value="<?= htmlspecialchars($cp->tenThanhPhan) ?>" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300" required></td>
                        <td class="px-4 py-3">
                            <select name="tp_loai[]" class="block w-full text-xs dark:bg-gray-700 form-select rounded shadow-sm border-gray-300">
                                <option value="INPUT" <?= ($cp->loaiThanhPhan == 'INPUT') ? 'selected' : '' ?>>INPUT (Cảm biến)</option>
                                <option value="OUTPUT" <?= ($cp->loaiThanhPhan == 'OUTPUT') ? 'selected' : '' ?>>OUTPUT (Điều khiển)</option>
                            </select>
                        </td>
                        <td class="px-4 py-3"><input type="text" name="tp_donvi[]" value="<?= htmlspecialchars($cp->donVi ?? '') ?>" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300"></td>
                        <td class="px-4 py-3"><input type="number" name="tp_gpio[]" value="<?= htmlspecialchars($cp->pinGPIO ?? '') ?>" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300"></td>
                        <td class="px-4 py-3 text-right">
                            <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr class="text-gray-700 dark:text-gray-400 row-component">
                        <td class="px-4 py-3"><input type="text" name="tp_ma[]" placeholder="t1" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300" required></td>
                        <td class="px-4 py-3"><input type="text" name="tp_ten[]" placeholder="Nhiệt độ" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300" required></td>
                        <td class="px-4 py-3">
                            <select name="tp_loai[]" class="block w-full text-xs dark:bg-gray-700 form-select rounded shadow-sm border-gray-300">
                                <option value="INPUT">INPUT (Cảm biến)</option>
                                <option value="OUTPUT">OUTPUT (Điều khiển)</option>
                            </select>
                        </td>
                        <td class="px-4 py-3"><input type="text" name="tp_donvi[]" placeholder="°C" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300"></td>
                        <td class="px-4 py-3"><input type="number" name="tp_gpio[]" placeholder="12" class="block w-full text-xs dark:bg-gray-700 form-input rounded shadow-sm border-gray-300"></td>
                        <td class="px-4 py-3 text-right">
                            <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function addRow() {
    const tbody = document.getElementById('component-body');
    const newRow = document.createElement('tr');
    newRow.className = "text-gray-700 dark:text-gray-400 row-component";
    newRow.innerHTML = `
        <td class="px-4 py-3"><input type="text" name="tp_ma[]" class="block w-full text-xs dark:bg-gray-700 form-input border-gray-300 rounded shadow-sm" placeholder="mã" required></td>
        <td class="px-4 py-3"><input type="text" name="tp_ten[]" class="block w-full text-xs dark:bg-gray-700 form-input border-gray-300 rounded shadow-sm" placeholder="tên" required></td>
        <td class="px-4 py-3">
            <select name="tp_loai[]" class="block w-full text-xs dark:bg-gray-700 form-select border-gray-300 rounded shadow-sm">
                <option value="INPUT">INPUT (Cảm biến)</option>
                <option value="OUTPUT">OUTPUT (Điều khiển)</option>
            </select>
        </td>
        <td class="px-4 py-3"><input type="text" name="tp_donvi[]" class="block w-full text-xs dark:bg-gray-700 form-input border-gray-300 rounded shadow-sm"></td>
        <td class="px-4 py-3"><input type="number" name="tp_gpio[]" class="block w-full text-xs dark:bg-gray-700 form-input border-gray-300 rounded shadow-sm"></td>
        <td class="px-4 py-3 text-right">
            <button type="button" onclick="removeRow(this)" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
}

function removeRow(btn) {
    const rows = document.querySelectorAll('.row-component');
    if (rows.length > 1) {
        btn.closest('tr').remove();
    } else {
        alert("Thiết bị phải có ít nhất một thành phần!");
    }
}
</script>