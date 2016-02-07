<?php include '/includes/header.php'; ?>

    <h1>Register</h1>

    <div class="form">
            <form action="/register" method="POST">

                <label>User name : </label>
                <?php
                if (isset($parameters['error']['user'])) {
                    echo "<input name='user' type='text' size='50' value='' style='background-color:indianred;'/><br/>";
                    echo '<span style="color:red; float:right; font-size:14px;">' . $parameters['error']['user'] . '</span><br/>';
                } else {
                    echo "<input name='user' type='text' size='50' />";
                }
                ?>

                <label>Password : </label>
                <?php
                if (isset($parameters['error']['password'])) {
                    echo "<input name='password' type='password' size='50' value='' style='background-color:indianred;'/><br/>";
                    echo '<span style="color:red; float:right; font-size:14px;">' . $parameters['error']['password'] . '</span><br/>';
                } else {
                    echo "<input name='password' type='password' size='50' />";
                }
                ?>

                <label>Confirmation : </label>
                <?php
                if (isset($parameters['error']['confirm'])) {
                    echo "<input name='confirm' type='password' size='50' value='' style='background-color:indianred;'/><br/>";
                    echo '<span style="color:red; float:right; font-size:14px;">' . $parameters['error']['confirm'] . '</span><br/>';
                } else {
                    echo "<input name='confirm' type='password' size='50' />";
                }
                ?>

                <br/><br/>

                <input type="submit" value="Register" />
            </form>
    </div>
    <br/>
<?php include '/includes/footer.php'; ?>

