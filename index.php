<script>
  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }
</script>

<?php 
$link = new mysqli('172.16.1.52','root','0000','BOGO');
if ($link->connect_error) $errorm="connection failed: " . $link->connect_error;
$link->set_charset("utf8");

if (isset($_GET['deleteTask']) && !empty($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM TODO WHERE ID = '$id'";
	$result = mysqli_query($link, $sql);
	header("Location: /");
	die();
}

if (isset($_POST['addTodo'])) {
	$task = $_POST['task'];
	$date = $_POST['dateOfTask'];
	// echo $date;
	$sql = "INSERT INTO TODO (`TASK`, `DATE`) VALUES ('$task', '$date')";
	$result = mysqli_query($link, $sql);
	if ($result) {
		// echo "<div class='container'><div class='alert alert-warning'>Task Added</div></div>";
	}else{
		echo mysqli_error($link);
	}
}



?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Todo App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<style type="text/css">
		body{
			background-color: #DAE0E2;
		}
		#butt{
			border-radius: 50%;
			position: fixed;
		    bottom: 20px;
		    right: 15px;
		    font-size: 25px;
		    z-index: 999999999;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1 class="text-center">My Todo Application</h1>
		<div class="text-center mt-3">
			<button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary shadow" id="butt">&#10010</button>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <form class="form" method="POST">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Add Tasks</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<div class="form-group">
						<label class="font-weight-bold">Task</label>
						<input type="text" name="task" class="form-control" placeholder="What You want to do?" required>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Task</label>
						<input type="date" name="dateOfTask" class="form-control" required="">
					</div>
			      </div>
			      <div class="modal-footer">
			        <input type="submit" name="addTodo" value="Add" class="btn btn-success">
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<div class="col-md-6 col-sm-12 mx-auto mt-3">
			<?php 
				$sql = "SELECT * FROM TODO";
				$result = mysqli_query($link, $sql);
				if (mysqli_num_rows($result)>0) {
					while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
						<div class="card shadow mb-3">
							<div class="card-header">
								<?php echo $row['DATE']; ?>
							</div>
							<div class="card-body">
								<h4 class="float-left" style="font-weight: bold;"><?php echo $row['TASK']; ?></h4>
								<a class="btn btn-danger float-right" href="/?deleteTask&id=<?php echo $row['ID']; ?>" ><span style="font-size: 20px;">&#10004</span></a>
							</div>
						</div>
						
				<?php
					}
				}else{ ?>
					<div class="alert alert-warning">No Tasks! Create One!</div>

				<?php }


		 	?>
		</div>
	</div>
</body>
</html>