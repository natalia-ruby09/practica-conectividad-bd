-- CREAR Y USAR LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS bd_universidad;
USE bd_universidad;

-- TABLAS
CREATE TABLE docente (
    docente_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    departamento VARCHAR(50),
    correo VARCHAR(80)
);

CREATE TABLE materia (
    materia_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    creditos INT,
    docente_id INT,
    FOREIGN KEY (docente_id) REFERENCES docente(docente_id)
);

CREATE TABLE estudiante (
    estudiante_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    carrera VARCHAR(50),
    correo VARCHAR(80)
);

CREATE TABLE inscripcion (
    inscripcion_id INT PRIMARY KEY AUTO_INCREMENT,
    fecha_inscripcion DATE,
    nota DECIMAL(5,2),
    estudiante_id INT,
    materia_id INT,
    FOREIGN KEY (estudiante_id) REFERENCES estudiante(estudiante_id),
    FOREIGN KEY (materia_id) REFERENCES materia(materia_id)
);

-- DATOS DOCENTE
INSERT INTO docente (nombre, departamento, correo) VALUES
('Ana Torres', 'Matemáticas', 'ana.torres@uni.edu'),
('Luis Pérez', 'Historia', 'luis.perez@uni.edu'),
('María López', 'Literatura', 'maria.lopez@uni.edu'),
('Carlos Gómez', 'Filosofía', 'carlos.gomez@uni.edu'),
('Sandra Díaz', 'Informática', 'sandra.diaz@uni.edu');

-- DATOS MATERIA
INSERT INTO materia (nombre, creditos, docente_id) VALUES
('Álgebra', 4, 1),
('Historia Antigua', 3, 2),
('Poesía Moderna', 3, 3),
('Ética Profesional', 2, 4),
('Programación Básica', 5, 5);

-- DATOS ESTUDIANTE
INSERT INTO estudiante (nombre, carrera, correo) VALUES
('Juan Arias', 'Sistemas', 'juan.arias@uni.edu'),
('Lucía Vidal', 'Psicología', 'lucia.vidal@uni.edu'),
('Pedro Suárez', 'Historia', 'pedro.suarez@uni.edu'),
('María Castro', 'Literatura', 'maria.castro@uni.edu'),
('Carla Ibáñez', 'Turismo', 'carla.ibanez@uni.edu');

-- DATOS INSCRIPCION
INSERT INTO inscripcion (fecha_inscripcion, nota, estudiante_id, materia_id) VALUES
('2025-01-10', 85.5, 1, 1),
('2025-01-15', 90, 1, 2),
('2025-01-20', 75, 2, 1),
('2025-02-01', 88, 2, 3),
('2025-02-10', 60, 3, 4),
('2025-02-15', 45, 3, 5),
('2025-03-01', 92, 4, 1),
('2025-03-10', 78, 4, 2),
('2025-03-15', 55, 5, 3),
('2025-04-01', 80, 5, 4);