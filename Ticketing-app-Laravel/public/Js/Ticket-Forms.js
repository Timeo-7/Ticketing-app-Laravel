console.log("Ticket-Forms.js loaded");

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.querySelector('[data-ticket-modal]');
    const openBtn = document.querySelector('[data-open-ticket-modal]');
    const closeBtn = document.querySelector('[data-close-ticket-modal]');

    // Ouvrir modal
    if (openBtn && modal) {
        openBtn.addEventListener('click', () => modal.showModal());
    }

    // Fermer modal
    if (closeBtn && modal) {
        closeBtn.addEventListener('click', () => modal.close());
    }

    function chek_ticket_success() {
        let res = 0;

        const TITLE_INPUT = document.querySelector("#ticket-title");
        const CLIENT_INPUT = document.querySelector("#ticket-client");

        const TITLE_ERROR = document.querySelector("#title_error");
        const CLIENT_ERROR = document.querySelector("#client_error");

        if (TITLE_INPUT.value === "") {
            TITLE_ERROR.classList.remove("titanic");
            res++;
        } else {
            TITLE_ERROR.classList.add("titanic");
        }

        if (CLIENT_INPUT.value === "") {
            CLIENT_ERROR.classList.remove("titanic");
            res++;
        } else {
            CLIENT_ERROR.classList.add("titanic");
        }

        return res;
    }

    const SUBMIT_TICKET = document.querySelector("#submitform_ticket");

    if (SUBMIT_TICKET) {
        SUBMIT_TICKET.addEventListener("submit", function(event) {

            if (modal) modal.close();

            let error = chek_ticket_success();

            if (error === 0) {
                SUBMIT_TICKET.submit();

                if (modal) modal.close();
            }
        });
    }

});