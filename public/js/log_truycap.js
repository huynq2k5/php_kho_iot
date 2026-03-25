// Hàm nạp thư viện FingerprintJS từ CDN
async function loadFingerprintLib() {
    if (typeof FingerprintJS !== 'undefined') return;
    return new Promise((resolve) => {
        const script = document.createElement('script');
        script.src = "https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@4/dist/fp.min.js";
        script.onload = resolve;
        script.onerror = () => console.error("Không thể tải thư viện từ CDN");
        document.head.appendChild(script);
    });
}

// Hàm lấy thông tin cấu hình chi tiết (Model, OS thật)
async function getAdvancedDeviceInfo() {
    let model = "Unknown Device";
    let osVersion = "Unknown Version";
    const ua = navigator.userAgent;

    // 1. Dùng Client Hints cho Android/Chrome (Lấy Model & Android Version thật)
    if (navigator.userAgentData && navigator.userAgentData.getHighEntropyValues) {
        const hints = await navigator.userAgentData.getHighEntropyValues(["model", "platformVersion"]);
        model = hints.model || model;
        osVersion = hints.platformVersion || osVersion;
    }

    // 2. Dùng Heuristics cho iPhone (Dòng X trở lên)
    if (/iPhone/i.test(ua)) {
        const w = window.screen.width;
        const h = window.screen.height;
        const dpr = window.devicePixelRatio;

        if (w === 375 && h === 812 && dpr === 3) model = "iPhone X/XS/11 Pro";
        else if (w === 414 && h === 896 && dpr === 2) model = "iPhone XR/11";
        else if (w === 414 && h === 896 && dpr === 3) model = "iPhone XS Max/11 Pro Max";
        else if (w === 390 && h === 844 && dpr === 3) model = "iPhone 12/13/14/Pro";
        else if (w === 428 && h === 926 && dpr === 3) model = "iPhone 12/13 PM/14 Plus";
        else if (w === 393 && h === 852 && dpr === 3) model = "iPhone 14 Pro/15/15 Pro";
        else if (w === 430 && h === 932 && dpr === 3) model = "iPhone 14 PM/15 PM/Plus";
        else if (w === 375 && h === 667) model = "iPhone SE/8/7/6s";
        
        osVersion = ua.match(/OS\s([0-9_]+)/i)?.[1].replace(/_/g, '.') || "iOS";
    }

    document.cookie = "device_model=" + encodeURIComponent(model) + "; path=/; max-age=31536000; SameSite=Lax";
    document.cookie = "os_real_version=" + osVersion + "; path=/; max-age=31536000; SameSite=Lax";
}

// Quy trình khởi tạo log bảo mật
async function initSecurityLog() {
    // Luôn lấy thông tin phần cứng trước
    await getAdvancedDeviceInfo();

    // Nạp thư viện Fingerprint
    await loadFingerprintLib();

    try {
        const fp = await FingerprintJS.load();
        const result = await fp.get();
        const vid = result.visitorId;

        // Nếu chưa có Fingerprint cookie, lưu và reload để PHP ghi nhận đầy đủ 3 loại Cookie
        if (!document.cookie.includes('device_fingerprint=')) {
            document.cookie = "device_fingerprint=" + vid + "; path=/; max-age=31536000; SameSite=Lax";
            location.reload();
        }
    } catch (error) {
        console.error("Lỗi khởi tạo bảo mật:", error);
    }
}

// Chạy hệ thống
initSecurityLog();