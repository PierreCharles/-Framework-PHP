<html>
    <body>
        <form action="/register" method="POST">
            <p color="red"><?= $error; ?></p>
            <label>User name : </label><input type="text" value="<?php echo $UserName; ?>" name="userName" placeholder="login.."/>
            <label>Password : </label><input type="password" name="userPassword" />
            <input type="submit" value="Register" />
        </form>
    </body>
</html>