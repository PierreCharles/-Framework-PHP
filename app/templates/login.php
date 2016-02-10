<?php include '/includes/header.php'; ?>
<h1>Log in</h1>

<div class="form">
    <form action="/login" method="POST">
        <?php
        if (isset($parameters['user'])) {
            echo "<input type='text' value='".$parameters['user']."' name='user' placeholder='User name'/>";
        } else {
            echo "<input type='text' name='user' placeholder='User name'/>";
        }
        if (isset($parameters['password'])) {
            echo "<input type='password' name='password' value='".$parameters['password']." placeholder='Password' />";
        } else {
            echo "<input type='password' name='password' placeholder='Password' />";
        }
        ?>
        <p color="red"><?php if (isset($parameters['error'])) {
    echo "<p style='color:red'>".$parameters['error'];
} ?></p>

        <input type="submit" value="Connection" />
    </form>
</div>

<?php include '/includes/footer.php'; ?>