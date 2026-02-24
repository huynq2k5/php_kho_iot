<!-- ĐẶT TRONG MAIN - Layout chuẩn cho cả 2 tab -->

        
        <!-- Header chung cho cả 2 tab -->
        <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Thêm kịch bản tự động mới
            </h2>
            <a href="index.php?page=tudong" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500 flex-shrink-0">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
        </div>

        <!-- Card container chung cho cả 2 tab -->
        <div class="w-full max-w-3xl mx-auto">
            <div class="min-w-0 p-6 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                
                <!-- Tab Navigation -->
                <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="scriptTabs" role="tablist">
                        <li class="mr-2">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg transition-colors duration-150 active-tab" 
                                    id="sensor-tab" 
                                    data-tab="sensor"
                                    onclick="switchTab('sensor')">
                                <i class="fas fa-temperature-high text-red-600 mr-2"></i> Theo cảm biến
                            </button>
                        </li>
                        <li class="mr-2">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 transition-colors duration-150" 
                                    id="timer-tab" 
                                    data-tab="timer"
                                    onclick="switchTab('timer')">
                                <i class="fas fa-clock text-yellow-600 mr-2"></i> Theo thời gian
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <form action="" method="POST" class="space-y-6">
                    
                    <!-- Tên kịch bản - CHUNG cho cả 2 tab -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">1. Tên kịch bản</span>
                        <input type="text" 
                               class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                               placeholder="Ví dụ: Tự động bật quạt khi nóng">
                    </label>

                    <!-- TAB 1: Sensor Form -->
                    <div id="sensor-tab-content" class="tab-content space-y-4">
                        <!-- Card điều kiện cảm biến -->
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <h6 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">THIẾT LẬP ĐIỀU KIỆN (NẾU...)</h6>
                            
                            <div class="grid gap-3 md:grid-cols-12">
                                <!-- Chọn cảm biến -->
                                <div class="md:col-span-4">
                                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Chọn cảm biến</label>
                                    <select class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-select focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10">
                                        <option value="temp">Nhiệt độ</option>
                                        <option value="hum">Độ ẩm</option>
                                        <option value="co2">CO2</option>
                                    </select>
                                </div>
                                <!-- So sánh -->
                                <div class="md:col-span-3">
                                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">So sánh</label>
                                    <select class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-select focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10">
                                        <option value=">">Lớn hơn (>)</option>
                                        <option value="<">Nhỏ hơn (<)</option>
                                    </select>
                                </div>
                                <!-- Giá trị ngưỡng -->
                                <div class="md:col-span-5">
                                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Giá trị ngưỡng</label>
                                    <div class="relative">
                                        <input type="number" class="block w-full pr-16 text-sm dark:bg-gray-800 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10" placeholder="30">
                                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none bg-gray-100 dark:bg-gray-700 rounded-r-md border-l dark:border-gray-600 h-10">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">đơn vị</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: Timer Form (ẩn mặc định) -->
                    <div id="timer-tab-content" class="tab-content space-y-4 hidden">
                        <!-- Card điều kiện thời gian -->
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <h6 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">THIẾT LẬP ĐIỀU KIỆN (NẾU...)</h6>
                            
                            <div class="space-y-4">
                                <!-- Giờ bắt đầu và kết thúc -->
                                <div class="grid gap-3 md:grid-cols-2">
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Giờ Bắt đầu (Bật)</label>
                                        <input type="time" class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10" value="08:00">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Giờ Kết thúc (Tắt)</label>
                                        <input type="time" class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10" value="17:00">
                                    </div>
                                </div>
                                
                                <!-- Lặp lại các thứ -->
                                <div>
                                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-2">Lặp lại vào các thứ:</label>
                                    <div class="flex flex-wrap gap-1">
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T2
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T3
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T4
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T5
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T6
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> T7
                                        </label>
                                        <label class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50 has-[:checked]:bg-red-600 has-[:checked]:text-white has-[:checked]:border-red-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:has-[:checked]:bg-red-600 dark:has-[:checked]:text-white transition-colors duration-150">
                                            <input type="checkbox" class="sr-only peer"> CN
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card hành động - CHUNG cho cả 2 tab -->
                    <div class="p-4 bg-white rounded-lg border border-green-200 dark:bg-gray-800 dark:border-green-800">
                        <h6 class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-3">HÀNH ĐỘNG THỰC THI (THÌ...)</h6>
                        <div class="grid gap-3 md:grid-cols-2">
                            <div>
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Chọn thiết bị</label>
                                <select class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-select focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray h-10">
                                    <option value="fan">Quạt thông gió</option>
                                    <option value="pump">Máy phun sương</option>
                                    <option value="light">Đèn</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Hành động</label>
                                <select class="block w-full text-sm dark:bg-gray-800 dark:text-gray-300 form-select focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray font-semibold text-red-600 h-10">
                                    <option value="ON">BẬT (ON)</option>
                                    <option value="OFF">TẮT (OFF)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="index.php?page=tudong" 
                           class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
                            Hủy bỏ
                        </a>
                        <button type="submit" 
                                class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
                            <i class="fas fa-save mr-2"></i> Lưu Kịch Bản
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <!-- </div>
</main> -->

<script>
    function switchTab(tab) {
        // Ẩn tất cả tab content
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Hiện tab được chọn
        document.getElementById(tab + '-tab-content').classList.remove('hidden');
        
        // Update active tab styling
        document.querySelectorAll('[id$="-tab"]').forEach(el => {
            el.classList.remove('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
            el.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
        });
        
        const activeTab = document.getElementById(tab + '-tab');
        activeTab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
        activeTab.classList.add('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
    }
    
    // Khởi tạo tab đầu tiên
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('sensor');
    });
</script>