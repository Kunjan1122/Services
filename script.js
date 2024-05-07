
$(document).ready(function(){
    // $('#home').addClass('active'); 
    
    $('#contact-form').validate({
        rules:{
            name:{
                required:true,
                maxlength:20
            },
            email:{
                required:true,
                email:true,
                maxlength:50
            },
            phone_number:{
                required:true,
                digits: true,
                maxlength:10,
                minlength:10
            }
        } 
    }); 
});
