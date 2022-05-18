@section('styles')
    <link rel="stylesheet"
        href="/{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css">
@endsection
@section('scripts')
    <script
        src="/{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js">
    </script>
    <script src="/{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/datatable/custom-datatable.js"></script>
    <script src="/{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/dist/js/pages/datatable/datatable-basic.init.js">
    </script>
@endsection
