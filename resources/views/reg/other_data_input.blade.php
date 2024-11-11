@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Ticket Name
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Ticket <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
     <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Set Your Ticket Name</h4>
                
                    <form class="forms-sample" method="post" action="{{ route('reg.other_data_input_post') }}">
                        @csrf

                      <div class="form-group">
                        <label for="exampleInputUsername1">Register</label>
                        <select name="register" id="" required class="form-control">
                            <option value="">Select Register</option>
                            
                            @foreach ($reg as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                      </div>
         
                      <div class="form-group">
                        <label for="exampleInputUsername1">Category</label>
                        <select name="category" id="" required class="form-control">
                            <option value="">Select Category</option>
                            
                            @foreach ($other as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="exampleInputUsername1">Today Qty</label>
                        <input type="text" required class="form-control" name="today" id="exampleInputUsername1" placeholder="Item Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername11">Today Amount ($)</label>
                        <input type="number" step="0.01" required class="form-control" name="amount" id="exampleInputUsername11" placeholder="Item Value">
                      </div>
                
                
                      <div class="form-group">
                        <label for="exampleInputUserndame11">Total Qty</label>
                        <input type="number" required class="form-control" name="total" id="exampleInputUserndame11" placeholder="Total Page">
                      </div>
                
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
                <div class="col-md-8 grid-margin stretch-card">
                    
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket List</h4>
                            {!! displayAlert() !!}
                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          
                          <th>Name</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($save as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->id  }}</td>
                        
                            <td>

                                {{-- <a href="{{ route('ticket_name.edit', $volt->id) }}" class="btn  btn-gradient-success">Edit</a> --}}
                                <form action="{{ route('ticket_name.destroy', $volt->id)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    {{-- <button class="btn  btn-gradient-danger" type="submit">Delete</button> --}}
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