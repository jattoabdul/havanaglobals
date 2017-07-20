/**
Custom module for you to write your own javascript functions
**/
var Custom = function () {

    // private functions & variables

    var myFunc = function(text) {
        alert(text);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.            
        },

        //some helper function
        doSomeStuff: function () {
            myFunc();
        }

    };

}();

jQuery(document).ready(function() {    
   Custom.init();
    $(document).on('click','.add-new-image',function(e) {
        e.preventDefault();

        var count = $(this).attr('data-count');
        var base_url = $(location).attr('protocol')+'//'+$(location).attr('hostname');
        var row = '<tr>';
        row += '<td><div class="form-group">';
        row += '<div class="fileinput fileinput-new" data-provides="fileinput">';
        row += '<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">';
        row += '<img src="'+base_url+'/dash/global/img/placeholder.png" alt="" /> </div>';
        row += '<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>';
        row += '<div>  <span class="btn default btn-file">';
        row += '<span class="fileinput-new"> Select image </span> <span class="fileinput-exists"> Change </span>';
        row += '<input type="file" name="product[images]['+count+'][file]"> </span>';
        row += '<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>';
        row += '</div> </div> </div>';
        row += '</td> <td>';
        row += '<input type="text" class="form-control" name="product[images]['+count+'][label]" value="">';
        row += '</td><td>';
        row += '<input type="text" class="form-control" name="product[images]['+count+'][sort_order]" value="0">';
        row += '</td><td>';
        row += '<a href="javascript:;" class="btn btn-default btn-sm" data-id="'+count+'"> <i class="fa fa-times"></i> Remove </a>';
        row += '</td> </tr>';
        console.log(row);
        $('#images-wrapper').append(row);
        $('.add-new-image').attr('data-count', count++);
    });
});

/***
Usage
***/
//Custom.doSomeStuff();