<section class="content guess">
    <h3>Guess my number (pratice version)</h3>
        
    <div id="features">
      <h4> Features: </h4>
      <ul>
        <li>Unlimited times of guesses</li>
        <li>Show whether every position is correct or not after every guess ("T": Ture, "F": False)</li>
        <li>One hint available: grey out your guessed numbers that are not in the answer if none of the positions is correct</li>
      </ul>
    </div>
    <div id='results'></div>
    <div id="take_guess">
      Pick a number <br>between 10000 and 99999: <br>
      <input type='text' name='guess' onkeypress="if (isNaN(String.fromCharCode(event.keyCode) )) return false;" maxlength ="8"/>
      <button id='guess_practice'>Guess</button>
      <div id='error'></div>

      <p> Scratchpad:<br>
        <textarea rows="3" cols="20" ></textarea><br>
      </p>
    </div>


    <div id='history'>
      Your past guesses: <br>
      <div id='guesses'></div>
    </div>

    <p id='hint'>Available choices</p> 
    <div id='number'></div>
</section>