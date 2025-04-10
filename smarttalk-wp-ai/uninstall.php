<?php
// Se non è stato chiamato da WordPress, esci
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Rimuovi le opzioni del plugin
delete_option('smarttalk_api_key');
delete_option('smarttalk_enabled');

// Rimuovi i dati transitori
delete_transient('smarttalk_last_error');

// Rimuovi i dati della cache
wp_cache_flush(); 