<?php
// Aggiungi voce di menu nella dashboard
function smarttalk_add_admin_menu() {
    add_menu_page(
        'SmartTalk WP AI',
        'SmartTalk AI',
        'manage_options',
        'smarttalk-wp-ai',
        'smarttalk_settings_page',
        'dashicons-format-chat',
        100
    );
}
add_action('admin_menu', 'smarttalk_add_admin_menu'); 