<?php get_header() ?>


<?php while (have_posts()) : the_post(); ?>
            
   <div class="card mt-5 mb-5">  

          <div class="card-body"> 

               <a href="<?php the_permalink() ?>">
               <h3><?php the_title() ?></h3>
               </a>    

               <?php the_post_thumbnail('card-event') ?>
               
               <p><?php the_excerpt() ?></p>
          
               <a href="<?php the_permalink() ?>" class="btn">
               Voir plus
               </a>

          </div>
   </div>

   <?php endwhile ?>
           

<?php get_footer() ?>