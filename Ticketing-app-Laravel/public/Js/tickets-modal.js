document.addEventListener('DOMContentLoaded', function () {
    const ticketPage = document.querySelector('[data-ticket-page]');
    if (!ticketPage) return;

    const modal = ticketPage.querySelector('[data-ticket-modal]');
    if (!modal) return;

    const openButtons = document.querySelectorAll('[data-open-ticket-modal]');
    const closeButtons = ticketPage.querySelectorAll('[data-close-ticket-modal]');
    const apiForm = ticketPage.querySelector('#submitform_ticket');
    const titleInput = ticketPage.querySelector('#ticket-title');
    const submitButton = ticketPage.querySelector('[data-ticket-submit-button]');
    const ticketList = ticketPage.querySelector('[data-ticket-list]');
    const openOnLoad = ticketPage.dataset.openOnLoad === 'true';

    function openModal() { if (!modal.open) modal.showModal(); }
    function closeModal() { if (modal.open) modal.close(); }
    function updateSubmitButtonState() {
        if (!titleInput || !submitButton) return;
        submitButton.disabled = titleInput.value.trim().length < 1;
    }

    function addTicketToTable(ticket) {
        if (!ticketList) return;

        const row = document.createElement('tr');
        row.style.cursor = 'pointer';
        row.onclick = () => {
            window.location.href = ticket.show_url; // URL générée côté serveur
        };

        row.innerHTML = `
            <td>${ticket.title}</td>
            <td>${ticket.client}</td>
            <td>${ticket.statut}</td>
            <td>${ticket.facturable}</td>
            <td>${ticket.time_estimated}h</td>
            <td>${ticket.time_spent}h</td>
            <td>${ticket.time_remaining}h</td>
            <td>${ticket.billable_amount}€</td>
            <td>${ticket.created_at}</td>
        `;

        ticketList.appendChild(row);
    }

    openButtons.forEach(btn => btn.addEventListener('click', openModal));
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

    if (apiForm) {
        updateSubmitButtonState();

        titleInput.addEventListener('input', updateSubmitButtonState);

        apiForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const data = {
                'ticket-title': apiForm.querySelector("input[name='ticket-title']").value,
                'description': apiForm.querySelector("textarea[name='description']").value || "",
                'project': apiForm.querySelector("select[name='project']").value || "No project",
                'facturable': apiForm.querySelector("input[name='facturable']").checked ? '🪙' : '_',
                'time_estimated': parseFloat(apiForm.querySelector("input[name='time_estimated']").value) || 0
            };

            const response = await fetch("/tickets", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                credentials: 'same-origin',
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                const err = await response.text();
                console.error("Erreur serveur:", err);
                return;
            }

            const json = await response.json();

            addTicketToTable(json.ticket);
            apiForm.reset();
            updateSubmitButtonState();
            closeModal();
        });
    }

    if (openOnLoad) openModal();
});