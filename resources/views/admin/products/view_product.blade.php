@extends('admin.layouts.admin')
@section('title','MLM Software - Receipt')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Products</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.list.product', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>View Products</h4>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered static-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Product Name</th>
                                            {{-- <th>Category Type</th> --}}
                                            {{-- <th>Sub Category Type</th> --}}
                                            <th>Price </th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            {{-- <th>Image</th> --}}
                                            <th>charge</th>
                                            <th width="160">sizes At</th>
                                            
                                            <th width="160">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($products)}} --}}
                                        @foreach($products as $key => $product)
                                            <tr>
                                                <td>{{ $product->id}}</td>
                                                <td>{{$product->name}}</td>
                                                {{-- <td>{{$product->category_type}}</td> --}}
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->quantity}}</td>
                                                {{-- <td>
                                                    @if($product->category_images  == null)
                                                        <img src="{{ asset('category/no-image.jpg') }}" width="100" />
                                                    @else
                                                        <img src="{{ asset('category/images/'.$product->category_images) }}" width="100" />
                                                    @endif
                                                </td> --}}
                                                <td>{{$product->delivery_charge}}</td>
                                                <td>{{$product->sizes}}</td>
                                                
                                                {{-- <td>{{ $product->status }}</td> --}}
                                                {{-- <td>{{ $product->created_at->format('d-m-Y') }}</td> --}}
                                                <td>
                                                    <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('admin.product.delete',$product->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
        });
    </script>
@endsection
