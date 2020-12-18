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
      $path_archivo = public_path('botpress12120\data\bots\ucm-botpress1\intents\despedida.json'); //RUTA DE ARCHIVO A ABRIR
      $leer = fopen($path_archivo, 'r+');
      $data = fread($leer, filesize($path_archivo));
      fclose($leer);
      $patron = '"Bye Bye",';
	  $sustitucion = '"byeeee byeeee",';
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //echo $datosnuevos;
      $escribir = fopen($path_archivo, 'w');
      fwrite($escribir, $datosnuevos);
      fclose($escribir);
     /* while(!feof($file)){
			//echo fgets($file). "<br />";
      		if($file==""Bye Bye,""){

      		}
		}
		fclose($file);*/
		dd($datosnuevos);
		//return view('intents.modify_despedida', compact($datosnuevos));
    }


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

    public function nlu_edit($id)
    {
        $datos=DB::table('nlu_name')->join('nlu_questions','nlu_name.id','=','nlu_questions.nlu_name_id')->select('nlu_questions.*','nlu_name.nombre')->where('nlu_questions.id','=',$id)->get();
        $nlu_questions=DB::table('nlu_questions')->where('nlu_questions.id',$id)->get();
        foreach($nlu_questions as $nlu_question)
        //dd($nlu_question->nlu_name_id);
        $nlu_names=DB::table('nlu_name')->where('nlu_name.id','=',$nlu_question->nlu_name_id)->get();
        foreach($nlu_names as $nlu_name);
        //dd($nlu_name);

        //foreach($datos as $dato);
        //dd($datos);
        //$nlus = ::with('projects')->all();
        //$nlu->nombre=$dato->nombre;
       // $nlu->respuesta=$dato->respuesta;
        return view('intents.nlu_edit',compact('nlu_question','nlu_name'));
    }

    public function nlu_update(Request $request, Nlu_question $nlu_question){

      $id=$nlu_question->id;
      $nlu_names=DB::table('nlu_name')->where('id','=',$nlu_question->nlu_name_id)->get();
      foreach($nlu_names as $nlu_name);
       //$nombre_archivo=$nlu_name->nombre .'.json';
      //dd($nombre_archivo);
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

      $nlu_question=Nlu_question::find($id);
      //dd($request->respuestas);
      //dd($nlu_question->respuestas);
      $patron= '"'.$nlu_question->respuestas.'",';
      $sustitucion='"'.$request->respuestas.'",';
      //dd($sustitucion);
      //$patron = '"{{$nlu_question->respuestas}}",';
      //dd($patron);
      //RUTA DE ARCHIVO A ABRIR
      //dd($path_archivo);
      $leer = fopen($path_archivo, 'r+');
      $data = fread($leer, filesize($path_archivo));
      fclose($leer);
    $sustitucion = '"byeeee byeeee",';
      $datosnuevos = str_replace($patron, $sustitucion, $data); //REEMPLAZA LO QUE CONTINE EL ARCHIVO VIEJO POR EL ARCHIVO NUEVO
      //echo $datosnuevos;
      $escribir = fopen($path_archivo, 'w');
      fwrite($escribir, $datosnuevos);
      fclose($escribir);
     /* while(!feof($file)){
      //echo fgets($file). "<br />";
          if($file==""Bye Bye,""){

          }
    }
    fclose($file);*/
    return view('intents.message', compact('datosnuevos','nlu_name'));
      
    }
}
