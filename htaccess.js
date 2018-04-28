//
// CMSUno
// Plugin Htaccess
//
function f_load_htaccess(){
	jQuery(document).ready(function(){
		jQuery.post('uno/plugins/htaccess/htaccess.php',{'action':'load','unox':Unox},function(r){
			document.getElementById('htcontent').value=r;
		});
	});
}
//
function f_save_htaccess(f){
	jQuery(document).ready(function(){
		jQuery.post('uno/plugins/htaccess/htaccess.php',{'action':'save','unox':Unox,'cont':f},function(r){
			f_alert(r);
			f_load_htaccess();
		});
	});
}
//
f_load_htaccess();
