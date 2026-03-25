<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
    <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Cảnh báo và Nhật ký hệ thống
    </h2>
    <div class="flex gap-2">
        <form action="index.php?page=alert_log_xoa" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa lịch sử cũ hơn 30 ngày?')">
            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-red-700 transition-colors duration-150 bg-red-100 border border-transparent rounded-lg hover:bg-red-200 focus:outline-none focus:shadow-outline-red dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50">
                <i class="fas fa-trash-alt mr-2"></i> Xóa lịch sử cũ
            </button>
        </form>
        <a href="index.php?page=alert_log_export" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-blue-700 transition-colors duration-150 bg-blue-100 border border-transparent rounded-lg hover:bg-blue-200 focus:outline-none focus:shadow-outline-red dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
            <i class="fas fa-file-export mr-2"></i> Xuất báo cáo
        </a>
    </div>
</div>

<div class="grid gap-6 md:grid-cols-1">
    
    <div class="w-full">
        <div class="min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full flex flex-col">
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Cảnh báo môi trường</h4>
            </div>
            
            <div class="divide-y divide-gray-200 dark:divide-gray-700 overflow-y-auto" style="max-height: 600px;">
                <?php if (empty($data['canhBao'])): ?>
                    <div class="px-4 py-6 text-center text-gray-500">Không có cảnh báo nào gần đây.</div>
                <?php else: ?>
                    <?php foreach ($data['canhBao'] as $cb): 
                        // Xác định màu sắc dựa trên loại thông báo hoặc nội dung
                        $borderColor = ($cb->loaiThongBao == 'CanhBao') ? 'border-red-600' : 'border-green-600';
                        $badgeClass = ($cb->loaiThongBao == 'CanhBao') ? 'text-red-700 bg-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100 dark:bg-green-700';
                    ?>
                    <div class="relative px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 border-l-4 <?= $borderColor ?>">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?= $cb->tieuDe ?></h5>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1"><?= $cb->noiDung ?></p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    <i class="far fa-clock mr-1"></i><?= date('d/m/Y H:i', strtotime($cb->thoiGian)) ?>
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight rounded-full <?= $badgeClass ?> dark:text-red-100">
                                <?= ($cb->loaiThongBao == 'CanhBao') ? 'Khẩn cấp' : 'Thông tin' ?>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="px-4 py-3 text-center border-t border-gray-200 dark:border-gray-700 mt-auto">
                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">Xem tất cả cảnh báo</a>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full flex flex-col">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Nhật ký vận hành (Audit Log)</h4>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Thời gian</th>
                            <th class="px-4 py-3">Người dùng</th>
                            <th class="px-4 py-3">Hành động</th>
                            <th class="px-4 py-3">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if (empty($data['nhatKy'])): ?>
                            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-500">Chưa có nhật ký hoạt động.</td></tr>
                        <?php else: ?>
                            <?php foreach ($data['nhatKy'] as $log): 
                                // Dynamic Badge Color
                                $actionClass = 'text-gray-700 bg-gray-100';
                                if (strpos($log->hanhDong, 'Điều khiển') !== false) $actionClass = 'text-blue-700 bg-blue-100 dark:bg-blue-700 dark:text-blue-100';
                                if (strpos($log->hanhDong, 'Sửa') !== false || strpos($log->hanhDong, 'Cấu hình') !== false) $actionClass = 'text-yellow-700 bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-100';
                                if ($log->hoTen == 'Hệ thống') $actionClass = 'text-cyan-700 bg-cyan-100 dark:bg-cyan-700 dark:text-cyan-100';
                            ?>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono"><?= date('H:i:s', strtotime($log->thoiGian)) ?></td>
                                <td class="px-4 py-3 text-sm font-medium"><?= $log->hoTen ?: 'N/A' ?></td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full <?= $actionClass ?>">
                                        <?= $log->hanhDong ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm"><?= $log->giaTriMoi ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w-full mt-6">
        <div class="min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Nhật ký truy cập (Security Log)</h4>
                <span class="text-xs text-gray-500 uppercase tracking-widest">Dữ liệu IP & Vị trí</span>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Thời gian</th>
                            <th class="px-4 py-3">IP & Địa điểm</th>
                            <th class="px-4 py-3 text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if (empty($data['truyCap'])): ?>
                            <tr><td colspan="3" class="px-4 py-10 text-center text-gray-500">Chưa có dữ liệu truy cập.</td></tr>
                        <?php else: ?>
                            <?php foreach ($data['truyCap'] as $access): ?>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm">
                                    <?= date('H:i:s d/m', strtotime($access->thoiGian)) ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-red-600 dark:text-red-400"><?= $access->ipAddress ?></span>
                                        <span class="text-[10px]"><?= $access->thanhPho ?>, <?= $access->quocGia ?></span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="index.php?page=chitiet_baomat&id=<?= $access->idTruyCap ?>" 
                                    class="px-3 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-md active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                        <i class="fas fa-eye mr-1"></i> Chi tiết
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>