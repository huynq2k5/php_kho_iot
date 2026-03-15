<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Chi tiết thiết bị: <?= $tb->tenThietBi ?>
    </h2>

    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Lịch sử dữ liệu cảm biến
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <div class="max-h-96 overflow-y-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 sticky top-0">
                            <th class="px-4 py-3">Thời gian</th>
                            <th class="px-4 py-3 text-center">Nhiệt độ (°C)</th>
                            <th class="px-4 py-3 text-center">Độ ẩm (%)</th>
                            <th class="px-4 py-3 text-center">CO2 (ppm)</th>
                            <th class="px-4 py-3 text-center">Ánh sáng (lux)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if (!empty($lichSu)): ?>
                            <?php foreach ($lichSu as $ls): ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">
                                        <?= date('d/m/Y H:i:s', strtotime($ls->thoiGian)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center font-bold text-orange-600">
                                        <?= $ls->nhietDo ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center font-bold text-blue-600">
                                        <?= $ls->doAm ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center font-bold text-purple-600">
                                        <?= $ls->nongDoCo2 ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center font-bold text-yellow-600">
                                        <?= $ls->cuongDoAnhSang ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-sm text-center text-gray-500">
                                    Không có dữ liệu lịch sử.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>