@extends('layouts.app')

@section('content')
<style>
    body {
  margin: 2em;
}

.lightRed {
  background-color: #ff8080 !important
}

.lightRed a {
  color: #fff;
  font-weight: bold;
}

.red {
  background-color: #f00;
}
    </style>
<input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
        @forelse($user_data as $user)

        <input type="text" id="namee<?php echo $user->id; ?>" value="<?php echo $user->name; ?>"> 
        <input type="text" id="emaill<?php echo $user->id; ?>" value="<?php echo $user->image; ?>"> 
        <input type="hidden" id="imagee<?php echo $user->id; ?>" value=""> 
  
		<tr>
			<td>1</td>
			<td>{{$user->name}}</td>
			<td>{{$user->email}}</td>
			<td><img src="{{ asset('profile/'.$user->image) }}" style="height: 50px;width:100px;"></td>
            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="update_user(<?php echo $user->id; ?>)">
  Edit
</button><button class="btn btn-danger" type="button" onclick="delete_data(<?php echo $user->id; ?>)">Delete</button></td>
		</tr>
		@empty
    
    <p>No Data found</p>

@endforelse
		
	</tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input class="form form-control" type="text" id="name_edit">
        <input class="form form-control" type="text" id="email_edit">
        <input class="form form-control" type="text" id="image_edit">
        <input class="form form-control" type="text" id="id_edit">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
  // DataTable initialisation
  $('#example').DataTable({
    "paging": true,
    "autoWidth": true,
    "columnDefs": [
      {
        "targets": 3,
        "render": function(data, type, full, meta) {
          var cellText = $(data).text(); //Stripping html tags !!!
          if (type === 'display' &&  (cellText == "Done" || data=='Done')) {
            var rowIndex = meta.row+1;
            var colIndex = meta.col+1;
            $('#example tbody tr:nth-child('+rowIndex+')').addClass('lightRed');
            $('#example tbody tr:nth-child('+rowIndex+') td:nth-child('+colIndex+')').addClass('red');
            return data;
          } else {
            return data;
          }
        }
      }
    ]
  });
});


function update_user(x)
{
  
    var test = $('#name_edit'+x).val(); 
    var xyz=$('#email_edit'+x).val();
    alert(test);
    $('#id_edit').val(x);
    var token = $('#token').val();
      
}

function delete_data(x)
{
    var id=x;
    alert(id);
    var token = $('#token').val();
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                    		   url: "/delete_user",
                    		   type: "POST", 
                    		   data: {id:x},
                    		 
                              headers: {
                                    'X-CSRF-Token': token 
                               },
                    				success: function(data)
                    				{
                    				     swal("Done", "Deleted", "success");
                    				      get_data_backend(1);
                    		        },
                    		        error: function(data){
                                        swal("Not deleted!", "Data not deleted", "error");

                                    }
                         	}); 
            } 
                    });
}
</script>
@endsection
