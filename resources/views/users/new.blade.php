@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Inserir Acesso</div>
                <div class="panel-body">
                   {!! Form::open([ 'id' => 'form-principal' , 'method' => 'post' ]) !!}
                        {{ Form::label('form_name', 'Nome:', ['class' => 'margin-top-10px control-label']) }}
                        {!! Form::text( 'name' , null , [ 'class' => 'form-control' ,'id' => 'form_name' ]) !!}
                        {{ Form::label('form_last_name', 'Sobrenome:', ['class' => 'margin-top-10px control-label']) }}
                        {!! Form::text( 'last_name' , null , [ 'class' => 'form-control' ,'id' => 'form_last_name' ]) !!}
                        {{ Form::label('form_email', 'E-mail:', ['class' => 'margin-top-10px control-label']) }}
                        {!! Form::text( 'email' , null , [ 'class' => 'margin-bottom-20px form-control' ,'id' => 'form_email' ]) !!}
                    {!! Form::close() !!}
                       <button type="submit" class="btn btn-primary margin-right-20px" onclick='sendForm()'>Salvar</button>
                       <a href='{{ url("users") }}' class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</div>

<script>
 
    function sendForm(){
        $.ajax({
                type: "POST",
                url: "{{ url('users/new') }}",
                data: $('#form-principal').serialize(),
                dataType: "json",
                success: function(response)
                {
                    successDialog( 300 , 220 , response.message , 'windowLocation("{{ url("users") }}")' )
                },
                error: function(jqXHR, textStatus, errorThrown){
                   returnErr = JSON.parse(jqXHR.responseText)
                   messageError = str_replace_recursive( "\n",'<br />',returnErr.message)
                   errorDialog( 410 , 300 , messageError )
                }
        });
    }

</script>

@endsection
