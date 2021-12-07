<?php

if (isset($_POST['client_id'])) {
    $client = $_POST['client_id'];
} else {
    return json_encode([
        'status' => 404,
        'msg' => 'Client ID não informado!'
    ]);
}

if (isset($_POST['category_id'])) {
    $category = $_POST['category_id'];
} else {
    return json_encode([
        'status' => 404,
        'msg' => 'Categoria ID não informada!'
    ]);
}

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
} else {
    return json_encode([
        'status' => 404,
        'msg' => 'Arquivo não anexado!'
    ]);
}

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
