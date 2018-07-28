<?php setcookie('color', "$_POST[color]"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <title>Task 88</title>
</head>
<body>
<?php
$color = ['red' => 'Красный', 'blue' => 'Синий', 'green' => 'Зеленый', 'yellow' => 'Желтый'];
?>
<form href="" method="post">
    <p><select name="color">
        <?php
        foreach ($color as $a => $b){
            if ($a != htmlspecialchars($_COOKIE[color])){
                echo "<option value='".$a."'>$b</option>";
            }else{
                echo "<option value='".$a."' selected>$b</option>";
            }
        }
        ?>
    </select></p>
    <p><input type="submit"/></p>
</form>
<?php
if (!isset($_COOKIE[color])){
    echo "<p style='color: ".$_POST[color]."'>Lorem Ipsum</p>";
}else{
    echo "<p style='color: ".$_COOKIE[color]."'>Lorem Ipsum</p>";
}
?>
</body>
</html>