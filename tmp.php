<?php
//date_default_timezone_set('Asia/Kolkata');
////$now=strtotime("now");
//echo "Today is " . date("Y/m/d h:i:sa") . "<br>";
//$d1=strtotime("10:40am");
//$d2=strtotime("12:30am");
//$d=$d1-  strtotime("now");
////echo "<br>now".date("h:i:sa", $now)."<br>";
//echo $d."<br>";
//echo "Created date is " . date("h:i:sa", $d);
//$db = new SQLite3('db.sqlite3');
//$rows=$db->query("select * from Products");
//while ($row = $rows->fetchArray()) {
////   echo time('H:i:sa', strtotime($row['auction_time']))->formate;
//    $d=strtotime($row['auction_time']);
//echo "Created date is " . date("g:ia", $d)."<br>";
//echo date("Y/m/d",strtotime($row['auction_date']))."==".date("Y/m/d")."<br>";
//if(date("Y/m/d",strtotime($row['auction_date']))==date("Y/m/d"))
//{
//    echo "same date<br>";
//}
// else {
//    echo "not the same<br>";
// }
// if(date("Y/m/d",strtotime($row['auction_date']))==date("Y/m/d") && (strtotime("now")-strtotime($row['auction_time'])>=0 && strtotime("now")-strtotime($row['auction_time']) <= 3600))
//{
//    echo $row['name']."<br>";
//}
////echo "for past".date("Y/m/d",strtotime($row['auction_date']))."<=".date("Y/m/d")."<br>"; 
//if((strcmp("".date("Y/m/d",strtotime($row['auction_date'])),"".date("Y/m/d"))<0) || (strcmp("".date("Y/m/d",strtotime($row['auction_date'])),"".date("Y/m/d")))==0 && (strtotime("now")-strtotime($row['auction_time'])>7200))
//{
//    echo "past deal".$row['name']."<br>";
//}
//
//}


//-------------Mailing--------------
//require_once('PHPMailer/PHPMailerAutoload.php');
//$mail=new PHPMailer();
//$mail->isSMTP();
//$mail->SMTPAuth=TRUE;
//$mail->SMTPSecure='ssl';
//$mail->Host='smtp.gmail.com';
//$mail->Port='465';
//$mail->isHTML();
//$mail->Username='bidmafia007@gmail.com';
//$mail->Password='msodqaowigryvpvb';
//$mail->SetFrom('bidmafia007@gmail.com');
//$mail->Subject='Hello World';
//$mail->Body='A test email';
//$mail->AddAddress('vyompatel95745@gmail.com');
//if($mail->Send())
//    echo 'sent';
//else
//    echo 'failed';
//
echo strcmp("78","80");
?>