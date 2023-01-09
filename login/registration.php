<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="icon.png">
</head>
<body>
    <div class="container">
    <img src="logo.PNG" height="100" width="100" padding="50" >
        <?php
        if (isset($_POST["submit"])){
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();

            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
             array_push($errors, "Remplissez tous les champs svp");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
             array_push($errors, "Mot de passe invalide");
            }
            if (strlen($password)<8){
             array_push($errors, "Votre mot de passe dois au moins contenir 8 caractères");
            }
            if ($password!== $passwordRepeat){
             array_push($errors, "Le mot de passe n'est pas correcte, veuillez réessayer svp");
            }
            require_once('database.php');
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowcount>0) {
                array_push($errors,"Email existe déjà");
            }
            if (count($errors)>0){
             foreach ($errors as $errors){
                echo "<div class='alert alert-danger'>$error</div>";
             }
            }
            else{

                $sql = "INSERT INTO users (full_name,email, password) VALUES ( ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepare_stmt) {
                    mysqli_stmt_bind_param($stmt,'sss',$fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success>You are registred successfully.</div>";
                }
                else{
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="registration.php" method="post"></form>
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Nom:">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repétez le mot de passe:">
        </div>
        <div class="form-group">
            <input type="submit" class="btn" value="Enregistrer" name="submit">
        </div>
        <br>
        <div><p>Raha efa manana compte<br><a href="Login.php">Se connecter</a></p></div>
    </div>
    </div>
</body>
</html>