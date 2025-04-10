<?php
// Verifica se la funzione esiste già
if (!function_exists('smarttalk_enqueue_scripts')) {
    function smarttalk_enqueue_scripts() {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
        wp_enqueue_style('smarttalk-style', plugin_dir_url(__FILE__) . 'css/style.css');
        wp_enqueue_script('smarttalk-script', plugin_dir_url(__FILE__) . '../assets/js/chatbot.js', array('jquery'), null, true);
    }
    add_action('wp_enqueue_scripts', 'smarttalk_enqueue_scripts');
}

// Widget del chatbot
function smarttalk_chatbot_widget() {
    ?>
    <div id="smarttalk-chatbot" class="smarttalk-chatbot">
        <i class="fas fa-robot"></i>
    </div>
    <div id="chat-window" class="chat-window" style="display: none;">
        <div class="chat-header">
            <h3>SmartTalk AI</h3>
            <button id="close-chat" class="close-button"><i class="fas fa-times"></i></button>
        </div>
        <div id="chat-messages" class="chat-messages"></div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Scrivi un messaggio...">
            <button id="send-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'smarttalk_chatbot_widget'); 