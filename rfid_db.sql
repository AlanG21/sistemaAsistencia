CREATE DATABASE rfid_db;

USE rfid_db;

CREATE TABLE asistencias (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(50) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE alumnos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    uid VARCHAR(50) NOT NULL UNIQUE,  -- Ensure each student's UID is unique
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) DEFAULT NULL  -- Increased the length to 100 to accommodate longer emails
);

CREATE TABLE profesores (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    pin VARCHAR(50) NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) DEFAULT NULL  -- Increased the length to 100 to accommodate longer emails
    password VARCHAR(255) NOT NULL,
);

CREATE TABLE administradores (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) DEFAULT NULL  -- Increased the length to 100 to accommodate longer emails
    password VARCHAR(255) NOT NULL,
);

CREATE TABLE tarjetas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(50) NOT NULL UNIQUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE asistencias
ADD asistio TINYINT(1) DEFAULT 0 NOT NULL;

-- Sample insert command
INSERT INTO `administradores` (`id`, `nombre`, `apellido`, `username`, `password`, `tipo`) VALUES (NULL, 'Luis', 'Loredo', 'admin1', 'admin123', 'administrador');

--Para agregar la funcionalidad Administración de los grupos del profesor. Cada profesor tendrá diferentes clases en diferentes horarios.

-- Creación de la tabla grupos
CREATE TABLE grupos (
    id_grupo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_grupo VARCHAR(255) NOT NULL,
    id_profesor INT,
    FOREIGN KEY (id_profesor) REFERENCES profesores(id_profesor)
    -- Puedes agregar más campos si lo necesitas
);

-- Creación de la tabla horarios
CREATE TABLE horarios (
    id_horario INT AUTO_INCREMENT PRIMARY KEY,
    id_grupo INT,
    dia VARCHAR(50) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo)
);

-- Creación de la tabla alumnos
CREATE TABLE alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    uid VARCHAR(255) UNIQUE
    -- Puedes agregar más campos si lo necesitas
);