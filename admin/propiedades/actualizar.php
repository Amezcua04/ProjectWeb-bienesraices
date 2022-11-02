<?php
    require '../../includes/funciones.php';
    $auth = autenticado();

    if(!$auth){
        header('Location: /');
    }

    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var( $id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }
    // Base de Datos
    require '../../includes/config/database.php';
    $db = ConnectDB();

    // Obtener los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedor";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorid = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];


    // Ejecutar el codigo despues de que el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        /*echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";*/

        // mysqli_real_escape_string sirve para desahibilitar el cross site scripting (inyeccion de codigo sql)
        $titulo = mysqli_real_escape_string($db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string($db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string($db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
        $creado = date('Y/m/d');
        $vendedorid = mysqli_real_escape_string($db, $_POST['vendedor_id'] );

        // echo "<pre>";
        // var_dump($vendedorid);
        // echo "</pre>";
        // exit;
        // Asignar files a una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = 'Debes Añadir un Titulo';
        }
        if(!$precio){
            $errores[] = 'El Precio es Obligatorio';
        }
        if(strlen( $descripcion) < 50 ){
            $errores[] = 'La Descripcion Debe Contener al menos 50 Caracteres';
        }
        if(!$habitaciones){
            $errores[] = 'El Número de Habitaciones es Obligatorio';
        }
        if(!$wc){
            $errores[] = 'El Número de Baños es Obligatorio';
        }
        if(!$estacionamiento){
            $errores[] = 'El Número de Estacionamientos es Obligatorio';
        }
        if(!$vendedorid) {
            $errores[] = 'Elige un Vendedor';
        }

        // Validar por tamaño (1Mb maximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida ) {
            $errores[] = 'La Imagen es muy Pesada';
        }

        /*echo "<pre>";
        var_dump($errores);
        echo "</pre>";*/

        // Revisar si el arreglo de errores esta vacio
        if(empty($errores)){
            /** SUBIDA DE ARCHIVOS
             *
             * Crear Carpeta */
            $carpetaImagenes = '../../images/'; // Asignamos la dirección de la carpeta

            if(!is_dir($carpetaImagenes)){ // Validamos si no existe la carpeta
                mkdir($carpetaImagenes); // Creamos la carpeta con la ruta especifica
            }

            $nombreImagen = '';

            // Validamos si existe una imagen previa a la actualización
            if( $imagen['name']) {
                unlink( $carpetaImagenes . $propiedad['imagen']);
                /** SUBIDA DE ARCHIVOS
                 *
                 * Generar un nombre único del archivo */
                $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

                /** SUBIDA DE ARCHIVOS
                 *
                 * Subir la Imagen */
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
            // Insertar en la base de datos
            $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, vendedorId = ${vendedorid} WHERE id = ${id} ";

            // echo $query;

            $resultado = mysqli_query($db, $query);
            if ($resultado) {
                // Redireccionar al usuario
                header('Location: /admin?resultado=2');
            }
        }

    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/images/<?php echo $imagenPropiedad; ?>" alt="imagen propiedad" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9"value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor_id">
                <option value="">-- Seleccione Vendedor--</option>
                <?php while($row = mysqli_fetch_assoc($resultado) ): ?>
                    <option <?php echo $vendedorid === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']." ".$row['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>