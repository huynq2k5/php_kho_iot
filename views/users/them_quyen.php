
    <!-- Header với tiêu đề và nút quay lại -->
    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Thêm quyền hạn
            </h2>
            
        </div>
        
        <a href="index.php?page=users&tab=permissions" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-chevron-left mr-2"></i> Quay lại
        </a>
    </div>

    <form action="index.php?page=quyen_xulythem" method="POST">
        <div class="grid gap-6 mb-8 md:grid-cols-12">
            
            <!-- Cột trái: Thông tin quyền hạn (chiếm 7/12) -->
            <div class="md:col-span-7">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Card header -->
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin quyền hạn</h4>
                    </div>
                    
                    <!-- Card body -->
                    <div class="space-y-4">
                        <!-- Mã quyền (Permission Key) -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Mã quyền (Permission Key) <span class="text-red-600">*</span></span>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-code text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       id="permissionKey"
                                       name="permission_key" 
                                       class="block w-full pl-10 pr-3 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray font-mono" 
                                       placeholder="module.action" 
                                       required>
                            </div>
                            <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="permissionKey_error">Mã quyền không hợp lệ</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="permissionKey_helper">
                                <i class="fas fa-info-circle mr-1"></i> Key dùng để check trong code: <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">if ($user->can('device.create'))</code>
                            </span>
                        </label>

                        <!-- Hàng 2 cột: Tên hiển thị và Module -->
                        <div class="grid gap-4 md:grid-cols-1">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium">Tên hiển thị <span class="text-red-600">*</span></span>
                                <input type="text" 
                                       id="permissionName"
                                       name="permission_name" 
                                       class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                       placeholder="VD: Thêm thiết bị mới" 
                                       required>
                                <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="permissionName_error">Tên hiển thị không được để trống</span>
                            </label>
                            
                        </div>

                        <!-- Mô tả chi tiết -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Mô tả chi tiết</span>
                            <textarea id="description" name="description" rows="3" 
                                      class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-textarea focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                      placeholder="Mô tả chức năng này làm gì..."></textarea>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Quy tắc đặt tên (chiếm 5/12) -->
            <div class="md:col-span-5">
                <div class="min-w-0 p-4 bg-gray-50 rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Card header -->
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Quy tắc đặt tên</h4>
                    </div>
                    
                    <!-- Card body -->
                    <div class="space-y-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Để hệ thống đồng bộ, vui lòng đặt <span class="font-semibold">Mã quyền</span> theo cấu trúc:
                        </p>
                        
                        <div class="p-4 bg-white border-2 border-dashed border-gray-300 rounded-lg text-center dark:bg-gray-700 dark:border-gray-600">
                            <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 font-mono">resource.action</h4>
                        </div>

                        <div class="space-y-3">
                            <!-- Đúng 1 -->
                            <div class="flex items-start">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100 mr-2 mt-0.5">
                                    Đúng
                                </span>
                                <div>
                                    <div class="font-mono font-semibold text-gray-800 dark:text-gray-200">device.create</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Rõ ràng: Tài nguyên + Hành động</div>
                                </div>
                            </div>
                            
                            <!-- Đúng 2 -->
                            <div class="flex items-start">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100 mr-2 mt-0.5">
                                    Đúng
                                </span>
                                <div>
                                    <div class="font-mono font-semibold text-gray-800 dark:text-gray-200">report.export_excel</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Hành động cụ thể</div>
                                </div>
                            </div>
                            
                            <!-- Sai -->
                            <div class="flex items-start">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100 mr-2 mt-0.5">
                                    Sai
                                </span>
                                <div>
                                    <div class="font-mono font-semibold text-gray-800 dark:text-gray-200">ThemNguoiDungMoi</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Không dùng Tiếng Việt, CamelCase</div>
                                </div>
                            </div>
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
                <i class="fas fa-save mr-2"></i> Lưu quyền mới
            </button>
        </div>
    </form>


<!-- VALIDATE SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const permissionKey = document.getElementById('permissionKey');
    const permissionName = document.getElementById('permissionName');
    
    // Span errors
    const permissionKeyError = document.getElementById('permissionKey_error');
    const permissionNameError = document.getElementById('permissionName_error');
    const permissionKeyHelper = document.getElementById('permissionKey_helper');

    // Validate Permission Key
    function validatePermissionKey() {
        const value = permissionKey.value.trim();
        
        // Rule: Không được để trống
        if (!value) {
            permissionKey.classList.add('border-red-600', 'input-invalid');
            permissionKey.classList.remove('border-green-600', 'input-valid');
            permissionKeyError.classList.remove('hidden');
            permissionKeyError.textContent = '❌ Mã quyền không được để trống';
            if (permissionKeyHelper) permissionKeyHelper.classList.add('hidden');
            return false;
        }
        // Rule: Không dấu cách
        else if (value.includes(' ')) {
            permissionKey.classList.add('border-red-600', 'input-invalid');
            permissionKey.classList.remove('border-green-600', 'input-valid');
            permissionKeyError.classList.remove('hidden');
            permissionKeyError.textContent = '❌ Mã quyền không được chứa dấu cách';
            if (permissionKeyHelper) permissionKeyHelper.classList.add('hidden');
            return false;
        }
        // Rule: Phải có dạng resource.action (chứa dấu chấm)
        else if (!value.includes('.')) {
            permissionKey.classList.add('border-red-600', 'input-invalid');
            permissionKey.classList.remove('border-green-600', 'input-valid');
            permissionKeyError.classList.remove('hidden');
            permissionKeyError.textContent = '❌ Phải có dạng "resource.action" (chứa dấu chấm)';
            if (permissionKeyHelper) permissionKeyHelper.classList.add('hidden');
            return false;
        }
        // Rule: Chỉ cho phép chữ thường, số, dấu chấm, gạch dưới
        else if (!/^[a-z0-9._]+$/.test(value)) {
            permissionKey.classList.add('border-red-600', 'input-invalid');
            permissionKey.classList.remove('border-green-600', 'input-valid');
            permissionKeyError.classList.remove('hidden');
            permissionKeyError.textContent = '❌ Chỉ chấp nhận chữ thường, số, dấu chấm (.) và gạch dưới (_)';
            if (permissionKeyHelper) permissionKeyHelper.classList.add('hidden');
            return false;
        }
        // Hợp lệ
        else {
            permissionKey.classList.remove('border-red-600', 'input-invalid');
            permissionKey.classList.add('border-green-600', 'input-valid');
            permissionKeyError.classList.add('hidden');
            if (permissionKeyHelper) {
                permissionKeyHelper.classList.remove('hidden');
                permissionKeyHelper.classList.add('text-green-600', 'dark:text-green-400');
                permissionKeyHelper.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Mã quyền hợp lệ';
            }
            return true;
        }
    }

    // Validate Permission Name
    function validatePermissionName() {
        const value = permissionName.value.trim();
        
        if (!value) {
            permissionName.classList.add('border-red-600', 'input-invalid');
            permissionName.classList.remove('border-green-600', 'input-valid');
            permissionNameError.classList.remove('hidden');
            permissionNameError.textContent = '❌ Tên hiển thị không được để trống';
            return false;
        } else if (value.length < 3) {
            permissionName.classList.add('border-red-600', 'input-invalid');
            permissionName.classList.remove('border-green-600', 'input-valid');
            permissionNameError.classList.remove('hidden');
            permissionNameError.textContent = '❌ Tên hiển thị phải có ít nhất 3 ký tự';
            return false;
        } else {
            permissionName.classList.remove('border-red-600', 'input-invalid');
            permissionName.classList.add('border-green-600', 'input-valid');
            permissionNameError.classList.add('hidden');
            return true;
        }
    }

    // Tự động chuyển sang chữ thường cho permission key
    if (permissionKey) {
        permissionKey.addEventListener('input', function(e) {
            this.value = this.value.toLowerCase();
            validatePermissionKey();
        });
        permissionKey.addEventListener('blur', validatePermissionKey);
    }

    // Validate tên hiển thị
    if (permissionName) {
        permissionName.addEventListener('input', validatePermissionName);
        permissionName.addEventListener('blur', validatePermissionName);
    }

    // Validate form khi submit
    if (form) {
        form.addEventListener('submit', function(e) {
            const isKeyValid = permissionKey ? validatePermissionKey() : true;
            const isNameValid = permissionName ? validatePermissionName() : true;
            
            if (!isKeyValid || !isNameValid) {
                e.preventDefault();
                
                if (!isKeyValid && permissionKey) permissionKey.focus();
                else if (!isNameValid && permissionName) permissionName.focus();
                
                alert('Vui lòng kiểm tra lại các trường bị lỗi!');
            }
        });
    }

    // Validate lần đầu khi load
    if (permissionKey) {
        validatePermissionKey();
        permissionKey.value = permissionKey.value.toLowerCase();
    }
    if (permissionName) validatePermissionName();
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
    .focus\:shadow-outline-red:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.45);
    }
    .dark .dark\:focus\:shadow-outline-gray:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    }
    code {
        font-family: monospace;
    }
</style>