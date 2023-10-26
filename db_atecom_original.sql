-- Utilizando el Tema 5: PARTE2 , implementar en sus proyectos las mejoras solicitadas
-- Creación de la BD
CREATE DATABASE bd_atecom_bolivia;
-- Creación de las tablas necesarias


CREATE TABLE asociacion (
id_asociacion INT NOT NULL AUTO_INCREMENT, 
nombre VARCHAR (25) NOT NULL,
direccion VARCHAR (40) NOT NULL, 
logo VARCHAR (20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_asociacion)
)ENGINE=INNODB;



CREATE TABLE terapeutas (
id_terapeuta INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL,
nombres VARCHAR (25) NOT NULL,
apellidos VARCHAR (50) NOT NULL,
ci VARCHAR (20) NOT NULL,
direccion VARCHAR (40) NOT NULL,
telefono VARCHAR (20),
profesion VARCHAR (20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_terapeuta),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB; 




CREATE TABLE paciente (
id_paciente INT NOT NULL AUTO_INCREMENT,
lugar VARCHAR (40) NOT NULL,
fecha DATE NOT NULL,
tema VARCHAR (40) NOT NULL, 
nombres VARCHAR (25) NOT NULL,
apellidos VARCHAR (50) NOT NULL,
telefono VARCHAR (20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_paciente)
)ENGINE=INNODB;

CREATE TABLE terapeutas_pacientes (
id_terapeuta_paciente INT NOT NULL AUTO_INCREMENT,
id_terapeuta INT NOT NULL,
id_paciente INT NOT NULL,
fecha_atencion DATE NOT NULL,
detalle VARCHAR (100) NOT NULL,
precio FLOAT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_terapeuta_paciente),
FOREIGN KEY (id_terapeuta) REFERENCES terapeutas (id_terapeuta),
FOREIGN KEY (id_paciente) REFERENCES paciente (id_paciente) 
)ENGINE=INNODB;

CREATE TABLE directorio (
id_directorio INT NOT NULL AUTO_INCREMENT,
id_terapeuta INT NOT NULL,
cargos VARCHAR (40) NOT NULL, 
fecha_inicio DATE NOT NULL,
fecha_final DATE,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_directorio),
FOREIGN KEY (id_terapeuta) REFERENCES terapeutas (id_terapeuta) 
)ENGINE=INNODB;

CREATE TABLE formaciones_terapias_complementarias (
id_formacion_terapia_complemen INT NOT NULL AUTO_INCREMENT,
nombre_formacion VARCHAR (40) NOT NULL,
lugar VARCHAR (40) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_formacion_terapia_complemen)
)ENGINE=INNODB;

CREATE TABLE terapeutas_formaciones_terapias_complementarias (
id_terapeuta_formacion INT NOT NULL AUTO_INCREMENT,
id_terapeuta INT NOT NULL,
id_formacion_terapia_complemen INT NOT NULL,
tiempo_formacion VARCHAR (20) NOT NULL,
año DATE NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_terapeuta_formacion),
FOREIGN KEY (id_terapeuta) REFERENCES terapeutas (id_terapeuta),
FOREIGN KEY (id_formacion_terapia_complemen) REFERENCES formaciones_terapias_complementarias (id_formacion_terapia_complemen)
)ENGINE=INNODB;

CREATE TABLE estatuto (
id_estatuto INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL, 
descripcion VARCHAR (100) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_estatuto),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB;

CREATE TABLE reglamento (
id_reglamento INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL,
descripcion VARCHAR (100) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_reglamento),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB;

CREATE TABLE asesoras (
id_asesora INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL,
nombres VARCHAR (25) NOT NULL,
apellidos VARCHAR (50) NOT NULL,
telefono VARCHAR (20) NOT NULL,
formacion VARCHAR (50) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_asesora),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB;

CREATE TABLE convenios (
id_convenio INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL,
nombre_institucion VARCHAR (50) NOT NULL,
nombres_participantes VARCHAR (25) NOT NULL,
apellidos VARCHAR (50) NOT NULL,
ci VARCHAR (20) NOT NULL,
direccion VARCHAR (40) NOT NULL,
telefono VARCHAR (20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_convenio),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB;

-- PRÁCTICO 3 
CREATE TABLE personas (
id_persona INT NOT NULL AUTO_INCREMENT,
id_asociacion INT NOT NULL,
ci VARCHAR (20) NOT NULL,
nombres VARCHAR (25) NOT NULL,
ap VARCHAR (25),
am VARCHAR (25),
telefono VARCHAR (10) NOT NULL,
direccion VARCHAR (40) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_persona),
FOREIGN KEY (id_asociacion) REFERENCES asociacion (id_asociacion)
)ENGINE=INNODB;

CREATE TABLE usuarios (
id_usuario INT NOT NULL AUTO_INCREMENT,
id_persona INT NOT NULL, 
usuario VARCHAR (25) NOT NULL,
clave VARCHAR (100) NOT NULL, 
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuarios INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_usuario),
FOREIGN KEY (id_persona) REFERENCES personas (id_persona)
)ENGINE=INNODB;

CREATE TABLE roles (
id_rol INT NOT NULL AUTO_INCREMENT,
rol VARCHAR (50) NOT NULL, 
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_rol)
)ENGINE=INNODB;

CREATE TABLE usuarios_roles (
id_usuario_rol INT NOT NULL AUTO_INCREMENT,
id_rol INT NOT NULL,
id_usuario INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL,
PRIMARY KEY (id_usuario_rol),
FOREIGN KEY (id_rol) REFERENCES roles (id_rol),
FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
)ENGINE=INNODB;

CREATE TABLE grupos (
id_grupo INT NOT NULL AUTO_INCREMENT,
grupo VARCHAR (50) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL, 
PRIMARY KEY (id_grupo)
)ENGINE=INNODB;

CREATE TABLE opciones (
id_opcion INT NOT NULL AUTO_INCREMENT,
id_grupo INT NOT NULL,
opcion VARCHAR (50) NOT NULL,
contenido VARCHAR (100) NOT NULL,
orden VARCHAR (50) NOT NULL, 
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL, 
PRIMARY KEY (id_opcion),
FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo)
)ENGINE=INNODB;

CREATE TABLE accesos (
id_acceso INT NOT NULL AUTO_INCREMENT,
id_rol INT NOT NULL,
id_opcion INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
usuario INT NOT NULL, 
estado CHAR (1) NOT NULL, 
PRIMARY KEY (id_acceso),
FOREIGN KEY (id_rol) REFERENCES roles (id_rol),
FOREIGN KEY (id_opcion) REFERENCES opciones (id_opcion)
)ENGINE=INNODB;

CREATE TABLE registro_huellas(
    id_registro_huella INT NOT NULL AUTO_INCREMENT,
    consulta VARCHAR(50) NOT NULL,
    fec_insercion timestamp NOT NULL, 
    usuario int NOT NULL,
    PRIMARY KEY (id_registro_huella)
)ENGINE=INNODB; 


CREATE TABLE registro_directorio(
    id_registro_dirctorio INT NOT NULL AUTO_INCREMENT,
    consulta VARCHAR(50) NOT NULL,
    fec_insercion timestamp NOT NULL, 
    usuario int NOT NULL,
    PRIMARY KEY (id_registro_dirctorio)
)ENGINE=INNODB; 


INSERT INTO asociacion VALUES(1,'ATECOM - BOLIVIA','B. MORROS BLANCOS','atecom.jpg',now(),now(),1,'A'); 

INSERT INTO terapeutas VALUES(1, 1, 'SANDRA','ALBORNOZ MERCADO','7121343 T.','EMBOROZÚ','','LABORES DE CASA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(2, 1, 'PATRICIA LILIAN','BALLESTEROS ROJAS','4159063 TJA.','TARIJA','73896740','ESTUDIANTE',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(3, 1, 'ANA','COA','5001789 TJA.','EMBOROZÚ','67383644','ENFERMERA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(4, 1, 'ANA MARIA','CORDERO SANDOVAL','7141264 TJA.','RUMICANCHA','72983316','EDUCADORA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(5, 1, 'NORMA','CRUZ VITANCUR','7101102 TJA.','TARIJA','74539390','EDUCADORA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(6, 1, 'ADA','CHOQUE MARTÍNEZ','1842437 TJA.','TARIJA','72901588','MECÁNICA DENTAL',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(7, 1, 'GLORIA','FARFÁN PÉREZ','5048424 TJA.','TARIJA','72971390','EDUCADORA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(8, 1, 'WILMA VERÓNICA','FARFÁN TAPIA','1980851 TJA.','TARIJA','71194690','EDUCADORA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(9, 1, 'ARMINDA','ORTIZ CAUCOTA','7118199 TJA.','LIMAL','','AMA DE CASA',now(),now(),1,'A');
INSERT INTO terapeutas VALUES(10, 1, 'PAULINA DELMIRA','ORTIZ CAUCOTA','5039086 TJA.','LIMAL','','AMA DE CASA',now(),now(),1,'A');

INSERT INTO paciente VALUES(1, 'TARIJA','2014-01-28','ENFERMEDAD','PAULINA DELMIRA','ORTIZ CAUCOTA','78251118',now(),now(),1,'A');
INSERT INTO paciente VALUES(2, 'RUMICANCHA','2015-02-01','TEMA ECONÓMICO','BARBARITA','PÉREZ LLANOS DE GASPAR','78251119',now(),now(),1,'A');
INSERT INTO paciente VALUES(3, 'SALADO CRUCE','2016-03-27','DEPRESIÓN','JUSTINA','ROSADO BENAVIDES','79251118',now(),now(),1,'A');
INSERT INTO paciente VALUES(4, 'EMBOROZÚ','2017-04-16','CULPABILIDAD','ROCÍO DALILA','RUIZ MAMANI','78351118',now(),now(),1,'A');
INSERT INTO paciente VALUES(5, 'PENAL DE MORROS BLANCOS','2018-05-02','IMPOTENCIA','KAREN PATRICIA','SCHMIDT ROSADO','78241118',now(),now(),1,'A');
INSERT INTO paciente VALUES(6, 'TARIJA','2019-06-16','ABANDONO','OLIVIA','TEJERINA','78251118',now(),now(),1,'A');
INSERT INTO paciente VALUES(7, 'TARIJA','2020-07-10','MALA RELACIÓN CON LA HIJA','MIRIAN','VARGAS VÁSQUEZ','78255118',now(),now(),1,'A');
INSERT INTO paciente VALUES(8, 'TARIJA','2021-08-13','RELACIÓN CON EL PADRE','ELIZABETH ANA','VELASCO VELÁSQUEZ','76251118',now(),now(),1,'A');
INSERT INTO paciente VALUES(9, 'TARIJA','2020-09-23','DESEQUILIBRADA','DAYSI','RUIZ HEVIA Y VACA','78251118',now(),now(),1,'A');
INSERT INTO paciente VALUES(10, 'TARIJA','2020-05-16','DEPRESIÓN','ANA MARIA','SÁNCHEZ RUIZ','77251118',now(),now(),1,'A');

INSERT INTO terapeutas_pacientes VALUES(1, 10, 5, '2014-07-23','ENFERMEDAD',200.50,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(2, 9, 6, '2015-02-04','TEMA ECONÓMICO',50,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(3, 8, 7, '2016-09-23','DEPRESIÓN',500,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(4, 7, 8, '2017-01-12','CULPABILIDAD',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(5, 5, 9, '2018-03-01','IMPOTENCIA',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(6, 5, 10, '2019-04-03','ABANDONO',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(7, 3, 1, '2020-05-16','MALA RELACIÓN CON LA HIJA',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(8, 3, 2, '2021-06-05','RELACIÓN CON EL PADRE',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(9, 2, 3, '2022-08-06','DESEQUILIBRADA',100,now(),now(),1,'A');
INSERT INTO terapeutas_pacientes VALUES(10, 2, 4, '2020-05-16','DEPRESIÓN',100,now(),now(),1,'A');

INSERT INTO directorio VALUES(1, 2, 'PRESIDENTA','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(2, 3, 'VICEPRESIDENTE','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(3, 4, 'TESORERA','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(4, 5, 'SECRETARIA DE ACTAS','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(5, 6, 'COMUNICACIÓN','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(6, 7, 'VOCAL RURAL Y SALUD','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(7, 8, 'VOCAL URBANA','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(8, 9, 'PRESIDENTA','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(9, 10, 'PRESIDENTA','2021-04-17','2024-04-17', now(),now(),1,'A');
INSERT INTO directorio VALUES(10, 2, 'PRESIDENTA','2021-04-17','2024-04-17', now(),now(),1,'A');

INSERT INTO formaciones_terapias_complementarias VALUES(1, 'CONSTELACIONES FAMILIARES ','ESCUELA DE TERAPIAS ALTERNATIVAS', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(2, 'CONSTELACIONES FAMILIARES ','ESCUELA DE TERAPIAS ALTERNATIVAS', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(3, 'CONSTELACIONES FAMILIARES ','ESCUELA DE TERAPIAS ALTERNATIVAS', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(4, 'MASOTERAPIA','LA PAZ', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(5, 'MAGNETOTERAPIA','TARIJA', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(6, 'REIKI','TARIJA', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(7, 'MEDICINA NATURISTA','TARIJA', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(8, 'MASAJE TERAPÉUTICO','SANTA CRUZ', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(9, 'ALIMENTO SALUDABLE','TARIJA', now(),now(),1,'A');
INSERT INTO formaciones_terapias_complementarias VALUES(10, 'DECODIFICACIÓN CORPORAL ','TARIJA', now(),now(),1,'A');

INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(1, 2, 3, 'TRES AÑOS','2021-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(2, 3, 4, 'DOS AÑOS','2020-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(3, 4, 5, 'UNO AÑOS','2022-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(4, 5, 6, 'UNO AÑOS','2019-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(5, 6, 7, 'DOS AÑOS','2018-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(6, 7, 8, 'TRES AÑOS','2017-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(7, 8, 9, 'TRES AÑOS','2016-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(8, 9, 10, 'DOS AÑOS','2017-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(9, 1, 2, 'UNO AÑOS','2018-04-17', now(),now(),1,'A');
INSERT INTO terapeutas_formaciones_terapias_complementarias VALUES(10, 10, 6, 'TRES AÑOS','2021-04-17', now(),now(),1,'A');

INSERT INTO estatuto VALUES(1, 1, 'ESTATUTO ORGÁNICO DE FUNCIONAMIENTO', now(),now(),1,'A');

INSERT INTO reglamento VALUES(1, 1, 'REGLAMENTO INTERNO DE FUNCIONAMIENTO', now(),now(),1,'A');

INSERT INTO asesoras VALUES(1, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(2, 1, 'ANA MARIA','SÁNCHEZ RUIZ','72981294','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(3, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(4, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(5, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(6, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(7, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(8, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(9, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');
INSERT INTO asesoras VALUES(10, 1, 'DAYSI','RUIZ HEVIA Y VACA','71871022','EDUCADORA', now(),now(),1,'A');

INSERT INTO convenios VALUES(1, 1, 'INTE (INSTITUTO TECNOLÓGICO EMBOROZÚ)','LORENZO','TOLAY','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(2, 1, 'EMBOROZÚ ADULTOS','LORENZO','RICADES','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(3, 1, 'EMBOROZÚ ADULTOS','ROSALIA','VALLEJOS','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(4, 1, 'INTE (INSTITUTO TECNOLÓGICO EMBOROZÚ)','LORENZO','FLORES','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(5, 1, 'EMBOROZÚ ADULTOS','JULIETA','ACUÑA','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(6, 1, 'SEDEGES','TEOFILO','BARRIOS ','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(7, 1, 'ALDEAS INFANTILES','FREDDY','ZUTARA','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(8, 1, 'MOISES NAVAJAS','RAQUEL','TOLABA','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(9, 1, 'SEDEGES','FRANCISCA','TEJERINA','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');
INSERT INTO convenios VALUES(10, 1, 'INTE (INSTITUTO TECNOLÓGICO EMBOROZÚ)','RENE','SEGOVIA','1234567','SAN FRANCISO','12345678', now(),now(),1,'A');

INSERT INTO personas VALUES (1, 1, '7141264','ANA MARIA','CORDERO','SANDOVAL','72983316','AEROPUERTO',now(),now(), 1, 'A');
INSERT INTO personas VALUES (2, 1, '11111111','DAYSI','RUIZ','HEVIA Y VACA','71871022','LA PAMPA',now(),now(), 1, 'A');
INSERT INTO personas VALUES (3, 1, '22222222','ANA MARIA','SÁNCHEZ','RUIZ','72981294','LA PAMPA',now(),now(), 1, 'A');

INSERT INTO usuarios VALUES (1,1,'admin','$2y$10$HxB1sZ3p/ok/Aa3cyATcsuGZoUrZzW5.TtmaiYh61S38axFgKVmXK', now(),now(), 1, 'A');
INSERT INTO usuarios VALUES (2,2,'hermanita','$2y$10$Xvo3cjyEW/XxVWbWpH9rI.Cafnwmp2b7PprwSkDf.MP.mLcL6L/Nm', now(),now(), 1, 'A');
INSERT INTO usuarios VALUES (3,3,'rufo_ernan','$2y$10$5wB8ldYboGuL5pXx0ZY26uXshz.UN9d3I3lV44LhQa/0ig2tcPGfm', now(),now(), 1, 'A');

INSERT INTO roles VALUES(1,'Administrador',now(),now(),1,'A');
INSERT INTO roles VALUES(2,'USUARIO PRUEBA 1',now(),now(),1,'A');
INSERT INTO roles VALUES(3,'USUARIO PRUEBA 2',now(),now(),1,'A');

INSERT INTO usuarios_roles VALUES(1,1,1,now(),now(),1,'A');
INSERT INTO usuarios_roles VALUES(2,2,2,now(),now(),1,'A');
INSERT INTO usuarios_roles VALUES(3,3,3,now(),now(),1,'A');

INSERT INTO grupos VALUES(1,'HERRAMIENTAS',now(),now(),1,'A');
INSERT INTO grupos VALUES(2,'PARAMETROS',now(),now(),1,'A');
INSERT INTO grupos VALUES(3,'ATECOM-BOLIVIA',now(),now(),1,'A');
INSERT INTO grupos VALUES(4,'REPORTES',now(),now(),1,'A');

INSERT INTO opciones VALUES(1,1,'Personas','../privada/personas/personas.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(2,1,'Usuarios','../privada/usuarios/usuarios.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(3,1,'Grupos','../privada/grupos/grupos.php',30,now(),now(),1,'A');
INSERT INTO opciones VALUES(4,1,'Roles','../privada/roles/roles.php',40,now(),now(),1,'A');
INSERT INTO opciones VALUES(5,1,'Usuarios Roles','../privada/usuarios_roles/usuarios_roles.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(6,1,'Opciones','../privada/opciones/opciones.php',60,now(),now(),1,'A');
INSERT INTO opciones VALUES(7,1,'Accesos','../privada/accesos/accesos.php',70,now(),now(),1,'A');
INSERT INTO opciones VALUES(8,2,'Estatuto','../privada/estatuto/estatuto.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(9,2,'Reglamento','../privada/reglamento/reglamento.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(10,3,'Asociacion','../privada/asociacion/asociacion.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(11,3,'Terapeutas','../privada/terapeutas/terapeutas.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(12,3,'Paciente','../privada/paciente/paciente.php',30,now(),now(),1,'A');
INSERT INTO opciones VALUES(13,3,'Terapeutas Pacientes','../privada/terapeutas_pacientes/terapeutas_pacientes.php',40,now(),now(),1,'A');
INSERT INTO opciones VALUES(14,3,'Directorio','../privada/directorio/directorio.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(15,3,'Formaciones Terapias Complementarias','../privada/formaciones_terapias_complementarias/formaciones_terapias_complementarias.php',60,now(),now(),1,'A');
INSERT INTO opciones VALUES(16,3,'Terapeutas Formaciones Terapias Complemen','../privada/terapeutas_formaciones_terapias_complemen/terapeutas_formaciones_terapias_complemen.php',70,now(),now(),1,'A');
INSERT INTO opciones VALUES(17,3,'Asesoras','../privada/asesoras/asesoras.php',80,now(),now(),1,'A');
INSERT INTO opciones VALUES(18,3,'Convenios','../privada/convenios/convenios.php',90,now(),now(),1,'A');
INSERT INTO opciones VALUES(19,4,'Rtp Personas con Usuarios','../privada/reportes/rtp_personas1.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(20,4,'Rtp Personas con fechas','../privada/reportes/rtp_personas2.php',20,now(),now(),1,'A');

INSERT INTO accesos VALUES(1,1,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(2,1,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(3,1,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(4,1,4,now(),now(),1,'A');
INSERT INTO accesos VALUES(5,1,5,now(),now(),1,'A');
INSERT INTO accesos VALUES(6,1,6,now(),now(),1,'A');
INSERT INTO accesos VALUES(7,1,7,now(),now(),1,'A');
INSERT INTO accesos VALUES(8,1,8,now(),now(),1,'A');
INSERT INTO accesos VALUES(9,1,9,now(),now(),1,'A');
INSERT INTO accesos VALUES(10,1,10,now(),now(),1,'A');
INSERT INTO accesos VALUES(11,1,11,now(),now(),1,'A');
INSERT INTO accesos VALUES(12,1,12,now(),now(),1,'A');
INSERT INTO accesos VALUES(13,1,13,now(),now(),1,'A');
INSERT INTO accesos VALUES(14,1,14,now(),now(),1,'A');
INSERT INTO accesos VALUES(15,1,15,now(),now(),1,'A');
INSERT INTO accesos VALUES(16,1,16,now(),now(),1,'A');
INSERT INTO accesos VALUES(17,1,17,now(),now(),1,'A');
INSERT INTO accesos VALUES(18,1,18,now(),now(),1,'A');
INSERT INTO accesos VALUES(19,1,19,now(),now(),1,'A');
INSERT INTO accesos VALUES(20,1,20,now(),now(),1,'A');
INSERT INTO accesos VALUES(21,2,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(22,2,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(23,2,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(24,2,4,now(),now(),1,'A');
INSERT INTO accesos VALUES(25,2,5,now(),now(),1,'A');
INSERT INTO accesos VALUES(26,2,6,now(),now(),1,'A');
INSERT INTO accesos VALUES(27,3,7,now(),now(),1,'A');
INSERT INTO accesos VALUES(28,3,8,now(),now(),1,'A');
INSERT INTO accesos VALUES(29,3,9,now(),now(),1,'A');
INSERT INTO accesos VALUES(30,3,10,now(),now(),1,'A');




