# Güvenli Web Dersi Proje Raporu

**Proje Adı:** Dosya Yükleme Güvenliği ve DoS Koruması Simülasyonu  
**Zafiyet Kategorisi:** CWE-400 / Dağıtılmış Hizmet Dışı Bırakma (DoS)  

### 1. Risk Analizi
Saldırganlar, dosya yükleme formlarını kullanarak sunucuya gigabaytlarca büyüklükte dosyalar gönderebilir. Bu durum sunucunun disk alanını (Storage) veya işlemci gücünü tüketerek yasal kullanıcıların sisteme erişmesini engeller.

### 2. Uygulanan Çözüm
Geliştirilen backend script'i ile dosya sunucuya kalıcı olarak yazılmadan önce boyutu denetlenir. 2 MB üzerindeki talepler sunucu tarafından doğrudan reddedilerek kaynak tükenmesi engellenir.