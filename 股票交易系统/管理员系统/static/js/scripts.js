
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch([
                    "static/img/backgrounds/2.jpg"
                  , "static/img/backgrounds/3.jpg"
                  , "static/img/backgrounds/1.jpg"
                 ], {duration: 3000, fade: 750});
    
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"]').on('focus', function() {
    	$(this).removeClass('input-error');
    });
});

function Login(frm){
    //alert("aaa");
        
    $('.login-form').find('input[type="text"], input[type="password"]').each(function(){
        if( $(this).val() == "" ) {
            $(this).addClass('input-error');
        }
        else {
            $(this).removeClass('input-error');
        }
    });

    if ($("input[name='form-username']").attr("class").match("input-error") != null ||
        $("input[name='form-password']").attr("class").match("input-error") != null)
    {
        return false;
    }
        

    var data = "form-username=" + $("input[name='form-username']").val() +
               "&form-password=" + $("input[name='form-password']").val();

    $.ajax({
        type:"POST",
        dataType:"json",
        url:"/Administration/Login/log_in",
        data:data,
        async:false,
        success:function(result){
            console.log(result);
            //alert("SUCCESS!");
            if (result.ifsuccess){
                window.location.href='Manage';
            }
            else{
                alert("WRONG INPUT!!!\nTRY AGAIN!");
            }
        },
        error:function(msg){
            console.log(msg);
            alert("SOMETHING out of expectation happened");
        }
    });

     return false;
    
}
