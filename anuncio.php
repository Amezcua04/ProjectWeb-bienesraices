<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta frente al bosque</h1>
    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img src="build/img/destacada.jpg" alt="imagen de la Propiedad" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
            <!-- Caracteristica 1 w.c -->
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p>3</p>
            </li>
            <!-- Caracteristica 2 Automoviles -->
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p>3</p>
            </li>
            <!-- Caracteristica 3 Recamaras -->
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy">
                <p>4</p>
            </li>
        </ul>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
        </p>
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.</p>
    </div>
</main>

<?php incluirTemplate('footer'); ?>