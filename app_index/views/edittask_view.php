<!-- Страница содержит форму для изменения записи в таблице задач (tasks). Форма при рендеринге заполняется извлеченными данными записи -->
<?php
    echo <<<EDITTASK
        <div class="flex-container-column flex-container-add-edit-Task">
            <div>
                <h1> Редактирование задачи id: $idTask</h1>
            </div>
            <!-- ------- Форма содержит данные, полученные в переменных из контроллера. Эти 
                         данные предполагается изменить и отправить в бд для обновления. ------- --> 
            <form id="form_editTask" action="/index/editTask/resultEditTask" method="POST" class="form-input-all-available-space">     
                <input name="id" value="$idTask" hidden>   <!-- Получаем и скрываем ИД редактируемой задачи, чтобы отправить его в контроллер для поиска в БД -->       
                
                <div>
                    <div>
                        <label for="name">Имя пользователя: </label>
                        <input type="text" name="username" value="$username" placeholder="Введите имя" required>
                    </div>
                    <div>
                        <label for="email">E-mail: </label>
                        <input type="email" name="email" value="$email" placeholder="Введите адрес электронной почты" required>
                    </div>
                    
                    <div class="div-checkbox">
                        <label for="status"> Выполнено </label>
                        <input type="checkbox" name="status" $status>
                    </div>
                </div>
                
                <div class="div_for_textarea">
                    <label for="task"> Отредактируйте текст задачи: </label>
                    <textarea name="task">$task</textarea>
                </div>
                <input type="submit" class="btn btn-activ">
            </form>
            <!-- -------------- Конец формы. ---------------------------------------------------- -->
        </div>
EDITTASK;
?>
