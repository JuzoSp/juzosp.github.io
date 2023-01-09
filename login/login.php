<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="icon.png">
</head>
<body> 
 <div class="container"> 
 <h1>Login</h1>
 <img src="logo.PNG" height="100" width="90">
    <?php
        if (isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result,  MYSQLI_ASSOC);
            if ($user){
                if (password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = "yes";
                header("Location : index.php");
                die();
                }else{
                    echo "<div class='alert alert-danger>Password does not match</div>";  
                }
            }else{
                echo "<div class='alert alert-danger>Email does not match</div>";
            }
        
        }
    ?>
    <form action="login.php" method="post">
    <div class="form-group">
            <input type="email" class="form-control" name="fullname" placeholder="Email">
    </div>
    <div class="form-group">
            <input type="password" class="form-control" name="fullname" placeholder="Mot de passe">
    </div> 
    <div class="form-group">
            <input type="submit" class="btn" value="Se connecter" name="submit">
    </div>
    </form>
    <br>
    <div><p>Raha mbola tsy manana compte <a href="registration.php">Créer</a></p></div>
    </div>
</body>
</html>