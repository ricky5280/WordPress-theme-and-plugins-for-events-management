<a class="navbar-brand" href="#">
            <?= the_custom_logo(); ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" style="color:#CBE8AD; border-color: #CBE8AD" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="dashicons dashicons-menu-alt3"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <!-- affichage menu -->
                <?php wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => 'false',
                    'menu_class' => 'navbar-nav mr-auto'
                    ]) ?>

            
                <!-- affichage formulaire de recherche -->
                <?php get_search_form(); ?>


            </div>