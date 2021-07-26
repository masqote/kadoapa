function showLoading() {
  $('.loading').show();
}

function closeLoading() {
  $('.loading').hide();
}

function set_currency(val){

  if (val) {
    return parseFloat(val.replace(/,/g, ""))
      // .toFixed(2)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      
  }

  return 0;
}

function alert_msg(status,textMsg,code){
  var background = '';

  if (status == 'Error') {
    background = 'red';
  }else{
    background = 'green';
  }

  var tbl = '';

    tbl+= `
    <div class="popup alert alert-danger alert-dismissible col-10 col-md-4" style="background:`+background+`; color:white;" role="alert" id="alert-msg" data-animation="slide-up" data-autohide="3000">
      <strong>`+status+`!</strong> `+textMsg+`
      <button type="button" class="close" data-dismiss="popup" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    `;

    $('.popup-alert').html(tbl);

    $("#alert_msg").click();
}

function read_error(xhr) {
  console.log(xhr);
  var textMsg = '<strong></strong>';
  // var response = [];

  // if (xhr.responseText) {
  //   response = JSON.parse(xhr.responseText);
  // }

  // $.each(response, function (x, y) {
  //   textMsg += x + ' : ' + y + '<br><br>';
  // });

  textMsg += xhr.responseJSON.message;

  alert_msg('Error',textMsg);
  // return;

}

function alert_admin(status,textMsg,code){
        var tbl = '';
              
              $("#alert_msg").show();
              tbl += `<div class="alert alert-danger" role="alert">
                      `+textMsg+`
                     </div>
                     `;
              
              $('#alert_msg').html(tbl);

              setTimeout(function() {
                  $("#alert_msg").hide();
              }, 5000);
}

function paginate(result){
    var pagination = '';
    var from_data = 0;
    var to_data = 0;
    var total_data = 0;

    if(result.data.length > 0){

      $.each(result.links,function(x,y){
        var active = '';
        if (y.active == true) {
          active = 'active';
        }else if (y.url == null) {
          active = 'disabled';
        }

        if (x == 0) {
          y.label = '&laquo; First'
        }else if (x > result.last_page) {
          y.label = 'Last &raquo;'
        }

        if (x > result.last_page) {
          x = x-1;
        }

        pagination += `
          <li class="page-item `+active+`"><button class="page-link" onclick="searchData(`+x+`)" >`+y.label+`</button></li>
        `;

    });
    from_data = result.from;
    to_data = result.to;
    total_data = result.total;

  }
  
  $('.pagination').html(pagination);
  $('#from_data').text(from_data);
  $('#to_data').text(to_data);
  $('#total_data').text(total_data);
}
