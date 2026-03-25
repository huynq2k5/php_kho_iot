async function initFingerprint() {
    if (typeof FingerprintJS === 'undefined') {
        await new Promise((resolve) => {
            const script = document.createElement('script');
            script.src = "https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@4/dist/fp.min.js";
            script.onload = resolve;
            script.onerror = () => console.error("Không thể tải thư viện từ CDN");
            document.head.appendChild(script);
        });
    }

    try {
        const fp = await FingerprintJS.load();
        const result = await fp.get();
        const vid = result.visitorId;

        if (!document.cookie.includes('device_fingerprint=')) {
            document.cookie = "device_fingerprint=" + vid + "; path=/; max-age=31536000; SameSite=Lax";
            location.reload(); 
        }
    } catch (error) {
        console.error("Lỗi Fingerprint:", error);
    }
}

initFingerprint();