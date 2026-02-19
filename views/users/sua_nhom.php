<!-- Header với tiêu đề và nút quay lại -->
<div class="flex flex-col items-start justify-between w-full gap-4 my-6 sm:flex-row sm:items-center">
    <div>
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Sửa nhóm người dùng: <span class="text-green-600" id="groupNameDisplay"><?= $group['tenNhom'] ?></span>
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Chỉnh sửa thông tin nhóm và màu sắc hiển thị
        </p>
    </div>
    
    <a href="index.php?page=users&tab=groups" 
       class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
        <i class="fas fa-chevron-left mr-2"></i> Quay lại
    </a>
</div>

<form action="index.php?page=nhom_xulycapnhat" method="POST">
    <!-- Hidden field chứa ID nhóm -->
    <input type="hidden" name="id" value="<?= $group['idNhom'] ?>">
    
    <div class="grid gap-6 mb-8 md:grid-cols-12">
        
        <!-- Cột trái: Thông tin chung (chiếm 7/12) -->
        <div class="md:col-span-7">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                <!-- Card header -->
                <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300">Thông tin chung</h4>
                </div>
                
                <!-- Card body -->
                <div class="space-y-4">
                    <!-- Mã nhóm - DISABLED (không cho sửa) -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Mã nhóm <span class="text-red-600">*</span></span>
                        <input type="text" 
                               value="<?= $group['maNhom'] ?>"
                               class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input bg-gray-100 dark:bg-gray-600 cursor-not-allowed opacity-75 font-mono uppercase" 
                               disabled
                               readonly>
                        <!-- Hidden field để gửi mã nhóm cũ lên server -->
                        <input type="hidden" name="group_code" value="<?= $group['maNhom'] ?>">
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-lock mr-1"></i> Mã nhóm không thể thay đổi sau khi tạo
                        </span>
                    </label>

                    <!-- Tên nhóm vai trò - CÓ THỂ SỬA -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Tên nhóm vai trò <span class="text-red-600">*</span></span>
                        <input type="text" 
                               id="groupNameInput" 
                               name="group_name" 
                               value="<?= $group['tenNhom'] ?>"
                               class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-input focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                               placeholder="VD: Kế toán kho" 
                               required 
                               oninput="updatePreview()">
                        <span class="text-xs text-red-600 dark:text-red-400 hidden mt-1" id="groupName_error">Tên nhóm không được để trống</span>
                    </label>

                    <!-- Mô tả chức năng - CÓ THỂ SỬA -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400 font-medium">Mô tả chức năng</span>
                        <textarea class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 form-textarea focus:border-red-400 focus:shadow-outline-red dark:focus:shadow-outline-gray" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Mô tả chi tiết về quyền hạn và trách nhiệm của nhóm này..."><?= $group['moTa'] ?></textarea>
                    </label>
                </div>
            </div>
        </div>

        <!-- Cột phải: Giao diện & Hiển thị (chiếm 5/12) -->
        <div class="md:col-span-5">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 border border-gray-200 dark:border-gray-700 h-full">
                <!-- Card header -->
                <div class="flex items-center mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <h4 class="font-semibold text-gray-700 dark:text-gray-300">Giao diện & Hiển thị</h4>
                </div>
                
                <!-- Card body -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm mb-3">
                            <span class="text-gray-700 dark:text-gray-400 font-medium">Màu sắc nhận diện (Badge Color)</span>
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Radio buttons dạng grid - THÊM selected cho màu hiện tại -->
                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_primary" value="blue" <?= ($group['badge_color'] ?? 'blue') == 'blue' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_primary" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-blue-700 bg-blue-50 border-2 border-blue-200 rounded-lg cursor-pointer peer-checked:bg-blue-200 peer-checked:border-blue-600 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800 dark:peer-checked:bg-blue-900 dark:peer-checked:border-blue-600 transition-colors duration-150">
                                    <i class="fas fa-circle text-blue-600 dark:text-blue-400 text-xs"></i> Xanh dương
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_success" value="green" <?= ($group['badge_color'] ?? 'blue') == 'green' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_success" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-green-700 bg-green-50 border-2 border-green-200 rounded-lg cursor-pointer peer-checked:bg-green-200 peer-checked:border-green-600 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800 dark:peer-checked:bg-green-900 dark:peer-checked:border-green-600 transition-colors duration-150">
                                    <i class="fas fa-circle text-green-600 dark:text-green-400 text-xs"></i> Xanh lá
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_warning" value="yellow" <?= ($group['badge_color'] ?? 'blue') == 'yellow' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_warning" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-yellow-700 bg-yellow-50 border-2 border-yellow-200 rounded-lg cursor-pointer peer-checked:bg-yellow-200 peer-checked:border-yellow-600 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800 dark:peer-checked:bg-yellow-900 dark:peer-checked:border-yellow-600 transition-colors duration-150">
                                    <i class="fas fa-circle text-yellow-600 dark:text-yellow-400 text-xs"></i> Vàng
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_danger" value="red" <?= ($group['badge_color'] ?? 'blue') == 'red' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_danger" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-red-700 bg-red-50 border-2 border-red-200 rounded-lg cursor-pointer peer-checked:bg-red-200 peer-checked:border-red-600 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800 dark:peer-checked:bg-red-900 dark:peer-checked:border-red-600 transition-colors duration-150">
                                    <i class="fas fa-circle text-red-600 dark:text-red-400 text-xs"></i> Đỏ
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_info" value="cyan" <?= ($group['badge_color'] ?? 'blue') == 'cyan' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_info" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-cyan-700 bg-cyan-50 border-2 border-cyan-200 rounded-lg cursor-pointer peer-checked:bg-cyan-200 peer-checked:border-cyan-600 dark:bg-cyan-900/20 dark:text-cyan-400 dark:border-cyan-800 dark:peer-checked:bg-cyan-900 dark:peer-checked:border-cyan-600 transition-colors duration-150">
                                    <i class="fas fa-circle text-cyan-600 dark:text-cyan-400 text-xs"></i> Xanh nhạt
                                </label>
                            </div>

                            <div class="relative">
                                <input type="radio" class="sr-only peer" name="badge_color" id="color_dark" value="gray" <?= ($group['badge_color'] ?? 'blue') == 'gray' ? 'checked' : '' ?> onchange="updatePreview()">
                                <label for="color_dark" class="flex items-center justify-center gap-2 w-full py-2 text-sm font-medium text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:bg-gray-200 peer-checked:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:peer-checked:bg-gray-600 dark:peer-checked:border-gray-400 transition-colors duration-150">
                                    <i class="fas fa-circle text-gray-600 dark:text-gray-400 text-xs"></i> Xám
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Preview box -->
                    <div class="p-4 mt-2 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 dark:bg-gray-700 dark:border-gray-600 text-center">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wider">Xem trước hiển thị</p>
                        
                        <span id="badgePreview" class="inline-flex items-center px-3 py-2 text-sm font-semibold rounded-full shadow-sm transition-all duration-300 
                            <?php
                            $color = $group['badge_color'] ?? 'blue';
                            switch($color) {
                                case 'green':
                                    echo 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900 dark:text-green-300 dark:border-green-800';
                                    break;
                                case 'yellow':
                                    echo 'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-900 dark:text-yellow-300 dark:border-yellow-800';
                                    break;
                                case 'red':
                                    echo 'bg-red-100 text-red-700 border-red-200 dark:bg-red-900 dark:text-red-300 dark:border-red-800';
                                    break;
                                case 'cyan':
                                    echo 'bg-cyan-100 text-cyan-700 border-cyan-200 dark:bg-cyan-900 dark:text-cyan-300 dark:border-cyan-800';
                                    break;
                                case 'gray':
                                    echo 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600';
                                    break;
                                default:
                                    echo 'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-800';
                            }
                            ?>">
                            <i class="fas fa-users mr-1"></i> 
                            <span id="previewText"><?= $group['tenNhom'] ?></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form actions -->
    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <a href="index.php?page=users&tab=groups" 
           class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:text-gray-800 hover:border-gray-400 focus:outline-none focus:shadow-outline-red dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-gray-300 dark:hover:border-gray-500">
            <i class="fas fa-times mr-2"></i> Hủy
        </a>
        <button type="submit" 
                class="px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline-green shadow-md">
            <i class="fas fa-save mr-2"></i> Cập nhật nhóm
        </button>
    </div>
</form>

<script>
    function updatePreview() {
        const nameInput = document.getElementById('groupNameInput');
        const previewText = document.getElementById('previewText');
        const badge = document.getElementById('badgePreview');
        
        if (!nameInput || !previewText || !badge) return;
        
        // Update text
        previewText.textContent = nameInput.value ? nameInput.value : "Tên nhóm...";

        // Define colors mapping
        const colors = {
            'blue': {
                bg: 'bg-blue-100 dark:bg-blue-900',
                text: 'text-blue-700 dark:text-blue-300',
                border: 'border-blue-200 dark:border-blue-800'
            },
            'green': {
                bg: 'bg-green-100 dark:bg-green-900',
                text: 'text-green-700 dark:text-green-300',
                border: 'border-green-200 dark:border-green-800'
            },
            'yellow': {
                bg: 'bg-yellow-100 dark:bg-yellow-900',
                text: 'text-yellow-700 dark:text-yellow-300',
                border: 'border-yellow-200 dark:border-yellow-800'
            },
            'red': {
                bg: 'bg-red-100 dark:bg-red-900',
                text: 'text-red-700 dark:text-red-300',
                border: 'border-red-200 dark:border-red-800'
            },
            'cyan': {
                bg: 'bg-cyan-100 dark:bg-cyan-900',
                text: 'text-cyan-700 dark:text-cyan-300',
                border: 'border-cyan-200 dark:border-cyan-800'
            },
            'gray': {
                bg: 'bg-gray-100 dark:bg-gray-700',
                text: 'text-gray-700 dark:text-gray-300',
                border: 'border-gray-200 dark:border-gray-600'
            }
        };

        // Get selected color
        const selectedRadio = document.querySelector('input[name="badge_color"]:checked');
        if (!selectedRadio) return;
        
        const selectedColor = selectedRadio.value;

        // Remove all color classes
        const allClasses = [
            'bg-blue-100', 'dark:bg-blue-900', 'text-blue-700', 'dark:text-blue-300', 'border-blue-200', 'dark:border-blue-800',
            'bg-green-100', 'dark:bg-green-900', 'text-green-700', 'dark:text-green-300', 'border-green-200', 'dark:border-green-800',
            'bg-yellow-100', 'dark:bg-yellow-900', 'text-yellow-700', 'dark:text-yellow-300', 'border-yellow-200', 'dark:border-yellow-800',
            'bg-red-100', 'dark:bg-red-900', 'text-red-700', 'dark:text-red-300', 'border-red-200', 'dark:border-red-800',
            'bg-cyan-100', 'dark:bg-cyan-900', 'text-cyan-700', 'dark:text-cyan-300', 'border-cyan-200', 'dark:border-cyan-800',
            'bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-gray-600'
        ];
        
        allClasses.forEach(cls => {
            badge.classList.remove(cls);
        });

        // Add new color classes
        const colorSet = colors[selectedColor];
        if (colorSet) {
            badge.classList.add(colorSet.bg, colorSet.text, colorSet.border);
        }
    }

    // Initialize preview on page load
    document.addEventListener('DOMContentLoaded', function() {
        updatePreview();
    });
</script>

<script>
    // Hàm updatePreview (giữ nguyên)
    function updatePreview() {
        const nameInput = document.getElementById('groupNameInput');
        const previewText = document.getElementById('previewText');
        const badge = document.getElementById('badgePreview');
        
        if (!nameInput || !previewText || !badge) return;
        
        // Update text
        previewText.textContent = nameInput.value ? nameInput.value : "Tên nhóm...";

        // Define colors mapping
        const colors = {
            'blue': {
                bg: 'bg-blue-100 dark:bg-blue-900',
                text: 'text-blue-700 dark:text-blue-300',
                border: 'border-blue-200 dark:border-blue-800'
            },
            'green': {
                bg: 'bg-green-100 dark:bg-green-900',
                text: 'text-green-700 dark:text-green-300',
                border: 'border-green-200 dark:border-green-800'
            },
            'yellow': {
                bg: 'bg-yellow-100 dark:bg-yellow-900',
                text: 'text-yellow-700 dark:text-yellow-300',
                border: 'border-yellow-200 dark:border-yellow-800'
            },
            'red': {
                bg: 'bg-red-100 dark:bg-red-900',
                text: 'text-red-700 dark:text-red-300',
                border: 'border-red-200 dark:border-red-800'
            },
            'cyan': {
                bg: 'bg-cyan-100 dark:bg-cyan-900',
                text: 'text-cyan-700 dark:text-cyan-300',
                border: 'border-cyan-200 dark:border-cyan-800'
            },
            'gray': {
                bg: 'bg-gray-100 dark:bg-gray-700',
                text: 'text-gray-700 dark:text-gray-300',
                border: 'border-gray-200 dark:border-gray-600'
            }
        };

        // Get selected color
        const selectedRadio = document.querySelector('input[name="badge_color"]:checked');
        if (!selectedRadio) return;
        
        const selectedColor = selectedRadio.value;

        // Remove all color classes
        const allClasses = [
            'bg-blue-100', 'dark:bg-blue-900', 'text-blue-700', 'dark:text-blue-300', 'border-blue-200', 'dark:border-blue-800',
            'bg-green-100', 'dark:bg-green-900', 'text-green-700', 'dark:text-green-300', 'border-green-200', 'dark:border-green-800',
            'bg-yellow-100', 'dark:bg-yellow-900', 'text-yellow-700', 'dark:text-yellow-300', 'border-yellow-200', 'dark:border-yellow-800',
            'bg-red-100', 'dark:bg-red-900', 'text-red-700', 'dark:text-red-300', 'border-red-200', 'dark:border-red-800',
            'bg-cyan-100', 'dark:bg-cyan-900', 'text-cyan-700', 'dark:text-cyan-300', 'border-cyan-200', 'dark:border-cyan-800',
            'bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-gray-600'
        ];
        
        allClasses.forEach(cls => {
            badge.classList.remove(cls);
        });

        // Add new color classes
        const colorSet = colors[selectedColor];
        if (colorSet) {
            badge.classList.add(colorSet.bg, colorSet.text, colorSet.border);
        }
    }

    // VALIDATE FUNCTION
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const groupCode = document.getElementById('groupCode');
        const groupName = document.getElementById('groupNameInput');
        
        // Span errors
        const groupCodeError = document.getElementById('groupCode_error');
        const groupNameError = document.getElementById('groupName_error');
        const groupCodeHelper = document.getElementById('groupCode_helper');

        // Validate Mã nhóm
        function validateGroupCode() {
            const value = groupCode.value.trim();
            
            // Rule: Không được để trống
            if (!value) {
                groupCode.classList.add('border-red-600', 'input-invalid');
                groupCode.classList.remove('border-green-600', 'input-valid');
                groupCodeError.classList.remove('hidden');
                groupCodeError.textContent = '❌ Mã nhóm không được để trống';
                if (groupCodeHelper) groupCodeHelper.classList.add('hidden');
                return false;
            }
            // Rule: Không dấu cách
            else if (value.includes(' ')) {
                groupCode.classList.add('border-red-600', 'input-invalid');
                groupCode.classList.remove('border-green-600', 'input-valid');
                groupCodeError.classList.remove('hidden');
                groupCodeError.textContent = '❌ Mã nhóm không được chứa dấu cách';
                if (groupCodeHelper) groupCodeHelper.classList.add('hidden');
                return false;
            }
            // Rule: Không ký tự đặc biệt (chỉ cho phép chữ hoa, số, gạch dưới)
            else if (!/^[A-Z0-9_]+$/.test(value)) {
                groupCode.classList.add('border-red-600', 'input-invalid');
                groupCode.classList.remove('border-green-600', 'input-valid');
                groupCodeError.classList.remove('hidden');
                groupCodeError.textContent = '❌ Chỉ chấp nhận chữ hoa, số và gạch dưới (_)';
                if (groupCodeHelper) groupCodeHelper.classList.add('hidden');
                return false;
            }
            // Rule: Độ dài tối thiểu 3
            else if (value.length < 3) {
                groupCode.classList.add('border-red-600', 'input-invalid');
                groupCode.classList.remove('border-green-600', 'input-valid');
                groupCodeError.classList.remove('hidden');
                groupCodeError.textContent = '❌ Mã nhóm phải có ít nhất 3 ký tự';
                if (groupCodeHelper) groupCodeHelper.classList.add('hidden');
                return false;
            }
            // Hợp lệ
            else {
                groupCode.classList.remove('border-red-600', 'input-invalid');
                groupCode.classList.add('border-green-600', 'input-valid');
                groupCodeError.classList.add('hidden');
                if (groupCodeHelper) {
                    groupCodeHelper.classList.remove('hidden');
                    groupCodeHelper.classList.add('text-green-600', 'dark:text-green-400');
                    groupCodeHelper.textContent = '✓ Mã nhóm hợp lệ';
                }
                return true;
            }
        }

        // Validate Tên nhóm
        function validateGroupName() {
            const value = groupName.value.trim();
            
            if (!value) {
                groupName.classList.add('border-red-600', 'input-invalid');
                groupName.classList.remove('border-green-600', 'input-valid');
                groupNameError.classList.remove('hidden');
                groupNameError.textContent = '❌ Tên nhóm không được để trống';
                return false;
            } else if (value.length < 3) {
                groupName.classList.add('border-red-600', 'input-invalid');
                groupName.classList.remove('border-green-600', 'input-valid');
                groupNameError.classList.remove('hidden');
                groupNameError.textContent = '❌ Tên nhóm phải có ít nhất 3 ký tự';
                return false;
            } else {
                groupName.classList.remove('border-red-600', 'input-invalid');
                groupName.classList.add('border-green-600', 'input-valid');
                groupNameError.classList.add('hidden');
                return true;
            }
        }

        // Tự động chuyển sang chữ hoa cho mã nhóm
        if (groupCode) {
            groupCode.addEventListener('input', function(e) {
                this.value = this.value.toUpperCase();
                validateGroupCode();
            });
            groupCode.addEventListener('blur', validateGroupCode);
        }

        // Validate tên nhóm
        if (groupName) {
            groupName.addEventListener('input', validateGroupName);
            groupName.addEventListener('blur', validateGroupName);
        }

        // Validate form khi submit
        if (form) {
            form.addEventListener('submit', function(e) {
                const isCodeValid = groupCode ? validateGroupCode() : true;
                const isNameValid = groupName ? validateGroupName() : true;
                
                if (!isCodeValid || !isNameValid) {
                    e.preventDefault();
                    
                    if (!isCodeValid && groupCode) groupCode.focus();
                    else if (!isNameValid && groupName) groupName.focus();
                    
                    alert('Vui lòng kiểm tra lại các trường bị lỗi!');
                }
            });
        }

        // Validate lần đầu khi load
        if (groupCode) {
            validateGroupCode();
            // Set giá trị mặc định thành chữ hoa nếu có
            groupCode.value = groupCode.value.toUpperCase();
        }
        if (groupName) validateGroupName();
    });
</script>

<style>
    /* Custom styles nếu cần */
    .focus\:shadow-outline-green:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.45);
    }
    .dark .dark\:focus\:shadow-outline-gray:focus {
        box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    }
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
    .focus\:shadow-outline-green:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.45);
    }
</style>