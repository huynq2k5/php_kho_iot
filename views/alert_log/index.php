
    <!-- Header với tiêu đề và nút chức năng -->
    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Cảnh báo và Nhật ký hệ thống
        </h2>
        <div class="flex gap-2">
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-red-700 transition-colors duration-150 bg-red-100 border border-transparent rounded-lg hover:bg-red-200 focus:outline-none focus:shadow-outline-red dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50">
                <i class="fas fa-trash-alt mr-2"></i> Xóa lịch sử cũ
            </button>
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-blue-700 transition-colors duration-150 bg-blue-100 border border-transparent rounded-lg hover:bg-blue-200 focus:outline-none focus:shadow-outline-red dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                <i class="fas fa-file-export mr-2"></i> Xuất báo cáo
            </button>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-12">
        
        <!-- Cột trái: Cảnh báo môi trường (5/12) -->
        <div class="md:col-span-5">
            <div class="min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full flex flex-col">
                <!-- Card header -->
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                        
                        Cảnh báo môi trường
                    </h4>
                    
                </div>
                
                <!-- Card body - list warnings -->
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Warning 1 - Đỏ (khẩn cấp) -->
                    <div class="relative px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 border-l-4 border-red-600">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Nhiệt độ quá cao!</h5>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    Giá trị đo được: <span class="font-bold text-red-600">35.5°C</span> (Ngưỡng: 30°C)
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    <i class="far fa-clock mr-1"></i>2 phút trước
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                Khẩn cấp
                            </span>
                        </div>
                    </div>

                    <!-- Warning 2 - Vàng (cảnh báo) -->
                    <div class="relative px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 border-l-4 border-yellow-500">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h5 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Độ ẩm quá thấp</h5>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    Giá trị đo được: <span class="font-bold text-yellow-600">45%</span> (Ngưỡng: 55%)
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    <i class="far fa-clock mr-1"></i>15 phút trước
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-600 dark:text-yellow-100">
                                Cảnh báo
                            </span>
                        </div>
                    </div>

                    <!-- Warning 3 - Xanh (đã ổn định) -->
                    <div class="relative px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 border-l-4 border-green-600 opacity-75">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h5 class="text-sm font-semibold text-green-600 dark:text-green-400">CO2 đã ổn định</h5>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    Giá trị hiện tại: 420 ppm
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    <i class="far fa-clock mr-1"></i>1 giờ trước
                                </p>
                            </div>
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Card footer -->
                <div class="px-4 py-3 text-center border-t border-gray-200 dark:border-gray-700">
                    <a href="#" class="text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                        Xem tất cả cảnh báo
                    </a>
                </div>
            </div>
        </div>

        <!-- Cột phải: Nhật ký vận hành (7/12) -->
        <div class="md:col-span-7">
            <div class="min-w-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full flex flex-col">
                <!-- Card header -->
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300 flex items-center">
                        
                        Nhật ký vận hành (Audit Log)
                    </h4>
                </div>

                <!-- Table -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Thời gian</th>
                                <th class="px-4 py-3">Người dùng</th>
                                <th class="px-4 py-3">Hành động</th>
                                <th class="px-4 py-3">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono">21:45:10</td>
                                <td class="px-4 py-3 text-sm font-medium">Admin (Huy)</td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                        Điều khiển
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Bật <span class="font-semibold text-gray-800 dark:text-gray-200">Quạt thông gió</span> thủ công
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono">21:30:05</td>
                                <td class="px-4 py-3 text-sm font-medium">Huy Nguyen</td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-600 dark:text-yellow-100">
                                        Cấu hình
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Sửa ngưỡng nhiệt độ: <span class="line-through text-gray-500">30</span> 
                                    <span class="font-semibold text-gray-800 dark:text-gray-200">32.5</span>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono">21:00:00</td>
                                <td class="px-4 py-3 text-sm font-medium text-green-600">Hệ thống</td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-cyan-700 bg-cyan-100 rounded-full dark:bg-cyan-700 dark:text-cyan-100">
                                        Tự động
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Kích hoạt kịch bản: <span class="font-semibold text-gray-800 dark:text-gray-200">Tưới nước sáng</span>
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono">20:45:22</td>
                                <td class="px-4 py-3 text-sm font-medium">Admin (Huy)</td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-100">
                                        Đăng nhập
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Truy cập từ IP: 192.168.1.15
                                </td>
                            </tr>
                            <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-4 py-3 text-sm font-mono">19:20:11</td>
                                <td class="px-4 py-3 text-sm font-medium">Nhan vien A</td>
                                <td class="px-4 py-3 text-xs">
                                    <span class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                        Điều khiển
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Tắt <span class="font-semibold text-gray-800 dark:text-gray-200">Đèn sưởi</span> thủ công
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Card footer với phân trang -->
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">Hiển thị 5 / 100 dòng mới nhất</span>
                    <span class="col-span-2"></span>
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                <li>
                                    <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-red" aria-label="Previous">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 text-white transition-colors duration-150 bg-red-600 border border-r-0 border-red-600 rounded-md focus:outline-none focus:shadow-outline-red">1</button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red">2</button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red">3</button>
                                </li>
                                <li>
                                    <span class="px-3 py-1">...</span>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-red" aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </span>
                </div>
            </div>
        </div>

    </div>
