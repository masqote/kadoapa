@extends('layouts.admin')

@section('title')
Master Kategori
@endsection

@section('content')
<div class="site-content" role="main">
  <section class="bg-primary">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="d-flex align-items-center py-3">
            <h2 class="h3 text-white mb-0 mr-auto">Create Blog</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  
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
  
            <a class="btn btn-outline-primary" href="{{url('master/blog')}}">Add New +</a>
            
            
          </div>
          
          <!-- end .d-flex -->
          <div style="overflow-x:auto;">
            <table class="table table-bordered table-dashed data-box" style="width:1100px; ">
              <thead>
                <tr>
                  <th class="d-md-table-cell" style="width: 5%;" scope="col">#</th>
                  <th scope="col">Nama Kategori</th>
                  <th class="d-md-table-cell" style="width: 20%;" scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
              <tfoot>
                <tr>
                  <th class="d-md-table-cell" style="width: 5%;" scope="col">#</th>
                  <th scope="col">Nama Kategori</th>
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
</div>
@endsection

@section('js')
<script>
  var urlPage = '';

$(document).ready(function(){

  $("form").submit(function(e) {
      e.preventDefault();
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
            url: "{{url('/master/search_list_blog?page=')}}" + page,
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'search_text': search_text,
            },
            success: function( data ) {
              
              var result = data.result;
              console.log(result);
              var tbl = '';
              
              if (result.data.length > 0) {
                var no = result.from;

                $.each(result.data,function(x,y){
                  tbl += `
                  <tr>
                    <td>`+no+++`</td>
                    <td>`+y.title+`</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-info" href="{{url('blog/`+y.id+`/`+y.slug+`')}}" target="_blank">View</a>
                        <a class="btn btn-primary" href="{{url('master/edit_blog/`+y.id+`')}}">Edit</a>
                        <a class="btn btn-danger" href="{{url('master/nonaktif_blog/`+y.id+`')}}">Nonaktifkan</a>
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


</script>
@endsection