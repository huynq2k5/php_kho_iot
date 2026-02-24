<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div x-data="{ activeTab: 'realtime' }">

    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Phân tích dữ liệu
        </h2>
        
        <div class="flex flex-col w-full gap-3 sm:w-auto sm:flex-row">
            
            <select id="globalSensorType" class="block w-full text-sm rounded-md border-gray-300 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 form-select sm:w-40">
                <option value="temp">Nhiệt độ (°C)</option>
                <option value="hum">Độ ẩm (%)</option>
                <option value="co2">CO2 (ppm)</option>
            </select>

            <input type="date" value="<?= date('Y-m-d') ?>" class="block w-full text-sm rounded-md border-gray-300 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 form-input sm:w-auto" />

            <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
            <li class="mr-2">
                <button @click="activeTab = 'realtime'" 
                        :class="{ 'text-red-600 border-red-600 dark:text-red-500 dark:border-red-500': activeTab === 'realtime', 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': activeTab !== 'realtime' }"
                        class="inline-block p-4 border-b-2 rounded-t-lg focus:outline-none transition-colors duration-150">
                    <i class="fas fa-chart-line me-2"></i> Giám sát Thời gian thực
                </button>
            </li>
            <li class="mr-2">
                <button @click="activeTab = 'advanced'" 
                        :class="{ 'text-red-600 border-red-600 dark:text-red-500 dark:border-red-500': activeTab === 'advanced', 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': activeTab !== 'advanced' }"
                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg focus:outline-none transition-colors duration-150">
                    <i class="fas fa-chart-area me-2"></i> Phân tích Xu hướng
                </button>
            </li>
        </ul>
    </div>

    <div x-show="activeTab === 'realtime'" 
         x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
        <!-- Card chứa biểu đồ - ĐÃ ĐÚNG -->
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Biến thiên dữ liệu theo giờ
            </h4>
            <div class="relative w-full" style="height: 400px;">
                <canvas id="realtimeChart"></canvas>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'advanced'" 
         x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
        
        <div class="min-w-0 p-4 mb-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-gray-800 dark:text-gray-300">
                    1. Vùng dao động chuẩn (Standard Deviation)
                </h4>
                <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700 text-xs">
                    24h qua
                </span>
            </div>
            <div class="relative w-full" style="height: 350px;">
                <canvas id="deviationChart"></canvas>
            </div>
        </div>

        <div class="min-w-0 p-4 mb-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                2. Chỉ số ổn định môi trường (0 - 100)
            </h4>
            <div class="relative w-full" style="height: 200px;">
                <canvas id="stabilityChart"></canvas>
            </div>
            <p class="mt-4 text-xs text-center text-gray-500 dark:text-gray-400">
                <i class="fas fa-info-circle me-1"></i> > 70: Tăng nhanh | < 30: Giảm nhanh | 50: Ổn định
            </p>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            
            <!-- Card Đánh giá hệ thống - ĐÃ SỬA -->
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 ">
                <h4 class="mb-4 font-semibold text-gray-700 dark:text-gray-200 text-lg">
                    Đánh giá hệ thống
                </h4>
                
                <!-- Alert - ĐÃ THÊM DARK MODE -->
                <div class="p-3 mb-4 text-sm text-red-800 bg-red-100 rounded-lg border-l-4 border-red-600 dark:bg-red-900 dark:text-red-200 dark:border-red-500">
                    <div class="flex items-center font-bold mb-1">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Cảnh báo biến động!
                    </div>
                    <p>Nhiệt độ vượt ngưỡng chuẩn (Giới hạn trên) 3 lần trong 24h qua.</p>
                </div>

                <!-- Stats - ĐÃ ĐÚNG -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Chỉ số ổn định:</span>
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            78 (Cao)
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Độ lệch chuẩn:</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200">±2.5</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Xu hướng:</span>
                        <span class="flex items-center text-red-600 dark:text-red-500 font-bold">
                            <i class="fas fa-arrow-up mr-1"></i> Đang nóng lên
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Gợi ý tối ưu - ĐÃ ĐÚNG (card màu đỏ không cần dark mode) -->
            <div class="min-w-0 p-4 text-white bg-red-600 rounded-lg shadow-xs">
                <h4 class="mb-4 font-semibold text-white text-lg">
                    Gợi ý tối ưu vận hành
                </h4>
                
                <p class="mb-4 text-red-100 text-sm opacity-90">
                    Hệ thống phát hiện xu hướng tăng nhiệt. Đề xuất cập nhật ngưỡng hoạt động mới để tiết kiệm năng lượng.
                </p>

                <div class="flex items-center justify-between p-4 bg-red-700 bg-opacity-50 rounded-lg border border-red-500">
                    <div class="text-center">
                        <p class="text-xs font-bold text-red-200 uppercase tracking-wide">Hiện tại</p>
                        <p class="text-xl font-bold text-white">30.0°C</p>
                    </div>
                    <i class="fas fa-arrow-right text-red-300 opacity-70"></i>
                    <div class="text-center">
                        <p class="text-xs font-bold text-green-300 uppercase tracking-wide">Đề xuất</p>
                        <p class="text-2xl font-bold text-green-300">32.5°C</p>
                    </div>
                </div>

                <!-- Button - ĐÃ THÊM DARK MODE -->
                <button onclick="applyThreshold()" 
                        class="w-full mt-4 px-4 py-3 text-sm font-bold leading-5 text-red-600 transition-colors duration-150 bg-white border border-transparent rounded-lg active:bg-red-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray dark:bg-gray-700 dark:text-red-400 dark:hover:bg-gray-600 dark:focus:shadow-outline-gray shadow-sm">
                    <i class="fas fa-check-circle me-2"></i> Áp dụng ngay
                </button>
            </div>

        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- 1. REALTIME CHART ---
        const ctxRealtime = document.getElementById('realtimeChart').getContext('2d');
        new Chart(ctxRealtime, {
            type: 'line',
            data: {
                labels: ['10:00', '10:05', '10:10', '10:15', '10:20', '10:25', '10:30'],
                datasets: [{
                    label: 'Nhiệt độ (°C)',
                    data: [28, 28.2, 28.5, 29, 28.8, 28.5, 28.2],
                    borderColor: '#dc2626', // MÃ MÀU ĐỎ (Red 600)
                    backgroundColor: 'rgba(220, 38, 38, 0.1)', // Đỏ nhạt
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                legend: { display: false },
                scales: {
                    x: { grid: { display: false } },
                    y: { grid: { borderDash: [2, 4], color: 'rgba(0,0,0,0.05)' } }
                }
            }
        });

        // --- 2. DEVIATION CHART ---
        const dataMain = [28, 29, 31, 34, 33, 30, 29, 28, 29, 30, 31, 35, 36, 34]; 
        const dataUpper = [32, 33, 35, 36, 36, 34, 33, 32, 33, 34, 35, 38, 39, 38]; 
        const dataLower = [24, 25, 27, 28, 28, 26, 25, 24, 25, 26, 27, 30, 31, 30]; 
        const labelsAdv = Array.from({length: 14}, (_, i) => `${i+8}:00`);

        const ctxDeviation = document.getElementById('deviationChart').getContext('2d');
        new Chart(ctxDeviation, {
            type: 'line',
            data: {
                labels: labelsAdv,
                datasets: [
                    {
                        label: 'Giới hạn trên (+2SD)',
                        data: dataUpper,
                        borderColor: '#9ca3af',
                        borderWidth: 1,
                        pointRadius: 0,
                        fill: false
                    },
                    {
                        label: 'Giới hạn dưới (-2SD)',
                        data: dataLower,
                        borderColor: '#9ca3af',
                        borderWidth: 1,
                        pointRadius: 0,
                        fill: '-1', 
                        backgroundColor: 'rgba(220, 38, 38, 0.05)' // Đổi nền tím nhạt sang đỏ nhạt
                    },
                    {
                        label: 'Giá trị đo',
                        data: dataMain,
                        borderColor: '#e02424',
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        zIndex: 10
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // --- 3. STABILITY CHART ---
        const dataStability = [45, 50, 60, 75, 70, 55, 45, 40, 50, 60, 65, 80, 85, 70];
        const ctxStability = document.getElementById('stabilityChart').getContext('2d');
        new Chart(ctxStability, {
            type: 'line',
            data: {
                labels: labelsAdv,
                datasets: [{
                    label: 'Mức độ ổn định',
                    data: dataStability,
                    borderColor: '#0694a2', // Giữ nguyên màu Teal cho biểu đồ này (hoặc đổi thành #dc2626 nếu muốn)
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: 'rgba(6, 148, 162, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { min: 0, max: 100, ticks: { stepSize: 50 } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>