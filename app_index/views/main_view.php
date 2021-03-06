<!-- Страница - главная. Содержит таблицу с задачами, пагинацией и кнопками управления - добавить и изменить. -->
<html>
    <h1>Просмотр задач </h1>
    <!-- ------------- Контейнер, содержащий форму с фильтром сортировки ------------- -->
    <div id="div_table_filter">
        <form id="form_filter_tableTask" action="/index" method="POST">
            <!-- ------- Выпадающий список со столбцами, по которым нужно сортировать записи таблицы.
                         Пункты списка содержат переменные, которые могут иметь значение selected (пункт выбран).
                         Только одна из переменных передается из контроллера с этим значением.
                         Переменная содержит это значение, если данный пункт выбран пользователем. ------- -->
            <label for="select_filter_columnName">Сортировать по: </label>
            <select name="select_filter_columnName" id="select_filter_columnName" class="select-filter">
                <option value="userName" <?= $selected_userName?>>
                    имени пользователя
                </option>

                <option value="email" <?= $selected_email?>>
                    e-mail
                </option>

                <option value="status" <?= $selected_status?>>
                    статусу
                </option>
            </select>
            <!-- ----------------------- Конец выпадающего списка со столбацми. ------------------------ -->

            <!-- --- Выпадающий список с направлениями сортировки. Пункты списка содержат переменные, которые могут
                     иметь значение selected (пункт выбран). Только одна из переменных передается из контроллера
                     с этим значением. Переменная содержит это значение, если данный пункт выбран пользователем. --- -->
            <label for="select_filter_vector">по: </label>
            <select name="select_filter_vector" id="select_filter_vector" class="select-filter">
                <option value="toBig" <?= $selected_toBig?>>
                    возрастанию
                </option>

                <option value="toSmall" <?= $selected_toSmall?>>
                    убыванию
                </option>
            </select>
            <!-- ----------------------- Конец выпадающего списка с направлениями сортировки. ---------------------- -->
            <input type="submit" value="Применить" class="btn btn-activ">
        </form>
    </div>
    <!-- ------------- Конец контейнера, содержащего форму с фильтром сортировки. ------------- -->

    <!-- ------- Таблица с задачами. В ней содержится данные из БД таблицы task.
                 Контроллер передает необходимое количество записей в ассоциативном массиве.
                 Где ключ - имя столбца, значение - значение ячейки. -------  -->
    <table id="table_tasks">
        <!-- Шапка таблицы - наименования столбцов -->
        <thead>
            <th class="table-column-username">Имя пользователя</th>
            <th class="table-column-email">e-mail</th>
            <th class="table-column-task">Задача</th>
            <th class="table-column-status">Статус</th>
            <th class="table-column-edited">Редакт</th>
        </thead>
        <!-- -------------------------------------- -->

        <!-- --- Заполняем строки таблицы. --- -->
        <?php
            foreach ($tasks as $row)   // Перебор строк.
            {
                echo "<tr>";   // Открываем очередную строку.

                foreach ($row as $key=>$ceil)   // Перебор ячеек строки. Имя столбца=>значение ячейки.
                {
                    $classColumn = 'table-column-'.$key;   // Формируем имя класса каждой ячейки на основе имени столбца. Далее все ячейки <td> конкретного столбца будут иметь свой этот класс.

                    // --- Для ячеек столбцов Статус и Редакт в массиве предусмотрены значения 0 или 1, переопределяем эти
                    //     значения на крестик и галочку соответственно. Крестику соответствует CSS класс dagger, галке galka. ---
                    if ($key=='status' or $key=='edited')
                        $ceil = $ceil==0 ? '<div class="dagger"></div>' : '<div class="galka"></div>';
                    // -----------------------------------------------------------------------------------------------------------

                    // --- Если значение ячейки содержит переносы строк, явно их заменяем
                    //     для html на <br>, чтобы в таблице строки переносились. ---
                    if (strpos($ceil, chr(10)))
                    {
                        $ceil = str_replace(chr(13).chr(10), '<br>', $ceil);
                    }
                    // --------------------------------------------------------------

                    echo "<td class='$classColumn'> $ceil </td>";   // Создаем ячейку.
                }

                echo "</tr>";   // Закрываем строку.
            }   // Конец перебора строк.
        ?>
        <!-- --- Конец заполнения строк таблицы. --- -->
    </table>
    <!-- -------------------- Конец таблицы с задачами tasks. --------------- -->

    <!-- --- Контейнер под таблицей. Содержит кнопки управления и пагинацию. --- -->
    <div id="div-control-table">
        <!-- Контейнер с ссылко-кнопками Добавить и Изменить/выбрать -->
        <div id="div-container-btnControlTable">
            <a href="/addtask" class="btnControlTable">Добавить</a>

            <!-- Кнопка Изменить. Добавляется только если авторизован админ. При нажатии вызывается JS функция,
                 добавляющаяя к таблице элементы выбора radio. Когда будет выбран, кнопка поменяет текст на Выбрать,
                 а также добавляется URL с GET запросом, содержащим ид задачи, на страницу изменения задачи.  -->
            <?php if($is_admin){ ?>
                <a id='btnEditTask' href="#" onclick="addChangeColumnTableTask('<?=$all_id_task?>')" class="btnControlTable">Изменить</a>
            <?php } ?>
            <!-- ----------------------------------------------------------------------------------------------------- -->
        </div>
        <!-- ------------- Конец контейнера с кнопками. ------------- -->

        <!-- ----- Контейнер с пагинацией. Используются переменные контроллера
                   $page - текущая страница и $count_page - количество страниц.
                   А также метод getPagination, создающий ссылки на страниц.
                   Реализован метод во включающем файле view.php в классе View. ----- -->
        <div id="div-container-pagination">
            <span id="this_page">Текущая страница: <?=$page?></span>
            <?=$this->getPagination($page, $count_page) ?>
        </div>
        <!-- ------------------Конец контейнера с пагинацией. ------------------------ -->
    </div>
    <!-- ------------- Конец контейнера с кнопками и пагинацией. ----------------- -->
</html>











