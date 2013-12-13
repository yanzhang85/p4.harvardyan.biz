<section class="content follow">
    <h3> Follow Others </h3>
    <input type="hidden" id="this_player_id" value="<?=$this_player_id?>" >


    <div id="results"></div>
    
    
   
    </div>
        
    <?php foreach($users as $user): ?>
        <article>
             <div id="<?=$user['user_id']?>" style="float:right;display:none;border:1px dotted gray;padding:.3em;background-color:white;width:200px;height:100px;">
                <div align="right">
                    <a href="javascript:hide_popup('my_popup')">close</a>
                </div>
                
                <p><?=$user['first_name']?> <?=$user['last_name']?> invites you for a game.</p>
                <a href="/numbergame/onlineplay/<?=$user['user_id']?>" name="<?=$user['user_id']?>" onclick="Lab(this)">YES</a>
            </div>
            <h4>
            <!-- display this user's profile image -->
            <img class="profile-pic" src="/uploads/avatars/<?=$user['image']?>" alt="<?=$user['first_name']?> <?=$user['last_name']?>">

            <!-- Print this user's name -->
            <?=$user['first_name']?> <?=$user['last_name']?>

            <button type="submit" class="button" id="invitation" value='<?=$user['user_id']?>'>Invite for a match</button> 
            

            </h4>
        </article>
    <?php endforeach; ?>
</section>