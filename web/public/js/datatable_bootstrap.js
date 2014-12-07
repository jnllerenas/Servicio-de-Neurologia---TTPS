$(document).ready(function() {

    $('.datatable_bootstrap').dataTable({
            "sPaginationType":"full_numbers",
            "aaSorting":[[0, "asc"]],
            iDisplayLength: 5,
            bLengthChange: false,
            "bJQueryUI":true,
            "oLanguage" : {
                "sEmptyTable" : "No se encontraron resultados",
                "sInfo" : "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty" : "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered" : "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix" : "",
                "sInfoThousands" : ",",
                "sLengthMenu" : "Mostrar _MENU_ registros",
                "sLoadingRecords" : "Cargando...",
                "sProcessing" : "Procesando...",
                "sSearch" : "Buscar:",
                "sZeroRecords" : "No se encontraron resultados",
                "oPaginate" : {
                        "sFirst" : "Primero",
                        "sLast" : "Último",
                        "sNext" : "Siguiente",
                        "sPrevious" : "Anterior"
                },
                "oAria" : {
                        "sSortAscending" : ": activar para Ordenar Ascendentemente",
                        "sSortDescending" : ": activar para Ordendar Descendentemente"
                }
            }
    });
    
});