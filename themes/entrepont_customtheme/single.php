<?php get_header() ?>

<?php if (have_posts()):  while (have_posts()) : the_post(); ?>
            
<div class="row">       
    <div class="col-5">          
            
            <h1 class="mt-5"><?php the_title() ?></h1>

            <h6 class="card-subtitle mb-2 text-muted"><?php the_category(' ') ?></h6>
            
            <?php the_terms(get_the_ID(), 'discipline') ?><br>
            <?php the_terms(get_the_ID(), 'lieu') ?>

    </div>  

    <div class="col-7 mt-5"> 

                <p>
                <?php the_post_thumbnail('single-event', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto;' ]); ?>
                </p>  
     </div>                
             
</div>            
            <div class="mb-5"> <?php the_content() ?>  </div>

    <?php endwhile;
    endif; ?>  


<!-- extension compteur de vues -->
<?php setPostViews(get_the_ID()); ?>
           


<?php get_footer() ?>