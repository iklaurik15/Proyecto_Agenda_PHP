
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Agenda- Modificar contacto</title>
        <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>

        <script type="text/javascript">
            function rellenarDatos() {

                var e = document.getElementById('contactos');
                var title = e.options[e.selectedIndex].title;

                var datos = title.split('-');
                var correo = datos[4].split(',');
                var grupo = datos[5].split(',');

                if (correo[1] == null) {
                    correo[1] = '';
                }
                if (grupo[0] == null) {
                    grupo[0] = '';
                }
                if (grupo[1] == null) {
                    grupo[1] = '';
                }

                document.getElementById('nombre').value = datos[0];
                document.getElementById('apellido').value = datos[1];
                document.getElementById('telefono').value = datos[2];
                document.getElementById('poblacion').value = datos[3];

                document.getElementById('email1').value = correo[0];
                document.getElementById('email2').value = correo[1];

                document.getElementById('grupo1').value = grupo[0];
                document.getElementById('grupo2').value = grupo[1];



            }
        </script>
    </head>
    <body>
        <h1>MODIFICAR CONTACTOS</h1>

        <a href="../controlador/controladorContacto.php" >Volver</a><br><br>

        <div>



            <form name="insertForm" action="../controlador/controladorModificar.php" method="post">

                <div>
                    <label>Selección contacto: </label>
                    <select id="contactos" name="contacts" onchange="rellenarDatos()"> 
                        <?php
                        for ($i = 0; $i < count($pd); $i++) {
                            echo'<option value="' . $pd[$i]['idContacto'] . '" '
                            . 'title="' . $pd[$i]['nombre'] . "-"
                            . $pd[$i]['apellido'] . "-"
                            . $pd[$i]['telefono'] . "-"
                            . $pd[$i]['poblacion'] . "-"
                            . $pd[$i]['correo'] . "-"
                            . $pd[$i]['grupos'] . '" >'
                            . $pd[$i]['nombre'] . " " . $pd[$i]['apellido'] . "</option>";
                        }
                        ?>
                    </select><br/>
                </div>
                <input id="idContacto" type="text" name="idContacto" hidden value="">

                <fieldset name="personal">
                    <legend>Datos Personales: </legend>
                    <div>
                        <label>Nombre: </label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required
                               maxlength="20" />
                    </div>
                    <div>
                        <label>Apellido: </label>
                        <input type="text" id="apellido" name="apellido" placeholder="Apellido"
                               required maxlength="20" />
                    </div>
                    <div>
                        <label>Teléfono: </label>
                        <input type="number" id="telefono" name="telefono" placeholder="Teléfono"
                               required maxlength="9" />
                    </div>
                    <div>
                        <label>Población: </label>
                        <input type="text" id="poblacion" name="poblacion" placeholder="Población"
                               required maxlength="30" />
                    </div>
                </fieldset>

                <fieldset name="emails">
                    <legend>Correos electrónicos: </legend>
                    <div>
                        <label>Dirección e-mail 1: </label>
                        <input type="email" id="email1" name="email1" placeholder="Email 1" size="50" required
                               maxlength="50" />
                    </div>
                    <div>
                        <label>Dirección e-mail 2: </label>
                        <input type="email" id="email2" name="email2" placeholder="Email 2" size="50"
                               required maxlength="50" />
                    </div>
                </fieldset>

                <fieldset name="grupos">
                    <legend>Pertenece a los grupos: </legend>
                    Grupo 1: &nbsp;&nbsp;<input id="grupo1" type="text" name="grupo1" value="">
                    Grupo 2: &nbsp;&nbsp;<input id="grupo2" type="text" name="grupo2" value="">
                </fieldset>

                <br><input name="modificar" type="submit" value="Modificar">
            </form>
        </div>


    </body>
</html>