<html>
    <head><meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ /> </head>
    <body>
<?php

$host = '{Microsoft Access Driver (*.mdb)}';
//$dbq   = filter_input (INPUT_SERVER,'DOCUMENT_ROOT',FILTER_SANITIZE_STRING)."/access/base_datos.mdb";
$dbq   = "C:/bdback$/db/dbPotosi-2018.mdb";
$charset = 'UTF-8';
$user = 'admin';
$pass = 'carnatamiliphp';


$dsn = "odbc:DRIVER=$host;DBQ=$dbq;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
     
    
  
   /******* CONSULTA SELECT ***************/
echo "******* INFOCAL POTOSÍ - REGISTRO DE DOCUMENTACIÓN **********<br/>";
    $stmt = $pdo->query("SELECT TC1.IdCursoC,TC1.Area, TC1.Curso,TC1.Costo,TC1.FECHAI, TC1.Horario, TC1.Estado
                         FROM CCursos TC1
                         WHERE TC1.Area=7 AND TC1.FECHAI > #01/01/2019# AND TC1.Estado='I'ORDER BY TC1.Curso");
    
  
    $cont1=0;
    unset($Curso);
    $Curso=array();
    while ($row = $stmt->fetch())
    {
        ++$cont1;
       $Curso[$cont1]["IdCursoC"]= utf8_encode($row['IdCursoC']); 
       $Curso[$cont1]["Curso"]=utf8_encode($row['Curso']); 
       $Curso[$cont1]["Costo"]= (int) utf8_encode($row['Costo']); 
       $Curso[$cont1]["Estado"]=utf8_encode ($row['Estado']);     
    }      
    
?>
<form name="formulario" method="post" action="index.php"> 
    <?= $Curso[2]['IdCursoC']." | ".$Curso[2]['Curso']." | ".$Curso[2]['Costo']. "<br/>";?>
    <input type="submit" name="Consulta" value="Generar Reporte" />
</form>  
             
        
<?php
echo filter_input (INPUT_POST,'Consulta',FILTER_SANITIZE_STRING);

      if( null!= filter_input (INPUT_POST,'Consulta',FILTER_SANITIZE_STRING))
        {
            echo " proceso ...";
        }  


} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
    </body>
</html>
