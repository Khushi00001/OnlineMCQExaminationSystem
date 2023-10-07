<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <style>
        th {
            background-color: #990000;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<nav class="side-nav">
    <ul>
        <li><a href="admin_page.php" class="btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="addquestion.php" class="btn"><i class="bi bi-plus-circle-fill"></i> Add Questions</a></li>
        <li><a href="viewusers.php" class="btn"><i class="fas fa-users"></i> View Users</a></li>
        <li><a href="premiumstudent.php" class="btn"><i class="bi bi-person-plus-fill"></i></i> Student Report</a></li>
        <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a></li>
    </ul>
</nav>
<main>
    <div class="container-fluid">
        <div class="container">
            <div class="content">
    <?php
@include 'config.php';

$sql = "SELECT * FROM result";
$result = $conn->query($sql);

// Display the data in a table format
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Exam Attended</th>
                <th>Score</th>
                <th>Student Type</th>
                <th>Date and Time</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["student_name"]."</td>
                <td>".$row["student_email"]."</td>
                <td>".$row["exam_name"]."</td>
                <td>".$row["score"]."</td>
                <td>".$row["student_type"]."</td>
                <td>".$row["date_and_time"]."</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}
$conn->close();
?>

            </div>
        </div>
    </div>
</main>
</body>
</html>
