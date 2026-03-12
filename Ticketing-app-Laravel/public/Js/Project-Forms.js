console.log("Project-Form is load.")

function chek_project_success() {
    let res = 0;

    const TITLE_INPUT = document.querySelector("#project-title");
    const CLIENT_INPUT = document.querySelector("#project-client");
    const FILE_INPUT = document.querySelector("#project-file");

    console.log("File : ",FILE_INPUT.value);

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

    const FILE_ERROR = document.querySelector("#file_error");

    if(FILE_INPUT.value == ""){
         FILE_ERROR.classList.remove("titanic");
        res ++;
    }
    else{
        FILE_ERROR.classList.add("titanic");
    }

    return res;

    
}

    const SUBMIT_PROJECT = document.querySelector("#submitform_project");

    SUBMIT_PROJECT.addEventListener("submit", function(event) {
        // on empeche la soumission du formulaire
        // pour éviter le rechargement de page
        event.preventDefault();

        let error = 0;
        error += chek_project_success();

        if (error == 0) {
            

            // on peut soumettre le formulaire
            // ici on peut faire une requete ajax pour envoyer les données du formulaire
            console.log("formulaire soumis");

            const TITLE_INPUT = document.querySelector("#project-title");
            const CLIENT_INPUT = document.querySelector("#project-client");
             const FILE_INPUT = document.querySelector("#project-file");

            console.log("title: " + TITLE_INPUT.value);
            console.log("Client: " + CLIENT_INPUT.value);
            console.log("File: " + FILE_INPUT.value);

            const VALID = document.querySelector(".ValidForms");

            VALID.classList.toggle("titanic");

            setTimeout(function() {
                VALID.classList.toggle("titanic");
            }, 3000);

        


            TITLE_INPUT.value = "";
            CLIENT_INPUT.value = "";
            FILE_INPUT.value = "";
        }
    });
    