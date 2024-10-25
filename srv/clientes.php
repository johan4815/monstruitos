<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CLIENTE.php";

ejecutaServicio(function () {

    $lista = select(pdo: Bd::pdo(), from: CLIENTE, orderBy: CLI_NOMBRE);

    $render = "";
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[CLI_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[CLI_NOMBRE]);

        $render .=
            "<li>
                <p>
                    <a href='modifica-cliente.html?id=$id'>$nombre</a>
                </p>
            </li>";
    }

    devuelveJson(["lista" => ["innerHTML" => $render]]);
});
