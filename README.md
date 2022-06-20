# php-with-ajax
1. Sayfaya ilk girildiğinde student tablosundaki kayıtlar SELECT ve PHP ile aşağıdaki resimdeki gibi
listelenecektir. Bu HTML TABLE'daki OLUŞTUR, SİL, GÜNCELLE BUTONLARINA tıklayarak yeni öğrenci 
kaydı INSERT ile, silinecek kayıt DELETE ile ve yeni kayıt değerleri verilen kayıtlar UPDATE ile 
vritabanında güncellenecektir.


1. HTML FORMnunun 3. Satırındaki INPUT kutucuklarına yeni öğrencinin adı, soyadı, doğum 
yeri ve tarihi kullanıcı tarafından girilip OLUŞTUR butonuna tıklanacak ve yeni girilen 
değerler AJAX ile yeni.php scriptine
yeni.php?no=xxx&ad=yyy&soyad=zzz&dtarih=ddd&dyer=hhhh şeklinde gönderilecek, yeni 
değerler bu scriptte INSERT ile veritabanına eklenecek, oluşan yeni sid değeri çağıran AJAX'a 
geri döndürülecek, yeni kayıt HTML tablosuna function yeni(){…} adlı javascript fonksiyonu 
ile eklenecek ve sayfada görüntülecektir. INSERT işlemi başarısız olursa kullanıcıya javascript 
alert fonksiyonuyla bir uyarı mesajı gösterilecektir.


2. SİL butonuna tıklanınca AJAX ile silinecek öğrencinin sid'si sil.php?no=33 şeklinde sil.php'ye 
gönderilecek, sil.php2de bu öğrencinin kaydı DELETE ile silinecek, işlem başarılı ise 1, bşarısız 
ise hata mesajı geri dönderilecek, function sil(){…} adlı bir javascript fonksiyonu ile ilgili satır 
yani TR elementi TABLE tablosundan silinecektir. 


3. GÜNCELLE butonuna tıklanınca TABLE'ın o satırındaki yani o TR'sindeki adı, soyadı, doğum 
yeri ve tarihi TD kutucuklarının içindee INPUT kutucukları oluşturulacak ve bu INPUT'lar 
içinde değiştirilecek değerler gösterilecek ve GÜNCELLE butonu SAKLA butonuna 
değiştirilecektir. Kullanıcı INPUTlardaki değerleri değiştirip SAKLA butonuna tıklayınca, AJAX 
ile yeni değerler guncelle.php'ye 
guncelle.php?sid=xxx&ad=ttt&soyad=eee,dtarih=rrr&dyer=qqq şeklinde gönderilecek, 
güncelle.php içinde UPDATE ile değerler veritabanına göncellenecek ve sonuç başarılı ise 1 
değişse ilgili hata mesajı geri döndürülecektir. Sonra TABLE'ın o satırındaki INPUT kutuları 
silinecek yerlerine yeni değerler TR içinde gösterilecek ve SAKLA butonu yeniden GÜNCELLE
olarak değiştirilecektir.

2. Şekilde verildiği gibi sütün başlıklarına tıklanarak kayıtlar azalan ve artan sırada sıralanacak ve her 
sayfada 5 kayıt olmak üzere sayfalama yapılacaktır. Sayfalama için tablonun altında ilk sayfa linki, 
sonraki sayfa linki, önceki 3 sayfanın linkleri, şimdiki sayfanın numarası, sonraki 3 sayfanın linkleri, 
sonraki sayfa linki, ve son sayfa linkleri bulunacaktır. Bu işlem PHP de değil Javascriptte yapılacaktır
