@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Reg Category
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Reg <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
     <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Reg Item Add</h4>
                
                    <form class="forms-sample" method="post" action="{{ route('reg.item_add_post') }}">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Item</label>
                        <input type="text" required class="form-control" name="item" id="exampleInputUsername1" placeholder="Item Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername11">Value</label>
                        <input type="number" step="0.01" required class="form-control" name="value" id="exampleInputUsername11" placeholder="Item Value">
                      </div>
                
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
                <div class="col-md-6 grid-margin stretch-card">
                    
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Reg Item List</h4>
                            {!! displayAlert() !!}
                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Value</th>
                          {{-- <th>Created</th> --}}
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($reg as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->name  }}</td>
                            <td>{{$volt->value  }}</td>
                            {{-- <td>{{$volt->created_at  }}</td> --}}
                            <td>
                                <form action="{{ route('reg.item_add_delete', $volt->id ) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn  btn-gradient-danger" type="submit">Delete</button>
                                </form>
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