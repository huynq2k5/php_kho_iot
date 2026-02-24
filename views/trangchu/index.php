<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Tổng quan kho hàng
</h2>

<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
            <i class="fas fa-temperature-high text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nhiệt độ</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">28°C</p>
            <p class="text-xs font-bold text-red-600 mt-1">Cao hơn chuẩn</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <i class="fas fa-tint text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Độ ẩm</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">65%</p>
            <p class="text-xs text-gray-500 mt-1">Ổn định</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <i class="fas fa-sun text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Ánh sáng</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">350 Lux</p>
            <p class="text-xs text-gray-500 mt-1">Trời nắng</p>
        </div>
    </div>

    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <i class="fas fa-wind text-xl w-5 h-5 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Nồng độ CO2</p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">420 ppm</p>
            <p class="text-xs text-green-600 font-bold mt-1">Không khí tốt</p>
        </div>
    </div>
</div>

<div class="grid gap-6 mb-8 md:grid-cols-2">
    
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Điều khiển hệ thống
        </h4>
        
        <div class="flex items-center justify-between p-4 mb-4 bg-purple-50 rounded-lg border border-purple-100 dark:bg-gray-700 dark:border-gray-600">
            <div>
                <p class="font-semibold text-purple-700 dark:text-purple-300">Chế độ vận hành</p>
                <p class="text-xs text-gray-600 dark:text-gray-400" id="modeStatusText">Hệ thống đang chạy Tự động</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" checked>
                <!-- Background toggle -->
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-600 peer-focus:ring-2 peer-focus:ring-red-300 dark:bg-gray-700 dark:peer-focus:ring-red-800 transition-all duration-300"></div>
                <!-- Nút tròn -->
                <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-sm peer-checked:translate-x-5 peer-checked:bg-white transition-all duration-300"></div>                
            </label>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="controlTable">
                    <tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity">
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center">
                                <div class="p-2 mr-3 rounded-full bg-gray-100 dark:bg-gray-700">
                                    <i class="fas fa-fan text-gray-500"></i>
                                </div>
                                <span class="font-medium">Quạt thông gió</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-right">
                            <button disabled class="btn-device px-3 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-md cursor-not-allowed">
                                Tắt
                            </button>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400 opacity-50 transition-opacity">
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center">
                                <div class="p-2 mr-3 rounded-full bg-blue-50 dark:bg-blue-900">
                                    <i class="fas fa-spray-can text-blue-500"></i>
                                </div>
                                <span class="font-medium">Máy phun sương</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-right">
                            <button disabled class="btn-device px-3 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-md cursor-not-allowed">
                                Bật
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Xu hướng môi trường (24h)
        </h4>
        
        <div class="relative w-full h-64">
            <canvas id="lineChart"></canvas>
        </div>

        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-red-500 rounded-full"></span>
                <span>Nhiệt độ</span>
            </div>
            <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                <span>Độ ẩm</span>
            </div>
        </div>
    </div>
</div>

<h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">
    Trạng thái kết nối
</h2>
<div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Thiết bị</th>
                    <th class="px-4 py-3">Loại</th>
                    <th class="px-4 py-3">Trạng thái</th>
                    <th class="px-4 py-3">Lần cuối</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <div class="w-full h-full rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                    <i class="fas fa-microchip"></i>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold">Cảm biến Khu A</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">ESP32</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">Sensor Node</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Online
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">Vừa xong</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    /* CSS cho nút gạt */
    input:checked ~ .toggle-bg { background-color: #7e3af2; border-color: #7e3af2; }
    input:checked ~ .dot { transform: translateX(100%); }
    .opacity-50 { opacity: 0.5; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- 1. SỬA LỖI BIỂU ĐỒ ---
        const ctx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0h', '4h', '8h', '12h', '16h', '20h'],
                datasets: [
                    {
                        data: [26, 25, 28, 32, 30, 27],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4 // Làm mềm đường vẽ
                    },
                    {
                        data: [70, 72, 68, 60, 62, 68],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // QUAN TRỌNG: Ngăn biểu đồ tự phóng to chiều cao
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: false, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });

        // --- 2. LOGIC NÚT GẠT ---
        const masterSwitch = document.getElementById('masterSwitch');
        const modeLabel = document.getElementById('modeLabel');
        const tableRows = document.querySelectorAll('#controlTable tr');
        const buttons = document.querySelectorAll('.btn-device');

        masterSwitch.addEventListener('change', function() {
            if (this.checked) {
                modeLabel.innerText = "MANUAL";
                tableRows.forEach(r => r.classList.remove('opacity-50'));
                buttons.forEach(btn => {
                    btn.disabled = false;
                    btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                    // Gán màu lại
                    if(btn.innerText.trim() === 'Tắt') btn.classList.add('bg-red-600', 'hover:bg-red-700');
                    else btn.classList.add('bg-green-600', 'hover:bg-green-700');
                });
            } else {
                modeLabel.innerText = "AUTO";
                tableRows.forEach(r => r.classList.add('opacity-50'));
                buttons.forEach(btn => {
                    btn.disabled = true;
                    btn.className = "btn-device px-3 py-1 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-md cursor-not-allowed";
                });
            }
        });
    });
</script>