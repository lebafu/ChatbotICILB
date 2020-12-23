@extends('intents.layouts')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Todas las intenciones de Aprendizaje del Lenguaje Natural</h2>
            </div>
            <div class="pull-right">
                <!- -->
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Preguntas</th>
            <th>Respuestas</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($datos as $dato)
        <tr>
            <td>{{ $dato->id}}</td>
            <td>{{ $dato->pregunta}}</td>
            <td>{{ $dato->nombre}}</td>
            <td>
                <!--
   
                    -->
    
                    <a class="btn btn-primary" href="{{route('qna.edit',$dato->id)}}">Editar</a>
   
                
            </td>
        </tr>
        @endforeach
    </table>
  

      
@endsection
© 2020 GitHub, Inc.