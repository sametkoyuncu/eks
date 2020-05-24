# eks
 Büyükbaş ve küçükbaş hayvan kayıt sistemi ile ev için hatırlatıcı, not vs. uygulamaları
# kurulum
    1- Dosyaları kendi sunucunuza kopyalayın.
    2- 'databese.sql' dosyasını kendi veritabanınıza içe aktarın.
    3- 'baglan.php' dosyasını açıp kendi veritananınıza göre düzenleyiniz.
    Bu adımlardan sonra sistem kullanıma hazır olacaktır.
# yapılacaklar
    ✓ 1- Kuzu Doğum kaydı eklerken girişte kaçız kuzu bilgisi alınsın ve ona göre toplu giriş imkanı verilsin. Tek tek zor oluyor ve sıkıyor.. Yanlış bilgi girmeye de mahal verebilir.
    2- toplu koyun eklemde sıkıntı olabilir. Kardeş sayıları hesaplanmıyor. sayfa yönlendirmesi foreach in içinde, denemedim ama sorun çıkabilir. Her işlemi kontrol etmek, en son yönlendirme yapmak gerek.
    3- koyun grup ayrıntı sayfasında hayvan ekleme yok, olması gerek..
    ✓ 4- rasyon silerken rasyon_yem tablosundaki verileri de temizle
    5- rasyon grafikler çalışmıyor
    6- rasyona eklenecek yemlere stok kontrolü yapmak gerek
    ✓ 7- get işlemlerinde oturum kontrolü yap. direkt if($_SESSION['']){header("giris.php")} olabilir diye umuyorum, tek tek paranteze almaktansa, yağıştır geç. 
    if(empty($_SESSION['kullanici_adi'])){
		header("Location:production/hesap.php?durum=pleaselogin");
	}
	else..... tam olarak böyle. tabi, biraz daha değişebilir, session tarafı
    8- htaccess engellemeleri araştır, uygula - https://www.etkisizeleman.com/nedir/htaccess-guvenlik-ayarlari-nasil-yapilir
    9- get işlemlerinde session kontrolü var ama sessiondaki kullanici id de kontrol edilmeli, yoksa herhangi bir kullanıcı herhangi bir kaydı silebilir
    10- SQL injection engelle. halihazırda script çalışıyor 
    11- yapılacaklar çalışmıyor

# güvenlik önerileri
    1- header ve footer çalışacak sayfalarda define("sabitdeger",true); gibi bir değişken oluşturuyoruz
sonra header ve footer a echo !defined("sabitdeger") ? die ("sayfa bulunamadı veya 404 e yönlendir falan, en iyi index gibi") : null;
maksat tek olarak çağırılamasınlar
    2-girişlerde eposta ile giriş kullan || eposta validate: if(!filter_var($eposta, FILTER_VALIDATE_EMAIL)){ echo "eposta değil"}
    3- Oturum sonlandırıldığı halde kapatılmamış tarayıcıda kalan çerezin art niyetle kullanılamaması için her oturum başlatıldığında ID değiştirin; session_regenerate_id(true);
    4- Standart oturumlar kullanmak yerine farklı isimler kullanın;  session_name("FARKLI-AD");
    5- Her oturum için kısıtlı bir geçerlilik süresi atayın = $_SESSION["time"] = time() + 600 ; // Örneğin 10 dakika
    6- Her sayfada oturum başlatın;
 if(version_compare(phpversion(), "5.4.0") != -1){
  if (session_status() == PHP_SESSION_NONE) {
   session_start();
  }
 } else {
  if(session_id() == '') {
   session_start();
  }
 }
    7- Yönetim sayfalarında zaman aşımına uğramış olanlar dahil yetkisiz erişimi yönlendirin, yetki devam ediyorsa oturum zamanını yeniden atayarak kullanıcının oturum süresini sıfırlayın;
 if(isset($_SESSION["time"]) && time() < $_SESSION["time"] ) {
  $_SESSION["time"] = time() + 600;
 } else {
  header ("location:login.php");
  exit();
 }
    8- Oturum zamanı ve adı gibi verileri sabit değerler olarak tanımlayıp kullanmak, session işlemlerini ayrı kaydedip include/require ile dahil etmek, her sayfaya dahil etmek yerine yönetim panelinin header sayfasında tek seferde kullanmak vb. planlamalar kod hakimiyetini artırır, denetimi kolaylaştırır ve hata oranını düşürür. Farklı yerlerde her bir iş için yetki kontrolü yapılmaz !
    9- images klasöründe input temizleme ile alakalı fonksiyonlar var. sql injection için uygula