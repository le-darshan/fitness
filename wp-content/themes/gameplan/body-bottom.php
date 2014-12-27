<?php if(is_active_sidebar('body_bottom')){?>

<div id="body-bottom">
	<div class="container">
    	<div class="container-pad">
            <div class="row-fluid">
			   <?php
			 	
				  
					 if(is_page( array( 3121) ))
					 {
					 	/*if(is_page(array(4862))){
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Diet Program') ) {}
						}*/
					  if ( is_user_logged_in() ) {
				 		 
						 } else {
						  echo get_dynamic_sidebar('body_bottom');
						  }
				      
					 } 
					 else if(is_page(array(4783 , 4862 )))
					 {
					 	
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Traning Programs') ) {}
						 if ( is_user_logged_in() ) {
				 		 
						 } else {
						echo get_dynamic_sidebar('body_bottom');
						}
						
					 }
				 
					?>
            </div>
        </div>
	</div>
</div>
<?php }?>