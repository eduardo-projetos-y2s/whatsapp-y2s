# 📥 Guia de Instalação - WhatsApp Float Button

## ⚡ Instalação Rápida

### 1️⃣ Baixar o Plugin
- Faça download de todos os arquivos deste plugin
- Mantenha a estrutura de pastas conforme mostrado abaixo

### 2️⃣ Estrutura de Arquivos
```
whatsapp-float-plugin/
├── whatsapp-float-plugin.php    ← Arquivo principal
├── uninstall.php               ← Limpeza na desinstalação
├── index.php                   ← Segurança
├── README.md                   ← Documentação completa
├── INSTALACAO.md              ← Este arquivo
├── screenshot-info.txt        ← Info sobre screenshots
└── assets/
    ├── whatsapp-float.css     ← Estilos do botão
    ├── whatsapp-float.js      ← Funcionalidades
    └── index.php             ← Segurança
```

### 3️⃣ Upload via WordPress Admin
1. Comprima toda a pasta em um arquivo ZIP
2. Acesse seu WordPress Admin
3. Vá em **Plugins > Adicionar Novo**
4. Clique em **Enviar Plugin**
5. Selecione o arquivo ZIP
6. Clique em **Instalar Agora**
7. Clique em **Ativar Plugin**

### 4️⃣ Upload via FTP
1. Conecte-se ao seu servidor via FTP
2. Vá para a pasta `/wp-content/plugins/`
3. Faça upload da pasta `whatsapp-float-plugin`
4. Acesse o WordPress Admin
5. Vá em **Plugins**
6. Ative o **WhatsApp Float Button**

## ⚙️ Configuração Inicial

### 1️⃣ Acessar Configurações
Após ativar, vá em **Configurações > WhatsApp Float**

### 2️⃣ Configurar Número
- Digite seu número com código do país
- **Formato correto**: `5511999999999`
- **Não use**: `+55 (11) 99999-9999`

### 3️⃣ Definir Mensagem (Opcional)
- Adicione uma mensagem que será enviada automaticamente
- Exemplo: `Olá! Vi seu site e gostaria de mais informações.`

### 4️⃣ Ativar o Botão
- Marque a opção "Habilitar WhatsApp Float"
- Clique em **Salvar Alterações**

## ✅ Verificação

### Teste no Desktop
1. Abra seu site em uma nova aba
2. Verifique se o botão verde aparece no canto inferior direito
3. Clique no botão - deve abrir o WhatsApp Web

### Teste no Mobile
1. Abra seu site no celular
2. Clique no botão - deve abrir o app WhatsApp
3. Se não tiver o app, abrirá no navegador

## 🔧 Solução de Problemas

### ❌ Botão não aparece
- [ ] Plugin está ativado?
- [ ] Opção "Habilitar" está marcada?
- [ ] Número foi configurado?
- [ ] Teste em modo anônimo (limpa cache)

### ❌ WhatsApp não abre
- [ ] Número está no formato correto?
- [ ] Teste o número manualmente
- [ ] No mobile, WhatsApp está instalado?

### ❌ Erro de instalação
- [ ] Versão do WordPress é 4.0+?
- [ ] Versão do PHP é 7.0+?
- [ ] Há conflito com outros plugins?

## 📞 Suporte

Caso tenha problemas:
1. Desative outros plugins de WhatsApp
2. Teste com tema padrão do WordPress
3. Verifique erros no console do navegador (F12)
4. Entre em contato com o desenvolvedor

---

**🎉 Pronto! Seu botão WhatsApp está funcionando!**