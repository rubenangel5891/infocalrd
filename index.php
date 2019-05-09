<html>
    <head><meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ /> </head>
    <body>
        <p>Hola ñ í á ó ú</p>

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
echo "******* PDO::query()**********<br/>";
    $stmt = $pdo->query("SELECT TC1.IdCursoC,TC1.Area, TC1.Curso,TC1.Costo,TC1.FECHAI, TC1.Horario, TC1.Estado
                         FROM CCursos TC1
                         WHERE TC1.Area=7 AND TC1.FECHAI > #01/01/2019# AND TC1.Estado='I'ORDER BY TC1.Curso");
    
    //$Cursos='';
    $cont1=1;
    while ($row = $stmt->fetch())
    {
         echo utf8_encode($row['IdCursoC']) . "<br/>";
        $cursos=array(
            array(  'IdCursoC' => utf8_encode($row['IdCursoC']),
                    'CursoC' => utf8_encode($row['CursoC']),
                    'Costo' => (int) utf8_encode($row['Costo']), 
                    'Estado' => utf8_encode ($row['Estado'])
                )
            );
         
         $cont1++;
    }
  
   

                                                        $Curso1["IdCursoC"][$cont1]=utf8_encode ($fila->IdCursoC); 
                                                            $Curso1["Curso"][$cont1]=utf8_encode ($fila->Curso); 
                                                            $Curso1["Costo"][$cont1]=(int)utf8_encode ($fila->Costo); 
                                                            $Curso1["Estado"][$cont1]=utf8_encode ($fila->Estado); 

    
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
    </body>
</html>
