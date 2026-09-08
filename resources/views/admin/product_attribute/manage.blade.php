@extends('admin.layouts.layout')
@section('admin_page_title')
Manage Default Attribute
@endsection
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Manage All Default Attributes</h5>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Attributes</th>
                        <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allattributes as $attribute)

                    <tr>
                        <td>{{$attribute->id}}</td>
                        <td>{{$attribute->attribute_value}}</td>
                        <td>
                            <a href="{{route('show.attribute', $attribute->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{route ('delete.attribute', $attribute->id)}}" method="POST" class="d-inline>
                                @csrf
                                @method('DELETE')
                                <button type="submit" value="Delete" class="btn btn-sm btn-danger">Delete</button>
                            </form >
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
@endsection
