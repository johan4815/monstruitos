<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CLIENTE.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");

    $modelo = selectFirst(pdo: Bd::pdo(), from: CLIENTE, where: [CLI_ID => $id]);

    if ($modelo === false) {
        $idHtml = htmlentities($id);
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Cliente no encontrado.",
            type: "/error/cliente-no-encontrado.html",
            detail: "No se encontró ningún cliente con el id $idHtml."
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[CLI_NOMBRE]],
        "email" => ["value" => $modelo[CLI_EMAIL]],
        "telefono" => ["value" => $modelo[CLI_TELEFONO]],
        "direccion" => ["value" => $modelo[CLI_DIRECCION]],
    ]);
});
