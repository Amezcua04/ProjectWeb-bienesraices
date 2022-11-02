<?php
    // Importar la BD
    require 'includes/config/database.php';
    $db = ConnectDB();

    // Autenticación de usuario
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password'] );

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }
        if(!$password) {
            $_POST['email'] = $email;
            $errores[] = "El password es obligatorio";
        }

        if( empty($errores) ) {
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuario WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado -> num_rows ) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                // var_dump($usuario);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    // El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "EL password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }
    // Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Usuario</legend>

            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" placeholder="Tu Email">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Tu Password">

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>