window.addEventListener('load', e=>{ // Når man laster nettsiden på nytt vil det som har blitt skrevet i input-feltene forsvinne.
const Kontakter = new Kontakt('#kontaktSøk ul');
  document.querySelector('#leggTil').addEventListener('click', e=>{ //Legger til en event lytter når brukeren klikker på legg til knappen.
    const form = e.target.form;
    // Legger til ny kontakt basert på infoen fra inputfeltet.
    // lagrer informasjonen som er skrevet inn på server, ved hjelp av funksjonen leggTilKontakt i class Kontakt
    Kontakter.leggTilKontakt(form.fornavn.value, form.etternavn.value, form.tlf.value,
      form.email.value, form.gate.value, form.postnr.value, form.poststed.value);
    // Henter verdien til hver enkelt input som sendes gjennom et klikk på knappen
    fornavn = document.querySelector('#fornavn').value;
    etternavn = document.querySelector('#etternavn').value;
    tlf = document.querySelector('#tlf').value;
    epost = document.querySelector('#email').value;
    gateadresse = document.querySelector('#gate').value;
    postnummer = document.querySelector('#postnr').value;
    poststed = document.querySelector('#poststed').value;
    form.fornavn.focus(); // legger fokus på første inputfelt fornavn
  });

  // Ved trykk på button oppdater så vil det lagre og sende informasjonen som er skrevet i input feletene
  // og oppdatere server ved hjelp av oppdaterKontakt fra class Kontakt
  document.querySelector('#oppdater').addEventListener('click', e=>{ //Legger til en event lytter når brukeren klikker på legg til knappen.
    const form = e.target.form;
    const formId = e.target.form.id;
    // Legger til ny kontakt basert på infoen fra inputfeltet.
    Kontakter.oppdaterKontakt(formId, form.fornavn.value, form.etternavn.value, form.tlf.value, form.email.value,
      form.gate.value, form.postnr.value, form.poststed.value);
    // Henter verdien til hver enkelt input som sendes gjennom et klikk på knappen
    fornavn = document.querySelector('#fornavn').value;
    etternavn = document.querySelector('#etternavn').value;
    tlf = document.querySelector('#tlf').value;
    epost = document.querySelector('#email').value;
    gateadresse = document.querySelector('#gate').value;
    postnummer = document.querySelector('#postnr').value;
    poststed = document.querySelector('#poststed').value;
    form.fornavn.focus(); // legger fokus på første inputfelt fornavn
  });

  // Gjør et søk etter kontakt
  document.getElementById('kontaktSøker').addEventListener('input', e => { // laget en event "lytte" for at noe skal skje når vi skriver inne i input feltet.
    const visAlleKontakter = document.querySelector('.kontaktListe ul'); // henter den unummerte listen registrert i class taggen på HTML siden.
      visAlleKontakter.innerHTML = '';

      // Lager to 'LI' elementer for en liste med overskrift over hvilken informasjon kontaktene holder
      let overskrift = document.createElement('LI');
      // legger til overskrift over søkeresultatene
      overskrift.innerHTML = `<span><b>Fornavn</b></span><span><b>Etternavn</b>
      </span><span><b>Telefonr</b></span><span><b>Epost</b>
      </span><span><b>Gateadresse</b></span><span>
      <b>Postnummer</b></span><span><b>Poststed</b></span>`;
      visAlleKontakter.appendChild(overskrift); // Legger til listen med overskriftene i søkefunskjonen

      // Filtrerer kontaktene så vi kun vil vise de som passser med det som er skrevet.
      Kontakter.kontaktListe.filter(kontakt =>

        // Når du søker på fornavn, etternavn og email gjøres alt til små bokstaver.
        // slik at kontakten som du søker etter, kommer opp uansett
      (kontakt.fornavn.toLowerCase().indexOf(e.target.value.toLowerCase()) > -1 ||
      kontakt.etternavn.toLowerCase().indexOf(e.target.value.toLowerCase()) > -1 ||
      kontakt.email.toLowerCase().indexOf(e.target.value.toLowerCase()) > -1)).forEach(kontakt => {
        // Lager et liste element
        const liste = document.createElement('LI');
        // Legger til alle kontaktene basert på informasjoen fra form
        liste.innerHTML = `<span>${kontakt.fornavn}</span><span>${kontakt.etternavn}</span><span>${kontakt.tlf}</span><span>${kontakt.email}</span>
        <span>${kontakt.gate}</span><span>${kontakt.postnr}</span><span>${kontakt.poststed}</span>`;
        visAlleKontakter.appendChild(liste);
        if (kontaktSøker.value == 0) //Hvis det ikke står noe i søkefeltet blir listen med kontakter og overskrifter fjernet.
          overskrift.innerHTML = '';
        if (kontaktSøker.value == 0) //Hvis det ikke står noe i søkefeltet blir listen med kontakter og overskrifter fjernet.
          liste.innerHTML = '';
      })

      // Hvis du trykker på en kontakt, så skal brukeren komme til et skjema hvor du kan oppdatere kontakten
      document.querySelector('.visKontakter').addEventListener('click', e =>
    {
      if (e.target.tagName == 'SPAN')     // Hvis du trykker på et SPAN element i LI - elementet
      {
        document.querySelectorAll('body>section').forEach(section => { // finner seksjonen

          if (section.id == 'oppdaterKontakt')    // Hvis det er seksjonen for å oppdatere kontakter
          {

            section.classList.add('active');    // Vis seksjonen der du kan redigere kontakt

            Kontakter.kontaktListe.filter(kontakt => // Filtrerer kontaktene
              (kontakt.fornavn.toLowerCase().indexOf(e.target.innerText.toLowerCase()) > -1 ||
            kontakt.etternavn.toLowerCase().indexOf(e.target.innerText.toLowerCase()) > -1 ||
            kontakt.email.toLowerCase().indexOf(e.target.innerText.toLowerCase()) > -1)).forEach(k => {
              // Finner input feltene i seksjonen
              // og setter data inn i input feltet for valgt kontakt
                let id = Kontakter.kontaktListe.indexOf(k, 0);
                section.children[1].id = id;
                section.children[1][0].value = k.fornavn;
                section.children[1][1].value = k.etternavn;
                section.children[1][2].value = k.tlf;
                section.children[1][3].value = k.email;
                section.children[1][4].value = k.gate;
                section.children[1][5].value = k.postnr;
                section.children[1][6].value = k.poststed;
                // Kjører kart funksjon for å vise hvor kontakten bor
                lagKart(k.gate, k.postnr, k.poststed);
              })
          }
          else {
            section.classList.remove('active');   // hvis det er en annen sekjson, avvis seksjonen
          }
        })
      }
      const visAlleKontakter = document.querySelector('.kontaktListe ul'); // Henter kontaktlisten hvor vi vil at kontaktene skal vises
      document.getElementById('kontaktSøker').value = '';   // gjør søkefeltet blank
      visAlleKontakter.innerHTML = '';    // gjør søkelista blank
    })
  })

  // funksjon for å finne og så vise funnet adresse frem på kartet
  function lagKart (adresse, postnr, poststed) {
 // Script for mapbox sine kart
  mapboxgl.accessToken = 'pk.eyJ1Ijoic2tvZ2xpMTIzIiwiYSI6ImNqdjIxMDU5ZDFqamwzem0yNDFtem8xZzQifQ.fOaLKHWGiMW8JUBMhnPS8w';
// eslint-disable-next-line no-undef
    let mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
    mapboxClient.geocoding.forwardGeocode({
      query: `${adresse}, ${postnr}, ${poststed}`, // Finner adresse, postnr og poststed for valgt kontakt.
      autocomplete: false,
      limit: 1
    })
    .send()
    .then(function (response) {
    if (response && response.body && response.body.features && response.body.features.length) {
    let feature = response.body.features[0];

    let map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: feature.center,
      zoom: 10
    });
    new mapboxgl.Marker()
    .setLngLat(feature.center)
    .addTo(map);
  }
  else {
    document.getElementById('map').innerHTML = `'Fant ikke adressen for ${kontakt.fornavn} ${kontakt.etternavn}'`;
    }
  })
 }
})
