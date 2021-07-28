@extends('layouts.admin')

@section('title')
Master Kado Edit
@endsection

@section('css')
<style>
  #upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(5, 5, 5, 0.7);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: rgb(0, 0, 0);
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}
</style>
@endsection

@section('content')
<section class="bg-primary">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="d-flex align-items-center py-3">
          <h2 class="h3 font-weight-semibold text-white mb-0 mr-auto">Edit Kado {{$result->nama_kado}}</h2>
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
        
          <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">

            <li class="nav-item">
              <a class="nav-link active" id="kategori_kado-tab" data-toggle="tab" href="#kategori_kado" role="tab" aria-controls="kategori_kado" aria-selected="false">Kategori Kado</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Gallery</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="lokasi-tab" data-toggle="tab" href="#lokasi" role="tab" aria-controls="lokasi" aria-selected="false">Lokasi</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="detail_kado-tab" data-toggle="tab" href="#detail_kado" role="tab" aria-controls="detail_kado" aria-selected="true">Detail Kado</a>
            </li>
          </ul>
        
        <hr>
        <div class="tab-content" id="myTabContent">
          {{-- //Detail Kado --}}
          <div class="tab-pane fade" id="detail_kado" role="tabpanel" aria-labelledby="detail_kado-tab">
            <form action="{{url('master/update_detail_kado').'/'.$result->id}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="form-check">
                  <input class="form-check-input" name="pria" @if($result->pria == 1) checked @endif type="checkbox">
                  <label class="form-check-label" for="gridCheck1">
                    Pria
                  </label>
                </div>
              </div>

              <div class="form-row">
                <div class="form-check">
                  <input class="form-check-input" name="wanita" @if($result->wanita == 1) checked @endif type="checkbox" id="gridCheck1">
                  <label class="form-check-label" for="gridCheck1">
                    Wanita
                  </label>
                </div>
              </div>
              <hr>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Kado</label>
                  <input type="text" class="form-control" name="nama_kado" value="{{$result->nama_kado}}">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Slug</label>
                  <input type="text" class="form-control" name="slug" value="{{$result->slug}}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Group Kado</label>
                  <select name="kado_group" class="form-control">
                    @foreach($group as $row)
                    <option value="{{$row->id}}" {{$result->id_kado_group == $row->id  ? 'selected' : ''}}>{{$row->nama_group}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="inputEmail4">Harga</label>
                  <input type="number" class="form-control" name="harga" value="{{$result->harga}}">
                </div>

                <div class="form-group col-md-3">
                  <label for="inputEmail4">Umur</label>
                  <input type="number" class="form-control" name="umur" value="{{$result->umur}}">
                </div>
                
              </div>

              <div class="form-row">
                <div class="form-group col-md-12 ckeditor">
                  <textarea name="content" id="editor">
                      {{$result->deskripsi}}
                  </textarea>
                </div>
              </div>
              
              <div class="form-row">
                
                <div class="col-md-6 mx-auto">
                  <label>Thumbnail</label>
                  {{-- <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input id="upload" type="file" name="thumbnail" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>
                    <input type="hidden" name="link_thumbnail" value="{{$result->thumbnail}}">
                  </div> --}}

                  <!-- Uploaded image area-->
                  <div class="image-area mt-4"><img id="imageResult" src="{{asset($result->thumbnail)}}" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                  
                  </div>
                </div>

              </div>

              <div class="form-row" style="float:right; margin-top:40px;">
                <button class="btn btn-warning"><i class="ya ya-save"></i>  Save Detail Kado</button>
              </div>
            </form>

          </div>

          {{-- Kategori Kado --}}
          <div class="tab-pane fade show active" id="kategori_kado" role="tabpanel" aria-labelledby="kategori_kado-tab">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Kategori</label>
                <div class="input-group">
                  <select class="form-control" name="kategori">
                    @foreach($kategori as $row)
                      <option value="{{$row->id}}">{{$row->nama_kategori}}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary border-left-0" data-toggle="tooltip" data-placement="top" title="Tambah Kategori" onclick="addKategoriKado({{$result->id}})"><i class="ya ya-plus m-0"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="form-row">
              <div class="form-group col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 5%;">#</th>
                      <th>Nama Kategori</th>
                      <th style="width: 5%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @foreach($result->kategori_kado as $row)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$row->nama_kategori}}</td>
                      <td>
                        <button type="button" onclick="deleteKategoriKado({{$row->id}})" style="color: white;" class="btn btn-danger">X</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          {{-- Gallery Kado --}}
          <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
            <form action="{{url('master/add_foto_kado').'/'.$result->id}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Foto Kado</label>
                  <div class="input-group">
                    <input type="file" name="foto[]" class="form-control" multiple>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary border-left-0" data-toggle="tooltip" data-placement="top" title="Tambah Foto"><i class="ya ya-plus m-0"></i></button>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-4">

                </div>

                <div class="form-group col-md-4">
                  <label for="inputEmail4">Video Kado</label>
                  <div class="input-group">
                    <input type="file" name="video" class="form-control">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary border-left-0" data-toggle="tooltip" data-placement="top" title="Tambah video"><i class="ya ya-plus m-0"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="form-row">
              <div class="form-group col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 5%;">#</th>
                      <th>Video</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        @if($result->video)
                        <video width="320" height="240" controls src="{{asset($result->video->video)}}">
                          Your browser does not support the video tag.
                        </video>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
              <hr style="margin-top:60px;">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th>Foto</th>
                        <th>Thumbnail</th>
                        <th style="width: 5%;" colspan="2" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach($result->foto as $row)
                      <tr>
                        <td>{{$no++}}</td>
                        <td><img src="{{asset($row->foto)}}" alt="" style="width:200px; height:150px;"></td>
                        <td>
                          @if($row->thumbnail)
                          <span class="badge badge-pill badge-primary">YES</span>
                          @endif
                        </td>
                        <td>
                          @if($row->fg_aktif == 1)
                            @if(!$row->thumbnail)
                            <button type="button" style="color: white;" class="btn btn-info" onclick="setThumbnail('{{$row->id}}','{{$result->id}}')">Jadikan Thumbnail</button>
                            @endif
                          @endif
                        </td>
                        <td>
                          @if($row->fg_aktif == 1)
                            <button type="button" style="color: white;" onclick="setFgAktif('{{$row->id}}','nonaktif')" class="btn btn-danger">Nonaktifkan</button>
                          @else
                            <button type="button" style="color: white;"onclick="setFgAktif('{{$row->id}}','aktif')" class="btn btn-success">Aktifkan</button>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>

          {{-- Lokasi  Kado --}}
          <div class="tab-pane fade" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">

            <form id="frm_lokasi" onsubmit="return addLokasiKado()">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" class="form-control">
                </div>
                <div class="form-group col-md-8">
                  <label for="inputEmail4">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Background</label>
                    <input type="text" name="background" class="form-control">
                    *Note : 
                      <ul>
                        <li>Shopee : <span style="background: #FF6600; color:white;">#FF6600</span></li>
                        <li>Tokopedia : <span style="background: #00ff2a; color:white;">#00ff2a</span></li>
                      </ul>
                    
                </div>
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Color</label>
                    <input type="text" name="color" class="form-control">
                </div>
              </div>
              <input type="hidden" name="id_kado" value="{{$result->id}}">
              <div class="form-row float-right">
                <button type="submit" class="btn btn-primary">Add Lokasi</button>
              </div>
            </form>
              <hr style="margin-top:60px;">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th>Nama Lokasi</th>
                        <th>Link Beli</th>
                        <th>Background</th>
                        <th>Color</th>
                        <th style="width: 5%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach($result->lokasi as $row)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$row->nama_lokasi}}</td>
                        <td><a href="{{$row->lokasi}}">{{$row->lokasi}}</a> </td>
                        <td style="background:{{$row->background}}; color:white;">{{$row->background}}</td>
                        <td>{{$row->color}}</td>
                        <td>
                          <button type="button" onclick="deleteLokasiKado('{{$row->id}}')" style="color: white;" class="btn btn-danger">X</button>
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
    </div>
  </div>
</section>

@endsection

@section('js')
<script src="{{asset('plugin/ckeditor/ckeditor.js')}}"></script>


<script>

$(document).ready(function(){

  $("#frm_lokasi").submit(function(e) {
        e.preventDefault();
    });

  ClassicEditor.create(document.querySelector('#editor'));

});



function addKategoriKado(id_kado){
  id_kategori = $('#kategori_kado [name="kategori"]').val();
  
  showLoading();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/add_kategori_kado')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'id_kategori': id_kategori,
              'id_kado': id_kado,
            },
            success: function( data ) {
              swal("Success!", data, "success");
              location.reload();
            },
            error : function(xhr) {
            swal("Error!", xhr.responseJSON.message, "error");
            closeLoading();
            
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}

function deleteKategoriKado(id) {
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
                url: "{{url('/master/delete_kategori_kado')}}",
                headers	: { 
                  "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                  },
                dataType: "json",
                data: {
                  'id':id,
                },
                success: function( data ) {
                  location.reload();
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

function addLokasiKado(id_kado){
  var dtForm 		= $('#frm_lokasi').serializeArray();
  showLoading();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/add_lokasi_kado')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: dtForm,
            success: function( data ) {
              swal("Success!", data, "success");
              location.reload();
            },
            error : function(xhr) {
            swal("Error!", xhr.responseJSON.message, "error");
            closeLoading();
            
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}

function deleteLokasiKado(id){
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
                url: "{{url('/master/delete_lokasi_kado')}}",
                headers	: { 
                  "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                  },
                dataType: "json",
                data: {
                  'id':id,
                },
                success: function( data ) {
                  location.reload();
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

function setThumbnail(id,id_kado){
  showLoading();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/set_thumbnail')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'id': id,
              'id_kado': id_kado
            },
            success: function( data ) {
              swal("Success!", data, "success");
              location.reload();

            },
            error : function(xhr) {
            swal("Error!", xhr.responseJSON.message, "error");
            closeLoading();
            
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}

function setFgAktif(id,status){
  showLoading();
       
        $.ajax({
            type 	: 'POST',
            url: "{{url('/master/set_fg_aktif')}}",
            headers	: { 
              "X-CSRF-TOKEN": "{{ csrf_token() }}" 
              },
            dataType: "json",
            data: {
              'id': id,
              'status': status
            },
            success: function( data ) {
              swal("Success!", data, "success");
              location.reload();

            },
            error : function(xhr) {
            swal("Error!", xhr.responseJSON.message, "error");
            closeLoading();
            
            },
            complete : function(xhr,status){
              closeLoading();
            }
        });
}
  
</script>

@endsection