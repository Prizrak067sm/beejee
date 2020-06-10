<?php
    class model_edittask extends Model
    {
        // --- Возвращает запись по переданному ИД.  Нужно для вывода данных в форму и далее их изменение. ---
        function get_data_for_id($id)
        {
            try
            {
                $SQL = "SELECT id, username, email, task, status FROM tasks WHERE id = ?";
                $stmt = $this->problem_book->prepare($SQL);
                $stmt->execute(array($id));
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $result = $result[0];
            }
            catch (Exception $e)
            {
                $result = false;
                echo "Произошла ошибка при извлечении записи для изменения - ".$e->getMessage();
            }

            return $result;
        }
        // --------- Конец get_data_for_id -------------------------------------------------------------------

        // --- Изменяем запись в БД на данные в ассоц.массиве(в аргументе), изменяемую запись ищем по id в этом же массиве. ---
        function update_data($data)
        {
            try
            {
                $this->problem_book->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                // --- Инициализируем переменные полученными в аргументе данными из ассоц.
                //     массива, экранируя все спец. символы, чтобы предотвратить XSS атаки. ---
                $id=htmlentities($data['id'], ENT_QUOTES, "UTF-8");
                $username= htmlentities($data['username'],ENT_QUOTES, "UTF-8");
                $email=htmlentities($data['email'],ENT_QUOTES, "UTF-8");
                $task=htmlentities($data['task'],ENT_QUOTES, "UTF-8");
                $status=$data['status']=='on' ? 1 : 0;
                // -----------------------------------------------------------------------------

                $SQL = "UPDATE tasks SET username=:username, email=:email, task=:task, status=:status, edited=1 WHERE id=:id";
                $stmt = $this->problem_book->prepare($SQL);
                $stmt->execute(array($username, $email, $task, $status, $id));

                $countUpdateRow = $stmt->rowCount();   // Количество затронутых записей.

                // --- Готовим результат в соответствии с количеством строк, если больше 0, то всё успешно.
                //     0 может быть, если специально изменить ИД при запросе на не существующий, например. ---
                if ($countUpdateRow>0)
                    $result = array('edited'=>true, 'msg'=>"Данные успешно обновлены");
                else
                    $result = array('edited'=>false, 'msg'=>"Ни одна из записей не была изменена");
                // --------------------------------------------------------------------------------------------
            }
            catch (Exception $e)
            {
                $result = array('edited'=>false, 'msg'=>"Произошла ошибка - ".$e->getMessage());
            }

            return $result;
        }
        // ----------------- Конец update_data. --------------------------------------------------------------------------------
    }
?>