<div class="pb-10">
    <div class="flex flex-col items-start justify-between gap-4 my-6 sm:flex-row sm:items-center">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tự động hóa hệ thống
        </h2>
        <a href="index.php?page=tudong-them" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
            <i class="fas fa-plus mr-2"></i>
            <span>Thêm kịch bản mới</span>
        </a>
    </div>

    <!-- Master switch - giữ nguyên -->
    <div class="p-5 mb-8 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center">
            <label class="flex items-center cursor-pointer relative mr-4">
                <input type="checkbox" id="masterAutoSwitch" class="sr-only peer">
                <div class="w-12 h-6 bg-gray-200 rounded-full peer-checked:bg-red-600 transition-all duration-300 dark:bg-gray-700 peer-focus:ring-2 peer-focus:ring-red-300"></div>
                <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-all duration-300 peer-checked:translate-x-6 shadow-sm"></div>
            </label>
            <div>
                <h4 class="font-bold text-gray-800 dark:text-gray-200">Chế độ Tự động hóa tổng</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Vô hiệu hóa toàn bộ luật điều khiển chỉ với 1 lần gạt</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        
        <!-- Card Theo Cảm biến -->
        <div class="min-w-0 p-5 bg-white rounded-xl shadow-sm dark:bg-gray-800 ">
            <div class="flex items-center justify-between mb-6">
                <h4 class="font-bold text-black-600 dark:text-white-400 flex items-center text-lg">
                    Theo Cảm biến
                </h4>
                
            </div>
            
            <div class="space-y-8">
                <!-- Automation item 1 -->
                <div class="automation-group group">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-700 dark:text-gray-200">Tự động làm mát kho</span>
                        <label class="flex items-center cursor-pointer relative">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-red-600 transition-all duration-300 peer-focus:ring-2 peer-focus:ring-red-300"></div>
                            <div class="absolute left-0.5 top-0.5 bg-white w-4 h-4 rounded-full transition-all duration-300 peer-checked:translate-x-5 shadow-sm"></div>
                        </label>
                    </div>
                    <div class="relative p-3 bg-gray-50 rounded-lg dark:bg-gray-700 border border-gray-100 dark:border-gray-600 flex items-center justify-between overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400 ml-2">NẾU Nhiệt độ <b class="text-red-600">> 30°C</b></span>
                        <i class="fas fa-arrow-right text-gray-300 text-xs"></i>
                        <span class="text-xs font-black text-green-600 uppercase"><i class="fas fa-fan mr-1"></i> BẬT Quạt</span>
                    </div>
                    <div class="flex justify-end mt-2 gap-4 opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <button class="text-[11px] font-bold text-gray-400 hover:text-blue-500 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-edit mr-1"></i>Thiết lập
                        </button>
                        <button class="text-[11px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-trash mr-1"></i>Gỡ bỏ
                        </button>
                    </div>
                </div>

                <!-- Automation item 2 -->
                <div class="automation-group group">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-700 dark:text-gray-200">Cấp ẩm tự động</span>
                        <label class="flex items-center cursor-pointer relative">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-red-600 transition-all duration-300 peer-focus:ring-2 peer-focus:ring-red-300"></div>
                            <div class="absolute left-0.5 top-0.5 bg-white w-4 h-4 rounded-full transition-all duration-300 peer-checked:translate-x-5 shadow-sm"></div>
                        </label>
                    </div>
                    <div class="relative p-3 bg-gray-50 rounded-lg dark:bg-gray-700 border border-gray-100 dark:border-gray-600 flex items-center justify-between overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400 ml-2">NẾU Độ ẩm <b class="text-blue-600">< 60%</b></span>
                        <i class="fas fa-arrow-right text-gray-300 text-xs"></i>
                        <span class="text-xs font-black text-blue-600 uppercase"><i class="fas fa-spray-can mr-1"></i> BẬT Phun sương</span>
                    </div>
                    <div class="flex justify-end mt-2 gap-4 opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <button class="text-[11px] font-bold text-gray-400 hover:text-blue-500 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-edit mr-1"></i>Thiết lập
                        </button>
                        <button class="text-[11px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-trash mr-1"></i>Gỡ bỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Lịch trình Hẹn giờ -->
        <div class="min-w-0 p-5 bg-white rounded-xl shadow-sm dark:bg-gray-800 ">
            <div class="flex items-center justify-between mb-6">
                <h4 class="font-bold text-black-500 dark:text-white-400 flex items-center text-lg">
                    Lịch trình Hẹn giờ
                </h4>
                
            </div>

            <div class="space-y-8">
                <div class="automation-group group">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-700 dark:text-gray-200">Bật đèn kho tối</span>
                        <label class="flex items-center cursor-pointer relative">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-red-600 transition-all duration-300 peer-focus:ring-2 peer-focus:ring-red-300"></div>
                            <div class="absolute left-0.5 top-0.5 bg-white w-4 h-4 rounded-full transition-all duration-300 peer-checked:translate-x-5 shadow-sm"></div>
                        </label>
                    </div>
                    <div class="flex items-baseline mb-2">
                        <span class="text-2xl font-black text-gray-800 dark:text-gray-100 mr-2">18:00</span>
                        <span class="text-xs font-bold text-gray-400 uppercase mr-3">đến</span>
                        <span class="text-2xl font-black text-gray-800 dark:text-gray-100">06:00</span>
                        <span class="ml-auto px-2 py-0.5 text-[9px] font-bold bg-gray-100 dark:bg-gray-700 text-gray-500 rounded uppercase">Hàng ngày</span>
                    </div>
                    <div class="p-3 bg-orange-50 dark:bg-gray-700 rounded-lg border border-orange-100 dark:border-gray-600">
                        <span class="text-xs font-black text-orange-700 dark:text-orange-300 uppercase"><i class="fas fa-lightbulb mr-1"></i> Kích hoạt: BẬT Đèn sưởi</span>
                    </div>
                    <div class="flex justify-end mt-2 gap-4 opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <button class="text-[11px] font-bold text-gray-400 hover:text-blue-500 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-edit mr-1"></i>Thiết lập
                        </button>
                        <button class="text-[11px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-tighter transition-colors duration-150">
                            <i class="fas fa-trash mr-1"></i>Gỡ bỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dot {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .peer:checked ~ .dot {
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    .automation-group {
        border-bottom: 1px solid rgba(0,0,0,0.03);
        padding-bottom: 0.5rem;
    }
    .automation-group:last-child {
        border-bottom: none;
    }
    .dark .automation-group {
        border-bottom-color: rgba(255,255,255,0.03);
    }
</style>