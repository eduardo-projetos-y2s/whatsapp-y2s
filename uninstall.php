<?php
/**
 * WhatsApp Float Plugin Uninstall
 * 
 * Remove todas as configurações do plugin quando ele for desinstalado
 */

// Previne acesso direto
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove todas as opções do plugin
delete_option('whatsapp_float_number');
delete_option('whatsapp_float_message');
delete_option('whatsapp_float_enabled');

// Remove opções de sites em rede (multisite)
delete_site_option('whatsapp_float_number');
delete_site_option('whatsapp_float_message');
delete_site_option('whatsapp_float_enabled');

// Limpa cache de opções
wp_cache_flush();