<html>
    <body>
        <form action="/login" method="POST">
            <input type="text" name="userName" placeholder="login.."/>
            <input type="password" name="userPassword" />
            <p color="red"><?= $error; ?></p>
            <input type="submit" value="Connection" />
        </form>
    </body>
</html>