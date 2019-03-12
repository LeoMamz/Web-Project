jQuery(document).ready(function() {
	$('.datatable-1').dataTable();
	$('.dataTables_paginate').addClass("btn-group datatable-pagination");
	$('.dataTables_paginate > a').wrapInner('<span />');
	$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
	$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');

	$('.form-inline').on("click",'.inc',function(){
		$('.btn').siblings("div").last().after('<div class="form-group"><select class="select" onchange="changeType(this)"><option value="Category">Category</option><option value="Title">Title</option><option value="Press">Press</option><option value="Years(Interval)">Years(Interval)</option><option value="Author">Author</option><option value="Price(Interval)">Price(Interval)</option></select><input type="text" name="input1" class="input-large"><a class="btn btn-default dec" role="button"><i class="icon-minus"></i></a></div>');
	});
	$('.form-inline').on("click",'.dec',function(){
		$(this).parent(".form-group").addClass("tmp");
		remove();
	});

	$('.form-inline').on('focus','input',function(){
		$(this).removeClass("input-error");
	});
} );

	function changeType(e)
	{
		if ($(e).val() == "Years(Interval)" || $(e).val() == "Price(Interval)"){
			if ($(e).parent(".form-group").find(".input-large").length>0){
				$(e).parent(".form-group").find(".input-large").remove();
				$(e).after('<input type="text" name="input-pre" class="input-small"><i class="icon-minus to"></i><input type="text" name="input-aft" class="input-small">');
			}
		}
		else{
			if ($(e).parent(".form-group").find(".input-small").length>0){
				$(e).parent(".form-group").find(".input-small").remove();
				$(e).parent(".form-group").find("i").remove();
				$(e).after('<input type="text" name="input1" class="input-large">');
			}
		}
	}

	function Search()
	{
		var frm = $('form');
		var Years = "";
		var Price = "";
		var Category = "";
		var Title = "";
		var Press = "";
		var Author = "";
		var state = true;

		$(frm).find("input").each(function(){
			if ($(this).val() == "") {
				state = false;
				$(this).addClass("input-error");
			}
			else{
				$(this).removeClass("input-error");
			}
		});

		$(frm).children('div').each(function(){
			if($(this).children('select').val() == "Years(Interval)")
			{
				if ($(this).children("input[name='input-pre']").val() > $(this).children("input[name='input-aft']").val())
				{
					state = false;
					$(this).children('input').addClass("input-error");
				}
				if (Years != "") Years += "*"
				Years += $(this).children("input[name='input-pre']").val() + "-" + $(this).children("input[name='input-aft']").val();
			}
			else if($(this).children('select').val() == "Price(Interval)")
			{
				if ($(this).children("input[name='input-pre']").val() > $(this).children("input[name='input-aft']").val())
				{
					state = false;
					$(this).children('input').addClass("input-error");
				}
				if (Price != "") Price += "*"
				Price += $(this).children("input[name='input-pre']").val() + "-" + $(this).children("input[name='input-aft']").val();
			}
			else if($(this).children('select').val() == "Category")
			{
				if (Category != "") Category += "*"
				Category += $(this).children("input[name='input1']").val();
			}
			else if($(this).children('select').val() == "Title")
			{
				if (Title != "") Title += "*"
				Title += $(this).children("input[name='input1']").val();
			}
			else if($(this).children('select').val() == "Press")
			{
				if (Press != "") Press += "*"
				Press += $(this).children("input[name='input1']").val();
			}
			else if($(this).children('select').val() == "Author")
			{
				if (Author != "") Author += "*"
				Author += $(this).children("input[name='input1']").val();
			}
		});

		var data = "Years=" + Years
				 + "&Price=" + Price
				 + "&Category=" + Category
				 + "&Title=" + Title
				 + "&Press=" + Press
				 + "&Author=" + Author;

		if (!state) return false;
		$.ajax({
	        type:"POST",
	        dataType:"json",
	        url:"/Administration/Search/search",
	        data:data,
	        async:false,
	        success:function(result){
	            console.log(result);
	            $("tbody").empty();
	            for (var i = result.length - 1; i >= 0; i--) {
	            	console.log(result[i].title);
	            	console.log(i);
	            	$('tbody').append("<tr><td>" + result[i].bno      + "</td>"
	            					     +"<td>" + result[i].category + "</td>"
	            					     +"<td>" + result[i].title    + "</td>"
	            					     +"<td>" + result[i].press    + "</td>"
	            					     +"<td>" + result[i].year     + "</td>"
	            					     +"<td>" + result[i].author   + "</td>"
	            					     +"<td>" + result[i].price    + "</td>"
	            					     +"<td>" + result[i].total    + "</td>"
	            					     +"<td>" + result[i].stock    + "</td>"
	            					 +"</tr>");
	            }
	        },
	        error:function(msg){
	            console.log(msg);
	            alert("SOMETHING out of expectation happened");
	        }
    	});
		return false;
	}

	function Search_all()
	{
		$.ajax({
	        type:"POST",
	        dataType:"json",
	        url:"/LibraryManagementSystem/Search/search_all",
	        async:false,
	        success:function(result){
	            console.log(result);
	            $("tbody").empty();
	            for (var i = result.length - 1; i >= 0; i--) {
	            	console.log(result[i].title);
	            	$('tbody').append("<tr><td>" + result[i].bno      + "</td>"
	            					     +"<td>" + result[i].category + "</td>"
	            					     +"<td>" + result[i].title    + "</td>"
	            					     +"<td>" + result[i].press    + "</td>"
	            					     +"<td>" + result[i].year     + "</td>"
	            					     +"<td>" + result[i].author   + "</td>"
	            					     +"<td>" + result[i].price    + "</td>"
	            					     +"<td>" + result[i].total    + "</td>"
	            					     +"<td>" + result[i].stock    + "</td>"
	            					 +"</tr>");
	            }
	        },
	        error:function(msg){
	            console.log(msg);
	            alert("SOMETHING out of expectation happened");
	        }
    	});
    	return false;
	}

	function remove()
	{
		$('.tmp').remove('.tmp');
	}