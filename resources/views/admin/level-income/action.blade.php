<a href="{{route('level-income.edit',encrypt($model->id))}}" class="btn btn-sm btn-warning">Edit</a>
<a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="ajaxOnClick(`{{route('level-income.destroy',encrypt($model->id))}}`,'DELETE',{{json_encode(['_token' => csrf_token()])}})">Delete</a>
