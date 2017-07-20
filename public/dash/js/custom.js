$(document).ready(function () {
    var _token = $('meta[name="_token"]').attr('content');

    $(document).on('click','.add-new-image',function(e) {
        e.preventDefault();

        var count = Number($(this).attr('data-count'));
        var base_url = $(location).attr('protocol')+'//'+$(location).attr('hostname')+($(location).attr('port') ? ':'+$(location).attr('port'): '');
        var row = '<tr class="new-image-'+count+'">';
        row += '<td>';
        row += '<div class="form-group">';
        row += '<div class="col-md-12">';
        row += '<div class="fileinput fileinput-new" data-provides="fileinput">';
        row += '<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">';
        row += '<img src="'+base_url+'/dash/global/img/placeholder.png" alt="" /> </div>';
        row += '<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>';
        row += '<div>  <span class="btn default btn-file">';
        row += '<span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>';
        row += '<input type="file" name="images['+count+'][file]"> </span>';
        row += '<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>';
        row += '</div> </div> </div>';
        row += '</td> <td>';
        row += '<input type="text" class="form-control" name="images['+count+'][label]" value="">';
        row += '</td><td>';
        row += '<input type="text" class="form-control" name="images['+count+'][sort_order]" value="0">';
        row += '</td><td>';
        row += '<a href="javascript:;" class="btn btn-default btn-sm remove-new-image" data-id="'+count+'"> <i class="fa fa-times"></i> Remove </a>';
        row += '</td> </tr>';

        count += 1;
        console.log(count);
        $('#images-wrapper').append(row);
        $('.add-new-image').attr('data-count', count);
    });

    $(document).on('click','.remove-new-image',function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        $('.new-image-'+id).slideUp(1000);
    });

    $(document).on('click','.delete-product-image',function(e) {
        e.preventDefault();
        var btn = $(this);
        var id = $(this).attr('data-id');

        btn.attr('disabled', 'disabled');

        $('#product-image-'+id).slideUp(1000);

        $.post("/admin/products/image/delete", {id:id, _token:_token},  function(response)
        {
            if(response.state == 'error') { swal('Oops',response.msg,'error'); img.slideDown(1000); btn.removeAttr('disabled')}
        });
    });

    $('.check-products').on('change',function(e){
        var val = $(this).val();

        if($(this).prop('checked') == true) { $('#check_ids').append('<input name="ids[]" type="hidden" class="hidden-check" value="'+val+'" id="hidden-check-'+val+'">'); }
        else { $('#hidden-check-'+val).remove(); }
    });

    $('#check-all').on('change',function(e){
        if($(this).prop('checked') == true) { $(".check-products").prop('checked', true); }
        else { $(".check-products").prop('checked', false); }

        var check_ids = '';
        $('.hidden-check').remove();
        $('.check-products:checked').each(function() {
            check_ids += '<input name="ids[]" class="hidden-check" type="hidden" id="hidden-check-'+Number(this.value)+'" value="'+Number(this.value)+'">'
        });

        $('#check_ids').append(check_ids);
    });

});