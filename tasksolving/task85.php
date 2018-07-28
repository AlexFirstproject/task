<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Task 85</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
<h3>Задание 85:</h3>
<ul class="list-unstyled">
    <li>Разработать web-страницу, на которой будет возможность выбора изображения на локальном компьютере и подальшая
        загрузка их на сервер. Также, должно быть отображение загруженных изображений в виде портфолио.</li>
    <li>Требования:
        <ul>
            <li>Размер изображения не должен превышать 3Мб.</li>
            <li>Изображения могут быть, только, форматов: jpg, png, gif.</li>
            <li>Изображения на сервере должны сохранятся в директории uploads.</li>
            <li>Имя загруженного на сервер изображения должно формироваться на серверной стороне.</li>
            <li>В портфолио можно загрузить максимум 7 изображений.</li>
            <li>При просмотре порфолио, при наведении на изображение, поверх самого изображения, должна отображаться дата загрузки и
                оригинальное имя этого же изображения.</li>
            <li>Для придания стилей используйте bootstrap CSS framework.</li>
            <li>Для сохранения оригинального имени, даты загрузки и модифицированного имени изображения используйте файл, в который
                вы будете записывать сериализованный массив данных.</li>
            <li>PHP скрипт и HTML код должен быть в разных файлах, в HTML выводите только данные (переменные, циклы).</li>
        </ul>
    </li>
</ul>
<h5><u>Решение:</u></h5>

<form enctype="multipart/form-data" action="" method="post">
    <div class="form-group">
        <p><label for="dounlFile1">Картинка 1</label>
        <input type="file" class="form-control-file" name="image" accept="image/jpeg,image/png,image/gif" id="dounlFile1"/></p>
        <p><label for="dounlFile2">Картинка 2</label>
        <input type="file" class="form-control-file" name="image2" accept="image/jpeg,image/png,image/gif" id="dounlFile1"/></p>
        <p><input type="submit"/> </p>
    </div>
</form>
<?php
include 'task85php.php'; // Подключаем фаил с функциями.
// Проверка на наличие загрузку хоть одной картинки.
if (isset($_FILES[image]) || isset($_FILES[image2])){
    $arrImage = [$_FILES[image], $_FILES[image2]]; // Масив загруженых картинок.
    for ($a = 0; $a < count($arrImage); $a++){
        // Проверка на наличие картинки в значении масива, если нет удаляем значение с масива.
        if ($arrImage[$a]['error'] == true){
            unset($arrImage[$a]);
            continue;
            // Проверяем допустимый ли размер картинки.
        }elseif ($arrImage[$a][size] > 3145728){
            echo "Превышает допустимый размер";
            continue;
            // Проверяем на допуск расширения.
        }elseif ($arrImage[$a][type] == 'image/jpeg' || $arrImage[$a][type] == 'image/png' || $arrImage[$a][type] == 'image/gif'){
            $tempName = tempName($arrImage[$a][tmp_name]); // Переменна с tem именем
            $extension = extension($arrImage[$a][name]); // Переменная расширения загружаемого фаила.
            copyImage ($arrImage[$a][tmp_name], $tempName, $extension); // Копируем фаил в папку uploads c именем которое было дано сервером в tem-е.
            $strserialize = ['tmp_name' => $tempName.".".$extension, 'name' => $arrImage[$a][name], 'date' => date('d.m.Y H:i:s')]; // Формируем строку для серриализации.
            strArrImage($strserialize); // Отправляем строку для серриализации и записи ее в фаил для хранения.
        }else{
            echo "Не правильное разрешение фаила.<br>";
            continue;
        }
    }
}
$x = file_get_contents('./file/dateBaseImages.txt'); // Переменная с серриализованым масивом из фаила.
$str3 = unserialize($x); // Переводим масив в нормальный вид.
?>
<p>
    <?php
    for ($x = 0; $x < 7 ? $x < count($str3) : $x < 7; $x++){ // выводим 7 картинок в сплывающей подсказке показано оригинальное имя и дата загрузки.
        echo "<img src='./uploads/".$str3[$x][tmp_name]."' alt='".$str3[$x][name]."' title='Оригинал имени: ".$str3[$x][name]."\nДата загрузки: ".$str3[$x][date]."' class='img-rounded' width ='250' height='250'>";
    }
    ?>
</p>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>