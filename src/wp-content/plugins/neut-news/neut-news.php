<?php
/**
 * Plugin Name: Neut News Plugin
 * Description: Displays news cards related to a post by fetching data from the nnews_crawl table.
 * Version: 1.0
 * Author: Carlo Cappai
 */

// Removed the reference to the missing template file
// require_once plugin_dir_path(__FILE__) . 'template/political_bias.php';


// Register the widget
function register_neut_news_widget() {
    register_widget( 'Neut_News_Cards_Widget' );
}
add_action( 'widgets_init', 'register_neut_news_widget' );

function neut_news_plugin_enqueue_styles() {
    wp_enqueue_style( 'news-cards-styles', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'neut_news_plugin_enqueue_styles' );

function neut_news_widget_shortcode($atts) {
    ob_start();
    the_widget('Neut_News_Cards_Widget'); // This calls the widget
    return ob_get_clean(); // Output the widget content as shortcode
}

// Register the shortcode
add_shortcode('neut_news', 'neut_news_widget_shortcode');

// Prevent direct access to the file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Neut_News_Cards_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'neut_news_cards_widget', // Base ID
            'Neut News Cards', // Name
            array( 'description' => __( 'Displays news cards for a specific post', 'text_domain' ), ) // Args
        );
    }

    // Output the content of the widget
    public function widget( $args, $instance ) {
        global $post; // Get the post ID
        $post_id = $post->ID;

        // Query to fetch data from the nnews_crawl table
        global $wpdb;
        $news_query = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT n.*, np.name AS newspaper_name, np.logo AS newspaper_logo
                 FROM nnews_crawl n
                 JOIN mod971_newspapers np ON n.newspaper_id = np.id
                 WHERE n.post_id = %d
                 ORDER BY n.n_score DESC
                 ",
                $post_id
            )
        );

        // Check if any results are found
        if ( !empty( $news_query ) ) {
            echo '<div class="news-cards-container">';

            // Loop through each row and generate the HTML for each card
            foreach ( $news_query as $news ) {
                $this->generate_news_card($news);
            }

            echo '</div>';
        } else {
            echo 'No news found for this post.';
        }
    }

    // Function to generate the HTML for each news card
    private function generate_news_card( $news ) {
        $ai_comment = json_decode($news->ai_comment, true);
        ?>
        <div class="news-card">
            <div class="newspaper-stripe">
                <div class="newspaper-info">
                    <img style="margin-bottom:0px!important" src="<?php echo esc_url($news->newspaper_logo); ?>" alt="Logo">
                    <div class="newspaper-name"><?php echo esc_html($news->newspaper_name); ?></div>
                </div>
            </div>
            <div class="news-title-row">
                <div class="news-title">
                    <?php echo esc_html($news->title); ?>
                </div>
                <div class="dropdown">
                    <button>
                        <a href="<?php echo esc_url($news->url); ?>" target="_blank" style="color:#FFF">Read</a>
                    </button>
                </div>
            </div>

            <!-- Display Scores -->
            <div class="category-scores">
                <div class="category_neut">
                    <i class="fas fa-check-double"></i> Completeness<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->completeness_score / 20)); ?>
                    </div>
                </div>
                <div class="category_neut">
                    <i class="fas fa-balance-scale"></i> Bias<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->bias_score / 20)); ?>
                    </div>
                </div>
                <div class="category_neut">
                    <i class="fas fa-language"></i> Language<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->language_score / 20)); ?>
                    </div>
                </div>
            </div>

            <!-- Overall Score -->
            <div class="total-score">
                <i class="fas fa-star"></i> NScore: <?php echo round($news->n_score); ?>/100
            </div>

            <!-- AI Comment -->
            <div class="ai-comment">
                <p><strong>Completeness:</strong> <?php echo esc_html($ai_comment['completeness']); ?></p>
                <p><strong>Bias:</strong> <?php echo esc_html($ai_comment['bias']); ?></p>
                <p><strong>Language:</strong> <?php echo esc_html($ai_comment['language']); ?></p>
            </div>
        </div>
        <?php
    }
}
