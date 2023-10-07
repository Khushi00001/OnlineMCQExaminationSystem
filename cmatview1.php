<?php
@include 'config.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login_form.php");
    exit();
}
$conn = new mysqli('localhost', 'root', '', 'user_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name = $_SESSION['user_name'];
$query = "SELECT user_type FROM user_form WHERE name = '$user_name'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_type = $row['user_type'];
    if ($user_type !== 'user') {
        header("Location: login_form.php");
        exit();
    }
}

// Check if the test has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Store the student's name, email, and type
    $student_name = $_SESSION['user_name'];

    $query_user = "SELECT email, checks FROM user_form WHERE name = '$student_name'";
    $result_user = $conn->query($query_user);

    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $student_email = $row_user['email'];
        $student_type = $row_user['checks'];

        // Store the subject name
        $exam_name = "CMAT"; // Replace "Your Exam Name" with the actual subject name

        // Store the current date and time
        $date_and_time = date('Y-m-d H:i:s');

        // Insert the data into the result table
        $insert_query = "INSERT INTO result (student_name, student_email, exam_name, student_type, date_and_time) 
                         VALUES ('$student_name', '$student_email', '$exam_name', '$student_type', '$date_and_time')";

        if ($conn->query($insert_query) === TRUE) {
            // Data inserted successfully
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    // Rest of your existing code for displaying test results
    $sql = "SELECT * FROM mcq_exam_questions";
    $result = mysqli_query($conn, $sql);

    $totalQuestions = mysqli_num_rows($result);
    $correctAnswers = 0;
    $incorrectAnswers = 0;
    $incorrectQuestions = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $questionId = $row['id'];

        // Check if the answer key exists in the $_POST array
        if (isset($_POST['answer_'.$questionId])) {
            $selectedAnswer = $_POST['answer_'.$questionId];
            $correctAnswer = $row['answer'];

            // Compare the selected answer with the correct answer
            if ($selectedAnswer == $correctAnswer) {
                $correctAnswers++;
            } else {
                $incorrectAnswers++;
                $incorrectQuestions[$questionId] = $correctAnswer;
            }
        }
    }

    $marks = $correctAnswers;
    $serializedIncorrectQuestions = serialize($incorrectQuestions);

    // Update the score in the result table
    $update_query = "UPDATE result SET score = '$marks' WHERE student_name = '$student_name'";
    if ($conn->query($update_query) === TRUE) {
        // Score updated successfully
    } else {
        echo "Error: " . $update_query . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM mcq_exam_questions";
    $result = mysqli_query($conn, $sql);

    $questionNumber = 1;
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table"><form method="POST" action="">';
        while ($row = mysqli_fetch_assoc($result)) {
            $questionId = $row['id'];
            $question = $row['question'];
            $options = array($row['option1'], $row['option2'], $row['option3'], $row['option4']);

            echo "<tr><th colspan='2'> $questionNumber: $question</th></tr>";
            echo '<tr>';
            foreach ($options as $index => $option) {
                echo '<td>';
                echo '<input type="radio" id="option_'.$index.'" name="answer_'.$questionId.'" value="'.$option.'" required>';
                echo '<label for="option_'.$index.'">'.$option.'</label>';
                echo '</td>';
                if ($index == 1) {
                    echo '</tr><tr>';
                }
            }
            echo '</tr>';
            $questionNumber++;
        }
        echo '</table>';
        echo '<div class="centered-button">';
        echo '<button type="submit" name="submit_test">Submit Test</button>';
        echo '</div></form>';
    } else {
        echo 'No questions found.';
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCQ Test</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/admin.css" href="css/style.css">
    <style>
        .centered-button {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <style>
            /* Styling for the section container */
            .quiz-results {
                text-align: center;
                padding: 20px;
                border: 2px solid #990000;
                border-radius: 5px;
                max-width: 500px;
                margin: 0 auto;
            }

            /* Styling for the heading */
            .quiz-results h3 {
                font-size: 24px;
                margin-top: 0;
                color: #990000;
            }

            /* Styling for the result details */
            .quiz-results h6 {
                font-size: 18px;
                margin: 10px 0;
                color: #555555;
            }

            /* Styling for the incorrect questions section */
            .quiz-results .incorrect-questions {
                margin-top: 20px;
            }

            /* Styling for individual incorrect question */
            .quiz-results .incorrect-question {
                margin-bottom: 10px;
            }

            /* Styling for links container */
            .quiz-results .links-container {
                text-align: left;
            }

            /* Styling for links */
            .quiz-results a {
                display: inline-block;
                color: #990000;
                text-decoration: none;
                margin-right: 10px;
                font-weight: bold;
            }
        </style>

        <style>
            /* Styling for the section container */
            .quiz-results {
                text-align: center;
                padding: 20px;
                border: 2px solid #990000;
                border-radius: 5px;
                max-width: 500px;
                margin: 0 auto;
            }

            /* Styling for the heading */
            .quiz-results h3 {
                font-size: 24px;
                margin-top: 0;
                color: #990000;
            }

            /* Styling for the result details */
            .quiz-results h6 {
                font-size: 18px;
                margin: 10px 0;
                color: #555555;
            }

            /* Styling for the incorrect questions section */
            .quiz-results .incorrect-questions {
                margin-top: 20px;
            }

            /* Styling for individual incorrect question */
            .quiz-results .incorrect-question {
                margin-bottom: 10px;
            }

            /* Styling for links container */
            .quiz-results .links-container {
                text-align: center;
                margin-bottom: 20px;
            }

            /* Styling for links */
            .quiz-results a {
                display: inline-block;
                color: #990000;
                text-decoration: none;
                margin: 10px;
                font-weight: bold;
            }
        </style>

        <div class="quiz-results">
            <div class="links-container">
                <a href="taketest.php">Take More Tests</a>
                <a href="download_pdf.php?totalQuestions=<?php echo $totalQuestions; ?>&correctAnswers=<?php echo $correctAnswers; ?>&incorrectAnswers=<?php echo $incorrectAnswers; ?>&marks=<?php echo $marks; ?>&incorrectQuestions=<?php echo urlencode($serializedIncorrectQuestions); ?>" target="_blank">Download PDF</a>
            </div>
            <h3>Test Results</h3>
            <div>
                <h6>Total Questions: <?php echo $totalQuestions; ?></h6>
                <h6>Correct Answers: <?php echo $correctAnswers; ?></h6>
                <h6>Incorrect Answers: <?php echo $incorrectAnswers; ?></h6>
                <h6>Marks Obtained: <?php echo $marks; ?></h6>
            </div>

            <?php if (count($incorrectQuestions) > 0): ?>
                <div class="incorrect-questions">
                    <h3>Incorrect Questions</h3>
                    <?php foreach ($incorrectQuestions as $questionId => $correctAnswer): ?>
                        <?php
                        $sql = "SELECT * FROM mcq_exam_questions WHERE id = '$questionId'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $question = $row['question'];
                        ?>

                        <div class="incorrect-question">
                            <h6>Question: <?php echo $question; ?></h6>
                            <h6>Correct Answer: <?php echo $correctAnswer; ?></h6>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
