@extends('intents.layouts')
 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar nlu') }}</div>

                <div class="card-body">
                    <form action="{{route('intents.nlu_update', $nlu_question->id)}}" method="POST">
                       @csrf
                       @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Id') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $nlu_question->id }}" required autocomplete="nombre" autofocus disabled>

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $nlu_name->nombre }}" required autocomplete="nombre" autofocus disabled>

                              
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Respuesta') }}</label>

                            <div class="col-md-6">
                                <input id="respuestas" type="text" class="form-control" name="respuestas" value="{{ $nlu_question->respuestas }}" required autocomplete="respuestas" autofocus>

                              
                            </div>
                        </div>

                         

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