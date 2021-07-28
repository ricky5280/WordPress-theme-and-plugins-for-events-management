<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        
    <!-- insértion de la barre d'administration en en-tête  -->
    <?php wp_head(); ?>


</head>
<body>

    <nav class="navbar navbar-expand-lg">

    <?php get_template_part('partials/navbar') ?> 

    </nav> 





    <div id="header" class="row">
    
        <div class="col-4">
            <h2 id="title" class="pl-5">Entre-Pont</h2>
        
        </div>

        <div id="sup-int-header" class="col-8">
            <div id="int-header" class="row d-flex flex-wrap">

                <div class="col-4">
                    <h2>Lieu de création</h2>
                </div> 
                <div class="col-4">   
                    <h2>Spectacle vivant</h2>
                </div> 
                <div class="col-4">
                    <h2>Pluridisciplinaire</h2>
                </div> 
            </div>    
        </div>    


    </div>


   


<div class="container" id="container">