/**
 * 
 * @class Carrousel
 * 
 * @property {Element} container
 * @property {Element} itemsContainer
 * @property {NodeList<Element>} items
 * @property {Element} pagination
 * @property {Number} indexPagination
 * @property {Number} intervalId
 * @property {Number} cooldown
 */
export default class Carrousel {
  container;
  itemsContainer;
  items;
  pagination;
  indexPagination = 0;
  intervalId = 0;
  cooldown = 1000;

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
    // console.log(this.pagination);

    if (this.container) {
      // this.MoveCarrouselItems();
      // this.intervalId = setInterval(() => this.MoveCarrouselItems(), this.cooldown);
    }
  }

  MoveCarrouselItems() {
    this.indexPagination++;
    // console.log(this.items);
    if (this.indexPagination >= this.items.length) this.indexPagination = 0;

    this.itemsContainer.style.transform = `translateX(${this.indexPagination * -100}%)`;
  }
}