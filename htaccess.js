//
// CMSUno
// Plugin Htaccess
//
function f_load_htaccess(){
	//jQuery.post('uno/plugins/htaccess/htaccess.php',{'action':'load','unox':Unox},function(r){
	//	document.getElementById('htcontent').value=r;
	//});



	let x=new FormData();
	x.set('action','load');
	x.set('unox',Unox);
	fetch('uno/plugins/htaccess/htaccess.php',{method:'post',body:x})
	.then(r=>r.text())
	.then(function(r){
		document.getElementById('htcontent').value=r;
	});
}
//
function f_save_htaccess(f){
	let x=new FormData();
	x.set('action','save');
	x.set('unox',Unox);
	x.set('cont',f);
	fetch('uno/plugins/htaccess/htaccess.php',{method:'post',body:x})
	.then(r=>r.text())
	.then(function(r){
		f_alert(r);
		f_load_htaccess();
	});
}
//
f_load_htaccess();
