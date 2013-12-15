<h1>Guess my number</h1>
    
    <div id="change_version">Ready for <a href="/match_version.php">a match</a>? </div>
    <h2> (Practice Version) </h2>
    
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
        <textarea></textarea><br>
      </p>
    </div>

    
    <div id='history'>
      Your past guesses: <br>
      <div id='guesses'></div>
    </div>

    <p id='hint'>Available choices</p> 
    <div id='number'></div>