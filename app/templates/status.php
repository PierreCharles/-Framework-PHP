<?php
if(empty($parameters['status'])){
    echo "<h2>No status posted with this ID yet</h2>";
}
else {
    echo "<table>";
    echo "<tr>";
    echo "<td><strong>" . $parameters['status']['id'] . "</strong></td>";
    echo "<td><strong>" . $parameters['status']['user'] . "</strong></td>";
    echo "<td>" . $parameters['status']['message'] . "</td>";
    echo "<td><form action='/statuses/". $parameters['status']['id']."' method='POST'><a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a></form></td>";
    echo "</tr>";
    echo "</table>";
}
