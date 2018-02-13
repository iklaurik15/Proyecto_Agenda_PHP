
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Agenda</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <a href="../controlador/controladorContacto.php" >Volver</a> 
        <div class="container">
            <h1>Grupos</h1>

            <table>
                <thead>
                    <tr>
                        <th>Nombre del grupo</th>
                        <th>Miembros</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    for ($i = 0; $i < count($grupo); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $grupo[$i]["nombreGrupo"]; ?></td>
                            
                        <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>

    </body>
</html>

