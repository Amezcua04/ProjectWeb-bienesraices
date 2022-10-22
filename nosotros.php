<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre Nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="buil/img/nosotros.jpg" type="image/jpeg">
                <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
            </picture>
        </div>
        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque recusandae assumenda delectus magni perferendis, vel iure quidem hic laudantium nobis. Est quos, corrupti similique dicta aliquid temporibus ratione delectus blanditiis!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque recusandae assumenda delectus magni perferendis, vel iure quidem hic laudantium nobis. Est quos, corrupti similique dicta aliquid temporibus ratione delectus blanditiis!</p>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque recusandae assumenda delectus magni perferendis, vel iure quidem hic laudantium nobis. Est quos, corrupti similique dicta aliquid temporibus ratione delectus blanditiis!</p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nobis blanditiis at natus dolores soluta pariatur iste, ea cum porro inventore fuga fugit ab. Ut sint eligendi aperiam et ducimus!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nobis blanditiis at natus dolores soluta pariatur iste, ea cum porro inventore fuga fugit ab. Ut sint eligendi aperiam et ducimus!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nobis blanditiis at natus dolores soluta pariatur iste, ea cum porro inventore fuga fugit ab. Ut sint eligendi aperiam et ducimus!</p>
        </div>
    </div>
</section>

<?php incluirTemplate('footer'); ?>