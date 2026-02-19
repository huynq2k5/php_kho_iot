<div>
    <!-- Header với nút quay lại -->
    <div class="flex items-center justify-between my-6">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Cấu hình Node: <span class="text-red-600 dark:text-red-400">Node_Sensor_01</span>
        </h2>
        <a href="index.php?page=thietbi" 
           class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-chevron-left mr-2"></i> Quay lại
        </a>
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-12">
        
        <!-- Cột chính: Cấu hình MQTT -->
        <div class="md:col-span-7">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <!-- Card header -->
                <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="fas fa-network-wired text-red-600 dark:text-red-400 mr-2"></i>
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông số kết nối MQTT</h4>
                </div>

                <form action="" method="POST" class="space-y-4">
                    <!-- Hàng 2 cột -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">MQTT Broker (Host)</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   type="text" value="broker.hivemq.com">
                        </label>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Cổng (Port)</span>
                            <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   type="number" value="1883">
                        </label>
                    </div>

                    <!-- Topic MQTT -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Topic MQTT</span>
                        <input class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                               type="text" value="vlu/kho_iot/sensor01">
                    </label>

                    <!-- Tần suất với đơn vị -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Tần suất gửi dữ liệu</span>
                        <div class="relative mt-1">
                            <input class="block w-full pr-20 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                   type="number" value="30">
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none bg-gray-100 dark:bg-gray-700 rounded-r-md border-l dark:border-gray-600">
                                <span class="text-xs text-gray-500 dark:text-gray-400">giây/lần</span>
                            </div>
                        </div>
                    </label>

                    <!-- Nút submit -->
                    <div class="pt-4 flex justify-end">
                        <button type="submit" 
                                class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            <i class="fas fa-save mr-2"></i> Lưu cấu hình
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Cột phụ: Thông tin phần cứng và Vùng nguy hiểm -->
        <div class="md:col-span-5 space-y-6">
            
            <!-- Card thông tin phần cứng -->
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <i class="fas fa-microchip text-gray-500 dark:text-gray-400 mr-2"></i>
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin phần cứng</h4>
                </div>
                
                <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                    <li class="py-3 flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Phiên bản Firmware:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200 px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded border dark:border-gray-600">v2.1.0-stable</span>
                    </li>
                    <li class="py-3 flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Flash trống:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">1.2 MB</span>
                    </li>
                    <li class="py-3 flex justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Thời gian chạy (Uptime):</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">05 ngày 12 giờ</span>
                    </li>
                </ul>
            </div>

            <!-- Card vùng nguy hiểm -->
            <div class="p-4 bg-red-50 rounded-lg shadow-xs border border-red-200 dark:bg-red-900/20 dark:border-red-800">
                <h4 class="mb-2 font-semibold text-red-700 dark:text-red-400 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Vùng nguy hiểm
                </h4>
                <p class="text-xs text-red-600 dark:text-red-400 mb-4 opacity-80">
                    Các thao tác này sẽ can thiệp trực tiếp vào bộ nhớ thiết bị. Hãy thận trọng!
                </p>
                
                <div class="space-y-3">
                    <button class="w-full px-4 py-2 text-xs font-medium text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 focus:outline-none focus:shadow-outline-red transition-colors duration-150 dark:bg-transparent dark:text-red-400 dark:border-red-700 dark:hover:bg-red-900/30">
                        <i class="fas fa-redo mr-2"></i> Khởi động lại Node
                    </button>
                    <button class="w-full px-4 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red transition-colors duration-150 dark:bg-red-700 dark:hover:bg-red-800">
                        <i class="fas fa-broom mr-2"></i> Reset Factory (Xóa trắng)
                    </button>
                </div>
            </div>

            <!-- Thêm thông tin trạng thái online -->
            <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900/20 dark:border-green-800">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                <span class="text-xs font-medium text-green-700 dark:text-green-400">Thiết bị đang hoạt động - Last seen: vừa xong</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Đảm bảo form-input tuân thủ shadow màu đỏ */
    .focus\:shadow-outline-red:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.45);
    }
    
    /* Dark mode focus shadow */
    .dark .dark\:focus\:shadow-outline-gray:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    }
    
    /* Animation cho pulse */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>