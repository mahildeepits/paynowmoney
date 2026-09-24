@php
    $method = 'post';
    $route = 'roles.store';
    $button = 'submit';
    $title = 'Create Role';
    if(isset($role)){
        $method = 'put';
        $route = ['roles.update',$id];
        $button = 'update';
        $title = 'Update Role';
    }
@endphp
<div class="card-body">
    <h4 class="pb-2">{{$title}}</h4>
    {!! Form::model($role ?? [], ['method' => $method,'route' => $route,'id' => 'form']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                <div class="invalid-feedback d-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="level">Level</label>
                {!! Form::number('level', null, ['class' => 'form-control','id' => 'level']) !!}
                <div class="invalid-feedback d-block"></div>
            </div>
        </div>
        <div class="col-md-4 mt-3 pt-3">
            <button type="submit" class="btn btn-primary">{{$button}}</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

