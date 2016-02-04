
<h1>Welcome on TweetTweet</h1>

<form action="status" method="POST">
    <input type="hidden" name="_method" value="POST">

    <label for="user">Your Name</label>
    <input type="text" name="user">

    <label for="message">Your message:</label>
    <textarea name="message"></textarea>

    <input type="submit" value="Submit">
</form>

<?php

if(empty($parameters['status']) || count($parameters['status'])<=0){
    echo "<h2>No status posted yet</h2>";
}
else {
    echo "<table>";
    foreach ($parameters['status'] as $id => $status) {
        echo "<tr>";
        echo "<td><strong>" . $status['user'] . "</strong></td>";
        echo "<td>" . $status['message'] . "</td>";
        echo "<td><form action='/status/".$id."' method='POST'><a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a></form></td>";
        echo "</tr>";
    }
    echo "</table>";
}
