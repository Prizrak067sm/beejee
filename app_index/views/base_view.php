<!-- Базовая вьюшка - шаблон. В ней подключаются остальные вьюшки с контентом. -->
<html>
    <head>
        <title><?= $title ?> </title>

        <link href="/css/head.css" rel="stylesheet" type="text/css">
        <link href="/css/other.css" rel="stylesheet" type="text/css">
        <link href="/css/tabletasks.css" rel="stylesheet" type="text/css">
        <link href="/css/forms.css" rel="stylesheet" type="text/css">
        <link href="/css/footer.css" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=900, initial-scale=1">
        <script src="/app_index/js/function.js"></script>
    </head>

    <script> </script>   <!-- Нужно, чтобы переходы НЕ срабатывали при открытии страниц в некоторых браузерах. -->
    <body>
        <!-- ---------------- Шапка. ------------------ -->
        <div id="head">   <!-- flex -->
            <!-- Блок-контейнер, часть шапки для логотипа сайта.  -->
            <div id="conteiner_logo_head">
                <!-- Ссылка на главную страницу. Внутри ссылки содержатся элементы с анимацией. На элементах
                     анимация настроена (jump-fragment) и при касании к ссылке, псевдокласс :hover меняет время
                     анимации, что приводит в движения  элементы, так как в них время анимации - inherit  -->
                <a id="refLogo" href="/index"> <h1 class="conteiner_for_fragment_animation"> <sup class="jump-fragment">(⹁'')('',) </sup>  Задачник BeeJee <sup class="jump-fragment">(⹁'')('',) </sup> </h1> </a>
                <!-- Конец ссылки. -->
            </div>
            <!-- Конец контейнера с логотипом сайта. -->

            <!-- Часть шапки скраю.. В данном контейнере - приветствие пользователя
                 по имени, а также кнопки ВОЙТИ/ВЫЙТИ и РЕГИСТРАЦИЯ. -->
            <div id="head_userPanel" >
                <!-- Блок с приветствием. Имя получаем из переданной контроллером переменной $userNameWel -->
                <div id="divUserName" >
                    <strong>Привет, <?php echo $userNameWel?></strong>
                </div>
                <!-- Конец блока с приветствием. -->

                <!-- Блок с кнопками ВОЙТИ/ВЫЙТИ и РЕГИСТРАЦИЯ. -->
                <div id="conteiner_btn_userPanel">
                    <!-- В контроллере всегда определяется совершен ли вход. Это состояние сохраняется в переменной $loginCompleted: true - вход выполнен. -->
                    <?php if (empty($loginCompleted))   // Если вход не выполнен ($loginCompleted==false), выводим ссылки-кнопки входа и регистрации.
                          { ?>
                            <a href="#Register" class="btn btnAuth" "> Регистрация </a>
                            <a href="#LogIn" class="btn btnAuth">Войти</a>
                    <?php }
                    else   // Иначе, если вход выполнен ($loginCompleted==true), выводим ссылкy-кнопкy выхода.
                          { ?>
                            <a href="/index/logOut" class="btn btnAuth" ">Выйти</a>
                    <?php }?>
                </div>
                <!-- Конец блока с кнопками ВОЙТИ/ВЫЙТИ и РЕГИСТРАЦИЯ. -->
            </div>
            <!-- Конец контейнера с приветтсвием и кнопками ВОЙТИ/ВЫЙТИ, РЕГИСТРАЦИЯ. -->

            <!-- Включаем формы входа и регистрации. Они будут появляться по якорю в соответствующих ссылках. -->
            <?php require_once "popup_windows/form_login.php"?>
            <?php require_once "popup_windows/form_register.php"?>
            <!-- -------------------------------------------------------------------------------------------- -->
        </div>
        <!-- ------- Конец шапки. --------------------- -->

        <!-- Блок с подключаемой страницей контента. -->
        <div id="div-content">
            <?php
                eval($content_view);
            ?>
        </div>
        <!-- ---------------------------------------- -->

        <div id = 'footer'>
           <div class="movie-right-to-left">  © Колюсь А. Н.  </div>
        </div>
    </body>
</html>
