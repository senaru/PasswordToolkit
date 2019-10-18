<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      
      
  </head>
  <body>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/BrowserFS/2.0.0/browserfs.js"></script>
<script>
	
	$(document).ready(function() {  
        
        test();
        
   function test(){    
        $.ajax({
            url: 'write.php', //This is the current doc
            type: "POST",
            data: ({name: 145}),
            success: function(data){
                console.log(data);
            }
        });  
        
//        $.ajax({
//            url:'write.php',
//            data:"",
//            dataType:'json',
//            success:function(data1){
//                var y1=data1;
//                console.log(data1);
//            }
//        });
    }
    });

</script>

  </body>
</html>