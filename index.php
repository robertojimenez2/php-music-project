<?php
    require_once 'components/conection.php'; 

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $errores_login = $_SESSION['errores_login'] ?? [];
    unset($_SESSION['errores_login']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Mi Biblioteca Musical</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="pantalla-ingreso">

    <main class="contenedor-auth">
        <section class="auth-info">
            <div class="info-contenido">
                <h1>AudioVault</h1>
                <p>El núcleo de tu colección musical.</p>
                <p class="detalle">Organiza tus álbumes, sube tus pistas, analiza tus archivos MIDI y lleva el control absoluto de tus piezas de piano favoritas con nuestra arquitectura de datos.</p>
            </div>
        </section>

        <section class="auth-formulario">
            <h2>Iniciar Sesión</h2>
            <p class="subtitulo">Ingresa tus credenciales para acceder a tu catálogo.</p>

            <?php if (!empty($errores_login)): ?>
                <div class="alerta-error">
                    <ul>
                        <?php foreach ($errores_login as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="login_process.php" method="POST" class="formulario">
                <div class="grupo-input">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="grupo-input">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-principal">Entrar al Sistema</button>
            </form>

            <div class="auth-enlaces">
                <p>¿Aún no tienes una cuenta? <a href="register">Crea una aquí</a></p>
            </div>
        </section>
    </main>

</body>
</html>