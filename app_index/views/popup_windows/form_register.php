<!-- Всплывающее окно с формой регистрации. -->
<div id="Register" class="conteiner-transparent-div">
    <div>
        <form action="/index/register" method="POST" class="form-input-all-available-space">
            <h3 id="msgReg" class="msgForPopupWindow"> <?= $msgForForm?> </h3>
            <fieldset>
                <legend> <h2> Регистрация </h2> </legend>
                <div>
                    <label for="userName" >Имя пользователя: </label>
                    <input type="text" id="userName" name="userName" value="<?php echo $userName ?>" placeholder="Введите имя" required>
                </div>
                <div>
                    <label for="userPassword"> Пароль: </label>
                    <input type="password" id="userPassword" name="userPassword" value="<?php echo $userPassword ?>" placeholder="Введите пароль" required>
                </div>

                <input type="submit" value="Зарегистрироваться" class="btn">
            </fieldset>
        </form>
    </div>
    <a href="#"></a>
</div>