@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Acesso</div>
                <div class="panel-body">

                   <form action="" method="POST" id='form-principal' >
                        <input type="hidden" class ='form-control' name='id' value="{{$user->id}}" />
                        {{ csrf_field() }}
                        <br />
                        Nome:
                            <input type="text" class ='form-control' name='name' value="{{$user->name}}" />
                        <br />
                        SobreNome:
                            <input type="text" class ='form-control' name='last_name' value="{{$user->last_name}}" />
                         
                        <br />
                        Email:
                            <input type="text" class ='form-control' name='email' value="{{$user->email}}" />
                        <br />
                    </form>
                       <button type="submit" class="btn btn-primary" onclick='sendForm()'>Salvar</button>
                       &nbsp; &nbsp; &nbsp;
                       <a href='{{ url("users") }}' class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</div>

<script>
 
    function sendForm(){
        $.ajax({
                type: "POST",
                url: "{{ url('users/edit') }}",
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
