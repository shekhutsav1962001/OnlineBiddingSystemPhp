<?php
session_start();
$db = new SQLite3('db.sqlite3');

$randomid=$_SESSION['otp'];
$otp=$_POST['otp'];
if($otp == $randomid)
{
    if($_POST['pass']==$_POST['repass'])
    {
        $rows=$db->query("select * from user_details");
        while($row=$rows->fetchArray())
        {
            if($row['email']==$_SESSION['email'])
            {
                $id=$row['id'];
            }
        }
        
        //echo $query;
        $pass=$_POST['pass'];
        $query="UPDATE user_details  SET password='".$pass."' WHERE id=$id";
        if($db->query($query)){
        $msg="Password changed successfully";
        unset($_SESSION['email']);
        unset($_SESSION['otp']);
        header("Location: index.php?msg=$msg");
        }
        else
            echo "password didn't reflet database";
        
    }
    else
    {
        $msg="Passwords didn't match";
        header("Location: otp.php?msg=$msg");
    }
}
 else {
    $msg="OTP didn't match";
    header("Location: otp.php?msg=$msg");
}
?>