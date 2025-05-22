<?php
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
echo '<article class="mec-util-hidden">';
get_header();
echo '</article>';
while ( have_posts() ) :
	the_post();
	the_content();
	// If comments are open or we have at least one comment, load up the comment template.
endwhile; // End of the loop.
echo '<article class="mec-util-hidden">';
get_footer();
echo '</article>';
