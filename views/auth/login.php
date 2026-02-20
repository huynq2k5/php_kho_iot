<div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" 
                 src="img/login-office.jpeg" alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" 
                 src="img/login-office.jpeg" alt="Office" />
        </div>
        
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    Đăng nhập hệ thống
                </h1>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="flex items-center justify-between p-4 mb-4 text-sm font-semibold text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span><?= $_SESSION['error']; ?></span>
                        </div>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                
                <form action="index.php?page=auth_xuly_dangnhap" method="POST">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Tên đăng nhập (Email)</span>
                        <input name="username" 
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:text-gray-300 form-input" 
                               placeholder="admin@gmail.com" required />
                    </label>
                    
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mật khẩu</span>
                        <input name="password" 
                               class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:text-gray-300 form-input" 
                               placeholder="***************" type="password" required />
                    </label>

                    <button type="submit" 
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                        Đăng nhập
                    </button>
                </form>

                <hr class="my-8" />

                <p class="mt-4">
                    <a class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline" href="index.php?page=auth_forgot">
                        Quên mật khẩu?
                    </a>
                </p>
                
            </div>
        </div>
    </div>
</div>