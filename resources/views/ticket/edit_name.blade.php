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
     <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Set Your Ticket Name</h4>
                
                    <form class="forms-sample" method="post" action="{{ route('ticket_name.update', $ticketName->id ) }}">
                        
                        @csrf
                        @method('put')

                      <div class="form-group">
                        <label for="exampleInputUsername1">Ticket Category</label>
                        <select name="ticket_id" id="" required class="form-control">
                            <option value="">Select Ticket Category</option>
                            
                            @foreach ($tickets as $item)
                                <option value="{{ $item->id }}" {{ $ticketName->ticket_id === $item->id ? 'selected':''  }}>{{ $item->name }}</option>
                            @endforeach

                        </select>
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" required class="form-control" name="name" value="{{ $ticketName->name }}" id="exampleInputUsername1" placeholder="Item Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername11">Value</label>
                        <input type="number" step="0.01" required class="form-control" name="value" value="{{ $ticketName->value }}" id="exampleInputUsername11" placeholder="Item Value">
                      </div>
                
                
                      <div class="form-group">
                        <label for="exampleInputUserndame11">Page Count</label>
                        <input type="number" required class="form-control" name="page" value="{{$ticketName->page}}" id="exampleInputUserndame11" placeholder="Total Page">
                      </div>
                
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
                
  </div>
 
  

  
</div>
        
@endsection