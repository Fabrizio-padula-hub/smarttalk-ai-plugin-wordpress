<?php
/*
Plugin Name: SmartTalk WP AI
Description: Un plugin per aggiungere un chatbot AI al tuo sito WordPress.
Version: 1.0
Author: Fabrizio Padula
*/

// Carica i file necessari per l'interfaccia di amministrazione
require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/chatbot-handler.php';
require_once plugin_dir_path(__FILE__) . 'public/chatbot-widget.php';

// Registra i file CSS e JS
function smarttalk_enqueue_scripts() {
    wp_enqueue_style('smarttalk-style', plugin_dir_url(__FILE__) . 'public/css/style.css');
    wp_enqueue_script('smarttalk-script', plugin_dir_url(__FILE__) . 'assets/js/chatbot.js', array('jquery'), null, true);
    wp_localize_script('smarttalk-script', 'smarttalk_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('smarttalk_nonce')
    ));
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'smarttalk_enqueue_scripts');

// Attiva il plugin
function smarttalk_activate() {
    // Codice per l'attivazione
}
register_activation_hook(__FILE__, 'smarttalk_activate');

// Disattiva il plugin
function smarttalk_deactivate() {
    // Codice per la disattivazione
}
register_deactivation_hook(__FILE__, 'smarttalk_deactivate'); 