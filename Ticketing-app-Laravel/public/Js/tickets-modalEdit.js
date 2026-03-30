document.addEventListener('DOMContentLoaded', function () {
    const ticketPage = document.querySelector('[data-ticket-page]');
    if (!ticketPage) return;

    const token = ticketPage.dataset.apiToken;

    // Modal
    const openBtnUpdate = document.querySelector('[data-open-ticket-modal-update]');
    const closeBtnUpdate = document.querySelector('[data-close-ticket-modal]');
    const modalUpdate = document.querySelector('[data-ticket-modal]');
    openBtnUpdate?.addEventListener('click', () => modalUpdate?.showModal());
    closeBtnUpdate?.addEventListener('click', () => modalUpdate?.close());

    // Form Update
    const apiForm = ticketPage.querySelector('[data-ticket-api-form]');
    if (apiForm) {
        const titleInput = ticketPage.querySelector('#ticket-title');
        const clientInput = ticketPage.querySelector('#ticket-client');
        const descriptionInput = ticketPage.querySelector('#description');
        const projectSelect = ticketPage.querySelector('#project');
        const facturableInput = ticketPage.querySelector('#facturable');
        const submitButton = ticketPage.querySelector('[data-ticket-submit-button]');

        const updateSubmitButtonState = () => {
            if (!submitButton || !titleInput || !clientInput) return;
            submitButton.disabled = titleInput.value.trim() === '' || clientInput.value.trim() === '';
        };
        updateSubmitButtonState();
        [titleInput, clientInput].forEach(input => input.addEventListener('input', updateSubmitButtonState));

        apiForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const data = {
                'ticket-title': titleInput.value.trim(),
                'ticket-client': clientInput.value.trim(),
                'description': descriptionInput.value.trim(),
                'project': projectSelect.value,
                'facturable': facturableInput.checked
            };
            try {
                const response = await fetch(apiForm.action, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify(data)
                });
                if (!response.ok) {
                    console.error(await response.json());
                    return;
                }
                const result = await response.json();
                document.querySelector('#ticket-title-display').textContent = result.ticket.title;
                document.querySelector('#ticket-client-display').textContent = result.ticket.client;
                document.querySelector('#ticket-project-display').textContent = result.ticket.project;
                document.querySelector('#ticket-description-display').textContent = result.ticket.description;
                document.querySelector('#ticket-facturable-display').textContent = result.ticket.facturable;
                modalUpdate?.close();
            } catch (error) {
                console.error(error);
            }
        });
    }

    // Validate
    ticketPage.querySelectorAll('[data-validate-ticket]').forEach(button => {
        button.addEventListener('click', async () => {
            const ticketId = button.dataset.validateTicket;
            try {
                const response = await fetch(`/api/tickets/validate/${ticketId}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
                if (!response.ok) {
                    console.error(await response.json());
                    return;
                }
                const result = await response.json();
                const statutTd = document.querySelector('#ticket-statut');
                if (statutTd) statutTd.textContent = result.statut;
                button.textContent = result.statut === "✅" ? "⌛ Working Ticket" : "✅ Validate Ticket";
            } catch (error) {
                console.error(error);
            }
        });
    });

    // Delete
    ticketPage.querySelectorAll('[data-delete-ticket]').forEach(button => {
        button.addEventListener('click', async () => {
            const ticketId = button.dataset.deleteTicket;
            if (!confirm("Voulez-vous vraiment supprimer ce ticket ?")) return;

            try {
                const response = await fetch(`/api/tickets/delete/${ticketId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
                if (!response.ok) {
                    console.error(await response.json());
                    return;
                }
                const ticketRow = document.querySelector(`tr[data-ticket-row="${ticketId}"]`);
                if (ticketRow) ticketRow.remove();
                else window.location.href = "{{ route('tickets.TicketList', auth()->user()->id) }}";
            } catch (error) {
                console.error(error);
            }
        });
    });
});