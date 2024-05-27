// Função para fazer a solicitação AJAX
function checkForNewTickets() {
    // Fazer a solicitação AJAX para o arquivo PHP que executa a consulta SQL
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'check_new_tickets.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Verificar se há novos tickets
            var response = JSON.parse(xhr.responseText);

            if (response.newTickets) {
                /* alert("Novos chamado aberto!"); */
                enviarNotificacao()
            }
        }
    };

    xhr.send();
}

function enviarNotificacao() {
                    if (!("Notification" in window)) {
                        alert("Este navegador não suporta notificações.");
                    } else if (Notification.permission === "granted") {
                        var notification = new Notification("Novo chamado aberto", {
                            body: "Um novo chamado foi aberto. Verifique agora!"
                        });
                    } else if (Notification.permission !== "denied") {
                        Notification.requestPermission().then(function(permission) {
                            if (permission === "granted") {
                                var notification = new Notification("Novo chamado aberto", {
                                    body: "Um novo chamado foi aberto. Verifique agora!"
                                });
                            }
                        });
                    }
                }

// Chamar a função checkForNewTickets a cada 2 minutos
setInterval(checkForNewTickets, 1 * 60 * 1000);