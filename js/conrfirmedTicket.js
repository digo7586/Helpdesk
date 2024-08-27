    function myFunction() {
        
        var subject = document.getElementById('subject').value;
        var message = document.getElementById('message').value;

       
        if (subject.trim() === '' || message.trim() === '') {

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Preencha todos os campos antes de enviar!"
              });
            
        } else {

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Chamado enviado com sucesso!",
                showConfirmButton: false,
                timer: 1500
              });           
        }
    }

