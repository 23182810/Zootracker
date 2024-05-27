<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

require_once "../config.php";

$name = $species = $health_status = $feeding_habits = $habitat = "";
$name_err = $species_err = $health_status_err = $feeding_habits_err = $habitat_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

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
        $sql = "INSERT INTO animals (name, species, health_status, feeding_habits, habitat) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_species, $param_health_status, $param_feeding_habits, $param_habitat);
            
            $param_name = $name;
            $param_species = $species;
            $param_health_status = $health_status;
            $param_feeding_habits = $feeding_habits;
            $param_habitat = $habitat;
            
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
    <title>Add Animal</title>
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
        /* Giriş formunda hata mesajlarının rengi */
        .help-block {
            color: #dc3545; /* Kırmızı */
        }
        /* Formdaki giriş alanları ve butonlar için arkaplan rengi */
        .form-control, .btn {
            background-color: rgba(255, 255, 255, 0.8); /* Beyaz tonu, %80 opaklık */
        }
        /* Formdaki giriş alanları ve butonlar için kenarlık rengi */
        .form-control, .btn {
            border-color: #17a2b8; /* Turkuaz */
        }
        /* Butonlarda hover durumunda arkaplan rengi */
        .btn:hover {
            background-color: #138496; /* Koyu turkuaz */
        }
        /* İptal butonunun rengi */
        .cancel-button {
            background-color: #6c757d; /* Gri */
            border-color: #6c757d; /* Gri */
        }
        /* İptal butonunun hover rengi */
        .cancel-button:hover {
            background-color: #5a6268; /* Koyu gri */
            border-color: #5a6268; /* Koyu gri */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Animal</h2>
        <p>Please fill this form to add an animal.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($species_err)) ? 'has-error' : ''; ?>">
                <label>Species</label>
                <input type="text" name="species" class="form-control" value="<?php echo $species; ?>">
                <span class="help-block"><?php echo $species_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($health_status_err)) ? 'has-error' : ''; ?>">
                <label>Health Status</label>
                <textarea name="health_status" class="form-control"><?php echo $health_status; ?></textarea>
                <span class="help-block"><?php echo $health_status_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($feeding_habits_err)) ? 'has-error' : ''; ?>">
                <label>Feeding Habits</label>
                <textarea name="feeding_habits" class="form-control"><?php echo $feeding_habits; ?></textarea>
                <span class="help-block"><?php echo $feeding_habits_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($habitat_err)) ? 'has-error' : ''; ?>">
                <label>Habitat</label>
                <textarea name="habitat" class="form-control"><?php echo $habitat; ?></textarea>
                <span class="help-block"><?php echo $habitat_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="list.php" class="btn btn-secondary cancel-button">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>
