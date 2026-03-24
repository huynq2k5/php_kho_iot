<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div x-data="{ activeTab: 'realtime' }">

    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Phân tích dữ liệu
        </h2>
        
        <div class="flex flex-wrap w-full gap-3 sm:w-auto sm:flex-nowrap">
            <select id="deviceFilter" class="block w-full text-sm rounded-md border-gray-300 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 form-select sm:w-40">
                <?php foreach ($danhSachThietBi as $index => $tb): ?>
                    <option value="<?= $tb->idThietBi ?>" <?= $index === 0 ? 'selected' : '' ?>>
                        <?= $tb->tenThietBi ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select id="globalSensorType" class="block w-full text-sm rounded-md border-gray-300 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 form-select sm:w-32"></select>

            <select id="periodFilter" class="block w-full text-sm rounded-md border-gray-300 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 form-select sm:w-32">
                <option value="day">Hôm nay</option>
                <option value="week">7 ngày qua</option>
                <option value="month">Tháng này</option>
            </select>

            <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                <i class="fas fa-filter mr-1"></i> Lọc
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
                    <i class="fas fa-project-diagram me-2"></i> Phân tích chỉ số
                </button>
            </li>
        </ul>
    </div>

    <div x-show="activeTab === 'realtime'" x-transition>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border dark:border-gray-700">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Biến thiên dữ liệu theo chu kỳ</h4>
            <div class="relative w-full" style="height: 400px;">
                <canvas id="realtimeChart"></canvas>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'advanced'" x-transition style="display: none;">
        <div class="min-w-0 p-4 mb-8 bg-white rounded-lg shadow-xs dark:bg-gray-800 border dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-gray-800 dark:text-gray-300">
                    1. Chỉ số MACD (Xu hướng biến động)
                </h4>
                <div class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Kỹ thuật Exponential Moving Average</div>
            </div>
            <div class="relative w-full" style="height: 350px;">
                <canvas id="macdChart"></canvas>
            </div>
            <div class="flex gap-4 mt-2 justify-center text-[10px] font-bold">
                <span class="text-red-600"><i class="fas fa-minus mr-1"></i> MACD Line</span>
                <span class="text-gray-400"><i class="fas fa-minus mr-1"></i> Signal Line</span>
                <span class="text-red-300"><i class="fas fa-columns mr-1"></i> Histogram</span>
            </div>
        </div>

        <div class="min-w-0 p-4 mb-8 bg-white rounded-lg shadow-xs dark:bg-gray-800 border dark:border-gray-700">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">Chỉ số RSI (Mức độ biến động)</h4>
            <div class="relative w-full" style="height: 200px;">
                <canvas id="rsiChart"></canvas>
            </div>
        </div>
        
        <div class="grid gap-6 mb-8 md:grid-cols-2">
    
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border dark:border-gray-700">
                <h4 class="mb-4 font-semibold text-gray-700 dark:text-gray-200 text-lg">
                    Đánh giá hệ thống
                </h4>
                
                <div class="p-3 mb-4 text-sm text-red-800 bg-red-100 rounded-lg border-l-4 border-red-600 dark:bg-red-900/40 dark:text-red-200">
                    <div class="flex items-center font-bold mb-1">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Cảnh báo đa chỉ số!
                    </div>
                    <p>MACD cho thấy xu hướng tăng, đồng thời <span class="font-bold underline">RSI đã chạm mức 74</span> (Vùng quá nhiệt). Cần can thiệp ngay để tránh sốc nhiệt cho kho bãi.</p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Xu hướng (MACD):</span>
                        <span class="flex items-center text-red-600 dark:text-red-500 font-bold">
                            <i class="fas fa-arrow-up mr-1"></i> Tăng mạnh
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Cường độ (RSI):</span>
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            74 (Quá nhiệt)
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Trạng thái:</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200">Biến động nhanh</span>
                    </div>
                </div>
            </div>

            <div class="min-w-0 p-4 text-white bg-red-600 rounded-lg shadow-xs">
                <h4 class="mb-4 font-semibold text-white text-lg">
                    Gợi ý tối ưu vận hành
                </h4>
                
                <p class="mb-4 text-red-100 text-sm opacity-90">
                    Dựa trên RSI > 70, cường độ tăng nhiệt đang ở mức báo động. Hệ thống đề xuất kích hoạt kịch bản làm mát cưỡng bức thay vì kịch bản tự động thông thường.
                </p>

                <div class="flex items-center justify-between p-4 bg-red-700 bg-opacity-50 rounded-lg border border-red-500">
                    <div class="text-center">
                        <p class="text-xs font-bold text-red-200 uppercase tracking-wide">Quạt hiện tại</p>
                        <p class="text-xl font-bold text-white">40% công suất</p>
                    </div>
                    <i class="fas fa-bolt text-yellow-300 animate-pulse"></i>
                    <div class="text-center">
                        <p class="text-xs font-bold text-green-300 uppercase tracking-wide">Đề xuất mới</p>
                        <p class="text-2xl font-bold text-green-300">80% công suất</p>
                    </div>
                </div>

                <button class="w-full mt-4 px-4 py-3 text-sm font-bold leading-5 text-red-600 transition-colors duration-150 bg-white border border-transparent rounded-lg hover:bg-gray-100 focus:outline-none shadow-sm">
                    <i class="fas fa-check-circle me-2"></i> Kích hoạt làm mát cưỡng bức
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deviceFilter = document.getElementById('deviceFilter');
        const sensorFilter = document.getElementById('globalSensorType');
        const periodFilter = document.getElementById('periodFilter');
        const filterBtn = document.querySelector('button i.fa-filter').parentElement;

        let realtimeChart, macdChart, rsiChart, stabilityChart;

        function initCharts() {
            const commonOptions = { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } };

            // 1. Realtime Chart
            realtimeChart = new Chart(document.getElementById('realtimeChart'), {
                type: 'line',
                data: { labels: [], datasets: [{ label: 'Nồng độ CO2 (ppm)', data: [], borderColor: '#dc2626', backgroundColor: 'rgba(220, 38, 38, 0.1)', fill: true, tension: 0.4 }] },
                options: commonOptions
            });

            // 2. MACD Chart
            macdChart = new Chart(document.getElementById('macdChart'), {
                type: 'bar',
                data: { labels: [], datasets: [
                    { label: 'MACD', type: 'line', data: [], borderColor: '#dc2626', borderWidth: 2, pointRadius: 0, tension: 0.3 },
                    { label: 'Signal', type: 'line', data: [], borderColor: '#9ca3af', borderDash: [5, 5], pointRadius: 0, tension: 0.3 },
                    { label: 'Histogram', data: [], backgroundColor: [] }
                ]},
                options: { ...commonOptions, scales: { x: { stacked: true } } }
            });

            // 3. RSI Chart
            rsiChart = new Chart(document.getElementById('rsiChart'), {
                type: 'line',
                data: { labels: [], datasets: [{ label: 'RSI Nhiệt độ', data: [], borderColor: '#9333ea', borderWidth: 2, pointRadius: 0, tension: 0.3 }] },
                options: { ...commonOptions, scales: { y: { min: 0, max: 100 } } }
            });

            // 4. Stability Chart
            stabilityChart = new Chart(document.getElementById('stabilityChart'), {
                type: 'line',
                data: { labels: [], datasets: [{ data: [], borderColor: '#0694a2', fill: true, pointRadius: 0, tension: 0.4, backgroundColor: 'rgba(6, 148, 162, 0.1)' }] },
                options: { ...commonOptions, scales: { y: { min: 0, max: 100 } } }
            });
        }

        async function loadSensors(idThietBi) {
            if (!idThietBi) return;
            try {
                const response = await fetch(`index.php?page=tudong_api_lay_thanh_phan&idThietBi=${idThietBi}&loai=INPUT`);
                const sensors = await response.json();

                sensorFilter.innerHTML = '';
                sensors.forEach((item, index) => {
                    const option = document.createElement('option');
                    option.value = item.maThanhPhan;
                    option.textContent = item.tenThanhPhan;
                    if (index === 0) option.selected = true;
                    sensorFilter.appendChild(option);
                });

                // Tự động cập nhật biểu đồ sau khi load cảm biến
                updateDashboard();
            } catch (error) {
                console.error("Lỗi tải cảm biến:", error);
            }
        }

        async function updateDashboard() {
            const idTB = deviceFilter.value;
            const sensor = sensorFilter.value; // Lấy giá trị từ Select cảm biến
            const period = periodFilter.value; // Lấy giá trị từ Select thời gian

            if (!idTB || !sensor) return;

            filterBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            try {
                // Dùng biến `${sensor}` và `${period}` để URL thay đổi theo Select
                const response = await fetch(`index.php?page=phantich_api_data&idThietBi=${idTB}&period=${period}&sensorType=${sensor}`);
                const res = await response.json();

                // Cập nhật tất cả biểu đồ theo cùng 1 nguồn dữ liệu vừa chọn
                [realtimeChart, macdChart, rsiChart, stabilityChart].forEach(chart => {
                    chart.data.labels = res.labels;
                });

                realtimeChart.data.datasets[0].label = sensorFilter.options[sensorFilter.selectedIndex].text;
                realtimeChart.data.datasets[0].data = res.values;
                realtimeChart.update();

                macdChart.data.datasets[0].data = res.macd.macd;
                macdChart.data.datasets[1].data = res.macd.signal;
                macdChart.data.datasets[2].data = res.macd.histogram;
                macdChart.data.datasets[2].backgroundColor = res.macd.histogram.map(v => v >= 0 ? 'rgba(220, 38, 38, 0.3)' : 'rgba(156, 163, 175, 0.3)');
                macdChart.update();

                rsiChart.data.datasets[0].data = res.rsi;
                rsiChart.update();

                stabilityChart.data.datasets[0].data = res.rsi.map(v => 100 - Math.abs(50 - v) * 2);
                stabilityChart.update();

                updateUIAnalysis(res);
            } catch (error) {
                console.error("Lỗi fetch:", error);
            } finally {
                filterBtn.innerHTML = '<i class="fas fa-filter mr-1"></i> Lọc';
            }
        }

        function updateUIAnalysis(res) {
            if (!res.rsi || res.rsi.length === 0) return;
            const lastRSI = Math.round(res.rsi[res.rsi.length - 1]);
            const lastMACD = res.macd.macd[res.macd.macd.length - 1];
            const lastSignal = res.macd.signal[res.macd.signal.length - 1];

            // Cập nhật Badge RSI
            const rsiBadge = document.querySelector('.px-2.py-1.font-semibold.leading-tight.rounded-full');
            if (rsiBadge) {
                const status = lastRSI > 70 ? 'Quá nhiệt' : (lastRSI < 30 ? 'Quá lạnh' : 'Ổn định');
                rsiBadge.textContent = `${lastRSI} (${status})`;
                rsiBadge.className = `px-2 py-1 font-semibold leading-tight rounded-full ${lastRSI > 70 ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100'}`;
            }

            // Cập nhật Mũi tên và Text Xu hướng
            const trendText = document.querySelector('.flex.items-center.text-red-600.font-bold');
            if (trendText) {
                const isUp = lastMACD > lastSignal;
                trendText.innerHTML = isUp ? '<i class="fas fa-arrow-up mr-1"></i> Tăng mạnh' : '<i class="fas fa-arrow-down mr-1 text-blue-500"></i> Đang giảm';
                trendText.className = isUp ? 'flex items-center text-red-600 font-bold' : 'flex items-center text-blue-600 font-bold';
            }
        }

        initCharts();

        // Gán sự kiện
        deviceFilter.addEventListener('change', () => loadSensors(deviceFilter.value));
        
        // Nút lọc và các select khác vẫn gọi updateDashboard 
        // nhưng bên trong hàm này chúng ta đã cố định sensorType trong URL fetch
        sensorFilter.addEventListener('change', updateDashboard);
        periodFilter.addEventListener('change', updateDashboard);
        filterBtn.addEventListener('click', updateDashboard);

        if (deviceFilter.value) loadSensors(deviceFilter.value);
    });
</script>