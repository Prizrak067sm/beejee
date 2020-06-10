<?php
    // Контроллер совершает выход клиента - удаляет из сессии имя. А также редирект на главную.
    class controller_logout extends Controller
    {
        function action_default()
        {
            unset($_SESSION['userName']);
            header("Location: /index");
        }
    }
?>