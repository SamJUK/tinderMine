<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('app/tinderMine.php');

$tinderWeb = new tinderWeb();
$users = $tinderWeb->getUsers();


?>
<style>
    .users .user .imgs img{
        height: 75px;
        width: 75px;
    }
    .users .user .imgs li{
        display: inline-block;
    }
    .ghetto-lightbox{
        opacity: 0;
        pointer-events: none;
        position: fixed;
        top: 0;
        left: 0;
        background: rgba(0,0,0,.5);
        height: 100%;
        width: 100%;
        z-index: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: .3s;
    }
    .ghetto-lightbox.show{
        opacity: 1;
        pointer-events: inherit;
    }
    .ghetto-lightbox img{
        max-width: 90%;
        max-height: 90%;
    }
</style>
<ul class="users">
<?php foreach($users as $user): ?>
    <li class="user">
        <h1><?php echo $user['name']; ?></h1>
        <ul class="imgs">
            <?php foreach($user['photos'] as $photo): ?>
                <li>
                    <img class='user-picture' src="<?php echo $photo['url']; ?>"/>
                    <p>0 Matches</p>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
<?php endforeach; ?>
</ul>


<div class="ghetto-lightbox">
    <img src=""/>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('.user-picture').click(function(){
            var img = $(this).attr('src');
            toggleLightBox(img);
        });

        $('.ghetto-lightbox').click(function(){
            toggleLightBox();
        });

    });
    
    function toggleLightBox(img) {
        if($('.ghetto-lightbox').hasClass('show')){
            $('.ghetto-lightbox').removeClass('show');
        }else{
            $('.ghetto-lightbox').find('img').attr('src', img);
            $('.ghetto-lightbox').addClass('show');
        }
    }
</script>