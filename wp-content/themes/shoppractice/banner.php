<?php
    // global $wp;
    // echo home_url( $wp->request );
    $taxonomyName = "product_cat";
    //This gets top layer terms only.  This is done by setting parent to 0.  
    $parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));
    $category = get_queried_object();
    $current_term_id = $category->term_id;
    ?>
    <?php 
        echo $current_term_id;
        echo gettype($current_term_id);
        $thumbnail_id = get_woocommerce_term_meta($current_term_id, 'thumbnail_id', true);
        // get the image URL for parent category
        $image = wp_get_attachment_url($thumbnail_id);
        echo gettype($image);
        if((is_null($current_term_id))){
            $image = wp_get_attachment_url(33);
            echo $image;
            $link = "<img src='{$image}' alt=''/>";
        }else{
            // print the IMG HTML for parent category
            $link = "<img src='{$image}' alt=''/>";
        }?>
                
        
        <h1 class="title_banner"><?php echo $category->name; ?></h1>
        <div class="img-banner">
            <?php echo $link?>
        </div>
                                               
    <?php 
?>