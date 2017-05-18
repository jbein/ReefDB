$('#modalDataDetail').on('show.bs.modal', function(event) {
   var button = $(event.relatedTarget);
   var did = button.data('did');
   var dname = button.data('dname');

   $.ajax({
      type: "POST",
      url: "php/getDataDetail.php",
      data: {
         DID: did,
		 DNAME: dname
      },
      cache: false,
      success: function(data) {
         console.log(data);
         $('.modal-content').html(data);
      },
      error: function(err) {
         console.log(err);
      }
  });
});

$(document).ready(function() {
    $('#newDataWater-1').change(function() {
		if(this.checked) {
			$('#newDataWaterVolumeDiv').fadeIn('slow');
		}
	});
	
    $('#newDataWater-0').change(function() {
        if(this.checked) {
            $('#newDataWaterVolumeDiv').fadeOut('slow');
        }
    });
});
