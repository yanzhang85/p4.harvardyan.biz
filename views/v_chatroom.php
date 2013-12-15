<section class="content follow">
    <h3> Follow Others </h3>
    <input type="hidden" id="this_user_name" value="<?=$this_user_firstname?> <?=$this_user_lastname?>" >

    
    <?php foreach($users as $user): ?>
        <article>
                        
            <h4>
            <!-- display this user's profile image -->
            <img class="profile-pic" src="/uploads/avatars/<?=$user['image']?>" alt="<?=$user['first_name']?> <?=$user['last_name']?>">

            <!-- Print this user's name -->
            <?=$user['first_name']?> <?=$user['last_name']?>

            
            
            

            </h4>
        </article>
    <?php endforeach; ?>

    <textarea autofocus rows="8" cols="100" readonly id="chat_history"></textarea>


    <input type="text" name="chat" id="chat">  
        
    <button id="chat_submit"></button>
    </form>






</section>