/**
 * 
 * @class Accordeon
 * 
 * @property {NodeListOf<Element>} listeInputsCheck La liste complète des inputs de type checkbox qui ont été trouvés sur la page actuelle.
 * @property {Number} posCheckActif L'index du checkbox présentement actif. -1 par d♪0faut pour signifier qu'aucun checkbox n'est actif.
 */
export default class Accordeon {
  listeInputsCheck;
  posCheckActif = -1;

  constructor() {
    this.Init();
  }

  Init() {
    // console.log('classe Accordeon');
    this.listeInputsCheck = document.querySelectorAll("input[type='checkbox']");
    // console.log(this.listeInputsCheck);
    this.listeInputsCheck.forEach(el => {
      el.addEventListener("click", () => this.SetActiveCheck(el));
    });
  }

  /**
   * Active le checkbox cliqué s'il ne l'est pas déjà.
   * 
   * @param {HTMLInputElement} checkbox Le checkbox qui s'est fait cliquer
   * 
   * @returns {void}
   */
  SetActiveCheck(checkbox) {
    // console.log(checkbox);

    const id = checkbox.id.split("-")[2];
    // console.log(id);

    this.DisableAllCheckboxes();

    this.posCheckActif = (id == this.posCheckActif) ? -1 : id;
    if (this.posCheckActif > -1) { this.listeInputsCheck[this.posCheckActif].checked = true; }
  }

  /**
   * Désactive tous les checkboxs.
   */
  DisableAllCheckboxes() {
    this.listeInputsCheck.forEach(element => {
      element.checked = false;
    });
  }
}