@if($storageIs)
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">{{__("Storage Link!")}}</h4>
    <p>{{__("Patrick not found storage link in public directory. Do you want to generate storage link")}}</p>
    <hr>
    <p class="mb-0">
        <form action="{{ route('storage.link_create') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary">
                {{__("Generate Link")}}
            </button>
        </form>
    </p>
</div>
@endif
