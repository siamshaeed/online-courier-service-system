$(document).ready(function() {
 
    //uses admin-dashboard for hide and show items
    $('.navbar-toggle').on('click', function(){
        $('#mobile-nav').slideToggle(300);
    });

    $(".hdr-adm-lft").click(function(){
        $("ul.hide-div").toggleClass("main");
    });

        $(".company-profile-nav li").click(function(){
        $(".company-profile-nav li").removeClass('selected');
            $(this).addClass('selected');

        })

/*$(document).ready(function() { 
  $(".company-profile-nav li").click(function ( e ) {
e.preventDefault();
$("company-profile-nav .active").removeClass("active"); //Remove any "active" class  
$(this).addClass("active"); //Add "active" class to selected tab  

// $(activeTab).show(); //Fade in the active content  
});
});*/
/*      $(document).ready(function() {
         $(".company-profile-nav li").on('click',function(e){
            $('.company-profile-nav li .active').toggle();
            return false;
         });
      });*/

/*$(document).ready(function() { 
    $(".company-profile-nav li").click(function ( e ) {
        e.preventDefault();
        $(".company-profile-nav li a .active").removeClass("active"); //Remove any "active" class  
        $(this).addClass("active"); //Add "active" class to selected tab  
        $(activeTab).show(); //Fade in the active content  
    });
});*/
//------------------------------------------


    $('#stackedForm').formValidation({
        framework: 'semantic',
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon',
            feedback: 'fv-control-feedback'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The username must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.@]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            fname: {
                message: 'The fname is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The first name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The first name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            lname: {
                message: 'The fname is not valid',
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The last name must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The last name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },                         
            user_email: {
                validators: {
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            address: {
                message: 'The address is not valid',
                validators: {
                    notEmpty: {
                        message: 'The address is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 1000,
                        message: 'The address must be more than 1 and less than 1000 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z-0-9_\.,:/ ]+$/,
                        message: 'The address can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },                        
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            agree: {
                validators: {
                    notEmpty: {
                        message: 'You must agree with the terms and conditions'
                    }
                }
            }
        }
    });

    // Use checkbox element
    // http://semantic-ui.com/modules/checkbox.html
    $('.ui.checkbox').checkbox();

var date_input=$('input[name="date"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
date_input.datepicker({
    format: 'mm/dd/yyyy',
    container: container,
    todayHighlight: true,
    autoclose: true,
})

});