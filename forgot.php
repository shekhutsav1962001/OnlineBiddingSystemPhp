<html>
    <head>
        <title>
            Forgot Username/Password
        </title>
    </head>
    <body><center>
        Forgot Username? Don't worry enter registered email address.<br>
        <form action="forgotusername.php" method="post">
            Registered Email:<input type="email" name="email" placeholder="Email...">
            <input type="submit" value="Get Username"><br>
            
        </form>
        <?php 
                if(isset($_GET['username']))
                {
                    echo $_GET['username']."<br>";
                }
            ?>
            <br><br><br>
        Forgot password? Enter Your username or email address. <br>
        we'll send One time password to your email by which you can reset your password.<br>
        <form action="forgotpassword.php" method="post">
            Email or Username:<input type="text" name="email" placeholder="Email/Username...">
            <input type="submit" value="Get OTP"><br><br><br>
        </form>
        <?php 
                if(isset($_GET['msg']))
                {
                    echo $_GET['msg']."<br>";
                }
        ?>
        <br><br>
        <a href="index.php">Back to Login page</a>
    </center>
    </body>
</html>