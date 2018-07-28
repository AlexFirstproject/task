<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Task 81</title>
</head>
<body>
    <form action="" method="post">
        <textarea cols="60" rows="10" name="text"></textarea><br>
        <input type="submit"/>
    </form>
    <?php
    $arr1 = ['slovo1', 'slovo2', 'slovo3'];
    $arrText = explode (' ', $_POST[text]);
    $amount = 0;
    for ($a = 0; $a <= count($arr1); $a++){
        foreach ($arrText as $b){
            if ($arr1[$a] == $b){
                $amount += 1;
            }
        }
    }
    echo $amount;
    ?>
    <br>
    <br>
    <a href="18.php">Назад к задачам.</a>
</body>
</html>