/**
 * WhatsApp Float Button JavaScript
 * Adiciona funcionalidade ao botão flutuante do WhatsApp
 */

(function($) {
    'use strict';

    // Aguarda o DOM estar pronto
    $(document).ready(function() {
        initWhatsAppFloat();
    });

    function initWhatsAppFloat() {
        const $whatsappButton = $('#whatsapp-float-button');
        
        if (!$whatsappButton.length) {
            return;
        }

        // Adiciona atributos de acessibilidade
        $whatsappButton.attr({
            'role': 'button',
            'tabindex': '0',
            'aria-label': 'Abrir WhatsApp para conversa'
        });

        // Evento de clique
        $whatsappButton.on('click', function(e) {
            e.preventDefault();
            openWhatsApp();
        });

        // Suporte para navegação por teclado
        $whatsappButton.on('keydown', function(e) {
            // Enter ou Space
            if (e.keyCode === 13 || e.keyCode === 32) {
                e.preventDefault();
                openWhatsApp();
            }
        });

        // Adiciona animação de entrada
        setTimeout(function() {
            $whatsappButton.addClass('whatsapp-float-visible');
        }, 500);

        // Detecta se usuário está inativo e adiciona pulso extra
        let inactiveTimer;
        
        function resetInactiveTimer() {
            clearTimeout(inactiveTimer);
            $whatsappButton.removeClass('whatsapp-pulse-attention');
            
            inactiveTimer = setTimeout(function() {
                $whatsappButton.addClass('whatsapp-pulse-attention');
            }, 30000); // 30 segundos de inatividade
        }

        // Reset timer em vários eventos
        $(document).on('mousemove keydown scroll touchstart', resetInactiveTimer);
        resetInactiveTimer();
    }

    function openWhatsApp() {
        if (typeof whatsappFloat === 'undefined') {
            console.error('WhatsApp Float: Configurações não encontradas');
            return;
        }

        const number = whatsappFloat.number;
        const message = whatsappFloat.message || '';

        if (!number) {
            console.error('WhatsApp Float: Número não configurado');
            return;
        }

        // Remove caracteres especiais do número
        const cleanNumber = number.replace(/\D/g, '');

        // Constrói a URL do WhatsApp
        let whatsappUrl;
        const encodedMessage = encodeURIComponent(message);

        // Detecta se é mobile para usar a URL apropriada
        if (isMobileDevice()) {
            whatsappUrl = `whatsapp://send?phone=${cleanNumber}`;
            if (message) {
                whatsappUrl += `&text=${encodedMessage}`;
            }
        } else {
            whatsappUrl = `https://web.whatsapp.com/send?phone=${cleanNumber}`;
            if (message) {
                whatsappUrl += `&text=${encodedMessage}`;
            }
        }

        // Animação de clique
        const $button = $('#whatsapp-float-button');
        $button.addClass('whatsapp-clicked');
        
        setTimeout(function() {
            $button.removeClass('whatsapp-clicked');
        }, 200);

        // Abre o WhatsApp
        const whatsappWindow = window.open(whatsappUrl, '_blank');

        // Analytics (se Google Analytics estiver disponível)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'click', {
                'event_category': 'WhatsApp Float',
                'event_label': 'WhatsApp Button Click'
            });
        } else if (typeof ga !== 'undefined') {
            ga('send', 'event', 'WhatsApp Float', 'click', 'WhatsApp Button Click');
        }

        // Facebook Pixel (se disponível)
        if (typeof fbq !== 'undefined') {
            fbq('track', 'Contact', {
                'content_name': 'WhatsApp Float Button',
                'content_category': 'Contact'
            });
        }

        // Fallback para mobile se não conseguir abrir o app
        if (isMobileDevice()) {
            setTimeout(function() {
                if (whatsappWindow && whatsappWindow.closed) {
                    // Se a janela foi fechada rapidamente, pode ser que o app não esteja instalado
                    // Tenta abrir no navegador
                    window.open(`https://api.whatsapp.com/send?phone=${cleanNumber}&text=${encodedMessage}`, '_blank');
                }
            }, 1000);
        }
    }

    function isMobileDevice() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    // Estilos adicionais via JavaScript para animações específicas
    function addDynamicStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .whatsapp-float-visible {
                animation: whatsapp-slide-in 0.5s ease-out forwards;
            }
            
            @keyframes whatsapp-slide-in {
                from {
                    transform: translateX(100px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            .whatsapp-clicked {
                animation: whatsapp-click 0.2s ease-out;
            }
            
            @keyframes whatsapp-click {
                0% { transform: scale(1); }
                50% { transform: scale(0.9); }
                100% { transform: scale(1); }
            }
            
            .whatsapp-pulse-attention::before {
                animation: whatsapp-pulse-attention 1s infinite;
            }
            
            @keyframes whatsapp-pulse-attention {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                50% {
                    transform: scale(1.3);
                    opacity: 0.5;
                }
                100% {
                    transform: scale(1.6);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Adiciona estilos dinâmicos quando o DOM estiver pronto
    $(document).ready(addDynamicStyles);

})(jQuery);