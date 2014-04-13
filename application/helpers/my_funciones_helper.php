<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *  Funcion definidas para ayudar 
 *  Ruta : Application/helpers/MY_funciones_helper.php
 *  forma de cargar individualmente: $this->load->helper('new_helper');
 *  forma de cargarlo en el autoload : $autoload['helper'] = array('MY_funciones');
 *  forma de llamarlo en donde se requiera 
 *   *  $query=compararFechas($fecha2,$fecha_actual);
 *   *   en este caso $query es el valor q recoge.
 */


/* Funcion que compara 2 fechas 
 *  $fecha_actual=date("Y-m-d"); 
 *  $primera = '2013-08-15' 
 *  $segunda ='2013-08-13';
 *  si la fecha primera > devuelve un numero negativo 
 *  si son iguales devuelve cero (0)
 *  si la fecha primera > devuelve un numero positivo
 */

 
//funcion q devuelve nro positivos si faltan dias y si se ha superado la 1ra fecha 
//  a la 2da devuelve nros negativos
if ( ! function_exists('compararFechas'))
{
function compararFechas($primera, $segunda)
    {
        $valoresPrimera = explode ("-", $primera);   
        $valoresSegunda = explode ("-", $segunda); 

        $diaPrimera    = (int)$valoresPrimera[2];  
        $mesPrimera  = (int)$valoresPrimera[1];  
        $anyoPrimera   =(int)$valoresPrimera[0]; 

        $diaSegunda   = (int)$valoresSegunda[2];  
        $mesSegunda = (int)$valoresSegunda[1];  
        $anyoSegunda  = (int)$valoresSegunda[0];

        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

        if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
          // "La fecha ".$primera." no es v&aacute;lida";
          return 0;
        }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
          // "La fecha ".$segunda." no es v&aacute;lida";
          return 0;
        }else{
          return  $diasPrimeraJuliano - $diasSegundaJuliano;
        } 

      }//fin de funcion compara fechas
}

/* funcion que obtiene la fecha y hora del sistema del sgte formato: 15/08/2013 17:20*/
if ( ! function_exists('obtenerfecha_hora'))
{
function obtenerfecha_hora()
   {
       $sdate=date("Y")."-".date("m")."-".date("d");
       $stime=date("H").":".date("i");
       $valor =$sdate." ".$stime;
       return $valor;
   }
}

/* funcion que obtiene la fecha y hora del sistema del sgte formato: 15/08/2013 */
if ( ! function_exists('obtenerfecha_actual'))
{
function obtenerfecha_actual()
   {
       $sdate=date("Y")."-".date("m")."-".date("d");
       return $sdate;
   }
}

/* funcion que obtiene la fecha y hora del sistema del sgte formato: 15/08/2013 */
if ( ! function_exists('obtenerhora_actual'))
{
function obtenerhora_actual()
   {
       $sdate=date("H").":".date("i");
       return $sdate;
   }
}


/* funcion que suma dias o meses a una fecha formato date("d-m-Y") */
if ( ! function_exists('sumar_a_fecha'))
{
function sumar_a_fecha($fecha,$tiempo,$cant)
   {
   switch ($tiempo)
   { case "mes":
        $nuevafecha = strtotime ( '+'.$cant.'month' , strtotime ( $fecha ) ) ;
        break;
     case "dia":
       $nuevafecha = strtotime ( '+'.$cant.'day' , strtotime ( $fecha ) ) ; 
       break;   
   }
       //$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
       $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
       //retornamos la nueva fecha
       return $nuevafecha;
   }
}

/* funcion que suma dias o meses a una fecha formato date("Y-m-d"*/
if ( ! function_exists('extraer_dia_a_fecha'))
{
function extraer_dia_a_fecha($fecha)
   {
        //$DATO_SACADO_DE_BD = "yyyy-mm-dd hh:mm:ss"
        //$DATOSACADODEBD ='2013-09-06 12:32:34';
        $DATOSACADODEBD =$fecha;
        /*la función explode divide una cadena por donde tu le indiques 
        (en este caso un espacio) y devuelve cada trozo (en este caso solo 2) en un array*/
        $resultado=explode(" ",$DATOSACADODEBD);

       // echo "DATOSACADODEBD : ".$DATOSACADODEBD;
       // echo "<br>fecha : ".$resultado[0];
       // echo "<br>";
       // echo "hora : ".$resultado[1];
        return $resultado[0];
   }
}
/* funcion que suma dias o meses a una fecha formato date("Y-m-d H:mm"*/
if ( ! function_exists('extraer_hora_a_fecha'))
{
function extraer_hora_a_fecha($fecha)
   {
        //$DATO_SACADO_DE_BD = "yyyy-mm-dd hh:mm:ss"
        //$DATOSACADODEBD ='2013-09-06 12:32:34';
        $DATOSACADODEBD =$fecha;
        /*la función explode divide una cadena por donde tu le indiques 
        (en este caso un espacio) y devuelve cada trozo (en este caso solo 2) en un array*/
        $resultado=explode(" ",$DATOSACADODEBD);

       // echo "DATOSACADODEBD : ".$DATOSACADODEBD;
       // echo "<br>fecha : ".$resultado[0];
       // echo "<br>";
       // echo "hora : ".$resultado[1];
        return $resultado[1];
   }
}

/*funcion que cuenta la profundidad del array */

if ( ! function_exists('getArrCount'))
{
    function getArrCount($arr, $depth=1) 
    {
      if (!is_array($arr) || !$depth) return 0;
        
     $res=count($arr);
        
      foreach ($arr as $in_ar)
         $res = $res + $this->getArrCount($in_ar, $depth-1);
     
      return $res;
   } 
}







    ////////////////////////////////////////////////////
   //Convierte fecha de mysql a español  --- para probar
   ////////////////////////////////////////////////////
if ( ! function_exists('fecha_mysql_a_espanol'))
{  function fecha_mysql_a_espanol($fecha){
     $cad = preg_split("/ /",$fecha);
    $sub_cad = preg_split("/-/",$cad[0]);
    if($cad)
    { $fecha_formateada = $sub_cad[2]."-".$sub_cad[1]."-".$sub_cad[0]." ".$cad[1];
    }else
    { $fecha_formateada = $sub_cad[2]."-".$sub_cad[1]."-".$sub_cad[0]; }    
    return $fecha_formateada;
   }
   /*
    list($dia,$mes,$ano)=explode("/",$fecha);
    $fecha="$ano-$mes-$dia";
    return $fecha
    */
   /* //funciona pero la funcion es vieja
      ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
      $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
      return $lafecha;
    */
}   


   ////////////////////////////////////////////////////
   //Convierte fecha de español a mysql --- para probar
   ////////////////////////////////////////////////////
if ( ! function_exists('fecha_espanol_a_mysql'))
{
   function fecha_espanol_a_mysql($fecha){
    $cad = preg_split("/ /",$fecha);
    $sub_cad = preg_split("/-/",$cad[0]);
    $cad_hora = preg_split("/:/",$cad[1]);
    $hora_formateada = $cad[0].":".$cad_hora[1].":".$cad_hora[2];
    $fecha_formateada = $sub_cad[2]."-".$sub_cad[1]."-".$sub_cad[0]." ".$hora_formateada;
    return $fecha_formateada;
   } 
   /* ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
      return $lafecha
    */
}

////////////////////////////////////////////////////
//Convierte fecha de mysql a español  --- OK
////////////////////////////////////////////////////
function convertirfecha_dma($amd)
{   //formato YY-mm-dd ingresa
    //retorna dd-mm-YY
    return substr($amd, 8, 2)."-".substr($amd, 5, 2)."-".substr($amd, 0, 4);
}

////////////////////////////////////////////////////
//Convierte fecha de español  a Mysql--- OK
////////////////////////////////////////////////////

function convertirfecha_amd($dma)
{   //formato dd-mm-YY ingresa
    //retorna YY-mm-dd
    return substr($dma, 6, 4)."-".substr($dma, 3, 2)."-".substr($dma, 0, 2);
}


?>
