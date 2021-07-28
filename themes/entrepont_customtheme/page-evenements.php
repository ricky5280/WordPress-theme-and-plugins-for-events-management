<?php get_header() ?>


<?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $today = date( 'Y-m-d' );         
        $args = array(
            'post_type' => 'event',
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'datetime_value_key',
            'meta_query' => array(
                array(
                    'key' => 'datetime_value_key',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'DATE'
                ) ),
                'paged' => $paged    

        );

        $loop = new WP_Query($args);
        if ($loop->have_posts()):  while ( $loop->have_posts() ) : $loop->the_post();
        

        ?>            


            
        <div class="card mt-5 mb-3">  

            <div class="card-body">             

                <a href="<?php the_permalink() ?>">
                <h3><?php the_title() ?></h3>
                </a>    
                <h4 id="date"><?= $date = get_post_meta($post->ID, 'datetime_value_key', true); ?></h4><br>
                <?php the_post_thumbnail('card-event') ?>
                
                <p><?php the_excerpt() ?></p>
            
                <a href="<?php the_permalink() ?>" class="btn">
                Voir plus
                </a>

            </div>
        </div>

            
        <?php endwhile ?>  

    
     
            <div class="pagination">
                <?php

                $big = 999999999;
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $loop->max_num_pages,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;'
                ) );

                ?>
            </div>

        <?php wp_reset_postdata(); ?>



             
            <?php else : ?>
                <h2>Pas d'événement pour le moment</h2>
            <?php endif; ?>
      
                    
  
  
           

<?php get_footer() ?>