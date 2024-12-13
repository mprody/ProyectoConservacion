create database ProyectoConservacion;

use ProyectoConservacion;
CREATE TABLE ConservationProjects ( ProjectID INT PRIMARY KEY AUTO_INCREMENT, ProjectName VARCHAR(100), StartDate DATE, EndDate DATE, Budget DECIMAL(18, 2), FocusArea VARCHAR(100) );


CREATE USER 'proyectoConservacion'@'%' IDENTIFIED BY 'proyectoConservacion';
GRANT SELECT, INSERT, UPDATE, DELETE ON ProyectoConversacion.* TO 'proyectoConservacion'@'%';