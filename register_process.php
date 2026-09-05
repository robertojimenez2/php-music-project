    <?php
    ini_set('display_errors', 1);
error_reporting(E_ALL);
    require_once 'components/conection.php'; 

    if($_SERVER["REQUEST_METHOD"] == "POST") {
            $mail = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
            $age = filter_var(trim($_POST['edad']), FILTER_SANITIZE_NUMBER_INT);
            $gender = trim($_POST['sexo']);
            $country = trim($_POST['country']);

            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $errors = [];
            
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Correo electrónico no válido.";
            }
            if($age < 17 || $age > 120) {
                $errors[] = "La edad debe ser mayor a 17";
            }
            if($gender !== 'masculino' && $gender !== 'femenino'){
                $errors[] = "Sexo no válido.";
            }

            if(strlen($password) < 8) {
                $errors[] = "La contraseña debe tener al menos 8 caracteres.";
            }
            if($password !== $confirm_password) {
                $errors[] = "Las contraseñas no coinciden.";
            }

            if(empty($errors)) {
                $stmt_check = $conexion->prepare("SELECT correo FROM users WHERE correo = ?");
                $stmt_check->bind_param("s", $mail);
                $stmt_check->execute();
                $stmt_check->store_result();
                

                if($stmt_check->num_rows > 0) {
                    $errors[] = "Correo electronico ya registrado.";
                }
                $stmt_check->close();
            }

            if(empty($errors)) {
                $hashedd_pass = password_hash($password, PASSWORD_DEFAULT);
        
                $type = 'free';     

                $stmt_insert = $conexion->prepare("INSERT INTO users (correo, edad, sexo, password_hash, country, type) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("sissss", $mail, $age, $gender, $hashedd_pass, $country, $type);

                if($stmt_insert->execute()) {
                    session_start();
                    $_SESSION["mail"] = $mail;
                    $_SESSION["type"] = $type;
                    $_SESSION["loggedin"] = true;
                    header("Location: dashboard");
                    exit();
                } else {
                        echo "Error de sistema al guardar: " . $conexion->error;
                }
                $stmt_insert->close();
            } else {
                foreach($errors as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }
                echo "<br><a href='register'>Volver al registro</a>";
            }
        } else {
            header("Location: register");
            exit();
        }
        ?>