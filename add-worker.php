<!DOCTYPE html>
<html>
<head>
	<title>Add Asset</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="app.css">
</head>
<body>

 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html">The House Keeping API</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
				<li><a href="add-asset.php">Add Asset</a></li>
        <li><a href="add-task.php">Add Task</a></li>
        <li><a href="add-worker.php">Add Worker</a></li>
        <li><a href="allocate-task.php">Allocate Task</a></li>
        <li><a href="all-assets.php">View All Assets</a></li>
        <li><a href="get-tasks-for-worker.php">Get Tasks For Worker</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

      </ul>
    </div>
  </div>
 </nav>

 <div class="container">
	 <?php
     if(isset($_POST['workerId'])) {
       echo "<br><br><br><br><span style='color:black'><b>Added worker #".$_POST['workerId']. ": ".$_POST["workerName"]."</b></span>";
     } else {
       echo '<br><br><br><form method="post" action="">
       <div class="row">
       <div class="col-25">
         <label>Asset ID:</label>
       </div>
       <div class="col-75">
          <input type="text" name="workerId" id="workerId" placeholder="012345" required />
       </div>
       </div>
       <div class="row">
       <div class="col-25">
         <label>Asset Description:</label>
       </div>
       <div class="col-75">
          <input type="text" name="workerName" id="assetType" placeholder="Brad, Chad etc." required />
       </div>
       </div>
         <div>
           <input type="submit" name = "submit" value="Submit" />
         </div>
       </form>';
     }


     if(isset($_POST['submit'])) {
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "housekeeping";

       $conn = new mysqli($servername, $username, $password, $dbname);

       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       $sql = "INSERT INTO `worker`(`worker-id`, `worker-name`) VALUES ('".$_POST['workerId']."', '".$_POST['workerName']."')";

       if ($conn->query($sql) === TRUE) {
         echo "<script>alert('New record added to table successfully');</script>";
       } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }

       $conn->close();

     }
    ?>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>
