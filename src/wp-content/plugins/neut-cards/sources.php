<?php
/**
 * Plugin Name: Sources Head Plugin
 * Description: Sources Head Plugin
 * Version: 1.0
 * Author: Carlo Cappai
 */

require_once plugin_dir_path(__FILE__) . 'template/political_bias.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';


// Register the widget
function register_sources_head_widget() {
    register_widget( 'Source_Head_Widget' );
}
add_action( 'widgets_init', 'register_sources_head_widget' );


function sources_head_widget_shortcode($atts) {
    ob_start();
    the_widget('Source_Head_Widget'); // This calls the widget
    return ob_get_clean(); // Output the widget content as shortcode
}

// Register the shortcode
add_shortcode('sources_head', 'sources_head_widget_shortcode');

// Prevent direct access to the file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Source_Head_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sources_head_widget', // Base ID
            'Sources Head', // Name
            array( 'description' => __( 'Displays news cards for a specific post', 'text_domain' ), ) // Args
        );
    }

    // Output the content of the widget
    public function widget( $args, $instance ) {
        global $post; // Get the post ID
        $post_id = $post->ID;
        $metadata = getPostNeutMetadata($post_id);

        $this->generate_code($metadata[0]);
    }

    // Function to generate the HTML for each news card
    private function generate_code( $news ) {
        ?>
        <h4 style="color:#FFF">Fonti: <?php echo $news; ?></h4>
        <?php
    }
}


