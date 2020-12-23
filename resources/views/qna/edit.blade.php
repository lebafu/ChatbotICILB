@extends('intents.layouts')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar QNA') }}</div>

                <div class="card-body">
                    <form action="{{route('qna.update', $question->id)}}" method="POST">
                       @csrf
                       @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Id') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="number" class="form-control" name="id" value="{{ $question->id }}" required autocomplete="nombre" autofocus readonly>

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Pregunta') }}</label>

                            <div class="col-md-6">
                                <input id="pregunta" type="text" class="form-control" name="pregunta" value="{{ $question->pregunta}}" required autocomplete="respuestas" autofocus>

                              
                            </div>
                        </div>
                        @if($question->id==1)
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Respuesta') }}</label>

                            <div class="col-md-6">
                                <input id="respuesta" type="text" class="form-control" name="respuesta" value="{{$answer->nombre}}" required autocomplete="nombre" autofocus readonly>
                            </div>
                        </div>
                        @else
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Respuesta') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{$answer->nombre}}" required autocomplete="nombre" autofocus>
                            </div>
                        </div>
                       @endif

                         

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>

                                <a href="/" class="btn">{{ __('Cancelar') }}</a>
                                    
                            </div>

                                
                            
                        </div>
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
© 2020 GitHub, Inc.