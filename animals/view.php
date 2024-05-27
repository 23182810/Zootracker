<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

require_once "../config.php";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = trim($_GET["id"]);
    
    $sql = "SELECT * FROM animals WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = $id;
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $name = $row["name"];
                $species = $row["species"];
                $health_status = $row["health_status"];
                $feeding_habits = $row["feeding_habits"];
                $habitat = $row["habitat"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
} else{
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Animal</title>
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
        /* Form başlığı rengi */
        h2 {
            color: #5D0E41; /* Turuncu */
        }
        /* Kart arka plan rengi */
        .card {
            background-color: rgba(0, 0, 0, 0.5); /* Siyah tonu, %50 opaklık */
            border: 1px solid #17a2b8; /* Turkuaz kenarlık */
            margin-top: 50px;
        }
        /* Kart içeriği rengi */
        .card-body, .form-control-static {
            color: #ffffff; /* Beyaz metin rengi */
        }
        /* Buton rengi */
        .btn-primary {
            background-color: #138496; /* Koyu turkuaz */
            border-color: #138496; /* Koyu turkuaz */
        }
        /* Buton hover rengi */
        .btn-primary:hover {
            background-color: #0c6b7e; /* Daha koyu turkuaz */
            border-color: #0c6b7e; /* Daha koyu turkuaz */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">View Animal</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Name:</label>
                    <p class="form-control-static"><?php echo $name; ?></p>
                </div>
                <div class="form-group"><hr>
                    <label>Species:</label>
                    <p class="form-control-static"><?php echo $species; ?></p>
                </div><hr>
                <div class="form-group">
                    <label>Health Status:</label>
                    <p class="form-control-static"><?php echo $health_status; ?></p>
                </div><hr>
                <div class="form-group">
                    <label>Feeding Habits:</label>
                    <p class="form-control-static"><?php echo $feeding_habits; ?></p>
                </div><hr>
                <div class="form-group">
                    <label>Habitat:</label>
                    <p class="form-control-static"><?php echo $habitat; ?></p>
                </div>
                <a href="list.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
