 $(document).ready(function() {
    function updateCommentList() {
        $.ajax({
            url: "view_ticket.php",
            method: "GET",
            success: function(data) {
                $('#section-resposta').html(data);
            }
        });
    }

    // Chame a função de atualização inicialmente
    updateCommentList();

    // Atualize a seção "comment-list" a cada segundo
    setInterval(function() {
        updateCommentList();
    }, 1000);
});