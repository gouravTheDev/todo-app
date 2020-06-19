<script>
  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }
</script>

<?php 

$link = new mysqli('localhost', 'root', '', 'todoapp');
if ($link->connect_error) {
	echo $link->connect_error;
}else{
	// echo "ok";
}

if (isset($_POST['submit'])) {
	$task = $_POST['task'];	
	$date = $_POST['date'];	

	$sql = "INSERT INTO tasks (`task`, `date`) VALUES ('$task', '$date')";
	$result =  mysqli_query($link, $sql);
	// echo $task;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM tasks WHERE ID = '$id'";
	$result =  mysqli_query($link, $sql);
	header("Location: /todoapp/");
	// echo $task;
}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Todo App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		body{
			background-color: #a4b0be;
		}
		#bttun{
			border-radius: 50%;
			font-size: 20px;
			position: absolute;
			right:    20px;
			bottom:   20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1 class="text-center">My Todo App</h1>
		<div class="col-md-6 col-sm-12 mx-auto">
			<?php 
				$sql = "SELECT * FROM tasks";
				$result =  mysqli_query($link, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
						<div class="card shadow" style="margin-bottom: 10px;">
							<div class="card-header" style="font-weight: bold;">
								<?php echo $row['date']; ?>
							</div>
							<div class="card-body" style="font-weight: bold;">
								<h4 class="float-left"><?php echo $row['task']; ?></h4>
								<a class="btn btn-danger float-right" href="/todoapp/?id=<?php echo $row['ID']; ?>">&#10008;</a>
								
							</div>
						</div>

				<?php	}
				}else{
					echo '<div class="alert alert-warning">No Tasks! Please Create One!</div>';
				}

			 ?>
		</div>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" id="bttun" data-target="#exampleModal">
		  &#43;
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<form method="POST">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        	<div class="form-group">
			        		<label style="font-weight: bold;">Task</label>
			        		<input type="text" name="task" class="form-control" placeholder="Enter the task you wanna do">
			        	</div>
			        	<div class="form-group">
			        		<label style="font-weight: bold;">Date</label>
			        		<input type="date" name="date" class="form-control">
			        	</div>
			        
			      </div>
			      <div class="modal-footer">
			        <input type="submit" value="Add" name="submit" class="btn btn-success">
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>
