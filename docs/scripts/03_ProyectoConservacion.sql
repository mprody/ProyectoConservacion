create database ProyectoConservacion;

use ProyectoConservacion;
CREATE TABLE ConservationProjects ( ProjectID INT PRIMARY KEY AUTO_INCREMENT, ProjectName VARCHAR(100), StartDate DATE, EndDate DATE, Budget DECIMAL(18, 2), FocusArea VARCHAR(100) );


CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT SELECT, INSERT, UPDATE, DELETE ON ProyectoConservacion.* TO 'admin'@'localhost';


SHOW GRANTS FOR 'proyectoConservacion'@'%';

DROP USER 'proyectoConservacion'@'localhost';