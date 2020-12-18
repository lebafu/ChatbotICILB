@extends('intents.layouts')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Check all Blogs</h2>
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
            <th>nombre</th>
            <th>respuestas</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($datos as $dato)
        <tr>
            <td>{{ $dato->id}}</td>
            <td>{{ $dato->nombre}}</td>
            <td>{{ $dato->respuestas}}</td>
            <td>
                <!--
   
                    -->
    
                    <a class="btn btn-primary" href="{{ route('intents.nlu_edit',$dato->id) }}">Edit</a>
   
                
            </td>
        </tr>
        @endforeach
    </table>
  

      
@endsection
© 2020 GitHub, Inc.