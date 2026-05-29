# 🛡️ CyberShield // Secure File Upload Gateway

Bu proje, web uygulamalarında en sık karşılaşılan kritik güvenlik zafiyetlerinden olan **Güvenli Olmayan Dosya Yükleme (Unrestricted File Upload)** ve **Kaynak Tükenmesi (Resource Exhaustion)** durumlarını engellemek amacıyla geliştirilmiş, sunucu tarafı tahkimatı (Server-Side Hardening) yapılmış güvenli bir dosya yükleme simülasyonudur.

---

## 👤 Öğrenci Bilgileri
* **Adı Soyadı:** Kübra Fison
* **Öğrenci Numarası:** 2420191055
* **Üniversite / Bölüm:** İstinye Üniversitesi // Bilişim Güvenliği Teknolojisi
* **Ders:** Güvenli Web (Dönem Projesi)

---

## 📊 Proje Durumu & Özellikleri
![PHP Version](https://img.shields.io/badge/PHP-8.2--apache-blue?style=for-the-badge&logo=php)
![Docker Compliant](https://img.shields.io/badge/Docker-Compatible-2496ED?style=for-the-badge&logo=docker)
![Security Focus](https://img.shields.io/badge/Security-Hardened-success?style=for-the-badge)

* 🖥️ **Siber Güvenlik Temalı Arayüz:** Modern, karanlık mod (Dark Mode) destekli fütüristik terminal tasarımı.
* 🛑 **CWE-400 (DoS) Koruması:** Sunucu kaynaklarını tüketmeye yönelik aşırı büyük dosya yükleme girişimlerinin tespiti ve engellenmesi.
* ☣️ **CWE-434 (RCE) Koruması:** `.php`, `.exe` gibi zararlı veya çalıştırılabilir script uzantılarının backend filtreleriyle tamamen engellenmesi.

---

## 📁 Proje Dizin Yapısı
```text
.
├── .github/
│   └── workflows/
│       └── ci.yml             # Sürekli entegrasyon ve otomatik test pipeline hattı
├── docs/
│   └── README.md              # Teknik dokümantasyon dosyası
├── reports/
│   └── security_report.md     # Akademik siber güvenlik proje raporu
├── src/
│   ├── index.php              # Güvenli terminal arayüzü ve yükleme formu
│   └── upload.php             # Backend güvenlik filtreleri ve analiz mekanizması
├── tests/                     # Proje doğrulama ve sızma testi dizini
├── Dockerfile                 # Uygulamanın izole konteyner yapılandırması
├── install.sh                 # Otomatik kurulum ve yetkilendirme Bash betiği
├── Makefile                   # Linux/Mac ortamları için hızlı terminal komutları
├── requirements.txt           # Bağımlılıklar ve statik tarama araçları listesi
└── TODO.md                    # Proje yol haritası ve geliştirme aşamaları

# 1. Docker imajını oluşturun
docker build -t guvenli-dosya-paneli .

# 2. Konteyneri 8080 portunda başlatın
docker run -d -p 8080:80 --name web-guvenlik-projesi guvenli-dosya-paneli 