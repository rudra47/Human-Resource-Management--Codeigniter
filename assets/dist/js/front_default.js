
function getSelectionHtml() {
		var html = "";
		if (typeof window.getSelection != "undefined") {
			var sel = window.getSelection();
			if (sel.rangeCount) {
				var container = document.createElement("div");
				for (var i = 0, len = sel.rangeCount; i < len; ++i) {
					container.appendChild(sel.getRangeAt(i).cloneContents());
				}
				html = container.innerHTML;
			}
		} else if (typeof document.selection != "undefined") {
			if (document.selection.type == "Text") {
				html = document.selection.createRange().htmlText;
			}
		}
		return html;
	}	

function position(e){
			var u = ie ? event.clientY + document.documentElement.scrollTop : e.pageY;
			var l = ie ? event.clientX + document.documentElement.scrollLeft : e.pageX;
			tt.style.top = (u - h) + 'px';
			tt.style.left = (l + left) + 'px';
		}

//function to delete cookies

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	function deleteCookie(name){
		var cookies = document.cookie.split(";");
		for (var i = 0; i < cookies.length; i++) {
			var cookie = cookies[i].replace(/^\s+|\s+$/g, '');
			var regxp=/c_word_name/;
			var mtch=cookie.match(regxp);
			if(mtch != null){
				var eqPos = cookie.indexOf("=");
				var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
				document.cookie = name +"=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
				//alert("Name: "+name+"Cookie: "+cookie+"eqPos: "+eqPos);
				//alert(document.cookie );
			}
		}
		document.getElementById("clr2").innerHTML="All cleared";	
	}	
	
		
		