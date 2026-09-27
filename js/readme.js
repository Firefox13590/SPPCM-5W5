/* 
    VARIABLES
*/
// éléments HTML
// TOUJOURS déclarer les variables contenant des éléments HTML comme constantes.
// Si la variable doit subir plusieurs affectations (dans une boucle ou une fonction), elle peut être déclarée comme variable classique.
const inputsFormInfolettre = document.querySelectorAll(".form-infolettre input[type='text']");
const galerie = docuemnt.querySelector(".galerie");

// variables de travail
// TOUJOURS déclarer les variables de travail non constantes avec le mot-clé "let".
let indexImage = 0;
let optionsFiltre = {};
let ListeCartesActives = [];
const RANGEES_MAX_PAR_PLATEFORME = {
    mobile: 1,
    tablette: 2,
    pc: 4,
};



/* 
    FONCTIONS
*/
// TOUJOURS documenter les fonctions, même si une focntion ne fait pas grand chose.
/* 
Les informations MINIMALES requises pour la documentation de fonctions sont les suivantes:

1- Une description de la fonction
2- Une description de chaque paramètre de la fonction
3- Une description du retour (return), sauf si le retour est nul (void)
*/
/**
 * Fait avancer ou reculer la galerie selon le mouvement.
 * @param {number} valeurMouvement Fait avancer ou reculer la galerie.
 * @returns {void}
 */
function ChangerImageGalerie(valeurMouvement = 0) {
    // code
}



/* 
    EXECUTION
*/
// Pour le code qui doit être éxécuté dès le chargement du script
optionsFiltre = localStorage.getItem("filtre") ?? {};
ChangerImageGalerie();
inputsFormInfolettre.forEach((el, i) => {
    el.style.animation = `fade-et-slide-in 1s ${.125 * i}s`;
});