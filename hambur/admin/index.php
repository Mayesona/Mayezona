<?php

// Incluir config file
require_once "config.php";


// Iniciar session
session_start();
 
// verificar si el usuario esta logeado
//if($_SESSION["id"] > 0){
//    header("location: productos.php");
//    exit;
//}
    
 
// Define variables
$username =  $password = "";
$username_err = $password_err = $login_err = "";
 
// Recuperar SUBMIT y validar
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar username vacio
    if(empty(trim($_POST["username"]))){
        $username_err = "Ingrese un Usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Valida password vacio
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingrese una Contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // verifica que no haya errores 
    if(empty($username_err) && empty($password_err)){
        
        
        //COnsulta a la DB
        $sql = "SELECT usu_id, usu_user, usu_password FROM usuarios WHERE usu_user = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // pasa parametro: Usuario
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            
            // Ejecuta consulta y validacion 
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $usu_id, $usu_user, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Si la contraseña es correcta - Inicio sesion!!
                            session_start();
                            
                            // Guardo variables de session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $usu_id;
                            $_SESSION["username"] = $usu_user;                            
                            
                            // Redirect a la pagina de Administración de productos
                            header("location: productos.php");
                        } else{
                            // Si la Password es invalida
                            $login_err = "Usuario o Contraseña incorrestos.";
                        }
                    }
                } else{
                    // Username no existe
                    $login_err = "Usuario o Contraseña incorrestos.";
                }
            } else{
                echo "Oops! Ocurrio un error. Volve a intentarlo";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       h2{
            color: white;
            font-size: 3.0rem;
            
        }
      
        p{
            color:white;
            font-size: 1.6rem;
            
        }
        body{ 
            background-color: #17181b;

            background-image: url(../img/icono2.png);
            
            }
        .wrapper{ 
            background-color: #17181b;
        text-align:center;
        padding: 50px 20px;
	margin: calc(25% + 100px);
	margin-top: 70px;
	padding-top: 28px;
	margin-bottom: 30px
    
            
        }
        * {
	    padding: 0;
	    margin: 0;
	    font-family: century gothic;
	    text-align: center;
        }
        label{
            color:white;
            background-color: #17181b;


        }
         
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Para acceder, ingrese sus credenciales.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            
        </form>
    </div>
</body>
</html>