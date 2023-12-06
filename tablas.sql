CREATE TABLE proyectos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT,
  propietario INT,
  estado VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (propietario) REFERENCES usuarios (id)
);

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  nombre_usuario VARCHAR(255) NOT NULL,
  contrasena VARCHAR(255) NOT NULL,
  apodo VARCHAR(255),
  imagen_perfil VARCHAR(255),
  roles VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE tareas (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT,
  miembros_asignados INT,
  PRIMARY KEY (id),
  FOREIGN KEY (miembros_asignados) REFERENCES usuarios (id)
);
