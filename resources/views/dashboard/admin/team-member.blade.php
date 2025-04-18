    <div class="card mt-3">
        <div class="card-header d-flex justify-content-around">


            <h5 class="m-auto">Team Members</h5>
            <div>
                <a href="{{ route('invite') }}" class="btn btn-primary invite-btn">Invite</a>
            </div>
        </div>

        <div class="card-body mt-3">
            <table class="table table-striped table-hover w-100 " id="admin_team_members_list">
                <thead>
                    <tr class="text-nowrap">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Total Generated URl's</th>
                        <th>Total URL Hits</th>
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
        const team_member_url = "{{ route('dashboard.team.member.list') }}"
    </script>
    <script src='{{ asset('assets/js/team-member-dt.js') }}'></script>
@endpush
