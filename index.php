<?php
// Eğer oturum açma kontrolü yapmak isterseniz
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Tracker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../zootrackerr/css/styles.css">
    <style>
        body {
            background-image: url('indir977.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            color: #ffffff; /* Beyaz metin rengi */
        }
        /* Navbar rengi */
        .navbar {
            background-color: #17a2b8; /* Turkuaz */
        }
        /* Navbar linkleri rengi */
        .navbar-nav .nav-link {
            color: #ffffff !important; /* Beyaz */
        }
        /* Navbar linklerine hover rengi */
        .navbar-nav .nav-link:hover {
            color: #ffc107 !important; /* Sarı */
        }
        /* Ana başlık rengi ve kenarlık rengi */
        .main-title {
            color: #ffc107; /* Sarı */
            border-bottom: 2px solid #ffc107; /* Sarı */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Zoo Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="animals/list.php">Animals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1 class="text-center main-title">Welcome to Zoo Tracker</h1>
            </div>
        </div>
    </div>
    <footer>
    <p>&copy; 2024 Zootracker System | <a href="https://github.com/ceydagulen/PHP_SQL_PROJECT.git" target="_blank">GitHub Link</a></p>
</footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
