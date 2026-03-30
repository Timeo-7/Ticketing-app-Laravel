

    const apiBaseUrl = "{{ url('/api/tickets') }}";

    document.querySelectorAll('[data-validate-ticket]').forEach(btn => {
        btn.addEventListener('click', async () => {
            const ticketId = btn.dataset.validateTicket;
            const token = "{{ auth()->user()->currentAccessToken()->plainTextToken ?? '' }}";
            try {
                const res = await fetch(`${apiBaseUrl}/${ticketId}/validate`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
                if(res.ok) {
                    const data = await res.json();
                    document.getElementById('ticket-statut').innerText = data.statut;
                    btn.innerText = data.statut === '✅' ? '⌛ Working Ticket' : '✅ Validate Ticket';
                }
            } catch(err) {
                console.error(err);
            }
        });
    });

    document.querySelectorAll('[data-delete-ticket]').forEach(btn => {
        btn.addEventListener('click', async () => {
            if(!confirm('Are you sure you want to delete this ticket?')) return;
            const ticketId = btn.dataset.deleteTicket;
            const token = "{{ auth()->user()->currentAccessToken()->plainTextToken ?? '' }}";
            try {
                const res = await fetch(`${apiBaseUrl}/${ticketId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                if(res.ok) {
                    window.location.href = "{{ route('tickets.TicketList', $ticket->user_id) }}";
                }
            } catch(err) {
                console.error(err);
            }
        });
    });
