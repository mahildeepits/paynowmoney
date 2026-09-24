<form action="{{route('announcements.create')}}" method="post" onsubmit="ajaxFormSubmit($(this))">
    @csrf
    @if($announcement != null)
        <input type="hidden" name="id" value="{{$announcement->id}}">
    @endif
    <div class="form-group mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{$announcement?->title ?? ''}}" id="title" placeholder="Enter title" />
        <div class="invalid-feedback"></div>
    </div>
    
    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description" >{{$announcement?->description ?? ''}}</textarea>
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group mb-3">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{$announcement && $announcement->status == 1 ? 'selected' : ''}}>Active</option>
            <option value="0" {{$announcement && $announcement->status == 0 ? 'selected' : ''}}>Inactive</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary ">
    </div>
</form>
