console.log("Ticket-Forms.js loaded");


function chek_ticket_success() {
    let res = 0;

    const TITLE_INPUT = document.querySelector("#ticket-title");
    const CLIENT_INPUT = document.querySelector("#ticket-client");

    const TITLE_ERROR = document.querySelector("#title_error");

    if (TITLE_INPUT.value == "") {

        TITLE_ERROR.classList.remove("titanic");
        res ++;
        
    } else {
        TITLE_ERROR.classList.add("titanic");
    }

    const CLIENT_ERROR = document.querySelector("#client_error");

    if(CLIENT_INPUT.value == ""){
         CLIENT_ERROR.classList.remove("titanic");
        res ++;
    }
    else{
        CLIENT_ERROR.classList.add("titanic");
    }

    return res;

    
}

const SUBMIT_TICKET = document.querySelector("#submitform_ticket");

SUBMIT_TICKET.addEventListener("submit", function(event) {
       // on empeche la soumission du formulaire
    // pour éviter le rechargement de page
    event.preventDefault();

    let error = 0;
    error += chek_ticket_success();

    if (error == 0) {
        SUBMIT_TICKET.submit();

        const VALID = document.querySelector(".ValidForms");
        VALID.classList.remove("titanic");
        setTimeout(() => VALID.classList.add("titanic"), 3000);

    }
    });


