document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    const nome = document.getElementById("nome").value;
    const cognome = document.getElementById("cognome").value;
    const email = document.getElementById("email").value;
    const messaggio = document.getElementById("messaggio").value;

    if (/spam|advertisement|malicious/.test(messaggio.toLowerCase())) {
      event.preventDefault();
      alert("Il messaggio contiene contenuti non consentiti.");
      return;
    }
  });
