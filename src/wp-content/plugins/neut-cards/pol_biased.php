<?php
/**
 * Plugin Name: Political bias widget
 * Description: Political bias widget
 * Version: 1.0
 * Author: Carlo Cappai
 */

require_once plugin_dir_path(__FILE__) . 'template/political_bias.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';


// Register the widget
function register_political_bias_widget() {
    register_widget( 'Political_Bias_Widget' );
}
add_action( 'widgets_init', 'register_political_bias_widget' );


function political_bias_widget_shortcode($atts) {
    ob_start();
    the_widget('Political_Bias_Widget'); // This calls the widget
    return ob_get_clean(); // Output the widget content as shortcode
}

// Register the shortcode
add_shortcode('political_bias', 'political_bias_widget_shortcode');

// Prevent direct access to the file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Political_Bias_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'political_bias_widget', // Base ID
            'Political Bias', // Name
            array( 'description' => __( 'Displays news cards for a specific post', 'text_domain' ), ) // Args
        );
    }

    // Output the content of the widget
    public function widget( $args, $instance ) {
        global $post; // Get the post ID
        $post_id = $post->ID;
        $metadata = getPostNeutMetadata($post_id);

        $this->generate_code($metadata[1]);
    }

    // Function to generate the HTML for each news card
    private function generate_code( $news ) {
        get_political_bias_big($news);
    }
}


