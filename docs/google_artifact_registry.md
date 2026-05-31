# ☁️ Google Artifact Registry Dağıtım Rehberi (Hydra-Check & Gateway)

Bu doküman, uygulamanın konteyner imajlarının Google Cloud Platform (GCP) Artifact Registry üzerinde depolanması, zafiyet taramasından geçirilmesi ve bulut mimarisine entegrasyon adımlarını içerir.

---

## 🛠️ 1. Kimlik Doğrulama ve Bölge Yetkilendirmesi
Yerel sistemdeki Docker istemcisinin Google Cloud `europe-west3` (Frankfurt) bölge deposuna güvenli şekilde erişebilmesi için gerekli auth konfigürasyonu:

```bash
gcloud auth login
gcloud auth configure-docker europe-west3-docker.pkg.dev
```
