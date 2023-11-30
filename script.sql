INSERT into activos_fijos (codigo, tipo_activo_id, descripcion) values ("Monitor", 2, "Monitor asus 32 plg");
SELECT * from activos_fijos WHERE codigo = "LAV23287";
SELECT * from asignaciones a INNER JOIN activos_fijos act on a.activos_fijos_id =act.id_activo_fijo
INNER JOIN personas p on a.personas_id = p.id_persona INNER JOIN areas_trabajo t on p.areas_trabajo_id = t.id_areas_trabajo;
DELETE FROM asignaciones a where activos_fijos_id  = (select a.id_activo_fijo from activos_fijos a where a.id_activo_fijo = 19);
INSERT INTO asignaciones (personas_id, activos_fijos_id) VALUES (1, 19);