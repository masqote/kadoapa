@extends('layouts.admin')

@section('title')
Master Kado
@endsection

@section('content')
<section class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="d-flex align-items-center py-3">
          <h2 class="h3 font-weight-semibold text-white mb-0 mr-auto">Master Kado</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="alert_msg">
            
</div>
<section class="pt-lg-5">
  <div class="container">
    <div class="row">
      <div class="col">
        
        <div class="d-md-flex align-items-center mb-4">
          <form class="form-inline mr-auto mb-3 mb-md-0">
            <span class="d-none d-lg-inline font-weight-semibold text-dark mr-3">Filter:</span>
            <div class="input-group">
              <input type="text" class="form-control form-control-inline" id="search_text" placeholder="Search in topic...">
              <div class="input-group-append">
                <button type="button" class="btn btn-light border-left-0"><i class="ya ya-search m-0"></i></button>
              </div>
            </div>
          </form>

          <button class="btn btn-outline-primary" id="add_new">Add New +</button>
          
          
        </div>
        
        <!-- end .d-flex -->
        <div style="overflow-x:auto;">
          <table class="table table-bordered table-dashed data-box" style="width:1100px;">
            <thead>
              <tr>
                <th class="d-md-table-cell" style="width: 5%;" scope="col">#</th>
                <th scope="col">Nama Kado</th>
                <th scope="col">Updated at</th>
                <th class="d-md-table-cell" style="width: 20%;" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr>
                <th class="d-md-table-cell" style="width: 5%;" scope="col">#</th>
                <th scope="col">Nama Kado</th>
                <th scope="col">Updated at</th>
                <th class="d-md-table-cell" style="width: 20%;" scope="col">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- end .table -->
        <nav aria-label="Page navigation">
          <div class="d-md-flex align-items-center mb-4">
            Result Data : <span id="from_data">0</span> - <span id="to_data">0</span> ( <span id="total_data">0</span> ) 
          </div>
          <ul class="pagination justify-content-md-end mt-4">

          </ul>
          
        </nav>
        <!-- end pagination -->
      </div>
    </div>
  </div>
</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_add" autocomplete="off"  onsubmit="return addProcess()">
          <div class="form-group">
            <label for="exampleInputEmail">Nama Kado</label>
            <input type="text" class="form-control" name="nama_kado" placeholder="Enter Nama Kado" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail">Slug</label>
            <input type="text" class="form-control" name="slug" placeholder="Enter Slug" required>
          </div>
          <button type="submit" id="btn_add_process" class="d-none" >submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_add">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>

var urlPage = '';

$(document).ready(function(){

  $("form").submit(function(e) {
        e.preventDefault();
    });
  
    $("#btn_add").click(function(){
      $('#btn_add_process').click();
    });

    $("#add_new").click(function(){
      $('#modal_add').modal('show');
    });

  page = 1;
  searchData(page);

  $("#search_text").change(function(){
    page = 1;
    searchData(page);
  });
  
});

function searchData(page){
       var search_text = $('#search_text').val();
       urlPage = page;

        showLoading();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/search_kado?page=')}}" + page,
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'search_text': search_text,
            },
            success: function( data ) {
              
              var result = data.result;
              var tbl = '';
              var action = '';
              if (result.data.length > 0) {
                var no = result.from;
                
                $.each(result.data,function(x,y){
                  if (y.fg_aktif === 1) {
                    action = `<button class="btn btn-danger" onclick="deleteData(`+y.id+`)">Delete</button>`
                  }else{
                    action = `<button class="btn btn-success" onclick="aktifkanData(`+y.id+`)">Aktifkan</button>`
                  }

                  tbl += `
                  <tr>
                    <td>`+no+++`</td>
                    <td>`+y.nama_kado+`</td>
                    <td>`+y.updated_human+`</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="{{url('master/edit_kado/`+y.id+`')}}" style="color:white;" target="_blank">Edit</a>
                        `+action+`
                      </div>
                    </td>
                  </tr>
                  `;
                });

              }
              paginate(result);

              $('.data-box tbody').html(tbl);
            },
            error : function(xhr) {
             closeLoading();
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}

function addProcess(){
      showLoading();
      var dtForm 		= $('#frm_add').serializeArray();
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/add_kado')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: dtForm,
            success: function( data ) {
              $('#modal_add').modal('hide');
              swal("Success!", "Data berhasil ditambahkan!", "success");
              $('#frm_add').trigger("reset");
              searchData(urlPage);
            },
            error : function(xhr) {
             closeLoading();
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}

function deleteData(id) {
        swal({
          title: "Are you sure?", 
          text: "Are you sure that you want to delete this data?", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, deleted it!",
          confirmButtonColor: "#ec6c62"
        }, function() {
          $.ajax({
                type 	: 'POST',
                url: "{{url('/master/delete_kado')}}",
                headers	: { 
                  "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                  },
                dataType: "json",
                data: {
                  'id':id,
                },
                success: function( data ) {
                  searchData();
                },
                error : function(xhr) {
                
                },
                complete : function(xhr,status){
               
                }
            })
          .done(function(data) {
            swal("Canceled!", "Your data successfully deleted!", "success");
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });
        });
}

function aktifkanData(id) {
        swal({
          title: "Are you sure?", 
          text: "Are you sure that you want to activated this data?", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Aktifkan!",
          confirmButtonColor: "#00FF00"
        }, function() {
          $.ajax({
                type 	: 'POST',
                url: "{{url('/master/aktifkan_kado')}}",
                headers	: { 
                  "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                  },
                dataType: "json",
                data: {
                  'id':id,
                },
                success: function( data ) {
                  searchData();
                },
                error : function(xhr) {
                
                },
                complete : function(xhr,status){
               
                }
            })
          .done(function(data) {
            swal("Active!", "Your data successfully activated!", "success");
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });
        });
}

</script>
@endsection