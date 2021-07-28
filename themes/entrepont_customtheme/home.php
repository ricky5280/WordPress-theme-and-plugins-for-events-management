<?php get_header() ?>

<h1 class="mt-4 text-center">Prochains événements</h1>

<!-- <?php wp_list_categories(['taxonomy' => 'discipline', 'title_li' => '']); ?>

<?php $disciplines = get_terms(['taxonomy' => 'discipline']); ?>

<ul class="nav nav_pills" >
    <?php foreach ($disciplines as $discipline): ?>
        <li class="nav-item">
        <a href="<?= get_term_link($discipline) ?>" class="nav-link"><?= $discipline->name ?></a>
        </li>
    <?php endforeach; ?>
</ul> -->
    
        <?php if (have_posts()): ?>
    
    <div class="row">
        
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-4">

                <?php get_template_part('partials/event') ?>  

            </div>    
        <?php endwhile ?>  
           
    </div>
<?php else : ?>
    <h2>Pas d'événement pour le moment</h2>
<?php endif; ?>



<?php get_footer() ?>