<!DOCTYPE html>
<html>
    <head>
        <title><?php if(isset($data['titre'])) echo $data['title']; else echo "TweetTweet"; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style>
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
                font-weight: bold ;
            }

            li {
                float: left;
                border-right:1px solid #bbb;
            }

            li:last-child {
                border-right: none;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: deepskyblue;
            }

            table, td, th {
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 80%;
                margin: auto;
            }

            th, td {
                padding: 15px;
            }

            input[type=text], input[type=password], textarea, select {
                width: 80%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 50%;
                background-color: dodgerblue;
                color: white;
                padding: 14px 20px;
                margin: auto;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: deepskyblue;
            }

            .form{
                text-align: center;
                margin: auto;
                width :50%;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 40px;
            }

            h1{
                text-align : center;
                color: dodgerblue;
            }

        </style>
    </head>
    <body>
        <?php
            if(isset($parameters['userName']) && $parameters['userName']!="Unknown" ) {
                    echo "<ul><li><a href='/statuses'>TweetTweet</a></li>";
                    echo "<ul style='float:right;list-style-type:none;'>";
                        echo "<li><a href='/logout'>Disconnect</a></li>";
                        echo "<li><a href='#'>".$parameters['userName']."</a></li>";
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