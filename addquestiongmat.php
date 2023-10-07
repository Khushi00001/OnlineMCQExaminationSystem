<html>
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
	<div id="question-form" style="display: none;">
		<form method="post" action="cmatadd.php">
			<label>Question:</label><br>
			<input type="text" name="question"><br><br>
			<label>Option 1:</label><br>
			<input type="text" name="option1"><br><br>
			<label>Option 2:</label><br>
			<input type="text" name="option2"><br><br>
				<label>Option 3:</label><br>
			<input type="text" name="option3"><br><br>
				<label>Option 4:</label><br>
			<input type="text" name="option4"><br><br>
				<label>Correct Answer:</label><br>
			<input type="text" name="answer"><br><br>
			<input type="submit" name="add" value="Add Question">
		</form>
	</div>
	if(isset($_POST['add'])) {
		$question = $_POST['question'];
		$option1 = $_POST['option1'];
		$option2 = $_POST['option2'];
		$option3 = $_POST['option3'];
		$option4 = $_POST['option4'];
		$answer = $_POST['answer'];
		$sql = "INSERT INTO gmat (question, option1, option2, option3, option4, answer) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$answer')";

		if (mysqli_query($conn, $sql)) {
			echo "Question added successfully!<br>";
			echo "<script>window.location.href='gmat.php';</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

</body>
</html>