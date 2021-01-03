<?php
session_start();
$db = new SQLite3('db.sqlite3');
$res = $db->query('select username,email from user_details');
$flag=0;
$email=$_POST['email'];
while ($row = $res->fetchArray()) {
    if(($email)===($row['username']) || ($email)===($row['email']))
    {
        $flag=1;
        $email_id=$row['email'];
        break;
    }
}
if($flag===0){
    $msg="No user found with that username/email";
    header("Location: forgot.php?msg=$msg");
}
 else {
    $randomid = mt_rand(100000, 999999);
    $_SESSION['otp']=$randomid;
    require_once('PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'bidmafia007@gmail.com';
    $mail->Password = 'your password';
    $mail->SetFrom('bidmafia007@gmail.com');
    $mail->Subject = 'Reset Password';
    $mail->Body = $randomid." is your otp to reset password";
    $mail->AddAddress($email_id);
    $mail->Send();
    $_SESSION['email']=$email_id;
    header("Location: otp.php");
}
?>

