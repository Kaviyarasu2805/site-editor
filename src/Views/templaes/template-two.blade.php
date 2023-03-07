<?php
if($buscon->manual_editor_content!=null){
    echo $buscon->manual_editor_content;
    $BDetails = DB::table('business')->select('userid')->where('bname','=',$bname)->where('userid','=',session()->has('busid'))->first();
    ?>
    @if(session()->has('busid') && session()->has('type') && ((session()->get('type'))=='user' || (session()->get('type'))=='socialuser'))
        @if($BDetails!=null)
            <script>
                $(".editor-link").remove();
            </script>
        @endif
        <script>
            $(".individual-links").remove();
            $(".user-login").remove();
        </script>
    @elseif(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
        <script>
            $(".business-links").remove();
            $(".user-login").remove();
        </script>
    @else
        <script>
            $(".individual-links").remove();
            $(".business-links").remove();
            $(".user-logout").remove();
        </script>
    @endif
    <script>
        $(".header-right .info-wrap").show();
        $(".header-right .info-wrap *").css('margin', '0 1px');
    </script>
    <style>
        .vvveb-none {
            display: block !important;
        }
    </style>
    <?php
}
else{
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <?php
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url_str_get = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $bname = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
        $BDetails = DB::table('business')->whereRaw("(bname = '$bname')")->get();
        $ownerid = $business_category = '';
        foreach($BDetails as $business){
            $ownerid = $business->userid;
            $business_category = $business->category;
        }
        $bid = $bus->id;
        $results_layout = DB::table('business_layout')->where('bid', $bid)->first();
        if(empty($buss)) {
            DB::table("business_layout")->insert(['bid' => $bid, 'header' => '1', 'banner' => '1', 'layout_3' => '1', 'layout_4' => '1', 'layout_7' => '1', 'layout_12' => '1', 'layout_14' => '1', 'map' => '1', 'footer' => '1', 'theme' => 'theme-light', 'primary_color' => '#395CB8', 'primary_based_color' => '#fff']);
            $results_layout = DB::table("business_layout")->where("bid", $bid)->first();
        }
    ?>
	<title>{{ $business_category }} | {{ $bname }}</title>
	<meta charset="utf-8">
	<meta name="keywords" content="{{ $bname }}" />
    <meta name="description" content="{{ $bname }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<meta name="format-detection" content="telephone=no">

	<!-- FavIcon Link -->
	<link rel="icon" href="" type="image/gif" sizes="16x16">

	<!-- Bootstrap CSS Link -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/bootstrap.min.css"); ?>">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Font Awesome Icon CSS Link -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/font-awesome.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/template/css/font-awesome.min.css"); ?>" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Slick Slider CSS Link -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/slick.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/slick-theme.css"); ?>">

	<!-- Wow Animation CSS Link -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/animate.css"); ?>">

	<!-- Themify Icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/vendor/themify/themify-icons.css"); ?>">

	<!-- Main Style CSS Link -->
	<link rel="stylesheet" type="text/css" href="<?php echo url("assets/templatetwo/css/style.css"); ?>">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<!--Star Rating-->
    <style>
        .parent_cart_button{
            position: relative;
            height: 55px;
            width: auto;
            display: flex;
            justify-content: center;
        }
        .icon-content .callback-btn {
            border-radius: 40px;
            margin-top: 10px;
            box-shadow: 0px 3px 12px 3px #ffffff17;
            color: var(--primary-based-color);
            font-size: 18px;
            padding: 8px 20px;
            background-color: var(--primary-color);
            border: none;
            cursor: pointer;
            position: absolute;
            z-index: 9999;
        }
        .callback-btn.out_of_stock {
            cursor: not-allowed !important;
        }
        h4.pname-hidden{
            display: -webkit-box !important;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .icon-bx-md.radius.bg-yellow.shadow-yellow img {
            /*width: 100%;*/
            max-height: 100%;
        }
        h4.dlab-title {
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            align-content: center;
        }
        .price-was::before {
            transform: rotate(293deg);
        }
        .price-was::after {
            transform: rotate(70deg);
        }
        .price-was::after, .price-was:before {
            font-size: 86px;
            left: 69%;
            z-index: 90;
            top: -23px;
            content: ' ';
            height: 75px;
            width: 2px;
            background-color: var(--heading-color);
            position: absolute;
        }
        /* component */
        .footer-contact-link a {
            padding-left: 0 !important;
        }
        .footer-last-link * {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
            line-height: 20px !important;
        }
        .footer-last-link a {
            width: 25px !important;
            height: 25px !important;
        }
        .star-rating {
            border: none;
            display: flex;
            flex-direction: row-reverse;
            font-size: 1.5em;
            justify-content: center;
            padding: 0 0.2em;
            text-align: center;
            width: 100%;
        }
        .star-rating span {
            font-size: 18px;
        }
        .star-rating input {
            display:none;
        }

        .star-rating label {
            color:var(--primary-based-color);
            cursor:pointer;
        }

        .star-rating :checked ~ label {
            color:#f90;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color:#fc0;
        }

          /*.back-btn:hover{*/
          /*     color:white !important;*/
          /*     background-color: #395CB8 !important;*/
          /* } */
    </style>
    <!--Cart-->
    <style>
        .cart_button {
            border-radius: 4px;
            height: 28px;
            width: 35px;
            justify-content: center;
            align-items: center;
            margin: 15px;
            font-size: 20px;
            background-color: var(--primary-color);
            color: var(--primary-based-color);
        }
        .cart_button .count {
            position: absolute;
            height: 30px;
            width: 30px;
            background-color: #85cb33;
            border-radius: 500px;
            font-size: 14px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            top: 15px;
            right: 15px;
            color: #100b00;
            transform: translate(50%, -50%);
            z-index: 1;
        }
        .badge {
            background-color: #6394f8;
            border-radius: 10px;
            color: white;
            display: inline-block;
            font-size: 12px;
            line-height: 1;
            padding: 3px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .shopping-cart {
            margin: 0;
            float: right;
            background: white;
            color: #000;
            width: 320px;
            border-radius: 3px;
            padding: 20px;
            position: absolute;
            z-index: 1000;
            right: 25px;
            box-shadow: -7px 7px 20px 0px #00000047;
            display: none;
        }
        .cart_button:hover .shopping-cart {
            display: block !important;
        }
        .shopping-cart:hover {
            display: block !important;
        }
        .shopping-cart .shopping-cart-header {
            border-bottom: 1px solid #e8e8e8;
            padding: 15px 0px 40px;
        }
        ul.shopping-cart-items::-webkit-scrollbar {
            width: 0px;
        }
        .shopping-cart .shopping-cart-header .shopping-cart-total {
            float: right;
        }
        .shopping-cart .shopping-cart-items {
            padding-top: 20px;
            max-height: 420px;
            overflow: auto;
        }
        .shopping-cart .shopping-cart-items li {
            margin-bottom: 18px;
            display: inline-flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-content: center;
            justify-content: space-evenly;
            align-items: center;
            justify-items: start;
        }
        .shopping-cart .shopping-cart-items img {
            float: left;
            margin-right: 12px;
            width: auto;
            height: auto;
            max-height: 100%;
        }
        .shopping-cart .shopping-cart-items .item-name {
            display: block;
            padding-top: 0px;
            font-size: 16px;
            width: 175px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
        .shopping-cart .shopping-cart-items .item-price {
            color: #6394f8;
            margin-right: 8px;
            font-size: 16px;
        }
        .shopping-cart .shopping-cart-items .item-quantity {
            color: #abb0be;
        }
        .shopping-cart .shopping-cart-items span.item-remove {
            position: relative;
            color: black;
            z-index: 9999999;
            right: 0px;
            top: -20px;
            cursor: pointer;
        }
        .shopping-cart:after {
            bottom: 100%;
            left: 89%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: white;
            border-width: 8px;
            margin-left: -8px;
        }
        .cart-icon {
            color: #515783;
            font-size: 24px;
            margin-right: 7px;
            float: left;
        }
        .button {
            color: var(--primary-based-color);
            background-color: var(--primary-color);
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            border-radius: 10px;
            font-size: 16px;
            margin: 25px 0 15px 0;
        }
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
    @extends('EditorFiles')
</head>
<body class="homepage-template page-template-elementor_header_footer page page-id-6868 wp-embed-responsive sticky-header header-style-4 footer-style-3 has-topbar topbar-style-2 no-sidebar right-sidebar product-grid-view has-footer-widget elementor-default elementor-template-full-width elementor-kit-471 elementor-page elementor-page-6868" id="home">
    <!-- Color Picker -->
    <script>
        // function to set a given theme/color-scheme
        function setTheme(themeName) {
            localStorage.setItem("theme", themeName);
            document.documentElement.className = themeName;
        }

        // Immediately invoked function to set the theme on initial load
        (function () {
            setTheme("<?php echo $results_layout->theme;  ?>");
        })();
    </script>
    <script>
        let picker;
        var color = '{{ $results_layout->primary_color }}';
        var primarybasedcolor = '{{ $results_layout->primary_based_color }}';

        document.documentElement.style.setProperty('--primary-color', color);

        localStorage.setItem('Primary_based_color',primarybasedcolor);
        document.documentElement.style.setProperty('--primary-based-color', primarybasedcolor);

        const defaults = {
            color: color,
            container: document.getElementById("color_picker"),
            onChange: function (color) {
                updateColor(color);
            },
            swatchColors: ["#D1BF91", "#60371E", "#A6341B", "#F9C743", "#395CB8", "#07510D", "#0532FF", "#FF9300", "#00F91A", "#000000", "#686868", "#EE5464", "#D27AEE", "#5BA8C4"],
        };

        function initPicker(options) {
            options = Object.assign(defaults, options);
            picker = new EasyLogicColorPicker(options);
        }

        function hexToRgb(h) {
            var r = parseInt(cutHex(h).substring(0, 2), 16),
                g = parseInt(cutHex(h).substring(2, 4), 16),
                b = parseInt(cutHex(h).substring(4, 6), 16);
            return "rgb(" + r + "," + g + "," + b + ")";
        }

        function cutHex(h) {
            return h.charAt(0) == "#" ? h.substring(1, 7) : h;
        }

        function updateColor(value) {
            color = value;
            const $color = document.querySelector(".sample__color");
            const $code = document.querySelector(".sample__code");
            $code.innerText = color;
            $color.style.setProperty("--color", color);
            document.documentElement.style.setProperty('--primary-color', color);
            var primary_based_color = '';
            if (getLightnessOfRGB(hexToRgb(color)).toFixed(4) >= "0.7") {
                document.documentElement.style.setProperty('--primary-based-color', '#000');
                primary_based_color = '#000';
            } else {
                document.documentElement.style.setProperty('--primary-based-color', '#fff');
                primary_based_color = '#fff';
            }

        }

        function getLightnessOfRGB(rgbString) {
            const rgbIntArray = rgbString
                .replace(/ /g, "")
                .slice(4, -1)
                .split(",")
                .map((e) => parseInt(e));

            // Get the highest and lowest out of red green and blue
            const highest = Math.max(...rgbIntArray);
            const lowest = Math.min(...rgbIntArray);
            // Return the average divided by 255
            return (highest + lowest) / 2 / 255;
        }

        function onChangeType(e) {
            picker.setType(e.value);
        }

        window.onload = function () {
            initPicker();
            updateColor(color);
            initDragElement();
            initResizeElement();
            document.getElementById("loader").style.display = "none";
            $("#loader").css("display", "none !important");
            $("#page").css("display", "block !important");
            $("#savetemplate").css("display", "block !important");
            $('#page').show();
            $('footer').show();
        };
    </script>
    <!-- End Color Picker -->
    <?php
        if($results_layout->theme=='theme-light'){  ?>
            <style>
                .banner-slider:before {
                    background-image: url(assets/templatetwo/images/banner-slider-shape.png) !important;
                }
            </style>
        <?php
        }else{  ?>
            <style>
                .banner-slider:before {
                    background-image: url(assets/templatetwo/images/banner-slider-shape_dark.png) !important;
                }
            </style>
        <?php
        }
    ?>
<div class="main">

	<!-- Header Start -->
	<header class="site-header">

		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-lg-12">
					<div class="header-box">
						<div class="site-branding">

						    <a href="#home" title="Business | Client">
								<?php if($buscon->content5 == null){?>
                                    <img src='<?php echo url("business/$bus->logo"); ?>' alt='Logo'>
                                <?php }else{ ?>
                                    <img src='<?php echo url("business/$buscon->content5"); ?>' alt='Logo'>
                                <?php } ?>
							</a>

						</div>
						<div class="header-menu">
							<nav class="main-navigation">
								<button class="toggle-button">
									<span></span>
									<span></span>
									<span></span>
								</button>
								<ul class="menu">
									<li>
            							<a href="#home" title="Home">Home</a>
            						</li>
									<li>
            							<a href="#about" title="About">About</a>
            						</li>
									<li>
            						     <a href="#services" title="Services">Services</a>
            						</li>
									<li>
            						     <a href="/{{ $bname }}/products" title="Products">Products</a>
            						</li>
									<li>
            							 <a href="#contact" title="Contact">Contact</a>
            						</li>
									@if(session()->has('busid') && session()->has('type') && ((session()->get('type'))=='user' || (session()->get('type'))=='socialuser'))
                                    <li>
                                        <a href="/userdashboard" class="sec-btn" data-text="Dashboard"><span>Dashboard</span></a>
                                    </li>
                                    <li>
                                        <a href="https://www.editor.1clxlite.com/{{ base64_encode($bus->bname) }}" class="sec-btn" data-text="Site Editor"><span>Site Editor</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ url('logout') }}" class="sec-btn" data-text="Logout"><span>Logout</span></a>
                                    </li>
                                    @elseif(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
                                        @foreach($connect as $connects)
                                            <?php
                                                $string = $connects->connected_bus;
                                                $str_arr = explode (",", $string);
                                            ?>
                                            <?php  if(in_array($ownerid, $str_arr) || $ownerid==session()->get('connection')) { ?>
                                               <!---->
                                            <?php   }else{?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="connection()" class="sec-btn" data-text="Connect">
                                                        <span class="btn-text" id="connected"><span>Connect</span></span>
                                                    </a>
                                                </li>
                                            <?php   }   ?>
                                        @endforeach
                                        <script>
                                            function connection() {
                                                $.ajax({
                                                    url: '/join_connection',
                                                    type: "POST",
                                                    data:{
                                                        _token:'{{ csrf_token() }}',
                                        				connection_id: {{ $ownerid }}
                                                    },
                                                    cache: false,
                                                    dataType: 'json',
                                                    success: function(dataResult){
                                        			    $("#connected").html("connected");
                                                    },
                                                    error: function () {
                                                        // alert("error");
                                                    }
                                                });
                                            }
                                        </script>
                                        <li>
                                            <a href="{{ url('ecx-dashboard') }}" class="sec-btn" data-text="Dashboard"><span>Dashboard</span></a>
                                        </li>
                                        <li>
                                            <div class="header-right-button">
                                                <div class="cart_button">
                                                    <!--<span class="btn-text">Cart</span>-->
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <?php
                                                        $data = DB::table('products')
                                                                ->select('products.id as pID', 'products.name as pName', 'products.price as pPrice', 'products.main_img as img', 'products.main_img_alt_tag as alt', 'cart.bus_id as bid', 'cart.user_id as user', 'cart.qty as cartQty', 'cart.total_price as total', 'cart.id as id')
                                                                ->join('cart','cart.product_id','=','products.id')
                                                                ->where('cart.bus_id','=',$ownerid)
                                                                ->where('cart.user_id','=',session()->get('busid'))
                                                                ->where('cart.removed','=','1')
                                                                ->get();

                                                        $totalAmount = DB::table('cart')
                                                                            ->select(DB::raw("SUM(total_price) as total"), DB::raw("SUM(qty) as qty"))
                                                                            ->where('bus_id','=',$ownerid)
                                                                            ->where('user_id','=',session()->get('busid'))
                                                                            ->where('removed','=',1)
                                                                            ->get();

                                                    ?>
                                                    <span class="count" id="cart_total_count">{{ $totalAmount[0]->qty }}</span>
                                                    <!--Products-->
                                                    <form action="{{ route('dircheckout') }}" method="get" id="paypal_form">
                                                        @csrf
                                                        <div class="shopping-cart">

                                                            <ul class="shopping-cart-items" id="cart_details_append">
                                                                <?php
                                                                    $cart_i = 0;
                                                                    $total = 0;
                                                                    foreach ($data as $cart) {
                                                                        $total += $cart->pPrice*$cart->cartQty;
                                                                        $cart_i++;
                                                                ?>
                                                                <li class="clearfix" id="hide_cart_row{{ $cart->id }}">
                                                                    <div style="max-width: 70px;max-height: 95px;width: 70px;height: 95px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                                                        <img src="<?php echo url("public/products/".$cart->img); ?>" alt="{{ $cart->alt }}" />
                                                                    </div>
                                                                    <div style="margin-left: 5px;">
                                                                        <span class="item-name">{{ $cart->pName }}</span>
                                                                        <div>
                                                                            <span class="item-price">${{ $cart->pPrice }}</span>
                                                                            <span class="item-quantity">QTY:
                                                                                <input type="number" class="cart_qty" name="cart_qty" min="1" value="{{ $cart->cartQty }}" data-amount="{{ $cart->pPrice }}" user-id="{{ session()->get('busid') }}" bus-id="{{ $ownerid }}" style="max-width: 40px;border: 0px;"  data-id="{{ $cart->id }}"   onkeypress="return !(event.charCode < 48 || event.charCode > 57)" required>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <span class="item-remove" data-id="{{ $cart->id }}" user-id="{{ session()->get('busid') }}" onclick="deletefunction({{ $cart->id }}, {{ session()->get('busid') }}, {{ $ownerid }})"><i class="fa fa-remove" style="color: #000;"></i></span>
                                                                </li>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </ul>

                                                            <div class="shopping-cart-header">
                                                                <div class="shopping-cart-total">
                                                                    <span class="lighter-text">Total:</span>
                                                                    <span class="main-color-text" id="cart_total_amount">
                                                                        <?php
                                                                        if(isset($dataCount)){
                                                                            if($dataCount!=0){
                                                                                foreach ($totalAmount as $totalAmounts) {
                                                                                    echo "$".$total;
                                                                                }
                                                                            }else{
                                                                                echo "$"."0.00";
                                                                            }

                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <a href="<?php echo url("ecx-dashboard/checkout/".$ownerid);?>" class="button">Checkout</a>
                                                        </div>
                                                    </form>
                                                    <!--End Products-->
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="{{ url('ecx-logout') }}" class="sec-btn" data-text="Logout"><span>Logout</span></a>
                                        </li>
                                    @else
                                    <li>
                                        <a href="{{ url($bname.'/login') }}" class="sec-btn" data-text="Login"><span>Login</span></a>
                                    </li>
                                    @endif



								</ul>
							</nav>
							<div class="black-shadow"></div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->

	<!-- Banner Start -->
    <?php if($results_layout->banner =='1'){ ?>
	<section class="main-banner" id="main-banner">
		<div class="sec-shape">
			<span class="shape shape1 animate-this"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
			<span class="shape shape2 animate-this"><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape3 animate-this"><img src="<?php echo url("assets/templatetwo/images/shape3.png"); ?>" alt="Shape"></span>
			<span class="shape shape4 animate-this "><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape5 animate-this"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="main-banner-slider wow fadeup-animation" data-wow-delay="0.6s">
						<div class="banner-slider">
						    <?php if($buscon->slide1 == null){?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/banner-img1.jpg');"); ?>"></div>
							<?php }else{ ?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("business/$buscon->slide1');"); ?>"></div>
							<?php } ?>

						    <?php if($buscon->slide2 == null){?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/banner-img2.jpg');"); ?>"></div>
							<?php }else{ ?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("business/$buscon->slide2');"); ?>"></div>
							<?php } ?>

						    <?php if($buscon->slide3 == null){?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/banner-img2.jpg');"); ?>"></div>
							<?php }else{ ?>
							    <div class="banner-img back-img" style="background-image: url('<?php echo url("business/$buscon->slide3');"); ?>"></div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="banner-content">
						 <h1 class="h1-title wow fadeup-animation" data-wow-delay="0.5s">
    				        <?php if($buscon->banner_heading1 == null){?>
                                START YOUR BUSINESS
                        	<?php }else{ ?>
                                {{ $buscon->banner_heading1 }}
                            <?php } ?>
    				    </h1>

    				    <p class="wow fadeup-animation" data-wow-delay="0.6s">
    				        <?php if($buscon->banner_text1 == null){?>
                                Our expertise, as well as our passion for web design set us aport from other agencies.
                        	<?php }else{ ?>
                                {!! $buscon->banner_text1 !!}
                            <?php } ?>
    					</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php }?>
	<!-- Banner End -->

	<!-- Services Start -->
	<?php if($results_layout->layout_4 == '1'){ ?>
	<section class="main-services">
		<div class="sec-shape">
			<span class="shape shape1"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
			<span class="shape shape2"><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape3 "><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape4"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="center-title">
						<span class="sub-title" id="services"></span>
					    <h2 class="h2-title">What We Provide</h2>
					</div>
				</div>
			</div>
			<div class="services-list">
				<div class="row justify-content-center">
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>
                                <?php if($buscon->content28 == null){?>
                                    <h3 class="h3-title">Service Name 1</h3>
                                <?php }else{  ?>
                                    <h3 class="h3-title"><?php echo $buscon->content28; ?></h3>
                                <?php }?>

                                <?php if($buscon->service_description_1 == null){?>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                <?php }else{  ?>
                                    <p><?php echo $buscon->service_description_1; ?></p>
                                <?php }?>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>

								    	 <?php if($buscon->content29 == null){?>
            								    <h3 class="h3-title">Service Name 2</h3>
            							  <?php }else{  ?>
            							      <h3 class="h3-title"><?php echo $buscon->content29; ?></h3>
            							 <?php }?>

								<?php if($buscon->service_description_2 == null){?>
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							    <?php }else{  ?>
							        <p><?php echo $buscon->service_description_2; ?></p>
							    <?php }?>

							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>

								    	 <?php if($buscon->content30 == null){?>
            								    <h3 class="h3-title">Service Name 3</h3>
            							  <?php }else{  ?>
            							      <h3 class="h3-title"><?php echo $buscon->content30; ?></h3>
            							 <?php }?>


								    <?php if($buscon->service_description_3 == null){?>
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							    <?php }else{  ?>
							        <p><?php echo $buscon->service_description_3; ?></p>
							    <?php }?>

							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>

								    	 <?php if($buscon->content31 == null){?>
            								    <h3 class="h3-title">Service Name 4</h3>
            							  <?php }else{  ?>
            							      <h3 class="h3-title"><?php echo $buscon->content31; ?></h3>
            							 <?php }?>


								    <?php if($buscon->service_description_4 == null){?>
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							    <?php }else{  ?>
							        <p><?php echo $buscon->service_description_4; ?></p>
							    <?php }?>

							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>

								    	 <?php if($buscon->content32 == null){?>
            								    <h3 class="h3-title">Service Name 5</h3>
            							  <?php }else{  ?>
            							      <h3 class="h3-title"><?php echo $buscon->content32; ?></h3>
            							 <?php }?>


								    <?php if($buscon->service_description_5 == null){?>
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							    <?php }else{  ?>
							        <p><?php echo $buscon->service_description_5; ?></p>
							    <?php }?>

							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="service-box wow fadeup-animation" data-wow-delay="0.4s">
							<div class="service-box-text">
								<div class="service-img">
									<!-- <img src="<?php echo url("assets/templatetwo/images/web-design.png"); ?>" alt="Web Design"> -->
									<i class='far fa-building'></i>
								</div>

								    	 <?php if($buscon->content33 == null){?>
            								    <h3 class="h3-title">Service Name 6</h3>
            							  <?php }else{  ?>
            							      <h3 class="h3-title"><?php echo $buscon->content33; ?></h3>
            							 <?php }?>


								    <?php if($buscon->service_description_6 == null){?>
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							    <?php }else{  ?>
							        <p><?php echo $buscon->service_description_6; ?></p>
							    <?php }?>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<?php }?>
	<!-- Services End -->

	<!-- About Us Start -->
	<?php if($results_layout->layout_7 == '1'){ ?>
	<section class="main-about-us" id="about">
		<div class="sec-shape">
			<span class="shape shape1"><img src="<?php echo url("assets/templatetwo/images/shape3.png"); ?>" alt="Shape"></span>
			<span class="shape shape2"><img src="<?php echo url("assets/templatetwo/images/shape4.png"); ?>" alt="Shape"></span>
		</div>
		<div class="container">
			<div class="row" id="about-us">
				<div class="col-lg-6 order-lg-1 order-2">
					<div class="about-content wow right-animation" data-wow-delay="0.4s">
					    <span class="sub-title">
    					    <?php if($buscon->about_section_heading == null){?>
                                ABOUT US
                            <?php }else{
                                echo $buscon->about_section_heading;
                            }?>
                        </span>

                        <?php if($buscon->content13 == null){?>
                            <h2 class="h2-title color_black">Who We Are</h2>

                            <div class="about-text">
                                <p>{{$bus->descript}}</p>
                            </div>
    					<?php }else{
                            echo $buscon->content13;
                        }?>
					</div>
				</div>
				<div class="col-lg-6 order-lg-2 order-1 wow left-animation" data-wow-delay="0.4s">
					<div class="about-img-box">

                        <!--about_img 1	-->
				    <?php if($buscon->content12 == null){?>
				        <div class="about-img img1 back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/about/about.png');"); ?>"></div>
				    <?php }else{?>
				        <div class="about-img img1 back-img" style="background-image: url('<?php echo url("business/$buscon->content12"); ?>'); background-size:cover;"></div>
				    <?php }?>

				    <!--about_img 2	-->
					<?php if($buscon->about_img_2 == null){?>
					    <div class="about-img img2 back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/about/about.png');"); ?>"></div>
					<?php }else{?>
					    <div class="about-img img2 back-img" style="background-image: url('<?php echo url("business/$buscon->about_img_2"); ?>'); background-size:cover;"></div>
					<?php }?>

					<!--about_img 3	-->
					<?php if($buscon->about_img_3 == null){?>
					    <div class="about-img img3 back-img" style="background-image: url('<?php echo url("assets/templatetwo/images/about/about.png');"); ?>"></div>
					<?php }else{?>
						<div class="about-img img3 back-img" style="background-image: url('<?php echo url("business/$buscon->about_img_3"); ?>'); background-size:cover;"></div>
					<?php }?>




					</div>
				</div>
			</div>
		</div>
	</section>
    <?php }?>
	<!-- About Us End -->

	<!-- Get Started Start -->
	<?php if($results_layout->layout_14 == '1'){ ?>
	<section class="main-get-started" id="contact">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="get-started-box wow fadeup-animation" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeup-animation;">
						<div class="circle-shape"><span></span></div>
						<div class="get-started-text">
						    <?php if($buscon->content22 == null){?>
								<h4 class="h4-title">Like Our Service? Subscribe Us</h4>
						        <p>Sign up to get new exclusive offers from our latest solutions</p>
                            <?php }else{
                                echo $buscon->content22;
                            }?>
						</div>
						<form>
							<input type="text" name="dzEmail" class="form-input" placeholder="Email Address" required="">
							<button type="submit" class="sec-btn" title="Subscribe">
    							<span>Subscribe</span>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
	<!-- Get Started End -->

	<!-- Products -->
    <?php
        $pi = 0;
        $userid = $bus->userid;
        $product_arr = DB::table('products')->select('*')->where('user_id', $userid)->where('visibility', '1')->orderBy('id','desc')->get();
        $ProductCount = $product_arr->count();
        if($ProductCount>0){
    ?>
	<section class="main-services content-inner">
		<div class="sec-shape">
			<span class="shape shape1"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
			<span class="shape shape2"><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape3 "><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
			<span class="shape shape4"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="center-title">
						<span class="sub-title" id="services">Products</span>
						<h2 class="h2-title color_black">Our Products</h2>
					</div>
				</div>
			</div>
			<div class="row"style="justify-content: center;">
                <?php
                    foreach ($product_arr as $products) {
                ?>
				<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.1s">
					<div class="icon-bx-wraper style-1 box-hover text-center m-b30 cart_products">
						<div class="icon-bx-md radius bg-yellow shadow-yellow">

							<img src="<?php echo url('public/products/'.$products->main_img); ?>" alt="{{   $products->main_img_alt_tag     }}">

						</div>
						<div class="icon-content">
							<h4 class="dlab-title pname-hidden">{{   $products->name    }}</h4>
							<h4 class="dlab-title">
							    <span>${{   $products->price     }}</span>
							    @if($products->old_price!=0.00 && $products->old_price!="" && $products->old_price!=$products->price)
                                    <div class="price-was">- ${{   $products->old_price     }}</div>
                                @endif
							</h4>
							<div class="star-rating">
                                <?php
                                    $id = $products->id;
                                    $stars1 = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.rating','=', 1 )
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();

                                    $stars2 = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.rating','=', 2 )
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();

                                    $stars3 = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.rating','=', 3 )
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();

                                    $stars4 = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.rating','=', 4 )
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();

                                    $stars5 = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.rating','=', 5 )
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();

                                    $total_star = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->count();
                                    // dd($total_star);

                                    $sum_of_star = DB::table('product_reviews')
                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                    ->where('product_reviews.product_id', '=', $id)
                                    ->sum('product_reviews.rating');
                                    // dd($sum);

                                    $star1 = $stars1;
                                    $star2 = $stars2;
                                    $star3 = $stars3;
                                    $star4 = $stars4;
                                    $star5 = $stars5;
                                    $total_stars = $total_star;
                                    $sum_of_stars = $sum_of_star;

                                    $val1 = $val2= $val3= $val4= $val5= $s1= $s2= $s3= $s4= $s5 = $all ="";

                                    if($total_stars !== 0){
                                        $val1 = $star1*100/$total_stars;
                                        $val2 = $star2*100/$total_stars;
                                        $val3 = $star3*100/$total_stars;
                                        $val4 = $star4*100/$total_stars;
                                        $val5 = $star5*100/$total_stars;

                                        $all = round($sum_of_stars/$total_stars);

                                        $s1 = round($val1, 2);
                                        $s2 = round($val2, 2);
                                        $s3 = round($val3, 2);
                                        $s4 = round($val4, 2);
                                        $s5 = round($val5, 2);
                                    }
                                ?>
								<span>({{$total_stars}})</span>
								<input type="radio" id="5-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="5"  disabled <?php if($all == 5){ echo "checked"; } ?> />
								<label for="5-stars<?php echo $pi; ?>" class="star">&#9733;</label>

								<input type="radio" id="4-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="4"  disabled <?php if($all == 5){ echo "checked"; } ?> />
								<label for="4-stars<?php echo $pi; ?>" class="star">&#9733;</label>

								<input type="radio" id="3-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="3"  disabled <?php if($all == 5){ echo "checked"; } ?> />
								<label for="3-stars<?php echo $pi; ?>" class="star">&#9733;</label>

								<input type="radio" id="2-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="2"  disabled <?php if($all == 5){ echo "checked"; } ?> />
								<label for="2-stars<?php echo $pi; ?>" class="star">&#9733;</label>

								<input type="radio" id="1-star<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="1"  disabled <?php if($all == 5){ echo "checked"; } ?> />
								<label for="1-star<?php echo $pi; ?>" class="star">&#9733;</label>
							</div>
							<div class="parent_cart_button">
                            @if($products->qty!=0)
                                @if(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
                                <button type="button" class="callback-btn add_to_cart_btn" style="width: auto;" data-id="{{ $products->id }}" data-bus="{{ $ownerid }}" data-price="{{ $products->price }}" user-id="{{ session()->get('busid') }}">Add To Cart</button>
                                @else
                                <button class="callback-btn" type="button">Add To Cart</button>
                                @endif
                            @else
                            <button type="button" class="callback-btn out_of_stock"><span>Out Of Stock</span></button>
                            @endif
                            </div>
						</div>
					</div>
				</div>
                <?php
                        $pi++;
                    }
                ?>
			</div>
		</div>
	</section>
    <?php
        }
    ?>
	<!-- End Products -->

	<!-- Map -->
	<?php if($results_layout->map == '1'){ ?>
	<section class="main-contact-page-link">
        <div data-component-maps="" class="container-fluid" style="min-height:100vh;max-width:100%;position:relative;padding: 0;">
            <?php
                $mapsrc = "https://maps.google.com/maps?q=" . $bus->lat . "," . $bus->lng . "&hl=en&z=14&output=embed";
            ?>
            <iframe frameborder="0" src="{{ $mapsrc }}" style="width:100%;height:450px;left:0px;pointer-events:none" marginheight="0" marginwidth="0"></iframe>
        </div>
	</section>
	<?php }?>
	<!-- End Map -->

	<!-- Footer Start -->
    <?php if($results_layout->footer == '1'){ ?>
	<footer class="site-footer" style="background: linear-gradient(0deg, var(--background-overlay), var(--background-overlay)),url(<?php echo url("assets/templatetwo/images/about/about.png);"); ?>">
		<div class="sec-shape">
			<span class="shape shape1"><img src="<?php echo url("assets/templatetwo/images/shape4.png"); ?>" alt="Shape"></span>
			<span class="shape shape2"><img src="<?php echo url("assets/templatetwo/images/shape1.png"); ?>" alt="Shape"></span>
			<span class="shape shape3 "><img src="<?php echo url("assets/templatetwo/images/shape2.png"); ?>" alt="Shape"></span>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="footer-info">
						<div class="footer-logo">

							<a href="#" title="Business | Client">
							    <?php if($buscon->content23 == null){?>
								   <img src="<?php echo url("business/$bus->logo"); ?>" alt="Logo">
								<?php }else{ ?>
								   <img src="<?php echo url("business/$buscon->content23"); ?>" alt="Logo">
								<?php }?>
							</a>

						</div>
						<div class="footer-desc">
				            <?php if($buscon->content24 == null){?>
							    <p>Lorem ipsum dolor sit amet, consectetur adipissed do eius mod tempor incididunt ut laboret amet, Lorem ipsum amet.</p>
    						<?php }else{
                                echo $buscon->content24;
                            }?>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="footer-info">
					    <h3 class="h3-title footer-title">Contact Details</h3>

						<div class="footer-contact-box">
							<div class="footer-contact-link">
								<span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
            				    <?php if($buscon->content1 == null){?>
            				        <p>{{$bus->address}},{{$bus->state}},{{$bus->country}},{{$bus->pincode}}</p>
            				    <?php }else{
                                    echo $buscon->content1;
                                }?>
							</div>
						</div>
						<div class="footer-contact-box">
							<div class="footer-contact-link">
								<span class="icon"><i class="fas fa-phone-alt" aria-hidden="true"></i></span>
            				    <?php if($buscon->content3 == null){?>
            					<a href="tel:{{$bus->phone}}" title="{{$bus->phone}}"><span class="__cf_email__" data-cfemail="0d64636b624d6a606c6461236e6260">{{$bus->phone}}</span></a>
            				    <?php }else{
                                    echo $buscon->content3;
                                }?>
							</div>
						</div>
						<div cla    ss="footer-contact-box">
							<div class="footer-contact-link">
								<span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            				    <?php if($buscon->content2 == null){?>
            					    <a href="mailto:{{$bus->email}}" title="{{$bus->email}}"><span class="__cf_email__" data-cfemail="0d64636b624d6a606c6461236e6260">{{$bus->email}}</span></a>
            					<?php }else{
                                    echo $buscon->content2;
                                }?>
							</div>
						</div>

					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="our-services">

    					<h3 class="h3-title footer-title">Our Services</h3>
					    <ul>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
							<li><a href="#" title="Lorem ipsum dolor">Lorem ipsum dolor</a></li>
						</ul>

					</div>
				</div>
				<div class="col-lg-3 footer_gallery">
					<div class="row">
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
					</div>
					<div class="row">
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    						<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
					</div>
					<div class="row">
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
						<div class="col-4">

    							<img src="<?php echo url("assets/templatetwo/images/team-img1.png"); ?>" alt="gallery">

						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div class="footer-last">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="copy-right">
    				    <?php if($buscon->content27 == null){?>
    				        <p>© Copyright <?php echo  date("Y"); ?>, All Rights Reserved.</p>
                        <?php }else{
                            echo $buscon->content27;
                        }?>


					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer-last-link">
    				    <?php if($buscon->content4 == null){?>
                        <ul>
                            <li class="topbar-social">
                                <div class="social-icon">
                                    <a target="_blank" href="https://www.linkedin.com/company/texasba">
                                        <i class="fab fa-linkedin-in">&nbsp;</i>
                                    </a>
                                    <a target="_blank" href="https://www.facebook.com/texasba/">
                                        <i class="fab fa-facebook-f">&nbsp;</i>
                                    </a>
                                    <a target="_blank" href="https://www.instagram.com/texasbusinessanalytics/">
                                        <i class="fab fa-instagram">&nbsp;</i>
                                    </a>
                                    <a target="_blank" href="https://twitter.com/texasba_ai">
                                        <i class="fab fa-twitter">&nbsp;</i>
                                    </a>
                                    <a target="_blank" href="https://in.pinterest.com/texasbusinessanalytics/_created/">
                                        <i class="fab fa-pinterest-p">&nbsp;</i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <?php }else{
                            echo $buscon->content4;
                        }?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php } ?>
	<!-- Footer End -->

	<!-- Scroll To Top Start -->
	<a href="#main-banner" class="scroll-top" id="scroll-to-top">
		<i class="fa fa-arrow-up" aria-hidden="true"></i>
	</a>
	<!-- Scroll To Top End-->

	<!-- Bubbles Animation Start -->
	<div class="bubbles_wrap">
		<div class="bubble x1"></div>
		<div class="bubble x2"></div>
		<div class="bubble x3"></div>
		<div class="bubble x4"></div>
		<div class="bubble x5"></div>
		<div class="bubble x6"></div>
		<div class="bubble x7"></div>
		<div class="bubble x8"></div>
		<div class="bubble x9"></div>
		<div class="bubble x10"></div>
	</div>
	<!-- Bubbles Animation End-->
</div>
@include('chatbot')
<!-- Jquery JS Link -->
<script src="<?php echo url("assets/templatetwo/js/jquery.min.js"); ?>"></script>

<!-- Banner Moving Js Link -->
<script src="<?php echo url("assets/templatetwo/js/bg-moving.js"); ?>"></script>

<!-- Bootstrap JS Link -->
<script src="<?php echo url("assets/templatetwo/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo url("assets/templatetwo/js/popper.min.js"); ?>"></script>

<!-- Slick Slider JS Link -->
<script src="<?php echo url("assets/templatetwo/js/slick.min.js"); ?>"></script>

<!-- Portfolio Tabbing JS Link -->
<script src="<?php echo url("assets/templatetwo/js/jquery.mixitup.min.js"); ?>"></script>

<!-- Wow Animation JS Link -->
<script src="<?php echo url("assets/templatetwo/js/wow.min.js"); ?>"></script>

<!-- Custom JS Link -->
<script src="<?php echo url("assets/templatetwo/js/dz.ajax.js"); ?>"></script>
<!-- AJAX -->
<script src="<?php echo url("assets/templatetwo/js/custom.js"); ?>"></script>
<script src="<?php echo url("assets/templatetwo/js/custom-scroll-count.js"); ?>"></script>
<!--Cart-->
<script>
    $("input.cart_qty").change(function(){
        var qty = $(this).val();
        var id = $(this).attr('data-id');
        var user_id = $(this).attr('user-id');
        var bid = $(this).attr('bus-id');
        var price = $(this).attr('data-amount');
        $.ajax({
            url: "{{ route('ajaxCartQty',12) }}",
            type: "post",
            data: {
                _token:'{{ csrf_token() }}',
                qty: qty,
                user_id: user_id,
                bid: bid,
                id: id,
                price: price
            },
            cache: false,
            dataType: 'json',
            success: function (dataResult) {
                var resultData = dataResult.statusCode;
                if(resultData==200){
                    alert('Please Login Your Account');
                }
                if(resultData==300){
                    $("#checkout_ttl_amount").val(dataResult.total);
                    $("#cart_total_amount").html("$"+dataResult.total);
                }
                return false;
            },
        });
    });

    $('.add_to_cart_btn').click(function(){
        var product_id = $(this).attr('data-id');
        var bus_id = $(this).attr('data-bus');
        var user_id = $(this).attr('user-id');

        $.ajax({
            url: "{{ route('ajaxCart',12) }}",
            type: "post",
            data: {
                _token:'{{ csrf_token() }}',
                product_id: product_id,
                bus_id: bus_id,
                user_id: user_id
            },
            cache: false,
            dataType: 'json',
            success: function (dataResult) {
                console.log(dataResult);
                var resultData = dataResult.statusCode;
                if(resultData==200){
                    alert('Please Login Your Account');
                }
                if(resultData==400){
                    alert('Out Of Stock');
                }
                if(resultData==100){
                    $("#cart_total_count").html(dataResult.count);
                    $("#cart_details_append").html(dataResult.HTML);
                    $("#checkout_ttl_amount").val(dataResult.total);
                    $("#cart_total_amount").html("$"+dataResult.total);
                }
                return false;
            },
        });
    });

    function deletefunction(a, b, c) {
        let text = "Are You Sure? !\nEither OK or Cancel.";
        var cart_id = a;
        var user_id = b;
        var bus_id = c;
        var hide = "hide_cart_row"+cart_id;
        if (confirm(text) == true) {
            $.ajax({
                url: "{{ route('ajaxCartRemove',12) }}",
                type: "post",
                data: {
                    _token:'{{ csrf_token() }}',
                    cart_id: cart_id,
                    bus_id: bus_id,
                    user_id: user_id
                },
                cache: false,
                dataType: 'json',
                success: function (dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.statusCode;
                    if(resultData==200){
                        alert('Something went wrong');
                    }
                    if(resultData==300){
                        $("#cart_total_count").html(dataResult.count);
                        $("#cart_details_append").html(dataResult.HTML);
                        $("#checkout_ttl_amount").val(dataResult.total);
                        $("#cart_total_amount").html("$"+dataResult.total);
                    }
                    return false;
                },
            });
        }
    }
</script>
<!--End Cart-->
<!--Map Location-->
<script
  src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_MAP_API_KEY");}}&callback=initMap&libraries=&v=weekly"
  async
></script>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        const uluru = { lat: {{ $bus->lat }}, lng: {{ $bus->lng }} };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>
</body>
</html>
<?php } ?>
