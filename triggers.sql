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


alter table Infraestructura add column comprobante1 varchar(1000);
alter table Infraestructura add column comprobante2 varchar(1000);
alter table Infraestructura add column comprobante3 varchar(1000);

'/uploads/oferta/infraestructura';




ALTER TABLE `upev0012016`.`ServicioSocial` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `AlumnosServicioAnterior`;
'/uploads/vinculacion/servicio'




ALTER TABLE `upev0012016`.`VisitasEscolares` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `TotalMatricula`;
'/uploads/vinculacion/visitas';



ALTER TABLE `upev0012016`.`ProyectosVinculados` 
ADD COLUMN `comprobante1` VARCHAR(1000) NULL AFTER `ProyectosVinculadosAnt`;

'/uploads/vinculacion/proyectos'



ALTER TABLE `upev0012016`.`RecursosAutogenerados` 
ADD COLUMN `comprobante1` VARCHAR(100) NULL AFTER `RecursosAutogenerados`;
'/uploads/gestion/recursos'





