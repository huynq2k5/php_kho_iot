function triggerModal(options) {
    // 1. Đổ dữ liệu vào các phần tử
    document.getElementById('modal-title').innerText = options.title || 'Xác nhận';
    document.getElementById('modal-description').innerText = options.description || 'Bạn có chắc chắn muốn thực hiện?';
    
    const confirmBtn = document.getElementById('modal-confirm-btn');
    confirmBtn.href = options.confirmUrl || '#';
    
    // 2. Đổi màu nút nếu cần (ví dụ: đỏ cho lệnh xóa)
    confirmBtn.className = `w-full px-5 py-3 text-sm text-center text-white rounded-lg sm:w-auto ${options.btnClass || 'bg-purple-600'}`;
    
    // 3. Kích hoạt Alpine.js để mở Modal
    // Do Windmill dùng Alpine, ta có thể dispatch sự kiện hoặc gọi trực tiếp nếu scope cho phép
}