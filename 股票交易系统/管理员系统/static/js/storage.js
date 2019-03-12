jQuery(document).ready(function() {

	$('.form-horizontal').on('focus','input',function(){
		$(this).removeClass("input-error");
	});

} );

	function confirm(frm)
	{
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
		if (state == false) return false;
		else if (state == true) return true;
	}

	function storage()
	{
		var frm = $('form');
		var Year = "";
		var Price = "";
		var Category = "";
		var Title = "";
		var Press = "";
		var Author = "";
		var Bno = "";
		var Num = "";
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
			if ($(this).children('label').text() == "Bno"){
				Bno += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Title"){
				Title += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Author"){
				Author += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Category"){
				Category += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Press"){
				Press += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Year"){
				Year += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Price"){
				Price += $(this).find('input').val();
			}
			else if ($(this).children('label').text() == "Number"){
				Num += $(this).find('input').val();
			}
		});

		var data = "Bno=" + Bno
				 + "&Price=" + Price
				 + "&Category=" + Category
				 + "&Title=" + Title
				 + "&Press=" + Press
				 + "&Author=" + Author
				 + "&Num=" + Num
				 + "&Year=" + Year;

		if (!state) return false;
		$.ajax({
	        type:"POST",
	        dataType:"json",
	        url:"/LibraryManagementSystem/Storage/storage",
	        date:data,
	        async:false,
	        success:function(result){
	            console.log(result);
	        },
	        error:function(msg){
	            console.log(msg);
	            alert("SOMETHING out of expectation happened");
	        }
    	});
    	return false;
	}