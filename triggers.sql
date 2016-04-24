DELIMITER $$
USE upev0012016$$
CREATE DEFINER = CURRENT_USER TRIGGER upev0012016.Evaluacion_AFTER_INSERT AFTER INSERT ON Evaluacion FOR EACH ROW
BEGIN

	INSERT INTO upev0012016.Alumnos (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.ApoyoEducativo (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.Docentes (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.ProgramasAcademicos (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.Tutorias (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.Becas (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.Infraestructura (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.ServicioSocial (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.VisitasEscolares (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.ProyectosVinculados (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.RecursosAutogenerados (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.InvestigacionDocencia (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.AlumnosInvestigacion (idEvaluacion) VALUES (NEW.idEvaluacion);
	INSERT INTO upev0012016.InnovacionEducativa (idEvaluacion) VALUES (NEW.idEvaluacion);

END
$$

DELIMITER ;


-- Becas
--  direccion donde se guardan los archivos 
-- /uploads/apoyo/becas
ALTER TABLE `upev0012016`.`Becas` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `TotalAlumnos`;

-- Tutorias
--  direccion donde se guardan los archivos 
-- /uploads/apoyo/tutorias
ALTER TABLE `upev0012016`.`Tutorias` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `TotalAlumnos`;


-- Apoyo Educativo 
--  direccion donde se guardan los archivos 
-- /uploads/apoyo/apoyoEducativo
ALTER TABLE `upev0012016`.`ApoyoEducativo` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `LimpiezaProgramada`,
ADD COLUMN `comprobante2` VARCHAR(1000) NULL AFTER `comprobante1`,
ADD COLUMN `comprobante3` VARCHAR(1000) NULL AFTER `comprobante2`,
ADD COLUMN `comprobante4` VARCHAR(1000) NULL AFTER `comprobante3`,
ADD COLUMN `comprobante5` VARCHAR(1000) NULL AFTER `comprobante4`;


