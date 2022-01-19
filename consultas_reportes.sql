# Realizar una consulta que permita conocer cuál es el producto que más stock tiene

SELECT producto_nombre,MAX(producto_stock)producto_stock FROM productos





# Realizar una consulta que permita conocer cuál es el producto más vendido.

SELECT v.producto_id,p.producto_nombre,COUNT(v.producto_id)AS cant,SUM(v.venta_soles)AS soles FROM ventas v
			LEFT JOIN  productos p ON p.producto_id=v.producto_id
			GROUP BY v.producto_id
			ORDER BY cant DESC LIMIT 1