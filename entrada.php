<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Guía para la decoración de tu hogar</h1>

    <picture>
        <source srcset="build/img/destacada2.webp" type="image/webp">
        <source srcset="build/img/destacada2.jpg" type="image/jpeg">
        <img src="build/img/destacada2.jpg" alt="imagen de la Propiedad" loading="lazy">
    </picture>
    <p class="informacion-meta">Escrito el: <span>20/10/2022</span> por: <span>Admin</span> </p>

    <div class="resumen-propiedad">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
        </p>
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam et officiis ab! Porro assumenda iure dolore veniam ea laborum voluptatem, eum, fugit qui quibusdam minus ipsa laboriosam temporibus fuga sapiente.</p>
    </div>
</main>

<?php incluirTemplate('footer'); ?>