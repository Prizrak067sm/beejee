<!-- Всплывающее окно с сообщением после редактирования задачи. -->
<?php
echo <<<end_
    <div class="conteiner-transparent-div conteiner-msg">
        <div class="msgForPopupWindow msg-popup-add-edit-task">
            $resultEditTask
        </div>
        <a href="$uriAfterEditTask"></a>
    </div>
end_;

