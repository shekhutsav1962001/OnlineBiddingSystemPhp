<?php
$email=$_POST['email'];
$db = new SQLite3('db.sqlite3');
$res = $db->query('select email,username from user_details');
$flag=0;
while ($row = $res->fetchArray()) {
    if(($email)===($row['email']))
    {
        $flag=1;
        $username=$row['username'];
        break;
    }
}
if($flag===0)
{
    $msg="No user found with this email address";
}
else
{
    $msg="Your username is :".$username;
}
header("Location: forgot.php?username=$msg");
?>