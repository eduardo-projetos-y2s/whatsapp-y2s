# WhatsApp Float Button Plugin

Um plugin WordPress que adiciona um botão flutuante do WhatsApp no canto inferior direito do seu site, permitindo que os visitantes entrem em contato diretamente via WhatsApp.

## 🚀 Características

- **Botão flutuante fixo** no canto inferior direito
- **Logo original do WhatsApp** em SVG com cores oficiais
- **Posicionamento responsivo** (5vw da direita, 5vh do fundo)
- **Configuração de número** do WhatsApp via painel admin
- **Mensagem inicial personalizável** (opcional)
- **Tooltip informativo** ao passar o mouse
- **Animações suaves** e efeitos visuais
- **Compatível com mobile e desktop**
- **Acessibilidade** com suporte a navegação por teclado
- **Integração com Analytics** (Google Analytics e Facebook Pixel)

## 📦 Instalação

### Método 1: Upload Manual

1. Faça download dos arquivos do plugin
2. Acesse o painel administrativo do WordPress
3. Vá em **Plugins > Adicionar Novo > Enviar Plugin**
4. Selecione o arquivo ZIP do plugin
5. Clique em **Instalar Agora** e depois **Ativar**

### Método 2: FTP

1. Faça upload da pasta do plugin para `/wp-content/plugins/`
2. Acesse **Plugins** no painel administrativo
3. Ative o plugin **WhatsApp Float Button**

## ⚙️ Configuração

1. Após ativar o plugin, vá em **Configurações > WhatsApp Float**
2. Configure as seguintes opções:

### Número do WhatsApp
- Digite o número completo com código do país
- Exemplo: `5511999999999` (Brasil)
- Não use símbolos como `+`, `(`, `)`, `-` ou espaços

### Mensagem Inicial (Opcional)
- Mensagem que será enviada automaticamente quando o usuário clicar no botão
- Exemplo: `Olá! Gostaria de mais informações sobre seus serviços.`
- Deixe em branco se não quiser mensagem automática

### Habilitar/Desabilitar
- Use o checkbox para ativar ou desativar o botão no site

## 🎨 Aparência

O botão possui:
- **Cor de fundo**: Verde oficial do WhatsApp (#25d366)
- **Ícone**: Logo oficial do WhatsApp em branco
- **Tamanho**: 60px x 60px (55px em tablets, 50px em mobile)
- **Posição**: Canto inferior direito com margem responsiva
- **Efeitos**: Hover, clique e animação de pulso

## 📱 Funcionalidades

### Desktop
- Abre o WhatsApp Web em nova aba
- URL: `https://web.whatsapp.com/send?phone=NUMERO&text=MENSAGEM`

### Mobile
- Abre o aplicativo WhatsApp diretamente
- URL: `whatsapp://send?phone=NUMERO&text=MENSAGEM`
- Fallback para WhatsApp Web se o app não estiver instalado

### Acessibilidade
- Navegação por teclado (Tab, Enter, Space)
- Atributos ARIA apropriados
- Contraste adequado para daltonismo

## 🔧 Personalização

### CSS Customizado
Para personalizar a aparência, adicione CSS personalizado em **Aparência > Personalizar > CSS Adicional**:

```css
/* Alterar cor do botão */
.whatsapp-float {
    background: #128C7E !important; /* Verde escuro */
}

/* Alterar posição */
.whatsapp-float {
    bottom: 10vh !important;
    right: 3vw !important;
}

/* Alterar tamanho */
.whatsapp-float {
    width: 70px !important;
    height: 70px !important;
}
```

### Hooks para Desenvolvedores

O plugin oferece hooks para personalização avançada:

```php
// Modificar configurações do botão
add_filter('whatsapp_float_settings', function($settings) {
    // Modificar $settings conforme necessário
    return $settings;
});

// Personalizar HTML do botão
add_filter('whatsapp_float_button_html', function($html) {
    // Modificar $html conforme necessário
    return $html;
});
```

## 🛠️ Solução de Problemas

### O botão não aparece
- Verifique se o plugin está ativado
- Confirme se a opção "Habilitar WhatsApp Float" está marcada
- Verifique se há um número configurado
- Teste em modo anônimo para descartar conflitos de cache

### O WhatsApp não abre
- Confirme se o número está no formato correto (código do país + número)
- No mobile, verifique se o WhatsApp está instalado
- Teste se o número é válido enviando uma mensagem manual

### Conflitos com outros plugins
- Desative outros plugins de WhatsApp
- Verifique se não há JavaScript conflitante
- Teste com tema padrão do WordPress

## 📋 Requisitos

- WordPress 4.0 ou superior
- PHP 7.0 ou superior
- jQuery (incluído no WordPress)

## 📄 Estrutura de Arquivos

```
whatsapp-float-plugin/
├── whatsapp-float-plugin.php    # Arquivo principal
├── assets/
│   ├── whatsapp-float.css       # Estilos do botão
│   └── whatsapp-float.js        # Funcionalidades JavaScript
└── README.md                    # Documentação
```

## 🔄 Changelog

### Versão 1.0.0
- Lançamento inicial
- Botão flutuante do WhatsApp
- Painel de configurações no admin
- Suporte responsivo
- Integração com Analytics

## 📞 Suporte

Para suporte técnico ou dúvidas:
- Email: seu-email@exemplo.com
- GitHub: https://github.com/seu-usuario/whatsapp-float-plugin

## 📜 Licença

Este plugin é licenciado sob GPL v2 ou superior.

---

**Desenvolvido com ❤️ para a comunidade WordPress**
