<div class="card mt-5 mb-5 mr-2 border border-dark rounded">
    <?php the_post_thumbnail('card-event', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto;' ]) ?>
        <div class="card-body" id="carrousel">
          
           <h5 class="card-title"><?php the_title() ?></h5>
          
           <h5 id="date" class="card-subtitle mb-2"><?= $date = get_post_meta($post->ID, 'datetime_value_key', true); ?></h5>           
          
           <h6> Discipline : <span><?php the_terms(get_the_ID(), 'first-tax') ?></span></h6>
           <h6>Organisateur : <span><?php the_terms(get_the_ID(), 'second-tax') ?></span></h6>
           <h6 class="mb-3" >Lieu : <span><?php the_terms(get_the_ID(), 'third-tax') ?></span></h6>

           
                       
            <a href="<?php the_permalink() ?>" class="btn">Voir plus</a>
        </div>
</div>