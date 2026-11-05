/**
 * 
 * @class Carrousel
 * 
 * @property {Element} container Le conteneur de toutes les parties du carrousel.
 * @property {Element} itemsContainer Le conteneur d'éléments déroulants du carrousel.
 * @property {NodeList<Element>} items La liste d'éléments déroulants du carrousel.
 * @property {Element} pagination La pagination du carrousel.
 * @property {Number} paginationIndex l'index de pagination du carrousel.
 * @property {Number} intervalId L'identifiant de l'intervalle.
 * @property {Number} cooldown le délai de l'intervalle.
 */
export default class Carrousel {
  container;
  itemsContainer;
  items;
  pagination;
  paginationIndex = 0;
  intervalId = 0;
  cooldown = 5000;

  constructor() {
    this.Init();
  }

  Init() {
    console.log('classe Carrousel');
    this.container = document.querySelector('.carrousel-container');
    this.itemsContainer = this.container.querySelector('.carrousel-items-container');
    this.items = this.container.querySelectorAll('.carrousel-item');
    this.pagination = this.container.querySelector('.carrousel-pagination');
    // console.log(this.container);
    // console.log(this.itemsContainer);
    // console.log(this.items, this.items.length);
    // console.log(this.pagination, this.pagination.children.length);

    if (this.pagination && this.pagination.children.length === 0) {
      for (let i = 0; i < this.items.length; i++) {
        const element = document.createElement('div');
        element.addEventListener('click', () => this.SetPaginationIndex(element));
        if (i === 0) element.classList.add('active');

        this.pagination.append(element);
      }
    }

    this.StartInterval();
  }

  StartInterval() {
    if (this.container) {
      // this.items.forEach(el => console.log(el.getBoundingClientRect()));

      // this.MoveCarrouselItems();
      clearInterval(this.intervalId);
      this.intervalId = setInterval(() => this.MoveCarrouselItems(), this.cooldown);
    }
  }

  /**
   * Fait bouger les éléments du carrousel en appliquant une translation sur le conteneur.
   * 
   * @returns {void}
   */
  MoveCarrouselItems() {
    this.paginationIndex++;
    // console.log(this.items);
    if (this.paginationIndex >= this.items.length) this.paginationIndex = 0;

    // this.itemsContainer.style.transform = `translateX(${this.indexPagination * -200}%)`;
    this.itemsContainer.style.transform = `translateX(calc(${this.paginationIndex * -200}% + ${this.paginationIndex * 4}px))`;

    if (this.pagination) this.UpdatePagination();
  }

  /**
   * Met à jour les boutons de pagination.
   * 
   * @returns {void}
   */
  UpdatePagination() {
    for (let i = 0; i < this.pagination.children.length; i++) {
      this.pagination.children[i].classList.remove('active');

      if (i == this.paginationIndex) this.pagination.children[i].classList.add('active');
    }
  }

  /**
   * Affecte directement une valeur à {@link Carrousel.paginationIndex}
   * 
   * @param {Element} element L'élément HTML enfant dans la liste de boutons de pagination.
   * 
   * @returns {void}
   */
  SetPaginationIndex(element) {
    this.paginationIndex = [...element.parentNode.children].indexOf(element);
    this.itemsContainer.style.transform = `translateX(calc(${this.paginationIndex * -200}% + ${this.paginationIndex * 4}px))`;
    this.UpdatePagination();

    this.StartInterval();
  }
}