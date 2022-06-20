<html>
<head>
  <title>STUDENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <style> a:link, a:visited {color: black;} </style>
</head>
<body>
   
<?php 
    error_reporting(E_ERROR | E_PARSE);
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    $kayitKumesi = mysqli_query($baglanti, "SELECT * FROM student2");
    
    $query = mysqli_query($baglanti, "SELECT count(*) FROM student2");
    $total = mysqli_fetch_array($query);

    $query2 = mysqli_query($baglanti, "SELECT * FROM student2 ORDER BY sid DESC LIMIT 1");
	$lastid = mysqli_fetch_object($query2);

    $totalsatir= $total[0];
    $sid="sid";

    echo "<div align='center' class='container'>
    <h1>ÖĞRENCİLER</h1>
    <input name=fname class='search' placeholder='BİR SEY YAZIN' size='90' type=text>
    <br>
    <br>
    <form>
    <input type='hidden' id='siralama' value='ASC'>
    <table class='table table-hover results' id='mytable'>
    <tr>
    <th><input type='button' value='ID' onclick=\"sirala('sid')\"> </th>
    <th><input type='button' value='AD' onclick=\"sirala('fname')\"></th>
    <th><input type='button' value='SOYAD' onclick=\"sirala('lname')\"></th>
    <th><input type='button' value='DOGUM YERI' onclick=\"sirala('birthplace')\"></th>
    <th><input type='button' value='DOGUM TARIHI' onclick=\"sirala('birthdate')\"></th>
    <th></th>
    <th></th>  
    </tr>";
    

    print "<tr> 
    <td></td><form>
    <td><input name=fname type=text id='fname' required></td>
    <td><input name=lname type=text id='lname' required></td>
    <td><input name=birthplace type=text id='birthplace' required></td>
    <td><input name=birthdate type=date id='birthdate' required></td>
    <td><button type='reset' class='btn btn-danger  btn-block'>TEMİZLE</button>
    <td><button type='button' onclick='ekle(this.form)'class='btn btn-primary  btn-block'>EKLE</button></td></form></tr>";
    while($satir = mysqli_fetch_assoc($kayitKumesi)){
        echo " <tr id='{$satir['sid']}'> 
        <td id='1{$satir['sid']}'><p id='s{$satir['sid']}'>{$satir['sid']}</p></td> 
        <td id='2{$satir['sid']}'><p id='f{$satir['sid']}'>{$satir['fname']}</p><input id='fg{$satir['sid']}' type='hidden' value='{$satir['fname']}'></td>
        <td id='3{$satir['sid']}'><p id='l{$satir['sid']}'>{$satir['lname']}</p><input id='lg{$satir['sid']}' type='hidden' value='{$satir['lname']}'></td>
        <td id='4{$satir['sid']}'><p id='bp{$satir['sid']}'>{$satir['birthplace']}</p><input id='bpg{$satir['sid']}' type='hidden' value='{$satir['birthplace']}'></td>
        <td id='5{$satir['sid']}'><p id='bd{$satir['sid']}'>{$satir['birthdate']}</p><input id='bdg{$satir['sid']}' type='hidden' value='{$satir['birthdate']}'></td>
        
        <td id='reset{$satir['sid']}'><input class='btn btn-danger' type='button' value='OGRENCI SIL' onclick='sil({$satir['sid']})'></td>
        
        <td id='update{$satir['sid']}'><input class='btn btn-primary' id='h{$satir['sid']}' type='button' value='GUNCELLE' onclick='showhidden({$satir['sid']})'>
        <input class='btn btn-primary' id='g{$satir['sid']}' type='hidden' value='KAYDET' onclick='guncelle({$satir['sid']})'></td>
        </tr>
        <input type='hidden' id='totalRow' name='totalRow' value='$totalsatir'>
		<input type='hidden' id = 'lastRecordId' name='lastRecordId' value='$lastid->sid'>
        ";
    }
    print "</div></form>";
?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
  </html>
  <script>
  $(".search").keyup(function() {
  var searchTerm = $(".search").val();
  var bulunan = 0
  $('.results  tr').each(function(e) {
      var table = $(this)
      if (table.text().toLowerCase().includes(searchTerm.toLowerCase())) {
          bulunan += 1
          table.show()
          $(".counter").text(bulunan + " kayıt bulundu")
          $(".no-result").css('display', 'none')
      } else {
          table.hide()
          $(".counter").text(bulunan + " kayıt bulundu")
          if (bulunan == 0) {
              $(".no-result").css('display', '')
          }
      }
  })
});

function sirala(sutunad){
    
    var recordId = parseInt(document.getElementById("lastRecordId").value);
    var sirala = document.getElementById("siralama").value;
    $.ajax({
        type: 'GET',
		url: 'sirala.php',
		data: {
		sutunad: sutunad,
		sirala: sirala
		},
        success: function(data) {
            if (sirala == "ASC") { document.getElementById("siralama").value = "DESC";} 
            else {document.getElementById("siralama").value = "ASC";}
			var sids = [];
            for (let x = 0; x < $.parseJSON(data).length; x++) { 
			sids[x] = (JSON.parse(data))[x].sid;
			}
            var siralama = sids.sort(function(a, b) {return a - b;});

            for (let i = 0; i <= $.parseJSON(data).length; i++) {
			if (siralama[i] <= recordId) {
			var id = (JSON.parse(data))[i].sid;     
            document.getElementById("1" + siralama[i]).innerHTML = (JSON.parse(data))[i].sid;
            document.getElementById("2" + siralama[i]).innerHTML = "<p id='f" + id + "'>" + (JSON.parse(data))[i].fname + "</p> <input type='hidden' id='fg" + id + "' value='" + (JSON.parse(data))[i].fname + "'>";
            document.getElementById("3" + siralama[i]).innerHTML = "<p id='l" + id + "'>" + (JSON.parse(data))[i].lname + "</p> <input type='hidden' id='lg" + id + "' value='" + (JSON.parse(data))[i].lname + "'>";
            document.getElementById("4" + siralama[i]).innerHTML = "<p id='bp" + id + "'>" + (JSON.parse(data))[i].birthplace + "</p> <input type='hidden' id='bpg" + id + "' value='" + (JSON.parse(data))[i].birthplace + "'>";
            document.getElementById("5" + siralama[i]).innerHTML = "<p id='bd" + id + "'>" + (JSON.parse(data))[i].birthdate + "</p> <input type='hidden' id='bdg" + id + "' value='" + (JSON.parse(data))[i].birthdate + "'>";
           
            document.getElementById("update" + siralama[i]).innerHTML = "<input class='btn btn-primary' id='h" + id + "'  type='button' value='GUNCELLE' onclick='showhidden(" + id + ")'> <input class='btn btn-primary' id='g" + id + "'  type='hidden' value='KAYDET' onclick='guncelle(" + id + ")'>";
            document.getElementById("reset" + siralama[i]).innerHTML = "<input class='btn btn-danger' type='button' value='OGRENCI SIL' onclick='sil(" + id + ")'>";
					}			
					}
        }

    })
} 
 function sil(sid){
    if(confirm("BU ÖĞRENCİYİ SİLMEK İSTİYOR MUSUNUZ?")){
        $.ajax({
        type: "POST",
        url: "sil.php",
        data: {sid:sid},
        success:function(data){
        alert('işlem başarılı');
        var row = document.getElementById(sid);
    row.deleteCell(0);
    row.deleteCell(0);
    row.deleteCell(0);
    row.deleteCell(0);
    row.deleteCell(0);
    row.deleteCell(0);
    row.deleteCell(0);
  
    }
    })}
}
function ekle(form){
            var fname = form.fname.value;
			var lname = form.lname.value;
			var birthplace = form.birthplace.value;
			var birthdate = form.birthdate.value;
			var totalRow = parseInt(document.getElementById("totalRow").value) + 2;
        if(fname==""){
             $fname="xxx";
         }
         if(lname==""){
            $lname="xxx";
        }
        if(birthplace==""){
            $birthplace="xxx";
        }
        if(birthdate=="0000-00-00"){
            $birthdate="1000-01-01";
        }
       

           // var x= document.getElementById("lastRecordId").value)+1;
            $.ajax({
            type: "POST",
            url: "ekle.php",
            data: {
                    fname: fname,
					lname: lname,
					birthplace: birthplace,
					birthdate: birthdate
            },
            success: function(data){
                var form=document.getElementById("mytable");
                var row = form.insertRow(2);
				row.sid = data;
               // var x=document.getElementById("lastRecordId").value;
                //x++;
               // alert(x);
                    var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var cell5 = row.insertCell(4);
					var cell6 = row.insertCell(5);
					var cell7 = row.insertCell(6);
                    cell1.id = "s" + data;
                   // cell1.innerHTML ="<p id='s" + data + "'>" + x + "</p>"; 
                   cell1.innerHTML = data;
                  // console.log(data);
                    cell2.innerHTML = "<p id='f" + data + "'>" + fname + "</p> <input type='hidden' id='fg" + data + "' value='" + fname + "'>";
					cell3.innerHTML = "<p id='l" + data + "'>" + lname + "</p> <input type='hidden' id='lg" + data + "' value='" + lname + "'>";
					cell4.innerHTML = "<p id='bp" + data + "'>" + birthplace + "</p> <input type='hidden' id='bpg" + data + "' value='" + birthplace + "'>";
					cell5.innerHTML = "<p id='bd" + data + "'>" + birthdate + "</p> <input type='hidden' id='bdg" + data + "' value='" + birthdate + "'>";
					cell7.innerHTML = "<input class= 'btn btn-primary' type='button' id='h" + data + "' value='GUNCELLE'  onclick='showhidden(" + data + ")'> <input class= 'btn btn-primary' type='hidden' id='g" + data + "' value='KAYDET' style='width:75px;' onclick='guncelle(" + data + ")'>";
					cell6.innerHTML = "<input class='btn btn-danger' type='button' value='OGRENCI SIL' onclick='sil(" + data + ")'>";
            
                    alert("KAYIT BASARI İLE EKLENDI");
            },
            })
}
function showhidden(sid){
            document.getElementById("h" + sid).type = 'hidden';
			document.getElementById("g" + sid).type = 'button';

			document.getElementById("f" + sid).style.display = "none";
			document.getElementById("fg" + sid).type = "text";
			document.getElementById("l" + sid).style.display = "none";
			document.getElementById("lg" + sid).type = "text";
			document.getElementById("bp" + sid).style.display = "none";
			document.getElementById("bpg" + sid).type = "text";
			document.getElementById("bd" + sid).style.display = "none";
			document.getElementById("bdg" + sid).type = "date";
}
function guncelle(sid){
    var fname = document.getElementById("fg" + sid).value;
	var lname = document.getElementById("lg" + sid).value;
	var birthplace = document.getElementById("bpg" + sid).value;
	var birthdate = document.getElementById("bdg" + sid).value;
    $.ajax({
				type: "POST",
				url: "guncelle.php",
				data: {
					sid: sid,
					fname: fname,
					lname: lname,
					birthplace: birthplace,
					birthdate: birthdate
				},
				success: function(data) {
					alert("KAYIT BAŞARI ILE GUNCELLENDI");
					$("#f" + sid).html(fname);
					$("#l" + sid).html(lname);
					$("#bp" + sid).html(birthplace);
					$("#bd" + sid).html(birthdate);

					document.getElementById("h" + sid).type = 'button';
					document.getElementById("g" + sid).type = 'hidden';

					document.getElementById("f" + sid).style.display = "block";
					document.getElementById("fg" + sid).type = "hidden";
					document.getElementById("l" + sid).style.display = "block";
					document.getElementById("lg" + sid).type = "hidden";
					document.getElementById("bp" + sid).style.display = "block";
					document.getElementById("bpg" + sid).type = "hidden";
					document.getElementById("bd" + sid).style.display = "block";
					document.getElementById("bdg" + sid).type = "hidden";

				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			})
}


</script>