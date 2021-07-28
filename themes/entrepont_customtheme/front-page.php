<?php get_header() ?>


<!-- 
<?= '<iframe width="100%" height="_800" src="https://www.youtube.com/embed/zx2Ib9zSz3A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' ?>   -->


<img id="header-img" src="http://localhost/wordpress/Entrepont_zero/wp-content/uploads/2021/06/accueil-e1622716077119.jpg" alt="">



  
  <div class="p-4 p-md-5 mb-4 text-black rounded" id="presentation">
    
      <h1 class="display-4 font-italic font-weight-bold text-center">Entre-Pont</h1>
      <p class="lead my-3 font-weight-bold">L’Entre-Pont est un lieu de création et de résidence pour le spectacle vivant.
    Implanté et opérant sur des quartiers populaires de Nice Est, ce lieu imagine et propose avec ses principaux partenaires, 
    de nouveaux modes de coopération dans le domaine de la culture et de la création contemporaine en lien avec 
    les évolutions et les enjeux de notre société.</p>      
   
  </div>


        
        <article id="edito" class="blog-post my-5 p-5">
          <h2 class="blog-post-title">Le mot de l'Entre-Pont</h2>
          
          <p>Depuis des mois nous attendions nos retrouvailles en maintenant avec vous ces “entre-ponts” ! <br>
          Les artistes ont continué à chercher, à créer, à repenser leur monde. Il est temps maintenant pour eux de vous retrouver.
          En coulisses, les pratiques artistiques ont été maintenues avec les scolaires. <br>
          Progressivement, nos actions redeviennent accessibles à tous ! Découvrez la programmation estivale ! </p>
          
        </article>




  <!-- loop carrousel 3 events -->


<div class="container-fluid my-5" id="container_2">

    <h2 class="mt-5 text-center">Prochains événements</h2>

    <?php     

        $today = date( 'Y-m-d' );    
        $args = array(
            'post_type' => 'event',
            'showposts' => 3,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_key' => 'datetime_value_key',
            'meta_query' => array(
              array(
                  'key' => 'datetime_value_key',
                  'value' => $today,
                  'compare' => '>=',
                  'type' => 'DATE'
                ) )
             );

        $loop = new WP_Query($args);

          if ($loop->have_posts()): ?> 
                
            <div class="row" id="proch_event">
              
              <?php  while ( $loop->have_posts() ) :  $loop->the_post();   ?> 
  
              <div class="col-4">
                  <?php get_template_part('partials/event-carrousel') ?>  
              </div>   

              <?php endwhile ?>                          

            </div>

      <?php else : ?>
            <h2>Pas d'événement pour le moment</h2>
      <?php endif; ?>

</div>


      <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Instagram</strong>
          <h3 class="mb-0">Visiter notre page</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Youtube</strong>
          <h3 class="mb-0">S'abonner à notre chaine</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
  </div>






<?php get_footer() ?>

    
  </body>
</html>
