<?php 
$sirala = $_GET["sirala"];
$sutunad = $_GET["sutunad"];

$sql="SELECT * FROM student2 ORDER BY $sutunad $sirala;";
 $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
 $sonuc = mysqli_query($baglanti, $sql);

 $satir=array();
 while($satir2 =mysqli_fetch_assoc($sonuc)){
$satir[] = $satir2;
}
echo (json_encode($satir));
?>