<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

require_once "../config.php";

$name = $species = $health_status = $feeding_habits = $habitat = "";
$name_err = $species_err = $health_status_err = $feeding_habits_err = $habitat_err = "";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id =  trim($_GET["id"]);
    
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

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = $_POST["id"];
    
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter the name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    if(empty(trim($_POST["species"]))){
        $species_err = "Please enter the species.";
    } else{
        $species = trim($_POST["species"]);
    }
    
    if(empty(trim($_POST["health_status"]))){
        $health_status_err = "Please enter the health status.";
    } else{
        $health_status = trim($_POST["health_status"]);
    }
    
    if(empty(trim($_POST["feeding_habits"]))){
        $feeding_habits_err = "Please enter the feeding habits.";
    } else{
        $feeding_habits = trim($_POST["feeding_habits"]);
    }
    
    if(empty(trim($_POST["habitat"]))){
        $habitat_err = "Please enter the habitat.";
    } else{
        $habitat = trim($_POST["habitat"]);
    }
    
    if(empty($name_err) && empty($species_err) && empty($health_status_err) && empty($feeding_habits_err) && empty($habitat_err)){
        $sql = "UPDATE animals SET name=?, species=?, health_status=?, feeding_habits=?, habitat=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_species, $param_health_status, $param_feeding_habits, $param_habitat, $param_id);
            
            $param_name = $name;
            $param_species = $species;
            $param_health_status = $health_status;
            $param_feeding_habits = $feeding_habits;
            $param_habitat = $habitat;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: list.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal</title>
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
            color: #A34343; /* Turkuaz */
        }
        /* Form arka plan rengi */
        .container {
            background-color: rgba(0, 0, 0, 0.5); /* Siyah tonu, %50 opaklık */
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
        }
        /* Input kutusu rengi */
        .form-control {
            background-color: rgba(255, 255, 255, 0.1); /* Beyaz tonu, %10 opaklık */
            color: #ffffff; /* Beyaz metin rengi */
            border: none; /* Kenarlık yok */
            border-bottom: 1px solid #ffffff; /* Alt çizgi */
            border-radius: 0; /* Kenar yuvarlaklığı yok */
        }
        /* Yardımcı metin rengi */
        .help-block {
            color: #ff6666; /* Kırmızı */
        }
        /* Buton rengi */
        .btn-primary {
            background-color: #138496; /* Koyu turkuaz */
            border-color: #138496; /* Koyu turkuaz */
            border-radius: 5px; /* Kenar yuvarlaklığı */
        }
        /* Buton hover rengi */
        .btn-primary:hover {
            background-color: #0c6b7e; /* Daha koyu turkuaz */
            border-color: #0c6b7e; /* Daha koyu turkuaz */
        }
        /* Butonlar arası boşluk */
        .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Animal</h2>
        <p>Please edit the input values and submit to update the animal.</p>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($species_err)) ? 'has-error' : ''; ?>">
                <label>Species</label>
                <input type="text" name="species" class="form-control" value="<?php echo $species; ?>">
                <span class="help-block"><?php echo $species_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($health_status_err)) ? 'has-error' : ''; ?>">
                <label>Health Status</label>
                <textarea name="health_status" class="form-control"><?php echo $health_status; ?></textarea>
                <span class="help-block"><?php echo $health_status_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($feeding_habits_err)) ? 'has-error' : ''; ?>">
                <label>Feeding Habits</label>
                <textarea name="feeding_habits" class="form-control"><?php echo $feeding_habits; ?></textarea>
                <span class="help-block"><?php echo $feeding_habits_err;?></span>
            </div>
            <div class="form-group <?php echo (!empty($habitat_err)) ? 'has-error' : ''; ?>">
                <label>Habitat</label>
                <textarea name="habitat" class="form-control"><?php echo $habitat; ?></textarea>
                <span class="help-block"><?php echo $habitat_err;?></span>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="list.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
