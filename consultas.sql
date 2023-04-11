SELECT * FROM antibioticos
SELECT * FROM grupo_antibioticos
SELECT * FROM detalle_grupo_antibioticos

SELECT * FROM detalle_grupo_antibioticos WHERE id_GrupoAntibiotico = 35

SELECT DISTINCT id_Antibiotico FROM detalle_grupo_antibioticos WHERE id_GrupoAntibiotico = 33

DELETE t1 FROM detalle_grupo_antibioticos t1
        INNER JOIN detalle_grupo_antibioticos t2 
        WHERE t1.id < t2.id  AND t1.id_Antibiotico = t2.id_Antibiotico  AND t1.id_GrupoAntibiotico = 33; 

SELECT id_Antibiotico, COUNT(*) Total
FROM detalle_grupo_antibioticos
WHERE id_GrupoAntibiotico = 34
GROUP BY id_Antibiotico
HAVING COUNT(*) > 1

DELETE FROM `detalle_grupo_antibioticos` WHERE id_Antibiotico = 55 AND t1.id_GrupoAntibiotico = 33;
CALL eliminar_duplicados_dga(33)