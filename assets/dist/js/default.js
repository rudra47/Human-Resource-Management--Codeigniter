
var url=window.location.href;
var pos=url.indexOf('author')
var base_path=url.substring(0,pos).replace('index.php/','');

$(document).ready(function($) {
 
 //delete confirmation
 $('.delete').click(function(){
	var del=confirm("Do You really want to delete.");						 
	if(del==true){return true;}
	else{return false;}																
 });
 
 
	 //change category on select
	 $('#by_cat').change(function(){
		var catid=$('#by_cat').val();

		if(catid!=0){
			 window.location=base_path+"author/article/index/0?cat="+catid;
		}else if(catid==0){
			 window.location=base_path+"author/article/index";	
		}
		
	 });
 
 
 
 
 
});  



//check for checked box.

var siteurl=base_path+"index.php/author/";

 function checkConfirm(){
	var r_value=0;
	var isChecked=false;
	var check_num=document.actionform.check.length;
	for(var i=0; i<check_num; i++){
		if(document.actionform.check[i].checked){						 
			var r_value=document.actionform.check[i].value;
			isChecked=true;
		}
	}
	if(isChecked==false){
		alert("Please first make a selection from the list");
		return false;
	}else{
		return r_value;
	}
 }
 
//delete confirmation
 function deleteRecord(data){
	
	var checkconfirm=checkConfirm();
	
	if(checkconfirm != false){			
		var del=confirm("Do You really want to delete?");						 
		if(del!=true){
			return false;
		}
		else{	
			var url=window.location.pathname;
			var urlArray=window.location.pathname.split('/');
			
		if(urlArray[urlArray.indexOf("index.php")+4] == undefined){ rportion	= 0;
		}else {  rportion	= urlArray[urlArray.indexOf("index.php")+4]; }
		
			if(typeof data === "undefined")
			{ window.location=siteurl+urlArray[urlArray.indexOf("index.php")+2]+"/delete/"+checkConfirm()+"/"+rportion;
			}else
			{ window.location=siteurl+urlArray[urlArray.indexOf("index.php")+2]+"/"+data+"/"+checkConfirm()+"/"+rportion;}			   	
		}			
	}else{
		return false;	
	}
	 
 }
 
// record edit function
function editRecord(data){
	var checkconfirm=checkConfirm();
	
	if(checkconfirm != false){			
		var url=window.location.pathname;
		var urlArray=window.location.pathname.split('/');
		if(urlArray[urlArray.indexOf("index.php")+4] == undefined){ rportion	= 0;
		}else {  rportion	= urlArray[urlArray.indexOf("index.php")+4]; }
		
			if(typeof data === "undefined")
			{ window.location=siteurl+urlArray[urlArray.indexOf("index.php")+2]+"/edit/"+checkConfirm()+"/"+rportion;
			}else
			{ window.location=siteurl+urlArray[urlArray.indexOf("index.php")+2]+"/"+data+"/"+checkConfirm()+"/"+rportion;}				
	}else{
		return false;	
	}			
}
