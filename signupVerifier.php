<?PHP
        session_start();
        $db = new SQLite3('db.sqlite3');
        $rows=$db->query("select * from user_details");
        $flag=0;
        while ($row = $rows->fetchArray())
        {
            if($_POST['username']===$row['username'])
            {
                $msg="username not available try another one";
                $flag=1;
                break;
            }
            if($_POST['email']===$row['email'])
            {
                $msg="already an account with this email id";
                $flag=2;
                break;
            }
            
        }
        if($flag==0)
        {
            if($_POST['pass']===$_POST['repeatpass'])
            {
                $db->query("INSERT INTO user_details(name,username,email,password) VALUES('".$_POST['name']."','".$_POST['username']."','".$_POST['email']."','".$_POST['pass']."')");
                header("Location: index.php");
            }
            else
            {
                $_SESSION['name']=$_POST['name'];
                $_SESSION['email']=$_POST['email'];
                $_SESSION['username']=$_POST['username'];
                $msg="passwords doesn't match";
                header("Location: signup.php?error=$msg");
            }
        }
        elseif ($flag==1)
        {
            $_SESSION['name']=$_POST['name'];
            $_SESSION['email']=$_POST['email'];
            header("Location: signup.php?error=$msg");
        }
        elseif ($flag==2)
        {
            $_SESSION['name']=$_POST['name'];
            $_SESSION['username']=$_POST['username'];
            header("Location: signup.php?error=$msg");
        }
//        $res=$db->query('select * from tempo');
//        while($row=$res->fetchArray())
//        {
//            echo "{$row['id']}{$row['name']}\n";
//        }
?>