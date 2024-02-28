if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


function showPopup(message) {
    // Vytvoření nového divu pro vyskakovací okno
    var popupContainer = document.createElement('div');
    popupContainer.classList.add('popup-container');
  
    // Obsah vyskakovacího okna
    var popupContent = document.createElement('div');
    popupContent.classList.add('popup-content');
    
    // Tlačítko pro zavření okna
    var closeButton = document.createElement('span');
    closeButton.classList.add('close-btn');
    closeButton.innerHTML = '&times;'; // Symbol 'x'
    closeButton.onclick = function() {
      document.body.removeChild(popupContainer); // Odstranění vyskakovacího okna po kliknutí na tlačítko
    };
  
    // Zobrazení zprávy v okně
    var messageElement = document.createElement('p');
    messageElement.textContent = message;
  
    // Přidání obsahu do okna
    popupContent.appendChild(closeButton);
    popupContent.appendChild(messageElement);
    popupContainer.appendChild(popupContent);
  
    // Přidání vyskakovacího okna do těla stránky
    document.body.appendChild(popupContainer);
  }


  