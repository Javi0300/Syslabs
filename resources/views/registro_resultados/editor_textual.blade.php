<div class="modal fade" id="EditorTextual">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="EditorTextualLabel">Editor de Texto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('registro_resultados.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body"> 
                    @if(session('editor_abierto') == 'si')
                    <input name="tomaxest_id" value="{{$tomaxest_editor->id}}" hidden readonly>
                    <textarea id="editor" name="editor" class="form-control">{{$tomaxest_editor->editor_archivo}}</textarea>
                   @endif
                </div>
                <div class="modal-footer">
                    {{-- <input id="imagen_cargada" type="file" class="btn btn-primary" onblur="hola();"> --}}
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>