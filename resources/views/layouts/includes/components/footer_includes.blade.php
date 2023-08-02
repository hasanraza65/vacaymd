    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/src/plugins/src/global/vendors.min.js"></script>
    <script src="/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="/src/plugins/src/waves/waves.min.js"></script>
    <script src="/layouts/modern-light-menu/app.js"></script>
    <script src="/src/assets/js/custom.js"></script>

    <script src="/src/assets/js/apps/invoice-preview.js"></script>
    <script src="/src/plugins/src/highlight/highlight.pack.js"></script>
    <script src="/src/assets/js/scrollspyNav.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--- notifications ---> 

    <script src="/src/plugins/src/notification/snackbar/snackbar.min.js"></script>
    
    <!--- ending notifications --->

    <!---sweet alerts ---> 
    <script src="/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
    <script src="/src/plugins/src/sweetalerts2/custom-sweetalert.js"></script>
    <!--- Ending sweet alerts --->

    @if (request()->is('admin'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="/src/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @endif

    @if (request()->is('patient'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="/src/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @endif

    @if (request()->is('doctor'))
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/src/plugins/src/apex/apexcharts.min.js"></script>
    <script src="/src/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @endif


    @if (request()->is('admin/users') || request()->is('admin/transactions') || Request::is('admin/users/*') )

    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>

    @endif

    @if (request()->is('patient/orders') || request()->is('patient/transactions') || Request::is('patient/orders/*') )

    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>

    @endif

    @if (request()->is('patient/orders/create') || Request::is('patient/orders/create/*') )
    <script src="/src/plugins/src/stepper/bsStepper.min.js"></script>
    <script src="/src/plugins/src/stepper/custom-bsStepper.min.js"></script>
    @endif

    @if (request()->is('admin/orders') || Request::is('admin/orders/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('admin/patients') || Request::is('admin/patients/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('admin/doctors') || Request::is('admin/doctors/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('admin/pharmacies') || Request::is('admin/pharmacies/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('doctor/orders') || Request::is('doctor/orders/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    <script src="/src/assets/js/customImage.js"></script>
    @endif

    @if (request()->is('pharmacy/orders') || Request::is('pharmacy/orders/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('admin/prescriptions') || Request::is('admin/prescriptions/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('patient/profile') || request()->is('doctor/profile') || request()->is('admin/profile') || request()->is('pharmacy/profile'))
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="/src/plugins/src/filepond/filepond.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginImagePreview.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginImageCrop.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginImageResize.min.js"></script>
    <script src="/src/plugins/src/filepond/FilePondPluginImageTransform.min.js"></script>
    <script src="/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js"></script>
    <script src="/src/plugins/src/notification/snackbar/snackbar.min.js"></script>
    <script src="/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
    <script src="/src/assets/js/users/account-settings.js"></script>
    <script src="/src/assets/js/customImage.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
    @endif

    @if (request()->is('admin/upsaleitems') || Request::is('admin/upsaleitems/*'))
    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
    @endif

    @if (request()->is('admin/state') || Request::is('admin/state/*') )

    <script src="/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>

    @endif