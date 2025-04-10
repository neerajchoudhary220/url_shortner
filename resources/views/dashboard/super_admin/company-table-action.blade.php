<div class="d-flex justify-content-center">
    <a href="{{ route('invite',['company_id'=>$d->id]) }}" class="btn btn-primary invite-btn">Invite</button>
    <a href="{{ route('shortUrl.show.list',$d->id) }}" class="btn btn-secondary ml-3">View Short URLs</button>

</div>