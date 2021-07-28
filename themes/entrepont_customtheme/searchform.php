<form class="form-inline my-2 my-lg-0" action="<?php esc_url(home_url( '/' )); ?>" method="get">
    <input class="form-control mr-sm-2" type="search" name="s" placeholder="Mots-clé" aria-label="search" value="<?php the_search_query(); ?>" required>
    <button type="submit" class="btn">Rechercher</button>
</form>