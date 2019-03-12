jQuery(document).ready(function() {

	if ($('.form-horizontal').find('input[id="optionsRadios1"]:checked').val() == "Yes")
	{
		$('.form-horizontal').find('input[id="optionsRadios1"]:checked').parents('.control-group').after('<div class="control-group new"><label class="control-label" for="basicinput8">Proxy ID. number</label><div class="controls"><input type="text" id="basicinput8" placeholder="Type something here..." class="span8"></div></div>');
	}

	var isProxyNum = false;

	$('.form-horizontal').on('click',':radio',function(){
		switch($(this).attr("name"))
		{
			case 'optionsRadios':
			case 'optionsRadios3':
				if ($(this).attr('id') == 'optionsRadios7'){
					window.location.href = 'http://localhost/Administration/Create/security/natual';
				}
				else if ($(this).attr('id') == 'optionsRadios2'){
					window.location.href = 'http://localhost/Administration/Create/security/legal';
				}
				break;
			case 'optionsRadios2':
				if ($(this).attr('id') == 'optionsRadios6' && !isProxyNum){
					$(this).parents('.control-group').after('<div class="control-group new"><label class="control-label" for="basicinput8">Proxy ID. number</label><div class="controls"><input type="text" id="basicinput8" placeholder="Type something here..." class="span8"></div></div>');
					isProxyNum = true;
				}
				else if ($(this).attr('id') == 'optionsRadios5'){
					$(this).parents('.control-group').siblings('.new').remove();
					isProxyNum = false;
				}
				break;
		}
	});

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
			var state1 = true;
			var data1 = "form-name=" + $('.form-horizontal').find('input[id="basicinput"]').val() + "&"
					  + "form-gender=" + $('.form-horizontal').find('input[name="optionsRadios1"]:checked').val() + "&"
					  + "form-identity_num=" + $('.form-horizontal').find('input[id="basicinput2"]').val() + "&"
					  + "form-address=" + $('.form-horizontal').find('input[id="basicinput3"]').val() + "&"
					  + "form-occupation=" + $('.form-horizontal').find('input[id="basicinput4"]').val() + "&"
					  + "form-education=" + $('.form-horizontal').find('input[id="basicinput5"]').val() + "&"
					  + "form-company=" + $('.form-horizontal').find('input[id="basicinput6"]').val() + "&"
					  + "form-tel=" + $('.form-horizontal').find('input[id="basicinput7"]').val() + "&"
					  + "form-if_agency=" + ($('.form-horizontal').find('input[name="optionsRadios2"]:checked').val() == "Yes" ? 1 : 0) + "&"
					  + "form-agent_id=" + $('.form-horizontal').find('input[id="basicinput8"]').val();
			$('#dialog_Sec1').find('#sec_id_b').empty().append($('.form-horizontal').find('input[name="optionsRadios"]:checked').val());
			$('#dialog_Sec1').find('#id_1').empty().append($('.form-horizontal').find('input[id="basicinput"]').val());
			$('#dialog_Sec1').find('#id_2').empty().append($('.form-horizontal').find('input[name="optionsRadios1"]:checked').val());
			$('#dialog_Sec1').find('#id_3').empty().append($('.form-horizontal').find('input[id="basicinput2"]').val());
			$('#dialog_Sec1').find('#id_4').empty().append($('.form-horizontal').find('input[id="basicinput3"]').val());
			$('#dialog_Sec1').find('#id_5').empty().append($('.form-horizontal').find('input[id="basicinput4"]').val());
			$('#dialog_Sec1').find('#id_6').empty().append($('.form-horizontal').find('input[id="basicinput5"]').val());
			$('#dialog_Sec1').find('#id_7').empty().append($('.form-horizontal').find('input[id="basicinput6"]').val());
			$('#dialog_Sec1').find('#id_8').empty().append($('.form-horizontal').find('input[id="basicinput7"]').val());
			$('#dialog_Sec1').find('#id_9').empty().append($('.form-horizontal').find('input[name="optionsRadios2"]:checked').val());
			$('#dialog_Sec1').find('#id_10').empty().append($('.form-horizontal').find('input[id="basicinput8"]').val());
			
			if (state1)
				$('#dialog_Sec1').dialog("open");
		}

		return false;
	});

	$('#submit2').click(function(){
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
			var data1 = "form-reg_id=" + $('.form-horizontal').find('input[id="basicinput9"]').val() + "&"
					  + "form-license=" + $('.form-horizontal').find('input[id="basicinput10"]').val() + "&"
					  + "form-corp_rep_name=" + $('.form-horizontal').find('input[id="basicinput11"]').val() + "&"
					  + "form-corp_rep_id=" + $('.form-horizontal').find('input[id="basicinput13"]').val() + "&"
					  + "form-corpname=" + $('.form-horizontal').find('input[id="basicinput14"]').val() + "&"
					  + "form-corp_tel=" + $('.form-horizontal').find('input[id="basicinput15"]').val() + "&"
					  + "form-corp_address=" + $('.form-horizontal').find('input[id="basicinput16"]').val() + "&"
					  + "form-auth_name=" + $('.form-horizontal').find('input[id="basicinput17"]').val() + "&"
					  + "form-auth_id=" + $('.form-horizontal').find('input[id="basicinput18"]').val() + "&"
					  + "form-auth_tel=" + $('.form-horizontal').find('input[id="basicinput19"]').val() + "&"
					  + "form-auth_addr=" + $('.form-horizontal').find('input[id="basicinput20"]').val();

			
			if (state1)
				$('#dialog_Sec2').dialog("open");
		}

		return false;
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
	        	var data = "form-name=" + $('.form-horizontal').find('input[id="basicinput"]').val() + "&"
						  + "form-gender=" + $('.form-horizontal').find('input[name="optionsRadios1"]:checked').val() + "&"
						  + "form-identity_num=" + $('.form-horizontal').find('input[id="basicinput2"]').val() + "&"
						  + "form-address=" + $('.form-horizontal').find('input[id="basicinput3"]').val() + "&"
						  + "form-occupation=" + $('.form-horizontal').find('input[id="basicinput4"]').val() + "&"
						  + "form-education=" + $('.form-horizontal').find('input[id="basicinput5"]').val() + "&"
						  + "form-company=" + $('.form-horizontal').find('input[id="basicinput6"]').val() + "&"
						  + "form-tel=" + $('.form-horizontal').find('input[id="basicinput7"]').val() + "&"
						  + "form-if_agency=" + ($('.form-horizontal').find('input[name="optionsRadios2"]:checked').val() == "Yes" ? 1 : 0) + "&"
						  + "form-agent_id=" + $('.form-horizontal').find('input[id="basicinput8"]').val();
			
				$( this ).dialog( "close" );
	          	$.ajax({
					type:"POST",
				    dataType:"json",
				    url:"/Administration/Create/create_natural_sec",
			        data:data,
			        async:false,
			        success:function(result){
			        	console.log(result);
			        	alert('your account is: '+result.natural_sec_acc_info[0].sec_acc);
			        	alert('your password is: '+result.natural_sec_acc_info[0].sec_pwd);
			        },
			        error:function(msg){
			        	console.log(msg);
			        	state1 = false;
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
	        	var data  = "form-reg_id=" + $('.form-horizontal').find('input[id="basicinput9"]').val() + "&"
					  	  + "form-license=" + $('.form-horizontal').find('input[id="basicinput10"]').val() + "&"
						  + "form-corp_rep_name=" + $('.form-horizontal').find('input[id="basicinput11"]').val() + "&"
						  + "form-corp_rep_id=" + $('.form-horizontal').find('input[id="basicinput13"]').val() + "&"
						  + "form-corpname=" + $('.form-horizontal').find('input[id="basicinput14"]').val() + "&"
						  + "form-corp_tel=" + $('.form-horizontal').find('input[id="basicinput15"]').val() + "&"
						  + "form-corp_address=" + $('.form-horizontal').find('input[id="basicinput16"]').val() + "&"
						  + "form-auth_name=" + $('.form-horizontal').find('input[id="basicinput17"]').val() + "&"
						  + "form-auth_id=" + $('.form-horizontal').find('input[id="basicinput18"]').val() + "&"
						  + "form-auth_tel=" + $('.form-horizontal').find('input[id="basicinput19"]').val() + "&"
						  + "form-auth_addr=" + $('.form-horizontal').find('input[id="basicinput20"]').val();
			
				$( this ).dialog( "close" );
	          	$.ajax({
					type:"POST",
				    dataType:"json",
				    url:"/Administration/Create/create_corp_sec",
			        data:data,
			        async:false,
			        success:function(result){
			        	console.log(result);
			        },
			        error:function(msg){
			        	console.log(msg);
			        	state1 = false;
			        }
				});
	        },
	        Cancel: function() {
	          $( this ).dialog( "close" );
	        }
	    }
	});

} );