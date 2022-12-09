<?php
session_start(); 
if(!isset($_POST['unox']) || $_POST['unox']!=$_SESSION['unox']) {sleep(2);exit;} // appel depuis uno.php
?>
<?php
include('../../config.php');
include('lang/lang.php');
// ********************* actions *************************************************************************
if(isset($_POST['action'])) {
	switch($_POST['action']) {
		// ********************************************************************************************
		case 'plugin': ?>
		<style>pre{color:#000;background-color:#cddc39;margin:0 20px 10px;}</style>
		<div class="blocForm">
			<h2>Htaccess</h2>
			<p><?php echo T_("Edit your main .htaccess file.");?></p>
			<textarea id="htcontent" rows="20" style="width:100%"></textarea>
			<div class="bouton" style="margin:5px 0;" onClick="f_save_htaccess(document.getElementById('htcontent').value);" title="<?php echo T_("Save settings");?>"><?php echo T_("Save");?></div>
			<h3><?php echo T_("Help");?></h3>
			<p>- <?php echo T_("Save empty for default .htaccess");?></p>
			<p>- <?php echo T_("Redirection");?>&nbsp;http => https :
				<pre><?php echo "# Put this after : RewriteEngine On"."\r\n"."RewriteCond %{HTTPS} off"."\r\n"."RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R,L]"; ?></pre>
			</p>
			<div class="clear"></div>
		</div>
		<?php break;
		// ********************************************************************************************
		case 'load':
		if(file_exists('../../../.htaccess')) echo file_get_contents('../../../.htaccess');
		else die();
		break;
		// ********************************************************************************************
		case 'save':
		if(isset($_POST['cont'])) {
			$cont = $_POST['cont'];
			if(empty($cont)) $cont = '# CMSUno - HTACCESS auto'."\r\n".
			'Options -Indexes'."\r\n".
			'Allow from all'."\r\n\r\n".
			'<IfModule mod_deflate.c>'."\r\n".
			"\t".'SetOutputFilter DEFLATE'."\r\n".
			"\t".'SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png)$ no-gzip'."\r\n".
			'</IfModule>'."\r\n\r\n".
			'<IfModule mod_expires.c>'."\r\n".
			"\t".'ExpiresActive On'."\r\n".
			"\t".'ExpiresDefault "access plus 7200 seconds"'."\r\n".
			"\t".'ExpiresByType image/jpg "access plus 1 week"'."\r\n".
			"\t".'ExpiresByType image/jpeg "access plus 1 week"'."\r\n".
			"\t".'ExpiresByType image/png "access plus 1 week"'."\r\n".
			"\t".'ExpiresByType text/javascript "access plus 7200 seconds"'."\r\n".
			"\t".'ExpiresByType application/x-javascript "access plus 7200 seconds"'."\r\n".
			"\t".'ExpiresByType application/javascript "access plus 7200 seconds"'."\r\n".
			'</IfModule>'."\r\n";
			if(file_put_contents('../../../.htaccess', $cont)) echo T_('Backup performed');
			else echo '!'.T_('Impossible backup');
		}
		break;
		// ********************************************************************************************
	}
	clearstatcache();
	exit;
}
?>
