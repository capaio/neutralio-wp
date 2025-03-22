<?php
/*
Plugin Name: Neut backend
Description: Neutralio backend
Version: 1.0
Author: Carlo Cappai
*/

add_action('admin_menu', 'my_custom_plugin_menu');
function my_custom_plugin_menu() {
    add_menu_page('Neutralio backend', 'Add News', 'manage_options', 'neut-backend-plugin', 'add_news');
    add_submenu_page('neut-backend-plugin', 'Add newspaper', 'Add newspaper', 'manage_options', 'add-newspaper', 'add_newspaper');
    add_submenu_page('neut-backend-plugin', 'Add News JSON', 'Add News JSON', 'manage_options', 'add-news-json', 'add_json');
}

add_action('admin_enqueue_scripts', 'my_custom_plugin_enqueue_media');
function my_custom_plugin_enqueue_media() {
    wp_enqueue_media();
}

require_once plugin_dir_path(__FILE__) . 'includes/add-news.php';
require_once plugin_dir_path(__FILE__) . 'includes/add-newspaper.php';
require_once plugin_dir_path(__FILE__) . 'includes/add-json.php';



