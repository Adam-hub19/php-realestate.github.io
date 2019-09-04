var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() 
        { 
             var formData = new FormData($('#edit-property-form')[0]);
             formData.append("sub",'sub');
             var error = true;
            
        if(error)
        {
           // alert(error);
        jQuery.ajax({
         
           url: 'ajax/ajax-edit-property.php',
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
                   //    alert('failure');
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
        $("#edit-property-form").validate({
            rules: {
                
                building_name:"required",
                contact_no:"required",
                address:"required",  
           },
            messages: {
                building_name:"Please enter Building Name",
                contact_no:"Please enter contact_no",
                address:"Please enter Address",
            }
        });

    });

}();
