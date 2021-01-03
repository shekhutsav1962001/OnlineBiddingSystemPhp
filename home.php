<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$db = new SQLite3('db.sqlite3');
$res=$db->query("select * from Products");
while($product=$res->fetchArray())
{
    if($product['email_status']=="sent")
    {
        continue;
    }
    else
    {
        if((strcmp("".date("Y/m/d",strtotime($product['auction_date'])),"".date("Y/m/d"))<0) || (strcmp("".date("Y/m/d",strtotime($product['auction_date'])),"".date("Y/m/d")))==0 && (strtotime("now")-strtotime($product['auction_time'])>7200))
        {
            if($product['bidder'])
            {
                $bidder_id=$product['bidder'];
                $resBidder=$db->query("select * from user_details where id=$bidder_id");
                $bidder=$resBidder->fetchArray();
                $bidder_name=$bidder['name'];
                $bidder_email=$bidder['email'];
                
                $owner_id=$product['owner'];
                $resOwner=$db->query("select * from user_details where id=$owner_id");
                $owner=$resOwner->fetchArray();
                $owner_name=$owner['name'];
                $owner_email=$owner['email'];
                require_once('PHPMailer/PHPMailerAutoload.php');
                    $mail=new PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPAuth=TRUE;
                    $mail->SMTPSecure='ssl';
                    $mail->Host='smtp.gmail.com';
                    $mail->Port='465';
                    $mail->isHTML();
                    $mail->Username='bidmafia007@gmail.com';
                    $mail->Password='your password';
                    $mail->SetFrom('bidmafia007@gmail.com');
                    $mail->Subject='Online Bidding';
                    $mail->Body="Congratulations ".$bidder_name."<br>Now you are the new owner of ".$product['name']."<br>You can contact the seller at given email address<br>Seller name:".$owner_name."<br>Seller's email:".$owner_email."<br>You can contect him for further details :)";
                    $mail->AddAddress($bidder_email);
                    if($mail->Send())
                    {
                        $mail2=new PHPMailer();
                    $mail2->isSMTP();
                    $mail2->SMTPAuth=TRUE;
                    $mail2->SMTPSecure='ssl';
                    $mail2->Host='smtp.gmail.com';
                    $mail2->Port='465';
                    $mail2->isHTML();
                    $mail2->Username='bidmafia007@gmail.com';
                    $mail2->Password='your password';
                    $mail2->SetFrom('bidmafia007@gmail.com');
                    $mail2->Subject='Online Bidding';
                    $mail2->Body="Congratulations ".$owner_name."<br>Your product ".$product['name']." was sold to ".$bidder_name."(".$bidder_email.") for Rs.".$product['current_price']."<br>You can contact the buyer for further information :)";
                    $mail2->AddAddress($owner_email);
                        if($mail2->Send())
                        {
                            $query="UPDATE Products  SET email_status='sent' WHERE ID=".$product['ID']."";
                            if(!$db->query($query)){
                                echo 'unable to update';
                            }
                        }
                    }
            }
            else
            {
                $owner_id=$product['owner'];
                $resOwner=$db->query("select * from user_details where id=$owner_id");
                $owner=$resOwner->fetchArray();
                $owner_name=$owner['name'];
                $owner_email=$owner['email'];
                require_once('PHPMailer/PHPMailerAutoload.php');
                    $mail=new PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPAuth=TRUE;
                    $mail->SMTPSecure='ssl';
                    $mail->Host='smtp.gmail.com';
                    $mail->Port='465';
                    $mail->isHTML();
                    $mail->Username='bidmafia007@gmail.com';
                    $mail->Password='msodqaowigryvpvb';
                    $mail->SetFrom('bidmafia007@gmail.com');
                    $mail->Subject='Online Bidding';
                    $mail->Body="Hello ".$owner_name."<br>Your product ".$product['name']." was gone unsold in the auction.<br>Best of luck for the next time :)";
                    $mail->AddAddress($owner_email);
                    if($mail->Send())
                    {
                        $query="UPDATE Products  SET email_status='sent' WHERE ID=".$product['ID']."";
                            if(!$db->query($query)){
                                echo 'unable to update';
                            }
                    }
                
            }
        }
    }
}
if(!isset($_SESSION['logged']))
{
    header("Location:index.php");
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Header/logo Title */
.header {
  padding: 80px;
  text-align: center;
  background: #061644;
  color:  white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}
.navbar a.left{
  float: left;
}
/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.row {  
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  -ms-flex: 20%; /* IE10 */
  flex: 20%;
  background-color: #a1c0e4;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 80%; /* IE10 */
  flex: 80%;
  background-color: white;
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

.mainimg{
  border-radius: 25px;
  width: 500px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;  
}


.img{
  border-radius: 25px;
  width: 250px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;  
}

.button {
  border-radius: 25px;
  background-color: #e7e7e7; /* Green */
  border: none;
  color: black;
  padding: 5px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
</style>

</head>
<body>

<div class="header">
  <h1>Bid Now And Grab More!!!</h1>
</div>



<div class="navbar">
    <a href="logoutVerifier.php" class="right">Log out</a>
    <a href="pastDeals.php" class="right">past deals</a>
    <a href="futureDeals.php" class="right">future deals</a>
    <a href="contactus.php" class="right">contact us</a>
</div>

<div class="row">
  <div class="side">
  <br>
  <div>
    <a href="myprofile.php"><button type="button" class="button">My Profile</button></a> 
  </div><br>
  <div>
      <a href="addproduct.php"><button type="button" class="button" >Add product</button></a>
  </div><br>
  <div>
	 <a href="log.php"><button type="button" class="button">Log</button></a> 
  </div>
  </div>
    <div class="main"><h2><b>
    <?php
        echo "Hello ".$_SESSION["username"]."!!\nHere are some amazing live deals for you, Go and grab it ";
    ?></b></h2>
        <font color='red'><h3>Note: All the auctions will be live for 2 hours from the starting time</h3></font>
        
    <?php
    $rows=$db->query("select * from Products");
    while ($row = $rows->fetchArray()) {
    if(date("Y/m/d",strtotime($row['auction_date']))==date("Y/m/d") && (strtotime("now")-strtotime($row['auction_time'])>=0 && strtotime("now")-strtotime($row['auction_time']) <= 3600))
    {
    ?>
            <table width = 100%>
        <tr>
                        <td colspan = "2"><h1><b>
                                    <?php echo $row['name']; ?>
                    </b></h1></td>
        <td rowspan = "5"> <?php echo "<img src='".$row['profile']."' class='img'>"; ?> </td>
        </tr>
        <tr>
        <td colspan = "2"><h4><b><?php echo $row['short_disc']; ?></b></h4></td>
        </tr>
        <tr>
        <td><h3><b>Current Price :<?php echo $row['current_price']; ?></b></h3></td>
        <td><h3><b>Base Price : <?php echo $row['base_price']; ?></b></h3></td>
        </tr>
        <tr>
        <td colspan = "1" ><h3><b>Auction Date : <?php echo $row['auction_date']; ?></b></h3></td>
        <td colspan = "1" ><h3><b>auction time : <?php echo $row['auction_time']; ?></b></h3></td>
        
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
        <td colspan = "2"><h2><a href = "viewproduct.php?id=<?php echo $row['ID']; ?>">View</a><br>
        </h2></td>
        </tr>

        </table>
    <?php
    
    }
    }
    ?>
     
  </div>
</div>

<div class="footer">
  <h2>Thank You!!! For having us.....</h2><br>
  <h3>Hope you like our work</h3>
</div>

</body>
</html>
<?php }
?>