    
    <title>@yield('title') </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/src/customjs.js"></script>
    <link href="/src/custom.css" rel="stylesheet" type="text/css" />

    <link rel="icon" type="image/x-icon" href="/src/assets/img/favicon.ico"/>
    <link href="/layouts/modern-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/modern-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/layouts/modern-light-menu/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="/src/bootstrap/js/bootstrap.min.js"></script>

    <link href="/layouts/modern-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/modern-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--- Notifications ---> 

    <link href="/src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />

    <!--- ending notifications --->

    <!---sweet alerts ---> 
    <link rel="stylesheet" href="/src/plugins/src/sweetalerts2/sweetalerts2.css">
    <link href="/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!--- Ending sweet alerts --->

    <link rel="stylesheet" href="/src/plugins/src/font-icons/fontawesome/css/regular.css">
    <link rel="stylesheet" href="/src/plugins/src/font-icons/fontawesome/css/fontawesome.css">

    <!--- datatable --->
    <link rel="stylesheet" type="text/css" href="/src/plugins/src/table/datatable/datatables.css">

    <link rel="stylesheet" type="text/css" href="/src/plugins/css/light/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/css/light/table/datatable/custom_dt_custom.css">

    <link rel="stylesheet" type="text/css" href="/src/plugins/css/dark/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/css/dark/table/datatable/custom_dt_custom.css">
        <!--- datatable ending  --->
<!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="/src/assets/css/light/apps/invoice-preview.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/apps/invoice-preview.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    @if (request()->is('admin'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endif

    @if (request()->is('admin/users') || Request::is('admin/users/*') )
   
    @endif

    @if (request()->is('admin/users/create') || Request::is('admin/users/create/*') )
    
    @endif

    @if (request()->is('patient/orders/create') || Request::is('patient/orders/create/*') )

    <link rel="stylesheet" type="text/css" href="/src/plugins/src/stepper/bsStepper.min.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/css/light/stepper/custom-bsStepper.css">
    <link rel="stylesheet" type="text/css" href="/src/plugins/css/dark/stepper/custom-bsStepper.css">
    
    @endif

    @if (request()->is('patient'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endif

    @if (request()->is('doctor'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endif

    @if (request()->is('admin/orders') || Request::is('admin/orders/*'))
    <link href="/src/assets/css/light/components/media_object.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/media_object.css" rel="stylesheet" type="text/css" />
    @endif

    @if (request()->is('patient/orders') || Request::is('patient/orders/*'))
    <link href="/src/assets/css/light/components/media_object.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/media_object.css" rel="stylesheet" type="text/css" />
    @endif

    @if (request()->is('doctor/orders') || Request::is('doctor/orders/*'))
    <link href="/src/assets/css/light/components/media_object.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/media_object.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/accordions.css" rel="stylesheet" type="text/css" />

    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/accordions.css" rel="stylesheet" type="text/css" />
    @endif

    @if (request()->is('doctor/orders') || Request::is('doctor/orders/*'))

    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
    
    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/dark/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/src/plugins/src/filepond/filepond.min.css">
    <link rel="stylesheet" href="/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">    
    <link href="/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/customImage.css" rel="stylesheet" type="text/css" />

    @endif

    @if (request()->is('pharmacy/orders') || Request::is('pharmacy/orders/*'))

    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
    
    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/dark/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/src/plugins/src/filepond/filepond.min.css">
    <link rel="stylesheet" href="/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">    
    <link href="/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />

    @endif

    @if (request()->is('pharmacy'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endif


    @if (request()->is('patient/profile') || request()->is('doctor/profile') || request()->is('admin/profile') || request()->is('pharmacy/profile'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="/src/plugins/src/filepond/filepond.min.css">
    <link rel="stylesheet" href="/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">
    <link href="/src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/src/plugins/src/sweetalerts2/sweetalerts2.css">
    
    <link href="/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/src/assets/css/light/elements/alert.css">
    
    <link href="/src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/src/assets/css/light/forms/switches.css">
    <link href="/src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">

    <link href="/src/assets/css/light/users/account-setting.css" rel="stylesheet" type="text/css" />



    <link href="/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/src/assets/css/dark/elements/alert.css">
    
    <link href="/src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/src/assets/css/dark/forms/switches.css">
    <link href="/src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">

    <link href="/src/assets/css/dark/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/customImage.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endif


    @if (request()->is('patient/orders') || Request::is('patient/orders/*'))

    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css">
    
    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/carousel.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/dark/components/modal.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/src/plugins/src/filepond/filepond.min.css">
    <link rel="stylesheet" href="/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">    
    <link href="/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <link href="/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    

    @endif
    


    