
<section class="content">

  <h3> Sign Up</h3>

  <form method='POST' action='/users/p_signup'>

  	<input type='text' name='first_name' placeholder="Enter first name" <?php if (isset($_POST['first_name'])) echo "value= '". $_POST['first_name'] ."'"?>><br>
  	<input type='text' name='last_name' placeholder="Enter last name" <?php if (isset($_POST['last_name'])) echo "value= '". $_POST['last_name'] ."'"?>><br>
    <input type='text' name='email' placeholder="Enter email" <?php if (isset($_POST['email'])) echo "value= '". $_POST['email'] ."'"?>><br>
    <input type='password' name='password' placeholder="Enter password"><br>
    <input type='password' name='retype' placeholder="Retype password"><br>
      
      <!-- warn on signup errors -->
      <?php if (isset($error)): ?>
        <div class="error"> Signup failed. 
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

    <div class='button'>  <input type='submit' value='Sign Up'> </div>


  </form>
</section>