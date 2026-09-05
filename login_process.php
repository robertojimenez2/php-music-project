<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'components/conection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    $errors = [];

    if(empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Por favor, ingresa un correo electrónico válido.";
    }
    if(empty($password)) {
        $errors[] = "Por favor, ingresa tu contraseña.";
    }

    if(empty($errors)) {
        $stmt = $conexion->prepare("SELECT correo, password_hash, type FROM users WHERE correo = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado->num_rows === 1) {
            $user = $resultado->fetch_assoc();

            if(password_verify($password, $user['password_hash'])) {
                $_SESSION["mail"] = $user['correo'];
                $_SESSION["type"] = $user['type'];
                $_SESSION["loggedin"] = true;

                header("Location: dashboard");
                exit();
            } else {
                $errors[] = "Correo o contraseña incorrectos.";
            }
        } else {
            $errors[] = "Correo o contraseña incorrectos.";
        }
        $stmt->close();
    }

    if(!empty($errors)) {
        $_SESSION['errores_login'] = $errors;
        header("Location: index"); 
        exit();
    }

} else {
    header("Location: index");
    exit();
}
?>