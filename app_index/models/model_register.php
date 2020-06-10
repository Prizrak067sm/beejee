<?php

    class model_register extends Model
    {
        public function reg_user(array $userData)
        {
            // --- Логин и пароль клииента. ---
            $login = $userData['userName'];
            $pass = $userData['userPassword'];
            // ---------------------------------

            $returnList = array();   // Для ответа и возможных ошибок при невозможной регистрации.
            $userNameForRegist = strtolower($userData['userName']);

            $existUser = $this->existUserName($userNameForRegist);
            // --- Если при проверке существования юзера в бд функция
            //     вернула не булевое значение, значит вернула ошибку. ---
            if (!is_bool($existUser))
            {
                return $returnList['error'] = $existUser;
            }
            // ------------------------------------------------------------

            if ($existUser)
            {
                $returnList['existUser'] = true;
            }
            else
            {
                try
                {
                    $salt = $this->getMySalt($login);    // Получаем свою соль.

                    $hash_userPassword = crypt($pass, $salt);   // Хэшируем пароль пользователя.

                    $sql = "INSERT INTO users (login, password) VALUE (?,?)";
                    $stmt = $this->problem_book->prepare($sql);
                    $stmt->execute(array($login, $hash_userPassword));

                    $returnList['userReg'] = true;
                }
                catch (Exception $e)
                {
                    $returnList['error'] = 'Произошла следующая ошибка: '.$e->getMessage();
                }
            }

            return $returnList;
        }

        // --- Функция для проверки существования пользователя с введенным именем при регистрации. ---
        private function existUserName($userName)
        {
            try
            {
                $sql = "SELECT login FROM users where login=?";
                $stmt = $this->problem_book->prepare($sql);
                $stmt->execute(array($userName));
                $existUser = (bool)$stmt->rowCount();

                return $existUser;
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }
        // --------- Конец existUserName. ----------------------------------------------------------------
    }

?>