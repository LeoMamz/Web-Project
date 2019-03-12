jQuery(document).ready(function() {

	var isProxyNum = false;

	$('.form-horizontal').on('focus','input',function(){
		$(this).removeClass("input-error");
	});

	$('#submit_Cap').click(function(){
		var state = true;

		$('.form-horizontal').find('input').each(function(){
			console.log($(this).val());
			if ($(this).val() == ''){
				$(this).addClass('input-error');
				state = false;
			}
		});

		if (state)
		{
			var state1 = true;
			var data = "op_type=" + $('.form-horizontal').find('input[name="optionsRadios"]:checked').val() + "&"
					  + "cap_acc=" + $('.form-horizontal').find('input[id="id"]').val() + "&"
					  + "amount=" + $('.form-horizontal').find('input[id="amount"]').val();

			if (state1)
				$('#dialog_Cap').dialog("open");
		}

		return false;
	});

	$( "#dialog_Cap" ).dialog({
		resizable: false,
		height: 400,
		width: 700,
		autoOpen: false,
		modal: true,
		closeOnEscape:false,
		open:function(event,ui){
			$(".ui-dialog-titlebar-close").hide();
			$('.ui-dialog-buttonset').find('button').addClass('ui-button ui-corner-all ui-widget');
		},
		buttons: {
	        "Comfirm": function() {
	        	var data = "op_type=" + $('.form-horizontal').find('input[name="optionsRadios"]:checked').val() + "&"
					  + "cap_acc=" + $('.form-horizontal').find('input[id="id"]').val() + "&"
					  + "amount=" + $('.form-horizontal').find('input[id="amount"]').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Manage_capital/manage_capital",
			        data:data,
			        async:false,
			        success:function(result){
			            console.log(result);
			            alert('Successfully create a capital account!');
			        },
			        error:function(msg){
			            console.log(msg);
			            alert('Create fail! :(');
			        }
	          	});
	        },
	        Cancel: function() {
	          $( this ).dialog( "close" );
	        }
	    }
	});

} );