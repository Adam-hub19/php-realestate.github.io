var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() 
        { 
             var formData = new FormData($('#add-property-form')[0]);
             formData.append("sub",'sub');
             var error = true;
           //  alert(formData[name]);
        if(error)
        {
            //alert(error); 
        jQuery.ajax({
         
           url: 'ajax/ajax-add-property.php',
           type: "POST",
           data:formData,
           processData: false,
           contentType: false,
           //beforeSend: function(){ $("#logBtn").val('Connecting...');},
         success: function(result)
                {
                alert(result);  
                var JSONObject = JSON.parse(result);
                var rslt=JSONObject['status'];
               
                if(rslt==1)
                {
                    window.location.href="manage-property.php";        
                }
                else
                {
                   // alert('failure');
                    BootstrapDialog.show({
                    title: 'Error' +" "+" "+'Response',
                    message:JSONObject['msg']
                      }); 
                }      
           }
        });
    }
}
    });

   $().ready(function() {
//       var email = $("#email").val()
        $("#add-property-form").validate({
            rules: {
                
                location_id:"required",
                name:"required",
                propert_des:"required",
                email_id:"required",
                contact_no:"required",
                
           },
            messages: {
               location_id:"Please enter Location ID ",
               name:"Please enter Name",
               propert_des:"Please enter Propert Description",
               email_id:"Please enterEemail ID",
               contact_no:"Please enter Contact NO",
               
            }
        });

    });

}();

