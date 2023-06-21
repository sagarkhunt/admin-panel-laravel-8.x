<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="utf-8" />
        <title>Login - Gurufit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Gurufit" name="description" />
        <meta content="Gurufit" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{URL::to('storage/app/public/Adminassets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{URL::to('storage/app/public/Adminassets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::to('storage/app/public/Adminassets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::to('storage/app/public/Adminassets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container" id="kt_login">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-6 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="index.html">
                                                <img src="{{URL::to('storage/app/public/Adminassets/images/logo.png')}}" alt="" height="24" />
                                                <h3 class="d-inline align-middle ml-1 text-logo">Crypto</h3>
                                            </a>
                                        </div>

                                        <h6 class="h5 mb-0 mt-4">Welcome back!</h6>
                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to
                                            access admin panel.</p>

                                        <!-- <form action="#" class="authentication-form"> -->
                                            {{ Form::open(['class' => 'authentication-form','url' => URL::to('register'), 'method' => 'POST']) }}
                                                @csrf
                                            <div class="form-group">
                                                <label class="form-control-label">Email Address</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="mail"></i>
                                                        </span>
                                                    </div>                                                    
                                                    {{ Form::email('email','',['class'=>'form-control','id'=>'emailAddress','parsley-type'=>'email','autocomplete'=>'off','placeholder'=> "hello@coderthemes.com"]) }}
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <label class="form-control-label">Password</label>
                                                <!-- <a href="#" class="float-right text-muted text-unline-dashed ml-1">Forgot your password?</a> -->
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>                                                    
                                                    {{ Form::password('password', ['class' => 'form-control','id'=>'hori-pass1','placeholder' => 'Enter your password' ]) }}                                                    
                                                </div>
                                            </div>

                                            <!-- <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="checkbox-signin" checked>
                                                    <label class="custom-control-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div> -->

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" id = "kt_login_signin_submit"> Log In
                                                </button>
                                            </div>
                                            {{Form::close()}}
                                        <!-- </form> -->
                                        <div class="py-3 text-center"><span class="font-size-16 font-weight-bold">Or</span></div>
                                       <!--  <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-white"><i class='uil uil-google icon-google mr-2'></i>With Google</a>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="#" class="btn btn-white"><i class='uil uil-facebook mr-2 icon-fb'></i>With Facebook</a>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar">
                                            <div class="overlay"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="font-size-24 font-weight-bold text-white mb-1">I simply love it!</p>
                                                <p class="lead">"It's a elegent templete. I love it very much!"</p>
                                                <p>- Admin User</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <!-- Vendor js -->
        <script src="{{URL::to('storage/app/public/Adminassets/js/vendor.min.js')}}"></script>

        <!-- Plugin js-->
        <script src="{{URL::to('storage/app/public/Adminassets/libs/parsleyjs/parsley.min.js')}}"></script>

        <!-- Validation init js-->
        <script src="{{URL::to('storage/app/public/Adminassets/js/pages/form-validation.init.js')}}"></script>

        <script src="{{URL::to('storage/app/public/Adminassets/js/pages/jquery.validate.min.js')}}"></script>
        <!-- App js -->
        <script src="{{URL::to('storage/app/public/Adminassets/js/app.min.js')}}"></script>

        <script  type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script type="text/javascript">
            "use strict";

                // Class Definition
                var KTLoginGeneral = function() {

                    var login = $('#kt_login');

                    var showMsg = function(form, type, msg) {
                        var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
                            <div class="alert-text">'+msg+'</div>\
                            <div class="alert-close">\
                                <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
                            </div>\
                        </div>');

                        form.find('.alert').remove();
                        alert.prependTo(form);
                        //alert.animateClass('fadeIn animated');
                        // KTUtil.animateClass(alert[0], 'fadeIn animated');
                        alert.find('span').html(msg);
                    }

                    var handleSignInFormSubmit = function() {
                        $('#kt_login_signin_submit').click(function(e) {
                            e.preventDefault();
                            var btn = $(this);
                            var form = $(this).closest('form');  
                            console.log(form);                          
                            form.validate({
                                rules: {
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    password: {
                                        required: true
                                    }
                                }
                            });

                            if (!form.valid()) {                                
                                return;
                            }

                            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

                            $.ajax({
                                url: "{{ URL::to('admin/login') }}",
                                type: 'post',
                                dataType: 'json',
                                data: form.serialize(),
                            }).done(function(response) {                                
                                if(typeof response!="undefined"){
                                    if(response.status)
                                    {                                        
                                        showMsg(form, 'success', 'Login successfully.');
                                        window.location.href="{{url('admin/dashboard')}}";                          
                                    }
                                    else
                                    {                                        
                                        showMsg(form, 'danger', 'Incorrect email or password. Please try again.');
                                    }
                                }
                            })
                            .fail(function() {                                
                                showMsg(form, 'danger', 'Incorrect email or password. Please try again.');
                            })
                            .always(function() {
                                setTimeout(function() {
                                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                                }, 1000);
                            });
                        });
                    }

                    // Public Functions
                    return {
                        // public functions
                        init: function() {
                            handleSignInFormSubmit();
                        }
                    };
                }();

                // Class Initialization
                jQuery(document).ready(function() {
                    KTLoginGeneral.init();
                });
        </script>   
        
    </body>
</html>
