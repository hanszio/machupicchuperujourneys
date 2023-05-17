<?php if (ICL_LANGUAGE_CODE == 'en') :
    $discoverperu = "Discover Peru";
    $childof = 29;
endif; ?>
<?php if (ICL_LANGUAGE_CODE == 'es') :
    $discoverperu = "Descubre el Perú";
    $childof = 13;
endif; ?>
<h2 class="tittle-coca"><?php echo $discoverperu; ?></h2>
<div class="packages">
    <?php
        $subcategories = get_terms(array( //Obtener los términos (subcategorías) de la categoría específica
            'taxonomy' => 'tipo-de-tour', // Reemplazar con el nombre de la taxonomía correspondiente
            'hide_empty' => false,
            'child_of' => $childof, // Reemplazar con el ID de la categoría específica
        ));
        $subcategories = array_reverse($subcategories); // Invertir el orden del array
        $cont1 = 1;
        foreach ($subcategories as $subcategory) {
            //Recorrer los términos y mostrar el título y la descripción de cada uno 
    ?>
        <div class="packages__card card-<?php echo $cont1; ?>">
            <div class="card-content">
                <h3><?php echo $subcategory->name; ?></h3>
                <p><?php echo $subcategory->description; ?></p>
                <a class="button-mpj" href="<?php echo get_term_link( $subcategory->term_id ); ?>">Ver<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    <?php $cont1++;
        }
    ?>
</div>
