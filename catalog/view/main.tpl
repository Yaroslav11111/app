<!DOCTYPE html>
<html lang="ru">
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1">

    <title>Title</title>

    <link rel="stylesheet" href="http://app/catalog/view/themes/Lite/css/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css"  href="http://app/catalog/view/themes/Lite/css/style.css"/>
    <link rel="stylesheet" type="text/css"  href="http://app/admin/view/css/admin.css"/>

</head>
<body>
<header>
    <div class="container auth">
        <div class="col-xs-2 logo"><img src="/catalog/view/themes/Lite/img/logo.png" alt=""></div>
        <div class="col-xs-3 menu_item"><a href="/">Главная</a></div>
        <div class="col-xs-3 menu_item"><a href="/task/create">Создать задачу</a></div>
        <div class="col-xs-3 menu_item">
            <? if (!isset( $_SESSION['logged_user'])) {?>

            <a class="" href="/administrator" >Вход</a>
        <? }  else {?>
            <a class="" href="/administrator/logout" >Выйти</a>
            </div>
    <?  } ?>
    </div>

</header>
<main>
    <? $content ?>
</main>
<footer>

</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="//app/catalog/view/themes/Lite/js/appjs.js"></script>
</body>
</html>