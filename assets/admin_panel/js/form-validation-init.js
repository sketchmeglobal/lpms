/**
 * Created by mosaddek on 3/8/15.
 */

var Script = function () {

    // $.validator.setDefaults({
    //     submitHandler: function() { alert("submitted!"); }
    // });

    $().ready(function() {

        // replacing default email format for validation (e.g. pro@me.in [3@2.2])
        $.validator.methods.email = function( value, element ) {
            return this.optional( element ) || /[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{2,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})+/.test( value );
        }
        // username validation (only characters, numbers, dash & underscore)
        jQuery.validator.addMethod("username", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9_-]*$/.test(value);
        }, "Only characters [a-z, A-Z], numbers [0-9], dash [-] & underscore [_] are allowed");
        // only characters validation
        jQuery.validator.addMethod("char", function(value, element) {
            return this.optional(element) || /^[a-zA-Z]*$/.test(value);
        }, "Only characters [a-z, A-Z] are allowed");
        // firstname validation
        jQuery.validator.addMethod("firstname", function(value, element) {
            return this.optional(element) || /^[a-zA-Z .]*$/.test(value);
        }, "Only characters [a-z, A-Z], period (.) & space ( ) are allowed");



        // validate user basic profile information form on keyup and submit
        $("#basic_info_form").validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,
                    firstname: true
                },
                lastname: {
                    required: true,
                    minlength: 2,
                    maxlength: 15,
                    char: true
                },
                phone: {
                    minlength: 10,
                    maxlength: 20
                },
            },
            messages: {
                firstname: {
                    required: "Please enter your firstname",
                    minlength: "Your firstname must be at least 2 characters long",
                    maxlength: "Firstname should not be longer than 30 characters"
                },
                lastname: {
                    required: "Please enter your lastname",
                    minlength: "Your lastname must be at least 2 characters long",
                    maxlength: "Lastname should not be longer than 15 characters"
                },
                phone: {
                    minlength: "Phone number must be 10 digits long",
                    maxlength: "Phone number should not be longer than 20 digits"
                },
            }
        });

        // validate change password form on keyup and submit
        $("#change_pass_form").validate({
            rules: {
                current_pass: {
                    required: true,
                },
                new_pass: {
                    required: true,
                    minlength: 8,
                    maxlength: 255,
                },
                confirm_pass: {
                    required: true,
                    equalTo: "#new_pass",
                }
            },
            messages: {
                current_pass: {
                    required: "Please enter your current password",
                },
                new_pass: {
                    required: "Please enter a new password",
                    minlength: "Your new password must be at least 8 characters long",
                    maxlength: "Your new password should not be longer than 255 characters"
                },
                confirm_pass: {
                    required: "Please enter the new password again",
                    equalTo: "Please enter the same password as above",
                }
            }
        });

        // validate change email form on keyup and submit
        $("#change_email_form").validate({
            rules: {
                new_email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                new_email: {
                    required: "Please enter a email address",
                    email: "Please provide a valid email address"
                },
            }
        });

        // validate change username form on keyup and submit
        $("#change_username_form").validate({
            rules: {
                new_username: {
                    required: true,
                    minlength: 5,
                    maxlength: 20,
                    username: true,
                    remote: base_url+"admin/ajax_username_check"
                },
            },
            messages: {
                new_username: {
                    required: "Please enter your desired username",
                    minlength: "Username must be at least 5 characters long",
                    maxlength: "Username should not be longer than 20 characters",
                },
            }
        });

    });

}();
