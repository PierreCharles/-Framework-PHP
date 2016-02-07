<?php include '/includes/header.php';

if(empty($parameters['status'])){
    echo "<h2>No status posted with this ID yet</h2>";
}
else {
    echo "<table>";
    echo "<tr>";
    echo "<td><strong>" . $parameters['status']->getId() . "</strong></td>";
    echo "<td><strong>" . $parameters['status']->getMessage() . "</strong></td>";
    echo "<td>" . $parameters['status']->getUser() . "</td>";
    echo "<td><form action='/statuses/". $parameters['status']->getId()."' method='POST'><a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a></form></td>";
    echo "</tr>";
    echo "</table>";
}
