
// Objekter i denne klassen blir brukt til å kunne lagre kontakter i en kontaktliste på egen server og lokalt i nettleseren
//  Objektet blir hentet fra serveren og hver gang et et objekt av klassen opprettes
// oppdateres serveren for hver gang en ny kontakt blir lagt til i serveren.
// Kontaktene som har blitt opprettet kan også bli oppdatert og redigert.


// printer tilbakemelding om kontakten er lagt til
const alert = document.querySelector('.printAlert');
const alert2 = document.querySelector('.printAlert2');


class Kontakt {

  /**
  *Oppretter en ny kontaktliste og henter informasjon fra kontaktliste fra egen server 'http://folk.ntnu.no/oeivindk/imt1441/storage/'.
  * kontaktene blir lagret på egen liste 'olet_kontaktRegisteret'.
  *metoden _finnKontakt(); blir brukt til å vise frem alle kontaktene i nettleseren og på HTML siden.
      *@param {String} kontaktListeSelektor er brukt til å vise de unummererte kontaktene i listem.
  */
  constructor (kontaktListeSelektor) { // i constructoren legges det til funksjonene og metodene som blir brukt i denne klassen.
    this._kontaktli = document.querySelector(kontaktListeSelektor);
    this._kontaktListe = []; // tømmer den nåværende kontaktlisten.
    this._storeURL = 'http://folk.ntnu.no/oeivindk/imt1441/storage/'; // server hvor kontaktene skal lagres.
    this._kontaktListeID = 'olet_kontaktRegisteret'; // kontaktene lagres på min liste på serveren
    this._finnKontakt(); // Henter kontaktene fra serveren

}
  // ved å bruke get kontaktListe henter vi alle kontaktene fra serveren
  get kontaktListe() {
    return this._kontaktListe; // Returnerer kontaktlisten fra server
  }
  set kontaktListe(updateContact) { // Set for å oppdatere kontaktlisten på server
    this._kontaktListe = updateContact;
  }

  /*
  * leggTilKontakt lager ny kontakt ved hjelp av informasjonen
  * som er skrevet inn i input feltene på legg til kontakt siden.
  */

  leggTilKontakt(forNavn, etterNavn, tlf, email, gate, postnr, poststed) {
    // nytt objekt og kontakt opprettes
    const newContact = {
      fornavn: forNavn,
      etternavn: etterNavn,
      tlf: tlf,
      email: email,
      gate: gate,
      postnr: postnr,
      poststed: poststed
    }
    const kontaktIndex1 = this._kontaktListe.map(k => k.fornavn).indexOf(forNavn)
    // hvis kontakten er større en -1 legges det til kontakt
    if (kontaktIndex1 == -1) {
      // legger til på lokalt
      this._kontaktListe.push(newContact);
      // legger til kontakt på server
      this._kontaktPåServer(newContact);

    }
    // Hvis du ikke har skrevet inn noe i input feltet, printes det en påminnende melding på siden
    if (fornavn.value.length == 0) {
      alert.innerHTML = "Ikke glem å skrive inn ditt fornavn!!";
    } else {
      alert.innerHTML = " Du har ikke lov til å ha samme fornavn!!";  // Printer melding ved samme fornavn som lagret tidligere.
    }
  }

  /*
  * _kontaktPåServer funksjonen legger til kontakter på serveren
  * Printer melding på forsiden når du har lagt til kontakt
  */
  _kontaktPåServer(kontakt) {
    const formData = new FormData(); // lager ny form data.
    formData.append('store', this._kontaktListeID);
    formData.append('data', JSON.stringify(kontakt));
    // legger til data på server
    fetch(`${this._storeURL}add.php`,
    {
      method: "POST",
      body: formData
    })
    .then(res=> res.json())
    .then(data => {
      console.log(data);
      alert.innerHTML = `DU har nå lagt til ${kontakt.fornavn} ${kontakt.etternavn} på serveren!!`;
    })
  }

  /*
  * oppdaterKontakt henter dataen som er satt inn
  * i input feltet og oppdaterer dem på serveren
  */

  oppdaterKontakt(idToUpdate, forNavn, etterNavn, tlf, email, gate, postnr, poststed) {
    const updateContact = {
      fornavn: forNavn,
      etternavn: etterNavn,
      tlf: tlf,
      email: email,
      gate: gate,
      postnr: postnr,
      poststed: poststed
    }
    // oppdaterer kontakten
    this._oppdatertServer(updateContact, idToUpdate);
  }
  /*
  * Funksjon _oppdaterServer finner indexen til kontakten og
  * oppdaterer
  */
  _oppdatertServer(kontakt, idToUpdate) {
    const formData = new FormData(); // lager ny form data.
    formData.append('store', this._kontaktListeID);
    formData.append('idx', idToUpdate); // setter id for hva som skal oppdateres
    formData.append('data', JSON.stringify(kontakt));
    formData.forEach(val => { // Finner hver enkel value fra formen
    })
    // oppdaterer til data på server
    fetch(`${this._storeURL}set.php`,
    {
      method: "POST",
      body: formData
    })
    .then(res=> res.json())
    .then(data => {
      //console.log(data);
      alert2.innerHTML = `DU har nå oppdatert ${kontakt.fornavn} ${kontakt.etternavn} på serveren!!`;
    })
  }
  // funksjon for å hente frem kontaktene fra server
  _finnKontakt() {
    fetch(`${this._storeURL}getAll.php?store=${this._kontaktListeID}`) // vi finner kontakt og henter den fra server.
      .then(res=>res.json())
      .then(data => {
        // hvis dataen fra server blir hentet ut riktig
        if (data.status == "SUCCESS") {
          // bruk data som en samling av kontaker
          this._kontaktListe = data.data;
        }
        else {
          // hvis dataene er feil, brukes det en tom samling
          this._kontaktListe = [];
        }
      })
      }
    }
  // Klassen kontakt er avsluttet
