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
                
                    <form class="forms-sample" method="post" action="{{ route('ticket_name.store') }}">
                        @csrf

                      <div class="form-group">
                        <label for="exampleInputUsername1">Ticket Category</label>
                        <select name="ticket_id" id="" required class="form-control">
                            <option value="">Select Ticket Category</option>
                            
                            @foreach ($tickets as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" required class="form-control" name="name" id="exampleInputUsername1" placeholder="Item Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername11">Value</label>
                        <input type="number" step="0.01" required class="form-control" name="value" id="exampleInputUsername11" placeholder="Item Value">
                      </div>
                
                
                      <div class="form-group">
                        <label for="exampleInputUserndame11">Page Count</label>
                        <input type="number" required class="form-control" name="page" id="exampleInputUserndame11" placeholder="Total Page">
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
                          <th>Category</th>
                          <th>Name</th>
                          <th>Value</th>
                          <th>Pages</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ticketname as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->ticket->name  }}</td>
                            <td>{{$volt->name  }}</td>
                            <td>{{$volt->value  }}</td>
                            <td>{{$volt->page  }}</td>
                            <td>
                              <p>{{$volt->status->getLebelText()  }}</p>
                              <a 
                                  href="{{ route('ticket.status_change', $volt->id) }}"
                                  class="{{$volt->status->isActive() == true ? 'btn  btn-gradient-warning':'btn  btn-gradient-info'}}"
                              >
                                {{$volt->status->getLebelReform()  }}
                              </a>
                            
                            </td>
                            <td>

                                <a href="{{ route('ticket_name.edit', $volt->id) }}" class="btn  btn-gradient-success">Edit</a>
                                <form action="{{ route('ticket_name.destroy', $volt->id)}}" method="POST">
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