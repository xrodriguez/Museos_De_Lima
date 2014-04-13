<?php

/** PHPExcel */
require_once 'PHPExcel.php';
/** PHPExcel_IOFactory */
require_once 'PHPExcel/IOFactory.php';
 
class Excel_pdf_manager
{     
    function import($filename)
    {
       //IMPORTANDO:
 
        //creando un objeto lector y cargando el fichero
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($filename);

        //iterando por el contenido de las celdas
        $objWorksheet = $objPHPExcel->getActiveSheet();
        foreach ($objWorksheet->getRowIterator() as $row)
        {
            $record = array();
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell)
            {
                $record[] = $cell->getValue();
            }
            //...
        }
    }//fin de funcion import
 
    //funcion que exporta el array de una consulta BD
    function export($array,$tablename)
    {
        //EXPORTANDO:
        $objPHPExcel = new PHPExcel();                      //creando un objeto excel
        $objPHPExcel->getProperties()->setCreator("Smartgamers S.A.C.");//propiedades
        $objPHPExcel->setActiveSheetIndex(0); //poniendo active hoja 1
        $objPHPExcel->getActiveSheet()->setTitle("Reporte");  //título de la hoja 1
            
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $value);                           
         $styleArray = array('font' => array('bold' => true));
        //$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')-> applyFromArray($styleArray);                  //poniendo en negritas una fila
         
         //poniendo una columna con tamaño auto según el contenido
        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
          
          //
        // -----------------------------------
        //poniendo algo en una celda
        //var_dump($array);
        $inicio_letra=65;
        $fin_letra=91;
        $nrotitulos=0;
        $letra=65;
        $nrofila=1;
        $ant_letra='';
        $nro_ant= 0;
        //$nro = $this->getArrCount($array);
        
        //echo '$nto '.$nro;
        //echo '<br> $nro item '.count($array);
        
        foreach ($array as $array2)
        { 
          //para los titulos de la cabecera
          if($nrofila==1)
          {    
            //echo 'TITULOS : ';
            foreach ($array2 as $row => $value)
            { 
              if($letra == $fin_letra)
               { 
                 $ant_letra= chr($inicio_letra + $nro_ant);
                 
              //   echo '<br>$ant_letra '.$ant_letra;
                 $nro_ant++;
                 $letra=$inicio_letra;
               }
              $columna= $ant_letra.''. chr($letra);
              $fila = $nrofila;
              
              //agregamos el dato a la celda especifica
               //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columna, $fila, $row);                 
              $celda=$columna.$fila;
              $contenido=$row;
               $objPHPExcel->getActiveSheet()->SetCellValue( $celda , $contenido);
               $objPHPExcel->getActiveSheet()->getStyle($celda)-> applyFromArray($styleArray);                  //poniendo en negritas una fila
         
                //poniendo una columna con tamaño auto según el contenido
               $objPHPExcel->getActiveSheet()->getColumnDimension($columna)->setAutoSize(true);
              $letra++;
              $nrotitulos++;
            }
            $nrofila++;
          }//fin del if para los titulos
          
        //  echo '<br> ==========================';
        //  echo '<br> VALORES : ';
          $ant_letra='';
          $nro_ant=0;
          $letra=$inicio_letra;
          foreach ($array2 as $row => $value)
          { 
              if($letra == $fin_letra)
               { 
                 $ant_letra= chr($inicio_letra + $nro_ant);
                 
             //    echo '<br><br>$ant_letra '.$ant_letra;
                 $nro_ant++;
                 $letra=$inicio_letra;
               }
              $columna= $ant_letra.''. chr($letra);
              $fila = $nrofila;
               
              $celda=$columna.$fila;
              if($value){$contenido=$value;}else{$contenido='-';}
              //agregamos el dato a la celda especifica
              $objPHPExcel->getActiveSheet()->SetCellValue( $celda , $contenido);
             
              $celda=$columna.$fila;
                 // $objPHPExcel->getActiveSheet()->SetCellValue( $celda , $value);
              $letra++;
              $nrotitulos++;
          }
          
          $nrofila++;
          
        } 
        //echo '<br>nro titu '.$nrotitulos;
        //fin de colocar en la celda
        //-------------------------------------
       

        //creando un objeto writer para exportar el excel, y direccionando 
        //salida hacia el cliente web para invocar diálogo de salvar:
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $ext='_'. obtenerfecha_hora();
        header('Content-Disposition: attachment;filename="'.$tablename.$ext);
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    } //fin de funcion export   
    
    
    //funcion que exporta el array tal como lo traes
    function export_ord_despachadas($array,$tablename)
    {
        //EXPORTANDO:
        $objPHPExcel = new PHPExcel();                      //creando un objeto excel
        $objPHPExcel->getProperties()->setCreator("Smartgamers S.A.C.");//propiedades
        $objPHPExcel->setActiveSheetIndex(0); //poniendo active hoja 1
        $objPHPExcel->getActiveSheet()->setTitle("Reporte");  //título de la hoja 1
            
        //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $value);                           
         $styleArray = array(
             'font' => array(
                 'bold' => true, 
                 'size' => '12',
                 'color' => array('rgb' => 'FFFFFF'),
                 ),
             'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb'=>'858585'),
                ),
             );
          $styleArray2 = array(
             'font' => array(
                 'bold' => true, 
                 'size' => '11'
                 ),
             'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
                        ),
                )
            );
          $styleArray3 = array(
             'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
                        ),
                ),
              'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb'=>'EEEEEE'),
                )
            );
        //$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')-> applyFromArray($styleArray);                  //poniendo en negritas una fila
         
         //poniendo una columna con tamaño auto según el contenido
        //$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
          
          //
        // -----------------------------------
        //poniendo algo en una celda
        //var_dump($array);
        $inicio_letra=65;
        $fin_letra=91;
        $nrotitulos=0;
        $letra=65;
        $nrofila=1;
        $ant_letra='';
        $nro_ant= 0;
        //$nro = $this->getArrCount($array);
        
        //echo '$nto '.$nro;
        //echo '<br> $nro item '.count($array);
        
        foreach ($array as $array2)
        { 
         
        //  echo '<br> ==========================';
        //  echo '<br> VALORES : ';
          $ant_letra='';
          $nro_ant=0;
          $letra=$inicio_letra;
          foreach ($array2 as $row => $value)
          { 
              if($letra == $fin_letra)
               { 
                 $ant_letra= chr($inicio_letra + $nro_ant);
                 
             //    echo '<br><br>$ant_letra '.$ant_letra;
                 $nro_ant++;
                 $letra=$inicio_letra;
               }
              $columna= $ant_letra.''. chr($letra);
              $fila = $nrofila;
               
              $celda=$columna.$fila; // ejemplo imprime : A4
              
              if($value){$contenido=$value;}else{$contenido='';}
              //agregamos el dato a la celda especifica
              $objPHPExcel->getActiveSheet()->SetCellValue( $celda , $contenido);
             if($contenido=="CLIENTE" OR $contenido=="DNI" OR $contenido=="CELULAR" OR $contenido=="TELEFONO_1" OR $contenido=="TELEFONO_2" OR $contenido=="ANEXO_2" OR $contenido=="EMAIL")
             { $objPHPExcel->getActiveSheet()->getStyle($celda)-> applyFromArray($styleArray); }     
             
             if($contenido=="Direccion Envio" OR $contenido=="Juegos por entregar al cliente" OR $contenido=="Juegos por recoger del cliente")
             {  
                 $celda_aux= $celda.":G".$fila; // imprime ejemplo A4:G4
                 $objPHPExcel->getActiveSheet()->getStyle($celda_aux)-> applyFromArray($styleArray2);
             }    
             if($contenido=="CODIGO" )
             {  
                 $celda_aux= $celda.":G".$fila;
                 $objPHPExcel->getActiveSheet()->getStyle($celda_aux)-> applyFromArray($styleArray3);
             }    
                     
              $celda=$columna.$fila;
                 // $objPHPExcel->getActiveSheet()->SetCellValue( $celda , $value);
              
              //poniendo una columna con tamaño auto según el contenido
              $objPHPExcel->getActiveSheet()->getColumnDimension($columna)->setAutoSize(true);
               
              $letra++;
              $nrotitulos++;
          }
          
          $nrofila++;
          
        } 
        //echo '<br>nro titu '.$nrotitulos;
        //fin de colocar en la celda
        //-------------------------------------
        //var_dump($objPHPExcel); exit();

        //creando un objeto writer para exportar el excel, y direccionando 
        //salida hacia el cliente web para invocar diálogo de salvar:
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $ext='_'. obtenerfecha_hora();
        header('Content-Disposition: attachment;filename="'.$tablename.$ext);
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    } //fin de funcion export   
    
    
     function cleanData($str) 
    {  
        // escape tab characters 
        $str = preg_replace("/\t/", "\\t", $str); 
        // escape new lines 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        // convert 't' and 'f' to boolean values 
        if($str == 't') $str = 'TRUE'; 
        if($str == 'f') $str = 'FALSE'; 
        // force certain number/date formats to be imported as strings 
        if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) 
        { $str = "'$str"; } 
        // escape fields that include double quotes 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }//fin de funcion cleanData
     
}//fin de la clase
?>
