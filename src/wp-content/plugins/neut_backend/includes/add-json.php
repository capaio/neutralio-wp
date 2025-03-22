<?php

require_once plugin_dir_path(__FILE__) . './functions.php';

function add_json() {
    global $wpdb; // Use the WordPress database global object


    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['my_nonce']) && wp_verify_nonce($_POST['my_nonce'], 'my_nonce_action')) {
        $post_id = intval($_POST['post_id']);
        $newspaper_id = intval($_POST['newspaper_id']);
        $json = str_replace('\\', '', $_POST['textfield']);
        $data = json_decode($json, true);
        $link = $_POST['link'];

        insert_in_db($data, $post_id, $newspaper_id, $link);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['my_nonce3']) && wp_verify_nonce($_POST['my_nonce3'], 'my_nonce_action3')) {
        $post_id = intval($_POST['post_id']);
        update_excerpt($post_id);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['my_nonce2']) && wp_verify_nonce($_POST['my_nonce2'], 'my_nonce_action2')) {
        recalculate_scores($_POST['news_id']);
    }

    // Retrieve the latest 20 posts
    $latest_posts = wp_get_recent_posts(array(
        'numberposts' => 10,
        'orderby' => 'date',
        /*'post_status' => 'publish',*/
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
            <label for="textfield">JSON:</label>
                <textarea cols="40" rows="5" name="textfield" id="textfield" required></textarea>

            <br><br>
            <label for="link">link:</label>
                            <input type="text" name="link" id="link" required>
            <input type="submit" value="Submit">
        </form>

        <div>
            <textarea cols="80" rows="10" name="textfield" id="tweet"></textarea>
            <textarea cols="80" rows="10" name="textfield" id="linkedin"></textarea>
            </div>

        <h2>Existing News Entries</h2>
        <div id="news-entries">
            <table class="widefat">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Newspaper</th>
                        <th>Link</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news_entries as $news): ?>
                        <tr>
                            <td><?php echo esc_html($news->title); ?></td>
                            <td><?php echo esc_html($news->newspaper_name); ?></td>
                            <td><a href="<?php echo esc_url($news->link); ?>" target="_blank">LINK</a></td>
                            <td><?php echo esc_html($news->updated_at); ?></td>
                            <td><form method="post" style="display:inline;">
                                    <?php wp_nonce_field('my_nonce_action2', 'my_nonce2'); ?>
                                    <input type="hidden" name="news_id" value="<?php echo esc_attr($news->id); ?>">
                                    <input type="submit" name="recalculate_scores" value="Ricalcola" >
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<form method="post" style="display:inline;">
    <?php wp_nonce_field('my_nonce_action3', 'my_nonce3'); ?>
    <input id="recalculate_scores" type="hidden" name="post_id" value="<?php echo esc_attr($post['ID']); ?>">
    <input type="submit" name="recalculate_scores" value="Rigenera Excerpt" >
</form>



    <script>
    jQuery(document).ready(function($) {
        // On change of post_id, fetch news entries related to the selected post
        $('#post_id').on('change', function() {
            $("#recalculate_scores").val($(this).val());
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

                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'get_tweet',
                        post_id: postId
                    },
                    success: function(response) {
                        $('#tweet').val(response);
                    }
                });

                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'get_linkedin',
                        post_id: postId
                    },
                    success: function(response) {
                        $('#linkedin').val(response);
                    }
                });

            } else {
                $('#tweet').val(''); // Clear if no post selected
            }
        });


    });

    </script>
    <?php
}

// AJAX handler to fetch news entries for the selected post
//add_action('wp_ajax_fetch_news_entries', 'fetch_news_entries');
add_action('wp_ajax_get_tweet', 'get_tweet');
add_action('wp_ajax_get_linkedin', 'get_linkedin');
