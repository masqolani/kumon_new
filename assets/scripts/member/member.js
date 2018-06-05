function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

  $('#member_list').DataTable({
      "ajax": getBaseUrl() + "/member/get_member_json",
      "columns": [
          { "data": "registration_number" },
          { "data": "member_name" },
          { "data": "grade_name" },
          { "data": "type_name" },
          { "data": "event_name" },
          { "data": "seat" },
          { "data": "attend_status" },
          { "data": "actions" }
      ]
  });

  // modified search
  $('div.dataTables_filter input').focus();
  $('.dataTables_filter input[type="search"]').
  attr('placeholder','looking for anything...').
  css({'width':'350px','display':'inline-block'});

  // event filter
  // $('#eventFilter').focus();
  $('#eventFilter').on('change', function(){
    var filter_value = $(this).val();
    var new_url = getBaseUrl() + "/member/get_member_json/"+filter_value;
    $("#member_list").DataTable().ajax.url(new_url).load();
  });

  // print ticket
  $("#ticketprint").click(function() {
      $('#printarea').printThis();
      return false;
  });

  // update attendance status
  $("#member_list").on("click", "#attend_status", function(){
    $.ajax({
      type: "post",
      url: getBaseUrl() + "/member/set_attended",
      data: {member_id : $(this).attr("member_id")},
      success: function(data){
        var data = JSON.parse(data);
        console.log(data);

        if(data.status = 'true') {

          if(data.result[0].meeting_point == null){
            var meeting_point = "";
          } else {
            var meeting_point = data.result[0].meeting_point;
          }

          if(data.result[0].gate_in == null){
            var gate_in = "";
          } else {
            var gate_in = data.result[0].gate_in;
          }

          var response = '<div id="printarea">'+
                          '<div style="text-align: center; max-width: 10cm;">'+
                            '<h4>'+ data.result[0].member_name +'</h4>'+
                            '<h5><b>Class: <b/><i>'+ data.result[0].grade_name +'</i></h5>'+
                            '<h5><b>Trophy: </b><i>'+ data.result[0].get_award +'</i></h5>'+
                            '<h5><b>Session: </b><i>'+ data.result[0].member_session +'</i></h5>'+
                            '<h5><b>Gate: </b><i>'+ gate_in +'</i></h5>'+
                            '<h5><b>Table: </b><i>'+ data.result[0].trophy_table +'</i></h5>'+
                            '<h5><b>Meeting Point: </b><i>'+ meeting_point +'</i></h5>'+
                            '<h5><b>Chair: </b><i>'+ data.seat +'</i></h5>'+
                          '</div>'+
                        '</div>';

          $('.modal-body').html(response);
          $('#empModal').modal('show');

          $("#member_list").DataTable().ajax.reload(null, false);
          // location.reload();
          // alert("Member has been attend");
        } else {
          alert("Member has not been attend");
          // location.reload();
        }
      },
      error: function(data){
        alert('something wrong');
      }
    });
  });
});
