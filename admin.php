<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  
    <style>
        .container{
            max-width: 50%;
            margin-top: 2%;
            
        }
        #login{
            margin-left: 35%;
            margin-top: 15%;
        }
        .btn{
            margin-left: 15%;
        }
        h3{
            margin-left: 10%;
        }
        body{
            background-color: #fcfdff;
        }
    </style>
</head>
<body>

<div class="container">

    <div id = "logo"><img src = "logo.jpg" class="img-responsive center-block"/> </div>

    <?php
if(isset($_POST["loginemail"])) { 

$servername = "localhost";
$username = "anchoriaam_admin";
$password = "Admin@123#";
$database = "anchoriaam_email";

$connection = new mysqli($servername,$username,$password,$database);
//check connection
if ($connection->connect_error){
   die("The connection failed   ".connect_error);
}
//INIT Variables
$loginemail = $_POST["loginemail"];
$loginpassword = $_POST["loginpassword"];


//verify the user
$verifyuser = "SELECT * FROM login;";
$verifyquery = $connection->query($verifyuser);
// begin a session
   session_start();

$wrong = true;
//loop through the database and log the verified user in..
if ($verifyquery->num_rows > 0 ){
   while($row = $verifyquery->fetch_assoc()){
       $getuseremail = $row['Email'];
       $getpassword = $row['Password'];
       if (($getuseremail == $loginemail) && ($getpassword == $loginpassword)){
           $_SESSION['clientmail'] = $loginemail;
           $_SESSION['clientpass'] = $loginpassword;
           $wrong = true;
           header("Location: adminsub.php");  
           exit();
       }   
   }
}
if ($wrong == true){
    echo "<br><br><br>"."<center>"."<b>"."Wrong Email or password.."."</b>"."</center>";
}


}
?>

    <div id = "login">
        <h3>Admin Login</h3>
        <form class="form-horizontal" action = "admin.php" method ="POST">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="email" class="form-control" id="useremail" placeholder="Enter Email" name="loginemail" required><br>
                </div>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="loginpassword" required><br>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-1 col-sm-10">
                      <button type="submit" class="btn btn-default">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   

</div>

</body>
</html>