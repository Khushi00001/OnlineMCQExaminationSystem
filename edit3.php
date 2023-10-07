<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM l3 WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $question = $row['question'];
        $option1 = $row['option1'];
        $option2 = $row['option2'];
        $option3 = $row['option3'];
        $option4 = $row['option4'];
        $answer = $row['answer'];
    } else {
        echo "Question not found.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answerOption = $_POST['answer'];

    // Determine the exact answer based on the selected option
    $answer = '';
    switch ($answerOption) {
        case 'Option 1':
            $answer = $option1;
            break;
        case 'Option 2':
            $answer = $option2;
            break;
        case 'Option 3':
            $answer = $option3;
            break;
        case 'Option 4':
            $answer = $option4;
            break;
    }

    $sql = "UPDATE l3 SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Question updated successfully!<br>";
        echo "<script>window.location.href='addlevel3.php?id=$id';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid question ID.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="question">Question:</label>
        <input type="text" id="question" name="question" value="<?php echo $question; ?>" required><br>

        <label for="option1">Option 1:</label>
        <input type="text" id="option1" name="option1" value="<?php echo $option1; ?>" required><br>

        <label for="option2">Option 2:</label>
        <input type="text" id="option2" name="option2" value="<?php echo $option2; ?>" required><br>

        <label for="option3">Option 3:</label>
        <input type="text" id="option3" name="option3" value="<?php echo $option3; ?>" required><br>

        <label for="option4">Option 4:</label>
        <input type="text" id="option4" name="option4" value="<?php echo $option4; ?>" required><br>

        <label for="correct_answer">Correct Answer:</label>
        <select id="correct_answer" name="answer" required>
            <option value="">Select Correct Answer</option>
            <option value="Option 1" <?php if ($answer === $option1) echo 'selected'; ?>>Option 1</option>
            <option value="Option 2" <?php if ($answer === $option2) echo 'selected'; ?>>Option 2</option>
            <option value="Option 3" <?php if ($answer === $option3) echo 'selected'; ?>>Option 3</option>
            <option value="Option 4" <?php if ($answer === $option4) echo 'selected'; ?>>Option 4</option>
        </select><br>

        <br><button type="submit" name="update_question">Update Question</button>
    </form>
    <span style="color: #990000; position: absolute; top: 10px; right: 10px;"><?php echo $_SESSION['admin_name'] ?></span><br>
      <span style="color: #990000; position: absolute; top: 30px; right: 10px;"><?php echo $_SESSION['admin_email'] ?></span>
</body>
</html>