
    <!-- Header với tiêu đề và nút quay lại -->
    <div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Sửa quyền hạn: <span class="text-red-600">device.create</span>
            </h2>
            
        </div>
        
        <a href="index.php?page=users&tab=permissions" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-chevron-left mr-2"></i> Quay lại
        </a>
    </div>

    <form action="index.php?page=quyen_xulycapnhat" method="POST">
        <!-- Hidden fields -->
        <input type="hidden" name="id" value="<?= $permission['id'] ?>">
        <input type="hidden" name="original_key" value="<?= $permission['maQuyen'] ?>">
        
        <div class="grid gap-6 mb-8 md:grid-cols-12">
            
            <!-- Cột trái: Thông tin quyền hạn -->
            <div class="md:col-span-7">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Card header -->
                    <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                        
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin quyền hạn</h4>
                    </div>
                    
                    <!-- Card body -->
                    <div class="space-y-4">
                        <!-- Mã quyền (Permission Key) - DISABLED -->
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Mã quyền (Permission Key) <span class="text-red-600">*</span></span>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-code text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       value="<?= $permission['maQuyen'] ?>" 
                                       class="block w-full pl-10 pr-3 text-sm dark:bg-gray-700 dark:text-gray-300 form-input bg-gray-100 dark:bg-gray-600 cursor-not-allowed opacity-75 font-mono" 
                                       disabled
                                       readonly>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                <i class="fas fa-lock mr-1"></i> Mã quyền không thể thay đổi sau khi tạo
                            </span>
                        </label>

                        <!-- Hàng 2 cột: Tên hiển thị và Module -->
                        <div class="grid gap-4 md:grid-cols-1">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400 font-medium">Tên hiển thị <span class="text-red-600">*</span></span>
                                <input type="text" 
                                       id="permissionName"
                                       name="permission_name" 
                                       value="<?= $permission['tenQuyen'] ?>"
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
                                      placeholder="Mô tả chức năng này làm gì..."><?= $permission['moTa'] ?></textarea>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Quy tắc đặt tên (giữ nguyên) -->
            <div class="md:col-span-5">
                <!-- ... giống form thêm ... -->
            </div>
        </div>

        <!-- Form actions -->
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="index.php?page=users&tab=permissions" 
               class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
                <i class="fas fa-times mr-2"></i> Hủy
            </a>
            <button type="submit" 
                    class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red shadow-md">
                <i class="fas fa-save mr-2"></i> Cập nhật quyền
            </button>
        </div>
    </form>

<!-- Validate script (giống form thêm, chỉ validate tên hiển thị) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const permissionName = document.getElementById('permissionName');
    const permissionNameError = document.getElementById('permissionName_error');

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

    if (permissionName) {
        permissionName.addEventListener('input', validatePermissionName);
        permissionName.addEventListener('blur', validatePermissionName);
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validatePermissionName()) {
                e.preventDefault();
                permissionName.focus();
                alert('Vui lòng kiểm tra lại tên hiển thị!');
            }
        });
    }

    if (permissionName) validatePermissionName();
});
</script>