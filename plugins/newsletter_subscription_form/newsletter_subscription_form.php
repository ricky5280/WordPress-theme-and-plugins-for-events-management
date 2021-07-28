<?php
/*
Plugin Name: Entre-Pont Newsletter Subcription Form
Description: Custom Newsletter Subscription Form 
Version: 1.0
Author: Riccardo
*/

function html_nwform_code() {
	echo '<form class="text-center my-5" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo 'Votre Nom * <br/>';
	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Votre Email * <br/>';
	echo '<input type="email" name="cf-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p><input class="btn" type="submit" name="cf-submitted" value="Je m\'inscris !"></p>';
	echo '</form>';
}

function record_database() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		if(!empty ($_POST["cf-name"]) & !empty($_POST["cf-email"] )) {

			// sanitize form values
			$name    = sanitize_text_field( $_POST["cf-name"] );
			$email   = sanitize_email( $_POST["cf-email"] );

			global $wpdb;		
			
				$data = array(
					'name' => $name,
					'email' => $email,
				);
			
				$table_name = $wpdb->prefix . 'newsletter';
			
				$result = $wpdb->insert($table_name, $data, $format=NULL);
			
				if ($result == 1) {
					echo "<script>alert('Inscription bien effectuée'); </script>"; 

					// redirection vers la page d'accueil
					?><script>window.location = "<?php echo home_url();?>"</script><?php

				} else {
					echo "<script>alert('Enregistrement non effectué'); </script>"; 
				}  							
			}	else { 
			echo 'Merci de remplir tous les champs';

	}

}
	
	
}



function newsform_shortcode() {
	ob_start();
	
	html_nwform_code();

    record_database();

	return ob_get_clean();
}

add_shortcode( 'entrepont_newsletter_form', 'newsform_shortcode' );

?>
