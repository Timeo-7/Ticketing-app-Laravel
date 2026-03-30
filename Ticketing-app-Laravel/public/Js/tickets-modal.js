document.addEventListener('DOMContentLoaded', function () {
    const ticketPage = document.querySelector('[data-ticket-page]');
    if (!ticketPage) return;

    const apiForm = ticketPage.querySelector('[data-ticket-api-form]');
    const titleInput = ticketPage.querySelector('#ticket-title');
    const clientInput = ticketPage.querySelector('#ticket-client');
    const descriptionInput = ticketPage.querySelector('#description');
    const projectSelect = ticketPage.querySelector('#project');
    const facturableInput = ticketPage.querySelector('#facturable');

    const submitButton = ticketPage.querySelector('[data-ticket-submit-button]');

    function updateSubmitButtonState() {
        if (!titleInput || !clientInput || !submitButton) return;
        submitButton.disabled = titleInput.value.trim() === '' || clientInput.value.trim() === '';
    }

    if (apiForm) {
        updateSubmitButtonState();
        [titleInput, clientInput].forEach(input => input.addEventListener('input', updateSubmitButtonState));

        apiForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            const data = {
                'ticket-title': titleInput.value.trim(),
                'ticket-client': clientInput.value.trim(),
                'description': descriptionInput.value.trim(),
                'project': projectSelect.value,
                'facturable': facturableInput.checked
            };

            const token = apiForm.dataset.apiToken;

            try {
                const response = await fetch(apiForm.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    console.error("Erreur API:", errorData);
                    return;
                }

                

            } catch (error) {
                console.error("Erreur lors de l'appel API:", error);
            }
        });
    }

});