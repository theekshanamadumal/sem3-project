<?php
session_start()
?>
<html>
<head><title>Admin login page</title></head>
<body>
<?php require_once('inc/connection.php');?>
<?php include_once("inc/head.php"); ?>
<div class="alert">
<?php
    if   (isset($_POST['submit'])){
        
        if($_POST['user_name']!=null and $_POST['password']!=null){
            
        $query= "SELECT * FROM adminpwrds WHERE ID='{$_POST['user_name']}'";
            $result= mysqli_query($connection,$query);

            if ($result){

                $details=mysqli_fetch_assoc($result);
                $password=$details['password1'];
                $user_id =$details['ID'];

                if ($password==$_POST['password'] and $user_id==$_POST['user_name']) {
                    include_once('logout.php');
                    session_start();
                    $_SESSION['loginID'] = $user_id;
                    $_SESSION['uI']="adminUI.php";
                    header("location:adminUI.php");
                    include_once('inc/foot.php');    
                    mysqli_close($connection);
                    die;
                }
                else echo "invalid user name or password";                     
            }
            else echo "<hr>LOGIN FAILED!";
        }
        else echo" user name and password can not be empty";            
    }
?></div>

<form action = "adminLogin.php" method="POST">
    <pre id="container-fluid text-left"><br><br><br><h3><center>
Admin name:  <input name="user_name" type="text" id="">

password  :  <input name="password" type="password" id="">

    <input name="submit" type="submit" id="" value="log in"></form>	<br>
   
    </pre>
     
	
    
<?php    include_once('inc/foot.php');    ?>
	
</body>
</html>
<?php mysqli_close($connection);?> 