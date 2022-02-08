@extends('layouts.home')

@section('content')




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
                 <th>jwt</th>
              </tr>
           </thead>

           <tbody>



           </tbody>
          </table>
          {{-- {{ $users->links() }} --}}
       </div>
    </div>
</div>












  <script>
    $(document).ready(function () {

      fetchUser();

      function fetchUser(){
          $.ajax({
              type:"GET",
              url:"/fetchUser",
              dataType:"json",
              success:function(response){
                console.log(response.users);
                  $('tbody').html(''); //empting the body before every reload to avoid duplication in table.
                    $.each(response.users, function(key, item){
                        $('tbody').append('<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+item.email+'</td>\
                            <td>'+item.jwt+'</td>\
                        </tr>');
                    });
              }

          });
      }

    });


  </script>



@endsection
