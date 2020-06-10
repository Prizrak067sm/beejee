<!-- Страница содержит форму для добавления записи в таблицу задач (tasks). Форма при рендеринге заполняется данными из сессии, которые сохранены при неудачной попытке добавления. -->
<?php
    echo <<<ADDTASK
        <div class="flex-container-column flex-container-add-edit-Task">
            <div>
                <h1> Ввод задачи </h1>
            </div>
             
            <form id="form-addTask" action="/index/addtask/resultAddTask" class="form-input-all-available-space" method="POST">
                <div>
                    <div>
                        <label for="name">Имя пользователя: </label>
                        <input type="text" name="username" value="$userNameWel" placeholder="Введите имя" required>
                    </div>
                    
                    <div>
                        <label for="email">E-mail: </label>
                        <input type="email" name="email" value="$email" placeholder="Введите адрес электронной почты" required>
                    </div>
                </div>
                
                <div class="div_for_textarea">
                    <label for="task">Задача: <br></label>
                    <textarea name="task" placeholder="Введите текст задачи" required>$task</textarea>
                </div>
                
                <input type="submit" class="btn btn-activ">
            </form>
        </div>
ADDTASK;
?>
