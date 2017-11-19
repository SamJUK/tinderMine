<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('app/tinderMine.php');
$tinderWeb = new tinderWeb();

if(!isSet($_GET['id']) || !$tinderWeb->userExists($_GET['id']))
    die('Need user id');

$userJson = $tinderWeb->user($_GET['id']);
?>
<html>
<head>
    <title><?php echo $userJson['name']; ?> :: TinderMine</title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/latest/slick.css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class="profile">
        <div class="profile-pictures">
            <?php foreach($userJson['photos'] as $photo): ?>
            <img src="<?php echo $photo['url']; ?>"/>
            <?php endforeach; ?>
        </div>
        <h1><?php echo $userJson['name']; ?></h1>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/latest/slick.min.js"></script>
    <script>
        $(document).ready(function (){

            $('.profile-pictures').slick({
                variableWidth: true,
                autoplay: false,
                speed: 500,
                fade: true,
                cssEase: 'linear',
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

