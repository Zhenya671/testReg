$(document).ready(function (){

    $('#sign-in-button').click(function () {
        $.ajax({
            type: 'POST',
            url: '/site/sign-in',
            dataType: 'json',
            data: $('#sign-in-form').serialize(),
            success: function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    $('#sign-in-errors').html(data.message).show();
                }

                $('#sign-up-errors').html('').hide();
                $('#sign-up-success').html('').hide();

                $('#sign-up-form')[0].reset();
            }
        })
    })

    $('#sign-up-button').click(function () {
        $.ajax({
            type:'POST',
            url: '/site/sign-up',
            dataType: 'json',
            data:  $('#sign-up-form').serialize(),
            success: function (data) {
                if (data.success) {
                    $('#sign-up-errors').html(data.message).hide();
                    $('#sign-up-success').html(data.message).show();

                    $('#sign-up-form')[0].reset();
                } else {
                    $('#sign-up-errors').html(data.message).show();
                    $('#sign-up-success').html(data.message).hide();
                }

                $('#sign-in-errors').html('').hide();
                $('#sign-in-form')[0].reset();
            }
        })
    })
})