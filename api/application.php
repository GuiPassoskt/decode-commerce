<?php

$client = $_POST['client_id'];
$category = $_POST['category_id'];
$file = $_FILES['file'];

$imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if (isset($file)) {
    $newName = uniqid('decode-commerce', true) . "." . $imageFileType;
    $file->move(ROOTPATH."public/assets/$client/$category", $newName);
    return json_encode([
        'status' => 201,
        'msg' => 'arquivo enviado com sucesso!',
        'path' => base_url("assets/$client/$category/$newName")
    ]);
} else {
    return json_encode([
        'status' => 'failed', 
        'msg' => 'erro ao tentar enviar arquivo'
    ]);
}
