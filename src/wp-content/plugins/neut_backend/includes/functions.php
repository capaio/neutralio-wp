<?php

function calculateOverallScore($factual_accuracy, $source_credibility, $political_bias, $fact_opinion_balance) {
    // Assign weights to each factor
    $factual_accuracy_weight = 0.4;
    $political_bias_weight = 0.3;
    $fact_opinion_balance_weight = 0.25;
    $source_credibility_weight = 0.05;

    // Normalize scores from 0-100 to a 1-100 scale
    $normalized_factual_accuracy = $factual_accuracy;
    $normalized_source_credibility = $source_credibility;
    $normalized_political_bias = 100-$political_bias;
    $normalized_fact_opinion_balance = $fact_opinion_balance;

    // Calculate the weighted score for each category
    $weighted_factual_accuracy = $normalized_factual_accuracy * $factual_accuracy_weight;
    $weighted_source_credibility = $normalized_source_credibility * $source_credibility_weight;
    $weighted_political_bias = $normalized_political_bias * $political_bias_weight;
    $weighted_fact_opinion_balance = $normalized_fact_opinion_balance * $fact_opinion_balance_weight;

    // Calculate the overall score as a weighted average
    $overall_score = $weighted_factual_accuracy + $weighted_source_credibility + $weighted_political_bias + $weighted_fact_opinion_balance;

    // Round to nearest integer for readability
    return round($overall_score);
}

function fetch_news_entries() {
    global $wpdb;

    $post_id = intval($_POST['post_id']);

    // Fetch news entries for the selected post
    $news_entries = $wpdb->get_results($wpdb->prepare("
        SELECT n.*, np.name AS newspaper_name
        FROM {$wpdb->prefix}nnews n
        JOIN {$wpdb->prefix}newspapers np ON n.newspaper_id = np.id
        WHERE n.post_id = %d
    ", $post_id));

    // Generate HTML for the news entries
    if ($news_entries) {
        foreach ($news_entries as $news) {
            echo '<tr>';
            echo '<td style="text-overflow: ellipsis;">' . esc_html($news->title) . '</td>';
            echo '<td>' . esc_html($news->newspaper_name) . '</td>';
            echo '<td><a href="' . esc_url($news->link) . '" target="_blank">LINK</a></td>';
            echo '<td>' . esc_html($news->updated_at) . '</td>';
            echo '<td>';
            echo '<form method="post" style="display:inline;">';
             wp_nonce_field('my_nonce_action2', 'my_nonce2');
            echo '<input type="hidden" name="news_id" value="'.esc_attr($news->id) .'">';
            echo '<input type="submit" name="recalculate_scores" value="Ricalcola" class="button" >';
           echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4">No news entries found for this post.</td></tr>';
    }

    wp_die(); // Required to terminate the AJAX request properly
}


  function get_tweet() {
    global $wpdb;

    $post_id = intval($_POST['post_id']);

    $news_entries = $wpdb->get_results($wpdb->prepare("
            SELECT AVG(nscore) as nscore, AVG(fact_vs_opinion_score) as fact_vs_opinion_score, AVG(political_points) as political_points, count(*) as sources
            FROM {$wpdb->prefix}nnews n
            JOIN {$wpdb->prefix}newspapers np ON n.newspaper_id = np.id
            WHERE n.post_id = %d
        ", $post_id));

    //get data from news_entries
    $nscore = (int)($news_entries[0]->nscore);
    $fact = (int)($news_entries[0]->fact_vs_opinion_score);
    $opinion = 100 - $fact;
    $political_points = $news_entries[0]->political_points > 50 ? $news_entries[0]->political_points : 100 - $news_entries[0]->political_points;
    $political_points = $news_entries[0]->political_points > 50 ? ($news_entries[0]->political_points - 50 )*2: (50 - $news_entries[0]->political_points)*2;
    //$political_points = $news_entries[0]->political_points;
    $sources = $news_entries[0]->sources;
    $polbias = $news_entries[0]->political_points > 50 ? "tendente a Destra" : "tendente a Sinistra";

    //get post info
    $post = get_post($post_id);
    //the permalink
    $permalink = get_permalink($post_id);

    echo "{$post->post_title}
La nostra AI ha analizzato $sources fonti diverse sulla notizia e ha evidenziato:
📊 Posizionamento Politico: $polbias $political_points%
⚖️ Fatti vs Opinioni: {$fact}% Fatti, {$opinion}% Opinioni
⭐ N-score medio: {$nscore}/100

Compara le fonti 👉 $permalink ";
return;
}

function get_linkedin() {
    global $wpdb;

    $post_id = intval($_POST['post_id']);

    $news_entries = $wpdb->get_results($wpdb->prepare("
            SELECT AVG(nscore) as nscore, AVG(fact_vs_opinion_score) as fact_vs_opinion_score, AVG(political_points) as political_points, count(*) as sources
            FROM {$wpdb->prefix}nnews n
            JOIN {$wpdb->prefix}newspapers np ON n.newspaper_id = np.id
            WHERE n.post_id = %d
        ", $post_id));

    //get data from news_entries
    $nscore = (int)($news_entries[0]->nscore);
    $fact = (int)($news_entries[0]->fact_vs_opinion_score);
    $opinion = 100 - $fact;
    $political_points = $news_entries[0]->political_points > 50 ? $news_entries[0]->political_points : 100 - $news_entries[0]->political_points;
    $political_points = $news_entries[0]->political_points > 50 ? ($news_entries[0]->political_points - 50 )*2: (50 - $news_entries[0]->political_points)*2;
    //$political_points = $news_entries[0]->political_points;
    $sources = $news_entries[0]->sources;
    $polbias = $news_entries[0]->political_points > 50 ? "tendente a Destra" : "tendente a Sinistra";

    //get post info
    $post = get_post($post_id);
    //the permalink
    $permalink = get_permalink($post_id);

    echo "🔍 Scopri come viene affrontata la notizia \"$post->post_title\" dalla stampa.

La nostra Intelligenza Artificiale ha analizzato $sources fonti diverse sulla notizia e ha evidenziato:

📊 Posizionamento Politico: $polbias $political_points%
⚖️ Fatti vs Opinioni: Opinioni il {$fact}% delle affermazioni sono basate su fatti, mentre il {$opinion}% include opinioni o interpretazioni personali.
⭐ N-score medio: {$nscore}/100

Scopri il report gratuito completo 👉 Link al primo commento
$permalink";
return;
}

function recalculate_scores($news_id){

    global $wpdb;
    $news = $wpdb->get_results($wpdb->prepare("
        SELECT *
        FROM {$wpdb->prefix}nnews
        WHERE id = %d
    ", $news_id));

    $data = array(
        "title" => $news[0]->title,
        "factual_points" => $news[0]->factual_points,
        "political_points" => $news[0]->political_points,
        "credibility_score" => $news[0]->credibility_score,
        "fact_vs_opinion_score" => $news[0]->fact_vs_opinion_score,
        "political_biased" => $news[0]->political_biased
    );

    $new_score = calculateOverallScore(
        $data["factual_points"],
        $data["credibility_score"],
        $data["political_biased"],
        $data["fact_vs_opinion_score"]
    );

    $a = $wpdb->update(
        $wpdb->prefix . 'nnews',
        array(
            'nscore' => $new_score
        ),
        array('id' => $news_id)
    );


}


function insert_in_db($data, $post_id, $newspaper_id, $link) {
        global $wpdb; // Use the WordPress database global object
        // Insert data into the database
        $table_name = $wpdb->prefix . 'nnews'; // Ensure correct table name
        $inserted = $wpdb->insert(
            $table_name,
            array(
                'post_id' => $post_id,
                'newspaper_id' => $newspaper_id,
                'link' => $link,
                'title' => $data["title"],
                'factual_points' => $data["factual_points"],
                'political_points' => $data["political_points"],
                'credibility_score' => $data["credibility_score"],
                'fact_vs_opinion_score' => $data["fact_vs_opinion_score"],
                'political_biased' => $data["political_biased"],
                'is_abroad' => 0,
                'resume' => '',
                'nscore' => calculateOverallScore(
                    $data["factual_points"],
                    $data["credibility_score"],
                    $data["political_biased"],
                    $data["fact_vs_opinion_score"]
                ),
            )
        );

        // Check if the insert was successful
        if ($inserted) {

            update_excerpt($post_id);

            echo '<div class="updated"><p>News entry added successfully!</p></div>';
        } else {
            echo '<div class="error"><p>Failed to add news entry. Error: ' . esc_html($wpdb->last_error) . '</p></div>';
        }
}


function create_excerpt($sources, $leaning) {
    $ret =  '<p>Numero di fonti: ' . $sources . '<p>';
    $ret .=  '<div>Posizionamento politico:';
    $ret .= '<div class="bar-container political-bias-bar">
                <div class="triangle" style="left:'.$leaning.'%; border-bottom: 10px solid #FFF"></div>
            </div></div>';

    return $ret;
}

function update_excerpt($post_id){

            global $wpdb; // Use the WordPress database global object
            //get all from nnews
            $news_entries = $wpdb->get_results($wpdb->prepare("
                SELECT count(*) as sources, AVG(political_points) as leaning
                FROM {$wpdb->prefix}nnews n
                WHERE n.post_id = %d group by post_id", $post_id));
            //update post with new data


            $a = $wpdb->update(
                $wpdb->prefix . 'posts',
                array(
                    'post_excerpt' => create_excerpt($news_entries[0]->sources, $news_entries[0]->leaning)
                ),
                array('ID' => $post_id)
            );

            //_dump($a);
}


function getTweet($title, $name, $link, $politicalPoints, $oggettivita, $fact_vs_opinion_score, $ispoliticalBiased, $credibilityScore){

        $sx = 100-$politicalPoints;
        $dx = $politicalPoints;
        $political = "$sx% Sinistra, $dx% Destra";

        $opinion = 100-$fact_vs_opinion_score;
        $fact = $fact_vs_opinion_score;
        $factualvsopinion = "$fact% Fatti, $opinion% Opinioni";

        $totale = calculateOverallScore(
            $fact_vs_opinion_score,
            $credibilityScore,
            $ispoliticalBiased,
            $fact_vs_opinion_score
        );
/*
//         return "📰 L'articolo \"$title\" di $name ha ottenuto il seguente punteggio su Neutralio:
//                <br>📊 Punteggio Totale: $totale/100
//                <br>🔄 Bias Politico: $political
//                <br>🎯 Oggettività:  $oggettivita%
//                <br>⚖️ Fatti vs Opinioni: $factualvsopinion
//                <br><br> 🔗 Link: $link";
*/
        return "📰 L'articolo \"$link\" di $name ha ottenuto il seguente punteggio su Neutralio:
               <br>📊 Punteggio Totale: $totale/100
               <br>🔄 Posizionamento Politico: $political
               <br>🎯 Oggettività:  $oggettivita%
               <br>⚖️ Fatti vs Opinioni: $factualvsopinion
               <br><br> 🔗 Link: $link";
}

function getTweet2($title, $name, $link, $politicalPoints, $oggettivita, $fact_vs_opinion_score, $ispoliticalBiased, $credibilityScore){

        $sx = 100-$politicalPoints;
        $dx = $politicalPoints;
        $political = "$sx% Sinistra, $dx% Destra";

        $opinion = 100-$fact_vs_opinion_score;
        $fact = $fact_vs_opinion_score;
        $factualvsopinion = "$fact% Fatti, $opinion% Opinioni";

        $totale = calculateOverallScore(
            $fact_vs_opinion_score,
            $credibilityScore,
            $ispoliticalBiased,
            $fact_vs_opinion_score
        );

//         return "📰 L'articolo \"$title\" di $name ha ottenuto il seguente punteggio su Neutralio:
//                <br>📊 Punteggio Totale: $totale/100
//                <br>🔄 Bias Politico: $political
//                <br>🎯 Oggettività:  $oggettivita%
//                <br>⚖️ Fatti vs Opinioni: $factualvsopinion
//                <br><br> 🔗 Link: $link";
        return "📰 L'articolo $link di $name ha ottenuto il seguente punteggio su Neutralio:📊 Punteggio Totale: $totale/100🔄 Bias Politico: $political🎯 Oggettività:  $oggettivita%⚖️ Fatti vs Opinioni: $factualvsopinion";
}


