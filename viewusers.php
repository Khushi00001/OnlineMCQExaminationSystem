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
        <li><a href="studentreport.php" class="btn"><i class="bi bi-person-plus-fill"></i></i> Student Report</a></li>
        <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a></li>
    </ul>
</nav>
<main>
    <div class="container-fluid">
        <div class="container">
            <div class="content">
                <?php
                @include 'config.php';
                
                $sql = "SELECT * FROM user_form WHERE user_type='user'";
                $result = mysqli_query($conn, $sql);
                echo "<table>";
                echo "<tr><th>Name</th><th>Email</th><th>Actions</th></tr>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>";
                        echo "<a href='premiumstudent.php?id=" . $row["email"] . "'> Edit</a>| ";
                        echo "<a href='deleteuser.php'> Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No student login details found.</td></tr>";
                }
                echo "</table>";
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
