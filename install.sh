#!/bin/bash
echo "[+] Proje kurulumu başlatılıyor..."
chmod +x install.sh
echo "[+] Bağımlılıklar kontrol ediliyor..."
if ! command -v php &> /dev/null
then
    echo "[-] PHP bulunamadı, lütfen PHP yükleyin."
    exit
fi
echo "[+] Kurulum tamamlandı. 'make run' komutu ile projeyi başlatabilirsiniz."