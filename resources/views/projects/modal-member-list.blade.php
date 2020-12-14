<div class="modal fade" id="member-list" tabindex="-1" role="dialog" aria-labelledby="edit-projectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title">Members of This Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <ul>
                    <li class="row no-gutters align-items-center justify-content-between mb-3">
                        <div class="row no-gutters align-items-center">
                            <img src="{{ asset('img/dummy-profile.svg') }}" class="mr-3" width="50px">
                            <div class="text-primary">Jess Effendy</div>
                        </div>
                        {{-- <em class="text-pending">Pending</em> --}}
                    </li>
                    <li class="row no-gutters align-items-center justify-content-between mb-3">
                        <div class="row no-gutters align-items-center">
                            <img src="{{ asset('img/dummy-profile.svg') }}" class="mr-3" width="50px">
                            <div class="text-primary">Team Membar 2</div>
                        </div>
                        {{-- <em class="text-pending">Pending</em> --}}
                    </li>
                    <li class="row no-gutters align-items-center justify-content-between mb-3">
                        <div class="row no-gutters align-items-center">
                            <img src="{{ asset('img/dummy-profile-not-confirmed.svg') }}" class="mr-3" width="50px">
                            <div class="text-primary">Team Member 2</div>
                        </div>
                        <em class="text-pending">Pending</em>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
