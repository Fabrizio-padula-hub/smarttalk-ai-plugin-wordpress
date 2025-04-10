// Gestione apertura widget e invio messaggi
jQuery(document).ready(function($) {
    // Funzione per inviare il messaggio
    function sendMessage() {
        var message = $('#message-input').val();
        if (message.trim() === '') return;

        // Stampa il messaggio dell'utente nella chat
        appendMessage('user', message);

        // Mostra una bolla "In attesa di risposta..."
        displayTyping();

        // Invia una richiesta AJAX POST
        $.ajax({
            url: smarttalk_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'smarttalk_process_message',
                message: message,
                nonce: smarttalk_ajax.nonce
            },
            success: function(response) {
                // Sostituisci la bolla "attesa" con il messaggio dell'AI
                $('.typing-indicator').remove();
                
                // Debug della risposta
                console.log('Risposta API:', response);
                
                if (response.success) {
                    if (response.data && response.data.choices && response.data.choices[0] && response.data.choices[0].message) {
                        appendMessage('ai', response.data.choices[0].message.content);
                    } else {
                        console.error('Struttura della risposta non valida:', response.data);
                        appendMessage('error', 'Errore: la risposta dell\'API non è nel formato atteso');
                    }
                } else {
                    console.error('Errore API:', response.data);
                    appendMessage('error', 'Errore: ' + (response.data || 'Errore sconosciuto'));
                }
            },
            error: function(xhr, status, error) {
                // Gestisci errori AJAX
                $('.typing-indicator').remove();
                console.error('Errore AJAX:', {xhr: xhr, status: status, error: error});
                appendMessage('error', 'Errore di connessione: ' + error);
            }
        });

        // Pulisci l'input
        $('#message-input').val('');
    }

    // Funzione per aggiungere un messaggio alla chat
    function appendMessage(type, content) {
        var messageClass = type === 'user' ? 'user-message' : 'ai-message';
        if (type === 'error') {
            messageClass = 'error-message';
        }
        var messageHtml = '<div class="chat-message ' + messageClass + '">' + content + '</div>';
        $('#chat-messages').append(messageHtml);
        
        // Scorri automaticamente alla fine della chat
        scrollToBottom();
    }

    // Funzione per mostrare l'indicatore di digitazione
    function displayTyping() {
        var typingHtml = '<div class="typing-indicator">' +
            '<div class="dot"></div>' +
            '<div class="dot"></div>' +
            '<div class="dot"></div>' +
            '</div>';
        $('#chat-messages').append(typingHtml);
        scrollToBottom();
    }

    // Funzione per scorrere alla fine della chat
    function scrollToBottom() {
        var chatMessages = $('#chat-messages');
        chatMessages.scrollTop(chatMessages[0].scrollHeight);
    }

    // Gestione click sul pulsante di invio
    $('#send-button').on('click', function() {
        sendMessage();
    });

    // Gestione pressione del tasto Enter
    $('#message-input').on('keypress', function(e) {
        if (e.which === 13) {
            sendMessage();
        }
    });

    // Gestione click sul pulsante di chiusura
    $('#close-chat').on('click', function() {
        $('#chat-window').addClass('hide');
        setTimeout(function() {
            $('#chat-window').hide().removeClass('hide');
        }, 300);
    });

    // Gestione click sul pulsante di apertura
    $('#smarttalk-chatbot').on('click', function() {
        $('#chat-window').show().addClass('show');
        setTimeout(function() {
            $('#chat-window').removeClass('show');
        }, 300);
        scrollToBottom();
    });

    // Focus sull'input quando si apre la chat
    $('#chat-window').on('show', function() {
        $('#message-input').focus();
    });
}); 