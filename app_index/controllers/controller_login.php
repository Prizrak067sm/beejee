<?php
    // Контроллер для авторизации пользователя. Не рендерит страниц. Делает редирект.
    class controller_login extends Controller
    {
        function __construct()
        {
            $this->model = new model_login();
        }

        function action_default()
        {
            // --- Получаем введенные пользователем данные для авторизации. Сохраняем в
            //     массив, чтобы удобно было передать в модель в случае расширения данных. ---
            $userData['userName'] = $_POST['userName'];
            $userData['userPassword'] = $_POST['userPassword'];
            // --------------------------------------------------------------------------------

            $userCorrect = $this->model->userCorrect($userData);   // Отправляем данные для аутентификации в модель. Она вернет true в случае успеха входа.

            // --- Если модель "дала добро", заносим имя в сессию. Это всегда будет означать,
            //   что клиент совершил вход. А также делаем редирект на главную.
            if ($userCorrect)
            {
                $_SESSION['userName'] = $userData['userName'];
                header("Location: /index");
            }
            else   // Если модель отказала во входе, то введенные данные сохраняем в сессию,
                   // чтобы они могли быть заполнены в форме входа. А также делаем редирект на форму входа. ---
            {
                $_SESSION['invalidDataFromForm'] = array('userName'=>$userData['userName'], 'userPassword'=>$userData['userPassword'], 'msg'=>'Неверные имя пользователя и/или пароль');
                header("Location: /index/#LogIn");
            }
            // ------- Конец if. -------------------------------------------------------------------------------
        }
    }
?>