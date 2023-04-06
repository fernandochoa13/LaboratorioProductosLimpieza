<?php
include "php/Database/dbconexion.php";

if(isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert('$message');</script>"; 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Quimicaroma</title>
    <link rel="shortcut icon" href="img/logo.png">

</head>
<body>
<section>
    <div class="form-box">
        <div class="form-value">
            <h2>Inicio de Sesión</h2>
    <form action="" method="POST">
        <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <label for="" >Correo Electrónico:</label> <br>
        <input type="text"
        name="emailField" required>
        </div>
        <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <label for="" >Clave:</label> <br>
        <input type="text" name="claveField" required>
    </div>
    <div class="forget">
        <label for=""><input type="checkbox">Recuerdame</label>
        <a href="#" class="olvideContra">Olvide mi contraseña</a>
    </div>
       
        <input type="submit" value="Iniciar Sesión" name="botonIniciarSesion" class="boton">
        
    </form>
    </div>
    </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<footer>
    <img src="img/logo.jpg" class="LogoQuimicaroma"></img>
    <p>Copyright © 2023. Todos los derechos reservados. Pagina hecha por Fernando Ochoa</p>
</footer>
</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
* {
    padding: 0;
    margin: 0;
    font-family: 'poppins',sans-serif;
}


section{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100%;
    
    background: url('img/LabLogin.jpg')no-repeat;
    background-position: center;
    background-size: cover;
}

.form-box{
    position: relative;
    width: 400px;
    height: 450px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;

}

h2{
    font-size: 2em;
    color: #fff;
    text-align: center;
}

.inputbox{
    position: relative;
    margin: 30px 0;
    width: 310px;
    border-bottom: 2px solid #fff;
}
.inputbox label{
    position: absolute;
    top: 25%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}

input:focus ~ label,
input:valid ~ label{
top: -5px;
}
.inputbox input {
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;
}

.inputbox ion-icon{
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2em;
    top: 20px;
}
.forget{
    margin: -15px 0 15px ;
    font-size: .9em;
    color: #fff;
    display: flex;
    justify-content: space-between;  
}

.forget label input{
    margin-right: 3px;
    
}
.forget label a{
    color: #fff;
    text-decoration: none;
}
.forget label a:hover{
    text-decoration: underline;
}

.boton {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight: 600;
}

.olvideContra {
    color: rgb(83, 184, 180);
}

footer {
    text-align: center;
    color: rgb(83, 184, 180);
    margin-top: 2%;
}

</style>

<?php
 if(isset($_POST['botonIniciarSesion']) && !empty($_POST['emailField']) && !empty($_POST['claveField'])) {
    $email = $_POST['emailField'];
    $clave = $_POST['claveField'];
    $claveConvertida = md5($clave);
    $querySelect = $conn->query("select * from usuario where correo='$email' and clave='$claveConvertida'");
    if ($datos=$querySelect->fetch_object()) {
        if(session_status() !== PHP_SESSION_ACTIVE)  {
            session_start();
        }
        
        if(!isset($_SESSION["sesionesArray"])) {
            $_SESSION["sesionesArray"] = array();
            $_SESSION["Usuario"] = $email;
            $_SESSION["clave"] = $clave;
            header("Location:php/paginas/home.php");
        } else {
            header("Location:php/paginas/home.php");
        }
       
    } else {
        echo "Los datos son incorrectos";
    }

} else {
   
}
if( isset($_POST['botonIniciarSesion']) && (empty($_POST['claveField']) || empty($_POST['emailField']))) {
    echo "Uno de los campos esta vacio";
}


?>