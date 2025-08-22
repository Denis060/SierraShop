<?php
include_once('content/models/cart.php');
$cart = cart_list();
$options = [
    'order_by' => 'id',
];
$ccategories = getAll('categories', $options);
$contact_option = [
    'where' => 'id=1',
];
$contacts = getAll('contacts', $contact_option);
foreach ($contacts as $contact) {
    $phone = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $contact['phone']);
    $phone2 = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $contact['phone_2']);
    $contactUrl = $contact['link_Contact'];
    $contactEmail = $contact['email'];
    $contactFacebook = $contact['link_Facebook'];
    $contactTwitter = $contact['link_Twitter'];
    $contactAddress = $contact['address'];
    $contactZalo = $contact['zalo'];
    $contactLinkedin = $contact['link_linkedin'];
    $aboutUrl = $contact['link_about'];
    $aboutFooter = $contact['about_footer'];
    $linkLogo = $contact['link_Logo'];
    $favicon = $contact['favicon'];
}
$menuFooterOptions = [
    'order_by' => 'id',
    'offset' => 15,
];
$footerMenu = getAll('menu_footers', $menuFooterOptions);
global $userNav;
$userLogin = getRecord('users', $userNav);

$link_image = $image_product ?? PATH_URL.'public/img/bang-hieu-chikoishop.jpg';

if (isset($url_product)) {
    $url_site = PATH_URL . $url_product . '/';
} else {
    $url_site = PATH_URL . 'home';
}
?>
<!DOCTYPE html>
<html>

<head>
	<base href="<?= PATH_URL; ?>" />
	<meta charset="utf-8">
	<title><?= isset($title) ? $title : 'Sierra Shop'; ?></title>
	<meta name="keywords" content="Sierra Shop - Developed by TanHongIT" />
	<meta name="description" content="Sierra Shop">
	<meta name="author" content="sierrashop.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel=icon href="<?= PATH_URL ?>public/img/<?= $favicon ?>" sizes="32x32">
	<link rel="shortcut icon" href="<?= PATH_URL ?>public/img/<?= $favicon ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?= PATH_URL ?>public/img/<?= $favicon ?>">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="public/vendor/bootstrap/bootstrap.css">
	<link rel="stylesheet" href="public/vendor/fontawesome/css/font-awesome.css">
	<link rel="stylesheet" href="public/vendor/owlcarousel/owl.carousel.min.css" media="screen">
	<link rel="stylesheet" href="public/vendor/owlcarousel/owl.theme.default.min.css" media="screen">
	<link rel="stylesheet" href="public/vendor/magnific-popup/magnific-popup.css" media="screen">
	<link rel="stylesheet" href="public/css/theme.css">
	<link rel="stylesheet" href="public/css/theme-elements.css">
	<link rel="stylesheet" href="public/css/theme-blog.css">
	<link rel="stylesheet" href="public/css/theme-shop.css">
	<link rel="stylesheet" href="public/css/theme-animate.css">
	<link rel="stylesheet" href="public/vendor/rs-plugin/css/settings.min.css" media="screen">
	<link rel="stylesheet" href="public/vendor/circle-flip-slideshow/css/component.css" media="screen">
	<link rel="stylesheet" href="public/css/skins/default.css">
	<link rel="stylesheet" href="public/css/custom.css">
	<!--[if IE]>
			<link rel="stylesheet" href="public/css/ie.css">
		<![endif]-->

	<!--[if lte IE 8]>
			<script src="public/vendor/respond/respond.js"></script>
			<script src="public/vendor/excanvas/excanvas.js"></script>
		<![endif]-->
	<script src="public/vendor/modernizr/modernizr.js"></script>
	<script src="public/js/jquery-3.2.1.min.js"></script>
	<meta property="og:site_name" content="Chi Koi Shop" />
	<meta property="og:title" content="<?= isset($title) ? $title : 'Chi Koi Shop'; ?>" />
	<meta property="article:tag" content="<?= isset($title) ? $title : 'Chi Koi Shop'; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $url_site; ?>" />
	<link rel="canonical" href="<?= $url_site; ?>" />
	<meta property="article:publisher" content="https://www.facebook.com/110895717060461" />
	<meta property="og:description" content="Selling food & drinks, cosmetics, beauty products,..." />
	<meta property="og:image" content="<?= $link_image; ?>" />
	<meta property="og:image:secure_url" content="<?= $link_image; ?>" />
	<meta property="og:image:width" content="700" />
	<meta property="og:image:height" content="345" />
	<meta property="og:locale" content="en_US" />
	<meta property="fb:app_id" content="517386205818335" />
	<meta name="twitter:description" content="Selling food & drinks, cosmetics, beauty products,..." />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="<?= isset($title) ? $title : 'Chi Koi Shop'; ?>" />
	<meta name="twitter:image" content="<?= $link_image; ?>" />
</head>

<body>
	<div class="body">
		<header id="header">
			<div class="container">
				<div class="logo">
					<a href="home">
						<?php if (isset($linkLogo)) : ?>
							<img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" src="public/img/<?= $linkLogo ?>"><?php endif; ?>
					</a>
				</div>
				<nav>
					<ul class="nav nav-pills nav-top">
						<li>
							<a href="<?= $aboutUrl ?>"><i class="fa fa-angle-right"></i>About</a>
						</li>
						<li>
							<a href="<?= $contactUrl ?>"><i class="fa fa-headphones"></i>Contact</a>
						</li>
						<?php if (!isset($userLogin)) : ?>
							<li>
								<a href="register.php"><strong><i class="fa fa-sign-in"></i>Sign up</strong></a>
							</li>
							<li>
								<a href="admin.php"><strong><i class="fa fa-user"></i>Sign in</strong></a>
							</li>
						<?php else : ?>
							<li>
								<a onclick="return confirm('Are you sure you want to log out?')" href="admin.php?controller=home&action=logout"><strong><i class="fa fa-sign-out"></i>Sign out</strong></a>
							</li>
						<?php endif; ?>
						<li class="phone">
							<span><i class="fa fa-phone"></i><?= $phone ?></span>
						</li>
					</ul>
				</nav>
				<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<div class="navbar-collapse nav-main-collapse collapse">
				<div class="container">
					<nav class="nav-main mega-menu">
						<ul class="nav nav-pills nav-main" id="mainMenu">
							<li class="dropdown active">
								<a class="dropdown-toggle" href="index.php">
									Home
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="index.php?controller=product&action=all">View all products</a></li>
									<li><a href="feedback">Send feedback <span class="tip">Send</span></a></li>
									<li class="dropdown-submenu">
										<a href="javascript:void(0);">About Chi Koi Shop</a>
										<ul class="dropdown-menu">
											<li><a href="<?= $contactUrl ?>">Contact</a></li>
											<li><a href="<?= $aboutUrl ?>">About the shop</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<?php foreach ($ccategories as $ccategory) : ?>
								<li class="dropdown">
									<a class="dropdown-toggle" href="shop/<?= $ccategory['id'] ?>-<?= $ccategory['slug'] ?>">
										<?= $ccategory['category_name'] ?>
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<?php
                                        $options2 = [
                                            'where' => $ccategory['id'] . '=category_id',
                                        ];
							    $ssubcategory = getAll('subcategory', $options2);
							    foreach ($ssubcategory as $subcate) : ?>
											<li><a href="category/<?= $subcate['id'] ?>-<?= $subcate['slug'] ?>"><?= $subcate['subcategory_name'] ?></a></li>
										<?php endforeach; ?>
									</ul>
								</li>
							<?php endforeach; ?>
							<?php if (!isset($userNav)) : ?>
								<li class="dropdown mega-menu-item mega-menu-signin signin" id="headerAccount">
									<a class="dropdown-toggle" href="admin.php">
										<i class="fa fa-user"></i> Sign in
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-12">
														<div class="signin-form">
															<span class="mega-menu-sub-title">Sign in to your account</span>
															<form action="admin.php?controller=home&action=login" id="" role="form" method="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>Enter your email</label>
																			<input autofocus type="text" name="email" value="" class="form-control input-lg" required placeholder="Enter email or username...">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<a class="pull-right" id="headerRecover" href="index.php?controller=forgot-password">(Forgot password?)</a>
																			<label>Password</label>
																			<input type="password" name="password" value="" class="form-control input-lg" placeholder="Enter password...">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<button type="submit" class="btn btn-primary pull-right push-bottom">Sign in</button>
																</div>
															</form>
															<p class="sign-up-info">Don't have an account? <a href="#" id="headerSignUp">Sign up</a></p>
														</div>
														<div class="signup-form">
															<span class="mega-menu-sub-title">Create a new account</span>
															<form action="index.php?controller=register" id="" method="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>Username</label>
																			<input type="text" required placeholder="Username" autofocus name="username" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>Email address</label>
																			<input name="email" required placeholder="Enter email" type="text" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-6">
																			<label>Password</label>
																			<input name="password" placeholder="Password" required type="password" value="" class="form-control input-lg">
																		</div>
																		<div class="col-md-6">
																			<label>Confirm password</label>
																			<input name="confirmPassword" placeholder="Confirm password" required type="password" value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<input type="submit" value="Create account" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																	</div>
																</div>
															</form>
															<p class="log-in-info">Already have an account? <a href="#" id="headerSignIn">Sign in</a></p>
														</div>
														<div class="recover-form">
															<span class="mega-menu-sub-title">Reset password</span>
															<p>Fill out the form below to receive an email with the authorization code needed to reset your password.</p>
															<form action="index.php?controller=forgot-password&amp;action=request" id="" method="post">
																<div class="row">
																	<div class="form-group">
																		<div class="col-md-12">
																			<label>Email address</label>
																			<input type="text" name="email" placeholder="Enter email" autofocus value="" class="form-control input-lg">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<input type="submit" value="Confirm" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
																	</div>
																</div>
															</form>

															<p class="log-in-info">Already have an account? <a href="#" id="headerRecoverCancel">Sign in</a></p>
														</div>

													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
							<?php else : ?>
								<li class="dropdown mega-menu-item mega-menu-signin signin logged" id="headerAccount">
									<a class="dropdown-toggle" href="admin.php">
										<?php if (!isset($userLogin['user_avatar'])) {
										    echo '<i class="fa fa-user"></i>';
										} else {
										    echo '<img style="max-width: 25px;  border-radius: 15px 15px 15px 15px;" src="public/upload/images/' . $userLogin['user_avatar'] . '" alt="' . $userLogin['user_name'] . '">';
										} ?> <?= $userLogin['user_username'] ?>
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-6">
														<div class="user-avatar">
															<div class="img-thumbnail">
																<img src="public/upload/images/<?= $userLogin['user_avatar'] ?>" alt="<?= $userLogin['user_name'] ?>">
															</div>
															<p><strong><?= $userLogin['user_name'] ?></strong><span><?php if ($userLogin['role_id'] == 0) {
															    echo 'Customer';
															} elseif ($userLogin['role_id'] == 1) {
															    echo 'Admin';
															} else {
															    echo 'Moderator';
															} ?></span></p>
														</div>
													</div>
													<div class="col-md-6">
														<ul class="list-account-options">
															<li><a href="admin.php?controller=user&action=info&user_id=<?= $userNav ?>">My account</a></li>
															<li><a href="admin.php?controller=purchase">My orders</a></li>
															<li><a href="admin.php?controller=home&action=logout">Sign out</a></li>
														</ul>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
							<?php endif; ?>
							<li class="dropdown mega-menu-item mega-menu-shop">
								<a class="dropdown-toggle mobile-redirect" href="cart">
									<i class="fa fa-shopping-cart"></i> Cart (<?= cart_number(); ?>)
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<div class="mega-menu-content">
											<div class="row">
												<div class="col-md-12">
													<table cellspacing="0" class="cart">
														<tbody>
															<?php foreach ($cart as $productId => $product_cart) { ?>
																<tr>
																	<td class="product-thumbnail">
																		<a href="product/<?= $product_cart['id'] . '-' . slug($product_cart['name']); ?>">
																			<img width="100" height="100" alt="<?= $product_cart['name'] ?>" class="img-responsive" src="public/upload/products/<?= $product_cart['image'] ?>">
																		</a>
																	</td>
																	<td class="product-name">
																		<a href="product/<?= $product_cart['id'] . '-' . slug($product_cart['name']); ?>"><?= $product_cart['name'] ?><br><span class="amount"><strong>
																					<?php if ($product_cart['saleoff'] != 0) {
																					    echo number_format(($product_cart['price']) - (($product_cart['price'] * $product_cart['percent_off']) / 100), 0, ',', '.');
																					} else {
																					    echo number_format($product_cart['price'], 0, ',', '.');
																					} ?>
																					VND</strong> - Qty: <?= $product_cart['number'] ?> </span></a>
																	</td>
																	<td class="product-actions">
																		<a title="Remove this item" class="remove" href="cart/delete/<?= $product_cart['id']; ?>">
																			<i class="fa fa-times"></i>
																		</a>
																	</td>
																</tr>
															<?php } ?>
															<tr>
																<td class="actions" colspan="6">
																	<div class="actions-continue">
																		<form action="cart"><input type="submit" value="View all" class="btn pull-right btn-primary"></form>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<div class="search">
								<form id="searchForm" action="<?= PATH_URL; ?>search/" method="get">
									<div class="input-group">
										<input type="text" class="form-control search" name="keyword" id="q" placeholder="Search..." required>
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
						</ul>
					</nav>
				</div>
			</div>
		</header>
