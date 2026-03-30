<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Trung tâm Nhật ký & Cảnh báo
        </h2>
        
    </div>
    <div class="flex items-center gap-3">
        <a href="index.php?page=alert_log_export" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition-all">
            <i class="fas fa-file-download mr-2"></i> Xuất báo cáo
        </a>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-2">
    
    <div class="flex flex-col min-w-0 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-50 dark:border-gray-700">
            <h4 class="font-bold text-gray-700 dark:text-gray-200 flex items-center">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                Cảnh báo môi trường
            </h4>
            
        </div>
        
        <div class="overflow-y-auto custom-scrollbar" style="max-height: 400px;">
            <?php if (empty($data['canhBao'])): ?>
                <div class="flex flex-col items-center py-12 text-gray-400">
                    <i class="fas fa-check-circle text-3xl mb-2 text-green-500/50"></i>
                    <p class="text-sm">Hệ thống đang hoạt động an toàn</p>
                </div>
            <?php else: ?>
                <div class="divide-y divide-gray-50 dark:divide-gray-700">
                    <?php foreach ($data['canhBao'] as $cb): 
                        $isUrgent = ($cb->loaiThongBao == 'CanhBao');
                        $indicatorColor = $isUrgent ? 'bg-red-500' : 'bg-green-500';
                        $bgHover = $isUrgent ? 'hover:bg-red-50/50 dark:hover:bg-red-900/10' : 'hover:bg-green-50/50 dark:hover:bg-green-900/10';
                    ?>
                    <div class="px-5 py-4 transition-colors <?= $bgHover ?> relative group">
                        <div class="flex items-start gap-3">
                            <div class="mt-1.5 w-2 h-2 rounded-full shrink-0 <?= $indicatorColor ?>"></div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h5 class="text-sm font-bold text-gray-800 dark:text-gray-200 truncate"><?= $cb->tieuDe ?></h5>
                                    <span class="text-[10px] font-medium text-gray-400 uppercase"><?= date('H:i d/m', strtotime($cb->thoiGian)) ?></span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed"><?= $cb->noiDung ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="flex flex-col min-w-0 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        <div class="px-5 py-4 border-b border-gray-50 dark:border-gray-700">
            <h4 class="font-bold text-gray-700 dark:text-gray-200 flex items-center">
                <i class="fas fa-history mr-2 text-blue-500"></i>
                Nhật ký vận hành
            </h4>
        </div>

        <div class="w-full overflow-x-auto flex-1 custom-scrollbar" style="max-height: 400px;">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-gray-50 dark:bg-gray-900 z-10">
                    <tr class="text-[11px] font-bold tracking-wider text-gray-500 uppercase border-b dark:border-gray-700">
                        <th class="px-5 py-3">Thời gian</th>
                        <th class="px-5 py-3">Đối tượng</th>
                        <th class="px-5 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    <?php if (empty($data['nhatKy'])): ?>
                        <tr><td colspan="3" class="px-5 py-12 text-center text-gray-400 text-sm">Chưa có hoạt động nào được ghi lại</td></tr>
                    <?php else: ?>
                        <?php foreach ($data['nhatKy'] as $log): 
                            $badgeStyle = 'text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-300';
                            if (strpos($log->hanhDong, 'Điều khiển') !== false) $badgeStyle = 'text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400';
                            if (strpos($log->hanhDong, 'Sửa') !== false || strpos($log->hanhDong, 'Cấu hình') !== false) $badgeStyle = 'text-orange-600 bg-orange-50 dark:bg-orange-900/30 dark:text-orange-400';
                            if ($log->hoTen == 'Hệ thống') $badgeStyle = 'text-purple-600 bg-purple-50 dark:bg-purple-900/30 dark:text-purple-400';
                        ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-5 py-3 text-xs font-mono text-gray-500 dark:text-gray-400"><?= date('H:i:s', strtotime($log->thoiGian)) ?></td>
                            <td class="px-5 py-3 text-xs font-semibold text-gray-700 dark:text-gray-300"><?= $log->hoTen ?: 'Hệ thống' ?></td>
                            <td class="px-5 py-3 text-xs font-semibold text-gray-900 dark:text-gray-200">
                                <?= $log->hanhDong ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="lg:col-span-2 flex flex-col min-w-0 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700 overflow-hidden mt-2">
        <div class="px-5 py-4 border-b border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/20 flex justify-between items-center">
            <h4 class="font-bold text-gray-700 dark:text-gray-200 flex items-center">
                <i class="fas fa-shield-alt mr-2 text-red-500"></i>
                Nhật ký truy cập bảo mật
            </h4>
            <span class="text-[10px] font-bold text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">DỮ LIỆU IP & VỊ TRÍ</span>
        </div>

        <div class="w-full overflow-x-auto overflow-y-auto custom-scrollbar" style="max-height: 400px;">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-widest bg-gray-50/50 dark:bg-gray-900/50 border-b dark:border-gray-700">
                        <th class="px-6 py-4">Thời điểm</th>
                        <th class="px-6 py-4">Địa chỉ IP</th>
                        <th class="px-6 py-4">Vị trí địa lý</th>
                        <th class="px-6 py-4 text-right">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                    <?php if (empty($data['truyCap'])): ?>
                        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">Không có dữ liệu truy cập trái phép</td></tr>
                    <?php else: ?>
                        <?php foreach ($data['truyCap'] as $access): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
                            <td class="px-6 py-4 text-xs font-medium text-gray-500">
                                <span class="block font-bold text-gray-700 dark:text-gray-300"><?= date('H:i:s', strtotime($access->thoiGian)) ?></span>
                                <span><?= date('d/m/Y', strtotime($access->thoiGian)) ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-mono font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded">
                                    <?= $access->ipAddress ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-300"></i>
                                    <div>
                                        <p class="font-bold text-gray-700 dark:text-gray-200"><?= $access->thanhPho ?></p>
                                        <p class="text-[10px] uppercase"><?= $access->quocGia ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="index.php?page=chitiet_baomat&id=<?= $access->idTruyCap ?>" 
                                   class="inline-flex items-center px-4 py-1.5 text-xs font-bold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 transition-shadow hover:shadow">
                                    Chi tiết <i class="fas fa-chevron-right ml-2 text-[10px]"></i>
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

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #374151; }
</style>