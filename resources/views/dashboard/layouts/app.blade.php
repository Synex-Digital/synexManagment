
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Synex Management</title>

    @yield('style')
    @include('dashboard.layouts.headerLink')
    @yield('summernote-style')
    <style>
        .quixnav{
            background-color: #fff!important;
            /* transition: .5s all ease; */
        }
        #menu .mm-active{
            background-color: #3b82f6!important;
        }
        #menu .mm-active .nav-text,#menu .mm-active .svg-color{
            color: #fff!important;
            fill : #fff!important;
        }
        .quixnav ul li a:hover {
            background-color: #3b82f6!important;
            /* transition: .5s; */
        }
        .quixnav ul li:hover .nav-text,.quixnav ul li:hover .svg-color{
            color: #fff!important;
            fill: #fff;
        }
        .quixnav .metismenu > li:hover > a, .quixnav .metismenu > li:focus > a, .quixnav .metismenu > li.mm-active > a {
            background-color: #3b82f6!important;
        }
        .quixnav .mm-active .mm-show{
            background-color: #fff!important;
        }
        .hamburger .line{
            background-color: #3b82f6!important;
        }
        .ps__thumb-y {
            background-color: transparent;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">



        @include('dashboard.layouts.navHeader')



        @include('dashboard.layouts.sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                    @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
              {{-- Modals Delete--}}
                <div class="modal fade" id="deleteModal">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-danger">WARNING !</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-dark"> Are you sure you want to delete it?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                <form id="deleteModalForm" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">YES</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- Modals end --}}

            @include('dashboard.layouts.footer')
        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    @yield('summernote')
    @include('dashboard.layouts.scripts')
    @yield('script')
    <script>
        $(document).ready(function() {

            $('form').on('submit', function(e) {
                // Disable the submit button if it matches the desired classes
                $(this).find('button.btn-outline-primary').prop('disabled', true);
                $(this).find('button.btn-outline-danger').prop('disabled', true);
            });
        });
    </script>
</body>

</html>
