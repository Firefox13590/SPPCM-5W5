export class Partenaires {
    constructor() {


        this.init();
    }

    /**
     * Initialise les comportements
     */
    init() {
        console.log('classe Partenaires');
        //selectionne a (affect)
        const partenairesContainers = document.querySelectorAll('li.partenaire-footer a')

        //selectionne img (regarde)
        const partenairesImages = document.querySelectorAll('li.partenaire-footer img')
        for(let i = 0; i < partenairesContainers.length; i++) {
            const img = partenairesImages[i];
            if (img.width > img.height) {
                img.parentElement.classList.add('partenaires-larges');
                img.parentElement.parentElement.classList.add('partenaires-larges');
            }

            };

    }
}