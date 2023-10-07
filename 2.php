<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    include 'config.php';

    $tables = ['gmat', 'mcq_exam_questions', 'loksewa', 'l2', 'l3', 'l4', 'l5', 'user']; // Add the names of your tables here

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<h2>'.$table.'</h2>';
            echo '<table class="table">';
            echo '<thead><tr><th>Name</th><th>Email</th></tr><th>Test Date</th></tr></thead>';
            echo '<tbody>';

            if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $testDate = date('Y-m-d H:i:s'); // Current date and time
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . "</td></tr>".'<td>'.$testDate.'</td></tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<h2>'.$table.'</h2>';
            echo 'No users found.';
        }
    }
}

    mysqli_close($conn);
    ?>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
