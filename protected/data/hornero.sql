-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-06-2014 a las 23:14:35
-- Versión del servidor: 5.5.35-0ubuntu0.12.04.2
-- Versión de PHP: 5.5.11-2+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hornero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Complejidad`
--

CREATE TABLE IF NOT EXISTS `Complejidad` (
  `idComplejidad` int(11) NOT NULL AUTO_INCREMENT,
  `Complejidad` varchar(100) NOT NULL,
  PRIMARY KEY (`idComplejidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Complejidad de los Problemas' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Complejidad`
--

INSERT INTO `Complejidad` (`idComplejidad`, `Complejidad`) VALUES
(1, 'Baja'),
(2, 'Media'),
(3, 'Alta');


--
-- Volcado de datos para la tabla `Equipo`
--

INSERT INTO `Equipo` (`id`, `Equipo`) VALUES
(1, 'leones'),
(2, 'Harry Potter'),
(3, 'Anonymous'),
(4, 'Global Core'),
(5, 'Los 57'),
(6, 'Los Angelitos'),
(7, 'PseBlue'),
(8, 'yenesepa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoResolucion`
--

CREATE TABLE IF NOT EXISTS `EstadoResolucion` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(100) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Estados de la Resolución' AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `EstadoResolucion`
--

INSERT INTO `EstadoResolucion` (`idEstado`, `Estado`) VALUES
(1, 'Iniciado en Espera de Respuesta'),
(2, 'Respuesta Correcta'),
(3, 'Respuesta Incorrecta '),
(4, 'Supera Tiempo máximo del Problema, Respuesta Correcta '),
(5, 'Supera Tiempo máximo del Problema, Respuesta Incorrecta '),
(6, 'Torneo Terminado, Respuesta Correcta'),
(7, 'Torneo Terminado, Respuesta incorrecta'),
(8, 'Torneo Terminado, Supera Tiempo máximo del Problema, Respuesta Correcta '),
(9, 'Torneo Terminado, Supera Tiempo máximo del Problema, Respuesta Incorrecta '),
(10, 'Problema Solucionado, Respuesta Correcta'),
(11, 'Problema Solucionado, Respuesta incorrecta'),
(12, 'Problema Solucionado, Supera Tiempo máximo del Problema, Respuesta Correcta'),
(13, 'Problema Solucionado, Supera Tiempo máximo del Problema, Respuesta Incorrecta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoTorneo`
--

CREATE TABLE IF NOT EXISTS `EstadoTorneo` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(100) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Estados del Torneo' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `EstadoTorneo`
--

INSERT INTO `EstadoTorneo` (`idEstado`, `Estado`) VALUES
(1, 'Antes de comienzo'),
(2, 'En Proceso'),
(3, 'Terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lenguaje`
--

CREATE TABLE IF NOT EXISTS `Lenguaje` (
  `idLenguaje` int(11) NOT NULL AUTO_INCREMENT,
  `Lenguaje` varchar(255) NOT NULL,
  PRIMARY KEY (`idLenguaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Lenguaje`
--

INSERT INTO `Lenguaje` (`idLenguaje`, `Lenguaje`) VALUES
(1, 'PHP'),
(2, 'Python'),
(3, 'JavaScript'),
(4, 'java'),
(5, 'c#'),
(6, 'VisualBasic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Problema`
--

CREATE TABLE IF NOT EXISTS `Problema` (
  `idProblema` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Archivo` varchar(255) DEFAULT NULL,
  `Enunciado` text NOT NULL,
  `idComplejidad` int(11) NOT NULL,
  `TiempoEjecucionMax` double NOT NULL COMMENT 'Tiempo Máximo en Segundos',
  PRIMARY KEY (`idProblema`),
  KEY `idComplejidad` (`idComplejidad`),
  KEY `idTipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Problema a Resolver' AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Problema`
--

INSERT INTO `Problema` (`idProblema`, `idTipo`, `Nombre`, `Archivo`, `Enunciado`, `idComplejidad`, `TiempoEjecucionMax`) VALUES
(1, 1, 'Suma de dos números', '7ae1a2c66f28ff205ea890d3e639bc5f.gif', 'Dados dos números enteros se debe devolver el resultado de la suma', 1, 2000),
(2, 1, 'Máximo', NULL, 'Dados dos números devolver el máximos de ambos', 1, 2000),
(3, 1, 'Área de Corona ', 'a48fee16262b89aef908eb37ad64adf1.jpeg', '¿Cuál es el área de una vereda en forma de corona circular, si el radio interior es r  y el radio exterior R?\r\nLa respuesta debe ser un número con dos decimales con punto ''.'' como separador decimal.', 1, 5000),
(4, 1, 'Área de Corazón', NULL, 'Hallar el área del siguiente corazón: diametro D, y diagonal d', 1, 2000),
(5, 3, 'Suma de múltiplos', NULL, 'Si listamos todos los números naturales menores que 10 que son múltiplos de 3 o 5 tenemos:\r\n3, 5, 6 y 9.  La suma de estos múltiplos es 23.\r\nSe requiere un programa que dado un número natulal N devuelva la suma de todos los múltiplos de 3 y 5 menores que N.', 2, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Resolucion`
--

CREATE TABLE IF NOT EXISTS `Resolucion` (
  `idResolucion` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idProblema` int(11) NOT NULL,
  `idSolucion` int(11) NOT NULL,
  `idTorneo` int(11) NOT NULL,
  `Token` varchar(32) NOT NULL,
  `FechaSolicitud` bigint(20) NOT NULL,
  `FechaRespuesta` bigint(20) DEFAULT NULL,
  `Respuesta` varchar(2000) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResolucion`),
  UNIQUE KEY `Token` (`Token`),
  KEY `idUsuario` (`idUsuario`,`idSolucion`,`idTorneo`),
  KEY `idSolucion` (`idSolucion`),
  KEY `idTorneo` (`idTorneo`),
  KEY `idEstado` (`idEstado`),
  KEY `idProblema` (`idProblema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Rosolución por parte de un usuario de una Solución de un Problema de un Torneo' AUTO_INCREMENT=1129 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE IF NOT EXISTS `Rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` varchar(100) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`idRol`, `Rol`) VALUES
(1, 'Administrador'),
(2, 'Jugador'),
(3, 'Gestor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solucion`
--

CREATE TABLE IF NOT EXISTS `Solucion` (
  `idSolucion` int(11) NOT NULL AUTO_INCREMENT,
  `idProblema` int(11) NOT NULL,
  `ParametrosEntrada` varchar(2000) NOT NULL,
  `Salida` varchar(2000) NOT NULL,
  PRIMARY KEY (`idSolucion`),
  KEY `idProblema` (`idProblema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Solución de un Problema dados Parámetros de Entrada' AUTO_INCREMENT=803 ;

--
-- Volcado de datos para la tabla `Solucion`
--

INSERT INTO `Solucion` (`idSolucion`, `idProblema`, `ParametrosEntrada`, `Salida`) VALUES
(1, 1, '1,2', '3'),
(2, 1, '10000,-265', '9735'),
(3, 1, '3185,-9381', '-6196'),
(4, 1, '-7901,-7194', '-15095'),
(5, 1, '2431,-4026', '-1595'),
(6, 1, '135,1801', '1936'),
(7, 1, '9025,590', '9615'),
(8, 1, '-2559,-5793', '-8352'),
(9, 1, '3843,2209', '6052'),
(10, 1, '5033,8574', '13607'),
(11, 1, '1603,-8181', '-6578'),
(12, 1, '-4870,8958', '4088'),
(13, 1, '-9135,686', '-8449'),
(14, 1, '-4016,-7785', '-11801'),
(15, 1, '9429,-1947', '7482'),
(16, 1, '-604,-3920', '-4524'),
(17, 1, '2284,-427', '1857'),
(18, 1, '559,-4532', '-3973'),
(19, 1, '192,2658', '2850'),
(20, 1, '-1726,-7377', '-9103'),
(21, 1, '8633,8409', '17042'),
(22, 1, '4424,7658', '12082'),
(23, 1, '-1001,-8136', '-9137'),
(24, 1, '-8136,-7158', '-15294'),
(25, 1, '4074,6897', '10971'),
(26, 1, '-8585,-4324', '-12909'),
(27, 1, '8717,-3454', '5263'),
(28, 1, '-5367,9582', '4215'),
(29, 1, '7233,618', '7851'),
(30, 1, '-8203,6661', '-1542'),
(31, 1, '8671,1193', '9864'),
(32, 1, '-7259,954', '-6305'),
(33, 1, '-9234,3301', '-5933'),
(34, 1, '6423,959', '7382'),
(35, 1, '-4041,-5303', '-9344'),
(36, 1, '3582,-5409', '-1827'),
(37, 1, '-6895,-1994', '-8889'),
(38, 1, '-7752,2105', '-5647'),
(39, 1, '-129,-5887', '-6016'),
(40, 1, '4947,-6056', '-1109'),
(41, 1, '-8991,6363', '-2628'),
(42, 1, '-380,9726', '9346'),
(43, 1, '-7091,4253', '-2838'),
(44, 1, '9308,-9858', '-550'),
(45, 1, '-5129,-8896', '-14025'),
(46, 1, '6804,-6459', '345'),
(47, 1, '2298,9545', '11843'),
(48, 1, '4496,3064', '7560'),
(49, 1, '2845,918', '3763'),
(50, 1, '-5978,8804', '2826'),
(51, 1, '5615,7605', '13220'),
(52, 1, '-6605,8721', '2116'),
(53, 1, '-4390,-4356', '-8746'),
(54, 1, '826,5481', '6307'),
(55, 1, '-243,-4227', '-4470'),
(56, 1, '9425,767', '10192'),
(57, 1, '-7864,-955', '-8819'),
(58, 1, '493,-4955', '-4462'),
(59, 1, '-6702,-200', '-6902'),
(60, 1, '-4813,-1831', '-6644'),
(61, 1, '905,-8010', '-7105'),
(62, 1, '1710,-6798', '-5088'),
(63, 1, '-8465,-3794', '-12259'),
(64, 1, '6267,4381', '10648'),
(65, 1, '7124,-9711', '-2587'),
(66, 1, '3185,2739', '5924'),
(67, 1, '7894,6580', '14474'),
(68, 1, '1459,-6496', '-5037'),
(69, 1, '-7777,-7716', '-15493'),
(70, 1, '8985,1981', '10966'),
(71, 1, '-1942,8410', '6468'),
(72, 1, '-7253,194', '-7059'),
(73, 1, '-2545,3240', '695'),
(74, 1, '5239,753', '5992'),
(75, 1, '-6960,-9574', '-16534'),
(76, 1, '8922,3945', '12867'),
(77, 1, '-7584,632', '-6952'),
(78, 1, '7147,-6049', '1098'),
(79, 1, '6838,3414', '10252'),
(80, 1, '8333,3962', '12295'),
(81, 1, '3703,1517', '5220'),
(82, 1, '-3300,1597', '-1703'),
(83, 1, '-1904,8160', '6256'),
(84, 1, '5101,320', '5421'),
(85, 1, '-9556,4086', '-5470'),
(86, 1, '-7700,-1498', '-9198'),
(87, 1, '2495,-4953', '-2458'),
(88, 1, '8696,9950', '18646'),
(89, 1, '8288,3935', '12223'),
(90, 1, '703,-8673', '-7970'),
(91, 1, '4361,-376', '3985'),
(92, 1, '5273,6778', '12051'),
(93, 1, '-9744,2419', '-7325'),
(94, 1, '-9271,7095', '-2176'),
(95, 1, '-4168,9062', '4894'),
(96, 1, '1057,9536', '10593'),
(97, 1, '578,7758', '8336'),
(98, 1, '1132,8674', '9806'),
(99, 1, '5917,-3768', '2149'),
(100, 1, '-1006,6361', '5355'),
(101, 1, '-9682,1294', '-8388'),
(102, 1, '-5137,2813', '-2324'),
(103, 2, '-1611,3910', '3910'),
(104, 2, '3328,-1442', '3328'),
(105, 2, '276,2360', '2360'),
(106, 2, '-8001,7583', '7583'),
(107, 2, '1244,-5922', '1244'),
(108, 2, '-2044,-7833', '-2044'),
(109, 2, '-751,2762', '2762'),
(110, 2, '-120,-7277', '-120'),
(111, 2, '-7162,-4143', '-4143'),
(112, 2, '6074,-938', '6074'),
(113, 2, '9358,-8151', '9358'),
(114, 2, '-3027,-7171', '-3027'),
(115, 2, '7562,-5387', '7562'),
(116, 2, '-1081,4669', '4669'),
(117, 2, '978,8339', '8339'),
(118, 2, '-911,9367', '9367'),
(119, 2, '2249,-7583', '2249'),
(120, 2, '-2075,-7475', '-2075'),
(121, 2, '4777,-76', '4777'),
(122, 2, '-9893,-3980', '-3980'),
(123, 2, '4003,-1937', '4003'),
(124, 2, '-1812,-6749', '-1812'),
(125, 2, '-9175,8069', '8069'),
(126, 2, '-4025,-6336', '-4025'),
(127, 2, '-6074,-7951', '-6074'),
(128, 2, '2726,-6717', '2726'),
(129, 2, '-6101,9699', '9699'),
(130, 2, '-3888,-8540', '-3888'),
(131, 2, '-5688,5032', '5032'),
(132, 2, '6129,5290', '6129'),
(133, 2, '3371,-4782', '3371'),
(134, 2, '4657,-4380', '4657'),
(135, 2, '-2365,-7418', '-2365'),
(136, 2, '-1855,-7589', '-1855'),
(137, 2, '2507,-1747', '2507'),
(138, 2, '-1568,-3491', '-1568'),
(139, 2, '6316,6621', '6621'),
(140, 2, '-239,7141', '7141'),
(141, 2, '4689,5737', '5737'),
(142, 2, '-9196,8615', '8615'),
(143, 2, '7786,3531', '7786'),
(144, 2, '-8102,-8316', '-8102'),
(145, 2, '3230,-1989', '3230'),
(146, 2, '-6855,7542', '7542'),
(147, 2, '-6958,9274', '9274'),
(148, 2, '2832,6413', '6413'),
(149, 2, '-5508,-2511', '-2511'),
(150, 2, '-7968,2128', '2128'),
(151, 2, '71,178', '178'),
(152, 2, '4539,-7423', '4539'),
(153, 2, '8431,-7029', '8431'),
(154, 2, '-913,4747', '4747'),
(155, 2, '9592,8848', '9592'),
(156, 2, '1887,4281', '4281'),
(157, 2, '4584,2692', '4584'),
(158, 2, '2895,2370', '2895'),
(159, 2, '-3777,4793', '4793'),
(160, 2, '4055,9454', '9454'),
(161, 2, '-7197,7200', '7200'),
(162, 2, '6996,-4154', '6996'),
(163, 2, '6474,-173', '6474'),
(164, 2, '-7742,-9035', '-7742'),
(165, 2, '7317,-5709', '7317'),
(166, 2, '3093,-2613', '3093'),
(167, 2, '4470,-2368', '4470'),
(168, 2, '-35,2900', '2900'),
(169, 2, '604,9052', '9052'),
(170, 2, '-2354,196', '196'),
(171, 2, '7900,9534', '9534'),
(172, 2, '-5524,2483', '2483'),
(173, 2, '2226,7371', '7371'),
(174, 2, '-5148,8450', '8450'),
(175, 2, '2164,8907', '8907'),
(176, 2, '7903,4968', '7903'),
(177, 2, '6107,4898', '6107'),
(178, 2, '-9186,2580', '2580'),
(179, 2, '-5275,-6927', '-5275'),
(180, 2, '3546,-7959', '3546'),
(181, 2, '-2636,-3361', '-2636'),
(182, 2, '-571,-8167', '-571'),
(183, 2, '4272,9395', '9395'),
(184, 2, '4734,-5124', '4734'),
(185, 2, '8446,-7620', '8446'),
(186, 2, '5072,6345', '6345'),
(187, 2, '-8087,9548', '9548'),
(188, 2, '-1172,4140', '4140'),
(189, 2, '6918,3681', '6918'),
(190, 2, '2589,-918', '2589'),
(191, 2, '2588,491', '2588'),
(192, 2, '-5950,-1306', '-1306'),
(193, 2, '-4611,-5136', '-4611'),
(194, 2, '-8726,114', '114'),
(195, 2, '-2063,4821', '4821'),
(196, 2, '2155,5302', '5302'),
(197, 2, '-8541,-8416', '-8416'),
(198, 2, '7136,5732', '7136'),
(199, 2, '-9022,1869', '1869'),
(200, 2, '-9393,9425', '9425'),
(201, 2, '4249,5679', '5679'),
(202, 2, '5770,6163', '6163'),
(403, 3, '2649,3883', '25322769.89'),
(404, 3, '624,3108', '29123468.68'),
(405, 3, '6477,9587', '156950953.04'),
(406, 3, '335,3528', '38750159.94'),
(407, 3, '218,791', '1816333.78'),
(408, 3, '1930,8326', '206080234.54'),
(409, 3, '5236,7804', '105201633.54'),
(410, 3, '1199,9041', '252276424.6'),
(411, 3, '4248,9322', '216311786.06'),
(412, 3, '4911,9303', '196122994.32'),
(413, 3, '9080,9827', '44370374.95'),
(414, 3, '7568,9474', '102045375.94'),
(415, 3, '221,1913', '11343436.56'),
(416, 3, '1980,4995', '66066515.41'),
(417, 3, '1288,2843', '20180664.44'),
(418, 3, '6726,9524', '142840363.98'),
(419, 3, '147,3937', '48626702.07'),
(420, 3, '3523,9834', '264823779.15'),
(421, 3, '168,6624', '137756173.79'),
(422, 3, '7051,7414', '16495859'),
(423, 3, '386,5377', '90362047.33'),
(424, 3, '8190,9344', '63567727.17'),
(425, 3, '543,612', '250369.23'),
(426, 3, '7231,9934', '145760458.64'),
(427, 3, '2141,4790', '57680329.13'),
(428, 3, '4616,9237', '201108152.08'),
(429, 3, '1221,6804', '140754582.07'),
(430, 3, '3133,4090', '21715979.62'),
(431, 3, '7024,9085', '104302914.99'),
(432, 3, '5112,9867', '223760392.28'),
(433, 3, '372,4635', '67056795.68'),
(434, 3, '4309,6593', '78226184.86'),
(435, 3, '4782,6426', '57886835.44'),
(436, 3, '1405,7832', '186504414.65'),
(437, 3, '4882,6594', '61722594.4'),
(438, 3, '6980,8819', '91276967.07'),
(439, 3, '258,8162', '209078268.97'),
(440, 3, '870,5169', '81560963.47'),
(441, 3, '2399,8705', '219980047.87'),
(442, 3, '804,3495', '36343857.05'),
(443, 3, '40,4539', '64719702.07'),
(444, 3, '5760,8111', '102449601.52'),
(445, 3, '2200,6843', '131904948.05'),
(446, 3, '3867,8892', '201419992.85'),
(447, 3, '1284,4003', '45161503.38'),
(448, 3, '1656,3733', '35163698.92'),
(449, 3, '325,8638', '234078243.35'),
(450, 3, '3419,5964', '75020400.05'),
(451, 3, '3795,6751', '97935933.98'),
(452, 3, '3345,4823', '37926261.56'),
(453, 3, '3641,8677', '194883824.51'),
(454, 3, '324,8935', '250476822.93'),
(455, 3, '1803,5492', '84544201.01'),
(456, 3, '508,9805', '301215781.1'),
(457, 3, '608,7891', '194458983.8'),
(458, 3, '2430,4002', '31764970.05'),
(459, 3, '647,2112', '12698113.3'),
(460, 3, '7489,8189', '34477722.74'),
(461, 3, '4312,7080', '99064017.07'),
(462, 3, '1356,5595', '92567935.46'),
(463, 3, '1083,5088', '77644006.9'),
(464, 3, '7251,9720', '131637127.27'),
(465, 3, '3215,5413', '59578243.79'),
(466, 3, '2164,3138', '16223649.42'),
(467, 3, '7010,7960', '44678159.92'),
(468, 3, '5508,5686', '6259723.89'),
(469, 3, '1601,5832', '98800019.62'),
(470, 3, '3404,4621', '30682129.03'),
(471, 3, '1323,4425', '56015526.92'),
(472, 3, '3911,9214', '218660739.18'),
(473, 3, '5032,7912', '117114552.89'),
(474, 3, '1643,5679', '92839064.33'),
(475, 3, '24,9831', '303628599.66'),
(476, 3, '3168,4335', '27507788.42'),
(477, 3, '4523,6911', '85779277.32'),
(478, 3, '7993,9930', '109066204.06'),
(479, 3, '7180,9611', '128236422.34'),
(480, 3, '5024,7712', '107550439.01'),
(481, 3, '395,850', '1779633.7'),
(482, 3, '7187,7404', '9947058.31'),
(483, 3, '2695,8810', '221020703.58'),
(484, 3, '410,3090', '29468139.09'),
(485, 3, '7710,8527', '41675202.61'),
(486, 3, '3814,9850', '259105694.1'),
(487, 3, '2135,7724', '173107884.46'),
(488, 3, '7167,9063', '96673340.46'),
(489, 3, '706,5636', '98225224.4'),
(490, 3, '2845,5659', '75179116.45'),
(491, 3, '536,6012', '112647610.26'),
(492, 3, '7447,9993', '139493750.99'),
(493, 3, '535,9923', '308440636.82'),
(494, 3, '145,5440', '92904984.37'),
(495, 3, '3152,7103', '127289496.05'),
(496, 3, '5169,7497', '92634408.42'),
(497, 3, '2356,4001', '32852466.9'),
(498, 3, '2810,4900', '50623309.86'),
(499, 3, '5050,7989', '120390923.01'),
(500, 3, '3220,3576', '7600693.87'),
(501, 3, '5699,7033', '53358342.73'),
(502, 3, '3426,7833', '155880841.76'),
(503, 3, '5748,9107', '156759017.44'),
(504, 3, '837,1668', '6539712.06'),
(505, 3, '4236,8810', '187466386.03'),
(506, 3, '5894,9178', '155497677.42'),
(507, 3, '4303,5962', '53500176.21'),
(508, 3, '56,1784', '9988756.67'),
(509, 3, '1348,8741', '234325040.59'),
(510, 3, '1175,1248', '555681.77'),
(511, 3, '410,5264', '86524475.66'),
(512, 3, '2659,8804', '221294210.63'),
(513, 3, '650,9288', '269688274.62'),
(514, 3, '131,9758', '299084028.28'),
(515, 3, '1000,1440', '3372813.87'),
(516, 3, '5766,7719', '82737628.15'),
(517, 3, '2227,3916', '32595679.4'),
(518, 3, '1333,5919', '104482058.03'),
(519, 3, '6756,9663', '149948321.03'),
(520, 3, '3000,3899', '19484789.1'),
(521, 3, '5565,8894', '151217455.35'),
(522, 3, '1527,3076', '22399703.27'),
(523, 3, '3132,3197', '1292404.09'),
(524, 3, '3310,4544', '30447800.78'),
(525, 3, '1872,4484', '52156319.11'),
(526, 3, '5792,7136', '54585901.21'),
(527, 3, '4894,8450', '149072542.39'),
(528, 3, '5543,5939', '14284419.67'),
(529, 3, '6070,7738', '72356357.75'),
(530, 3, '5300,9177', '176329204.45'),
(531, 3, '1066,7069', '153417807.99'),
(532, 3, '6896,9296', '122084803.79'),
(533, 3, '2814,4981', '53067044.83'),
(534, 3, '628,4644', '66514905.5'),
(535, 3, '3628,9569', '246311473.2'),
(536, 3, '5133,8542', '146455001.94'),
(537, 3, '1617,2522', '11767762.05'),
(538, 3, '5718,6660', '36631209.1'),
(539, 3, '4748,9969', '241391990.43'),
(540, 3, '262,6620', '137462761.6'),
(541, 3, '4453,6053', '52808915.87'),
(542, 3, '3756,9347', '230149537.23'),
(543, 3, '4502,9695', '231613984.36'),
(544, 3, '2240,4889', '59328100.76'),
(545, 3, '189,5764', '104263098.45'),
(546, 3, '1416,2833', '18915004.72'),
(547, 3, '1254,8311', '212058148.14'),
(548, 3, '2128,6235', '107903783.36'),
(549, 3, '1125,2756', '19886001.9'),
(550, 3, '693,878', '913056.78'),
(551, 3, '6384,9419', '150677396.72'),
(552, 3, '5826,8905', '142492429.45'),
(553, 3, '1036,2486', '16043799.52'),
(554, 3, '4623,5784', '37958378.06'),
(555, 3, '2454,4884', '56018806.75'),
(556, 3, '2404,6907', '131718915.5'),
(557, 3, '936,6159', '116418580.16'),
(558, 3, '5438,6254', '29972905.07'),
(559, 3, '1142,5853', '103526300.72'),
(560, 3, '1617,7677', '176939650.46'),
(561, 3, '1331,9093', '254189679.65'),
(562, 3, '2585,4449', '41190602.52'),
(563, 3, '6577,7403', '36277478.34'),
(564, 3, '8528,8819', '15858687.46'),
(565, 3, '9332,9696', '21759273.9'),
(566, 3, '5715,9220', '164453500.42'),
(567, 3, '5046,9115', '181022052.73'),
(568, 3, '150,4620', '66984724.4'),
(569, 3, '7531,9242', '90159320.35'),
(570, 3, '5933,9985', '202631896.78'),
(571, 3, '4125,8336', '164849642.68'),
(572, 3, '5060,6892', '68788513.8'),
(573, 3, '3145,4495', '32402386.63'),
(574, 3, '348,497', '395542.22'),
(575, 3, '4287,8174', '152165889.6'),
(576, 3, '1965,5618', '87024312.48'),
(577, 3, '6413,7266', '36656690.56'),
(578, 3, '4669,8202', '142858406.14'),
(579, 3, '2990,7021', '126776901.23'),
(580, 3, '2321,3196', '15165645.84'),
(581, 3, '2416,6717', '123405004.7'),
(582, 3, '5831,8036', '96059646.05'),
(583, 3, '2656,7462', '152766565.26'),
(584, 3, '4993,5981', '34062127.73'),
(585, 3, '1897,1914', '203534.36'),
(586, 3, '4978,6022', '36078050.03'),
(587, 3, '250,1869', '10777739.39'),
(588, 3, '1082,4744', '67025288.64'),
(589, 3, '1579,5014', '71147507.45'),
(590, 3, '5092,9301', '190318113.35'),
(591, 3, '7056,9752', '142359285.61'),
(592, 3, '4918,7017', '78701812.56'),
(593, 3, '3120,3469', '7224283.94'),
(594, 3, '1686,6458', '122092243.08'),
(595, 3, '140,4881', '74784233.96'),
(596, 3, '6856,8779', '94455454.59'),
(597, 3, '6814,7297', '21411879.73'),
(598, 3, '2687,4758', '48438944.78'),
(599, 3, '8667,9469', '45694691.34'),
(600, 3, '1366,9751', '292846842.17'),
(601, 3, '580,4728', '69170280.14'),
(602, 3, '830,7387', '169265459.03'),
(603, 5, '4762', '6048374'),
(604, 5, '2495', '1658343'),
(605, 5, '5003', '6673334'),
(606, 5, '401', '42933'),
(607, 5, '3199', '2728533'),
(608, 5, '7845', '16403895'),
(609, 5, '6054', '9768734'),
(610, 5, '3735', '3716325'),
(611, 5, '3861', '3974513'),
(612, 5, '6047', '9750585'),
(613, 5, '1184', '373275'),
(614, 5, '4395', '5146545'),
(615, 5, '5969', '9498270'),
(616, 5, '6618', '11675475'),
(617, 5, '4539', '5490374'),
(618, 5, '3074', '2518425'),
(619, 5, '9766', '25437825'),
(620, 5, '9703', '25106835'),
(621, 5, '572', '87210'),
(622, 5, '3772', '3795134'),
(623, 5, '2064', '1134374'),
(624, 5, '5467', '7971614'),
(625, 5, '6579', '11536934'),
(626, 5, '7110', '13473450'),
(627, 5, '3458', '3187814'),
(628, 5, '9796', '25594335'),
(629, 5, '692', '127650'),
(630, 5, '9151', '22335150'),
(631, 5, '6832', '12448814'),
(632, 5, '4114', '4512783'),
(633, 5, '6985', '13008398'),
(634, 5, '1593', '675750'),
(635, 5, '6599', '11609400'),
(636, 5, '1988', '1053374'),
(637, 5, '1984', '1049403'),
(638, 5, '9789', '25545374'),
(639, 5, '9823', '25731675'),
(640, 5, '8028', '17181525'),
(641, 5, '3523', '3309975'),
(642, 5, '3684', '3616214'),
(643, 5, '4075', '4426808'),
(644, 5, '4697', '5882835'),
(645, 5, '8069', '17358570'),
(646, 5, '43', '495'),
(647, 5, '1314', '459374'),
(648, 5, '2607', '1811343'),
(649, 5, '3107', '2574045'),
(650, 5, '1080', '309960'),
(651, 5, '2309', '1420650'),
(652, 5, '3670', '3590483'),
(653, 5, '4842', '6250053'),
(654, 5, '4364', '5076495'),
(655, 5, '9128', '22216334'),
(656, 5, '1421', '538653'),
(657, 5, '1474', '579183'),
(658, 5, '2585', '1780203'),
(659, 5, '1217', '394875'),
(660, 5, '2156', '1239843'),
(661, 5, '1736', '803883'),
(662, 5, '8039', '17229720'),
(663, 5, '6260', '10445853'),
(664, 5, '8711', '20236233'),
(665, 5, '9623', '24691334'),
(666, 5, '2858', '2177414'),
(667, 5, '698', '129734'),
(668, 5, '1606', '688545'),
(669, 5, '2646', '1866488'),
(670, 5, '521', '72453'),
(671, 5, '9625', '24700958'),
(672, 5, '6160', '10116773'),
(673, 5, '4195', '4691408'),
(674, 5, '3699', '3645734'),
(675, 5, '856', '195795'),
(676, 5, '2263', '1365795'),
(677, 5, '3733', '3716325'),
(678, 5, '2161', '1246320'),
(679, 5, '4861', '6303420'),
(680, 5, '6831', '12441983'),
(681, 5, '3231', '2783183'),
(682, 5, '7161', '13673213'),
(683, 5, '500', '66333'),
(684, 5, '8064', '17334374'),
(685, 5, '1525', '619658'),
(686, 5, '9619', '24672093'),
(687, 5, '9475', '23937008'),
(688, 5, '2989', '2382033'),
(689, 5, '2204', '1294335'),
(690, 5, '692', '127650'),
(691, 5, '5135', '7028103'),
(692, 5, '3930', '4114710'),
(693, 5, '8721', '20279813'),
(694, 5, '1395', '517545'),
(695, 5, '2640', '1855920'),
(696, 5, '8343', '18556500'),
(697, 5, '4243', '4801095'),
(698, 5, '3329', '2953710'),
(699, 5, '9940', '26344313'),
(700, 5, '6880', '12620213'),
(701, 5, '3841', '3936000'),
(702, 5, '9565', '24393938'),
(703, 5, '5102', '6941100'),
(704, 5, '9117', '22161603'),
(705, 5, '3070', '2512283'),
(706, 5, '2154', '1235534'),
(707, 5, '7061', '13296333'),
(708, 5, '4973', '6593534'),
(709, 5, '6159', '10110614'),
(710, 5, '1334', '473925'),
(711, 5, '6557', '11464695'),
(712, 5, '1554', '642734'),
(713, 5, '6725', '12055683'),
(714, 5, '8788', '20594970'),
(715, 5, '7034', '13190625'),
(716, 5, '6207', '10271343'),
(717, 5, '7813', '16278645'),
(718, 5, '17', '75'),
(719, 5, '4285', '4894898'),
(720, 5, '9789', '25545374'),
(721, 5, '4913', '6435374'),
(722, 5, '6308', '10609214'),
(723, 5, '8672', '20053710'),
(724, 5, '4340', '5019933'),
(725, 5, '6853', '12524085'),
(726, 5, '8221', '18026460'),
(727, 5, '6374', '10831125'),
(728, 5, '5173', '7136325'),
(729, 5, '5337', '7593483'),
(730, 5, '960', '244800'),
(731, 5, '580', '89513'),
(732, 5, '5583', '8308620'),
(733, 5, '6124', '10000083'),
(734, 5, '5672', '8578710'),
(735, 5, '4700', '5887533'),
(736, 5, '9184', '22491003'),
(737, 5, '7816', '16294275'),
(738, 5, '1760', '824853'),
(739, 5, '4157', '4607895'),
(740, 5, '3975', '4209525'),
(741, 5, '3085', '2536898'),
(742, 5, '713', '135374'),
(743, 5, '5519', '8119920'),
(744, 5, '9801', '25613933'),
(745, 5, '9491', '24022353'),
(746, 5, '2553', '1736550'),
(747, 5, '6007', '9624014'),
(748, 5, '7303', '14222835'),
(749, 5, '2560', '1746773'),
(750, 5, '291', '22523'),
(751, 5, '7092', '13409553'),
(752, 5, '7463', '14850374'),
(753, 5, '6590', '11576433'),
(754, 5, '5764', '8858883'),
(755, 5, '1803', '865800'),
(756, 5, '3442', '3160214'),
(757, 5, '3984', '4229414'),
(758, 5, '8167', '17788814'),
(759, 5, '8605', '19742738'),
(760, 5, '9312', '23119833'),
(761, 5, '9117', '22161603'),
(762, 5, '9175', '22445108'),
(763, 5, '4895', '6386343'),
(764, 5, '5241', '7323773'),
(765, 5, '4846', '6264585'),
(766, 5, '9585', '24489675'),
(767, 5, '4424', '5217075'),
(768, 5, '2662', '1890374'),
(769, 5, '1345', '481958'),
(770, 5, '8572', '19596734'),
(771, 5, '6627', '11708583'),
(772, 5, '4420', '5208233'),
(773, 5, '9275', '22933983'),
(774, 5, '2145', '1224795'),
(775, 5, '4220', '4746093'),
(776, 5, '8766', '20489648'),
(777, 5, '4688', '5859374'),
(778, 5, '227', '13725'),
(779, 5, '6068', '9817214'),
(780, 5, '7239', '13968374'),
(781, 5, '508', '68850'),
(782, 5, '3160', '2661773'),
(783, 5, '4701', '5892233'),
(784, 5, '7088', '13395374'),
(785, 5, '8914', '21187983'),
(786, 5, '6495', '11242845'),
(787, 5, '530', '74553'),
(788, 5, '2897', '2237835'),
(789, 5, '4662', '5793933'),
(790, 5, '9125', '22198083'),
(791, 5, '2209', '1300953'),
(792, 5, '3779', '3806460'),
(793, 5, '8299', '18365133'),
(794, 5, '7094', '13416645'),
(795, 5, '9011', '21654033'),
(796, 5, '3145', '2636558'),
(797, 5, '6679', '11894853'),
(798, 5, '3434', '3143025'),
(799, 5, '5798', '8962934'),
(800, 5, '8014', '17125383'),
(801, 5, '2006', '1073343'),
(802, 5, '2424', '1564934');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stub`
--

CREATE TABLE IF NOT EXISTS `Stub` (
  `idStubs` int(11) NOT NULL AUTO_INCREMENT,
  `idLenguaje` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `Archivo` varchar(255) NOT NULL,
  PRIMARY KEY (`idStubs`),
  KEY `idLenguaje` (`idLenguaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoProblema`
--

CREATE TABLE IF NOT EXISTS `TipoProblema` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TipoProblema`
--

INSERT INTO `TipoProblema` (`idTipo`, `Tipo`) VALUES
(1, 'Condicional'),
(2, 'Iterativo'),
(3, 'Secuencial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoTorneo`
--

CREATE TABLE IF NOT EXISTS `TipoTorneo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TipoTorneo`
--

INSERT INTO `TipoTorneo` (`idTipo`, `Tipo`) VALUES
(1, 'Abierto'),
(2, 'Cerrado'),
(3, 'Abierto sin límite de tiempo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Torneo`
--

CREATE TABLE IF NOT EXISTS `Torneo` (
  `idTorneo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  PRIMARY KEY (`idTorneo`),
  KEY `idEstado` (`idEstado`),
  KEY `idTipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Torneo' AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Torneo`
--

INSERT INTO `Torneo` (`idTorneo`, `Nombre`, `Descripcion`, `FechaInicio`, `FechaFin`, `idEstado`, `idTipo`) VALUES
(1, 'Beta "La guerra de los Lenguajes"', 'Torneo de Prueba para testear los stubs de cada lenguaje. Los participantes serán los desarrolladores de cada stub.', '2014-06-25 18:00:00', '2014-06-26 23:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TorneoProblema`
--

CREATE TABLE IF NOT EXISTS `TorneoProblema` (
  `idTorneoProblema` int(11) NOT NULL AUTO_INCREMENT,
  `idProblema` int(11) NOT NULL,
  `idTorneo` int(11) NOT NULL,
  `Orden` int(11) NOT NULL COMMENT 'Orden de Ejecución del Problema',
  PRIMARY KEY (`idTorneoProblema`),
  KEY `idProblema` (`idProblema`,`idTorneo`),
  KEY `idTorneo` (`idTorneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Problemas que estan incluidos en el torneo' AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `TorneoProblema`
--

INSERT INTO `TorneoProblema` (`idTorneoProblema`, `idProblema`, `idTorneo`, `Orden`) VALUES
(9, 1, 4, 1),
(10, 2, 4, 2),
(11, 3, 4, 3),
(14, 5, 4, 4),
(15, 4, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TorneoUsuario`
--

CREATE TABLE IF NOT EXISTS `TorneoUsuario` (
  `idTorneoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `idTorneo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL DEFAULT '0',
  `Tiempo` bigint(20) NOT NULL,
  `Token` varchar(32) NOT NULL,
  PRIMARY KEY (`idTorneoUsuario`),
  KEY `idTorneo` (`idTorneo`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Usuario Participantes del Torneo' AUTO_INCREMENT=33 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(100) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `idRol` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `idLenguaje` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `NombreUsuario` (`NombreUsuario`),
  UNIQUE KEY `NombreUsuario_2` (`NombreUsuario`),
  UNIQUE KEY `NombreUsuario_3` (`NombreUsuario`),
  UNIQUE KEY `NombreUsuario_4` (`NombreUsuario`),
  KEY `idRol` (`idRol`),
  KEY `idLenguaje` (`idLenguaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `NombreUsuario`, `Descripcion`, `Clave`, `idRol`, `Email`, `idLenguaje`) VALUES
(1, 'admin', '', 'hornero', 1, '', 1);

--
-- Restricciones para tablas volcadas
--


--
-- Filtros para la tabla `Problema`
--
ALTER TABLE `Problema`
  ADD CONSTRAINT `Problema_ibfk_1` FOREIGN KEY (`idComplejidad`) REFERENCES `Complejidad` (`idComplejidad`),
  ADD CONSTRAINT `Problema_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `TipoProblema` (`idTipo`);

--
-- Filtros para la tabla `Resolucion`
--
ALTER TABLE `Resolucion`
  ADD CONSTRAINT `Resolucion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`),
  ADD CONSTRAINT `Resolucion_ibfk_2` FOREIGN KEY (`idSolucion`) REFERENCES `Solucion` (`idSolucion`),
  ADD CONSTRAINT `Resolucion_ibfk_3` FOREIGN KEY (`idTorneo`) REFERENCES `Torneo` (`idTorneo`),
  ADD CONSTRAINT `Resolucion_ibfk_4` FOREIGN KEY (`idEstado`) REFERENCES `EstadoResolucion` (`idEstado`),
  ADD CONSTRAINT `Resolucion_ibfk_5` FOREIGN KEY (`idProblema`) REFERENCES `Problema` (`idProblema`);

--
-- Filtros para la tabla `Solucion`
--
ALTER TABLE `Solucion`
  ADD CONSTRAINT `Solucion_ibfk_1` FOREIGN KEY (`idProblema`) REFERENCES `Problema` (`idProblema`);

--
-- Filtros para la tabla `Stub`
--
ALTER TABLE `Stub`
  ADD CONSTRAINT `Stub_ibfk_1` FOREIGN KEY (`idLenguaje`) REFERENCES `Lenguaje` (`idLenguaje`);

--
-- Filtros para la tabla `Torneo`
--
ALTER TABLE `Torneo`
  ADD CONSTRAINT `Torneo_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `EstadoTorneo` (`idEstado`),
  ADD CONSTRAINT `Torneo_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `TipoTorneo` (`idTipo`);

--
-- Filtros para la tabla `TorneoProblema`
--
ALTER TABLE `TorneoProblema`
  ADD CONSTRAINT `TorneoProblema_ibfk_1` FOREIGN KEY (`idTorneo`) REFERENCES `Torneo` (`idTorneo`),
  ADD CONSTRAINT `TorneoProblema_ibfk_2` FOREIGN KEY (`idProblema`) REFERENCES `Problema` (`idProblema`);

--
-- Filtros para la tabla `TorneoUsuario`
--
ALTER TABLE `TorneoUsuario`
  ADD CONSTRAINT `TorneoUsuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`),
  ADD CONSTRAINT `TorneoUsuario_ibfk_2` FOREIGN KEY (`idTorneo`) REFERENCES `Torneo` (`idTorneo`);

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `Rol` (`idRol`),
  ADD CONSTRAINT `Usuario_ibfk_2` FOREIGN KEY (`idLenguaje`) REFERENCES `Lenguaje` (`idLenguaje`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
