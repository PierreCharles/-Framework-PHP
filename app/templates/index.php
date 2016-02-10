<?php include '/includes/header.php'; ?>

<h1>Write a tweet</h1>

<div class="form">
    <form action="statuses" method="POST">
        <?php if (isset($parameters['user']) && $parameters['user'] != 'Unregister User'
            && isset($_SESSION['is_connected']) && $_SESSION['is_connected']) {
    echo "<input type = 'text' name='user' value='".$parameters['user']."' readonly>";
} else {
    echo "<input type = 'text' name = 'user' value ='Unregister User' placeholder='Unregister User' readonly>";
}
        ?>
        <textarea name="message" placeholder='Write a message limited to 140 characters...' maxlength="140" onkeyup="left(this.value)"></textarea>
        <br/>
        <p><span style="text-align:center; color:dodgerblue;" id="characteres"></span></p>
        <script type="text/javascript">
            function left(message){
                document.getElementById('characteres').innerHTML=140-message.length+" characters again";
            }
        </script>
        <p color="red"><?php if (isset($parameters['error'])) {
    echo "<p style='color:red'>".$parameters['error'];
} ?></p>

        <input type="submit" value="Tweet">
    </form>
</div>
<br/>

<?php
if (empty($parameters['status']) || count($parameters['status']) <= 0) {
    echo '<h2>No status posted yet</h2>';
} else {
    echo '<table>';
    echo '<tr><td>ID</td><td>User</td><td>Message</td><td>Date</td><td>Action</td></tr>';
    foreach ($parameters['status'] as $status) {
        echo '<tr>';
        echo '<td>'.$status->getId().'</td>';
        echo '<td><strong>'.$status->getUser().'</strong></td>';
        echo '<td>'.$status->getMessage().'</td>';
        echo '<td>'.$status->getDate().'</td>';
        if (isset($parameters['user']) && $parameters['user'] == $status->getUser() &&  $parameters['user'] != 'Unregister User') {
            echo "<td><form action='/statuses/".$status->getId()."' method='POST'>";
            echo "<a href='#'> <input type='hidden' name='_method' value='DELETE'> <input type='submit' value='X'></a>";
            echo '</form></td>';
        }

        echo '</tr>';
    }
    echo '</table>';
}
include 'includes/footer.php';
