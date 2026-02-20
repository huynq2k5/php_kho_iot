function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(tab + '-tab-content').classList.remove('hidden');
    
    document.querySelectorAll('[id$="-tab"]').forEach(el => {
        el.classList.remove('text-red-600', 'border-red-600', 'dark:text-red-500', 'dark:border-red-500');
        el.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
    });
    
    const activeTab = document.getElementById(tab + '-tab');
    activeTab.classList.remove('border-transparent');
    activeTab.classList.add('text-red-600', 'border-red-600');
}

function updateModuleCheckbox(module) {
    const checkboxes = document.querySelectorAll(`.perm-checkbox[data-module="${module}"]`);
    const moduleCheckbox = document.querySelector(`.module-checkbox[data-module="${module}"]`);
    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
    
    if (moduleCheckbox) {
        moduleCheckbox.checked = checkedCount === checkboxes.length;
        moduleCheckbox.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
    }
}

function toggleModule(module, checked) {
    document.querySelectorAll(`.perm-checkbox[data-module="${module}"]`).forEach(cb => cb.checked = checked);
}

function checkAllPermissions() {
    document.querySelectorAll('.perm-checkbox, .module-checkbox').forEach(cb => {
        cb.checked = true;
        cb.indeterminate = false;
    });
}

function uncheckAllPermissions() {
    document.querySelectorAll('.perm-checkbox, .module-checkbox').forEach(cb => {
        cb.checked = false;
        cb.indeterminate = false;
    });
}

function updatePreview() {
    const nameInput = document.getElementById('groupNameInput');
    const previewText = document.getElementById('previewText');
    const badge = document.getElementById('badgePreview');
    if (!nameInput || !previewText || !badge) return;

    previewText.textContent = nameInput.value.trim() || "Tên nhóm...";
    const color = document.querySelector('input[name="badge_color"]:checked')?.value || 'blue';
    
    badge.className = `inline-flex items-center px-3 py-2 text-sm font-semibold rounded-full shadow-sm transition-all duration-300 border bg-${color}-100 text-${color}-700 border-${color}-200 dark:bg-${color}-900 dark:text-${color}-300 dark:border-${color}-800`;
}

function validateGroupCode() {
    const groupCode = document.getElementById('groupCode');
    const errorSpan = document.getElementById('groupCode_error');
    const helperSpan = document.getElementById('groupCode_helper');
    if (!groupCode) return true;

    const value = groupCode.value.trim();
    const regex = /^[A-Z0-9_]+$/;

    if (!value) {
        showError(groupCode, errorSpan, helperSpan, '❌ Mã nhóm không được để trống');
        return false;
    } else if (value.includes(' ')) {
        showError(groupCode, errorSpan, helperSpan, '❌ Mã nhóm không được chứa dấu cách');
        return false;
    } else if (!regex.test(value)) {
        showError(groupCode, errorSpan, helperSpan, '❌ Chỉ dùng chữ hoa, số và gạch dưới');
        return false;
    } else if (value.length < 3) {
        showError(groupCode, errorSpan, helperSpan, '❌ Mã nhóm phải có ít nhất 3 ký tự');
        return false;
    } else {
        showSuccess(groupCode, errorSpan, helperSpan, '✓ Mã nhóm hợp lệ');
        return true;
    }
}

function validateGroupName() {
    const groupName = document.getElementById('groupNameInput');
    const errorSpan = document.getElementById('groupName_error');
    if (!groupName) return true;

    const value = groupName.value.trim();

    if (!value) {
        groupName.classList.add('border-red-600');
        errorSpan.classList.remove('hidden');
        errorSpan.textContent = '❌ Tên nhóm không được để trống';
        return false;
    } else if (value.length < 3) {
        groupName.classList.add('border-red-600');
        errorSpan.classList.remove('hidden');
        errorSpan.textContent = '❌ Tên nhóm phải có ít nhất 3 ký tự';
        return false;
    } else {
        groupName.classList.remove('border-red-600');
        groupName.classList.add('border-green-600');
        errorSpan.classList.add('hidden');
        return true;
    }
}

function showError(input, errorEl, helperEl, message) {
    input.classList.add('border-red-600');
    input.classList.remove('border-green-600');
    errorEl.classList.remove('hidden');
    errorEl.textContent = message;
    if (helperEl) helperEl.classList.add('hidden');
}

function showSuccess(input, errorEl, helperEl, message) {
    input.classList.remove('border-red-600');
    input.classList.add('border-green-600');
    errorEl.classList.add('hidden');
    if (helperEl) {
        helperEl.classList.remove('hidden');
        helperEl.classList.add('text-green-600');
        helperEl.textContent = message;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    updatePreview();
    document.querySelectorAll('.module-checkbox').forEach(cb => updateModuleCheckbox(cb.dataset.module));

    const groupCode = document.getElementById('groupCode');
    const groupName = document.getElementById('groupNameInput');
    const form = document.getElementById('mainForm');

    if (groupCode) {
        groupCode.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            validateGroupCode();
        });
        groupCode.addEventListener('blur', validateGroupCode);
    }

    if (groupName) {
        groupName.addEventListener('input', validateGroupName);
        groupName.addEventListener('blur', validateGroupName);
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            const isCodeValid = validateGroupCode();
            const isNameValid = validateGroupName();

            if (!isCodeValid || !isNameValid) {
                e.preventDefault();
                switchTab('info');
                if (!isCodeValid && groupCode) groupCode.focus();
                else if (!isNameValid && groupName) groupName.focus();
                alert('Vui lòng kiểm tra lại thông tin bị lỗi!');
            }
        });
    }
});