<?php
require_once 'components/conection.php'; 

$query_countries = "SELECT  code, name FROM paises ORDER BY name ASC";
$result_countries = $conexion->query($query_countries);
   
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
        <!-- Panel Izquierdo: Información de la App -->
        <!-- Panel Derecho: Formulario de Login -->
        <section class="auth-formulario">
            <h2>Registrate</h2>
            <p class="subtitulo">Completa el formulario para crear tu cuenta.</p>

            <form action="register_process" method="POST" class="formulario">
                <div class="grupo-input">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="grupo-input">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" placeholder="25" required>
                </div>

                <div class="grupo-input">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo" required class="select-sex">
                        <option value="" >Selecciona tu sexo</option>
                        <option value="masculino" >Masculino</option>
                        <option value="femenino" >Femenino</option>
                    </select>
                </div>

                 <div class="grupo-input">
                    <label for="country">País</label>
                    <select id="country" name="country" required class="select-sex">
                        <option value="">Selecciona tu país</option>
                        
                        <!-- Generar las opciones dinámicamente con PHP -->
                        <?php while($country = $result_countries->fetch_assoc()): ?>
                            <option value="<?php echo $country['code']; ?>">
                                <?php echo $country['name']; ?>
                            </option>
                        <?php endwhile; ?>
                        
                    </select>
                </div>

                <div class="grupo-input">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="grupo-input">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-principal">Crear cuenta</button>
            </form>

            <div class="auth-enlaces">
                <p>¿Aún no tienes una cuenta? <a href="index">Inicia sesión aquí</a></p>
            </div>
        </section>
    </main>

</body>
</html>