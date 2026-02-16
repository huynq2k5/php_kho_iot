<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-secondary fw-bold">Phân tích dữ liệu cảm biến</h4>
        <div class="d-flex gap-2">
            <select class="form-select w-auto" id="globalSensorType">
                <option value="temp">Nhiệt độ (°C)</option>
                <option value="hum">Độ ẩm (%)</option>
                <option value="co2">CO2 (ppm)</option>
            </select>
            <input type="date" class="form-control w-auto" value="<?= date('Y-m-d') ?>">
            <button class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>

    <ul class="nav nav-tabs nav-fill mb-4" id="analyticsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="tab-realtime-btn" data-bs-toggle="tab" data-bs-target="#tab-realtime" type="button" role="tab">
                <i class="fas fa-chart-line me-2"></i> Giám sát Thời gian thực
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-danger" id="tab-advanced-btn" data-bs-toggle="tab" data-bs-target="#tab-advanced" type="button" role="tab">
                <i class="fas fa-chart-area me-2"></i> Phân tích Xu hướng & Ổn định
            </button>
        </li>
    </ul>

    <div class="tab-content" id="analyticsTabsContent">

        <div class="tab-pane fade show active" id="tab-realtime" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted mb-3">Biến thiên dữ liệu theo giờ</h5>
                    <div style="height: 400px; width: 100%;">
                        <canvas id="realtimeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-advanced" role="tabpanel">
    <div class="row">
        
        <div class="col-12">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-wave-square me-2"></i>1. Vùng dao động chuẩn (Standard Deviation)
                    </h6>
                    <span class="badge bg-light text-dark border">Dữ liệu 24h qua</span>
                </div>
                <div class="card-body">
                    <div style="height: 350px;"> <canvas id="deviationChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-2">
                    <h6 class="mb-0 fw-bold text-secondary">
                        <i class="fas fa-chart-bar me-2"></i>2. Chỉ số ổn định môi trường (0 - 100)
                    </h6>
                </div>
                <div class="card-body">
                    <div style="height: 180px;">
                        <canvas id="stabilityChart"></canvas>
                    </div>
                    <div class="mt-2 text-center">
                        <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Chỉ số > 70: Tăng nhanh | Chỉ số < 30: Giảm nhanh | 50: Ổn định</small>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 bg-soft-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white p-2 rounded-circle shadow-sm text-warning me-3">
                                    <i class="fas fa-clipboard-check fa-lg"></i>
                                </div>
                                <h5 class="fw-bold mb-0 text-dark">Đánh giá hệ thống</h5>
                            </div>
                            
                            <div class="alert bg-white border-warning mb-2">
                                <strong><i class="fas fa-exclamation-triangle"></i> Cảnh báo biến động!</strong>
                                <p class="mb-0 small mt-1">Nhiệt độ vượt ngưỡng chuẩn thống kê (Giới hạn trên) 3 lần. Dấu hiệu môi trường thiếu ổn định.</p>
                            </div>

                            <ul class="list-unstyled small text-muted mb-0">
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Chỉ số ổn định: <strong>78</strong> (Cao)</li>
                                <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Độ lệch chuẩn: <strong>±2.5</strong></li>
                                <li><i class="fas fa-arrow-up text-danger me-2"></i>Xu hướng: Đang nóng lên</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 border-start border-4 border-success">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3 text-success">
                                <i class="fas fa-sliders-h me-2"></i>Gợi ý tối ưu vận hành
                            </h5>
                            
                            <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded mb-3">
                                <div>
                                    <small class="text-muted text-uppercase fw-bold">Ngưỡng Cao (Hiện tại)</small>
                                    <div class="h5 mb-0 text-secondary">30.0°C</div>
                                </div>
                                <div class="text-center text-success">
                                    <i class="fas fa-arrow-right fa-lg"></i>
                                </div>
                                <div class="text-end">
                                    <small class="text-success text-uppercase fw-bold">Đề xuất mới</small>
                                    <div class="h4 mb-0 text-primary fw-bold">32.5°C</div>
                                </div>
                            </div>

                            <button class="btn btn-success w-100 fw-bold shadow-sm" onclick="applyThreshold()">
                                <i class="fas fa-check-circle me-2"></i> Áp dụng cấu hình này
                            </button>
                        </div>
                    </div>
                </div>

            </div> </div> </div> </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Hàm giả lập áp dụng ngưỡng
    function applyThreshold() {
        if(confirm('Bạn có chắc chắn muốn cập nhật ngưỡng nhiệt độ mới không?')) {
            alert('Đã cập nhật cấu hình thành công xuống thiết bị!');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. BIỂU ĐỒ REALTIME (TAB 1) ---
        const ctxRealtime = document.getElementById('realtimeChart').getContext('2d');
        new Chart(ctxRealtime, {
            type: 'line',
            data: {
                labels: ['10:00', '10:05', '10:10', '10:15', '10:20', '10:25', '10:30'],
                datasets: [{
                    label: 'Nhiệt độ (°C)',
                    data: [28, 28.2, 28.5, 29, 28.8, 28.5, 28.2],
                    borderColor: '#0d6efd',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // --- 2. BIỂU ĐỒ DAO ĐỘNG CHUẨN (Thay cho Bollinger) ---
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
                        label: 'Giới hạn trên (+2SD)', // Thay đổi thuật ngữ
                        data: dataUpper,
                        borderColor: 'rgba(108, 117, 125, 0.5)',
                        borderWidth: 1,
                        pointRadius: 0,
                        fill: false
                    },
                    {
                        label: 'Giới hạn dưới (-2SD)', // Thay đổi thuật ngữ
                        data: dataLower,
                        borderColor: 'rgba(108, 117, 125, 0.5)',
                        borderWidth: 1,
                        pointRadius: 0,
                        fill: '-1', 
                        backgroundColor: 'rgba(13, 110, 253, 0.05)' // Vùng an toàn nhạt hơn
                    },
                    {
                        label: 'Giá trị đo',
                        data: dataMain,
                        borderColor: '#d63346',
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        zIndex: 10
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Biểu đồ dao động so với mức trung bình' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Tùy chỉnh tooltip cho dễ hiểu hơn
                                if (context.dataset.label.includes('Giới hạn')) {
                                    return context.dataset.label + ': ' + context.raw;
                                }
                                return 'Giá trị thực tế: ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: { suggestedMin: 20, suggestedMax: 45 }
                }
            }
        });

        // --- 3. BIỂU ĐỒ CHỈ SỐ ỔN ĐỊNH (Thay cho RSI) ---
        const dataStability = [45, 50, 60, 75, 70, 55, 45, 40, 50, 60, 65, 80, 85, 70];
        
        const ctxStability = document.getElementById('stabilityChart').getContext('2d');
        new Chart(ctxStability, {
            type: 'line',
            data: {
                labels: labelsAdv,
                datasets: [{
                    label: 'Mức độ ổn định',
                    data: dataStability,
                    borderColor: '#6610f2',
                    borderWidth: 1.5,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: 'rgba(102, 16, 242, 0.05)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        min: 0, max: 100,
                        ticks: { stepSize: 50 }, // Chỉ hiện 0, 50, 100
                        grid: {
                            color: function(context) {
                                if (context.tick.value === 30 || context.tick.value === 70) {
                                    return 'rgba(255, 0, 0, 0.2)'; // Vạch cảnh báo đỏ nhạt
                                }
                                return 'rgba(0, 0, 0, 0.05)';
                            }
                        }
                    }
                }
            }
        });
    });
</script>