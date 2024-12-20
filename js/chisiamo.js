// Funzione per avviare il conteggio
function startCounters() {
  const counters = document.querySelectorAll('.counter');

  counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      let current = 0;
      const increment = target / 100;  // Aggiustare la velocità del conteggio

      const updateCounter = () => {
          if (current < target) {
              current += increment;
              counter.textContent = Math.ceil(current);
              requestAnimationFrame(updateCounter);  // Richiama la funzione ad ogni frame
          } else {
              counter.textContent = target;
          }
      };

      updateCounter();
  });
}
window.addEventListener('load', startCounters);