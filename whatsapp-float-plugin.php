<?php
/**
 * Plugin Name: WhatsApp Float Button
 * Plugin URI: https://github.com/seu-usuario/whatsapp-float-plugin
 * Description: Adiciona um botão flutuante do WhatsApp no canto inferior direito do site com configurações personalizáveis.
 * Version: 1.0.0
 * Author: Seu Nome
 * License: GPL v2 or later
 * Text Domain: whatsapp-float
 */

// Previne acesso direto
if (!defined('ABSPATH')) {
    exit;
}

// Define constantes do plugin
define('WHATSAPP_FLOAT_VERSION', '1.0.0');
define('WHATSAPP_FLOAT_PATH', plugin_dir_path(__FILE__));
define('WHATSAPP_FLOAT_URL', plugin_dir_url(__FILE__));

class WhatsAppFloatPlugin {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'add_whatsapp_button'));
        
        // Hook de ativação para definir valores padrão
        register_activation_hook(__FILE__, array($this, 'activate'));
    }
    
    public function init() {
        load_plugin_textdomain('whatsapp-float', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    public function activate() {
        // Define valores padrão na ativação
        if (!get_option('whatsapp_float_number')) {
            update_option('whatsapp_float_number', '5511999999999');
        }
        if (!get_option('whatsapp_float_message')) {
            update_option('whatsapp_float_message', 'Olá! Gostaria de mais informações.');
        }
        if (!get_option('whatsapp_float_enabled')) {
            update_option('whatsapp_float_enabled', '1');
        }
    }
    
    public function add_admin_menu() {
        add_options_page(
            'Configurações WhatsApp Float',
            'WhatsApp Float',
            'manage_options',
            'whatsapp-float',
            array($this, 'admin_page')
        );
    }
    
    public function admin_init() {
        register_setting('whatsapp_float_settings', 'whatsapp_float_number');
        register_setting('whatsapp_float_settings', 'whatsapp_float_message');
        register_setting('whatsapp_float_settings', 'whatsapp_float_enabled');
        
        add_settings_section(
            'whatsapp_float_section',
            'Configurações do WhatsApp',
            array($this, 'section_callback'),
            'whatsapp_float_settings'
        );
        
        add_settings_field(
            'whatsapp_float_enabled',
            'Habilitar WhatsApp Float',
            array($this, 'enabled_callback'),
            'whatsapp_float_settings',
            'whatsapp_float_section'
        );
        
        add_settings_field(
            'whatsapp_float_number',
            'Número do WhatsApp',
            array($this, 'number_callback'),
            'whatsapp_float_settings',
            'whatsapp_float_section'
        );
        
        add_settings_field(
            'whatsapp_float_message',
            'Mensagem Inicial (Opcional)',
            array($this, 'message_callback'),
            'whatsapp_float_settings',
            'whatsapp_float_section'
        );
    }
    
    public function section_callback() {
        echo '<p>Configure as opções do botão flutuante do WhatsApp.</p>';
    }
    
    public function enabled_callback() {
        $enabled = get_option('whatsapp_float_enabled', '1');
        echo '<input type="checkbox" name="whatsapp_float_enabled" value="1" ' . checked(1, $enabled, false) . ' />';
        echo '<label for="whatsapp_float_enabled"> Exibir botão do WhatsApp no site</label>';
    }
    
    public function number_callback() {
        $number = get_option('whatsapp_float_number', '');
        echo '<input type="text" name="whatsapp_float_number" value="' . esc_attr($number) . '" class="regular-text" />';
        echo '<p class="description">Digite o número com código do país (ex: 5511999999999)</p>';
    }
    
    public function message_callback() {
        $message = get_option('whatsapp_float_message', '');
        echo '<textarea name="whatsapp_float_message" rows="3" cols="50" class="large-text">' . esc_textarea($message) . '</textarea>';
        echo '<p class="description">Mensagem que será enviada automaticamente quando o usuário clicar no botão (opcional)</p>';
    }
    
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Configurações WhatsApp Float</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('whatsapp_float_settings');
                do_settings_sections('whatsapp_float_settings');
                submit_button();
                ?>
            </form>
            
            <div style="margin-top: 30px; padding: 20px; background: #f9f9f9; border-left: 4px solid #00a884;">
                <h3>Preview do Botão</h3>
                <p>O botão aparecerá no canto inferior direito do seu site, assim:</p>
                <div style="position: relative; width: 200px; height: 100px; background: #e0e0e0; border: 1px dashed #ccc;">
                    <div style="position: absolute; bottom: 10px; right: 10px; width: 60px; height: 60px; background: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                        <svg style="width: 35px; height: 35px; fill: white;" viewBox="0 0 24 24">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2M8.53 7.33c.16 0 .31 0 .45.01.14.01.32-.05.5.39.18.44.61 1.61.67 1.73.05.12.09.26.02.42-.07.16-.11.26-.21.4-.1.14-.21.32-.3.43-.1.14-.21.28-.09.55.12.27.53 1.06 1.27 1.72.96.84 1.72 1.1 1.98 1.23.26.13.42.11.57-.07.15-.18.64-.74.81-.99.17-.25.35-.21.59-.13.24.08 1.54.73 1.81.86.26.13.44.19.5.3.07.11.07.64-.14 1.25-.22.61-1.24 1.13-1.79 1.13-.47.01-.96-.09-1.64-.42-2.84-1.38-4.72-4.27-4.86-4.47-.14-.2-.98-1.18-.98-2.26 0-1.08.62-1.61.84-1.84.22-.23.48-.29.64-.29"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function enqueue_scripts() {
        if (get_option('whatsapp_float_enabled', '1')) {
            wp_enqueue_style(
                'whatsapp-float-style',
                WHATSAPP_FLOAT_URL . 'assets/whatsapp-float.css',
                array(),
                WHATSAPP_FLOAT_VERSION
            );
            
            wp_enqueue_script(
                'whatsapp-float-script',
                WHATSAPP_FLOAT_URL . 'assets/whatsapp-float.js',
                array('jquery'),
                WHATSAPP_FLOAT_VERSION,
                true
            );
            
            // Passa variáveis para JavaScript
            wp_localize_script('whatsapp-float-script', 'whatsappFloat', array(
                'number' => get_option('whatsapp_float_number', ''),
                'message' => get_option('whatsapp_float_message', '')
            ));
        }
    }
    
    public function add_whatsapp_button() {
        if (get_option('whatsapp_float_enabled', '1') && get_option('whatsapp_float_number')) {
            ?>
            <div id="whatsapp-float-button" class="whatsapp-float">
                <div class="whatsapp-float-tooltip">
                    Fale conosco no WhatsApp
                </div>
                <svg class="whatsapp-float-icon" viewBox="0 0 24 24" width="35" height="35">
                    <path fill="white" d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2M8.53 7.33c.16 0 .31 0 .45.01.14.01.32-.05.5.39.18.44.61 1.61.67 1.73.05.12.09.26.02.42-.07.16-.11.26-.21.4-.1.14-.21.32-.3.43-.1.14-.21.28-.09.55.12.27.53 1.06 1.27 1.72.96.84 1.72 1.1 1.98 1.23.26.13.42.11.57-.07.15-.18.64-.74.81-.99.17-.25.35-.21.59-.13.24.08 1.54.73 1.81.86.26.13.44.19.5.3.07.11.07.64-.14 1.25-.22.61-1.24 1.13-1.79 1.13-.47.01-.96-.09-1.64-.42-2.84-1.38-4.72-4.27-4.86-4.47-.14-.2-.98-1.18-.98-2.26 0-1.08.62-1.61.84-1.84.22-.23.48-.29.64-.29"/>
                </svg>
            </div>
            <?php
        }
    }
}

// Inicializa o plugin
new WhatsAppFloatPlugin();