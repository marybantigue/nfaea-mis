<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NFAEA</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir("css/app.css") }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: "Lato";
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>


    
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" style="color:white" href="{{ url("/") }}">
                    NFAEA - MIS
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                <ul class="nav navbar-nav">
                    <li><a href="{{ url("/home") }}">Home</a></li>

                    <li><a href="{{ url("/invoices") }}">SOA<span class="sr-only">(current)</span></a></li>
                    <li><a href="{{ url("/provinces") }}">Provinces</a></li>


                    <li><a href="{{ url("/members") }}">Members</a></li>
                </ul>
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url("/login") }}">Login</a></li>
                        <li><a href="{{ url("/register") }}">Register</a></li>
                    @else
                        <li><a  style="color:white">
                            @if ( Auth::user()->isMain()) 
                                Central
                            @else
                                {{ Auth::user()->province()->first()->name }}
                            @endif
                            </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url("/logout") }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield("content")

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    {{-- <script src="{{ elixir("js/app.js") }}"></script> --}}
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
