<!-- Всплывающее окно с сообщением после добавления задачи. -->
<?php
echo <<<end_
    <div class="conteiner-transparent-div conteiner-msg">
        <div class="msgForPopupWindow msg-popup-add-edit-task">
            $resultAddTask
        </div>
        <a href="$uriAfterAddTask"></a>
    </div>
end_;

