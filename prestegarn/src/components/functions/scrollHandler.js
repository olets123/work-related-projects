/**
 * function to change the navigation bar to sticky when scrolled past it
*/
export const scrollFunction = () => {
    const distanceY = window.pageYOffset || document.documentElement.scrollTop,
    shrinkOn = 40,
    headerEl = document.getElementById("header");

  if (distanceY > shrinkOn) {
    headerEl.classList.add("smaller");
  } else {
    headerEl.classList.remove("smaller");
  }
}
