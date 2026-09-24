@if ($model->joiningKit == null)
    <a href="{{route('auto-pool.edit',encrypt($model->id))}}" class="btn btn-sm btn-warning">Edit</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="ajaxOnClick(`{{route('auto-pool.destroy',encrypt($model->id))}}`,'DELETE',{{json_encode(['_token' => csrf_token()])}})">Delete</a>    
@endif