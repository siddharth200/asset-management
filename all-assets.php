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

 <div class="container" style="color:black">
   <br><br><h1>Assets Table</h1>
	 <?php

       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "housekeeping";

       $conn = new mysqli($servername, $username, $password, $dbname);

       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       $sql = "SELECT * FROM `asset`";
       $result = $conn->query($sql);




       if ($result->num_rows > 0) {
         echo '<br><br><br><table class="table table-striped" style="color: black">
          <thead>
            <tr>
              <th>Asset ID</th>
              <th>Asset Name</th>
            </tr>
          </thead><tbody>';

           while($row = $result->fetch_assoc()) {

               echo '<tr>
                   <td>'.$row["asset-id"].'</td>
                   <td>'.$row['asset-description'].'</td>
                 </tr>';
           }
       }

       $conn->close();
    ?>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>
