console.log("Connexion is load.");


function chek_connexion_success() {
    let res = 0;

    const MAIL_INPUT = document.querySelector("#email");
    const PASSWORD_INPUT = document.querySelector("#password");

    const EMAIL_ERROR = document.querySelector("#email_error");

    if (MAIL_INPUT.value == "") {
        EMAIL_ERROR.classList.remove("titanic");
        res ++;
    } 
    else if(!/.+@+./.test(MAIL_INPUT.value)){
        EMAIL_ERROR.classList.remove("titanic");
        console.log("Pas de @");
        res ++;
    }
    else {
        EMAIL_ERROR.classList.add("titanic");
    }

    const PASSWORD_ERROR = document.querySelector("#password_error");

    if(PASSWORD_INPUT.value == ""){
         PASSWORD_ERROR.classList.remove("titanic");
        res ++;
    }
    else if(PASSWORD_INPUT.value.length < 8){
        PASSWORD_ERROR.classList.remove("titanic");
        res ++;
    }
    else if(!/\d/.test(PASSWORD_INPUT.value) || !/[a-zA-Z]/.test(PASSWORD_INPUT.value)){
        PASSWORD_ERROR.classList.remove("titanic");
        res ++;
    }
    else{
        PASSWORD_ERROR.classList.add("titanic");
    }

    return res;

}


const SUBMIT_CONNEXION = document.querySelector("#submitform_connexion");

SUBMIT_CONNEXION.addEventListener("submit", function(event) {
       // on empeche la soumission du formulaire
    // pour éviter le rechargement de page
    event.preventDefault();

    let error = 0;
    error += chek_connexion_success();

    if (error == 0) {
        

        // on peut soumettre le formulaire
        // ici on peut faire une requete ajax pour envoyer les données du formulaire
        console.log("formulaire soumis");

        const EMAIL_INPUT = document.querySelector("#email");
        const PASSWORD_INPUT = document.querySelector("#password");
        const VALID = document.querySelector(".ValidForms");


        console.log("title: " + EMAIL_INPUT.value);
        console.log("Client: " + PASSWORD_INPUT.value);

        VALID.classList.toggle("titanic");

        setTimeout(function() {
            VALID.classList.toggle("titanic");
        }, 3000);

        


        EMAIL_INPUT.value = "";
        PASSWORD_INPUT.value = "";
    }
    });


