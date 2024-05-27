<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

require_once "../config.php";

$sql = "SELECT * FROM animals";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal List</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-image: url('../indir977.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            color: #ffffff; /* Beyaz metin rengi */
        }
        /* Başlık rengi */
        h2 {
            color: #A34343; /* Turkuaz */
        }
        /* Ekleme butonunun rengi */
        .add-button {
            background-color: #ffc107; /* Sarı */
            border-color: #ffc107; /* Sarı */
        }
        /* Ekleme butonunun hover rengi */
        .add-button:hover {
            background-color: #ffca28; /* Sarı tonu */
            border-color: #ffca28; /* Sarı tonu */
        }
        /* Tablo başlıkları arkaplan rengi */
        .table thead th {
            background-color: #17a2b8; /* Turkuaz */
            color: #ffffff; /* Beyaz */
        }
        /* Tablo hücrelerinin arkaplan rengi */
        .table tbody td {
            background-color: #007bff; /* Mavi */
            color: #ffffff; /* Beyaz */
        }
        /* Tablo hücrelerine hover rengi */
        .table tbody td:hover {
            background-color: #1565c0; /* Koyu mavi */
        }
        /* Butonların arkaplan rengi */
        .action-button {
            background-color: #dc3545; /* Kırmızı */
            border-color: #dc3545; /* Kırmızı */
        }
        /* Butonların hover rengi */
        .action-button:hover {
            background-color: #c82333; /* Koyu kırmızı */
            border-color: #c82333; /* Koyu kırmızı */
        }
        /* Geri dönme butonu rengi */
        .back-button {
            background-color: #6c757d; /* Gri */
            border-color: #6c757d; /* Gri */
        }
        /* Geri dönme butonunun hover rengi */
        .back-button:hover {
            background-color: #5a6268; /* Koyu gri */
            border-color: #5a6268; /* Koyu gri */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Animal List</h2>
        <a href="add.php" class="btn btn-primary mb-3 add-button">Add New Animal</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Health Status</th>
                    <th>Feeding Habits</th>
                    <th>Habitat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['species']; ?></td>
                    <td><?php echo $row['health_status']; ?></td>
                    <td><?php echo $row['feeding_habits']; ?></td>
                    <td><?php echo $row['habitat']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm action-button">View</a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm action-button">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm action-button">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary back-button">Back to Home</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
