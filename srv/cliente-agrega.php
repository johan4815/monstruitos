<?php
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";

ejecutaServicio(function () {
    $nombre = validaNombre(recuperaTexto("nombre"));
    $email = validaNombre(recuperaTexto("email"));
    $password = validaNombre(recuperaTexto("password"));
    $direccion = recuperaTexto("direccion");
    $telefono = recuperaTexto("telefono");
    $estatus = "activo";

    $pdo = Bd::pdo();
    $pdo->prepare("INSERT INTO CLIENTE (CLI_NOMBRE, CLI_EMAIL, CLI_PASSWORD, CLI_DIRECCION, CLI_TELEFONO, CLI_ESTATUS) 
                   VALUES (?, ?, ?, ?, ?, ?)")
        ->execute([$nombre, $email, $password, $direccion, $telefono, $estatus]);

    $id = $pdo->lastInsertId();
    devuelveCreated("/srv/cliente.php?id=" . urlencode($id), [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "email" => ["value" => $email]
    ]);
});
