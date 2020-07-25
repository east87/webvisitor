function myFunctionFORM() {
        /* validation */
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters and spaces only please");
        jQuery.validator.addMethod("correctemail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Must correct email");
        $("#form-contact").validate({
            rules: {
                contact_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                contact_subject: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                contact_email: {
                    required: true,
                    correctemail: true,
                    email: true
                },
                contact_message: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                contact_name: {
                    required: "Please enter name",
                    minlength: "Minimum 3 characters",
                    maxlength: "Maximum 30 characters"
                },
                contact_subject: {
                    required: "Please enter subject",
                    minlength: "Minimum 3 characters",
                    maxlength: "Maximum 100 characters"
                },
                contact_email: "Please enter a valid email address",
                contact_message: {
                    required: "Please enter message",
                    minlength: "Minimum 5 characters"
                }
            },
            submitHandler: submitContactForm
        });
        /* validation */
    }
    /* form submit */
function submitContactForm() {
    var data = $("#form-contact").serialize();
    $.ajax({
        type: 'POST',
        url: document.location.origin + '/contact/postMsg',
        data: data,
        beforeSend: function() {
            var btnSend = '<span class="input-group-append">' +
                '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            $("#btn-submit").html(btnSend);
        },
        success: function(result) {
            $('#ModalContact').modal('show');
            $("#btn-submit").html("&nbsp;SUBMIT");
            if (result == "success") {
                $('#contact_name').val('');
                $('#contact_subject').val('');
                $('#contact_email').val('');
                $('#contact_message').val('');
            } else if (result == "robot_fail") {
                alert('Robot verification failed, please try again.');
                $('#captcha_error').html('Robot verification failed, please try again.');
                location.reload();
            } else if (result == "check_captcha") {
                alert('Please click on the reCAPTCHA box.');
                $('#captcha_error').html('Please click on the reCAPTCHA box.');
            } else {
                $('#contact_name').val('');
                $('#contact_email').val('');
                $('#contact_lastname').val('');
                $('#contact_message').val('');
                // $('#form-contact').hide();
                alert('Robot verification failed, please try again.');
                $('#captcha_error').html('Robot verification failed, please try again.');
                // window.open("https://localhost/panom/contact/thankyou","_self");
            }
            //console.log(data);
        }
    });
    return false;
}

function myFunctionSUBS() {
        /* validation */
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters and spaces only please");
        jQuery.validator.addMethod("correctemail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Must correct email");
        $("#form-newsletter").validate({
            rules: {
                subs_email: {
                    required: true,
                    correctemail: true,
                    email: true
                }
            },
            messages: {
                subs_email: "Please enter a valid email address"
            },
            submitHandler: submitSubs
        });
        /* validation */
    }
    /* form submit */
function submitSubs() {
    var data = $("#form-newsletter").serialize();
    var btnSend = '<span class="input-group-append">' +
                '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
    var btnStle = '<span class="input-group-append">' +
                '<i class="fa fa-newspaper-o" aria-hidden="true"></i>';
    $.ajax({
        type: 'POST',
        url: document.location.origin + '/contact/subscribe',
        data: data,
        beforeSend: function() {
           
            $("#btn-subs").html(btnSend);
        },
        success: function(resultsubs) {
            if (resultsubs == 1) {
                $('#ModalSubs').modal('show');
                $("#btn-subs").html(btnStle);
                $('#subs_email').val('');
                $('#notife_subs').text('Success Subscribe:');
                $('#popUpModalOn').modal('show');
            } else {
                $("#btn-subs").html("&nbsp;Subscribe");
                $('#subs_email').val('');
                $('#notife_subs').text('Error Subscribe:');
                // window.open("https://localhost/panom/contact/subscribe","_self");
            }
            //console.log(data);
        }
    });
    return false;
}

function myFunctionSUBSF() {
        
        /* validation */
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters and spaces only please");
        jQuery.validator.addMethod("correctemail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Must correct email");
        $("#form-newsletterf").validate({
            rules: {
                subs_emailf: {
                    required: true,
                    correctemail: true,
                    email: true
                }
            },
            messages: {
                subs_emailf: "Please enter a valid email address"
            },
            submitHandler: submitSubsF
        });
        /* validation */
    }
    /* form submit */
function submitSubsF() {
    var data = $("#subs_emailf").val();
    var btnSend = '<span class="input-group-append">' +
                '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
    var btnStle = '<span class="input-group-append">' +
                '<i class="fa fa-newspaper-o" aria-hidden="true"></i>';
    alert(data);
    $.ajax({
        type: 'POST',
        url:'https://localhost/vaniac/contact/subscribe',
        data: {
            subs_email: data
        },
        beforeSend: function() {
            
            $("#btn-subsf").html(btnSend);
           
        },
        success: function(resultsubs) {
          alert(resultsubs);
            
            if ( resultsubs == 1) {
                    alert(resultsubs);
                $('#ModalSubs').modal('show');
                $("#btn-subsf").html(btnStle);
                $('#subs_emailf').val('');
                 $('#subsf_already').hide();
            } else {
                 
                $("#btn-subsf").html(btnStle);
                $('#subs_email').val('');
                $('#subsf_already').show();
                $('#subsf_already').text('Your emali already subscribe');
                // window.open("https://localhost/panom/contact/subscribe","_self");
            }
            //console.log(data);
        }
    });
    return false;
}

function myFunctionCata() {
    /* validation */
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Letters and spaces only please");
    jQuery.validator.addMethod("correctemail", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, "Must correct email");
    $("#form-catalogue").validate({
        rules: {
            catalogue_name: {
                required: true,
                minlength: 3,
                maxlength: 100,
                lettersonly: true
            },
            catalogue_phone: {
                minlength: 10,
                maxlength: 15,
                number: true
            },
            catalogue_email: {
                required: true,
                correctemail: true,
                email: true
            }
        },
        messages: {
            catalogue_name: {
                required: "Please enter name",
                minlength: "Minimum 3 characters",
                maxlength: "Maximum 30 characters"
            },
            catalogue_phone: {
                minlength: "Minimum 10 characters",
                maxlength: "Maximum 15 characters"
            },
            catalogue_email: "Please enter a valid email address"
        },
        submitHandler: submitCat
    });
    /* validation */
}

function submitCat() {
        var catalogue_name = $("#catalogue_name").val();
        var catalogue_phone = $("#catalogue_phone").val();
        var catalogue_email = $("#catalogue_email").val();
        var category = $("#category_web").val();
        alert(catalogue_name);
        $.ajax({
            type: 'POST',
            url: 'https://localhost/vaniac/contact/cataloque',
            data: {
                catalogue_name: catalogue_name,
                catalogue_phone: catalogue_phone,
                catalogue_email: catalogue_email,
                category: category
            },
            beforeSend: function() {
                $("#formCatalogueSubmit").html("&nbsp; sending ...");
            },
            success: function(resultc) {
                alert(resultc);
                $("#formCatalogueSubmit").html("&nbsp;sending");
                if (resultc == "success") {
                    $('#ModalCatalog').modal('show');
                    $('#catalogue_name').val('');
                    $('#catalogue_phone').val('');
                    $('#catalogue_email').val('');
                    alert(resultc);
                } else {
                    $('#catalogue_name').val('');
                    $('#catalogue_phone').val('');
                    $('#catalogue_email').val('');
                    $('#catalogue_email').val('');
                    return false;
                }
                //console.log(data);
            }
        });
        return false;
    }
    /* form submit */