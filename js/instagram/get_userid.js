

        function webservice_call(username){

			var webMethod;
	        var divToBeWorkedOn = "#success_result_text";
	        webMethod = "http://pinstagramid.com:80/service.asmx/get_ID";

	        var parameters = "{'userName':'" + username + "'}";

            $.ajax({
                type: 'POST',
                url: webMethod,
                data: parameters,
                contentType: "application/json; charset=utf-8",
                //crossDomain: true,
                dataType: "json",
                async: false,
                success: function (msg) {

                // Ajax loading - On
                document.getElementById("ajax-progress-dialog").style.visibility = 'hidden';

                document.getElementById('success_box').style.display = 'visible';

		        var data = msg.d;
		        var elem = document.getElementById("success_result_text");
		        if (data == '0') {
		            elem.value = 'Bad Username :-(';
		            document.getElementById("success_text").innerHTML = "Ohhh we're sorry.. Something went wrong... Try again";
		            //return;
		        }
		        document.getElementById("success_text").innerHTML = "We got it !! Now you can copy, and paste it wherever you want...";
		        elem.value = data;
                   
                //return data;
                },
                error: function (e) {

                document.getElementById('success_box').style.display = 'visible';

                // Ajax loading - On
                document.getElementById("ajax-progress-dialog").style.visibility = 'hidden';
                document.getElementById("success_text").innerHTML = "Ohhh we're sorry.. Something went wrong... Try again";
		        var elem1 = document.getElementById("success_result_text");
		        elem1.value = 'Error';
                //return 'Error';
                }
            });
        }

        function get_id() {

            document.getElementById("ajax-progress-dialog").style.visibility = 'visible';
            document.getElementById('success_box').style.display = 'none';
            var textbox_value = document.getElementById('username_textbox').value;

            var id = webservice_call(textbox_value);
            //document.getElementById('success_result').value = id;
                
            if (document.getElementById('success_box').style.display == 'none') {
                document.getElementById('success_box').style.display = 'block';
            }
        }
    