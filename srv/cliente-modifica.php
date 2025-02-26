<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CLIENTE.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");
    $nombre = recuperaTexto("nombre");
    $email = recuperaTexto("email");
    $telefono = recuperaTexto("telefono");
    $direccion = recuperaTexto("direccion");

    $nombre = validaNombre($nombre);
    $email = validaNombre($email);
    $telefono = validaNombre($telefono);
    $direccion = validaNombre($direccion);

    update(
        pdo: Bd::pdo(),
        table: CLIENTE,
        set: [
            CLI_NOMBRE => $nombre,
            CLI_EMAIL => $email,
            CLI_TELEFONO => $telefono,
            CLI_DIRECCION => $direccion
        ],
        where: [CLI_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "email" => ["value" => $email],
        "telefono" => ["value" => $telefono],
        "direccion" => ["value" => $direccion],
    ]);
});
