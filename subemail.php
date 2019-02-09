<?php
session_start();
if((isset( $_SESSION['clientmail']))  == false )
{
  header("Location: adminlogin.php");
  exit();
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
            max-width: 70%;
            margin-top: 8%;
            border:groove;
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
        margin-left: 38%;
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
  </style>
 
  </head>
  <body>

        <div class="container">
                
                    <div id = "logo"><img src = "logo.jpg" class="img-responsive center-block"/>
                    </div>
                    <p id = "error" style = "text-align: center; margin-top: 10px;"></p>
                    <form class="form-horizontal" id = "login" action = "email.php" method="POST">
                            
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <textarea class="form-control" id = "fullname" name="email" rows = "10" cols="50"><?php 
                                      $connection = new mysqli('localhost','anchoriaam_admin','Admin@123#','anchoriaam_email');
                                      $sub = $_GET['sub'];
                                      if ($sub == 1){
                                      $query = "SELECT Email FROM email WHERE Status = 'Subscribed'; ";
                                      $fdquery = $connection->query($query);
                                      }
                                      else{
                                        $query = "SELECT Email FROM email WHERE Status = 'Unsubscribed'; ";
                                        $fdquery = $connection->query($query);
                                      }
                                      while($row = $fdquery->fetch_assoc()){
                                          echo $row['Email']."; ";
                                      }
                                    ?></textarea> 
                                </div>
                            </div>
                            
                    </form>

        </div>



  </body>