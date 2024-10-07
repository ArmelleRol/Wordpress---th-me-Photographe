<footer>
      <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-sm-6 col-lg-12 col-xl-12">
                  <div class="d-flex justify-content-center">
                        <?php if(is_active_sidebar('widgetized-footer')): ?>

                              <?php dynamic_sidebar('widgetized-footer'); ?>

                        <?php else:
                        //sidebar s'affiche sinon texte  ?>


                              <div class="col-xs-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur
                                     adipisicing elit. Unde accusantium enim dolorum nemo at sint provident, 
                                     totam asperiores eveniet animi, maxime aliquam. Sunt optio tenetur 
                                     assumenda. Harum, error earum autem porro,</p>
                                    <p>illum doloremque expedita 
                                     quas repellendus fugiat nemo eos, voluptatibus aspernatur mollitia 
                                     est iste excepturi neque doloribus officiis esse quod laudantium 
                                     cupiditate. Esse, iure voluptatum quos aliquam error quia voluptates
                                      sed doloribus facilis tempora commodi</p>
                                    <p>explicabo fuga officiis 
                                      maiores dignissimos laboriosam voluptatem culpa distinctio vel 
                                      quasi beatae. Accusantium molestias repellendus debitis, 
                                      illum veniam, distinctio beatae quibusdam, illo ipsam commodi 
                                      sunt suscipit, nisi reiciendis cumque eum quis iure dolorum laborum dolore2!</p>
                              </div>

                               <?php endif; ?>  
                        </div>            
                   </div>
            </div>
      </div>      
 </footer>

<?php wp_footer();

if (isset($_SESSION['contact-result']) && !is_page('contact')): 
      unset($_SESSION['contact-result']);
endif;


  ?> 

</body>
</html>