<?php

    ini_set( 'display_errors', 0 );
    $db = 'DATABASE';
    $host = 'mysql:host=localhost;dbname=' . $db;
    $user = 'USER';
    $pass = 'PASS';
    $opt = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    global $pdo;

    try {
        $pdo = new PDO( $host, $user, $pass, $opt );
    }
    catch ( PDOException $e ) {
        echo '<h1>Ocorreu um erro, veja o log para maiores informações</h1>';
        echo '<pre>' . $e->getMessage() . '</pre>';
        exit;
    }

    function getRegistros( $pg = 1, $itens = 5 ) {

        global $pdo;
        $pg -=1;

        $sql = "select
                    noticiaID, titulo, descricao
                from noticias
                limit " . $itens . " offset " . $pg * $itens;

        $results = array();
        foreach ( $pdo->query( $sql ) as $row ) {
            $results[] = $row;
        }
        return $results;
    }

?>
