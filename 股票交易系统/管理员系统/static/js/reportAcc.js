jQuery(document).ready(function() {

	var isProxyNum = false;

	$('.form-horizontal').on('click',':radio',function(){
		switch($(this).attr("name"))
		{
			case 'optionsRadios':
			case 'optionsRadios3':
				if ($(this).attr('id') == 'optionsRadios7'){
					window.location.href = 'http://localhost/Administration/Report/security/natual';
				}
				else if ($(this).attr('id') == 'optionsRadios2'){
					window.location.href = 'http://localhost/Administration/Report/security/legal';
				}
				break;
		}
	});

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
			var data1 = "sec_acc=" + $('.form-horizontal').find('#id').val();
			$.ajax({
				type:"POST",
			    dataType:"json",
			    url:"/Administration/Report_loss_capital/report_loss_capital",
		        data:data1,
		        async:false,
		        success:function(result){
		        	console.log(result);
		        },
		        error:function(msg){
		        	console.log(msg);
		        	state1 = false;
		        }
			});
			if (state1)
				$('#dialog_Cap').dialog("open");
		}

		return false;
	});

	$('#submit_Sec1').click(function(){
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
			var data1 = "form-identity_num=" + $('.form-horizontal').find('#id').val() + "&"
	        			 + "type=" + $('.form-horizontal').find('input[name="optionsRadios"]:checked').val();
			$.ajax({
				type:"POST",
			    dataType:"json",
			    url:"/Administration/Report/natural_if_valid",
		        data:data1,
		        async:false,
		        success:function(result){
		        	console.log(result);
		        },
		        error:function(msg){
		        	console.log(msg);
		        	state1 = false;
		        }
			});
			if (state1)
				$('#dialog_Sec1').dialog("open");
		}

		return false;
	});

	$('#submit_Sec2').click(function(){
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
			var data1 = "sec_acc=" + $('.form-horizontal').find('#id').val();
			$.ajax({
				type:"POST",
			    dataType:"json",
			    url:"/Administration/Report/natural_if_valid",
		        data:data1,
		        async:false,
		        success:function(result){
		        	console.log(result);
		        },
		        error:function(msg){
		        	console.log(msg);
		        	state1 = false;
		        }
			});
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
	        	var data = "sec_acc=" + $('.form-horizontal').find('#id').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Report_loss_capital/confirm_report",
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

	$( "#dialog_Sec1" ).dialog({
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
	        	var data = "form-identity_num=" + $('.form-horizontal').find('#id').val() + "&"
	        			 + "type=" + $('.form-horizontal').find('input[name="optionsRadios"]:checked').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Report/Frozen",
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

	$( "#dialog_Sec2" ).dialog({
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
	        	var data = "sec_acc=" + $('.form-horizontal').find('#id').val();
	          	$( this ).dialog( "close" );
	          	$.ajax({
		          	type:"POST",
			        dataType:"json",
			        url:"/Administration/Report_loss_capital/confirm_report",
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