@yield('java')



<script>
    $(document).ready(function () {
        //Se posiciona y marca el primer campo disponible.
        $('input:visible:enabled:first').focus();
        $('input:visible:enabled:first').select();

        ActivarFiltro();
    });

    function ActivarFiltro() {
        if (document.getElementById('opcion1').checked) {
            document.getElementById("FechaInicio").disabled = true;
            document.getElementById("FechaFin").disabled = true;
            document.getElementById("Pacientes").disabled = false;
            $('#Pacientes').focus();
            $('#Pacientes').select();
        }

        if (document.getElementById('opcion2').checked) {
            document.getElementById("FechaInicio").disabled = false;
            document.getElementById("FechaFin").disabled = false;
            document.getElementById("Pacientes").disabled = true;
            $('#Pacientes').focus();
            $('#Pacientes').select();
        }

    }

</script>
