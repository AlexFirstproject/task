<?php
function strArrImage ($a){
    // Проверяем пустой ли фаил хранения масива.
    if (!file_get_contents('./file/dateBaseImages.txt')){
        $b = [0 => $a]; // Если пустой делаем первую запись с ключем 0.
        $file = fopen('./file/dateBaseImages.txt', 'w'); // Открываем фаил с функцией перезаписи (впринципе можно установить просто на запись).
        $c = serialize($b); // Серриализуем масив
        fwrite($file, $c); // Записывам серриал. масив в фаил.
        fclose($file); // Закрывам фаил.
    }else{
        $arrImages = file_get_contents('./file/dateBaseImages.txt'); // Читаем фаил.
        $unserArrImages = unserialize($arrImages); // Росшифровываем масив из фаила.
        array_push($unserArrImages, $a); // Добавляем прибывший масив в конец масива из фаила.
        $serArrImages = serialize($unserArrImages); // Шифруем то что получилось.
        $file = fopen('./file/dateBaseImages.txt', 'w');
        fwrite($file, $serArrImages);
        fclose($file);
    }
}
function copyImage ($a, $b, $c){
    @mkdir(uploads,0777);
    $upldir = "./uploads/";
    $uplfile = $upldir.$b.".".$c;
    if (copy($a, $uplfile)){
        echo "Фаил успешно скопирован.<br />";
    }else{
        echo "Не удалось скопировать фаил.<br />";
    }
}
function tempName ($a){
    $arrNameFile = explode('\\', $a);
    $arrNameFile2 = explode ('.', end($arrNameFile));
    return $arrNameFile2[0];
}
function extension ($a){
    $arrNameFile3 = explode ('.', $a);
    return end($arrNameFile3);
}
