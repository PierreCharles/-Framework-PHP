
<h1>Welcome on TweetTweet</h1>

<form action="statuses" method="POST">
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
    echo "<tr><td>ID</td><td>User</td><td>Message</td></tr><td>Date</td>";
    foreach ($parameters['status'] as $status) {
        echo "<tr>";
        echo "<td>".$status->getId()."</td>";
        echo "<td><strong>" . $status->getUser() . "</strong></td>";
        echo "<td>" . $status->getMessage() . "</td>";
        echo "<td>" . $status->getDate() . "</td>";
        echo "<td><form action='/statuses/".$status->getId()."' method='POST'>";
        echo "<a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a>";
        echo "</form></td>";
        echo "</tr>";
    }
    echo "</table>";
}
