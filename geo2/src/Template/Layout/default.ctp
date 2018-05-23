<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Language" content="en">
<title><?php echo $title_for_layout; ?></title>
<meta name="description" content="<?php echo empty($description) ? '' : $description ; ?>" />
<meta name="keywords" content="<?php echo empty($keywords) ? '' : $keywords ; ?>" />
<meta name="application-name" content="kende.com">
<meta property="og:title" content="<?php echo $title_for_layout; ?>">
<meta property="og:description" content="<?php echo empty($description) ? '' : $description ; ?>">
<meta property="og:url" content="<?php //echo Router::url( $this->here, true ); ?>">
<?php if(isset($location) && ($location['Location']['lat'] != 0)) : ?>
<meta property="place:location:longitude" content="<?php echo $location['Location']['lng']; ?>">
<meta property="place:location:latitude" content="<?php echo $location['Location']['lat']; ?>">
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/js.js"></script>
<script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "27daeeb0-f83a-4ce9-948a-a99b09ff5734", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>

<?php echo $this->fetch('css'); ?>
<?php echo $this->fetch('script'); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-231576-89', 'kende.com');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top1 navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://www.kende.com/">kende.com</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="http://www.kende.com/">Home</a></li>
					<li><a href="http://www.kende.com/events">Events</a></li>
					<!-- <li><a href="http://www.kende.com/shops">Shops</a></li> -->
					<li><a href="http://www.kende.com/search">Search</a></li>
					<li><a href="http://www.kende.com/contact">Contact</a></li>
				</ul>
				<form action="/search" method="get" class="navbar-form navbar-right" role="search" id="searchform">
					<div class="form-group">
						<input type="text" name="name" class="form-control input-sm" id="s" placeholder="Search...">
					</div>
					<button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
				</form>
			</div>
		</div>
	</nav>

<div class="header">

	<div class="container">

		<div class="row">
			<div class="col-sm-6">

				<div id="sharethis">
					<span class='st_facebook_button'></span>
					<span class='st_fblike_hcount'></span>
					<span class='st_plusone_button'></span>
					<span class='st_googleplus'></span>
					<span class='st_twitter'></span>
					<span class='st_sharethis'></span>
				</div>

			</div>
			<div class="col-sm-6">
				<div class="pull-right">
					<?php if(!isset($authuser)): ?>
						<a href="/users/login" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Log In / Sign Up &nbsp;</a>
					<?php else: ?>
						<a href="/users/dashboard" class="btn btn-success btn-sm" type="button"><span class="glyphicon glyphicon-user"></span> <?php echo $authuser['name']; ?> :: Profile</a> &nbsp;
						<a href="/users/logout" class="btn btn-danger btn-sm" type="button"><span class="glyphicon glyphicon-log-out"></span> Log Out</a> &nbsp;
					<?php endif; ?>
				</div>
			</div>

		</div>

		<div class="breadcrumb"> / <?php echo $this->Html->getCrumbs(' / ', ''); ?></div>

	</div>
</div>

<div class="main">
	<div class="container">

		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 728x90 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-1329323284396399"
		     data-ad-slot="0421941100"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		<br />

		<?= $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
		<br />
		<br />
	</div>
</div>

<div class="footer">
	<div class="container">
		Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.kende.com/">www.kende.com</a>
		<br />
		<br />
		<a href="http://www.kende.com/">Website developpment: www.kende.com</a>
		<br />
		<br />
	</div>
</div>

<?php // echo $this->element('sql_dump'); ?>

</body>
</html>
