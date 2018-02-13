<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar contacto</title>
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <a href="vistaListado.php" >Volver</a><br><br>

        <form action="../controlador/controladorEliminar.php" method="post">

            <select id="eliminar" name="eliminar">
                <?php
                $link = mysqli_connect('localhost', 'root', '', 'agenda');
                $sql = mysqli_query($link, "SELECT idContacto, nombre, apellido FROM contactos");
                while ($row = $sql->fetch_assoc()) {
                                echo '<option value="' . $row['idContacto'] . '">' . $row['idContacto'] . " " . $row['nombre'] . " " . $row['apellido'] . "</option>";
                            }
                ?>
            </select>
            <input type="submit" value="Eliminar" />

        </form>




    </body>
</html>
