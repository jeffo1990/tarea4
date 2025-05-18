CREATE DATABASE lista_tareas;
USE lista_tareas;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  rol ENUM('admin', 'usuario') NOT NULL
);

CREATE TABLE tareas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  completada BOOLEAN DEFAULT 0,
  id_usuario INT,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
