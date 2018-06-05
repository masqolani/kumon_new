$(document).ready(function() {
    $('#dataTables-example').DataTable({
       responsive: true
    });
});

// var table = $('#dataTables-example').DataTable({
// 	// responsive: true,
// 	"ajax":
// 		{
//            "url": 'table/get_data',
//            "error": function(jqXHR, textStatus, errorThrown){
// 	            alert('Please Login');
// 	            location.href = getBaseUrl()+"/login"
//            },
//            "success": function() {
//            		console.log('masuk sukses');
//            }
// 		},
// 	"columns": [
// 		{"data":"username"},
// 		{"data":"first_name"},
// 		{"data":"last_name"},
// 		{"data":"email"},
// 		{"data":"actions"}
// 	],
// 	"columnDefs": [ { orderable: false, targets: [4] } ],
// 	"order": [[ 0, "desc" ]]
// });

// function getBaseUrl() 
// {
//     var l = window.location;
//     var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
//     return base_url;
// }