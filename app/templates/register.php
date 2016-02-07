<?php include '/includes/header.php'; ?>
<div class="form">
        <form action="/register" method="POST">
            <p color="red"><?php if(isset($error)) echo $error ?></p>
            <label>User name : </label><input type="text" value="<?php if(isset($userName)) echo $userName ?>" name="userName" placeholder="User name"/>
            <label>Password : </label><input type="password" name="userPassword" />
            <label>Confirmation : </label><input type="password" name="userPasswordConfirm" />
            <input type="submit" value="Register" />
        </form>
</div>