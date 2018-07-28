<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Galery</title>
</head>
<body>
<form enctype="multipart/form-data" method="post">
    <p><input type="file" name="img" multiple accept="image/*,image/jpeg,image/png"/></p>
    <input type="submit"/>
</form>
<?php
// Создаем папку и копируем туда посланые через форму фаилы.
$upldir = "./images/";
if (isset($_FILES[img])){
    @mkdir(images,0777);
    $uplfile = $upldir.$_FILES[img][name];
    if (copy($_FILES[img][tmp_name], $uplfile)){
        echo "Фаил успешно скопирован.";
    }else{
        echo "Не удалось скопировать фаил.";
    }
}
//Создаем масив елементов папки 'images' (чтение начинаем с 2-го так как первых два это '.' и '..').
$arrimage = array_slice(scandir($upldir), 2);
//Вычисляем сколько будет строк в таблице.
$numTr = intval((count($arrimage)-1)/3);
echo "<table>";
for ($a = 0; $a <= $numTr; $a++){
    echo "<tr>";
    $c = $a*3+2; //Сколько столбцов в строке.
        for ($b = $a*3; $b <= $c; $b++){
            echo "<td><img src=".$upldir.$arrimage[$b]." alt='Пока отсуцтвует' width='300px' height='300px'/></td>";
        }
    echo "</tr>";
}
echo "</table>";
echo "<br><br><br><a href='18.php'>Назад к заданиям.</a>";
?>
</body>
</html>
