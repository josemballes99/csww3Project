<?php 
	//Submits review 
	session_start();
	//if no rating is provided
	if ((!isset($_POST["rating"]))|| ($_POST["rating"]==="")){
		echo json_encode(array("status" => false, "message" => "No rating provided"));
	} else{
		// check data then insert review into the database
		$pdo = new PDO('mysql:host=localhost;dbname=whats_open', 'webmanager', 'databasepwd23');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$sql = "INSERT INTO `Reviews` (`review_id`, `reviewer_email`, `location_id`, `rating`, `review`) VALUES (NULL, :user, :location_id, :rating, :review)";

	    	$stmt = $pdo->prepare($sql);
	    	// bind parameters to statement

	    	$stmt->bindParam(':user', $_SESSION['user']);
	    	$stmt->bindParam(':location_id', $_POST['location']);
	    	$stmt->bindParam(':rating', $_POST["rating"]);
	    	$stmt->bindParam(':review', $_POST['review']);

	    	$stmt->execute();

	    	// return the results to the javascript on the page in order to submit review with AJAX
	    	echo json_encode(array("status" => true, "rating" => htmlspecialchars($_POST["rating"]), "review" => htmlspecialchars($_POST["review"])));
		}catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
?>