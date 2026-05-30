#!/bin/bash
# TODO: Otomatik Güvenlik Sızma Testi Scripti (Pentest)

SERVER_URL="http://localhost/proje/upload.php"

echo "=== CYBERSHIELD OTOMATIK GÜVENLIK TESTLERI BAŞLADI ==="

echo -e "\n[TEST 1] Zararlı PHP Dosyası Yükleme Girişimi (CWE-434 RCE Kontrolü)..."
echo "<?php echo 'Hacked'; ?>" > malware.php
RESPONSE=$(curl -s -F "myFile=@malware.php" -F "submit=1" $SERVER_URL)
rm malware.php

if [[ $RESPONSE == *"CRITICAL_SECURITY_ALERT"* ]]; then
    echo "--> BAŞARILI: Sistem zararlı uzantıyı engelledi ve alarm üretti!"
else
    echo "--> BAŞARISIZ: Güvenlik filtresi aşıldı!"
fi

echo -e "\n[TEST 2] Aşırı Büyük Dosya Yükleme Girişimi (CWE-400 DoS Kontrolü)..."
# 3 MB sahte dosya oluşturuluyor
dd if=/dev/zero of=big_file.pdf bs=1M count=3 status=none
RESPONSE2=$(curl -s -F "myFile=@big_file.pdf" -F "submit=1" $SERVER_URL)
rm big_file.pdf

if [[ $RESPONSE2 == *"RESOURCE_EXHAUSTION_LIMIT"* ]]; then
    echo "--> BAŞARILI: Sistem aşırı büyük dosyayı reddetti ve sunucuyu korudu!"
else
    echo "--> BAŞARISIZ: DoS koruması devreye girmedi!"
fi

echo -e "\n=== TÜM TEST SENARYOLARI TAMAMLANDI ==="