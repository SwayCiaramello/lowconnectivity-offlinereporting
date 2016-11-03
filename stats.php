<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
	<title>Statistics Media Library Box</title>
		<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" href="css/font.css">
	<link rel="stylesheet" href="css/structure.css">
	<link rel="prefetch" type="application/l10n" href="locales/locales.ini" />
	<script src="js/jquery.min.js"></script>
	<script src="js/downloads.js"></script>
	<script src="js/visit_count.js"></script>
	<script src="js/vc_tally.js"></script>
	<script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/l10n.js"></script>
</head>
<body onLoad="">

<?php
// Define your password
$password = "cool";
if ($_POST['txtPassword'] != $password) {
?>

<h1>Login</h1>

<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p><label for="txtpassword">Password:</label>
    <br /><input type="password" title="Enter your password" name="txtPassword" /></p>
    <p><input type="submit" name="Submit" value="Login" /></p>
</form>


<?php
}
else {
?>

<p>This is the protected content. </p>
		<span id="vc_count"></span>
    <div id="top-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
        	<a href="/content/" class="brand navbar-brand"><img src="img/LOGO_v3_small.png" width="30" alt="lbx-logo-small">&nbsp;Media Library</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span data-l10n-id="commonNavbarToggle" class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
    </div>
  <div class="container">
	<div class="lb-content">
	<section id="content">
<!-- visitor counter -->
		<div id="welcome">
			<div class="container">
				<h1 data-l10n-id="statsWelcomeDownloads"><img src="img/LOGO_v3.png">Media Library Downloads</h1>
				<p data-l10n-id="statsWelcomeDescription">Below are download statistics and user counts for this Media Library Box.</p>
			</div>
		</div>
		<div class="container">
			<div class="one-half">
				<div id="files-top" class="card">
				<h2 data-l10n-id="statsFilesTopUserCounts">User Counts</h2>
					<p id="visitors-top-statspage">No visitors yet. This probably means you haven't set the time/date on Media Library.</p>
				</div>
            </div>
			<div class="one-half">
				<div id="files-top" class="card">
					<h2 data-l10n-id="statsFilesTopDownloads">Content Downloads</h2>
          			<p id="files-top-statspage">Nothing's been downloaded yet. Why don't you download something and get this party started?</p>
        		</div>
			</div>
			<div class="one-half">
				<div id="files-top" class="card">
				<h2 data-l10n-id="statsFilesEmailReport">Email Stats Report</h2>

				<a href="javascript:void(0);" onclick="sendEmail();">Click here to email current stats report</a>
				   	<p><br>       
       		<br><br>
          	<a HREF="ssidupdate.php">Click here to change SSID</a>
          	</p>
				</div>
    	</div>
		</div>
	</section>
	</div>

	<footer id="footer">
		<div class="container">
			<p class="to-top"><a href="#welcome" data-l10n-id="commonFooterBackToTop">Back to top</a></p>
			<p data-l10n-id="commonFooterLicenceMain">The Media Library Box is Software Licensed under GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html for license details and by Lars Jung </p>
			<small data-l10n-id="commonFooterLicenceOther">All Media Library content not otherwise licensed is released under a Creative Commons NC-BY license.  </small>
		</div>
	</footer>
</div>

<?php
		error_reporting(-1);
		ob_start();
		system('/sbin/ifconfig | grep eth0');

		$dump = ob_get_contents();
		preg_match('/[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}:[A-F0-9]{2}/i', $dump, $mac);
		$mac_address = $mac[0];

		ob_end_clean();

$to = 'fullychargedreports@cru.org';
$body = 'Device MacAddr:' . $mac_address;
?>

<script language="javascript" type="text/javascript">

	var to = '<?php echo ($to); ?>';
	var body = '<?php echo htmlspecialchars($body); ?>'
	var addrdevice = '<?php echo ($mac_address); ?>';
	
	var d=new Date();
    var timestamp = d.toLocaleString();

	function sendEmail() {
			var files = jQuery('#files-top-statspage').html();
			var visitors = jQuery('#visitors-top-statspage').html();
								
			jQuery.getJSON("/dl_statistics_display.php?sortBy=counter&sortOrder=DESC&list_type=top&top-max=10&output_type=json" , function(data) {
  				  var jsonViewData = JSON.stringify(data);
  				  
				});

			
			var fullBody = 'Reporting Date: ' + timestamp + encodeURIComponent('\r\n\r\n') + body + encodeURIComponent('\r\n\r\n') + 'EventId:WYD2016' + encodeURIComponent('\r\n\r\n') + encodeURIComponent(files) +
				encodeURIComponent('\r\n\r\n') + encodeURIComponent(visitors) + encodeURIComponent('\r\n\r\n');

			window.location.href = "mailto:" + to + "?subject=Latest Reports from Wifi Box (WYD2016): " + addrdevice +
			"&body=" + fullBody;
	}
</script>
<?php
}
?>

</body>
</html>