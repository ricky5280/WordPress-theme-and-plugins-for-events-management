<?php get_header() ?>


<?php while (have_posts()) {

         the_post(); ?>
            
        
            
        <h1 class="mt-4 text-center"><?php the_title() ?></h1>
        
        <p><?php the_content() ?></p>
   
   <?php   }

?>  
           
<?php get_footer() ?>