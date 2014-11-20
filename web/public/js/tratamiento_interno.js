var c = $('#select_medicamentos').size() + 1;

$(document).ready(function() {

    $('#remove_medicamento').hide();

    $('#add_medicamentos').click(function() {
        
        c++;

        var orginal = $(".div_medicamento:last");

        var elem_clone = $(".div_medicamento:last").clone(true);

        elem_clone.appendTo(".div_medicamentos");
        //get original selects into a jq object
        var originalSelects = orginal.find('select');
        
        elem_clone.find('.select_medicamentos').each(function(i, item) {

            $(this).find("[value='"+originalSelects.eq(i).val()+"']").remove();
            var newId = this.id.substring(0, this.id.length-2) + c + ']';
            this.name = this.id = newId; // update id and name (assume the same)                 

        });
        
        elem_clone.find('.otro').each(function(i, item) {

            var newId = this.id.substring(0, this.id.length-2) + c + ']';
            this.name = this.id = newId; // update id and name (assume the same)                 

        });

        elem_clone.find("div, input").each(function(){
             var newId = this.id.substring(0, this.id.length-2) + c + ']';
             this.name = this.id = newId; // update id and name (assume the same)
        });

        if((elem_clone.find('.select_medicamentos option').length) <= 1){

            $('#add_medicamentos').hide();
            
        }
        
        if (c >= 1) {
            $('#remove_medicamento').show();
        } else {
            $('#remove_medicamento').hide();
        }
        
    });

    $('#remove_medicamento').click(function() {
        if (c > 1) {
            $('.div_medicamento:last').remove();
            c--;
            if (c == 1) {
                $('#remove_medicamento').hide();
            }
        }
        $('#add_medicamentos').show();
    });

});