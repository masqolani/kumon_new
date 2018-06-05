function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {

    $('#event_name').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#event_date').datetimepicker({
      format: 'yyyy-mm-dd hh:ii',
      startDate: new Date(),
      autoclose: true
    });

    $('#event_date').keypress(function(e) {
        e.preventDefault();
    });

    $('#event_form').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        onkeyup: false,
        rules: {
            location_id :{
              required : true,
              remote: {
                url: getBaseUrl()+"/event/check_event",
                type: "post",
                data: {
                    location_id: function() {
                       return $("#location_id").val();
                    },
                    event_name: function() {
                       return $("#event_name").val();
                    },
                    event_date: function() {
                      return $("#event_date").val();
                    },
                    event_id: function() {
                      return $("#event_id").val();
                    }
                  },
                error: function(data) {
                    event.href = getBaseUrl()+"/login"
                  }
                }
            },
            event_name :{
              required : true,
              remote: {
                url: getBaseUrl()+"/event/check_event",
                type: "post",
                data: {
                    location_id: function() {
                       return $("#location_id").val();
                    },
                    event_name: function() {
                       return $("#event_name").val();
                    },
                    event_date: function() {
                      return $("#event_date").val();
                    },
                    event_id: function() {
                      return $("#event_id").val();
                    }
                  },
                error: function(data) {
                    event.href = getBaseUrl()+"/login"
                  }
                }
            },
            event_date :{
              required : true,
              remote: {
                url: getBaseUrl()+"/event/check_event",
                type: "post",
                data: {
                    location_id: function() {
                       return $("#location_id").val();
                    },
                    event_name: function() {
                       return $("#event_name").val();
                    },
                    event_date: function() {
                      return $("#event_date").val();
                    },
                    event_id: function() {
                      return $("#event_id").val();
                    }
                  },
                error: function(data) {
                    event.href = getBaseUrl()+"/login"
                  }
                }
            }
        },
        messages: {
            event_name: {
              remote: "Event name already exist"
            },
            event_date: {
              remote: "Event date already exist"
            },
            location_id: {
              remote: "Event location already exist"
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit
        },
        highlight: function (element) { // hightlight error inputs
           $(element)
                 .closest('.form-group').addClass('has-error'); // set error class to the control group
         },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});
