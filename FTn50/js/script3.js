window.onload=function(){
	document.getElementById("output").innerHTML="Hello!";
	document.getElementById("form").onsubmit=function yoyo()
	{
		document.getElementById("output").innerHTML="dong";
	// Detect when the value of the files input changes.
		var files = document.getElementById('files');
		// Retrieve the file list from the input element
			callajax(files);
			//uploadFiles(files);	
			return false;
	}
}

function callajax(files)
{
	var ajax = new XMLHttpRequest();
    ajax.open("POST",'../reqs/gen_id.php',true);
  
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState == 4)
        {   
        if (ajax.status==403){

            document.getElementById("output2").innerHTML="error: " + ajax.status + " retry...";
            setTimeout( ajax1(), 3000 );

          } else if (ajax.status==200 || window.location.href.indexOf("http")==-1 || ajax.responseText != 'failed'){

            document.getElementById("output2").innerHTML="http://localhost/FTn50/videos/"+ajax.responseText+"/"+get_file_name(files.value);
			var file_id=ajax.responseText;	selectElementContents(document.getElementById("output2"));
	
            uploadFiles(files,file_id);
          } else {
            document.getElementById("output2").innerHTML="error: " + ajax.status;
          }

        }
    }       

    ajax.send(null);
}


function selectElementContents(el) {
    var range = document.createRange();
    range.selectNodeContents(el);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
}

function uploadFiles(files,file_id){
	// Create a new HTTP requests, Form data item (data we will send to the server) and an empty string for the file paths.
	xhr = new XMLHttpRequest();
	data = new FormData();
	//data.append('password',document.getElementById('password').value);
	//data.append('privacy',document.getElementById('privacy').value);
	data.append('file_id',file_id);
	var fileInput = files;
	data.append("files",files.files[0]);
	
	document.getElementById("output").innerHTML="start";
	
	// Open and send HHTP requests to upload.php
		
xhr.onreadystatechange = function () {
    if (xhr.readyState < 4)                         // while waiting response from server
        document.getElementById('output').innerHTML = "Uploading...";
    else if (xhr.readyState === 4) {                // 4 = Response from server has been completely loaded.
        if (xhr.status == 200 && xhr.status < 300) // http status between 200 to 299 are all successful
        {
			var json = JSON.parse(xhr.responseText);
			document.getElementById("output").innerHTML =json.count + ' Files uploaded!' +'\n' + json.pass //+ json.url +' is your url'  ;
			//document.getElementById("output").innerHTML =xhr.responseText;
		}
	}
}
	xhr.open('POST', "uploader3.php", true);
	xhr.send(this.data);
}


function get_file_name(myString)
{
	var pathElements = myString.replace(/\/$/, '').split('\\');
var lastFolder = pathElements[pathElements.length - 1];
	return lastFolder;
}


$(function() {
	
	/* variables */
	var status = $('.status');
	var percent = $('.percent');
	var bar = $('.bar');
	
	/* submit form with ajax request */
	$('form').ajaxForm({

		/* set data type json */

		/* reset before submitting */
		beforeSend: function() {
			status.fadeOut();
			bar.width('0%');
			percent.html('0%');
		},

		/* progress bar call back*/
		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + '%';
			bar.width(pVel);
			percent.html(pVel);
		},

	});
});