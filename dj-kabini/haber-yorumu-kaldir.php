<?php
require_once "BasicDB.php";
require_once "baglan.php"; 
session_Start();
if($_SESSION["giris"] == false){
	header("Location: login.php");
    die("Burada olmaman gerekirdi!");
}
$uye_id = $_SESSION['id'];
$bilgiler = $db->select('authme')
			->where('id', $uye_id)
			->run(TRUE);
if($bilgiler["yetki"] == 0){
   header("Location: dj-listesi.php");
   die("Buraya erişme yetkin yok!");
}
$id=$_POST['idsi'];
$query = $db->update('haberyorum')
            ->where('idsi', $id)
			->set(array(
			'onay' => '0',
			));
   
if ( $query ){
  echo '<meta http-equiv="refresh" content="0;URL=haber-yorumlari.php">';
}else {
	echo "Yorum kaldırılamadı bir hata oluştu.";
}
?>