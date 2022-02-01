# eks
 Büyükbaş ve küçükbaş hayvan kayıt sistemi ile ev için hatırlatıcı, not vs. uygulamaları
# kurulum
* Dosyaları kendi sunucunuza kopyalayın.
* 'databese.sql' dosyasını kendi veritabanınıza içe aktarın.
* 'baglan.php' dosyasını açıp kendi veritananınıza göre düzenleyiniz.
    Bu adımlardan sonra sistem kullanıma hazır olacaktır.
# yapılacaklar
* ✓ Kuzu Doğum kaydı eklerken girişte kaçız kuzu bilgisi alınsın ve ona göre toplu giriş imkanı verilsin. Tek tek zor oluyor ve sıkıyor.. Yanlış bilgi girmeye de mahal verebilir.
* toplu koyun eklemde sıkıntı olabilir. Kardeş sayıları hesaplanmıyor. sayfa yönlendirmesi foreach in içinde, denemedim ama sorun çıkabilir. Her işlemi kontrol etmek, en son yönlendirme yapmak gerek.
* koyun grup ayrıntı sayfasında hayvan ekleme yok, olması gerek..
* ✓ rasyon silerken rasyon_yem tablosundaki verileri de temizle
* rasyon grafikler çalışmıyor
* rasyona eklenecek yemlere stok kontrolü yapmak gerek
* ✓ get işlemlerinde oturum kontrolü yap. direkt ```if($_SESSION['']){header("giris.php")}``` olabilir diye umuyorum, tek tek paranteze almaktansa, yapıştır geç. 
    ```if(empty($_SESSION['kullanici_adi'])){
		header("Location:production/hesap.php?durum=pleaselogin");
	}
	else.....
	```
	tam olarak böyle. tabi, biraz daha değişebilir, session tarafı
* htaccess engellemeleri araştır, uygula - https://www.etkisizeleman.com/nedir/htaccess-guvenlik-ayarlari-nasil-yapilir
* get işlemlerinde session kontrolü var ama sessiondaki kullanici id de kontrol edilmeli, yoksa herhangi bir kullanıcı herhangi bir kaydı silebilir
* SQL injection engelle. halihazırda script çalışıyor 
* yapılacaklar çalışmıyor

# güvenlik önerileri
* header ve footer çalışacak sayfalarda ```define("sabitdeger",true);``` gibi bir değişken oluşturuyoruz
sonra header ve footer a ```echo !defined("sabitdeger") ? die ("sayfa bulunamadı veya 404 e yönlendir falan, en iyi index gibi") : null;```
maksat tek olarak çağırılamasınlar
* girişlerde eposta ile giriş kullan || eposta validate: ```if(!filter_var($eposta, FILTER_VALIDATE_EMAIL)){ echo "eposta değil"}```
* Oturum sonlandırıldığı halde kapatılmamış tarayıcıda kalan çerezin art niyetle kullanılamaması için her oturum başlatıldığında ID değiştirin; ```session_regenerate_id(true);```
* Standart oturumlar kullanmak yerine farklı isimler kullanın;  ```session_name("FARKLI-AD");```
* Her oturum için kısıtlı bir geçerlilik süresi atayın = ```$_SESSION["time"] = time() + 600 ; // Örneğin 10 dakika```
* Her sayfada oturum başlatın;
 ```if(version_compare(phpversion(), "5.4.0") != -1){
  if (session_status() == PHP_SESSION_NONE) {
   session_start();
  }
 } else {
  if(session_id() == '') {
   session_start();
  }
 }
 ```
* Yönetim sayfalarında zaman aşımına uğramış olanlar dahil yetkisiz erişimi yönlendirin, yetki devam ediyorsa oturum zamanını yeniden atayarak kullanıcının oturum süresini sıfırlayın;
 ```
 if(isset($_SESSION["time"]) && time() < $_SESSION["time"] ) {
  $_SESSION["time"] = time() + 600;
 } else {
  header ("location:login.php");
  exit();
 }
 ```
* Oturum zamanı ve adı gibi verileri sabit değerler olarak tanımlayıp kullanmak, session işlemlerini ayrı kaydedip include/require ile dahil etmek, her sayfaya dahil etmek yerine yönetim panelinin header sayfasında tek seferde kullanmak vb. planlamalar kod hakimiyetini artırır, denetimi kolaylaştırır ve hata oranını düşürür. Farklı yerlerde her bir iş için yetki kontrolü yapılmaz !
* images klasöründe input temizleme ile alakalı fonksiyonlar var. sql injection için uygula
