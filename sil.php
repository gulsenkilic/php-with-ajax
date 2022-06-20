<?php 
if($_POST) { //Post Kontrolü

    $sid = $_POST['sid'];
    $sql = "DELETE FROM student WHERE sid='$sid';";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    if(!$baglanti)exit(mysqli_error($baglanti));
	 mysqli_query($baglanti, "DELETE FROM student2 WHERE sid=$sid;");
    if(!$sonuc) exit(mysqli_error($baglanti));
    }
?>