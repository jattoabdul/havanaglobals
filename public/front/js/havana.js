$(document).ready(function() {
    var ajaxSpinner = '<img src="/front/img/ajax-loader.gif" width="20" />';
    var _token = $('meta[name="_token"]').attr('content');
    'use strict';


    $(document).on('click','.checkout-login',function(e)
    {
        e.preventDefault(); var email = $('#login-email').val(); var password = $('#login-password').val(); $('#ajax_login_feedback').html(ajaxSpinner);
        $.post("/login", {email:email, password:password, _token:_token},  function(response, status)
        {
            location.reload();

            $('#ajax_login_feedback').html('Log In')
            //if(response.state == 'error') { swal('Oops',response.msg,'error'); $('#course-'+id).slideDown(); $('#ajax_ui_feedback').html(''); }
        }).fail(function(response) {
                if (response.status == 422) {
                    var val_errors='';
                    $.each(response.responseJSON, function(i, item) {
                        if ($.isArray(item)) { val_errors += item[0]+" <br />"; }else { val_errors += item+" <br />"; }
                    })
                    $('#login-error-response').html(val_errors);
                    $('#ajax_login_feedback').html('Log In');
                    console.log(response.responseJSON);
                }
            });
    });

    $(document).on('submit','.checkout-login',function(e)
    {
        e.preventDefault(); var email = $('#login-email').val(); var password = $('#login-password').val(); $('#ajax_login_feedback').html(ajaxSpinner);
        $.post("/login", {email:email, password:password, _token:_token},  function(response, status)
        {
            if (response.status == 200)
            {
                location.reload();
            }

            $('#ajax_login_feedback').html('Log In')
            //if(response.state == 'error') { swal('Oops',response.msg,'error'); $('#course-'+id).slideDown(); $('#ajax_ui_feedback').html(''); }
        }).fail(function(response) {
            if (response.status == 422) {
                var val_errors='';
                $.each(response.responseJSON, function(i, item) {
                    if ($.isArray(item)) { val_errors += item[0]+" <br />"; }else { val_errors += item+" <br />"; }
                })
                $('#login-error-response').html(val_errors);
                $('#ajax_login_feedback').html('Log In');
                console.log(response.responseJSON);
            }
        });
    });
});