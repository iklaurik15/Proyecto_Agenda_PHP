
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Agenda- Insertar contacto</title>
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>NUEVO CONTACTO</h1>
        
        <a href="vistaListado.php" >Volver</a><br><br>

        <div>

            <form name="insertForm" action="../controlador/controladorInsertar.php" method="post">


                <fieldset name="personal">
                    <legend>Datos Personales: </legend>
                    <div>
                        <label>Nombre: </label>
                        <input type="text" name="nombre" placeholder="Nombre" required
                               maxlength="20" />
                    </div>
                    <div>
                        <label>Apellido: </label>
                        <input type="text" name="apellido" placeholder="Apellido"
                               required maxlength="20" />
                    </div>
                    <div>
                        <label>Teléfono: </label>
                        <input type="number" name="telefono" placeholder="Teléfono"
                               required maxlength="9" />
                    </div>
                    <div>
                        <label>Poblacion: </label>
                        <input type="text" name="poblacion" placeholder="Poblacion" required
                               maxlength="20" />
                    </div>
                </fieldset>

                <fieldset name="emails">
                    <legend>Correos electrónicos: </legend>
                    <div>
                        <label>Dirección e-mail 1: </label>
                        <input type="email" name="email1" placeholder="Email 1" size="50" required
                               maxlength="50" />
                    </div>
                    <div>
                        <label>Dirección e-mail 2: </label>
                        <input type="email" name="email2" placeholder="Email 2" size="50"
                               required maxlength="50" />
                    </div>
                </fieldset>

                <fieldset name="grupos">
                    <legend>Pertenece a los grupos: </legend>
                    <div>
                        <label>Grupo 1: </label>
                        <select id="grupos" name="grupo1" >
                            <option value="nada"></option>
                            <?php
                            $link = mysqli_connect('localhost', 'root', '', 'agenda');
                            $sql = mysqli_query($link, "select idGrupo, nombreGrupo from grupos");
                            while ($row = $sql->fetch_assoc()) {
                                echo '<option value="' . $row['idGrupo'] . '">' . $row['nombreGrupo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label>Grupo 2: </label>
                        <select id="grupos" name="grupo2">
                            <option value="nada"></option>
                            <?php
                            $link = mysqli_connect('localhost', 'root', '', 'agenda');
                            $sql = mysqli_query($link, "select idGrupo, nombreGrupo from grupos");
                            while ($row = $sql->fetch_assoc()) {
                                echo '<option value="' . $row['idGrupo'] . '">' . $row['nombreGrupo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </fieldset>

                <br><input type="submit" value="Insertar">
            </form>
        </div>


    </body>
</html>