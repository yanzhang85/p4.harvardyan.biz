<section class="content chatroom">
    <h3> Chatroom </h3>
    <input type="hidden" id="this_user_name" value="<?=$this_user_firstname?> <?=$this_user_lastname?>" >

    <div id="online_list">
        <h4>Users in The Room</h4>
        <?php foreach($users as $user): ?>
            <article>
                <!-- display this user's profile image -->
                <img class="chat-pic" src="/uploads/avatars/<?=$user['image']?>" alt="<?=$user['first_name']?> <?=$user['last_name']?>"> 

                <!-- Print this user's name -->
                <?=$user['first_name']?> <?=$user['last_name']?>   
            </article>
        <?php endforeach; ?>
    </div>

    <textarea autofocus rows="15" cols="68" readonly id="chat_history" placeholder="Here shows chat history."></textarea>
    
    <p id="chat_input">
        Your message here: <input type="text" name="chat" id="chat">  
            
        <button id="chat_submit">Enter</button>
    </p>
    
</section>