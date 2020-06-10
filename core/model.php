<?php
spl_autoload_register();
    class Model extends PDOconnect
    {
        const PREFIX_SALT_CRYPT_BLOWFISH = '$2y$07$';
        protected $problem_book;

        public function __construct()
        {
            parent::__construct();
            try
            {
                $this->problem_book = $this->connect();
            }
            catch (Exception $e)
            {
                echo 'Не удалось соединиться с БД - '.$e->getMessage();
            }

        }

        function get_data()   // Для выборки данных
        {

        }

        function set_data()   // Для записи данных
        {

        }

        protected function getMySalt($userName)
        {
            // --- Создаём соль, добавляя префикс, определяющий алгоритм.
            //     Соль должна быть не короче 22 символов, не учитывая префикс.
            //     В качестве соли используем захэшированный сначала алгоритмом sha1,
            //     затем md5, логин юзера, перд ним добавив 'bee', а после 'jee'.
            //     Итоговая соль будет содержать префикс алгоритма и хэш, описанный выше.
            //     Длина соли получится длиннее нужной, но функция хэширования пароля ее обрежет автоматически. ---
            $salt = self::PREFIX_SALT_CRYPT_BLOWFISH.md5(sha1('bee'.$userName.'jee'));
            // ----------------------------------------------------------------------------------------------------

            return $salt;
        }
    }
?>