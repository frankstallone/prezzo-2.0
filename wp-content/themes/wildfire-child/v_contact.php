<?php
// Template Name: V Contact Page
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

    <div id="container-sidebar"><!-- sidebar content container -->
    <div class="content-container">

    <div id="map-contact">
        <?php echo carbon_get_the_post_meta('map'); ?>
    </div>



    <div class="container-spacing">


<?php the_content(); ?>


    <div id="contact-wrapper">
<?php echo do_shortcode('[contact-form-7 id="78" title="contatti form"]');?>
    </div><!-- close #contact-wrapper -->
    <div class="clearfix"></div>

<?php endwhile; // end of the loop. ?>


    <div class="clearfix"></div>
    </div><!-- close .content-container-spacing -->
    </div><!-- close .content-container -->

    <div class="clearfix"></div>
    </div><!-- close #container-sidebar -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>