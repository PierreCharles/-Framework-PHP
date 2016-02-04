<?php
if(empty($parameters['status']) || count($parameters['status'])<=0){
    echo "<h2>No status posted with this ID yet</h2>";
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
