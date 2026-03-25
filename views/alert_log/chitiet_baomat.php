<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Chi tiết bản ghi bảo mật #<?= $access->idTruyCap ?>
    </h2>

    <div class="px-6 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
        
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="mb-2 text-xs font-bold text-gray-500 uppercase dark:text-gray-400">Thời gian hệ thống</p>
                <div class="flex items-center space-x-4">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        <i class="far fa-calendar-alt mr-2 text-red-500"></i><?= date('d/m/Y', strtotime($access->thoiGian)) ?>
                    </p>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        <i class="far fa-clock mr-2 text-red-500"></i><?= date('H:i:s', strtotime($access->thoiGian)) ?>
                    </p>
                </div>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="mb-2 text-xs font-bold text-gray-500 uppercase dark:text-gray-400">Phiên làm việc (Session ID)</p>
                <p class="text-xs font-mono text-gray-600 dark:text-gray-300 break-all">
                    <?= $access->sessionId ?? 'Không có Session' ?>
                </p>
            </div>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2 border-t dark:border-gray-700 pt-6">
            <div>
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Kết nối mạng</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b dark:border-gray-700 pb-1">
                        <span class="text-gray-500">Địa chỉ IP:</span>
                        <span class="font-bold text-red-600"><?= $access->ipAddress ?></span>
                    </div>
                    <div class="flex justify-between border-b dark:border-gray-700 pb-1">
                        <span class="text-gray-500">Nhà mạng (ISP):</span>
                        <span class="text-gray-700 dark:text-gray-200"><?= $access->isp ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Múi giờ:</span>
                        <span class="text-gray-700 dark:text-gray-200"><?= $access->timezone ?></span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Vị trí địa lý</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b dark:border-gray-700 pb-1">
                        <span class="text-gray-500">Thành phố:</span>
                        <span class="text-gray-700 dark:text-gray-200"><?= $access->thanhPho ?></span>
                    </div>
                    <div class="flex justify-between border-b dark:border-gray-700 pb-1">
                        <span class="text-gray-500">Quốc gia:</span>
                        <span class="text-gray-700 dark:text-gray-200"><?= $access->quocGia ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8 p-4 border rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Định danh thiết bị</h4>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                <div class="space-y-2">
                    <p class="text-xs text-gray-500 uppercase font-bold">Fingerprint ID:</p>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-fingerprint text-purple-500"></i>
                        <code class="text-[10px] text-purple-600 dark:text-purple-400 font-mono break-all bg-purple-50 dark:bg-gray-800 p-1 rounded">
                            <?= $access->fingerprint ?>
                        </code>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-xs text-gray-500 uppercase font-bold">Thông tin chi tiết:</p>
                    <div class="flex flex-wrap gap-2 mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            <i class="<?= $access->phanGiaiUA['os_icon'] ?> mr-1"></i> 
                            <?= $access->phanGiaiUA['os'] ?> <?= $access->phanGiaiUA['version'] ?>
                        </span>

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            <i class="<?= $access->phanGiaiUA['browser_icon'] ?> mr-1"></i> 
                            <?= $access->phanGiaiUA['browser'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-lg">
            <h4 class="mb-2 font-semibold text-red-700 dark:text-red-400 uppercase text-xs">Dữ liệu yêu cầu</h4>
            <div class="flex flex-wrap items-center gap-4">
                <span class="px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                    <?= $access->method ?>
                </span>
                <span class="text-sm font-mono text-gray-700 dark:text-gray-200 break-all">
                    <?= $access->requestUri ?>
                </span>
            </div>
        </div>

        <div class="mt-8">
            <a href="index.php?page=alert_log" class="inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Trở về danh sách
            </a>
        </div>
    </div>
</div>