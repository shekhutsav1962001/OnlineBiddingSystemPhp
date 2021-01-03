<?php
session_start();
$db = new SQLite3('db.sqlite3');
$res = $db->query('select id,username,password from user_details');
$flag=0;
$uname=$_POST['username'];
$pass=$_POST['pass'];
while ($row = $res->fetchArray()) {
    if(($uname)===($row['username']) && ($pass)===($row['password']))
    {
        $flag=1;
        $_SESSION['id']=$row['id'];
        $_SESSION['username']=$uname;
        $_SESSION['logged']="in";
        header("Location: home.php");
    }
}
if($flag===0){
    $msg="Incorect username or password";
    header("Location: index.php?msg=$msg");
}
?>