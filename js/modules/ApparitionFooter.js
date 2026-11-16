export class ApparitionFooter {
  constructor() {
    this.init();
  }

  /**
   * Initialise les comportements
   */
  init() {
    console.log("classe ApparitionFooter");
    // source : https://developer.mozilla.org/en-US/docs/Web/API/IntersectionObserver/observe
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.intersectionRatio > 0 ) {
          // Add 'active' class if observation target is inside viewport
          entry.target.classList.add("apparition");
        } else {
          // Remove 'active' class otherwise
          entry.target.classList.remove("apparition");
        }
      });
    });
    const footer = document.querySelectorAll(".footer-content>*");
    footer.forEach((el) => {
      io.observe(el);
    });
  }
}
