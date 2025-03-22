<?php

require_once plugin_dir_path(__FILE__) . '../openai/openai.php';
require_once plugin_dir_path(__FILE__) . './functions.php';

function add_news() {
    global $wpdb; // Use the WordPress database global object

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['my_nonce2']) && wp_verify_nonce($_POST['my_nonce2'], 'my_nonce_action2')) {
        // Handle the recalculation of scores
        if (isset($_POST['recalculate_scores'])) {
            $news_id = intval($_POST['news_id']);

            // Call a function to recalculate scores
            $news_entry = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}nnews WHERE id = %d", $news_id));

            $openai_response = json_decode(call_openai_api($news_entry->link), true);

            if($openai_response && $openai_response["title"]) {
                $resp = $wpdb->update(
                    "{$wpdb->prefix}nnews",
                    array(
                        'title' => $openai_response["title"],
                        'factual_points' => $openai_response["factual_points"],
                        'political_points' => $openai_response["political_points"],
                        'credibility_score' => $openai_response["credibility_score"],
                        'fact_vs_opinion_score' => $openai_response["fact_vs_opinion_score"],
                        'is_abroad' => 0,
                        'resume' => '',
                        'nscore' => calculateOverallScore(
                            $openai_response["factual_points"],
                            $openai_response["credibility_score"],
                            $openai_response["political_biased"],
                            $openai_response["fact_vs_opinion_score"]
                        ),
                    ),
                    array('id' => $news_entry->id)
                );
                var_dump($resp);
            } else {
                  echo '<div class="error"><p>No response from ai: '.var_dump($openai_response).'</p></div>';
              }
        }
    }


    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['my_nonce']) && wp_verify_nonce($_POST['my_nonce'], 'my_nonce_action')) {
        $post_id = intval($_POST['post_id']);
        $newspaper_id = intval($_POST['newspaper_id']);
        $link = sanitize_text_field($_POST['textfield']);

        $openai_response = json_decode(call_openai_api($link), true);
        insert_in_db($openai_response, $post_id, $newspaper_id, $link);
    }

    // Retrieve the latest 20 posts
    $latest_posts = wp_get_recent_posts(array(
        'numberposts' => 20,
        'orderby' => 'date',
        'post_status' => 'publish',
        'order' => 'DESC',
    ));

    // Retrieve newspapers for selection
    $newspapers = $wpdb->get_results("SELECT id, name FROM {$wpdb->prefix}newspapers");

    // Initial empty news entries
    $news_entries = [];

    ?>
    <div class="wrap">
        <h1>News</h1>
        <form method="post">
            <?php wp_nonce_field('my_nonce_action', 'my_nonce'); ?>
            <label for="post_id">Select a post:</label>
            <select name="post_id" id="post_id" required>
                <option value="">-- Select a Post --</option>
                <?php foreach ($latest_posts as $post): ?>
                    <option value="<?php echo esc_attr($post['ID']); ?>"><?php echo esc_html($post['post_title']); ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <label for="newspaper_id">Select a newspaper:</label>
            <select name="newspaper_id" id="newspaper_id" required>
                <?php foreach ($newspapers as $newspaper): ?>
                    <option value="<?php echo esc_attr($newspaper->id); ?>"><?php echo esc_html($newspaper->name); ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <label for="textfield">Link:</label>
            <input type="text" name="textfield" id="textfield" required>
            <br><br>
            <input type="submit" value="Submit">
        </form>

        <h2>Existing News Entries</h2>
        <div id="news-entries">
            <table class="widefat">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Newspaper</th>
                        <th>Link</th>
                        <th>Updated At</th>
                        <th>Recalculate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news_entries as $news): ?>
                        <tr>
                            <td><?php echo esc_html($news->title); ?></td>
                            <td><?php echo esc_html($news->newspaper_name); ?></td>
                            <td><a href="<?php echo esc_url($news->link); ?>" target="_blank"><?php echo esc_html($news->link); ?></a></td>
                            <td><?php echo esc_html($news->updated_at); ?></td>
                            <td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // On change of post_id, fetch news entries related to the selected post
        $('#post_id').on('change', function() {
            var postId = $(this).val();
            if (postId) {
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'fetch_news_entries',
                        post_id: postId
                    },
                    success: function(response) {
                        $('#news-entries tbody').html(response);
                    }
                });
            } else {
                $('#news-entries tbody').html(''); // Clear if no post selected
            }
        });
    });
    </script>
    <?php
}

// AJAX handler to fetch news entries for the selected post
add_action('wp_ajax_fetch_news_entries', 'fetch_news_entries');




