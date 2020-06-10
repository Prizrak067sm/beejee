<!-- Всплывающее окно с формой входа. -->
<div id ="LogIn" class="conteiner-transparent-div">
    <div>
        <form action="/index/login" method="POST" class="form-input-all-available-space">
            <h3 id="msgLog" class="msgForPopupWindow"> <?= $msgForForm?> </h3>
            <fieldset>
                <legend> <h2> Авторизация </h2> </legend>
                <div>
                    <label for="userName" >Имя пользователя: </label>
                    <input type="text" id="userName" name="userName" value="<?= $userName ?>" placeholder="Введите имя" required>
                </div>
                <div>
                    <label for="userPassword"> Пароль: </label>
                    <input type="password" id="userPassword" name="userPassword" value="<?= $userPassword ?>" placeholder="Введите пароль" required>
                </div>

                <input type="submit" value="Авторизоваться" class="btn">
            </fieldset>
        </form>
    </div>
    <a href="#"></a>
</div>