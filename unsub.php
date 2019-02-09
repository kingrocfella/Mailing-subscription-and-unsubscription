<?php
if(isset($_POST["email"])) { 

$servername = "localhost";
$username = "anchoriaam_admin";
$password = "Admin@123#";
$database = "anchoriaam_email";

$connection = new mysqli($servername,$username,$password,$database);
// check connection
if ($connection->connect_error){
    die("The connection failed".connect_error);
}

$email = $_POST["email"];

//remove whitespaces
$emailq = preg_replace('/\s+/', '', $email);


//Email Validation
if (!filter_var($emailq, FILTER_VALIDATE_EMAIL)) {
    echo "<h5>"."<center>"."<b>"."The email address is invalid: <br />"."</b>"."</center>"."</h5>";
    echo "<h5>"."<center>"."- " . $emailq ."<br />"."</h5>"; 
}
else{
    $getemail = "SELECT * FROM email WHERE Email = '{$emailq}'";
    $verifyquery = $connection->query($getemail);
    $usersub = true;
    //loop through the database
    if ($verifyquery->num_rows > 0 ){
        while($row = $verifyquery->fetch_assoc()){
            $getuseremail = $row['Email'];
            $status = $row['Status'];
        
            if ($getuseremail == $emailq && $status == 'Subscribed'){
                $querys = "UPDATE email SET Status = 'Unsubscribed' WHERE Email = '{$emailq}'";
                
                    if ($connection->query($querys)){
                            $usersub = false;
                            echo "<br><br><br>"."<h4 style=\"color: green;\">"."<center>"."<b>"."Successfully Unsubscribed!!"."</b>"."</center>"."</h4>";
                    }           
            }

        }
    }
    if ($usersub == true){
        echo "<br><br><br>"."<h4 style=\"color: red;\">"."<center>"."<b>"."You have already unsubscribed or you have not previously subscribed!!"."</b>"."</center>"."</h4>";
    }
    $connection->close();
}

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
         .container{
            max-width: 30%;
            margin-top: 5%;
            border:groove;
            border-color: rgb(255, 216, 216);
            border-radius: 15px;
            background-color: #ffffff;
        }
    body{
        background-color: rgb(233, 231, 231);
    }
    h3{
        text-align: center;
        margin-bottom: 20px;
        margin-top: 3px;
        color: rgb(113, 113, 121);
    }
    .form-control{
        margin-top: 13%;
        margin-bottom: 15px;
        background-color: rgb(223, 247, 213);
        margin-left: 29%;
    }
    .btn{
        margin-top: 5px; 
        margin-bottom:-3px;
        margin-left: 33%;
        color:#ffffff;
        background-color: rgb(40, 40, 59);
   }
   #error{
       color: red;
   }
   div img{
       margin-top: 40px;
       width: 30%;
   }
   #fullname{
       margin-top: 5px;
   }
   #text{
       margin-top: 2%;
   }
   #footertext{
       margin-left: 36%;
       margin-top: 5px;
       font-size: 11px;
   }
  </style>
  
  </head>
  <body>
        <h3 id = "text">Unsubscribe from our mailing list</h3>
        <h5 style = "margin-left: 36%; color: "#edeeef";> This will stop you from receiving mails from <b> Anchoria AM</b></h5>
        <div class="container">
                
                    <div id = "logo"><img src = "logo.jpg" class="img-responsive center-block"/>
                    </div>
                    <p id = "error" style = "text-align: center; margin-top: 10px;"></p>
                    <form class="form-horizontal" id = "login" action = "unsub.php" method="POST">
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id = "fullname" placeholder="Enter your Email Address" name="email" required>  
                                </div>
                            </div>
                            <div class="form-group">        
                                    <div class="col-sm-offset-1 col-sm-10">
                                      <button type="submit" class="btn btn-default"><b>Unsubscribe</b></button>
                                    </div>
                                </div>
                    </form>

        </div>

            <p id = "footertext"><b>Note:</b> In each email you receive, there will be a link to unsubscribe. <br> Your privacy is important to us.</p>

  </body>
</html>

