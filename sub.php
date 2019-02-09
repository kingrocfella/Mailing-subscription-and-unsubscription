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

$emailxx = explode(";", $email);
$emailerr = array();

foreach($emailxx as $value) {
    $value = trim($value);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $emailerr[]=$value;
    }
    else{
        $emailq = preg_replace('/\s+/', '', $value);
        $getemail = "SELECT * FROM email WHERE Email = '{$emailq}'";
            $verifyquery = $connection->query($getemail);
            $usersub = true;
            
            //loop through the database
            if ($verifyquery->num_rows > 0 ){
                while($row = $verifyquery->fetch_assoc()){
                    $getuseremail = $row['Email'];
                    $status = $row['Status'];
                    // previously unsubscribed
                    if ($getuseremail == $emailq && $status == 'Unsubscribed'){
                        $querys = "UPDATE Email SET Status = 'Subscribed' WHERE Email ='".$emailq."';";
                            if ($connection->query($querys)){
                                    $usersub = false;
                            }           
                    }
                    //if the user is already subscribed
                    else if ($getuseremail == $emailq && $status != 'Unsubscribed')  {
                        echo "<h5>"."<center>".$getuseremail." is already in our mailing list and could not be submitted"."</center>"."</h5>";
                    }
                }
            }
            // fresh customer
            else {
                $query = "INSERT INTO email (Email, Status) VALUES( '".$emailq."', 'Subscribed');";
                if ($connection->query($query)){
                    $usersub = false;
                }
            }
            
    }
}
        if (!empty($emailerr)){
            echo "<h5>"."<center>"."These email addresses are invalid: <br />"."</center>"."</h5>";
            foreach($emailerr as $invalid){
                echo "<h5>"."<center>"."- " . $invalid ."<br />"."</h5>";
            }
        }
        // update was successful
        if($usersub == false && (empty($emailerr))){
            echo "<br><br>"."<h4>"."<center>"."<b>"."You have successfully subscribed to our mailing list"."</b>"."</center>"."</h4>";
        } 

        $connection->close();
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
            max-width: 50%;
            margin-top: 3%;
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
        margin-left: 35%;
        color:#ffffff;
        background-color: rgb(40, 40, 59);
   }
   div img{
       margin-top: 40px;
       width: 30%;
   }
   #text{
       margin-top: 3%;
   }
   #footertext{
       margin-left: 36%;
       margin-top: 5px;
       font-size: 11px;
   }
   #fullname{
       margin-top: -3px;
       max-width: 90%;
   }
  </style>
  
  </head>
  <body>
  <h3 id = "text">Subscribe to our mailing list</h3>
        <div class="container">
                
                    <div id = "logo"><img src = "logo.jpg" class="img-responsive center-block"/>
                    </div>
                    <p id = "error" style = "text-align: center; margin-top: 10px;"></p>
                    <form class="form-horizontal" id = "login" action = "sub.php" method="POST">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <textarea class="form-control" id = "fullname" placeholder="Seperate multiple emails with a semi-colon (;)" name="email" rows = "10" cols = "50" required></textarea> 
                        </div>
                    </div>
                            <div class="form-group">        
                                    <div class="col-sm-offset-1 col-sm-10">
                                      <button type="submit" class="btn btn-default"><b>Subscribe</b></button>
                                    </div>
                                </div>
                    </form>

        </div>
        <p id = "footertext"><b>Note:</b> In each email you receive, there will be a link to unsubscribe. <br> Your privacy is important to us.</p>


  </body>
</html>

