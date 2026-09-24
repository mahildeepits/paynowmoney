<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <option @if($edit_id == $subcategory->id) selected @endif value="{{$subcategory->id}}">{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('admin.categories.editSubCategoryList-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach

