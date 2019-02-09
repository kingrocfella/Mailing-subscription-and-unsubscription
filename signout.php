<?php
session_start();
//erase all session variables
$_SESSION = array();
//destroy the session
session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <style>
    body{
    background-color: rgb(192, 192, 192);
    font-family: 'Rubik', sans-serif;
    }
    #message{
    margin-top: 20%;
    text-align: center;
    }
    .btn{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
</head>
<body>
<div id = "message">
<h3><b>You have successfully logged out of your account!</b></h3>

<form action = "admin.php">
    <button class = "btn"><h4><b>Click here to Login again</b></h4></button>
</form>
</div>

</body>
</html>





