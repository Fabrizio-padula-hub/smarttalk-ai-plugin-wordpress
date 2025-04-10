<?php
// Gestione delle richieste AJAX per il chatbot
function smarttalk_process_message() {
    // Verifica il nonce per la sicurezza
    check_ajax_referer('smarttalk_nonce', 'nonce');

    // Ottieni il messaggio dall'utente
    $message = sanitize_text_field($_POST['message']);

    // Ottieni l'API key dalle impostazioni
    $api_key = get_option('smarttalk_api_key');

    // Verifica che l'API key sia presente
    if (empty($api_key)) {
        wp_send_json_error('API key non configurata. Per favore, configura l\'API key nelle impostazioni del plugin.');
        return;
    }

    // Ottieni il contesto del sito
    $site_context = get_site_context();

    // Prepara i dati per la richiesta all'API
    $data = array(
        'model' => 'openai/gpt-3.5-turbo',
        'messages' => array(
            array(
                'role' => 'system',
                'content' => 'Sei un assistente virtuale per un sito web. Ecco le informazioni sul sito: ' . $site_context . 
                            ' Usa queste informazioni per rispondere alle domande degli utenti in modo preciso e utile.'
            ),
            array(
                'role' => 'user',
                'content' => $message
            )
        ),
        'temperature' => 0.7,
        'max_tokens' => 150
    );

    // Invia la richiesta all'API di OpenRouter
    $response = wp_remote_post('https://openrouter.ai/api/v1/chat/completions', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
            'HTTP-Referer' => get_site_url(),
            'X-Title' => 'SmartTalk WP AI'
        ),
        'body' => json_encode($data),
        'timeout' => 30
    ));

    // Gestisci la risposta
    if (is_wp_error($response)) {
        wp_send_json_error('Errore di connessione: ' . $response->get_error_message());
        return;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    $response_code = wp_remote_retrieve_response_code($response);

    if ($response_code !== 200) {
        wp_send_json_error('Errore API (codice ' . $response_code . '): ' . 
            (isset($body['error']['message']) ? $body['error']['message'] : 'Errore sconosciuto'));
        return;
    }

    if (isset($body['error'])) {
        wp_send_json_error('Errore API: ' . $body['error']['message']);
        return;
    }

    if (!isset($body['choices'][0]['message']['content'])) {
        wp_send_json_error('Risposta API non valida: struttura dati mancante');
        return;
    }

    wp_send_json_success($body);
}

// Funzione per ottenere il contesto del sito
function get_site_context() {
    $context = "Informazioni sul sito:\n";
    
    // Informazioni generali del sito
    $context .= "Nome del sito: " . get_bloginfo('name') . "\n";
    $context .= "Descrizione: " . get_bloginfo('description') . "\n";
    $context .= "URL: " . get_site_url() . "\n";
    
    // Pagine del sito
    $pages = get_pages();
    $context .= "\nPagine del sito:\n";
    foreach ($pages as $page) {
        $context .= "- " . $page->post_title . " (" . get_permalink($page->ID) . ")\n";
        // Aggiungi il contenuto della pagina se è una pagina importante
        if (in_array($page->post_name, array('contatti', 'chi-siamo', 'servizi'))) {
            $context .= "  Contenuto: " . wp_strip_all_tags($page->post_content) . "\n";
        }
    }
    
    // Post recenti
    $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
    if (!empty($recent_posts)) {
        $context .= "\nPost recenti:\n";
        foreach ($recent_posts as $post) {
            $context .= "- " . $post['post_title'] . " (" . get_permalink($post['ID']) . ")\n";
        }
    }
    
    return $context;
}

add_action('wp_ajax_smarttalk_process_message', 'smarttalk_process_message');
add_action('wp_ajax_nopriv_smarttalk_process_message', 'smarttalk_process_message'); 