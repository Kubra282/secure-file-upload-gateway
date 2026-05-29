<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberShield // Secure File Upload Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #0a0f1d;
            --card-bg: #131a30;
            --accent-color: #00ff66;
            --text-color: #e2e8f0;
            --border-color: #1e294b;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'JetBrains+Mono', monospace;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            background-image: radial-gradient(rgba(0, 255, 102, 0.05) 1px, transparent 0);
            background-size: 24px 24px;
        }

        /* Siber Güvenlik Temalı Konteyner */
        .terminal-container {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(0, 255, 102, 0.05);
            position: relative;
            overflow: hidden;
        }

        .terminal-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #00ff66, #00bcff);
        }

        /* Üst Bar (Terminal Penceresi Havası) */
        .terminal-header {
            background: #0d1325;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .window-dots {
            display: flex;
            gap: 6px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 5px;
        }
        .dot-r { background: #ff5f56; }
        .dot-y { background: #ffbd2e; }
        .dot-g { background: #27c93f; }

        .terminal-title {
            font-family: 'Share Tech Mono', sans-serif;
            color: #64748b;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* İçerik Alanı */
        .terminal-body {
            padding: 35px 30px;
            text-align: center;
        }

        .shield-icon {
            font-size: 48px;
            color: var(--accent-color);
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(0, 255, 102, 0.3);
            animation: pulse 2s infinite alternate;
        }

        h2 {
            font-family: 'Share Tech Mono', sans-serif;
            margin: 0 0 10px 0;
            font-size: 24px;
            color: #fff;
            letter-spacing: 1px;
        }

        .status-badge {
            background: rgba(0, 255, 102, 0.1);
            color: var(--accent-color);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 30px;
            border: 1px solid rgba(0, 255, 102, 0.2);
        }

        /* Güvenlik Kuralları Bölümü */
        .rules-box {
            background: #0d1325;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            text-align: left;
            margin-bottom: 30px;
            font-size: 13px;
        }

        .rules-box div {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rules-box i { color: #00bcff; }

        /* Sürükle Bırak / Dosya Seçme Alanı */
        .file-upload-area {
            border: 2px dashed #334155;
            border-radius: 8px;
            padding: 30px 20px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(13, 19, 37, 0.5);
        }

        .file-upload-area:hover {
            border-color: var(--accent-color);
            background: rgba(0, 255, 102, 0.02);
        }

        .file-upload-area i {
            font-size: 32px;
            color: #475569;
            margin-bottom: 10px;
        }

        .file-upload-area input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-name-display {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 5px;
        }

        /* Havalı Yükleme Butonu */
        .submit-btn {
            background: linear-gradient(135deg, #00ff66 0%, #00ea5d 100%);
            color: #0a0f1d;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-family: 'JetBrains+Mono', monospace;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            margin-top: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 255, 102, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 102, 0.4);
        }

        @keyframes pulse {
            from { transform: scale(1); opacity: 0.9; }
            to { transform: scale(1.05); opacity: 1; }
        }
    </style>
</head>
<body>

<div class="terminal-container">
    <div class="terminal-header">
        <div class="window-dots">
            <div class="dot dot-r"></div>
            <div class="dot dot-y"></div>
            <div class="dot dot-g"></div>
        </div>
        <div class="terminal-title">SECURE_UPLOAD_GATEWAY // v1.0.4</div>
        <div></div>
    </div>
    
    <div class="terminal-body">
        <div class="shield-icon">
            <i class="fa-solid to fa-shield-halved"></i>
        </div>
        <h2>GÜVENLİ DOSYA TARAYICI</h2>
        <div class="status-badge">
            <i class="fa-solid fa-circle-check"></i> GATEWAY_ACTIVE_HARDENING_ON
        </div>
        
        <div class="rules-box">
            <div><i class="fa-solid fa-shield"></i> <span><strong>Boyut Sınırı:</strong> Max 2 MB (CWE-400 DoS Koruması)</span></div>
            <div><i class="fa-solid fa-code"></i> <span><strong>Uzantı Sınırı:</strong> Sadece PDF, PNG, JPG, DOCX (RCE Koruması)</span></div>
        </div>
        
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="file-upload-area" id="uploadArea">
                <i class="fa-solid fa-cloud-arrow-up" id="uploadIcon"></i>
                <div id="uploadText">Analiz Edilecek Dosyayı Seçin</div>
                <div class="file-name-display" id="fileName">Henüz dosya seçilmedi...</div>
                <input type="file" name="myFile" id="fileInput" required>
            </div>
            
            <button type="submit" name="submit" class="submit-btn">
                <i class="fa-solid fa-terminal"></i> GÜVENLİK ANALİZİNİ BAŞLAT
            </button>
        </form>
    </div>
</div>

<script>
    // Dosya seçildiğinde adını anlık ve havalı şekilde gösteren script
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileName');
    const uploadArea = document.getElementById('uploadArea');
    const uploadText = document.getElementById('uploadText');
    const uploadIcon = document.getElementById('uploadIcon');

    fileInput.addEventListener('change', function() {
        if(this.files.length > 0) {
            fileNameDisplay.textContent = "Seçilen: " + this.files[0].name;
            fileNameDisplay.style.color = "#00ff66";
            uploadText.textContent = "Dosya Analize Hazır!";
            uploadArea.style.borderColor = "#00ff66";
            uploadIcon.style.color = "#00ff66";
        }
    });
</script>

</body>
</html>