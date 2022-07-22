@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-danger fw-bold  rounded-pill" href="{{url('create')}}">Add New Product</a>
            </div>
        </div>
    </div>
    @if($msg = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$msg}}</p>
        </div>
    @endif
    <table class="table mt-5">
        <thead class= "bg-danger text-white fw-bold">
            <th>No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Status</th>
            <th width="300px">Actions</th>
        </thead>
        <tbody class="bg-white fs-5">
        @foreach($products as $product)
            <tr>
                <td class="pt-5">{{++$i}}</td>
                <td><img src="/images/{{$product->image}} " width="100px" height="100px"></td>
                <td class="pt-5">{{$product->name}}</td>
                <td class="pt-5">{{$product->price}}</td>
                <td class="pt-5">
                    @if($product->status==1)
                    <a class="btn btn-danger rounded-pill" href="{{url('change-status/'.$product->id)}}" style="width:100px;">Active</a>
                    @else
                    <a class="btn btn-outline-warning rounded-pill" href="{{url('change-status/'.$product->id)}}" style="width:100px;">Inactive</a>
                    @endif
                </td>
                <td class="pt-5">
                    <form action="{{route('destroy',$product->id)}}" method="POST">
                        <a class="btn btn-outline-danger rounded-pill" href="{{route('show',$product->id)}}" style="width:80px;">Show</a>
                        <a class="btn btn-outline-danger rounded-pill" href="{{route('edit',$product->id)}}" style="width:80px;">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger rounded-pill" style="width:80px;" onclick="return confirm('Are you sure to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->links()!!}
</div>
@endsection
