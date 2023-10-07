<?php
include 'config.php';
@include 'sessionadmin.php';
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
        <label for="id">Id:</label>
        <input type="number" id="id" name="id" required><br>

        <label for="question">Question:</label>
        <input type="text" id="question" name="question" required><br>

        <label for="option1">Option 1:</label>
        <input type="text" id="option1" name="option1" required><br>

        <label for="option2">Option 2:</label>
        <input type="text" id="option2" name="option2" required><br>

        <label for="option3">Option 3:</label>
        <input type="text" id="option3" name="option3" required><br>

        <label for="option4">Option 4:</label>
        <input type="text" id="option4" name="option4" required><br>

        <label for="correct_answer">Correct Answer:</label>
        <select id="correct_answer" name="answer" required>
            <option value="">Select Correct Answer</option>
            <option value="Option 1">Option 1</option>
            <option value="Option 2">Option 2</option>
            <option value="Option 3">Option 3</option>
            <option value="Option 4">Option 4</option>
        </select><br>

        <br><button type="submit" name="add_question">Add Question</button>
    </form>
    <br>
    <br>
    <a href="admin_page.php"><p style="color:#990000;">Return to dashboard</p></a> <br>
    <br>

    <?php

    if (isset($_POST['add_question'])) {
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

        $sql = "INSERT INTO gmat (id, question, option1, option2, option3, option4, answer) 
                VALUES ('$id', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')";
        if (mysqli_query($conn, $sql)) {
            echo "Question added successfully!<br>";
            echo "<script>window.location.href='gmat.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    $sql = "SELECT * FROM gmat";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>List of Questions:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Id</th><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th>Answer</th><th>Actions</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["question"] . "</td><td>" . $row["option1"] . "</td><td>" . $row["option2"] . "</td><td>" . $row["option3"] . "</td><td>" . $row["option4"] . "</td><td>" . $row["answer"] . 
                "</td><td><a href='editgmat.php?id=" . $row["id"] . "'>Edit</a> | 
                <a href='deletegmat.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this question?')\">Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No questions added yet.";
    }

    mysqli_close($conn);
    ?>
    <span style="color: #990000; position: absolute; top: 10px; right: 10px;"><?php echo $_SESSION['admin_name'] ?></span><br>
      <span style="color: #990000; position: absolute; top: 30px; right: 10px;"><?php echo $_SESSION['admin_email'] ?></span>
</body>
</html>
