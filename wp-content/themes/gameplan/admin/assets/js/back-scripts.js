// JavaScript Document
var $=jQuery.noConflict();

		$(document).on('click','input[type="checkbox"]',function(){		 
       //$('input[type="checkbox"]').click(function(){
		
            if($(this).attr("value")=="red"){
                $(".red").toggle();
            }
            
        });
	   var countChecked = function() {
				 
				
			  var n = jQuery( "input:checked" ).length;
			   
			  jQuery( "input#le_count" ).val( n + (n === 0 ));
			  if(jQuery(this).attr("checked") == "checked"){
			  var disp_val=$(this).attr('disp_val');
			  var temp=disp_val.split('_');
			var test = $(this).attr('for');
			
			     var html='<tr id="tr_'+disp_val+'" class="red" ><th>set</th><td><input type="number" name="set_'+disp_val+'" value="" /></td><th>Reps</th><td><input type="number" name="reps_'+disp_val+'" value="" required /></td><th>Rest</th><td><input type="number" name="rest_'+disp_val+'" value="" required /></td></tr>';
			  	
				if(test == 'loseweight')
			{
				$("#data_table2_"+temp[0]).append(html);
			}
			else
			{
				$("#data_table_"+temp[0]).append(html);
			}
			  }
				jQuery("input[type='checkbox']").each(function(){
					if(jQuery(this).attr("checked")!== "checked")
					{
					
						var count=jQuery(this).attr("disp_val");
							
						jQuery("#tr_"+count).remove();	
					}
				});
				
		};
			
 		 $(document).on('click','input[type="checkbox"]', countChecked ); 
		//	jQuery( "input[type=checkbox]" ).on( "click", countChecked ); 
			
			
			
 
 
    /*var custom_uploader;
 
 
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
   });
 */

	 
	   



 function displayVals() {
  var singleValues = $( "#myselect" ).val();
  var days = $("#exe_days").val();
  var exe_days = days+"_"+singleValues;
 // document.getElementById("demo").innerHTML = "" + prg_name;
 //document.getElementById("demo").value = "prg_name";
 document.getElementById("title").setAttribute('value',exe_days);
}
 
$( "#myselect , #exe_days " ).change( displayVals );
displayVals();

