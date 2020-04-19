<?php /* Template Name: Gallery */ ?>
<?php get_header();?>

    <div class="cotainer-fluid">
        <div class="row hero">
            <img src="<?php bloginfo('template_directory');?>/images/gallery-hero.jpg" class="img-fluid">
            <div class="hero-title">
                <h1 class="hero-title-text">GALLERY<h1>
            </div>
        </div>

        <div class="row logo-sm">
            <div class="col-12">
                <img src="<?php bloginfo('template_directory');?>/images/small-logo.jpg" class="img-fluid">
            </div>
        </div>

        <div class="row gallery">
            <div class="col-12 col-lg-6 offset-lg-3">
                <?php
                    // checks if there are any posts that match the query
                    if (have_posts()) :
                    
                    // If there are posts matching the query then start the loop
                    while ( have_posts() ) : the_post();
                        ?>
                        <?php the_content(); ?>                    
                        <?php
                        // Stop the loop when all posts are displayed
                    endwhile;
                    // If no posts were found
                    else :
                    ?>
                    <p>Sorry no posts matched your criteria.</p>
                    <?php
                    endif;
                    ?>
            </div>
            
        </div>

<?php get_footer();?>
    

    