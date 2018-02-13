<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Agenda</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <a href="../vista/vistaLogin.php" >Volver</a> <a href="../controlador/controladorListarGrupos.php" >Listar Grupos</a><br><br>
        <div class="container">
            <h1>Agenda</h1> 
            <div id="admin">
                <p><a href="../vista/vistaInsertar.php">Insertar</a> <a href="../vista/vistaEliminar.php">Eliminar</a> <a href="../controlador/controladorListadoModificar.php">Modificar</a></p>
            </div>

            <?php
            if (isset($_SESSION['Logueado'])) {
                echo '<style type = "text/css"> #admin{ display:block;}</style>';
            } else {
                echo '<style type = "text/css"> #admin{ display:none;}</style>';
            }
            ?>

            <form action="../controlador/controladorContacto.php" method="POST">
                <fieldset id="datos">
                    <legend>Buscar por:</legend>
                    <div>
                        <label>Nombre:</label> &nbsp;&emsp;
                        <input type="text" name="nombre" placeholder="EJ.: Sara" >
                    </div>

                    <div>
                        <label>Apellidos:</label> &nbsp;&nbsp;&nbsp;
                        <input type="text" name="apellido" placeholder="EJ.: García" >
                    </div>
                    <div>
                        <label>Grupo:</label> &emsp; &emsp;
                        <select name="grupo" >
                            <option value=""></option>
                            <?php
                            $link = mysqli_connect('localhost', 'root', '', 'agenda');
                            $sql = mysqli_query($link, "select idGrupo, nombreGrupo from grupos");
                            while ($row = $sql->fetch_assoc()) {
                                echo '<option value="' . $row['idGrupo'] . '">' . $row['nombreGrupo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div>
                        <button type="submit" >Buscar</button>
                        <button type="reset" name="resetear">Resetear</button>
                    </div>
                </fieldset>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Email(s)</th>
                        <th>Grupo(s)</th>
                        <th>Población</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    for ($i = 0; $i < count($contacto); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $contacto[$i]["nombre"]; ?></td>
                            <td><?php echo $contacto[$i]["apellido"]; ?></td>
                            <td><?php echo $contacto[$i]["telefono"]; ?></td>
                            <td><?php echo $contacto[$i]["email"]; ?></td>
                            <td><?php echo $contacto[$i]["grupo"]; ?></td>
                            <td><?php echo $contacto[$i]["poblacion"]; ?></td>
                        </tr>
    <?php
}
?>


                </tbody>
            </table>
        </div>

    </body>
</html>
