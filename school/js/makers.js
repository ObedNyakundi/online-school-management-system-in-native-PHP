






function showresult(str) {
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
        xmlhttp.open("GET","livesearch.php?act=sear&&q="+str,true);
        xmlhttp.send();
    }
}

function switch(a,b){
	//switch elements on click
	document.getElementById(a).style.display="inline-block";
	document.getElementById(b).style.display="none";

}

//function to hide an element
	function hide(x){
		document.getElementById(x).style.display="none";
	};
//another one to unhide them
	function unhide(x){
		document.getElementById(x).style.display="inline-block";
	};


function strip1(e) {
		var Textf=document.getElementById(e);
		var repl= /[^a-z 0-9]/gi;
		Textf.value=Textf.value.replace(repl,"*");	
		};
//strip letters and special characters.
function strip2(e,len) {
		var text0=document.getElementById(e).value;
		if (text0.length<13) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9]/gi;
		Textf.value=Textf.value.replace(repl,"");
		}else if(text0.length==13){
			var repl=/[^]/gi;
			Textf.value=Textf.value.replace(repl,"");
		}
		};

		//strip letters and special characters in an email.
function strip3(e) {
		var Textf=document.getElementById(e);
		var repl= /[^0-9a-z.@_]/gi;
		Textf.value=Textf.value.replace(repl,"");	
		};
		//strip special characters and numbers in a name.
function strip4(e,e1) {
		var Textf=document.getElementById(e);
		var repl= /[^a-z ]/gi;
		Textf.value=Textf.value.replace(repl,"");
		document.getElementById(e1).style.color="#6f0";
		document.getElementById(e1).innerHTML="<i class='glyphicon glyphicon-thumbs-up'></i> Use letters only!";

		if (Textf.value==="") {
		document.getElementById(e1).innerHTML="";
		//document.getElementById(e1).innerHTML="<i class='glyphicon glyphicon-thumbs-up'></i> Use letters only!";	
		}
	};
//function to verify email entered
function VerifyE(n,n1){
		var email=document.getElementById(n).value;
		var t=email.indexOf('@');
		var m= email.indexOf('.');
		var len=m+2;
		if(email.length==0){
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="";
		}else if(email.length>0 &&(t==0 || m==0)){
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="<i class='glyphicon glyphicon-thumbs-down'></i>poor";
		}else if(email.length>0 && t>0 && m>0 && len>=2){
			document.getElementById(n1).style.color="#6f0";
			document.getElementById(n1).innerHTML="<i class='glyphicon glyphicon-thumbs-up'></i> Good!";
		}else{
			document.getElementById(n1).style.color="red";
			document.getElementById(n1).innerHTML="<i class='glyphicon glyphicon-thumbs-down'></i> poor...";
		}
		}

//confirm the password is more than 6 characters
function checker(x,x2){
	var passwd=document.getElementById(x).value;
	//var pass2=document.getElementById(x1).value;
	if (passwd.length==0) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
	else if (passwd.length <6) {
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="<i class='glyphicon glyphicon-thumbs-down'></i> poor";
	}else if(passwd.length>=6 && pass2.length<6){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="<i class='glyphicon glyphicon-thumbs-up'></i> Good!";
	} else if(passwd.length>=6 && pass2.length>=6 && (passwd !== pass2)){
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="<i class='glyphicon glyphicon-thumbs-down'></i> Passwords mismatch";
	}else if(passwd.length>=6 && pass2.length>=6 && (passwd === pass2)){
		document.getElementById(x2).style.color="#6f0";
		document.getElementById(x2).innerHTML="<i class='glyphicon glyphicon-thumbs-up'></i> Great!";
	}else{
		document.getElementById(x2).style.color="red";
		document.getElementById(x2).innerHTML="";
	}
}