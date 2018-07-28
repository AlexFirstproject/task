<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Task 78</title>
</head>
<body>
<h3>Фильм "Аннигиляция"</h3>
<p>Никто не знает, откуда взялась Зона Икс — смертельно опасная территория, кишащая аномальными явлениями. Там не бегают
    чудовища, оттуда не приносят трофеев, и охотники за наживой там не промышляют. Тайная правительственная организация
    отправляет в Зону одну исследовательскую экспедицию за другой, но чаще всего те не возвращаются — или возвращаются,
    но неуловимо и страшно изменившись. Сможет ли новая, двенадцатая экспедиция в Зону добиться того, что не удалось
    предшественникам и раскрыть тайны этого проклятого места? Оставив позади имена и прежние жизни, четыре женщины —
    психолог, биолог, топограф и антрополог — отправляются навстречу чуждой, нечеловеческой тайне…</p>
<hr/>
<hr/>
<?php
$name = 'root';
$pass = '';
$host = '127.0.0.1:3306';
$link = mysqli_connect($host, $name, $pass, 'task');
$getQuery = 'SELECT name, comit, date FROM task78';
$result = mysqli_query($link, $getQuery);

// Проверка на маты
// Какая-то база нецензурщины.
$mati = ['мат1', 'мат2', 'мат3'];
$arrPost  = explode(' ', $_POST[comit]);
if (array_intersect($mati, $arrPost) == true){
    echo "Некорректный комментарий.";
    unset($_POST[comit]);
}

// Если есть текс добавляем ее в твблицу , делаем проверку _POST[comit] на наличие тегов кром <b>.
if (!empty($_POST[name]) && !empty(strip_tags($_POST[comit], '<b>'))) {
    $setQuery = "INSERT INTO `task78` (`name`, `comit`) VALUES ('" . $_POST[name] . "', '" . $_POST[comit] . "')";
    mysqli_query($link, $setQuery);
}

// Выводим комиты из таблицы.
while ($arrComit = mysqli_fetch_assoc($result)) {
    echo "<blockquote style='width: 40%'><p><b>" . $arrComit[name] . "</b></p><p>" . $arrComit[comit] . "</p><p dir='rtl'><i>" . $arrComit[date] . "</i></p></blockquote>";
}
?>
<hr/>
<p><h5>Оставить комит:</h5></p>
<form action="" method="post">
    <p><input type="text" name="name" required/></p>
    <p><textarea rows="5" cols="50" name="comit" required></textarea><br/></p>
    <p><input type="submit"/></p>
</form>



<br/>
<br/>
<a href="18.php">Назад к заданиям.</a>

</body>
</html>
