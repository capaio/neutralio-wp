<?php

function getPostNeutMetadata($post_id){

            global $wpdb; // Use the WordPress database global object
            //get all from nnews
            $news_entries = $wpdb->get_results($wpdb->prepare("
                SELECT count(*) as sources, AVG(political_points) as leaning
                FROM {$wpdb->prefix}nnews n
                WHERE n.post_id = %d group by post_id", $post_id));
            //update post with new data


            $sources = $news_entries[0]->sources;
            $leaning = $news_entries[0]->leaning;
            return array($sources, $leaning);
}


function getNnewsFromPostId($post_id){

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

    return $news_query;

}
