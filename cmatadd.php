<!DOCTYPE html>
<html>
<head>
	<title>MCQ Exam Questions</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Include Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/admin.css" href="css/style.css">
<body>
	<h3>MCQ Exam Questions</h3>
	<a href="addquestioncmat.php"><button  id="add-question-btn" class="btn"><i class="bi bi-plus-lg"></i> Add Questions</button></a>

	<?php
	// Include database connection configuration file
	@include 'config.php';
	@include 'sessionadmin.php';
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Add question
	if(isset($_POST['add'])) {
		$id = $_POST['id'];
		$question = $_POST['question'];
		$option1 = $_POST['option1'];
		$option2 = $_POST['option2'];
		$option3 = $_POST['option3'];
		$option4 = $_POST['option4'];
		$answer = $_POST['answer'];
		$sql = "INSERT INTO mcq_exam_questions (id, question, option1, option2, option3, option4, answer) VALUES ('$id', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')";

		if (mysqli_query($conn, $sql)) {
			echo "Question added successfully!<br>";
			echo "<script>window.location.href='cmat.php';</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
mysqli_close($conn);
?>
<span style="color: #990000; position: absolute; top: 10px; right: 10px;"><?php echo $_SESSION['admin_name'] ?></span><br>
      <span style="color: #990000; position: absolute; top: 30px; right: 10px;"><?php echo $_SESSION['admin_email'] ?></span>
</body>
</html>