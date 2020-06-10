<?php
    session_start();
    class Controller
    {
        public $model;
        public $view;
        protected $data_for_view;
        public $template = 'base_view.php';   // Имя базовой вьюшки(в нее будут включаться остальные вьюшки с контентом).

        function __construct()
        {

            $this->view = new View(Route::$dir_app);  // Экземпляр класса из файла core/view.php.
            // --- Если были отправлены данные для входа или регистрации
            //     и они не подошли, о чем свидетельствует переменная сессии. ---
            if (isset($_SESSION['invalidDataFromForm']))
            {
                $this->dataForFormUser($_SESSION['invalidDataFromForm']);
                unset($_SESSION['invalidDataFromForm']);
            }
            // -------------------------------------------------------------------

            $this->data_for_view['loginCompleted'] = $this->loginCompleted();   // Совершен ли вход.
            $this->data_for_view['userNameWel'] = $this->setUserName();   // Переменная с именем пользователя. Если не вошел, будет - гость.
        }

        // --- Стандартный экшен. Если он не будет переопределен в наследниках, то будет вывод 404 страницы.
        //     Типа нет реализации метода. Может возникнуть, если в строке запроса только имя контроллера.
        //     Эта ситуация должна быть обработана в методе action_default() наследника. ---
        function action_default()
        {
            Route::error_page404();
        }
        // ------------------------------------

        // --- Возвращает совершен ли вход. Определяется по наличию элемента с именем юзера в сессии. ---
        function loginCompleted()
        {
            return empty($_SESSION['userName']) ? FALSE : TRUE;
        }
        // -----------------------------------------------------------------------------------------------

        // --- Возвращает имя юзера. Если имя юзера нет в сессии - вход не совершен, тогда вернет "Гость". ---
        function setUserName()
        {
            return empty($_SESSION['userName']) ? 'Гость' : $_SESSION['userName'];
        }
        // ---------------------------------------------------------------------------------------------------

        // --- Добавляет в массив элементов(потом станут переменными) для вьюшки данные
        //     с формы регистрации/входа, при неудачи. Чтобы они добавились в форму для редактирования. ---
        function dataForFormUser(&$invalidDataFromForm)
        {
            $this->data_for_view['userName'] = $invalidDataFromForm['userName'];
            $this->data_for_view['userPassword'] = $invalidDataFromForm['userPassword'];
            $this->data_for_view['msgForForm'] = $invalidDataFromForm['msg'];
        }
        // -------------------------------------------------------------------------------------------------

        // --- Определяет админ юзер или нет. По имени в сессии. ---
        protected function is_admin()
        {
            $result = (strtolower($this->setUserName())=='admin') ? true : false;

            return $result;
        }
        // -----------------------------------------------------------
    }
?>