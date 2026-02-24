
    <!-- Header với tiêu đề và nút quay lại -->
    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Thêm người dùng
            </h2>
            
        </div>
        
        <a href="index.php?page=users" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-chevron-left mr-2"></i> Quay lại
        </a>
    </div>

    <form action="" method="POST">
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            
            <!-- Cột trái: Thông tin cá nhân -->
            <div class="md:col-span-1">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Card header -->
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="p-2 mr-2 bg-red-100 rounded-full dark:bg-red-900">
                            <i class="fas fa-id-card text-red-600 dark:text-red-400"></i>
                        </div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin cá nhân</h4>
                    </div>
                    
                    <!-- Card body -->
                    <div class="space-y-4">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-start">
                            
                            <!-- Avatar upload -->
                            <div class="text-center mx-auto xl:mx-0">
                                <div class="relative inline-block">
                                    <div class="flex items-center justify-center w-28 h-28 bg-gray-100 rounded-full border-2 border-dashed border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                        <i class="fas fa-camera text-2xl text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <button type="button" 
                                            class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 text-white bg-red-600 rounded-full border-2 border-white shadow-sm hover:bg-red-700 focus:outline-none focus:shadow-outline-red dark:border-gray-800">
                                        <i class="fas fa-pen text-xs"></i>
                                    </button>
                                </div>
                                <div class="mt-2 text-xs font-medium text-gray-500 dark:text-gray-400">Ảnh đại diện</div>
                            </div>

                            <!-- Form fields -->
                            <div class="flex-1 w-full space-y-3">
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400 font-medium">Họ và tên <span class="text-red-600">*</span></span>
                                    <input type="text" id="fullname" 
                                        class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                        placeholder="VD: Nguyễn Văn A" 
                                        required>
                                    <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="fullname_error">Họ tên không được để trống</span>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400 font-medium">Số điện thoại</span>
                                    <input type="text" id="phone" 
                                        class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                        placeholder="09xxxxxxx">
                                    <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="phone_error">SĐT không hợp lệ</span>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400 font-medium">Địa chỉ liên hệ</span>
                                    <textarea rows="2" 
                                            class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-textarea focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                            placeholder="VD: 123 Đường ABC..."></textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Tài khoản & Phân quyền -->
            <div class="md:col-span-1">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Card header -->
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="p-2 mr-2 bg-green-100 rounded-full dark:bg-green-900">
                            <i class="fas fa-user-shield text-green-600 dark:text-green-400"></i>
                        </div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Tài khoản & Phân quyền</h4>
                    </div>
                    
                    <!-- Card body -->
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-2">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium">Email đăng nhập <span class="text-red-600">*</span></span>
                                <input type="email" id="email" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" placeholder="email@example.com" required>
                                <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="email_error">Email không hợp lệ</span>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium">Mật khẩu khởi tạo <span class="text-red-600">*</span></span>
                                <div class="relative mt-1">
                                    <input type="password" 
                                           class="block w-full pr-10 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray font-mono" 
                                           value="12345678">
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </label>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium uppercase text-xs tracking-wider">Nhóm quyền (Role)</span>
                                <select id="role" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-select focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                        name="role_id" required>
                                    <option value="" disabled selected>-- Chọn nhóm --</option>
                                    <option value="1">Ban quản trị (Admin)</option>
                                    <option value="2">Vận hành viên (Staff)</option>
                                    <option value="3">Người xem (Viewer)</option>
                                </select>
                                <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="role_error">Vui lòng chọn nhóm quyền</span>
                            </label>

                            <div class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium uppercase text-xs tracking-wider">Trạng thái</span>
                                <div class="flex items-center justify-between p-3 mt-1 bg-gray-100 rounded-lg dark:bg-gray-700">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Kích hoạt ngay</span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-red-600 peer-focus:ring-2 peer-focus:ring-red-300 dark:bg-gray-600 transition-all duration-300"></div>
                                        <div class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-all duration-300"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <i class="fas fa-info-circle mr-1 text-red-500"></i> Nhóm quyền sẽ quyết định các menu được hiển thị.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form actions -->
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <button type="reset" 
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
                <i class="fas fa-undo mr-2"></i> Làm mới
            </button>
            <button type="submit" 
                    class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
                <i class="fas fa-save mr-2"></i> Lưu & Tạo mới
            </button>
        </div>
    </form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const fullname = document.getElementById('fullname');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const role = document.getElementById('role');

    // Hàm validate
    function validateFullname() {
        const error = document.getElementById('fullname_error');
        if (!fullname.value.trim()) {
            fullname.classList.add('border-red-600', 'input-invalid');
            error.classList.remove('hidden');
            return false;
        } else {
            fullname.classList.remove('border-red-600', 'input-invalid');
            fullname.classList.add('border-green-600', 'input-valid');
            error.classList.add('hidden');
            return true;
        }
    }

    function validateEmail() {
        const error = document.getElementById('email_error');
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(email.value)) {
            email.classList.add('border-red-600', 'input-invalid');
            error.classList.remove('hidden');
            return false;
        } else {
            email.classList.remove('border-red-600', 'input-invalid');
            email.classList.add('border-green-600', 'input-valid');
            error.classList.add('hidden');
            return true;
        }
    }

    function validatePhone() {
        const error = document.getElementById('phone_error');
        const regex = /^(0[3|5|7|8|9])[0-9]{8}$/;
        if (phone.value && !regex.test(phone.value)) {
            phone.classList.add('border-red-600', 'input-invalid');
            error.classList.remove('hidden');
            return false;
        } else {
            phone.classList.remove('border-red-600', 'input-invalid');
            if (phone.value) phone.classList.add('border-green-600', 'input-valid');
            error.classList.add('hidden');
            return true;
        }
    }

    function validateRole() {
        const error = document.getElementById('role_error');
        if (!role.value) {
            role.classList.add('border-red-600', 'input-invalid');
            error.classList.remove('hidden');
            return false;
        } else {
            role.classList.remove('border-red-600', 'input-invalid');
            role.classList.add('border-green-600', 'input-valid');
            error.classList.add('hidden');
            return true;
        }
    }

    // Gán sự kiện
    fullname.addEventListener('input', validateFullname);
    email.addEventListener('input', validateEmail);
    phone.addEventListener('input', validatePhone);
    role.addEventListener('change', validateRole);

    // Validate khi submit
    form.addEventListener('submit', function(e) {
        const isValid = validateFullname() & validateEmail() & validatePhone() & validateRole();
        if (!isValid) {
            e.preventDefault();
            alert('Vui lòng kiểm tra lại thông tin!');
        }
    });
});
</script>
<style>
    .input-invalid {
        border-color: #dc2626 !important;
    }
    .input-valid {
        border-color: #16a34a !important;
    }
    .dark .input-invalid {
        border-color: #ef4444 !important;
    }
    .dark .input-valid {
        border-color: #4ade80 !important;
    }
</style>
