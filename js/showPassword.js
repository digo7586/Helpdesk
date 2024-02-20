function passaMouseMostraSenha () {
    let senha = document.getElementById("newPassword");
    
    if (senha.type == "password"){
        senha.type = "text";
    } else {
            senha.type = "password";       
    }

    senha.type = senha.type;

    let eye = document.getElementById("showEye");

    if (eye.classList.contains("bi-eye")){
        eye.classList.remove("bi-eye");
        eye.classList.add("bi-eye-slash");
    } else {
        eye.classList.remove("bi-eye-slash");
        eye.classList.add("bi-eye");
    }
}


function passaMouseMostraSenhaLogin () {
    let senhaLogin = document.getElementById("password");
    
    if (senhaLogin.type == "password"){
        senhaLogin.type = "text";
    } else {
            senhaLogin.type = "password";       
    }

    senhaLogin.type = senhaLogin.type;

let eyeLogin = document.getElementById("closeEye");

if (eyeLogin.classList.contains("bi-eye")){
    eyeLogin.classList.remove("bi-eye");
    eyeLogin.classList.add("bi-eye-slash");
} else {
    eyeLogin.classList.remove("bi-eye-slash");
    eyeLogin.classList.add("bi-eye");
}
}