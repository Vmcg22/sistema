Mostrar Lista de Empleados

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
                <td> {{ $empleado->Foto}} </td>
                <td> Editar | Borrar </td>
            </tr>
        @endforeach
    </tbody>
</table>