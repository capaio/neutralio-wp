<?php
/**
 * Plugin Name: Neut Cards Plugin
 * Description: Displays news cards related to a post by fetching data from custom tables.
 * Version: 1.0
 * Author: Carlo Cappai
 */

require_once plugin_dir_path(__FILE__) . 'template/political_bias.php';


// Register the widget
function register_news_cards_widget() {
    register_widget( 'News_Cards_Widget' );
}
add_action( 'widgets_init', 'register_news_cards_widget' );

function news_cards_plugin_enqueue_styles() {
    wp_enqueue_style( 'news-cards-styles', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'news_cards_plugin_enqueue_styles' );

function news_cards_widget_shortcode($atts) {
    ob_start();
    the_widget('News_Cards_Widget'); // This calls the widget
    return ob_get_clean(); // Output the widget content as shortcode
}

// Register the shortcode
add_shortcode('news_cards', 'news_cards_widget_shortcode');

// Prevent direct access to the file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class News_Cards_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'news_cards_widget', // Base ID
            'News Cards', // Name
            array( 'description' => __( 'Displays news cards for a specific post', 'text_domain' ), ) // Args
        );
    }

    // Output the content of the widget
    public function widget( $args, $instance ) {
        global $post; // Get the post ID
        $post_id = $post->ID;

        // Query to fetch data from the two tables joined by newspaper_id
        global $wpdb;
        $news_query = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT n.*, np.name AS newspaper_name, np.logo AS newspaper_logo
                 FROM mod971_nnews n
                 JOIN mod971_newspapers np ON n.newspaper_id = np.id
                 WHERE n.post_id = %d
                 ORDER BY n.nscore DESC
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
                <!-- Dropdown Button for Read, Summary, Translate -->
                <div class="dropdown">
                    <button>
                        <a href="<?php echo esc_url($news->link); ?>" target="_blank" style="color:#FFF">Leggi</a>
                        </button>
<!--                     <div class="dropdown-content">
                        <a href="<?php echo esc_url($news->link); ?>">Leggi</a>
                        <a href="#">Sommario IA</a>
                        <a href="#">Traduzione</a>
                    </div> -->
                </div>
            </div>

            <!-- Display Scores -->
            <div class="category-scores">
                <div class="category_neut">
                    <i class="fas fa-check-double"></i> Accuratezza<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->factual_points / 20)); ?>
                    </div>
                </div>
                <div class="category_neut">
                    <i class="fas fa-balance-scale"></i> Opinioni o Fatti<br>
                    <div class="bar-container fact-opinion-bar">
                        <div class="triangle" style="left:<?php echo $news->fact_vs_opinion_score; ?>%;"></div>
                    </div>
                </div>
                <div class="category_neut">
                    <?php get_political_bias($news->political_points); ?>
                </div>
                <div class="category_neut">
                    <i class="fas fa-shield-alt"></i> Credibilità<br>
                    <div class="stars">
                        <?php echo str_repeat('<i class="fas fa-star"></i>', round($news->credibility_score / 20)); ?>
                    </div>
                </div>
            </div>

            <!-- Overall Score -->
            <div class="total-score">
                <i class="fas fa-star"></i> NScore: <?php echo round($news->nscore); ?>/100
                <span class="score-info-icon" tabindex="0"> <!-- Question mark icon -->
                        <i class="fas fa-question-circle"></i>
                    </span>

                    <!-- Tooltip popup content -->
                    <div class="popup-content">
                        NScore è il punteggio che Neutralio assegna a ciascuna notizia. Esso è calcolato sulla base di un algoritmo proprietario. Tra i fattori tenuti in considerazione ci sono accuratezza, obiettività, bias politico (a prescindere se destra o sinistra) e credibilità. NScore varia da 0 a 100, dove 0 rappresenta la notizia meno affidabile e 100 la più affidabile.
                    </div>
            </div>
        </div>
        <?php
    }
}


