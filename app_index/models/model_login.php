<?php
    class model_login extends Model
    {
        function userCorrect($userData)
        {
            // --- Логин и пароль клииента. ---
            $login = $userData['userName'];
            $pass = $userData['userPassword'];
            // ---------------------------------

            try
            {
                // --- Запрашиваем запись в БД из таблицы с пользователями, поле login
                //     которой соответствует отправленному имени пользователя клиентом. ---
                $sql = "SELECT * FROM users where login=?";
                $stmt = $this->problem_book->prepare($sql);
                $stmt->execute(array($login));
                $existUser = (bool)$stmt->rowCount();   // Если запись найдена, присваиваем переменной значение true.
                // -------------------------------------------------------------------------

                // --- Если в таблице найден пользователь, проверяем соответствие введенного пароля и пароля в записи.
                if ($existUser)
                {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);   // Получаем всю запись.

                    $userPasswordInBd = $user['password'];   // Пароль, сохраненный в БД найденного логина.

                    $hash_userPassword = crypt($pass, $userPasswordInBd);   // Хэшируем пароль пользователя. В качестве соли берем пароль из бд. Так как вначале ХЕШа соль, то в силу префикса алгоритма автоматически возьмется строка длинною в соль.

                    if ($hash_userPassword == $userPasswordInBd)
                        return true;
                }
                // ---------------------------------------------------------------------------------------------------

                return false;   // Выполнение дошло до этой строки, значит функция ранее не вернула истину - логин или пароль не подошли.
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>