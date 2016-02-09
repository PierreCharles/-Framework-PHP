<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($data['titre'])) echo $data['title']; else echo "TweetTweet"; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="./css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            if(isset($parameters['user']) && $parameters['user']!="Unregister User"
                && isset($_SESSION['is_connected']) && $_SESSION['is_connected']) {
                    echo "<ul><li><a href='/statuses'>TweetTweet</a></li>";
                    echo "<ul style='float:right;list-style-type:none;'>";
                        echo "<li><a href='/statuses?id=".$parameters['user']."'>".$parameters['user']."</a></li>";
                        echo "<li><a href='/logout'>Disconnect</a></li>";
                    echo"</ul></ul>";
            }
            else{
                echo "<ul><li><a href='/statuses'>TweetTweet</a></li>";
                    echo "<ul style='float:right;list-style-type:none;'>";
                        echo "<li><a href='/login'>Log in</a></li>";
                        echo "<li> <a href='/register'>Register</a></li>";
                    echo"</ul>";
                echo "</ul>";
            }
            ?>


<br/>