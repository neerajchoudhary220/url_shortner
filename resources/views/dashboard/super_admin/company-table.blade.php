<div class="col-12 px-4">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-around">


            <h5 class="m-auto">Company List</h5>
            <div>
                {{-- <a href=""><button class="btn btn-primary">Add New Company</button></a> --}}
            </div>
        </div>

        <div class="card-body mt-3">
            <table class="table table-striped table-hover w-100 " id="company_list_tbl">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Name</th>
                        <th>Users</th>
                        <th>Total Generated URL's</th>
                        <th>Total URL Hits</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('custom-js')
    <script src="{{ asset('assets/js/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        const company_list_url = "{{ route('dashboard.company.list') }}";
    </script>
    <script src='{{ asset('assets/js/company/compnay-dt.js') }}'></script>
@endpush
