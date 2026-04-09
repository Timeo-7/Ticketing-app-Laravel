document.addEventListener('DOMContentLoaded', () => {
    const ticketPage = document.querySelector('[data-ticket-page]');
    if (!ticketPage) return;

    const modal = ticketPage.querySelector('[data-ticket-modal]');
    if (!modal) return;

    // Boutons
    const openButtons = document.querySelectorAll('[data-open-ticket-modal]');
    const openUpdateButtons = document.querySelectorAll('[data-open-ticket-modal-update]');
    const closeButtons = ticketPage.querySelectorAll('[data-close-ticket-modal]');

    // Formulaire et champs
    const apiForm = ticketPage.querySelector('#submitform_ticket');
    const titleInput = ticketPage.querySelector('#ticket-title');
    const submitButton = ticketPage.querySelector('[data-ticket-submit-button]');
    const ticketList = ticketPage.querySelector('[data-ticket-list]');
    const openOnLoad = ticketPage.dataset.openOnLoad === 'true';

    const openModal = () => { if (!modal.open) modal.showModal(); };
    const closeModal = () => { if (modal.open) modal.close(); };

    let currentTicketId = null;

    openUpdateButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentTicketId = btn.dataset.ticketId;
            openModal();
        });
    });

    const updateSubmitButtonState = () => {
        if (titleInput && submitButton) {
            submitButton.disabled = titleInput.value.trim().length < 1;
        }
    };

    const addOrUpdateTicket = (ticket) => {
        if (!ticketList) return;

        const existingRow = ticketList.querySelector(`tr[data-ticket-id="${ticket.id}"]`);
        if (existingRow) {
            existingRow.innerHTML = `
                <td>${ticket.title}</td>
                <td>${ticket.client}</td>
                <td>${ticket.statut}</td>
                <td>${ticket.facturable}</td>
                <td>${ticket.created_at}</td>
                
            `;
            return;
        }

        const row = document.createElement('tr');
        row.style.cursor = 'pointer';
        row.dataset.ticketId = ticket.id;
        row.addEventListener('click', () => {
            window.location.href = ticket.show_url;
        });

        row.innerHTML = `
            <td>${ticket.title}</td>
            <td>${ticket.client}</td>
            <td>${ticket.statut}</td>
            <td>${ticket.facturable}</td>
            <td>${ticket.created_at}</td>
        `;
        ticketList.appendChild(row);
    };

    // Gestion des boutons
    openButtons.forEach(btn => btn.addEventListener('click', openModal));
    openUpdateButtons.forEach(btn => btn.addEventListener('click', openModal));
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

    if (apiForm) {
        updateSubmitButtonState();
        titleInput.addEventListener('input', updateSubmitButtonState);

        apiForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const data = {
                _method: 'PUT',
                'ticket-title': apiForm.querySelector("input[name='ticket-title']").value,
                'description': apiForm.querySelector("textarea[name='description']").value || "",
                'project': apiForm.querySelector("select[name='project']").value || "No project",
                'facturable': apiForm.querySelector("input[name='facturable']").checked ? '🪙' : '_',
                'time_estimated': parseFloat(apiForm.querySelector("input[name='time_estimated']").value) || 0
            };
            
            
            try {
                const response = await fetch(`/tickets/${currentTicketId}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    const err = await response.text();
                    console.error("Erreur serveur:", err);
                    return;
                }

                const json = await response.json();

                if (json.ticket) {
                    addOrUpdateTicket(json.ticket);

                    document.getElementById('ticket-title-display').textContent = json.ticket.title;
                    document.getElementById('ticket-project-display').textContent = json.ticket.project;
                    document.getElementById('ticket-description-display').textContent = json.ticket.description;
                    document.getElementById('ticket-facturable-display').textContent = json.ticket.facturable;
                    document.getElementById('ticket-statut').textContent = json.ticket.statut;
                }

                apiForm.reset();
                updateSubmitButtonState();
                closeModal();

            } catch (error) {
                console.error("Erreur fetch:", error);
            }
        });
    }

    if (openOnLoad) openModal();
});