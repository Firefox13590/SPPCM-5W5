export class Partenaires {
    constructor() {


        this.init();
    }

    /**
     * Initialise les comportements
     */
    init() {
        console.log('classe Partenaires');

        //selectionne img (regarde)
        document.querrySelectorAll('li.partenaire-footer img')
        //selectionne a (affect)
        document.querrySelectorAll('li.partenaire-footer a')

    }
}