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
     if(isset($_POST['assetId'])) {
     } else {
       echo '<br><br><br><form method="post" action="">
       <div class="row">
       <div class="col-25">
         <label>Asset ID:</label>
       </div>
       <div class="col-75">
       <input type="text" name="assetId" id="assetId" placeholder="012345" required />
       </div>
       </div>
       <div class="row">
       <div class="col-25">
         <label>Task ID:</label>
       </div>
       <div class="col-75">
       <input type="text" name="taskId" id="taskId" placeholder="012345" required />
       </div>
       </div>
       <div class="row">
       <div class="col-25">
         <label>Worker ID:</label>
       </div>
       <div class="col-75">
       <input type="text" name="workerId" id="workerId" placeholder="012345" required />
       </div>
       </div>
       <div class="row">
       <div class="col-25">
         <label>Time of Allocation:</label>
       </div>
       <div class="col-75">
       <input type="time" name="timeOfAllocation" id="timeOfAllocation" required />
       </div>
       </div>
       <div class="row">
       <div class="col-25">
         <label>To be completed by:</label>
       </div>
       <div class="col-75">
       <input type="time" name="completedBy" id="completedBy" required />
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

         $isPresent = True;

         // Create connection
         $conn = new mysqli($servername, $username, $password, $dbname);
         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }

         $sql = "SELECT * FROM `asset` WHERE `asset-id`='".$_POST['assetId']."'";
         $result = $conn->query($sql);

         $asset = "";
         $task = "";
         $worker = "";

         if ($result->num_rows < 1) {
             $isPresent = False;
         } else {
           $row = $result->fetch_assoc();
           $asset = $row['asset-description'];
         }

         $sql = "SELECT * FROM `task` WHERE `task-id`='".$_POST['taskId']."'";
         $result = $conn->query($sql);

         if ($result->num_rows < 1) {
             $isPresent = False;
         } else {
             $row = $result->fetch_assoc();
             $task = $row['task-description'];
         }

         $sql = "SELECT * FROM `worker` WHERE `worker-id`='".$_POST['workerId']."'";
         $result = $conn->query($sql);

         if ($result->num_rows < 1) {
             $isPresent = False;
         } else {

             $row = $result->fetch_assoc();
             $worker = $row['worker-name'];
         }

         if($isPresent) {
           $sql = "INSERT INTO `allocate`(`task-id`, `asset-id`, `worker-id`, `time-of-allocation`, `completed-by`) VALUES
           ('".$_POST['taskId']."', '".$_POST['assetId']."', '".$_POST['workerId']."', '".$_POST['timeOfAllocation']."', '".$_POST['completedBy']."')";

           if ($conn->query($sql) === TRUE) {
             echo "<script>alert('New record added to table successfully');</script>";
             echo "<span style='color:black'><br><br><br><br>Allocated task " . $task . " on <i>".$asset."</i> to worker <b>".$worker."</b></span>";
           } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
           }
         } else {
           echo "<br><br>Invalid details! Please try again.";
         }



         $conn->close();

       }
      ?>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>
