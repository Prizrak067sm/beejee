<?php
    class model_addtask extends Model
    {
        // ------- Добавляем данные в БД. -------
        function set_data($dataTask)
        {
            try
            {
                // --- Инициализируем переменные полученными в аргументе данными из ассоц.
                //     массива, экранируя все спец. символы, предотвращая XSS атаки. ---
                $name = htmlentities($dataTask['username'], ENT_QUOTES, "UTF-8"); // Имя.
                $email = htmlentities($dataTask['email'], ENT_QUOTES, "UTF-8");   // Почта.
                $task = htmlentities($dataTask['task'], ENT_QUOTES, "UTF-8");     // Задача.
                // ----------------------------------------------------------------------

                $SQL = "INSERT INTO tasks (username, email, task, status, edited) VALUES (?, ?, ?, false ,false )";

                $stmt = $this->problem_book->prepare($SQL);
                $stmt->execute(array($name, $email, $task));

                $result = array('added'=>true, 'msg'=>"Данные успешно добавлены");
            }
            catch (Exception $e)
            {
                $result = array('added'=>false, 'msg'=>"Произошла ошибка - ".$e->getMessage());
            }

            return $result;
        }
        // ------------- Конец добавления. -------
    }
?>