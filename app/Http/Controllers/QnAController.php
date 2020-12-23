<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use App\Models\Question;

class QnAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //Envio en la variable datos la información de las atblas questions y answer mediante el join.
         $datos=DB::table('answer')->join('questions','answer.id','=','questions.id_answers')->select('questions.*', 'answer.nombre')->get();
    //dd($datos);
      return view('qna.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $datos=DB::table('answer')->join('questions','answer.id','=','questions.id_answers')->select('questions.*', 'answer.nombre')->select('questions.*','answer.nombre')->where('answer.id','=',$id)->get();

        //Selecciono el elemento de la tabla questions que editaremos
        $questions=DB::table('questions')->where('questions.id',$id)->get();
        //Como tenemos 2 consultas question y answer lo mejor es recorrer con un foreach estas variables e imprimirlas de manera directa en la vista
        foreach($questions as $question)

        //dd($nlu_question->nlu_name_id);

        //Selecciono el elemento answer que editaremos conectandolo con su fk de la tabla question
        $answers=DB::table('answer')->where('answer.id','=',$question->id_answers)->get();
        //Como tenemos 2 consultas question y answer lo mejor es recorrer con un foreach estas variables e imprimirlas de manera directa en la vista
        foreach($answers as $answer);
        //Les paso los elementos de las consultas a la vista.
        return view('qna.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        //dd($id);

        //consulto por cual es la tupla editada en la tabla questions
        $questions=DB::table('questions')->where('id','=',$id)->get();
        //Recorro con el foreach para pasar los datos de esta tabla por separado con los de la otra tabla, sin usar un join
        //ya que question y answer en un inicio tenían el mismo nombre y me lanzaba un problema
        foreach($questions as $question);
        
        //pregunto mediante la fk de la tabla question, a cual id de la tabla answer corresponde...
        $answers=DB::table('answer')->where('id','=',$question->id_answers)->get();
      foreach($answers as $answer);
      
      //Guardo en $contador_question cuantos answers o respuestas tengo asociadas a esa pregunta...
      $contador_question=DB::table('questions')->where('id_answers','=',$question->id_answers)->count();
      
      //La ruta del directorio dentro de la carpeta public, que como se dijo anteriormente irá dentro de directorio1
      $directorio1="botpress12120/data/bots/ucm-botpress1/intents";
      
      //Se creaa arreglo para guadar direccion de archivos de carpeta
      $res = array();

  // Agregamos la barra invertida al final en caso de que no exista
  if(substr($directorio1, -1) != "/") $directorio1 .= "/";

  // Creamos un puntero al directorio y obtenemos el listado de archivos
  $dir1 = @dir($directorio1) or die("getFileList: Error abriendo el directorio $directorio1 para leerlo");
  while(($archivo1 = $dir1->read()) !== false) {
      // Obviamos los archivos ocultos
      if($archivo1[0] == ".") continue;
      if(is_dir($directorio1 . $archivo1)) {
          $res[] = array(
            "Nombre" => $directorio1 . $archivo1 . '"/"',
            "Tamaño" => 0,
            "Modificado" => filemtime($directorio1 . $archivo1)
          );
      } else if (is_readable($directorio1 . $archivo1)) {
          $res[] = array(
            "Nombre" => $directorio1 . $archivo1,
            "Tamaño" => filesize($directorio1 . $archivo1),
            "Modificado" => filemtime($directorio1 . $archivo1)
          );
      }
  }

  //MODIFICO  EL ARCHIVO EN EL QUE SE ENCUENTRE $patron DENTRO DE LA CARPETA INTENTS (PREGUNTA O QUESTION)
  //SI LA LINEA DE PREGUNTAS A MODIFICAR NO ES LA ULTIMA DEL ARREGLO NO LLEVA COMA, ENTONCES AQUI ACTUALIZARÁ ESTA LINEA
  //DE LO CONTRARIO HARÁ LA MODIFICACIÓN EN EEL SIGUIENTE WHILE
   $datosnuevos=null;
   //para saber cuantos archivos existen en la carpeta
  $tam=sizeof($res);
  //dd($tam);

  $i=0;
  //Si el valor de i es menor a la cantidad de archivos entonces saldrá del ciclo while
   while($i<$tam){
    
    //Se van abriendo cada uno de los archivos de la carpeta hasta que abre todos los archivos de la carpeta
    $path_archivo=("C:/Users/LI/Desktop/chatbot/public/".$res[$i]["Nombre"]);
    //print_r($res2[$i]["Nombre"]);
    //El texto que se desea modificar en el archivo de texto
    $patron= '"'.$question->pregunta.'"';
    //dd($patron);

    //Lo que se desea escribir en el archivo
    $sustitucion='"'.$request->pregunta.'"';
   
     //Se abre el archivo y se lee
      $leer = fopen($path_archivo, 'r+');
      //if(filesize($path_archivo) > 0){
      // Se almacena en data el contenido inicial del archivo
      $data = fread($leer, filesize($path_archivo));
      //dd($data);
      //Se cierra el archivo
      fclose($leer);
      //Se realiza el reeemplzado de la linea $patron por lo que dice en sustitución y lo demas queda exactamente igual a cmo esta en $data
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
        //Se abre el archivo para reescribirlo
      $escribir = fopen($path_archivo, 'w');
      //dd($datosnuevos);
      //Se esccribe en el archivo
      fwrite($escribir, $datosnuevos);
      fclose($escribir);
      //dd($datosnuevos);
      //Se le suma uno a $i y se abre el siguiente archivo siempre y cuando $i< la cantidad de archivos en esta carpeta
    $i=$i+1;
    //print_r($i);
   //}
  }
 

     //MODIFICO  EL ARCHIVO EN EL QUE SE ENCUENTRE $patron DENTRO DE LA CARPETA INTENTS (QUESTION O PREGUNTA)
    //SEGUIRÁ A ESTE WHILE SI EL PATRON QUE SE BUSCA ES EL ULTIMO ELEMENTO DELA ARREGLO QUESTION, ES:{}
   $datosnuevos=null;
    $i=0;
    //Si i es menor que la cantidad de archivos en la carpeta Intents mantiene el ciclo..., sino sale.
    while($i<$tam){
    
    //La ruta con los archivos que va abriendo 
    $path_archivo=("C:/Users/LI/Desktop/chatbot/public/".$res[$i]["Nombre"]);
    //print_r($res2[$i]["Nombre"]);

    //El string que es buscando en alguna linea en los archivos
    $patron= '"'.$question->pregunta.'","';
    //Lo que viene del formulario edit para modificar y añadirlo a la base de datos
    $sustitucion='"'.$request->pregunta.'","';
    //dd($sustitucion);
    //}
        $leer = fopen($path_archivo, 'r+');
      $data = fread($leer, filesize($path_archivo));
      //dd($data , $patron, $sustitucion);
      fclose($leer);
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      $escribir = fopen($path_archivo, 'w');
      fwrite($escribir, $datosnuevos);
      fclose($escribir);
      //dd($datosnuevos);
    $i=$i+1;
    //print_r($i);
  }

  //CERRAMOS EL DIRECTORIO
  $dir1->close();

  $directorio2="botpress12120/data/bots/ucm-botpress1/qna";
  $res2 = array();

  // Agregamos la barra invertida al final en caso de que no exista


  if(substr($directorio2, -1) != "/") $directorio2 .= "/";

  // Creamos un puntero al directorio y obtenemos el listado de archivos
  $dir2 = @dir($directorio2) or die("getFileList: Error abriendo el directorio $directorio2 para leerlo");
  while(($archivo2 = $dir2->read()) !== false) {
      // Obviamos los archivos ocultos
      if($archivo2[0] == ".") continue;
      if(is_dir($directorio2 . $archivo2)) {
          $res2[] = array(
            "Nombre" => $directorio2 . $archivo2 . "/",
            "Tamaño" => 0,
            "Modificado" => filemtime($directorio2 . $archivo2)
          );
      } else if (is_readable($directorio2 . $archivo2)) {
          $res2[] = array(
            "Nombre" => $directorio2 . $archivo2,
            "Tamaño" => filesize($directorio2 . $archivo2),
            "Modificado" => filemtime($directorio2 . $archivo2)
          );
      }
  }
  
  //MODIFICAMOS EL CAMPO PREGUNTA DE LA TABLA QUIESTIONS PARA VERIFICAR

  $datosnuevos=null;
  $tam=sizeof($res2);
  //dd($tam);

  $i=0;
   while($i<$tam){
    //RUTA DE LA CARPETA PUBLIC + RUTA DE DIRECTORIO HASTA CARPETA QNA DONDE RECORRERA CADA UNO DE LOS NOMBRES DE LOS ARCHIVOS QUE TIENE ALMACENADO EN LA VARIABLE RES2
    $path_archivo=("C:/Users/LI/Desktop/chatbot/public/".$res2[$i]["Nombre"]);
    //print_r($res2[$i]["Nombre"]);
    //EL STRING QUE SE ESTA BUSCANDO EN LOS ARCHIVOS DE LA CARPETA QNA, PARA MODIFICAR ALGUNA DE LAS PREGUNTAS, QUE COMO $patron como 
    //en este caso no lleva coma, sabemos que no será el ultimo del arreglo questions: es:[]
    $patron= '"'.$question->pregunta.'"';
    //dd($patron);
    // LO QUE SE DESEA ESCRIBIR COMO NUEVA PREGUNTA EN LA TABLA QUESTIONS Y EN LA BASE DE DATOS DE BOTPRESS
    $sustitucion='"'.$request->pregunta.'"';
    //dd($patron , $sustitucion);
    //}
    //dd($path_archivo);
        //SE ABRE EL ARCHIVO PARA LEERLO
      $leer = fopen($path_archivo, 'r+');
      //if(filesize($path_archivo) > 0){
      //SE ALMACENA LO QUE SE LEE INTERMANETE EN EL ARCHIVO
      $data = fread($leer, filesize($path_archivo));
      //dd($data);
      //SE CIERRA EL ARCHIVO QUE SE LEE
      fclose($leer);
      //SI EN EL ARCHIVO ENCUENTRA $patron entonces lo cambiará por $sustitucion y copiará lo demas del archivo data en la variable $datosnuevos
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      $escribir = fopen($path_archivo, 'w');
      //dd($datosnuevos);
      //Se escribe en $datosnuevos los en el aarchivo que corresponde
      fwrite($escribir, $datosnuevos);
      //cerramos la escritura en el archivo
      fclose($escribir);
      //dd($datosnuevos);
    $i=$i+1;
    //print_r($i);
   //}
  }
 
   $datosnuevos=null;
    $i=0;
    while($i<$tam){
    //dd($request->pregunta);
    //dd($question->pregunta);
    //if($i+1==11){

        //RUTA DE LA CARPETA PUBLIC + RUTA DE DIRECTORIO HASTA CARPETA QNA DONDE RECORRERA CADA UNO DE LOS NOMBRES DE LOS ARCHIVOS QUE TIENE ALMACENADO EN LA VARIABLE RES2
    $path_archivo=("C:/Users/LI/Desktop/chatbot/public/".$res2[$i]["Nombre"]);
    //print_r($res2[$i]["Nombre"]);

    //EL STRING QUE SE ESTA BUSCANDO EN LOS ARCHIVOS DE LA CARPETA QNA, PARA MODIFICAR ALGUNA DE LAS PREGUNTAS, QUE COMO $patron como 
    //en este caso no lleva coma, sabemos que no será el ultimo del arreglo questions: es:[]
    $patron= '"'.$question->pregunta.'","';
        // LO QUE SE DESEA ESCRIBIR COMO NUEVA PREGUNTA EN LA TABLA QUESTIONS Y EN LA BASE DE DATOS DE BOTPRESS MEDIANTE MODIFICACION DE ARCHIVO .JSON SE LOGRARÁ.
    $sustitucion='"'.$request->pregunta.'","';
    //dd($sustitucion);
    //}
       //SE ALMACENA LO QUE SE LEE INTERNAMENTE EN EL ARCHIVO
        $leer = fopen($path_archivo, 'r+');
      $data = fread($leer, filesize($path_archivo));
      //dd($data , $patron, $sustitucion);
      //se cierra la lectura del archivo
      fclose($leer);
    //SI EN EL ARCHIVO ENCUENTRA $patron entonces lo cambiará por $sustitucion y copiará lo demas del archivo data en la variable $datosnuevos
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //SE ABRE EL ARCHIVO APRA ESCRITURA
      $escribir = fopen($path_archivo, 'w');
     //Se escribe en $datosnuevos los en el aarchivo que corresponda a esta iteracion
      fwrite($escribir, $datosnuevos);
      fclose($escribir);
      //dd($datosnuevos);
    $i=$i+1;
    //print_r($i);
  }

     //dd($datosnuevos);
    //Se cierra directorio
     $dir2->close();
  
  //MODIFICANDO RESPUESTA DE QNA QUESTION PREGUNTA 
  $tam=sizeof($res2);
  $i=0;
  while($i<$tam){
    //dd($request->pregunta);
    //dd($question->pregunta);
    //if($i+1==11){

    //Se abre cada uno de los archivos de la carpeta  QNA
    $path_archivo=("C:/Users/LI/Desktop/chatbot/public/".$res2[$i]["Nombre"]);
    //print_r($res2[$i]["Nombre"]);

    //EL STRING QUE SE ESTA BUSCANDO EN LOS ARCHIVOS DE LA CARPETA QNA, PARA MODIFICAR ALGUNA DE LA RESPUESTAS, QUE COMO $patron como 
    //en este caso no lleva coma, sabemos que no será el ultimo del arreglo answers: es:[], cbae señalar que las respuestas de QNA son solo son una fla con el texto entre comillas, no tienen ninguna coma final al ser solo una respuesta única.
    $patron= '"'.$answer->nombre.'"';
    //dd($patron);
    $sustitucion='"'.$request->nombre.'"';
    //dd($sustitucion);
    //}
     //Abro el archivo que corresponda para leerlo
      $leer = fopen($path_archivo, 'r+');
      //lo leo y copio eso en la variable $data
      $data = fread($leer, filesize($path_archivo));
      //cierro el archivo para leer
      fclose($leer);
    //SI EN EL ARCHIVO ENCUENTRA $patron entonces lo cambiará por $sustitucion y copiará lo demas del archivo data en la variable $datosnuevos

      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //Abro el archivo para escribir en el
      $escribir = fopen($path_archivo, 'w');
      //Escribo lo que se encuentra en $datosnuevos lo que see haya en el archivo respectivo de la iteración en la que estemos
      fwrite($escribir, $datosnuevos);
      //Cerramos el archivo apara escribir
      fclose($escribir);
      //dd($datosnuevos);
    $i=$i+1;
    //print_r($i);
  }

  //Actualizamos la base de datos mysql con las respectivas tablas
   DB::table('questions')->where('id', $id)->update(['pregunta' => $request->pregunta]);
   //$question->pregunta=$request->pregunta;
   //$question->save();
    DB::table('answer')->where('id','=',$question->id_answers)->update(['nombre'=>$request->nombre]);

   //$answer->nombre=$request->nombre;
   //$answer->save();
   //$dir2->close();
    

 return view('qna.message',compact('question','answer','datosnuevos'));
 
  
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
