<div class="card mt-5 mr-2 border border-dark rounded">
    <?php the_post_thumbnail('card-event', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto;' ]) ?>
        <div class="card-body">
            <h5 class="card-title"><?php the_title() ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php the_category(' ') ?></h6>
            <?php the_terms(get_the_ID(), 'discipline') ?><br>
            <?php the_terms(get_the_ID(), 'lieu') ?>

            <!-- <?php the_terms(get_the_ID(), 'calendar') ?> -->

            <p class="card-text"><?php the_excerpt() ?></p>
            <a href="<?php the_permalink() ?>" class="btn">Voir plus</a>
        </div>
</div>