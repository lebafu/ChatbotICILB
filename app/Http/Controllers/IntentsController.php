<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Nlu_name;
use App\Models\Nlu_question;
	  


class IntentsController extends Controller
{
    //

    public function modify_despedida(Request $request){

      //$path_archivo = public_path('botpress12120/ucm-botpress1/intents/despedida.json');
      //Ruta de archivo a abrir
      $path_archivo = public_path('botpress12120\data\bots\ucm-botpress1\intents\despedida.json'); 

      //Se abre el archivo y se lee
      $leer = fopen($path_archivo, 'r+');

      //Se guarda texto del archivo en data
      $data = fread($leer, filesize($path_archivo));

      //se cieerra archivo
      fclose($leer);

      //Texto a buscar en el archivo de texto .json
      $patron = '"Bye Bye",';
      //Texto a colocar en el archivo .json
	  $sustitucion = '"byeeee byeeee",';
    //La funcion str_replace permite reemplazar un texto hallado en una fila $patron en un archivo $data, por el texto $sustitucion
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //echo $datosnuevos;
      //Abre el archivo nuevamente 
      $escribir = fopen($path_archivo, 'w');
      //Escribe el texto nuevo en el archivo
      fwrite($escribir, $datosnuevos);

      //Cierra el archivo
      fclose($escribir);
     /* while(!feof($file)){
			//echo fgets($file). "<br />";
      		if($file==""Bye Bye,""){

      		}
		}
		fclose($file);*/
		//dd($datosnuevos);
		//return view('intents.modify_despedida', compact($datosnuevos));
    }

   //Se hace join entre las tablas del aprendizaje del lenguaje natural(NLU), para mostrar información en la base de datos
       public function nlu_index()
    {
      $datos=DB::table('nlu_name')->join('nlu_questions','nlu_name.id','=','nlu_questions.nlu_name_id')->select('nlu_questions.*', 'nlu_name.nombre')->get();

      return view('intents.nlu_index',compact('datos'));


    }

    public function create()
    {


    }


    public function store()
    {


    }


    //Editar campo respuestas de nlu_questions, pd: aun no se puede modificar campo nombre de nlu_name
    public function nlu_edit($id)
    {
        $datos=DB::table('nlu_name')->join('nlu_questions','nlu_name.id','=','nlu_questions.nlu_name_id')->select('nlu_questions.*','nlu_name.nombre')->where('nlu_questions.id','=',$id)->get();

        //Consulto por los datos que el usuario desea editar que perteneceran a la tabla nlu_questions
        $nlu_questions=DB::table('nlu_questions')->where('nlu_questions.id',$id)->get();
        //Uso foreach para acceder a cada elemento de la tabla.
        foreach($nlu_questions as $nlu_question)
        
        //Mediante la fk descubro el nombre del archivo .json al que debe pertenece.
        $nlu_names=DB::table('nlu_name')->where('nlu_name.id','=',$nlu_question->nlu_name_id)->get();
        //Uso foreach para acceder a cada elemento de la tabla.

        foreach($nlu_names as $nlu_name);
        //De esta forma se puede imprimir de manera directa los campos deseados en la vista intents.nlu_edit
        return view('intents.nlu_edit',compact('nlu_question','nlu_name'));
    }

    public function nlu_update(Request $request, Nlu_question $nlu_question){

      //Descubro que elemnto de la tabla nlu_questions estoy editando...
      $id=$nlu_question->id;
      //Pregunto el nombre del archivo, o el campo nombre que al que estan asociadas o etiquetadas este conjunto de palabras del aprendizaje automatico.
      $nlu_names=DB::table('nlu_name')->where('id','=',$nlu_question->nlu_name_id)->get();
      //Uso el foreach para no tener que aplicar foreach en la vista, y que sea mas engorroso, de esta forma en la vista
      //accedo al campo de la tabla nlu_name de forma directa, sin usar foreach
      foreach($nlu_names as $nlu_name);
       //De momento accedo de manera menos practica que con las QNA
      //Cabe recordar que public_path me genera la ruta automatica desde la raiz hasta la carpeta chatbot/public y de ahi en adelante busca la ruta que esta dentro de las "".
      if($nlu_name->nombre=="despedida"){
      $path_archivo = public_path("botpress12120\data\bots\ucm-botpress1\intents\despedida.json");
      }elseif($nlu_name->nombre=="mallas"){
        $path_archivo = public_path("botpress12120\data\bots\ucm-botpress1\intents\mallas.json");

      }elseif($nlu_name->nombre=="perfil-de-egreso"){
        $path_archivo = public_path("botpress12120\data\bots\ucm-botpress1\intents\perfil-de-egreso.json");

      }elseif($nlu_name->nombre=="contacto-carrera"){
        $path_archivo = public_path("botpress12120\data\bots\ucm-botpress1\intents\contacto-carrera.json");

     }elseif($nlu_name->nombre=="renunciar"){
              $path_archivo = public_path('botpress12120\data\bots\ucm-botpress1\intents\renunciar.json');

      }elseif($nlu_name->nombre=="sitio-web"){
            $path_archivo = public_path('botpress12120\data\bots\ucm-botpress1\intents\sitio-web.json');

      }
      //Consigo Nlu_question
      $nlu_question=Nlu_question::find($id);
      

      //Le asigno el elemento actual que se encuentra en base de datos mysql
      $patron= '"'.$nlu_question->respuestas.'",';
      //Le asigno a sustitucion el elemento que viene desde el formularo edit
      $sustitucion='"'.$request->respuestas.'",';
      //dd($sustitucion);
      //$patron = '"{{$nlu_question->respuestas}}",';
      //dd($patron);
      //RUTA DE ARCHIVO A ABRIR
      //dd($path_archivo);

      //leo el archivo
      $leer = fopen($path_archivo, 'r+');

      //escribo en la variable data lo que este archivo contiene
      $data = fread($leer, filesize($path_archivo));

      //cierro el archivo
      fclose($leer);
    //$sustitucion = '"byeeee byeeee",';
      //Modifico el archivo
      //Creo una variable $datosnuevos copio lo mismo que en $data pero modifico lo que dice en la fila $patron por $sustitucion
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //echo $datosnuevos;
      //abro el archivo nuevo para escribir 
      $escribir = fopen($path_archivo, 'w');
      //escribo lo que se almacen la variable $datosnuevos
      fwrite($escribir, $datosnuevos);

      //cierro el archivo
      fclose($escribir);
     /* while(!feof($file)){
      //echo fgets($file). "<br />";
          if($file==""Bye Bye,""){
      
          }
    }
    fclose($file);*/
    $nlu_question->respuestas=$request->respuestas;
    $nlu_question->save();
    return view('intents.message', compact('datosnuevos','nlu_name'));
      
    }
}
