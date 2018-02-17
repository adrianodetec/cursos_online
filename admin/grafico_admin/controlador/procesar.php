<?php
	include('conexion.php');
	
	$año = $_POST['ano'];

   $enero = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=1 AND YEAR(cursos_dt_ter)='$año'";	   
   $ejecutar_enero = $conexion->query($enero);
   $enero = $ejecutar_enero->fetch_assoc();  

   $febrero = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=2 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_febrero  = $conexion->query($febrero);
   $febrero = $ejecutar_febrero->fetch_assoc();

   $marzo = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=3 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_marzo  = $conexion->query($marzo);
   $marzo = $ejecutar_marzo->fetch_assoc();

   $abril = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=4 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_abril  = $conexion->query($abril);
   $abril = $ejecutar_abril->fetch_assoc();

   $mayo = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=5 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_mayo  = $conexion->query($mayo);
   $mayo = $ejecutar_mayo->fetch_assoc();

   $junio = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=6 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_junio  = $conexion->query($junio);
   $junio = $ejecutar_junio->fetch_assoc();
  
   $julio = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=7 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_julio  = $conexion->query($julio);
   $julio = $ejecutar_julio->fetch_assoc();


   $agosto = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=8 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_agosto  = $conexion->query($agosto);
   $agosto = $ejecutar_agosto->fetch_assoc();


   $septiembre = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=9 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_septiembre  = $conexion->query($septiembre);
   $septiembre = $ejecutar_septiembre->fetch_assoc();
   
   $octubre = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=10 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_octubre = $conexion->query($octubre);
   $octubre = $ejecutar_octubre->fetch_assoc();

   $noviembre = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=11 AND YEAR(cursos_dt_ter)='$año'";
   $ejecutar_noviembre  = $conexion->query($noviembre);
   $noviembre = $ejecutar_noviembre->fetch_assoc();


  $diciembre = "SELECT SUM(cursos_qt_inscritos) AS r FROM tb_cursos WHERE MONTH(cursos_dt_ter)=12 AND YEAR(cursos_dt_ter)='$año'";
  $ejecutar_diciembre  = $conexion->query($diciembre);
  $diciembre = $ejecutar_diciembre->fetch_assoc();


 
	$data = array(0 => round($enero['r'],1),
				  1 => round($febrero['r'],1),
				  2 => round($marzo['r'],1),
				  3 => round($abril['r'],1),
				  4 => round($mayo['r'],1),
				  5 => round($junio['r'],1),
				  6 => round($julio['r'],1),
				  7 => round($agosto['r'],1),
				  8 => round($septiembre['r'],1),
				  9 => round($octubre['r'],1),
				  10 => round($noviembre['r'],1),
				  11 => round($diciembre['r'],1)
				  );			 

	echo json_encode($data);


?>