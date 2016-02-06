<html>
    <body>
        <form action="/login" method="POST">
            <input type="text" name="userName" placeholder="User name"/>
            <input type="password" name="userPassword" placeholder="Password" />
            <p color="red"><?php if(isset($error)) echo $error; ?></p>
            <input type="submit" value="Connection" />
        </form>
    </body>
</html>