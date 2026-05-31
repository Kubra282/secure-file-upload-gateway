<p align="center">
  <img width="204" height="192" alt="isu_logo" src="https://github.com/user-attachments/assets/83b47ed4-0449-4454-82ec-06c9c08eef43" />
</p>

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
│       └── ci.yml              # Sürekli entegrasyon ve otomatik test pipeline hattı
├── docs/
│   └── google_artifact_registry.md # Google Artifact Registry bulut dağıtım rehberi
├── reports/
│   └── security_report.md      # Akademik siber güvenlik proje raporu
├── src/
│   ├── index.php               # Güvenli terminal arayüzü ve yükleme formu (Hardened UI)
│   └── upload.php              # Backend güvenlik filtreleri ve analiz mekanizması
├── tests/
│   ├── test_upload_security.sh # Otomatik sızma testi (Pentest) simülasyon betiği
│   └── README.md               # Test senaryoları dokümantasyonu
├── .env.example                # Merkezi güvenlik politikası yapılandırma şablonu
├── .gitattributes              # Git satır sonu ve dil algılama optimizasyonları
├── .gitignore                  # GitHub'a yüklenmeyecek sistem ve geçici dosya filtreleri
├── Dockerfile                  # Uygulamanın izole konteyner yapılandırması
├── LICENSE                     # MIT Lisansı açık kaynak kullanım izni
├── install.sh                  # Otomatik kurulum ve yetkilendirme Bash betiği
├── Makefile                    # Linux/Mac ortamları için hızlı terminal komutları
├── requirements.txt            # Bağımlılıklar ve statik tarama araçları listesi
└── TODO.md                     # Proje yol haritası ve geliştirme aşamaları

## 🔍 Ele Alınan Zafiyetler ve Güvenlik Filtreleri

### 1. CWE-434: Unrestricted Upload of File with Dangerous Type
Saldırganların web sunucusu üzerinde doğrudan zararlı kod çalıştırmasını (**Remote Code Execution - RCE**) engellemek amacıyla katı bir whitelist (beyaz liste) politikası uygulanmıştır.

* **İzin Verilen Uzantılar:** `pdf`, `png`, `jpg`, `jpeg`, `docx`
* **Mekanizma:** Gelen isteklerin uzantıları `pathinfo()` ile ayıklanarak küçük harfe çevrilir ve `in_array()` fonksiyonu ile kontrol edilir. `.php` gibi tehlikeli uzantılar tespit edildiği an işlem kesilerek `CRITICAL_SECURITY_ALERT` üretilir.

### 2. CWE-400: Uncontrolled Resource Consumption (DoS)
Sunucunun disk alanını, CPU ve bellek kaynaklarını doldurarak yasal kullanıcıların hizmet almasını engellemeye yönelik yapılan **Denial of Service (DoS)** saldırılarına karşı sınırlandırma getirilmiştir.

* **Maksimum Boyut Sınırı:** 2 MB (2,097,152 Bayt)
* **Mekanizma:** Dosya sunucuya kalıcı olarak kaydedilmeden önce boyutu denetlenir. Sınırı aşan talepler doğrudan reddedilerek `RESOURCE_EXHAUSTION_LIMIT` uyarısı verilir.

---

## 🚀 Kurulum ve Çalıştırma Talimatları

Proje çapraz platform (Cross-Platform) mimarisine uygun olarak 3 farklı yöntemle çalıştırılabilmektedir:

### Yöntem A: Windows & XAMPP Lokal Sunucu Ortamı (Canlı Deneyim)
Projeyi Windows tabanlı bilgisayarlarda klasik yöntemle test etmek için aşağıdaki adımları izleyin:

1. `src/` klasörünün içerisindeki `index.php` ve `upload.php` dosyalarını kopyalayın.
2. Bilgisayarınızdaki yerel diskte bulunan `C:\xampp\htdocs\proje\` dizinini oluşturup altına yapıştırın.
3. XAMPP Control Panel uygulamasını açın ve **Apache** servisini başlatın (**Start** butonuna basın).
4. Herhangi bir web tarayıcısı (Chrome, Edge vb.) açarak adres satırına `http://localhost/proje/index.php` yazarak arayüze erişin.

### Yöntem B: Docker İle Çalıştırma (Sandbox Konteynerizasyon)
Uygulamayı tamamen izole, güvenli bir sandbox konteyneri içinde ayağa kaldırmak için terminalde şu komutları çalıştırın:

```bash
# 1. Docker imajını oluşturun
docker build -t guvenli-dosya-paneli .

# 2. Konteyneri 8080 portunda başlatın
docker run -d -p 8080:80 --name web-guvenlik-projesi guvenli-dosya-paneli
Erişim Adresi: http://localhost:8080
make run