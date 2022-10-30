<?php
    /**
     *  echo "<pre>";
        var_dump($id);
        echo "</pre>";
     */
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    // Importar la BD
    require 'includes/config/database.php';
    $db = ConnectDB();

    // Consultar la BD
    $query = "SELECT * FROM propiedades WHERE id = ${id} ";

    // Obtener los resultados
    $resultado = mysqli_query($db, $query);
    if(!$resultado->num_rows) {
        header('Location: /');
    }
    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <img src="/images/<?php echo $propiedad['imagen']; ?>" alt="imagen de la Propiedad" loading="lazy">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas">
            <!-- Caracteristica 1 w.c -->
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <!-- Caracteristica 2 Automoviles -->
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <!-- Caracteristica 3 Recamaras -->
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad['descripcion']; ?></p>
    </div>
</main>

<?php
    incluirTemplate('footer');
    // Cerrar la conexión de la BD
    mysqli_close($db);
?>