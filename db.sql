CREATE TABLE usuario(
	username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100),
    admin BOOLEAN DEFAULT FALSE
);

INSERT INTO usuario VALUES ('usuario', '$2y$10$/RSbEm64vPAj3fW4Ekk1OOyNA10gxpQelf3NvX5LXoMdwd3m3/gRG', 0);
INSERT INTO usuario VALUES ('adminSJ', '$2y$10$43D1qhdtN41ffc0Hlp1d4Ol4wJw4CuiQtACtTrPkyUE2mtZK0j8bm', 1);


CREATE TABLE registro(
    telefono VARCHAR(30),
    cedula VARCHAR(15),
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    direccion VARCHAR(100),
    tipo VARCHAR(20),
    fecha DATE,
    hora TIME,
    finDeriva VARCHAR(20),
    motivo VARCHAR(1000),
    usuario VARCHAR(50)
    
);

CREATE TABLE persona(
    cedula VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    telefono VARCHAR(30)
);
