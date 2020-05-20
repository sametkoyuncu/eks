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
    7- get işlemlerinde oturum kontrolü yap. direkt if($_SESSION['']){header("giris.php")} olabilir diye umuyorum, tek tek paranteze almaktansa, yağıştır geç. 
    if(empty($_SESSION['kullanici_adi'])){
		header("Location:production/hesap.php?durum=pleaselogin");
	}
	else..... tam olarak böyle. tabi, biraz daha değişebilir, session tarafı
    8- htaccess engellemeleri araştır, uygula