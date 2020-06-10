<!-- Всплывающее окно с сообщением после регистрации. -->
<div class="conteiner-transparent-div conteiner-msg">
    <div>
        <?php
            if (isset($userNameReg))   // Если контроллер передал переменную с именем, значит, регистрация прошла успешно.
            {
               echo "<h3> Вы успешно зарегистрировались, Ваше имя $userNameReg </h3>";
            }
            elseif (isset($errorReg))
            {
                echo "<h3> При регистрации произошла следующая ошибка: $errorReg </h3>";
            }
        ?>
    </div>

    <a href="/index"></a>
</div>


