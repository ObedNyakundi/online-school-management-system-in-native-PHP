		
		
		<footer id="footer" class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright text-center">
							Copyright &copy; <?php echo $y=2000+date('y');?> School Management System</a>. All rights reserved. Designed &amp; developed by <a href="http://www.facebook.com/AceNyakundi" target="_blank">Obed Nyakundi</a>
						</p>
					</div>
				</div>
			</div>
		</footer>
		
		<a href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

		<!-- Essential jQuery Plugins
		================================================== -->
		<!-- Main jQuery -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <!-- Main javascript modified for makers hub-->
        <script src="js/makers.js"></script>
		<!-- Single Page Nav -->
        <script src="js/jquery.singlePageNav.min.js"></script>
		<!-- Twitter Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
		<!-- jquery.fancybox.pack -->
        <script src="js/jquery.fancybox.pack.js"></script>
		<!-- jquery.mixitup.min -->
        <script src="js/jquery.mixitup.min.js"></script>
		<!-- jquery.parallax -->
        <script src="js/jquery.parallax-1.1.3.js"></script>
		<!-- jquery.countTo -->
        <script src="js/jquery-countTo.js"></script>
		<!-- jquery.appear -->
        <script src="js/jquery.appear.js"></script>
		<!-- Contact form validation -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
		<!-- Google Map -->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyApI3pCxUiWNyIy_884pMmw1LTJ4gAbRiw "></script>
		<!-- jquery easing -->
        <script src="js/jquery.easing.min.js"></script>
		<!-- jquery easing -->
        <script src="js/wow.min.js"></script>
		<script>
			var wow = new WOW ({
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       120,          // distance to the element when triggering the animation (default is 0)
				mobile:       false,       // trigger animations on mobile devices (default is true)
				live:         true        // act on asynchronously loaded content (default is true)
			  }
			);
			wow.init();
		</script> 
		<!-- Custom Functions -->
        <script src="js/custom.js"> </script>
		
		<script type="text/javascript">

		
		/****************************************
			method to hide and unhide components
		****************************************/
	function hide(x){
		document.getElementById(x).style.display="none";
	};

	function unhide(x){
		document.getElementById(x).style.display="inline-block";
	};



	function showresult(str,opt,disp) {
    if (str == "") {
        document.getElementById(disp).innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(disp).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","livesearch.php?act="+opt+"&&q="+str,true);
        xmlhttp.send();
    }
}



	function showevents(str,opt) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","livesearch2.php?act="+opt+"&&q="+str,true);
        xmlhttp.send();
    }
}


//on-page jquery animations JS and asyncronous JS
		function strip1(e) {
		var Textf=document.getElementById(e);
		var repl= /[^a-z 0-9]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};

		//strip letters and special characters for phone num.
		function strip2(e,len){
		var text0=document.getElementById(e).value;
		var text1=document.getElementById(e);
		if (text0.length<len) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9]/gi;
		Textf.value=Textf.value.replace(repl,"");
		}
		else
		{
			text1.value = text0.substr(0,len);
			//slice();
		}
		};

				//strip letters and special characters in an email.
function strip3(e) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9a-z.@_]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};

//confirm the password is more than 6 characters
function checker(x,x2){
	var passwd=document.getElementById(x).value;
	if (passwd.length==0) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="*";
	}
	else if (passwd.length <4) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-down'></i> poor";
	}else if (passwd.length >=4 && passwd.length<6) {
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-down'></i> It looks better now...";
	}
	else if(passwd.length>=6 && passwd.length <8){
		document.getElementById(x2).style.color="light-green";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-up'></i> A lot better. But you can add more";
	}else if(passwd.length>=8){
		document.getElementById(x2).style.color="#green";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-up'></i> Perfect!";
	}
	else{
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
}

//confirm the password is more than 6 characters
function checker2(x,x1,x2){
	var passwd=document.getElementById(x).value;
	var pass2=document.getElementById(x1).value;
	if (passwd.length==0) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
	else if (passwd.length <6) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-down'></i> poor";
	}else if(passwd.length>=6 && pass2.length<6){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-up'></i> Good!";
	} else if(passwd.length>=6 && pass2.length>=6 && (passwd !== pass2)){
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-down'></i> Passwords mismatch";
	}else if(passwd.length>=6 && pass2.length>=6 && (passwd === pass2)){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="<i class='fa fa-thumbs-up'></i> Great!";
	}else{
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
}
			$(function(){

				/* ========================================================================= */
				/*	Contact Form
				/* ========================================================================= */
				
				$('#contact-form').validate({
					rules: {
						name: {
							required: true,
							minlength: 2
						},
						email: {
							required: true,
							email: true
						},
						message: {
							required: true
						}
					},
					messages: {
						name: {
							required: "come on, you have a name don't you?",
							minlength: "your name must consist of at least 2 characters"
						},
						email: {
							required: "no email, no message"
						},
						message: {
							required: "um...yea, you have to write something to send this form.",
							minlength: "thats all? really?"
						}
					},
					submitHandler: function(form) {
						$(form).ajaxSubmit({
							type:"POST",
							data: $(form).serialize(),
							url:"process.php",
							success: function() {
								$('#contact-form :input').attr('disabled', 'disabled');
								$('#contact-form').fadeTo( "slow", 0.15, function() {
									$(this).find(':input').attr('disabled', 'disabled');
									$(this).find('label').css('cursor','default');
									$('#success').fadeIn();
								});
							},
							error: function() {
								$('#contact-form').fadeTo( "slow", 0.15, function() {
									$('#error').fadeIn();
								});
							}
						});
					}
				});
			});
		</script>
		
		</div>
    </body>
</html>