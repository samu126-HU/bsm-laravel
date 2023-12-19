document.addEventListener('DOMContentLoaded', function() {
  const cardCheckbox = document.getElementById('card');
  const cashCheckbox = document.getElementById('cash');
  const cardDataDiv = document.getElementById('carddata');

  let element = document.createElement('span')
  
  element.innerHTML = `
          <div class="form-group my-2">
              <label for="cardNumber">Kártyaszám:</label>
              <input type="number" class="form-control" id="cardNumber" name="cardNumber" placeholder="Kártyaszám" required autocomplete="cc-number">
          </div>
          <div class="form-group my-2">
              <label for="cardName">Név:</label>
              <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Kártya tulajdonos neve" required autocomplete="cc-name">
          </div>
          <div class="row my-2">
              <div class="col-6">
                  <label for="cardExpiry">Lejárati dátum:</label>
                  <input type="number" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required autocomplete="cc-exp">
              </div>
              <div class="col-6">
                  <label for="cardCVC">CVC:</label>
                  <input type="number" class="form-control" id="cardCVC" name="cardCVC" placeholder="CVC" required autocomplete="cc-csc">
              </div>
          </div>
      </div>

  `;

  cardCheckbox.addEventListener('click', function() {
    cardDataDiv.appendChild(element)
  });
  cashCheckbox.addEventListener('click', function() {
    cardDataDiv.removeChild(element)
  });
});


