<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Task 86</title>
</head>
<body>
<?php
$form = "<form action='' method='post'>
            <p><input type='text' name='login'/></p>
            <p><input type='email' name='email'/></p>
            <p><textarea cols='30' rows='10' name='text'></textarea></p>
            <p><input type='submit'/></p>
        </form>";
$counter = !isset($_SESSION['counter'])? false : $_SESSION['counter'];
if ($counter == false){
    echo $form;
    $_SESSION['counter'] = 1;
    $_SESSION['time'] = time()+60;
}elseif($counter > 3){
    if ($_SESSION['time'] > time()){
        echo $form;
        echo "Вы привысели лимит отправки форм в минуту.";
        unset($_POST);
    }else{
        echo $form;
        echo "Форма успешно отправлена.";
        $_SESSION['counter'] = 1;
        $_SESSION['time'] = time()+60;
    }
}else{
    echo $form;
    $_SESSION['counter']++;
    echo "Форма успешно отправлена.";
}
?>
<br>
<a href="unsetSession.php">Удаляем сессию.</a>
</body>
</html>