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
                <ul class="users-list clearfix">
                    @foreach ($members as $member)
                        @if ($member->project_id == $projects->id)
                            <li>
                                <img src="{{ (!empty($member->user->profile_photo_path)) ? url('/storage/'.$member->user->profile_photo_path) : asset('img/dummy-profile.svg') }}" class="img-member-modal">
                                <a class="users-list-name" href="#">{{ $member->user->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
