<html>
    <head>
        <title>forgot password</title>
    </head>
    <body>
    <center>
        OTP is sent to your email address<br><br>
        
        <form action="otpVerifier.php" method="POST">
            Enter OTP:<input type="text" name="otp" placeholder="otp.." required="true"><br>
            New Password:<input type="password" name="pass" placeholder="Password.." required="true"><br>
            Confirm Password:<input type="password" name="repass" placeholder="Confirm Password.." required="true"><br>
            <input type="submit" value="submit">
        </form>
        <b>
        <font color="red"><center>
        <?php
            if(isset($_GET['msg']))
            {
                echo "<br><br>".$_GET['msg']."";
            }
        ?>
        </center></font></b>

    </center>
    </body>
</html>