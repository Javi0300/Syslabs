<table class="table">
    <thead>
        <tr>
            <th width="5">ID</th>
            <th width="15" style="background-color:#95b3d7; font-size: 15px;">Tipo</th>
            <th width="25" style="background-color:#95b3d7; font-size: 15px;">Estudios/Paquetes</th>
            <th width="20" style="background-color:#95b3d7; font-size: 15px;">Precio Actual</th>
            <th width="15" style="background-color:#95b3d7; font-size: 15px;">Precio</th>
            {{-- <th height="50" width="80">
                
            </th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $precio)
        <tr>
            <td>{{ $precio->idEstudio}}</td>
            <td>{{ $precio->Depto}}</td>
            <td>{{ $precio->nombreEstudio}}</td>
            <td>{{ $precio->precio}}</td>
            <td style="background-color:#ebf1de;">0</td>
        </tr>
      
        @endforeach
    </tbody>
</table>
