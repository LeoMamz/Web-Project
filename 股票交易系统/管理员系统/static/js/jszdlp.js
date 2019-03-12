jQuery(document).ready(function() {

	$('.form-horizontal').on('focus','input',function(){
		$(this).removeClass("input-error");
	});

	$('#submit1').click(function(){
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
			$('#dialog').find('#sec_id_b').empty().append($('.form-horizontal').find('#sec_id').val());
			$('#dialog').find('#id_b').empty().append($('.form-horizontal').find('#identity_id').val());
			$('#dialog').dialog("open");
		}

		return false;
	});

	$( "#dialog" ).dialog({
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
	        	var data = "sec_id=" + $('.form-horizontal').find('#sec_id').val() + "&"
	        			 + "identity_id=" + $('.form-horizontal').find('#identity_id').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Create_capital/create_capital",
			        data:data,
			        async:false,
			        success:function(result){
			            console.log(result);
			            alert('Successfully create a capital account!');
			            alert('Your capital account: ' + result.cap_info[0].cap_acc);
			            alert('Your capital password: ' + result.cap_info[0].cap_pwd);
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