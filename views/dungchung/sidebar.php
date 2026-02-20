<?php 
// Lấy tên trang hiện tại từ URL để active menu
$currentPage = $_GET['page'] ?? 'dashboard';
?>

<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center" href="index.php?page=dashboard">
            <img src="img/kho_iot_logo.png" class="w-8 h-8 mr-3 object-contain" alt="Logo">
            <span>IoT Warehouse</span>
        </a>
        
        <!-- Main Menu -->
        <ul class="mt-6">
            <!-- Dashboard - Tổng quan -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'dashboard'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'dashboard' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=dashboard">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Tổng quan</span>
                </a>
            </li>

            <!-- Phân tích -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'phantich'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'phantich' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=phantich">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="ml-4">Phân tích</span>
                </a>
            </li>

            <!-- Tự động hoá -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'tudong'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'tudong' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=tudong">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Tự động hoá</span>
                </a>
            </li>

            <!-- Thiết bị -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'thietbi'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'thietbi' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=thietbi">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Thiết bị</span>
                </a>
            </li>

            <!-- Cảnh báo và Nhật ký -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'alert_log'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'alert_log' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=alert_log">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Cảnh báo và nhật ký</span>
                </a>
            </li>

            <!-- Người dùng -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'users'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'users' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=users">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="ml-4">Người dùng</span>
                </a>
            </li>
        </ul>

    </div>
</aside>

<!-- Backdrop for mobile -->
<div x-show="isSideMenuOpen" 
     x-transition:enter="transition ease-in-out duration-150"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in-out duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
</div>

<!-- Mobile sidebar -->
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
       x-show="isSideMenuOpen"
       x-transition:enter="transition ease-in-out duration-150"
       x-transition:enter-start="opacity-0 transform -translate-x-20"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in-out duration-150"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0 transform -translate-x-20"
       @click.away="closeSideMenu"
       @keydown.escape="closeSideMenu">
    
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <!-- Logo -->
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center" href="index.php?page=dashboard">
            <img src="img/kho_iot_logo.png" class="w-8 h-8 mr-3 object-contain" alt="Logo">
            <span>IoT Warehouse</span>
        </a>
        
        <!-- Mobile Menu - Copy đầy đủ từ desktop sidebar -->
        <ul class="mt-6">
            <!-- Dashboard - Tổng quan -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'dashboard'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'dashboard' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=dashboard">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="ml-4">Tổng quan</span>
                </a>
            </li>

            <!-- Phân tích -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'phantich'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'phantich' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=phantich">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="ml-4">Phân tích</span>
                </a>
            </li>

            <!-- Tự động hoá -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'tudong'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'tudong' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=tudong">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Tự động hoá</span>
                </a>
            </li>

            <!-- Thiết bị -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'thietbi'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'thietbi' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=thietbi">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Thiết bị</span>
                </a>
            </li>
            
            <!-- Cảnh báo -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'alert_log'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'alert_log' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=alert_log">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="ml-4">Cảnh báo và Nhật ký</span>
                </a>
            </li>

            <!-- Người dùng -->
            <li class="relative px-6 py-3">
                <?php if ($currentPage == 'users'): ?>
                    <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                <?php endif; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?php echo $currentPage == 'users' ? 'text-gray-800 dark:text-gray-100' : '' ?>" href="index.php?page=users">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="ml-4">Người dùng</span>
                </a>
            </li>
        </ul>
    </div>
</aside>