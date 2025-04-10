<?php
// Pagina delle impostazioni
function smarttalk_settings_page() {
    // Mostra messaggi di notifica
    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'smarttalk_messages',
            'smarttalk_message',
            'Impostazioni salvate con successo!',
            'updated'
        );
    }
    
    // Mostra eventuali errori
    settings_errors('smarttalk_messages');
    ?>
    <div class="wrap">
        <h1>Impostazioni SmartTalk WP AI</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smarttalk_options_group');
            do_settings_sections('smarttalk-wp-ai');
            submit_button('Salva Impostazioni');
            ?>
        </form>
    </div>
    <?php
}

// Registra le impostazioni
function smarttalk_register_settings() {
    register_setting('smarttalk_options_group', 'smarttalk_api_key', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ));
    
    register_setting('smarttalk_options_group', 'smarttalk_model', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'openchat/openchat'
    ));
    
    register_setting('smarttalk_options_group', 'smarttalk_enabled', array(
        'sanitize_callback' => 'absint',
        'default' => 0
    ));

    add_settings_section('smarttalk_main_section', 'Impostazioni Principali', 'smarttalk_section_callback', 'smarttalk-wp-ai');

    add_settings_field('smarttalk_api_key', 'API Key', 'smarttalk_api_key_callback', 'smarttalk-wp-ai', 'smarttalk_main_section');
    add_settings_field('smarttalk_model', 'Modello AI', 'smarttalk_model_callback', 'smarttalk-wp-ai', 'smarttalk_main_section');
    add_settings_field('smarttalk_enabled', 'Attivazione Chatbot', 'smarttalk_enabled_callback', 'smarttalk-wp-ai', 'smarttalk_main_section');
}
add_action('admin_init', 'smarttalk_register_settings');

// Callback per la sezione
function smarttalk_section_callback() {
    echo '<p>Configura le impostazioni del chatbot SmartTalk WP AI.</p>';
}

// Callback per i campi delle impostazioni
function smarttalk_api_key_callback() {
    $api_key = get_option('smarttalk_api_key');
    echo '<input type="text" name="smarttalk_api_key" value="' . esc_attr($api_key) . '" class="regular-text" />';
    echo '<p class="description">Inserisci la tua API key di OpenRouter.</p>';
}

function smarttalk_model_callback() {
    $model = get_option('smarttalk_model');
    echo '<select name="smarttalk_model" class="regular-text">';
    echo '<option value="openchat/openchat"' . selected($model, 'openchat/openchat', false) . '>openchat/openchat</option>';
    echo '<option value="mistralai/mistral-7b"' . selected($model, 'mistralai/mistral-7b', false) . '>mistralai/mistral-7b</option>';
    echo '<option value="nousresearch/nous-capybara"' . selected($model, 'nousresearch/nous-capybara', false) . '>nousresearch/nous-capybara</option>';
    echo '</select>';
    echo '<p class="description">Seleziona il modello AI da utilizzare.</p>';
}

function smarttalk_enabled_callback() {
    $enabled = get_option('smarttalk_enabled');
    echo '<input type="checkbox" name="smarttalk_enabled" value="1" ' . checked(1, $enabled, false) . ' />';
    echo '<p class="description">Attiva o disattiva il chatbot sul sito.</p>';
} 