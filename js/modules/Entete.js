/** Gère le menu mobile, les sous-menus et la fermeture au clavier. */

export default class Entete {
    constructor() {
        this.entete = document.querySelector('.entete-site');
        if (!this.entete) return;

        this.bouton = this.entete.querySelector('.bouton-menu');
        this.groupes = this.entete.querySelectorAll('details');
        this.formatBureau = window.matchMedia('(min-width: 75em)');
        this.entete.classList.add('menu-initialise');

        this.bouton.addEventListener('click', () => {
            this.ChangerMenu(!this.entete.classList.contains('menu-ouvert'));
        });

        // Fermer le burger dès le clic sur la loupe, avant l'ouverture du champ.
        this.entete.querySelector('.recherche-bureau > summary').addEventListener('click', () => {
            this.ChangerMenu(false);
            this.entete.querySelectorAll('.groupe-menu').forEach(groupe => {
                groupe.open = false;
            });
        });

        this.groupes.forEach(groupe => {
            groupe.addEventListener('toggle', () => {
                if (!groupe.open) return;
                this.groupes.forEach(autre => {
                    if (autre !== groupe) autre.open = false;
                });
                if (groupe.classList.contains('recherche-bureau')) {
                    this.ChangerMenu(false);
                    groupe.querySelector('input').focus();
                }
            });
        });

        document.addEventListener('click', evenement => {
            if (!this.entete.contains(evenement.target)) this.FermerTout();
        });

        this.entete.addEventListener('keydown', evenement => {
            if (evenement.key !== 'Escape') return;
            const groupeOuvert = [...this.groupes].find(groupe => groupe.open);
            if (groupeOuvert) {
                groupeOuvert.open = false;
                groupeOuvert.querySelector('summary').focus();
            } else if (this.entete.classList.contains('menu-ouvert')) {
                this.ChangerMenu(false);
                this.bouton.focus();
            }
        });

        this.formatBureau.addEventListener('change', () => this.FermerTout());
    }

    /** Ouvre ou ferme le menu et met à jour son état pour les lecteurs d'écran. */
    ChangerMenu(ouvert) {
        this.entete.classList.toggle('menu-ouvert', ouvert);
        this.bouton.setAttribute('aria-expanded', String(ouvert));
        this.bouton.setAttribute('aria-label', ouvert ? 'Fermer le menu' : 'Ouvrir le menu');
        if (ouvert) {
            this.entete.querySelector('.recherche-bureau').open = false;
        }
    }

    /** Ferme tous les panneaux après un clic extérieur ou un changement de format. */
    FermerTout() {
        this.ChangerMenu(false);
        this.groupes.forEach(groupe => { groupe.open = false; });
    }
}
