<!DOCTYPE html>
<html <?php language_attributes(); ?>>
 <head>
   <meta charset="<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
   <?php if(is_home()): ?>
        <meta name="description" content="Le site présente la page des articles du blog 
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, aspernatur." />
    <?php endif; ?>

    <?php if(is_front_page()): ?>
        <meta name="description" content="Le site présente la page d'accueil statique
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, impedit." />
    <?php endif; ?>

    <?php if(is_page()  && !is_front_page()): ?>
        <meta name="description" content="Le site présente une contenu de type page    
        Loorem ipsuum dolor sit amet, consectetur adipisicing elit. At, aspernatur." />
    <?php endif; ?>

   <?php wp_head(); ?>
 </head>




<body <?php body_class(); ?>>
    
    <header class="header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="d-flex justify-content-center">
        <!--logo--> 
                    <div class="logo">
                        <a href="<?php echo home_url( '/' ); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class='img-fluid' alt="Logo">
                        </a>
                    </div>
                </div>
            </div>
         <!-- titre -->  
          <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-6 col-lg-12 col-xl-12">
                <div class="slogan">
                    <h1><?php bloginfo('description');// affiche le slogan définit dans général  ?></a></h1>
                </div>
                </div>
            </div>
        <!--menu de navigation-->
             <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-sm-6 col-lg-12 col-xl-12">
                <div class="nav">
                   <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="<?php echo bloginfo('url'); ?>"></a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                        <?php
                wp_nav_menu( array(
                    'menu'              => 'top-menu',
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'navbar',
                    'menu_class'        => 'nav navbar-nav ml-auto',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker())
                );  ?>
                    </div>
                    </div><!-- /container -->
                  </nav>
                </div>
            </div>
        </div>
    </header>
  
        <!-- affiche si validation du message de la page accueil -->
        <?php if (isset($_SESSION['contact-result'])): ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bg-success text-white text-center p-3 mb-3">
                            <p class="mb-0"><?php echo $_SESSION['contact-result']; ?></p>
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    
    

