<?php 
 $sid = $_POST['sid'];
 $fname = $_POST['fname'];
 $lname = $_POST['lname'];
 $birthplace = $_POST['birthplace'];
 $birthdate = $_POST['birthdate'];

 $sql="UPDATE STUDENT2 SET fname='$fname',lname='$lname',birthplace='$birthplace',birthdate='$birthdate' WHERE sid=$sid LIMIT 1;";
 $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
 $sonuc = mysqli_query($baglanti, $sql);
 if(!$baglanti)exit(mysqli_error($baglanti));

?>