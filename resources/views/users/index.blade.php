@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
<div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Acessos</div>
                <div class="panel-body">
                <form action="{{url('users/')}}">
                    <table class="table">   
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Nome</td>
                                <td>Sobrenome</td>
                                <td>Email</td>
                                <td>Ações</td>
                            </tr>
                            {{--  <tr>
                                    <td><input type="text" name="filters[id]" class="mini-form"></td>
                                    <td><input type="text" name="filters[name]" class="mini-form"></td>
                                    <td><input type="text" name="filters[last_name]" class="mini-form"></td>
                                    <td><input type="text" name="filters[emai]l" class="mini-form"></td>
                                    <td><input type="submit" value="Enviar"></td>
                            </tr>  --}}
                        </thead>
                        <tbody>
                    @forelse ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><ul class="grid-action-area">
                                                        <li>
                                                            <a title="Editar" class="glyphicon glyphicon-pencil" href="{{ url('/users/edit') }}/{{$item->id}}">
                                                                <span class="hide-text"></span>
                                                            </a>
                                                        </li>
                                                          <li>
                                                            <a title="Excluir Acesso" class="glyphicon glyphicon-remove-sign" href="javascript:void(0)" onclick="confirmationDialog('400','250','Deseja Excluir o acesso de: {{$item->name}}?','excludeAccess(\'{{ $item->id }}\')')">
                                                                <span class="hide-text"></span>
                                                            </a>
                                                        </li>
                                                        </ul>
                                </td>
                            </tr>
                        @empty
                            <td>Nenhum dado Encontrado</td>
                        @endforelse
                        </tbody>
                    </table>
                </form>
               
                <br />
                <a href="{{ url('/users/new') }}" class="btn btn-primary">Novo</a>
                &nbsp;&nbsp;&nbsp;
                <a href='{{ url("/") }}' class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
    </div>

    <script>
    
    excludeAccess = function( idParam ){
        $.ajax({
                type: "POST",
                url: "{{ url('users/remove') }}",
                data: {
                       id: idParam,
                       _token: _token
                       },
                dataType: "json",
                success: function(response)
                {
		    redirTo = "{{ url('users') }}";
                    successDialog( 300 , 220 , response.message , "$(location).attr('href', '"+redirTo+"')" )
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
