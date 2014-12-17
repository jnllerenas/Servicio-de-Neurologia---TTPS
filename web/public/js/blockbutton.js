$(document).ready(
    function(){

        $('form').submit(function(){
            $(":submit").attr('disabled','disabled').text('Procesando...').val('Procesando...');
        });
        
        $('a.btn-submit').click(function(){
            $(this).attr('disabled','disabled').text('Procesando...');
        });

    }
);