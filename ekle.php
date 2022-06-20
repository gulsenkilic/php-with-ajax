<?php 

if($_POST) { //Post Kontrolüm
 
    //$sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birthplace = $_POST['birthplace'];
    $birthdate = $_POST['birthdate'];

    if($fname==NULL){
        $fname="xxx";
    }
    if($lname==NULL){
       $lname="xxx";
   }
   if($birthplace==NULL){
       $birthplace="xxx";
   }
   if($birthdate==NULL){
       $birthdate="1000-01-01";
   }
 

    $sql="INSERT INTO STUDENT2 VALUE(NULL, '$fname', '$lname', '$birthplace', '$birthdate');";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
	$sonuc = mysqli_query($baglanti, $sql);

    $sql2="SELECT * FROM student2 ORDER BY sid DESC LIMIT 1"; //son kaydın id si alınır
    $sonuc2 = mysqli_query($baglanti, $sql2);
    $record = mysqli_fetch_object($sonuc2);
   echo $record->sid;
  
}
?>