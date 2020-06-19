// Legger alle bildene i en variabel 
const spaceStation = ["images/astronaut_1.jpg",
                      "images/atlantisspaceshuttle_2.jpg",
                      "images/internationalspacestation_3.jpg",
                      "images/iss_4.jpg",
                      "images/space_shuttle_5.jpg"];

  const slideshow = document.querySelector('.slideshow'); // finner HTML-elementet for slideshow
  const slide1 = document.createElement('DIV'); // lager en div
  slideshow.appendChild(slide1);
  const slide2 = document.createElement('DIV');
  slideshow.appendChild(slide2);
  slide1.style.backgroundImage = `url('${spaceStation[0]}')`;

  setTimeout(()=>{
    slide1.style.opacity = 1;
  }, 1);                          // Etter 1 ms, fade inn det bakerste bilder


  let currentSlide = 1;   // Hva er det neste bildet som skal vises
  nextSlide();            // Starter slideshower

  /**
   * Venter 5 sekunder før de to bildene settes til samme bildet og
   * slide2 vises frem. Når slide2 er helt synlig vil neste bilde vises frem.
   */
  function nextSlide() {
    setTimeout(()=>{
      slide2.style.backgroundImage = slide1.style.backgroundImage;
      slide2.style.opacity = 1;
    }, 5000); // Etter 5 sekunder, legg samme bilde i det fremste som det bakerste, fade inn det fremste
  }

  slide2.addEventListener('transitionend', e=>{ // Når slide to er helt synlig/usynlig
    if (slide2.style.backgroundImage==slide1.style.backgroundImage) { // Når det fremste bildet er fadet inn
      slide1.style.backgroundImage = `url('${spaceStation[currentSlide]}')`;// Bytt det bakerste bildet
      slide2.style.opacity = 0;                                       // Fade ut det fremste bildet (dvs, vis bildet bak)
      currentSlide++;     // Gå til neste bilde
      currentSlide = currentSlide%spaceStation.length; // Dersom forbi slutten, gå til begynnelsen
      nextSlide();        // Etter 5 sekunder, gjør klar for å bytte bildet igjen
    }
  })
