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
     if(isset($_GET['workerId'])) {
     } else {
       echo '<br><br><br><form>
       <div class="row">
       <div class="col-25">
         <label>Worker ID:</label>
       </div>
       <div class="col-75">
       <input type="text" name="workerId" id="workerId" placeholder="012345" required />
       </div>
       </div>
         <div>
           <input type="submit" name = "submit" value="Submit" />
         </div>
       </form>';
     }


     if(isset($_GET['submit'])) {
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "housekeeping";

       $conn = new mysqli($servername, $username, $password, $dbname);

       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       $sql = "SELECT * FROM `allocate` WHERE `worker-id`='".$_GET['worker_id']."'";
       $result = $conn->query($sql);




       if ($result->num_rows > 0) {
         echo '<br><br><br><table class="table table-striped" style="color: black">
          <thead>
            <tr>
              <th>Task ID</th>
              <th>Task Name</th>
              <th>Worker ID</th>
              <th>Worker Name</th>
              <th>Asset ID</th>
              <th>Asset Name</th>
              <th>Allocated On</th>
              <th>To Be Completed By</th>
            </tr>
          </thead><tbody>';

           while($row = $result->fetch_assoc()) {

             $asset = "";
             $task = "";
             $worker = "";

             $newsql = "SELECT * FROM `asset` WHERE `asset-id`='".$row['asset-id']."'";
             $newresult = $conn->query($newsql);

             $newrow = $newresult->fetch_assoc();
             $asset = $newrow['asset-description'];

             $newsql = "SELECT * FROM `task` WHERE `task-id`='".$row['task-id']."'";
             $newresult = $conn->query($newsql);

             $newrow = $newresult->fetch_assoc();
             $task = $newrow['task-description'];

             $newsql = "SELECT * FROM `worker` WHERE `worker-id`='".$row['worker-id']."'";
             $newresult = $conn->query($newsql);

             $newrow = $newresult->fetch_assoc();
             $worker = $newrow['worker-name'];




               echo '<tr>
                   <td>'.$row["task-id"].'</td>
                   <td>'.$task.'</td>
                   <td>'.$row["worker-id"].'</td>
                   <td>'.$worker.'</td>
                   <td>'.$row["asset-id"].'</td>
                   <td>'.$asset.'</td>
                   <td>'.$row["time-of-allocation"].'</td>
                   <td>'.$row["completed-by"].'</td>
                 </tr>';
           }
       } else {
           echo "<span style='color: black'><b>0 results</b></span>";
       }

       $conn->close();
     }
    ?>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>
