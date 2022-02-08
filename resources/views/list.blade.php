<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Users Data</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 <style>
   .container{
    padding: 0.5%;
   }
</style>
</head>
<body>

<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Users Data</h2><br>
    <div class="row">
        <div class="col-12">
          <table class="table table-bordered" id="">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Email</th>
                 {{-- <td colspan="2">Action</td> --}}
              </tr>
           </thead>
           <tbody id="users-crud">
              @foreach($users as $u_info)
              <tr id="user_id_{{ $u_info->id }}">
                 <td>{{ $u_info->id  }}</td>
                 <td>{{ $u_info->name }}</td>
                 <td>{{ $u_info->email }}</td>
                 {{-- <td><a href="javascript:void(0)" id="show-user" data-id="{{ $u_info->id }}" class="btn btn-info">Show</a></td> --}}
              </tr>
              @endforeach
           </tbody>
          </table>
          {{ $users->links() }}
       </div>
    </div>
</div>

</body>
</html>

<div class="modal fade" id="ajax-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="userShowModal"></h4>
          </div>
          <div class="modal-body">
              <form id="userForm" name="userForm" class="form-horizontal">
                 <input type="hidden" name="user_id" id="user_id">
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-12">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="">
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

     /* When click show user */
      $('body').on('click', '#show-user', function () {
        var user_id = $(this).data('id');
        $.get('ajax-crud/' + user_id +'/edit', function (data) {
           $('#userShowModal').html("User Details");
            $('#ajax-modal').modal('show');
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
        })
     });

    });


  </script>
