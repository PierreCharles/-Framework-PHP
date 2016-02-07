<?php include '/includes/header.php'; ?>

<h1>Write a message</h1>

<div class="form">
    <form action="statuses" method="POST">
        <input type="hidden" name="_method" value="POST">
        <?php if(isset($parameters['userName']) && $parameters['userName']!="Unknown" ) {
            echo "<input type = 'hidden' name = 'userName' value='".$parameters['userName']."'>";
            }else {
                echo "<input type = 'text' name = 'userName' placeholder='Unregister User'>";
            }
        ?>
        <br/>
        <textarea name="message" placeholder='Write a message limited to 140 characters...'></textarea>
        <input type="submit" value="Submit">
    </form>
</div>
<br/>

<?php
if(empty($parameters['status']) || count($parameters['status'])<=0){
    echo "<h2>No status posted yet</h2>";
} else {
    echo "<table>";
    echo "<tr><td>ID</td><td>User</td><td>Message</td><td>Date</td></tr>";
    foreach ($parameters['status'] as $status) {
        echo "<tr>";
        echo "<td>".$status->getId()."</td>";
        echo "<td><strong>" . $status->getUser() . "</strong></td>";
        echo "<td>" . $status->getMessage() . "</td>";
        echo "<td>" . $status->getDate() . "</td>";
        if(isset($parameters['userName']) && $parameters['userName']==$status->getUser() ){
            echo "<td><form action='/statuses/".$status->getId()."' method='POST'>";
            echo "<a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a>";
            echo "</form></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}

include 'includes/footer.php';
