<div class="card mt-3">
    <div class="card-header d-flex justify-content-around">


        <h5 class="m-auto">Generated Short URLs</h5>
        <div>
        <a href="{{ route('shortUrl.generate') }}"><button class="btn btn-primary">Generate</button></a>
        </div>
    </div>

    <div class="card-body mt-3">
        <table class="table table-striped table-hover w-100 " id="admin_short_url_list">
            <thead>
                <tr class="text-nowrap">
                    <th>Short URL</th>
                    <th>Long URL</th>
                    <th>Hits</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('custom-js')
    <script src="{{ asset('assets/js/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
       const  short_url_list = "{{ route('shortUrl.list') }}"
    </script>
    <script src='{{ asset('assets/js/short-url-dt.js') }}'></script>
@endpush
