
$('#itemtrackbtn').on('submit', function(e) {
    e.preventDefault(true);
    var form = $(this);
    $.ajax({
        url: form.prop('action'),
        data: form.serialize(),
        success: function (data) {
        // do some cool stuff like returning a rendered comment
        //$('.comments').append(data);
        // OR just display a message
        $('#submissionstatus').html(data);
       // $('#formDiv').html('');
        alert('on success');
    },
    error: function (data) {
        // display the error (note: you have to work harder when there is
        // an array of errors returned
        alert('on erros');
        var error = data.responseJSON;
        $('#submissionstatus').html('<span style="color:red;">' + error.body + 'A message</span>');
    }
});
});


