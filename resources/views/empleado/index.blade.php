Mostrar Lista de Empleados

@if(Session::has('mensaje'))
    {{Session::get('mensaje')}}
@endif

<br> <br>

<a href=" {{ url('empleado/create') }} "> Crear Nuevo Empleado</a>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th> ID </th>
            <th> Nombre </th>
            <th> Apellido Paterno </th>
            <th> Apellido Materno </th>
            <th> Correo </th>
            <th> Foto </th>
            <th> Acciones </th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td> {{ $empleado->id}} </td>
                <td> {{ $empleado->Nombre}} </td>
                <td> {{ $empleado->ApellidoPaterno}} </td>
                <td> {{ $empleado->ApellidoMaterno}} </td>
                <td> {{ $empleado->Correo}} </td>
                <td> 

                    <img src=" {{ asset('storage'). '/' . $empleado->Foto }} " width="100" alt="" srcset="">
                    
                </td>
                <td> 
                    <a href=" {{url('/empleado/' . $empleado->id . '/edit') }} "> Editar </a>
                     |  
                    <form action=" {{ url('/empleado/' . $empleado->id) }} " method="post">
                        @csrf
                        {{ method_field("DELETE") }}
                        <input type="submit" onclick="return confirm('¿Deseas elimimar el Empleado?') " value="Borrar">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>