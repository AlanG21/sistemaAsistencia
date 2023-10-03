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



-- Crea la base de datos
CREATE DATABASE sistema_asistencia;

-- Usa la base de datos
USE sistema_asistencia;

-- Crea la tabla de alumnos
CREATE TABLE alumnos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  apellidos VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  clase VARCHAR(255) NOT NULL,
  tarjeta_rfid VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

-- Crea la tabla de profesores
CREATE TABLE profesores (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  apellidos VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  clase VARCHAR(255) NOT NULL,
  tarjeta_rfid VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

-- Crea la restricción de clave externa entre las tablas
ALTER TABLE alumnos
ADD CONSTRAINT fk_alumnos_clase
FOREIGN KEY (clase)
REFERENCES profesores (clase);
