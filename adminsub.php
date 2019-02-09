<?php
session_start();
if((isset( $_SESSION['clientmail']))  == false )
{
  header("Location: admin.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.table').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			} );
		} );
	</script>
<style>
.btn{
    margin-left:170px;
}
#text{
    margin-top: -25px;
}
.container{
        max-width: 60%;
        margin-top: 2%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
#logo{
    margin-top:5px;
}
h2{
    margin-left: 35%;
    font-weight: 700;
}
body{
    background-color: #fcfdff;
    font-family: 'Raleway', sans-serif;
}
#signout{
    margin-left:90%;
    margin-top: -70px;
}
</style>

</head>
<body>
<div id = "logo"><img src = "logo.jpg" class="img-responsive center-block"/>
<div class="container">
  <h2>Admin Portal</h2>
  <form action = "signout.php">  
     <button class="btn btn-default btn-sm" id = "signout">
      <span class="glyphicon glyphicon-log-out"></span> Log out
    </button>
    </form>
 
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#home">Subscribed Email Clients</a></li>
    <li><a data-toggle="tab" href="#menu1">Unsubscribed Email Clients</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     
    <table class="table table-bordered" id = "mytable">
            <thead>
                <tr>    <th> <button class='btn btn-default btn-sm'><a href='subemail.php?sub=1'>Copy</a></button>
                <p id = "text">Email Address</p></th>
                    <th>Status</th>
                    <th> Date</th>
                </tr>   
            </thead>
            <?php
                $connection = new mysqli('localhost','anchoriaam_admin','Admin@123#','anchoriaam_email');
                $query = "SELECT Email, Status, created_at FROM email WHERE Status = 'Subscribed'; ";
                $fdquery = $connection->query($query);
                while($row = $fdquery->fetch_assoc()){
                    echo "<tr><td>".$row['Email']."</td><td>".$row['Status']."</td><td>".date( 'd-m-y H:i:s', strtotime($row['created_at']))."</td></tr>";
                }
            ?>
        </table>
    </div>
    <div id="menu1" class="tab-pane fade">
    <table class="table table-bordered" id = "mytable">
    <thead>
    <tr>    <th> <form action = "subemail.php"> <button class='btn btn-default btn-sm'><a href='subemail.php?sub=2'>Copy</a></button> <p id = "text">Email Address</p></th>
            <th>Status</th>
            <th>Date</th>
        </tr>   
    </thead>
    <?php
        $connection = new mysqli('localhost','anchoriaam_admin','Admin@123#','anchoriaam_email');
        $query = "SELECT Email, Status, created_at FROM email WHERE Status = 'Unsubscribed'; ";
        $fdquery = $connection->query($query);
        while($row = $fdquery->fetch_assoc()){
            echo "<tr><td>".$row['Email']."</td><td>".$row['Status']."</td><td>".date( 'd-m-y H:i:s', strtotime($row['created_at']))."</td></tr>";
        }
    ?>
</table>
    </div>
  </div>
</div>

</body>
</html>
