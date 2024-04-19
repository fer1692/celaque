$(document).ready(function(){
    $(".inputNumberBox").keypress(function(event){
        var inputNumberBox = event.charCode;
        if(!(inputNumberBox >= 48 && inputNumberBox <= 57) && (inputNumberBox != 31 && inputNumberBox != 0)){
            event.preventDefault();
        }
    });

    $('#limpiarCampos').click(function(){
        document.getElementById('monto').value = ''
        document.getElementById('interes').value = ''
        document.getElementById('plazo').value = ''
     });
});
