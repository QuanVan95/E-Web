$('.login-form').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        },
        remember: {
            required: false
        }
    },

    messages: {
        email: {
            required: "Email is required.",
            email: "Email is invalid."
        },
        password: {
            required: "Password is required."
        }
    },
    highlight: function(element) { // hightlight error inputs
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    submitHandler: function(form) {
        form.submit(); // form validation success, call ajax form submit
    }
});

$('.login-form input').keypress(function(e) {
    if (e.which == 13) {
        if ($('.login-form').validate().form()) {
            $('.login-form').submit(); //form validation success, call ajax form submit
        }
        return false;
    }
});
$('.register').validate({
    errorElement: 'span', //default input error message container
    errorClass: 'help-block', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        },
        password_confirmation: {
            required: true,
            equalTo: '#register_password'
        },
    },

    messages: {
        name: {
            required: "Name is required."
        },
        email: {
            required: "Email is required.",
            email: "Email is invalid."
        },
        password: {
            required: "Password is required."
        },
        password_confirmation: {
            required: "Password confirmed is required.",
            equalTo: "Password confirmation does not match."
        }
    },
    highlight: function(element) { // hightlight error inputs
        $(element)
            .closest('.form-group').addClass('has-error'); // set error class to the control group
    },

    submitHandler: function(form) {
        form.submit(); // form validation success, call ajax form submit
    }
});