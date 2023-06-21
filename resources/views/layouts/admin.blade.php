<!DOCTYPE html>
<html lang="en">
@include('Includes.Admin.head')

    <body>

        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="circle1"></div>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                </div>
            </div>
        </div>
        <!-- End Preloader-->

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
            @include('Includes.Admin.header')

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                @include('Includes.Admin.sidebar')
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')

                    </div>
                </div> <!-- content -->



                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                2020 &copy; Gurufit. All Rights Reserved.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{URL::to('storage/app/public/Adminassets/js/vendor.min.js')}}"></script>

        <!-- optional plugins -->
        <script src="{{URL::to('storage/app/public/Adminassets/libs/moment/moment.min.js')}}"></script>
        <script src="{{URL::to('storage/app/public/Adminassets/libs/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{URL::to('storage/app/public/Adminassets/libs/flatpickr/flatpickr.min.js')}}"></script>
        @yield('plugin')
        <!-- page js -->
        <script src="{{URL::to('storage/app/public/Adminassets/js/pages/dashboard.init.js')}}"></script>
        @yield('js')
        <!-- App js -->
        <script src="{{URL::to('storage/app/public/Adminassets/js/app.min.js')}}"></script>



    </body>

</html>
