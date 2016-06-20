<?php

    include("functions.php");

    $exec = filter_input( INPUT_POST, 'exec' );
    if ( $exec == "scroll" ) {
        $pg = filter_input( INPUT_POST, 'pg' );
        $registros = getRegistros( $pg );
        $pg += 1;
        $html = "";
        foreach ( $registros as $registro ) {
            $html .= '<article class="col-md-8 col-md-offset-4">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="http://lorempixel.com/800/400/abstract" class="img-responsive">
                            </div>
                            <div class="col-md-8">
                                <h2>' . $registro[ 'titulo' ] . '</h2>
                                <p>' . nl2br( $registro[ 'descricao' ] ) . '</p>
                            </div>
                        </div>
                    </article>

                    <div class="clearfix"></div>
                    <br>';
        }
        die( json_encode( array( "results" => $html, "pg" => $pg, "totalItens" => count( $registros ) ) ) );
    }
?>