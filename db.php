<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$serverName = "localhost";
    $userName = "root";
    $password = "";
    $db = "todo";
    $con = mysqli_connect($serverName, $userName, $password, $db);
	
	$id = 0;
	$update = FALSE;
    $task = "";

    // checks if successfully connected to the database
    if(mysqli_connect_errno()) {
        echo "failed to connect!";
        exit();
    }

	// if submit button is clicked, data inputted will be saved in the database
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO list (task) VALUES ('$task')";
			mysqli_query($con, $sql);
			header('location: index.php');
		}
	}	

    // delete task
    if (isset($_GET['del'])) {
        $id = $_GET['del'];

        mysqli_query($con, "DELETE FROM list WHERE id=$id");
        header('location: index.php');
    }

	// edit task
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
		$update = TRUE;
        $result = mysqli_query($con, "SELECT * FROM list WHERE id=$id");
		
		$row = $result -> fetch_array();
		$task = $row['task'];
    }

	//updating the databse with the edited task
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$task = $_POST['task'];

		mysqli_query($con, "UPDATE list SET task = '$task' WHERE id = '$id'")
			or die (mysqli->error);
		
		header('location: index.php');
	}
?>