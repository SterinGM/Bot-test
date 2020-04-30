<h1>Авторизация</h1>

<form action="/user/login" method="post">
    <div style="color: #ff0000"><?php echo $error ?></div>

    <br />

    <label for="username">Имя пользователя</label>
    <label>
        <input type="text" name="username">
    </label>

    <br />

    <label for="password">Пароль</label>
    <label>
        <input type="password" name="password">
    </label>

    <br /><br />

    <input type="hidden" name="token" value="<?php echo $token ?>">

    <button type="submit">Войти в систему</button>
</form>