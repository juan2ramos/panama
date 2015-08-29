var filesForm = {
    'team': 'Equipo',
    'city': 'Ciudad ',
    'url_image': 'Imagen ',
    'name-user': 'Nombre ',
    'last-name': 'Apellido ',
    'birthday': 'Cumpleaños',
    'email': 'Email',
    'phone': 'Teléfono',
    'address': 'Dirección',

}, validationForm = [];

$(function () {
    $( ".datepicker" ).datepicker({changeYear: true,dateFormat: 'yy-mm-dd',yearRange: "1900:2015" }).on('change',function(ev){
        $(this).removeClass('fail');
        $(this).css({'border-color': '#BFBFBF'});
        $(this).parent().find('.error-s').remove();
    });


    $('.code').keyup(function () {
        if ($(this).val().length == $(this).attr("maxlength")) {
            $(this).next().focus();
        }
    });


    $('#form').on("submit", function (e) {
       e.preventDefault();


        validationForm = [];

        $(this).find('input').each(function () {
            validate($(this))
        });


        if (validationForm.length == 0) {

            var fields = $(this).serializeArray();
            $('.loading').addClass('show');
            $('.loading .spinner').addClass('show');
            $.post($(this).attr('action'), fields, responseForm, 'json');
        } else {
            topMove = $(this).find(' input.fail , select.fail').first().offset().top - 20;
            $('html, body').animate({scrollTop: topMove}, 'slow')
        }


    });

    $('input').focusout(function () {
        validate($(this));
    });
    function responseForm(r) {
        $('.loading').removeClass('show');
        $('.loading .spinner').removeClass('show');


        if (!r.success) {
            var res = r.errors.split("**");
            $("input").css({'border-color': '#e0e0e0'});
            $(".error-s").remove();

            for (var i = 0; i < res.length - 1; i++) {

                var str = res[i].trim();


                str1 = str;

                str2 = str1.split("++")[1]

                if (str2 != undefined) {

                     message = (str2 == "email")?'El mail ya esta registrado':(str2 == "code-1")?'Codigo invalido':'Número de Cédula ya registrada';
                    $("input[name=" + str2 + "]").before("<span class='error-s'>" + message + "</span>");

                    $("input[name=" + str2 + "]").css({'border-color': '#D60C41'}, {'background-color': 'red'});
                    $("input[name=" + str2 + "]").addClass('fail');
                } else {
                    $("input[name='" + str + "']").before("<span class='error-s'>El campo no puede estar vacío</span>");
                    $("input[name='" + str + "']").css({'border-color': '#D60C41'}, {'background-color': 'red'});
                }
              //  topMove = $('#form').find(' input.fail').first().offset().top - 20;
              //  $('html, body').animate({scrollTop: topMove}, 'slow')
            }
        }
        else {
                $('main').append(" <span class='thanks'>Gracias por inscribirte, en cuanto verifiquemos los datos te confirmaremos vía correo electrónico tu participación en Red Bull.</span>");
                $('#form').slideUp("slow");


        }
    }

    function validate($element) {


        if ($element.data('value') != undefined) {
            validateArray = $element.data('value').split("|")
            for (var i = 0; i < validateArray.length; i++) {
                window[validateArray[i]]($element);
            }
        }
    }

});
function requiredField($element) {



    $element.siblings(".error-s").remove();
    $element.css({'border-color': '#BFBFBF'});
    $element.removeClass('fail');

    if (!$element.val()) {
        if($element.attr('name') == 'code-1' || $element.attr('name') == 'code-2' || $element.attr('name') == 'code-3'){
            $('#code-1').removeClass('fail');
            $('#code-1').addClass('fail');
            $('#code-1').before("<span class='error-s'>El campo no puede estar vacío</span>");

            $('#code-1').css({'border-color': '#D60C41'});
            $('#code-2').css({'border-color': '#D60C41'});
            $('#code-3').css({'border-color': '#D60C41'});
            validationForm.push($element);

        }else{

            $element.addClass('fail');
            $element.before("<span class='error-s'>El campo no puede estar vacío</span>");
            $element.css({'border-color': '#D60C41'});
            validationForm.push($element);
        }

    }

}

function email($element) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    $element.siblings(".error-s").remove();
    $element.css({'border-color': '#BFBFBF'});


    $element.removeClass('fail');
    if (!pattern.test($element.val())) {
        $element.before("<span class='error-s'>No es un email válido </span>");
        $element.css({'border-color': '#D60C41'});
        $element.addClass('fail');
        validationForm.push($element);
    }

};