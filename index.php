<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Paginação com Scroll =]</title>

        <link href="css/bootstrap.css" rel="stylesheet">
    </head>

    <body class="container-fluid">
        <div class="row"><h1 class="col-md-8 col-md-offset-4">Exemplo de Paginação</h1></div>

        <section class="row" id="res" >
            <!--Some Stuff =]-->
        </section>

        <span id="page" style="display:none">1</span>
        <span id="trigger" style="display:none">true</span>

        <script src=js/jquery.min.js></script>

        <script>
            $(document).ready(function () {
                $(window).scroll(function (event) {
                    if ($('body').height() <= ($(window).height() + 400 + $(window).scrollTop())) {
                        getPagination($("#page").html());
                    }
                });

            });

            function getPagination(pg) {

                if ($("#trigger").html() === "true") {
                    $("#trigger").html("false");
                    $("#res").fadeTo("slow", 0.3);

                    setTimeout(function () {

                        $.ajax({
                            type: "POST",
                            url: "actions.php",
                            data: {
                                exec: 'scroll',
                                pg: pg
                            },
                            dataType: 'json',
                            processData: true,
                            success: function (data) {
                                if (data.results !== "") {
                                    $("#res").append(data.results);
                                    setTimeout(function () {
                                        if (data.totalItens < 5) {
                                            $("#trigger").html("false");
                                        }
                                        else {
                                            $("#trigger").html("true");
                                        }
                                        $("#page").html(data.pg);
                                    }, 500);
                                }
                                else {
                                    $("#re").append('<div class="col-md-12"><h3>Sem Mais Resultados...</h3></div>');
                                }
                                $("#res").fadeTo("slow", 1);
                            }
                        });

                    }, 1000);
                }
            }
            getPagination(1);
        </script>
    </body>
</html>