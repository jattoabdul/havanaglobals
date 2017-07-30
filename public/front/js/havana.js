$(document).ready(function() {
    var ajaxSpinner = '<img src="/front/img/ajax-loader.gif" width="20" />';
    var _token = $('meta[name="_token"]').attr('content');
    'use strict';

    $(document).on('click','.prod-img',function(e)
    {
        window.location.href = $(this).attr('data-url');
    });




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


    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        var btn = $(this); var id = btn.attr('data-id'); var btn_title = btn.attr('data-title'); var qty = ($('#single-product-qty').length)?$('#single-product-qty').val():1;

        btn.html(ajaxSpinner).attr('disabled', 'disabled');

        $.post("/cart/add", {pid:id, qty:qty, _token:_token},  function(response)
        {
            console.log(response.state);
            if (response.state == 'success')
            {
                $('.cart-total').html('N'+response.total);
                $('#cart-count').html(response.count);
                var qty_element = $('#cart-item-qty-'+id);

                if (qty_element.length === 0) {

                    var cart_item = '<li class="cart-list" id="cart-item-'+id+'">';
                    cart_item += '<div class="cart-img"> <img src="'+response.data.img+'" alt=""> </div>';
                    cart_item += '    <div class="cart-title">';
                    cart_item += '         <div class="fsz-16">';
                    cart_item += '             <a href="'+response.data.url+'" target="_blank"> <span class="light-font">'+response.data.name+'</span></a>';
                    cart_item += '         </div>';
                    cart_item += '         <div class="price">';
                    cart_item += '             <strong class="clr-txt"><span>N'+response.data.price+'</span> x <span id="cart-item-qty-'+id+'">'+response.data.qty+'</span></strong>';
                    cart_item += '         </div>';
                    cart_item += '    </div>';
                    cart_item += '</div>';
                    cart_item += '<div class="close-icon"> <i class="fa fa-close clr-txt cart-item-remove" data-id="'+id+'" data-row-id="'+response.data.row_id+'"></i> </div>';

                    $('#cart-popup').prepend(cart_item);
                }
                else
                {
                    var item_qty = Number(qty_element.html());
                    qty_element.html(item_qty + Number(response.data.qty));
                }

                swal('Success',response.msg,'success');
                if ($('#shopping-cart-table').length){ location.reload(); }
            }

            if (response.state == 'error') { swal('Oops',response.msg,'error'); }
            $(btn).html(btn_title).removeAttr('disabled');
        })
    });

    $(document).on('click', '.cart-item-remove', function (e)
    {
        e.preventDefault();
        var btn = $(this); var id = btn.attr('data-id'); var row_id = btn.attr('data-row-id');

        $.get("/cart/remove/"+row_id, function(response)
        {
            if (response.state == 'success')
            {
                $('.cart-total').html('N'+response.total);
                $('#cart-count').html(response.count);
                $('#cart-item-'+id).slideUp();
                //swal('Success',response.msg,'success');
            }
            if ($('#shopping-cart-table').length){ location.reload(); }
        });
    });

    $(document).on('click', '.add-to-wishlist', function (e)
    {
        e.preventDefault();
        var btn = $(this); var id = btn.attr('data-id');

        if (id == null) { swal('Info','Login to add items to your wishlist','info'); return;}

        $.post("/wishlist/add", {id:id, _token:_token}, function(response)
        {
            if (response.state == 'success') { swal('Success',response.msg,'success'); }
            if (response.state == 'error') { swal('Error',response.msg,'error'); }
            if (response.state == 'info') { swal('Info',response.msg,'info'); }
        });
    });

    $(document).on('click', '.remove-from-wishlist', function (e)
    {
        e.preventDefault();
        var btn = $(this); var id = btn.attr('data-id'); var btn_title = btn.attr('data-title');
        btn.html(ajaxSpinner).attr('disabled', 'disabled');
        $.post("/wishlist/remove", {id:id, _token:_token}, function(response)
        {
            if (response.state == 'success') { $('#wish-item-'+id).slideUp(); }

            if (response.state == 'error') { swal('Error',response.msg,'error'); }
            if (response.state == 'info') { swal('Info',response.msg,'info'); }

            $(btn).html(btn_title).removeAttr('disabled');
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

    $(document).on('click','#switch-to-login',function(e)
    {
        e.preventDefault();
        $('#checkout-register-form').slideUp();
        $('#checkout-login-form').slideDown();
    });

    $(document).on('click', '.product-quicklook', function (e)
    {
        var id = $(this).attr('data-id');

        $('.preview-overlay').show();
        var popup_canvas = $('#product-popup-canvas');
        function syncPosition(el) {
            var current = this._current;
            sync2
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced");
            center(current);
        }
        function center(num) {
            var sync2visible = sync2.find('.owl-item.active').map(function () {
                return $(this).index();
            });
            if ($.inArray(num, sync2visible) === -1) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("to.owl.carousel", [num - sync2visible.length + 2, navSpeedThumbs, true]);
                } else {
                    sync2.trigger("to.owl.carousel", Math.max(0, num - 1));
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2.trigger("to.owl.carousel", [sync2visible[1], navSpeedThumbs, true]);
            } else if (num === sync2visible[0]) {
                sync2.trigger("to.owl.carousel", [Math.max(0, num - 1), navSpeedThumbs, true]);
            }
        }

        $.get("/product/"+id, function(res)
        {
            if (res.state == 'success') {
                var product = res.product;
                var images_sync1 = '';
                var images_sync2 = '';
                var categories = '';
                var product_content = $('.product-content');
                $.each(product.images, function(i, item) {
                    var active = (i == 0)?' active':'';
                    images_sync1 += '<div class="owl-item'+active+'" style="width: 100px; margin-right: 0px;">';
                    images_sync1 += '<div class="item">';
                    images_sync1 += '<img src="'+item.url+'" alt="'+item.label+'">';
                    images_sync1 += '<a href="'+item.url+'" data-gal="prettyPhoto[prettyPhoto]" title="'+item.label+'" class="caption-link"><i class="arrow_expand"></i></a>';
                    images_sync1 += '</div>';
                    images_sync1 += '</div>';
                });
                $.each(product.images, function(i, item) {
                    var active = (i == 0)?' active synced':'';
                    images_sync2 += '<div class="owl-item'+active+'" style="width: 33.333px; margin-right: 0px;">';
                    images_sync2 += '<div class="item"> <a href="#"> <img src="'+item.url+'" alt="'+item.label+'"> </a> </div>';
                    images_sync2 += '</div>';
                });
                $.each(product.category, function(i, item) {
                    categories += item.name+', ';
                });

                var data_id = (product.qty > 0) ?product.id:null;
                var add_to_cart = (product.qty > 0)? ' add-to-cart':'';
                var old_price = (product.old_price != null)? 'N'+product.old_price:'';
                var desc = (product.description != null)? product.description:'';

                $('#sync1').find('.owl-stage:first').html(images_sync1);
                $('#sync2').find('.owl-stage:first').html(images_sync2);

                $('#sync1').init();
                $('#sync2').init();
                console.log($('#sync1').init());

                product_content.find('.section-title:first').html('<a href="#"> <span class="light-font"> '+product.name+' </span></a>');
                product_content.find('.description:first').html('<p>'+desc+'</p>');
                product_content.find('.add-cart:first').html('<a href="javascript:;" data-title="ADD TO CART" data-id="'+data_id+'" class="theme-btn btn'+add_to_cart+'"> <strong> ADD TO CART </strong> </a>');
                product_content.find('.categories:first').html(categories.trim().slice(0,-1));
                product_content.find('.qty').html('Quantity Available: '+product.qty);
                product_content.find('.price:first').html('<strong class="clr-txt fsz-20">N'+product.price.toLocaleString("en")+' </strong><del class="light-font">'+old_price+' </del>');

                $('.preview-overlay').fadeOut(500);
            }
        });
    });

});