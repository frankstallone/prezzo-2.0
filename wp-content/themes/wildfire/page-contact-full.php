<?php
// Template Name: Contact Page Full Width
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php
//If the form is submitted
if(isset($_POST['submit'])) {
	
	$comments = $_POST['message'];

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}


	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = get_post_meta($post->ID, 'contactpage_text', true); //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nComments:\n $comments";
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, get_bloginfo('name'), $body, $headers);
		$emailSent = true;
	}
}
?>

<?php while ( have_posts() ) : the_post(); ?>

</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<?php get_template_part( 'child-page', 'navigation' ); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">


	<div class="content-container">
		
		
		<?php if(get_post_meta($post->ID, 'contactpage_textarea', true)): ?>
			<div id="map-contact"></div>
			<script type="text/javascript"> 
			jQuery(document).ready(function($) {
			    $("#map-contact").goMap({ 
			        markers: [{  
			            address: '<?php echo get_post_meta($post->ID, 'contactpage_textarea', true); ?>', 
			            title: 'marker title 1' ,
						icon: '<?php echo get_template_directory_uri(); ?>/images/pin.png'
			        }],
					disableDoubleClickZoom: true,
					zoom: 12,
					maptype: 'ROADMAP'
			    }); 
			});
			</script>
		<?php endif; ?>
		
		<div class="container-spacing">
			

			<?php the_content(); ?>
			
			<?php if(get_post_meta($post->ID, 'contactpage_text', true)): ?>
			<div id="contact-wrapper">
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("#contactform").validate();
					});
				</script>
				<?php if(isset($hasError)) { //If errors are found ?>
					<p class="error"><?php _e('Please check if you have filled all the fields with valid information. Thank you.','progression'); ?></p>
				<?php } ?>

				<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
					<p class="success"><?php _e('Email Successfully Sent!','progression'); ?></p>
					<p class="success2"><?php _e('Thank you for using my contact form! I will be in touch with you soon.','progression'); ?></p>
				<?php } ?>
				<form method="post" action="<?php echo get_permalink(); ?>" id="contactform">
					<div class="contact-form-border-input">
					    <label for="name"><?php _e('Name','progression'); ?>:<span class="required">*</span></label>
						<input type="text" size="28" name="contactname" id="contactname" value="" class="required" />
					</div>
					<div class="contact-form-border-input">
						<label for="email"><?php _e('Email','progression'); ?>:<span class="required">*</span></label>
						<input type="text" size="28" name="email" id="email" value="" class="required email" />
					</div>
					<div class="contact-form-border">
						<label for="message"><?php _e('Message','progression'); ?>:</label>
						<textarea rows="10" cols="38" name="message" id="message"></textarea>
					</div>
				    <input type="submit" value="<?php _e('Send Message','progression'); ?>" name="submit" class="button" />
				</form>
			</div><!-- close #contact-wrapper -->
			<div class="clearfix"></div>
			<?php endif; ?>
			
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
			

			<?php endwhile; // end of the loop. ?>
			

<div class="clearfix"></div>
</div><!-- close .content-container-spacing -->
</div><!-- close .content-container -->

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>

<div class="clearfix"></div>

<?php get_footer(); ?>