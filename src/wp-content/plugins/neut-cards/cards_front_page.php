<?php
/**
 * Plugin Name: Cards Frontpage
 * Description: Cards Frontpage
 * Version: 1.0
 * Author: Carlo Cappai
 */

require_once plugin_dir_path(__FILE__) . 'template/frontpagecards.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';


// Register the widget
function cards_front_page_widget() {
    register_widget( 'Cards_Front_Page_Widget' );
}
add_action( 'widgets_init', 'cards_front_page_widget' );


function front_page_cards_widget_shortcode($atts) {
    ob_start();
    the_widget('Cards_Front_Page_Widget'); // This calls the widget
    return ob_get_clean(); // Output the widget content as shortcode
}

// Register the shortcode
add_shortcode('cards_front_page', 'front_page_cards_widget_shortcode');

// Prevent direct access to the file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Cards_Front_Page_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'cards_frontpage', // Base ID
            'Cards Front Page', // Name
            array( 'description' => __( 'Displays news cards for a specific post', 'text_domain' ), ) // Args
        );
    }

    public function widget( $args, $instance ) {
            $category_slug = 'prima'; // Replace 'news' with your specific category slug or ID

            $args = array(
                'post_type' => 'post', // Specify the post type (in this case, 'post')
                'category_name' => $category_slug, // Retrieve posts from this category (use category slug)
                'posts_per_page' => 1, // Number of posts to retrieve (adjust as needed)
                'orderby' => 'date', // Order by post date
                'order' => 'DESC', // Get the most recent posts
            );

            $query = new WP_Query( $args );
            //get id of the post


            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $post_id = get_the_ID();
                    $nnews = getNnewsFromPostId($post_id);
                    // Output the post title and a link to the post
                    $post_link = get_permalink($post_id);
                    $this->generate_code($nnews,$post_link);
                    //getting post link


                }
                wp_reset_postdata(); // Reset the global $post object to avoid conflicts
            } else {
                // No posts found
                echo 'No posts found in this category.';
            }
        }

        // Function to generate the HTML for each news card
        private function generate_code( $nnews,$post_link ) {
            getFrontpageNnews($nnews,$post_link);
        }
}


