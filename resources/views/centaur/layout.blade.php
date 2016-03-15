<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('title')</title>

        <!-- Bootstrap - Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet">
    

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">NFAEA - MIS</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                         @if (Sentinel::check() && Sentinel::inRole('provincial'))
                        <li class="{{ Request::is('invoices*') ? 'active' : '' }}"><a href="{{ url("/invoices") }}">Invoices</a></li>
                        @endif
                         @if (Sentinel::check() && Sentinel::inRole('main'))
                        <li class="{{ Request::is('/provinces') ? 'active' : '' }}"><a href="{{ url("/provinces") }}">Provinces</a></li>


                        <li class="{{ Request::is('/members') ? 'active' : '' }}"><a href="{{ url("/members") }}">Members</a></li>
                        @endif

                        @if (Sentinel::check() && Sentinel::inRole('administrator'))
                            <li class="{{ Request::is('users*') ? 'active' : '' }}"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="{{ Request::is('roles*') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Roles</a></li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Sentinel::check())
                             @if (Sentinel::inRole('provincial'))   
                            <li><p class="navbar-text">
                                {!! Helpers::getProvince(Sentinel::getUser()->id) !!}
                            </p></li>
                            @endif

                            <li><p class="navbar-text">{{ Sentinel::getUser()->email }}</p></li>
                            <li><a href="{{ route('auth.logout') }}">Log Out</a></li>
                        @else
                            <li><a href="{{ route('auth.login.form') }}">Login</a></li>
                            <li><a href="{{ route('auth.register.form') }}">Register</a></li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            @include('Centaur::notifications')
            @yield('content')
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
        <script src="{{ asset('restfulizer.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
        
        <script>

        $(document).ready(function(){


            $(".member_select").select2({
              placeholder: "Select a member",
              allowClear: true
            });
            
            var memberIndex = 0;
            
            var wrapper         = $(".help-members-container"); //Fields wrapper
            var add_button      = $(".add_member_button"); //Add button ID
            var source = $(".myForm");
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
              
                e.preventDefault();
                x++; //text box increment
                memberIndex++;
                $(".member_select").select2('destroy');

                var name = 'helpmember[' + memberIndex + '][member_id]';
                var name2 = 'helpmember[' + memberIndex + '][amount]';
                var cloned = $(".help-members-container")
                        .children(".help-members-row")
                        .first()
                        .clone();
                cloned.find('select').attr('name', name);
                cloned.find('select').attr('value', null);
                cloned.find('input').attr('name', name2);               
                cloned.find('input').val('');

                cloned.append('<div class="col-xs-1"><a href="#" class="btn btn-danger remove_field">-</a></div>');
                
                $(".help-members-container").append( cloned);
                // enable Select2 on the select elements
                $(".member_select").select2({
                      placeholder: "Select a member",
                      allowClear: true
                });
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
            });


            $('#account_type').on('change', function() {
              if( this.value == "HELP" ){
                $("#help-options").show();
              }else{
                $("#help-options").hide();
              }; // or $(this).val()
            });

        });
        


    </script>
    </body>
</html>