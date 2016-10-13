function validateForm() {
			var post = document.forms["myForm"]["post"].value;
			var image = document.forms["myForm"]["image"].value;
			if ((post == null || post == "") && (image == null || image == "")) {
				var error = document.getElementById('error');
				error.innerHTML =  'You must be enter post or image or both';
				return false;
			}
		}
		
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
$(document).ready(function(){
$(".getComment").click(function() {
	 var postId = $(this).attr('postId');
	//alert("hello"+postId);
	$("#assignedToModal").modal('show');
           
           
            $.ajax({
                type: 'GET',
                url: '/GetComments/'+postId,
                dataType: 'json',
				data:"",
			    success:function(datax) {
                    GetallComments = datax;
                    $("#comments").empty();
                    var comments = new Array();
                    allUsers = [];
					//var obj = JSON.parse(GetallComments);
                    var i = 0;
					var test = false;
					var html = '<div id="remove">';
						for(i=0;i<GetallComments['allComments'].length;i++){
							html += '<div class="div" style="width:100%">';
							html+='<h5 class="text  time">'+GetallComments.allComments[i].created_at+'</h5>';
							html +='<h3 class="text">'+GetallComments.allComments[i].name+'</h3>';
							html +='<br>';
							html +='<br>';
							html+='<h4 class="text">"'+GetallComments.allComments[i].comment+'"</h4>';
							html+='</div>';
							test= true;
							
						}
						if (test){
							html += '</div>';
							comments[comments.length] = html;
							$("#comments").append(comments); 
						}
						if(!test) 
						{
							var html = '<div id="remove"><div class="div" style="width:100%">';
							html +='<br>';
							html +='<h4>No Comments for this post found</h4>';
							html +='<br>';
							html+='</div></div>';
							comments[comments.length] = html;
							$("#comments").append(comments); 
						}
                    $('.chzn-select').trigger("chosen:updated");
                   
             },error: function(errorThrown){
				 
							var html = '<div id="remove"><div class="div" style="width:100%">';
							html +='<br>';
							html +='<h3>No Comments for this post found</h3>';
							html +='<br>';
							html+='</div></div>';
							comments[comments.length] = html;
							$("#comments").append(comments); 
			 }
			 
        });
		
        });
        });
       
function remove() {
    var elem = document.getElementById('remove');
    elem.parentNode.removeChild(elem);
    return false;
}	