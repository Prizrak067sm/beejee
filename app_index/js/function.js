// --- Добавляем столбец с радиокнопками в таблицу. Параметр содержит строку с ИД для радиокнопок(это ИДы задач строках). ---
function addChangeColumnTableTask(ids) {
    if (document.getElementsByName('idTask').length==0)   // Если еще нет элементов с ИД задачи..
    {
        var id_for_task = ids.split(',');   // Массив ид задач, для которых создадутся элементы выбора радио.

        var table_tasks = document.getElementById('table_tasks');   // Таблица с задачами.
        var rows = table_tasks.getElementsByTagName('tr');   // Массив строк таблицы с задачами. В них далее будем добавлять ячейки с радиокнопками.

        var td = document.createElement('td');   // Ячейка. Именно эта пустая, но далее аналогичные будут для радиокнопки с ид задачи очередной строки.
        rows[0].prepend(td);   // В строку заголовка пустую ячейку.

        // --- Перебираем строки. Создаем ячейку, радиокнопку со свойствами,
        //     добавляем в ячейку, а ячейку в очередную строку. ---
        for (i=1; i<rows.length; i++)
        {
            var td = document.createElement('td');
            var inputRadio_idTask = document.createElement('input');
            inputRadio_idTask.type = 'radio';
            inputRadio_idTask.name = 'idTask';

            inputRadio_idTask.id = id_for_task[i-1];   // Поскольку нулевая строка в заголовке таблицы, первая строка имеет индекс 1, а первый ид 0, то для каждой строки i индекс массива с идами i-1.
            inputRadio_idTask.value = id_for_task[i-1];// Аналогично ид.

            // --- Задаем минимальный размер, чтобы после добавления размер увеличить -
            //     эффект появления. Плавное изменение размера обеспечит переход в CSS. ---
            inputRadio_idTask.style.width = 1 + 'px'
            inputRadio_idTask.style.height = 1 + 'px'
            // -----------------------------------------------------------------------------

            inputRadio_idTask.className = 'inputRadio_idTask'
            inputRadio_idTask.onchange = editBtnForEditTask;   // Событие при выборе. Обработчик изменит ссылку в кнопке для изменения задачи. В ссылке изменится ид на ид выбранной радиокнопки.
            td.append(inputRadio_idTask);

            rows[i].prepend(td);
        }
        // --------------------------------------------------------------------

        setTimeout(resizeInputRadio, 100);   // Вызываем для изменения размера радиокнопок.
    }

}
// ------ Конец addChangeColumnTableTask. ---------------------------------------------------------------------------------

// --- Чтоб анимация сработала меняем размер в функции через некоторое время. ---
function resizeInputRadio() {
    input_radio=document.getElementsByClassName('inputRadio_idTask')
    for (i=0; i<input_radio.length;i++)
    {
        input_radio[i].style.width = 15 + 'px';
        input_radio[i].style.height = 15 + 'px';
    }

}
// -----Конец resizeInputRadio ----------------------------------------------------

// --- Обработчик события выбора радиокнопки. Ид этой
//     кнопки добавляем к ссылке кнопки в части гет-запроса. ---
function editBtnForEditTask(event) {
    idTask = event.currentTarget.id;
    btn = document.getElementById('btnEditTask');
    btn.innerText = 'Выбрать';
    btn.href = "/editTask?idtask="+idTask;
}
// ------ Конец editBtnForEditTask. -----------------------------




