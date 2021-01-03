<?php

session_start();
$bidder=$_SESSION['id'];
$pid=$_GET['id'];
$db = new SQLite3('db.sqlite3');
$res=$db->query("select * from Products where id=$pid");
$row=$res->fetchArray();
$owner=$row['owner'];
$status="sold";
$c_price=$_SESSION['c_price'];
$bidprice=$_POST['bidprice'];
unset($_SESSION['c_price']);
if(strcmp($c_price, $_POST['bidprice'])>=0 )
{
    $_SESSION['biderror']="Bidding price must be greater than current price";
    
}
elseif($bidder = $owner){
    //$bidder=$_SESSION['id'];
    if($db->query("UPDATE Products  SET current_price =$bidprice , bidder =$bidder , status = 'sold'  WHERE ID=$pid;"))
    {
        
    }
    else
    {
        
    }
}
 else {
    $_SESSION['biderror']="you can't bid for product added by you";
    
}
header("Location:viewproduct.php?id=".$pid."");
?>