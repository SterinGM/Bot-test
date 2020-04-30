<h2>Мой кабинет</h2>

Пользователь: <strong><?php echo $username ?></strong> <br />
Баланс: <strong><?php echo $balance ?></strong> <br />

<form action="/main/withdraw" method="post">
    <div style="color: #ff0000"><?php echo $error ?></div>

    <br />

    <label for="amount">
        Сумма для вывода
        <input type="text" name="amount">
    </label>

    <input type="hidden" name="token" value="<?php echo $token ?>">

    <button type="submit">Вывести</button>
</form>

<br />

<form action="/user/logout" method="post">
    <button>Выйти из кабинета</button>
</form>