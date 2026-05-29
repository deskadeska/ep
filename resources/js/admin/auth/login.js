document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const identifier = document.getElementById("raw_identifier").value;
    const password = document.getElementById("raw_password").value;

    const payloadData = JSON.stringify({
        identifier: identifier,
        password: password,
    });

    // 1. KUNCI BARU (Wajib sama persis 32 Karakter dengan di Controller)
    const secretKey = "EkopemUprSecretKey2026AdminLogin";

    // 2. PARSING KUNCI (Wajib untuk AES murni)
    const keyParsed = CryptoJS.enc.Utf8.parse(secretKey);

    // 3. ENKRIPSI
    const encryptedData = CryptoJS.AES.encrypt(payloadData, keyParsed, {
        mode: CryptoJS.mode.ECB,
        padding: CryptoJS.pad.Pkcs7,
    }).toString();

    document.getElementById("encrypted_payload").value = encryptedData;

    // Lanjutkan submit
    this.submit();
});
