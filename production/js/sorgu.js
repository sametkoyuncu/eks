$(function(){
        $("input[name='kullanici_adi']").keyup(function(){
          var kullanici_adi = $(this).val();
          //document.load("kullanici-sorgu.php?kullanici=kullanici_adi");
          //alert(kullanici_adi);

          $.ajax({  
              type: 'POST',  
              url: '../kullanici-sorgu.php', 
              data: { kullanici: kullanici_adi },
              success:function(sonuc){
                if (sonuc==1) {
                  alert("Bu kullanıcı adı kullanımda, lütfen başka bir kullnıcı adı giriniz.");
                } else {

                }
                
                //$("#kullanici_adi").html(sonuc);
              }
          });

        });
      });