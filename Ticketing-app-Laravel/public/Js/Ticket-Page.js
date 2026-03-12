  // On veut gérer les filtres
// je selectionne tous les filtres
const FILTRE_EN_COURS = document.querySelector(".filter-btn-En-Cours");


FILTRE_EN_COURS.addEventListener("click", function(event) {


    const trs = document.querySelectorAll('#content tbody tr');

         for (let j=0; j < trs.length ; j++) {
        // Je veux parcourir mon tableau
            console.log(trs[j]);
            const statut = trs[j].querySelector(".Statut");
            // texte de la case dans le tableau
            console.log(statut.innerText);

            // Je veux comparer mon texte du bouton, avec celui de la case du tableau
            // Si le texte est différent, on cache la ligne

            if (statut.innerText.trim() != '⏳') {
                trs[j].classList.add('titanic');
            } else {
                trs[j].classList.remove('titanic');
            }

        }
});

const FILTRE_NON_TRAITE = document.querySelector(".filter-btn-Non-Traite");



FILTRE_NON_TRAITE.addEventListener("click", function(event) {

    const trs = document.querySelectorAll('#content tbody tr');

         for (let j=0; j < trs.length ; j++) {
        // Je veux parcourir mon tableau
            console.log(trs[j]);
            const statut = trs[j].querySelector(".Statut");
            // texte de la case dans le tableau
            console.log(statut.innerText);

            // Je veux comparer mon texte du bouton, avec celui de la case du tableau
            // Si le texte est différent, on cache la ligne

            if (statut.innerText.trim() != '❌') {
                trs[j].classList.add('titanic');
            } else {
                trs[j].classList.remove('titanic');
            }

        }
});

const FILTRE_MONEY = document.querySelector(".filter-btn-Money");



FILTRE_MONEY.addEventListener("click", function(event) {

    const trs = document.querySelectorAll('#content tbody tr');

         for (let j=0; j < trs.length ; j++) {
        // Je veux parcourir mon tableau
            console.log(trs[j]);
            const statut = trs[j].querySelector(".Money");
            // texte de la case dans le tableau
            console.log(statut.innerText);

            // Je veux comparer mon texte du bouton, avec celui de la case du tableau
            // Si le texte est différent, on cache la ligne

            if (statut.innerText.trim() != '🪙') {
                trs[j].classList.add('titanic');
            } else {
                trs[j].classList.remove('titanic');
            }

        }
});
