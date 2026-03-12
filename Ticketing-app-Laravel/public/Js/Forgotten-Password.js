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
        console.log("Pas de @ je crois");
        res ++;
    }
    else {
        EMAIL_ERROR.classList.add("titanic");
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
        const VALID = document.querySelector(".ValidForms");

        console.log("title: " + EMAIL_INPUT.value);

        VALID.classList.toggle("titanic");

        setTimeout(function() {
            VALID.classList.toggle("titanic");
        }, 3000);

        EMAIL_INPUT.value = "";

        
    }
    });


