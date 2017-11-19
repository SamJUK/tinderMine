<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('app/tinderMine.php');
$tinderWeb = new tinderWeb();

$users = $tinderWeb->getUsers();
?>
<html>
    <head>
        <title>Users :: TinderMine</title>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/latest/slick.css"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="style.css" rel="stylesheet"/>
    </head>
    <body>
        <ul class="users">
        <?php foreach($users as $user): ?>
            <li class="user"
                data-age = "<?php echo tinderWeb::getAge($user['birth_date']); ?>"
                data-distance = "<?php echo $user['distance_mi']; ?>"
            >
                <div class="profile-pictures">
                    <?php foreach($user['photos'] as $photo): ?>
                    <img src="<?php echo $photo['url']; ?>"/>
                    <?php endforeach; ?>
                </div>
                <h1><?php echo $user['name']; ?></h1>

                <div class="distance">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 width="430.114px" height="430.114px" viewBox="0 0 430.114 430.114" style="enable-background:new 0 0 430.114 430.114;"	 xml:space="preserve"><g>	<path id="Facebook_Places" d="M356.208,107.051c-1.531-5.738-4.64-11.852-6.94-17.205C321.746,23.704,261.611,0,213.055,0		C148.054,0,76.463,43.586,66.905,133.427v18.355c0,0.766,0.264,7.647,0.639,11.089c5.358,42.816,39.143,88.32,64.375,131.136		c27.146,45.873,55.314,90.999,83.221,136.106c17.208-29.436,34.354-59.259,51.17-87.933c4.583-8.415,9.903-16.825,14.491-24.857		c3.058-5.348,8.9-10.696,11.569-15.672c27.145-49.699,70.838-99.782,70.838-149.104v-20.262		C363.209,126.938,356.581,108.204,356.208,107.051z M214.245,199.193c-19.107,0-40.021-9.554-50.344-35.939		c-1.538-4.2-1.414-12.617-1.414-13.388v-11.852c0-33.636,28.56-48.932,53.406-48.932c30.588,0,54.245,24.472,54.245,55.06		C270.138,174.729,244.833,199.193,214.245,199.193z"/></g></svg>
                    <span><?php echo $user['distance_mi']; ?> Mile away</span>
                </div>
                <span><?php echo tinderWeb::getAge($user['birth_date']); ?> Years Old</span>
                <div class="button-set">
                    <a href="user.php?id=<?php echo $user['_id']; ?>">View More</a>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/latest/slick.min.js"></script>
        <script>
            $(document).ready(function (){

                $('.profile-pictures').slick({
                    dots: false,
                    autoplay: false,
                    speed: 300,
                    arrows: false
                });

                var hoverInt = null;
                $('.profile-pictures').mouseenter(function(){
                    if(hoverInt !== null)
                        clearInterval(hoverInt);

                    $(this).slick('slickNext');
                    hoverInt = setInterval(function(elm){
                        elm.slick('slickNext');
                    }, 1000, $(this));
                });

                $('.profile-pictures').mouseleave(function(){
                    if(hoverInt !== null)
                        clearInterval(hoverInt);

                    $(this).slick('slickGoTo', 0);
                });
            });
        </script>
    </body>
</html>