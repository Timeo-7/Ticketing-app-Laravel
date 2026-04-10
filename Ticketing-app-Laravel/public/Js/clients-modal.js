document.addEventListener('DOMContentLoaded', () => {

    const openBtn = document.querySelector('[data-open-ticket-modal]');
    const modal = document.querySelector('[data-ticket-modal]');
    const closeBtns = document.querySelectorAll('[data-close-ticket-modal]');

    if (!openBtn || !modal) return;

    // Ouvrir la modale
    openBtn.addEventListener('click', () => {
        modal.showModal();
    });

    // Fermer avec les boutons ✖ et Annuler
    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.close();
        });
    });

    // Fermer si clic en dehors (overlay)
    modal.addEventListener('click', (e) => {
        const rect = modal.getBoundingClientRect();
        const isInside =
            e.clientX >= rect.left &&
            e.clientX <= rect.right &&
            e.clientY >= rect.top &&
            e.clientY <= rect.bottom;

        if (!isInside) {
            modal.close();
        }
    });

});