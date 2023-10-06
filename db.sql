CREATE DATABASE sistema_asistencia CHARACTER SET utf8 COLLATE utf8_general_ci;
USE sistema_asistencia;

-- Creación de la tabla profesores
CREATE TABLE profesores (
    profesor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
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

-- Creación de la tabla tarjetas_rfid
CREATE TABLE tarjetas_rfid (
    tarjeta_id INT AUTO_INCREMENT PRIMARY KEY,
    numero_tarjeta VARCHAR(255) UNIQUE NOT NULL
);
-- Agregar una columna 'tarjeta_rfid_id' a la tabla 'profesores' para relacionar con la tabla 'tarjetas_rfid'
ALTER TABLE profesores ADD COLUMN tarjeta_rfid_id INT;

-- Establecer la relación con la tabla 'tarjetas_rfid'
ALTER TABLE profesores ADD FOREIGN KEY (tarjeta_rfid_id) REFERENCES tarjetas_rfid(tarjeta_id);

-- Agregar una columna 'tarjeta_rfid_id' a la tabla 'alumnos' para relacionar con la tabla 'tarjetas_rfid'
ALTER TABLE alumnos ADD COLUMN tarjeta_rfid_id INT;

-- Establecer la relación con la tabla 'tarjetas_rfid'
ALTER TABLE alumnos ADD FOREIGN KEY (tarjeta_rfid_id) REFERENCES tarjetas_rfid(tarjeta_id);
INSERT INTO administradores (nombre, apellido, email, password) VALUES ('Ejemplo', 'Administrador', 'admin@example.com', 'contrasena123');
