-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2018 a las 12:23:09
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarContactos` ()  NO SQL
BEGIN
SELECT contactos.idContacto, contactos.nombre, contactos.apellido, contactos.telefono, contactos.poblacion, GROUP_CONCAT(DISTINCT email) as correo, GROUP_CONCAT(DISTINCT grupos.nombreGrupo) as grupos, grupos.idGrupo FROM contactos LEFT JOIN emails ON emails.idContacto=contactos.idContacto LEFT JOIN contactosgrupos ON contactosgrupos.idContacto=contactos.idContacto LEFT JOIN grupos ON contactosgrupos.idGrupo=grupos.idGrupo GROUP BY contactos.idContacto ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarContacto` (IN `pIdContacto` INT(11))  NO SQL
BEGIN

DELETE FROM contactos where idContacto = pIdContacto;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertarContacto` (IN `pNombre` VARCHAR(20), IN `pApellido` VARCHAR(20), IN `pTelefono` INT(9), IN `pGrupo1` INT(11), IN `pGrupo2` INT(11), IN `pEmail1` VARCHAR(50), IN `pEmail2` VARCHAR(50), IN `pPoblacion` VARCHAR(30))  NO SQL
BEGIN
	DECLARE vIdContacto int(11);
    
	INSERT INTO contactos (nombre, apellido, telefono, poblacion) 
    	VALUES (pNombre, pApellido, pTelefono, pPoblacion);
     
    SET vIdContacto = (select max(idContacto) from contactos);
    
    INSERT into contactosgrupos (idcontacto, idgrupo) 
    	values (vIdContacto, pGrupo1);
                                
    INSERT into contactosgrupos (idcontacto, idgrupo) 
    	values (vIdContacto, pGrupo2);
                              
    INSERT into emails (email, idcontacto)
    	values (pEmail1, vIdContacto);
        
    INSERT into emails (email, idcontacto)
    	values (pEmail2, vIdContacto);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarGrupos` ()  NO SQL
BEGIN

	SELECT nombreGrupo FROM grupos;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spSacarListado` (IN `pNombre` VARCHAR(20), IN `pApellido` VARCHAR(20), IN `pGrupo` VARCHAR(2))  NO SQL
BEGIN

select c.idContacto, c.nombre, c.apellido, c.telefono, c.poblacion, group_concat(distinct e.email separator '<br>') as email, group_concat(distinct g.nombreGrupo separator '<br>') as grupo
	from contactos c, emails e, grupos g, contactosgrupos cg
    WHERE (cg.idContacto = c.idContacto) 
    	AND (g.idGrupo = cg.idGrupo) 
        AND (e.idContacto = c.idContacto)
        AND c.nombre LIKE CONCAT('%',pNombre, '%') 
        AND c.apellido LIKE CONCAT('%',pApellido, '%') 
        AND cg.idGrupo like CONCAT('%',pGrupo, '%')
    group by c.idContacto;
                
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateContacto` (IN `pnombre` VARCHAR(50), IN `papellidos` VARCHAR(50), IN `ptelefono` INT(9), IN `pcorreo1` VARCHAR(50), IN `pcorreo2` VARCHAR(50), IN `pgrupo1` VARCHAR(50), IN `pgrupo2` VARCHAR(50), IN `pidContacBorrar` INT, IN `pPoblacion` VARCHAR(30))  NO SQL
BEGIN 

DECLARE pidContacto INT (11); 
DECLARE pidGrupo1 INT;
DECLARE pidGrupo2 INT;

IF pidContacBorrar <> '' THEN 
    DELETE FROM contactos WHERE idContacto =                 pidContacBorrar; 
END IF; 

INSERT INTO contactos(nombre, apellido, telefono, poblacion) VALUES (pnombre,papellidos,ptelefono,pPoblacion); 

SET pidContacto = (SELECT MAX(idContacto) FROM contactos);

SET pidGrupo1 = (SELECT idGrupo FROM grupos WHERE nombreGrupo = pgrupo1);

INSERT INTO emails(email, idContacto) VALUES (pcorreo1,pidContacto); 

INSERT INTO contactosgrupos(idGrupo,idContacto) VALUES (pidGrupo1,pidContacto); 

IF pcorreo2 <> '' THEN 
    INSERT INTO emails(email,idContacto) VALUES             (pcorreo2,pidContacto); 
END IF; 

IF pgrupo2 <> '' THEN 
    SET pidGrupo2 = (SELECT idGrupo FROM grupos WHERE         nombreGrupo = pgrupo2);
    INSERT INTO contactosgrupos(idGrupo,idContacto)         VALUES(pidGrupo2,pidContacto); 
END IF;

UPDATE contactos SET idContacto = pidContacBorrar WHERE idContacto = pidContacto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idContacto` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `telefono` int(9) NOT NULL,
  `poblacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `nombre`, `apellido`, `telefono`, `poblacion`) VALUES
(2, 'asdasd', 'asdasd', 12123, 'Bilbao'),
(4, 'Soraya', 'Cabo', 333333333, 'Bermeo'),
(5, 'Duztin', 'Prince', 444444444, 'Beasain'),
(8, 'Lalalander', 'Zabalalgo', 654654654, 'Amorebieta'),
(9, 'Hodei', 'Baranda', 666987542, 'Bilbao'),
(11, 'Augusto', 'Mequedao', 778552114, 'Lazkao'),
(12, 'Mikelon', 'sainz', 555555555, 'Bilbao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactosgrupos`
--

CREATE TABLE `contactosgrupos` (
  `idContactosGrupos` int(11) NOT NULL,
  `idcontacto` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactosgrupos`
--

INSERT INTO `contactosgrupos` (`idContactosGrupos`, `idcontacto`, `idgrupo`) VALUES
(7, 4, 1),
(9, 8, 1),
(10, 8, 2),
(11, 9, 1),
(12, 9, 4),
(25, 2, 1),
(26, 2, 4),
(39, 5, 4),
(40, 5, 1),
(41, 12, 3),
(42, 12, 4),
(45, 11, 3),
(46, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emails`
--

CREATE TABLE `emails` (
  `idEmail` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idcontacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emails`
--

INSERT INTO `emails` (`idEmail`, `email`, `idcontacto`) VALUES
(7, 'soraya1@gmail.com', 4),
(8, 'soraya2@gmail.com', 4),
(10, 'lander1@gmail.com', 8),
(11, 'lander2@gmail.com', 8),
(12, 'hodei@gmail.com', 9),
(13, 'h@gmail.com', 9),
(32, 'asd', 2),
(33, 'asd', 2),
(46, 'duztin1@gmail.com', 5),
(47, 'duzt@gmail.com', 5),
(48, 'mikelon@gmail.com', 12),
(49, 'mkl@gmail.com', 12),
(52, 'august@gmail.com', 11),
(53, 'A.mequedao@gmail.com', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `nombreGrupo`) VALUES
(1, 'Familia'),
(2, 'Amigos'),
(3, 'Trabajo'),
(4, 'WhatsApp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `user`, `pass`, `esAdmin`) VALUES
(1, 'admin', 'admin', 1),
(9, 'asd', '$2y$12$1mr5fLENJDSDW', 1),
(11, 'Hodei', '$2y$12$BfZBuoj9QgUZK2hl3P6fceNSbq3dGkRiiMuSSTLXfVco7hYkNAPrC', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `idContacto` (`idContacto`);

--
-- Indices de la tabla `contactosgrupos`
--
ALTER TABLE `contactosgrupos`
  ADD PRIMARY KEY (`idContactosGrupos`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idcontacto` (`idcontacto`);

--
-- Indices de la tabla `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`idEmail`),
  ADD KEY `idcontacto` (`idcontacto`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `idGrupo` (`idGrupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `contactosgrupos`
--
ALTER TABLE `contactosgrupos`
  MODIFY `idContactosGrupos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `emails`
--
ALTER TABLE `emails`
  MODIFY `idEmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactosgrupos`
--
ALTER TABLE `contactosgrupos`
  ADD CONSTRAINT `contactosgrupos_ibfk_1` FOREIGN KEY (`idcontacto`) REFERENCES `contactos` (`idContacto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactosgrupos_ibfk_2` FOREIGN KEY (`idgrupo`) REFERENCES `grupos` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`idcontacto`) REFERENCES `contactos` (`idContacto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
