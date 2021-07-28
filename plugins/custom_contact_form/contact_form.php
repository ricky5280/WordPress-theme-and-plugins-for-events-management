<?php
/*
Plugin Name: Entre-Pont Contact Form Plugin
Description: Custom Contact Form for Entre-Pont
Version: 1.0
Author: Riccardo
*/

function html_form_code() {
	echo '<form class="text-center my-5" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo 'Votre Nom * <br/>';
	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Votre Email * <br/>';
	echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Objet <br/>';
	echo '<input type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Votre Message * <br/>';
	echo '<textarea rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
	echo '</p>';
	echo '<p><input type="submit" class="btn" name="cf-submitted" value="Envoyer"></p>';
	echo '</form>';
}

function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		if(!empty ($_POST["cf-name"]) & !empty($_POST["cf-email"] )) {

		// sanitization des données saisies dans le formulaire
		$name    = sanitize_text_field( $_POST["cf-name"] );
		$email   = sanitize_email( $_POST["cf-email"] );
		$subject = sanitize_text_field( $_POST["cf-subject"] );
		$message = esc_textarea( $_POST["cf-message"] );

		// récupération de l'adresse email de l'administrateur
		$to = get_option( 'admin_email' );

		$headers = "From: $name <$email>" . "\r\n";

		// Si l'email a bien été envoyé, afficher un message de succès
		if ( wp_mail( $to, $subject, $message, $headers ) ) {
			echo '<div>';
			echo '<p>Merci pour votre message, nous vous répondrons au plus vite !</p>';
			echo '</div>';

			// redirection vers la page d'accueil
			?><script>window.location = "<?php echo home_url();?>"</script><?php
		} else {
			echo 'Erreur inattendu';
		}
	}
}

}

function cf_shortcode() {
	ob_start();
	deliver_mail();
	html_form_code();

	return ob_get_clean();
}

add_shortcode( 'entrepont_contact_form', 'cf_shortcode' );

?>
