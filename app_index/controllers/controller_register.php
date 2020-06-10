<?php
    class controller_register extends Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->model = new model_register();
        }

        function action_default()
        {
            // --- Получаем введенные пользователем данные для регистрации. Сохраняем в
            //     массив, чтобы удобно было передать в модель в случае расширения данных. ---
            $userData['userName'] = $_POST['userName'];
            $userData['userPassword'] = $_POST['userPassword'];
            // --------------------------------------------------------------------------------

            $result_reg = $this->model->reg_user($userData);   // Отправляем данные для регистрации и получаем массив с результатами.

            if ($result_reg['existUser'])   // Если пользователь с введенным именем уже есть, сохраняем данные в сессию и редирект на форму регистрации, где должны заполниться данные из сессии.
            {
                $_SESSION['invalidDataFromForm'] = array('userName'=>$userData['userName'], 'userPassword'=>$userData['userPassword'], 'msg'=>'Такой пользователь существует. Придумайте другое имя пользователя.');
                header("Location: /index/#Register");
                exit;
            }

            if ($result_reg['userReg'])   // Если модель вернула этот элемент с истиной - регистрация успешна.
            {
                $this->data_for_view['userNameReg'] = $_POST['userName'];   // Сохраняем введенное имя в массив для передащи во вьюшку.
            }
            elseif ($result_reg['error'])   // Если модель вернула этот элемент - есть ошибка..
            {
                $this->data_for_view['errorReg'] = $result_reg['error'];   // Сохраняем полученную ошибку в массив для передачи во вьюшку.
            }

            // ------- Откроем главную страницу, вызвав соответствующий контроллер,
            //         чтобы далее поверх него открылось всплывающее окно с сообщением. ---
            include Route::$dir_app.'/models/model_main.php';   // Подключаем файл с моделью, так как объект контроллера главной страницы будет взаимодействовать с моделью для отображения задач.
            $main = new controller_main();
            $main->action_default();
            // -----------------------------------------------------------------------------
            $this->view->generate("/popup_windows/msg_register.php", "", $this->data_for_view);   // Всплывающее окно с сообщением.
        }
    }
?>