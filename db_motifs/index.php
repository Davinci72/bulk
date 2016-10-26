<?php require ('auth/auth.php'); 
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Enterprise Resources Planner</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css"/>
<link rel="stylesheet" href="css/libs/select2.css" type="text/css"/>
<script src="js/demo-rtl.js"></script>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/datatables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
	<script type="text/javascript" language="javascript" src="js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sRowSelect": "multi",
			"sSwfPath": "/var/www/html/amarachi/js/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"

        }
    } );
} );
	</script>
<link rel="stylesheet" type="text/css" href="css/libs/font-awesome.css"/>
<link rel="stylesheet" type="text/css" href="css/libs/nanoscroller.css"/>
<link rel="stylesheet" type="text/css" href="css/compiled/theme_styles.css"/>
<link rel="stylesheet" href="css/libs/daterangepicker.css" type="text/css"/>
<link rel="stylesheet" href="css/libs/jquery-jvectormap-1.2.2.css" type="text/css"/>
<link rel="stylesheet" href="css/libs/weather-icons.css" type="text/css"/>
<link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
 
<link rel="stylesheet" type="text/css" href="css/libs/dataTables.fixedHeader.css">
<link rel="stylesheet" type="text/css" href="css/libs/dataTables.tableTools.css">

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<script src="js/demo-rtl.js"></script>
<script>
jQuery.fn.dataTableExt.oApi.fnSetFilteringDelay =
function ( oSettings, iDelay ) {
iDelay = (iDelay && (/^[0-9]+$/.test(iDelay))) ? iDelay : 250;
var $this = this, oTimerId;
var anControl = $( 'div.dataTables_filter input:text' );
anControl.unbind( 'keyup' ).bind( 'keyup', function() {
var $$this = $this;
window.clearTimeout(oTimerId);
oTimerId = window.setTimeout(function() {
$$this.fnFilter( anControl.val() );
}, iDelay);
});
return this;
}
$(document).ready(function(){
$('#the_table').dataTable({
'bProcessing':true,
'bServerSide':true,
'sAjaxSource':'get_data.php'
}).fnSetFilteringDelay();
});
</script>

         <script>
$( "form" ).submit(function( event ) {
  if ( $( "input:first" ).val() === "correct" ) {
    $( "span" ).text( "Validated..." ).show();
    return;
  }
 
  $( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
  event.preventDefault();
});
</script> 
</head>
<body>
<div id="theme-wrapper">
<header class="navbar" id="header-navbar">
<div class="container">
<a href="index-2.html" id="logo" class="navbar-brand">
SMSKE ERP
</a>
<div class="clearfix">
<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
<ul class="nav navbar-nav pull-left">
</ul>
</div>
<div class="nav-no-collapse pull-right" id="header-nav">
<ul class="nav navbar-nav pull-right">
<li class="dropdown profile-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="img/1.jpg" alt=""/>
<span class="hidden-xs"><? echo $_SESSION['SESS_FIRST_NAME'].' '.$_SESSION['SESS_LAST_NAME']; ?></span> <b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
<li><a href="auth/logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
</ul>
</li>
<li class="hidden-xxs">
<a class="btn">
<i class="fa fa-power-off"></i>
</a>
</li>
</ul>
</div>
</div>
</div>
</header>
<div id="page-wrapper" class="container">
<div class="row">
<div id="nav-col">
<section id="col-left" class="col-left-nano">
<div id="col-left-inner" class="col-left-nano-content">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
<img alt="" src="img/1.jpg"/>
<div class="user-box">
<span class="name">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php echo htmlentities($_SESSION['username']); ?>
<i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu">
<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
<li><a href="auth/logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
</ul>
</span>
<span class="status">
<i class="fa fa-circle"></i> Online
</span>
</div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
<?php require "app/templates/side_nav.php"; ?>
</div>
</div>
</section>
<div id="nav-col-submenu"></div>
</div>
<div id="content-wrapper">
<div class="row">
<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">
<div id="content-header" class="clearfix">
  <div class="pull-right hidden-xs">
  <div class="xs-graph pull-left">
<div class="graph-label">
<b><i class="fa fa-shopping-cart"></i> 838</b> Orders
</div>
<div class="graph-content spark-orders"></div>
</div>
<div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
<div class="graph-label">
<b>&dollar;12.338</b> Revenues
</div>
<div class="graph-content spark-revenues"></div>
</div>
</div>
</div>
</div>
</div>
<div class="row"></div>
<div class="row"></div>
<div class="row">
<div class="col-lg-12">
<div class="main-box clearfix" style="min-height:500px;">
<header class="main-box-header clearfix">
<h2 class="pull-left"> </h2>
</header>
<div class="main-box-body clearfix" >
<?php
if(isset($_GET['page'])){
include 'app/index.php';
}
?>
</div>
</div>
</div>
</div>
<div class="row"></div>
</div>
</div>
<footer id="footer-bar" class="row">
<p id="footer-copyright" class="col-xs-12">
Powered by The Titan Web Engine.
</p>
</footer>
</div>
</div>
</div>
</div>
<script src="js/my_script.js" type="text/javascript"></script>
<script src="js/demo-skin-changer.js"></script>  
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.nanoscroller.min.js"></script>
<script src="js/demo.js"></script> 
 <script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.fixedHeader.js"></script>
<script src="js/dataTables.tableTools.js"></script>
<script src="js/jquery.dataTables.bootstrap.js"></script>
 
 
<script src="js/scripts.js"></script>
<script src="js/pace.min.js"></script>

 
<script src="js/moment.min.js"></script>
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-merc-en.js"></script>
<script src="js/gdp-data.js"></script>
<script src="js/flot/jquery.flot.min.js"></script>
<script src="js/flot/jquery.flot.resize.min.js"></script>
<script src="js/flot/jquery.flot.time.min.js"></script>
<script src="js/flot/jquery.flot.threshold.js"></script>
<script src="js/flot/jquery.flot.axislabels.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/skycons.js"></script>
<script src="js/select2.min.js"></script>

<script src="js/scripts.js"></script>
<script src="js/pace.min.js"></script>
 
 
<script>
	$(document).ready(function() {
		var table = $('#table-example').dataTable({
			
		});
		
	    var tt = new $.fn.dataTable.TableTools( table );
		$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
		
		var tableFixed = $('#table-example-fixed').dataTable({
			'info': false,
			'pageLength': 50
		});
		
		new $.fn.dataTable.FixedHeader( tableFixed );
	});
	</script>
    <script>
	$(document).ready(function() {
		$('#email-list li > .star > a').on('click', function() {
			$(this).toggleClass('starred');
		});
		
		$(".has-tooltip").each(function (index, el) {
			$(el).tooltip({
				placement: $(this).data("placement") || 'bottom'
			});
		});
		
		setHeightEmailContent();
		
		initEmailScroller();
	});
			$('#sel2').select2();
		
		$('#sel2Multi').select2({
			placeholder: 'Select a Country',
			allowClear: true
		});
		$('#sel3').select2();
		

	$(window).smartresize(function(){
		setHeightEmailContent();
		
		initEmailScroller();
	});
	
	function setHeightEmailContent() {
		if ($( document ).width() >= 992) {
			var windowHeight = $(window).height();
			var staticContentH = $('#header-navbar').outerHeight() + $('#email-header').outerHeight();
			staticContentH += ($('#email-box').outerHeight() - $('#email-box').height());
	
			$('#email-detail').css('height', windowHeight - staticContentH);
		}
		else {
			$('#email-detail').css('height', '');
		}
	}
	
	function initEmailScroller() {
		if ($( document ).width() >= 992) {
			$('#email-navigation').nanoScroller({
		    	alwaysVisible: false,
		    	iOSNativeScrolling: false,
		    	preventPageScrolling: true,
		    	contentClass: 'email-nav-nano-content'
		    });
			
			$('#email-detail').nanoScroller({
		    	alwaysVisible: false,
		    	iOSNativeScrolling: false,
		    	preventPageScrolling: true,
		    	contentClass: 'email-detail-nano-content'
		    });
		}
	}
	</script>

</body>

<!-- Mirrored from cube.adbee.technology/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 18 Dec 2014 05:19:50 GMT -->
</html>
