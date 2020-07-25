function myFunctionFORM() {
        /* validation */
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters and spaces only please");
        jQuery.validator.addMethod("correctemail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Must correct email");
        $("#form-signin").validate({
            rules: {
                quest_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                quest_id: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                quest_phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 15,
                    number: true
                },
                quest_email: {
                    required: true,
                    correctemail: true,
                    email: true
                },
               quest_type: {
                    required: true,
                   
                },
                quest_validation: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
                 quest_temp: {
                    required: true,
                    minlength: 2,
                    number: true,
                    maxlength: 5,
                    min: 35.00,
                    max: 37.90
                },
            },
            messages: {
                quest_name: {
                    required: "Please enter name",
                    minlength: "Minimum 3 characters",
                    maxlength: "Maximum 30 characters"
                },
                quest_id: {
                    required: "Please enter Id Card",
                    minlength: "Minimum 3 characters",
                    maxlength: "Maximum 100 characters"
                },
                quest_phone: {
                    required: "Please enter phone",
                    minlength: "Minimum 10 characters",
                    maxlength: "Maximum 15 characters"
                },
                quest_email: "Please enter a valid email address",
                quest_type: {
                    required: "Please select type"
                },
                quest_validation: {
                    required: "Please enter Validation Code",
                    minlength: "Minimum 6 characters",
                    maxlength: "Maximum 6 characters"
                },
                quest_temp: {
                    required: "Please enter Temp",
                    number: "Please enter mumeric",
                    minlength: "Minimum 2 characters",
                    maxlength: "Maximum 4 characters",
                    min: "minimum temp 35.00",
                    max: "maximum temp 37.9"
                },
            },
            
            submitHandler: submitCheckinForm
        });
        /* validation */
    }
    /* form submit */
function submitCheckinForm() {
    
    var data = $("#form-signin").serialize();
      var urls = 'https://localhost/vaniaqr/checkin/doCheckin';
    $.ajax({
        type: 'POST',
        url: urls,
        data: data,
        beforeSend: function() {
            var btnSend = '<span class="input-group-append">' +
                '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            $("#btn-submit").html(btnSend);
        },
        success: function(result) {
           
           alert(result);
            $("#btn-submit").html("Checkin");
            if (result == 1) {
                 $("#form-signin")[0].reset();
                $('#quest_name').val('');
                $('#quest_id').val('');
                $('#quest_email').val('');
                $('#quest_phone').val('');
                location.reload();
            } else if (result == 2) {
                 $("#form-signin")[0].reset();
                alert('You still checkin.');
                //$('#captcha_error').html('Robot verification failed, please try again.');
                location.reload();
            } else if (result == 3) {
                 $("#form-signin")[0].reset();
               // alert('Please click on the reCAPTCHA box.');
                location.reload();
                //$('#captcha_error').html('Please click on the reCAPTCHA box.');
            } 
            else if (result == 4) {
                //alert('Please check your map');
                $('#captcha_error').html('Cannot find showroom');
                getRecaptcha();
            } 
            else if (result == 5) {
                
               $('#captcha_error').html('Robot verification failed, please try again.');
               getRecaptcha();
            } 
             else if (result == 6) {
                   getRecaptcha();
                 alert('Robot verification failed, please try again.');
                $('#captcha_error').html('Robot verification failed, please try again.');
            } 
            else {
                getRecaptcha();
                // $('#form-contact').hide();
                alert('Robot verification failed, please try again.');
                $('#captcha_error').html('Robot verification failed, please try again.');
            }
            //console.log(data);
        }
    });
    return false;
}

