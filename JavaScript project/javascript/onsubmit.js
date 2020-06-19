// Istedenfor å ha "onsubmit='javascript: return false'" i alle forms så
// bruker vi denne koden for å legge til "submit" event håndtering for alle forms.
document.querySelectorAll('form').forEach(form=>{
  form.addEventListener('submit', e=>{
    e.preventDefault(); // Ikke submit
    return false;       // Ikke submit, litt dobbelt opp, men noen eldre nettlesere trenger denne
  })
})
