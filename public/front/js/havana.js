$(document).ready(function() {
    var ajaxSpinner = '<img src="/front/img/ajax-loader.gif" width="20" />';
    var _token = $('meta[name="_token"]').attr('content');
    'use strict';


    $(document).on('click','.checkout-login',function(e)
    {
        e.preventDefault(); var email = $('#login-email').val(); var password = $('#login-password').val(); $('#ajax_login_feedback').html(ajaxSpinner).attr('disabled', 'disabled');
        $.post("/login", {email:email, password:password, _token:_token},  function(response, status)
        {
            location.reload();

            $('#ajax_login_feedback').html('Log In').removeAttr('disabled');
            //if(response.state == 'error') { swal('Oops',response.msg,'error'); $('#course-'+id).slideDown(); $('#ajax_ui_feedback').html(''); }
        }).fail(function(response) {
                if (response.status == 422) {
                    var val_errors='';
                    $.each(response.responseJSON, function(i, item) {
                        if ($.isArray(item)) { val_errors += item[0]+" <br />"; }else { val_errors += item+" <br />"; }
                    })
                    $('#login-error-response').html(val_errors);
                    $('#ajax_login_feedback').html('Log In').removeAttr('disabled');
                    console.log(response.responseJSON);
                }
            });
    });



    $(document).on('click','.checkout-register',function(e)
    {
        e.preventDefault();
        var first_name = $('#reg-firstname').val(); var last_name = $('#reg-lastname').val();
        var email = $('#reg-email').val(); var password = $('#reg-password').val(); var tel = $('#reg-tel').val();

        if(first_name == '') { swal('Oops','The first name field must not be empty.','info'); return;}
        if(last_name == '') { swal('Oops','The last name field must not be empty.','info'); return;}
        if(email == '') { swal('Oops','The email field must not be empty.','info'); return;}
        if(password == '') { swal('Oops','The password field must not be empty.','info'); return;}
        if(tel == '') { swal('Oops','The tel field must not be empty.','info'); return;}

        $('#ajax_register_feedback').html(ajaxSpinner).attr('disabled', 'disabled');

        $.post("/register", {first_name:first_name, last_name:last_name, email:email, password:password, tel:tel, _token:_token},  function(response, status)
        {
            location.reload();

            $('#ajax_register_feedback').html('Register').removeAttr('disabled');
        }).fail(function(response) {
            if (response.status == 422) {
                var val_errors='';
                $.each(response.responseJSON, function(i, item) {
                    if ($.isArray(item)) { val_errors += item[0]+" <br />"; }else { val_errors += item+" <br />"; }
                });
                $('#register-error-response').html(val_errors);
                $('#ajax_register_feedback').html('Log In').removeAttr('disabled');
            }
        });
    });


    $(document).on('click','.checkout-guest',function(e)
    {
        e.preventDefault();
        var first_name = $('#guest-firstname').val(); var last_name = $('#guest-lastname').val();
        var email = $('#guest-email').val(); var tel = $('#guest-tel').val();

        if(first_name == '') { swal('Oops','The first name field must not be empty.','info'); return;}
        if(last_name == '') { swal('Oops','The last name field must not be empty.','info'); return;}
        if(email == '') { swal('Oops','The email field must not be empty.','info'); return;}
        if(tel == '') { swal('Oops','The tel field must not be empty.','info'); return;}

        $('#ajax_guest_feedback').html(ajaxSpinner).attr('disabled', 'disabled');

        $.post("/guest/register", {first_name:first_name, last_name:last_name, email:email, tel:tel, _token:_token},  function(response, status)
        {
            location.reload();

            $('#ajax_guest_feedback').html('Submit').removeAttr('disabled');
        }).fail(function(response) {
            if (response.status == 422) {
                var val_errors='';
                $.each(response.responseJSON, function(i, item) {
                    if ($.isArray(item)) { val_errors += item[0]+" <br />"; }else { val_errors += item+" <br />"; }
                });
                $('#guest-error-response').html(val_errors);
                $('#ajax_guest_feedback').html('Submit').removeAttr('disabled');
            }
        });
    });


    $(document).on('click','.checkout-continue',function(e)
    {
        e.preventDefault();
        $('#checkout-login-form').slideUp();
        if ($('#chk-register').prop('checked') == true)
        {
            $('#checkout-guest-form').slideUp();
            $('#checkout-register-form').slideDown();
        }
        if ($('#chk-guest').prop('checked') == true)
        {
            $('#checkout-register-form').slideUp();
            $('#checkout-guest-form').slideDown();
        }
    });
});