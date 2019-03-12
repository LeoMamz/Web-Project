jQuery(document).ready(function() {

	var isProxyNum = false;

	$('.form-horizontal').on('focus','input',function(){
		$(this).removeClass("input-error");
	});

	$('#submit').click(function(){
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
			var data = "cap_acc=" + $('.form-horizontal').find('input[id="basicinput"]').val() + "&"
					  + "cap_pwd_old=" + $('.form-horizontal').find('input[id="basicinput1"]').val() + "&"
					  + "cap_pwd_new=" + $('.form-horizontal').find('input[id="basicinput2"]').val();

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
	        	var data = "cap_acc=" + $('.form-horizontal').find('input[id="basicinput"]').val() + "&"
					  + "cap_pwd_old=" + $('.form-horizontal').find('input[id="basicinput1"]').val() + "&"
					  + "cap_pwd_new=" + $('.form-horizontal').find('input[id="basicinput2"]').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Modify_capital/modify_capital",
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