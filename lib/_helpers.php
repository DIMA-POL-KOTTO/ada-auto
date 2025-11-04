<?php
function getModelFolder($brand, $model) {
    $name = strtolower(trim($brand . '_' . $model));
    $name = preg_replace('/[^a-z0-9_-]+/', '_', $name);
    return trim($name, '_');
}

function findModelImage($folder, $num=0) {
    $base = $_SERVER['DOCUMENT_ROOT'] . "/images/models/$folder/$num";
    $extensions = ['jpg', 'jpeg', 'jfif', 'png', 'webp'];
    
    foreach ($extensions as $ext) {
        if (file_exists("$base.$ext")) {
            return "images/models/$folder/$num.$ext";
        }
    }
    return null; // не найдено
}
?>