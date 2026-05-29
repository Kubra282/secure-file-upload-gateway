<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['myFile'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Uzantıyı güvenli şekilde yakalamak için pathinfo kullanıyoruz
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Güvenlik Politikası Sınırları
    $maxAllowedSize = 2097152; // 2 MB
    $allowedExtensions = array('pdf', 'png', 'jpg', 'jpeg', 'docx');

    echo "<!DOCTYPE html>
    <html lang='tr'>
    <head>
        <meta charset='UTF-8'>
        <title>Analiz Sonuçları</title>
        <link href='https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Share+Tech+Mono&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            body { background: #0a0f1d; color: #e2e8f0; font-family: 'JetBrains+Mono', monospace; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin:0; }
            .result-card { background: #131a30; border: 2px solid #1e294b; border-radius: 12px; padding: 40px; text-align: center; max-width: 500px; width: 100%; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
            .icon { font-size: 60px; margin-bottom: 20px; }
            .success { color: #00ff66; text-shadow: 0 0 20px rgba(0, 255, 102, 0.2); }
            .danger { color: #ff3e3e; text-shadow: 0 0 20px rgba(255, 62, 62, 0.2); }
            .info-box { background: #0d1325; border: 1px solid #1e294b; border-radius: 8px; padding: 15px; margin: 25px 0; text-align: left; font-size: 14px; }
            .back-btn { background: #1e294b; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 6px; display: inline-block; transition: 0.3s; font-size: 14px; }
            .back-btn:hover { background: #334155; }
        </style>
    </head>
    <body>
    <div class='result-card'>";

    if ($fileError === 0) {
        // 1. GÜVENLİK ADIMI: Uzantı Kontrolü (Hatalı kısım in_array olarak düzeltildi)
        if (!in_array($fileExt, $allowedExtensions)) {
            echo "<div class='icon danger'><i class='fa-solid fa-triangle-exclamation'></i></div>";
            echo "<h2 style='color:#ff3e3e;'>CRITICAL_SECURITY_ALERT</h2>";
            echo "<p>Uzantı Doğrulaması Başarısız Oldu.</p>";
            echo "<div class='info-box'>";
            echo "<strong>Engellenen Dosya:</strong> " . htmlspecialchars($fileName) . "<br>";
            echo "<strong>Zafiyet Riski (CWE-434):</strong> '.php', '.exe' veya bilinmeyen uzantılar sunucu üzerinde Uzaktan Kod Çalıştırılmasına (RCE) yol açabilir. Sistem koruma modu devreye girdi.";
            echo "</div>";
        }
        // 2. GÜVENLİK ADIMI: Boyut Kontrolü (DoS Engelleme)
        else if ($fileSize > $maxAllowedSize) {
            echo "<div class='icon danger'><i class='fa-solid fa-battery-empty'></i></div>";
            echo "<h2 style='color:#ff3e3e;'>RESOURCE_EXHAUSTION_LIMIT</h2>";
            echo "<p>Kritik Boyut Sınırı Aşıldı.</p>";
            echo "<div class='info-box'>";
            echo "<strong>Dosya Boyutu:</strong> " . round($fileSize / 1024 / 1024, 2) . " MB<br>";
            echo "<strong>Zafiyet Riski (CWE-400):</strong> Aşırı büyük dosyalar web sunucusunun kaynaklarını tüketerek Hizmet Dışı Bırakma (DoS) saldırılarına kapı aralar. Yükleme kesildi.";
            echo "</div>";
        } 
        // Tüm Kontrollerden Geçerse (Güvenli Durum)
        else {
            echo "<div class='icon success'><i class='fa-solid fa-user-shield'></i></div>";
            echo "<h2 style='color:#00ff66;'>STATUS_CLEAN_APPROVED</h2>";
            echo "<p>Dosya Güvenlik Filtrelerinden Başarıyla Geçti.</p>";
            echo "<div class='info-box'>";
            echo "<strong>Dosya Adı:</strong> " . htmlspecialchars($fileName) . "<br>";
            echo "<strong>Boyut:</strong> " . round($fileSize / 1024 / 1024, 2) . " MB<br><br>";
            echo "<span style='color:#00ff66;'>✔ Integrity OK</span><br>";
            echo "<span style='color:#00ff66;'>✔ Policy Validation OK</span>";
            echo "</div>";
        }
    } else {
        echo "<p>Dosya işlenirken sistemsel bir hata meydana geldi.</p>";
    }

    echo "<br><a href='index.php' class='back-btn'><i class='fa-solid fa-arrow-left'></i> Terminale Dön</a>
    </div>
    </body>
    </html>";
}
?>