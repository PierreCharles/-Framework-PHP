<?php include '/includes/header.php';

if (empty($parameters['status']) || count($parameters['status']) <= 0) {
    echo '<h2>No status posted yet</h2>';
} else {
    echo '<table>';
    echo '<tr><td>ID</td><td>User</td><td>Message</td><td>Date</td><td>Action</td></tr>';

        echo '<tr>';
        echo '<td>'.$parameters['status']->getId().'</td>';
        echo '<td><strong>'.$parameters['status']->getUser().'</strong></td>';
        echo '<td>'.$parameters['status']->getMessage().'</td>';
        echo '<td>'.$parameters['status']->getDate().'</td>';
        if (isset($parameters['user']) && $parameters['user'] == $parameters['status']->getUser() &&  $parameters['user'] != 'Unregister User') {
            echo "<td><form action='/statuses/".$status->getId()."' method='POST'>";
            echo "<a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a>";
            echo '</form></td>';
        }
        echo '</tr>';
    echo '</table>';
}
include 'includes/footer.php';
