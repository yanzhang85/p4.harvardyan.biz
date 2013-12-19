<section class="content login">
    <h3>Log in</h3>

    <form method='POST' action='/users/p_login'>

        <input type='text' name='email' placeholder="Email, please.">
        <input type='password' name='password' placeholder="Password, please.">

        <div class='message error'>
            <?php if($error=='error1'): ?>
                Login failed. Email is incorect. 
            <?php endif; ?>

            <?php if($error == 'error2'): ?>
               Login failed. Password is incorect. 
            <?php endif; ?>
        </div>
        
        <div class= 'button'><input type='submit' value='Log in'></div>
    </form>
</section>