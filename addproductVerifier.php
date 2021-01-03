<?php
session_start();
$owner=$_SESSION["id"];
$name=$_POST['name'];
$tag=$_POST['tag'];
$short_disc=$_POST['sdis'];
$long_dis=$_POST['ldis'];
$price=$_POST['price'];
$auction_date=$_POST['s_date'];
$auction_time=$_POST['s_time'];
$db = new SQLite3('db.sqlite3');

//profile image
$img_name=$_FILES['img']['name'];
$img_temp=$_FILES['img']['tmp_name'];
$exp=  explode(".",$img_name);
$ext=end($exp);
$img=time().'.'.$ext;
$location="pics/".$img;
move_uploaded_file($img_temp, $location);

$i=1;
//optional image1
if (isset($_FILES['img1'])) {
    $img1_name = $_FILES['img1']['name'];
    $img1_temp = $_FILES['img1']['tmp_name'];
    $exp = explode(".", $img1_name);
    $ext = end($exp);
    $img1 = time() . $i . '.' . $ext;
    $location1 = "pics/" . $img1;
    move_uploaded_file($img1_temp, $location1);
}
$i=2;
//optional image2
if (isset($_FILES['img2'])) {
    $img2_name = $_FILES['img2']['name'];
    $img2_temp = $_FILES['img2']['tmp_name'];
    $exp = explode(".", $img2_name);
    $ext = end($exp);
    $img2 = time() . $i . '.' . $ext;
    $location2 = "pics/" . $img2;
    move_uploaded_file($img2_temp, $location2);
}
$i = 3;
//optional image3
if (isset($_FILES['img1'])) {
    $img3_name = $_FILES['img3']['name'];
    $img3_temp = $_FILES['img3']['tmp_name'];
    $exp = explode(".", $img3_name);
    $ext = end($exp);
    $img3 = time() . $i . '.' . $ext;
    $location3 = "pics/" . $img3;
    move_uploaded_file($img3_temp, $location3);
}
$i = 4;
//optional image4
if (isset($_FILES['img1'])) {
    $img4_name = $_FILES['img4']['name'];
    $img4_temp = $_FILES['img4']['tmp_name'];
    $exp = explode(".", $img4_name);
    $ext = end($exp);
    $img4 = time() . $i . '.' . $ext;
    $location4 = "pics/" . $img4;
    move_uploaded_file($img4_temp, $location4);
}
$db->query("INSERT INTO Products(name,tag,short_disc,long_disc,base_price,current_price,auction_date,auction_time,owner,profile,img1,img2,img3,img4) VALUES('".$name."','".$tag."','".$short_disc."','".$long_dis."','".$price."','".$price."','".$auction_date."','".$auction_time."','".$owner."','".$location."','".$location1."','".$location2."','".$location3."','".$location4."')");
  
header("Location: home.php");
?>

