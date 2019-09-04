function loginproceeds()
    { 
        //alert('hhii');
        var error= false;
        var formData = new FormData($('#loginform')[0]); 
        formData.append("sub",'sub');
        var error = true;
        
    if(error)
        {
        jQuery.ajax({
           url: '../ajax/ajax-login.php',
           type: "POST",
           data:formData,
           processData: false,
           contentType: false,
           //beforeSend: function(){ $("#logBtn").val('Connecting...');},
           success: function(result)
                {
//                alert(result);  
                var JSONObject = JSON.parse(result);
                var rslt=JSONObject['status'];
                
              // alert(result);
                if(rslt==1)
                    {
                    window.location.href="index.php";  
                    }
                    else
                    {
//                    alert('failure');
                    BootstrapDialog.show({
                    title: 'Error' +" "+" "+'Response',
                    message:JSONObject[0]['msg']
                      }); 
                    }      
           }
        });
    }
 
    }
 



// Start For first login  