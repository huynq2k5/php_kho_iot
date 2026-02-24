<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center min-w-0">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 truncate">
            Hạ tầng thiết bị
        </h2>
    </div>
    
    <a href="index.php?page=thietbi_them" 
       class="flex-shrink-0 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
        <i class="fas fa-plus mr-2"></i>
        <span>Thêm Node mới</span>
    </a>
</div>

<div class="grid gap-6 mb-8 md:grid-cols-3">
    <!-- Có thể thêm stats cards ở đây nếu cần -->
</div>

<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs border border-gray-200 dark:border-gray-700">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Tên thiết bị</th>
                    <th class="px-4 py-3">Loại</th> <!-- THÊM CỘT LOẠI -->
                    <th class="px-4 py-3">Trạng thái</th>
                    <th class="px-4 py-3">Địa chỉ IP</th>
                    <th class="px-4 py-3 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block flex-shrink-0">
                                <div class="flex items-center justify-center w-full h-full rounded-full bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-200">
                                    <i class="fas fa-microchip"></i>
                                </div>
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold truncate">Node_Sensor_01</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Khu vực A</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">ESP32 DevKit</td> <!-- THÊM DỮ LIỆU LOẠI -->
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Online
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-mono">192.168.1.50</td>
                    <td class="px-4 py-3 text-sm text-right">
                        <button class="px-3 py-1 text-xs font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-red hover:bg-red-100 dark:hover:bg-red-900 transition-colors duration-150">
                            <i class="fas fa-tools mr-1"></i> Cấu hình
                        </button>
                    </td>
                </tr>
                <!-- Thêm row thứ 2 để test -->
                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block flex-shrink-0">
                                <div class="flex items-center justify-center w-full h-full rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                    <i class="fas fa-wifi"></i>
                                </div>
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold truncate">Gateway_Chinh</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Khu vực B</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">Raspberry Pi 4</td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-600 dark:text-yellow-100">
                            Pending
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-mono">192.168.1.1</td>
                    <td class="px-4 py-3 text-sm text-right">
                        <a class="px-3 py-1 text-xs font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-red hover:bg-red-100 dark:hover:bg-red-900 transition-colors duration-150"
                            href="index.php?page=thietbi_config">
                            <i class="fas fa-tools mr-1"></i> Cấu hình
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination chuẩn Windmill -->
    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">Hiển thị 1-2 trên 10</span>
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
                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-red">8</button>
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