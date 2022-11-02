<?php
    require '../includes/funciones.php';
    $auth = autenticado();

    if(!$auth){
        header('Location: /');
    }

    // Importar la conexión de la BD
    require '../includes/config/database.php';
    $db = ConnectDB();

    // Escribir query
    $query = "SELECT * FROM propiedades";

    // Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    // MUESTRA MENSAJE CONDICIONAL
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            // Eliminar el archivo de imagen
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";

            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../images/' . $propiedad['imagen']);

            // Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);

            if( $resultado) {
                header('Location: /admin?resultado=3');
            }
        }
    }

    // INCLUYE UN TEMPLATE
    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if( intval( $resultado) === 1): ?>
        <p class="alerta exito"> Registro Exitoso!</p>
    <?php elseif( intval( $resultado) === 2): ?>
        <p class="alerta exito"> Actualización Exitosa!</p>
    <?php elseif( intval( $resultado) === 3): ?>
        <p class="alerta exito"> Anuncio Eliminado!</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Image</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados de la BD-->
        <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta) ): ?>
            <tr>
                <td> <?php echo $propiedad['id']; ?> </td>
                <td> <?php echo $propiedad['titulo']; ?> </td>
                <td> <img src="/images/<?php echo $propiedad['imagen'];?>" class="imagen-tabla"> </td>
                <td>$ <?php echo $propiedad['precio']; ?> </td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
    // Cerrar la conexión de la BD
    mysqli_close($db); // Opcional, sql detecta cuando se suspende el uso y la cierra automaticamente.

    incluirTemplate('footer');

?>