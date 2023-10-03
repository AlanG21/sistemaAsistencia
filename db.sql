CREATE DATABASE sistema_asistencia CHARACTER SET utf8 COLLATE utf8_general_ci;
USE sistema_asistencia;

-- Creación de la tabla profesores
CREATE TABLE profesores (
    profesor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    tarjeta_rfid VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL  -- Nueva columna para la contraseña
);

-- Creación de la tabla clases
CREATE TABLE clases (
    clase_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_clase VARCHAR(255) NOT NULL,
    profesor_id INT,
    FOREIGN KEY (profesor_id) REFERENCES profesores(profesor_id)
);

-- Creación de la tabla alumnos
CREATE TABLE alumnos (
    alumno_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    tarjeta_rfid VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  -- Nueva columna para la contraseña
    clase_id INT,
    FOREIGN KEY (clase_id) REFERENCES clases(clase_id)
);

-- Creación de la tabla administradores
CREATE TABLE administradores (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);


-- Agrega una columna 'rol' a la tabla 'profesores' para indicar el rol
ALTER TABLE profesores ADD COLUMN rol VARCHAR(255) NOT NULL;

-- Agrega una columna 'rol' a la tabla 'administradores' para indicar el rol
ALTER TABLE administradores ADD COLUMN rol VARCHAR(255) NOT NULL;

-- Agrega una columna 'rol' a la tabla 'alumnos' para indicar el rol
ALTER TABLE alumnos ADD COLUMN rol VARCHAR(255) NOT NULL;


INSERT INTO `profesores` (`profesor_id`, `nombre`, `apellido`, `email`, `tarjeta_rfid`, `password`) VALUES (NULL, 'Luis', 'Loredo', 'luis@example.com', '', 'admin123');

INSERT INTO `administradores` (`admin_id`, `nombre`, `apellido`, `email`, `password`) VALUES (NULL, 'administrador_loredo', 'adminAp', 'admin@example.com', 'admin123');

INSERT INTO `alumnos` (`alumno_id`, `nombre`, `apellido`, `email`, `tarjeta_rfid`, `password`, `clase_id`, `rol`) VALUES (NULL, 'Paullette', 'Esparza', 'paullette', '', 'paullette123', NULL, 'alumno');