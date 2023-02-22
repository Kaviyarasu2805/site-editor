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
else {
?>
<!doctype html>
<html lang="en-US">
<head>
    <?php
    $QUERY_STRING = $ownerid = '';
    $BDetails = DB::table('business')->whereRaw("(bname = '$bname')")->get();
    foreach ($BDetails as $business) {
        $ownerid = $business->userid;
        $business_category = $business->category;
        $business_business_for = $business->business_for;
        $business_lat = $business->lat;
        $business_lag = $business->lng;
        $url_name = $business->url_name;
    }
    $bid = $bus->id;
    if ($business_business_for == '1') {
        $dash_service = '1'; $dash_ecom = '0';
    } else if ($business_business_for == '2') {
        $dash_ecom = '1'; $dash_service = '0';
    } else if ($business_business_for == '1,2') {
        $dash_service = '1'; $dash_ecom = '1';
    }
    $results_layout = DB::table('business_layout')->where('bid', $bid)->first();
    if (empty($results_layout)) {
        DB::table("business_layout")->insert(['bid' => $bid, 'header' => '1', 'banner' => '1', 'layout_3' => '1', 'layout_4' => '1', 'layout_7' => $dash_service, 'layout_12' => '1', 'layout_14' => '1', 'layout_16' => $dash_ecom, 'map' => '1', 'footer' => '1', 'theme' => 'theme-light', 'primary_color' => '#395CB8', 'primary_based_color' => '#fff', 'dash_ecom' => $dash_ecom, 'dash_service' => $dash_service]);
        $results_layout = DB::table("business_layout")->where("bid", $bid)->first();
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        function loadAsync(e, t) {
            var a, n = !1;
            a = document.createElement("script"), a.type = "text/javascript", a.src = e, a.onreadystatechange = function() {
                n || this.readyState && "complete" != this.readyState || (n = !0, "function" == typeof t && t())
            }, a.onload = a.onreadystatechange, document.getElementsByTagName("head")[0].appendChild(a)
        }
    </script>
    <title><?php echo $business_category ?> | {{ $url_name }}</title>

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/all.min.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/v4-shims.min.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/font-awesome.min.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/fontawesome1.min.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/wp-block-library.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/style.css" media="all" />
    <noscript>
        <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/style.css" media="all" />
    </noscript>

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/wpo.css" media="all" />

    <link rel="stylesheet" href="https://www.1clxlite.com/assets/template/css/solid.min.css" media="all" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- color picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js" as="script" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

    <!-- Font awsome -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="https://www.1clxlite.com/assets/css/custom/site-template-one.css" media="all">

    <!-- Color Picker -->
    <script>
        // function to set a given theme/color-scheme
        function setTheme(themeName) {
            localStorage.setItem("theme", themeName);
            document.documentElement.className = themeName;
        }

        // Immediately invoked function to set the theme on initial load
        (function() {
            setTheme("<?php echo $results_layout->theme;  ?>");
        })();

        let picker;
        var color = '{{ $results_layout->primary_color }}';
        var primarybasedcolor = '{{ $results_layout->primary_based_color }}';

        document.documentElement.style.setProperty('--primary-color', color);

        localStorage.setItem('Primary_based_color', primarybasedcolor);
        document.documentElement.style.setProperty('--primary-based-color', primarybasedcolor);

        const defaults = {
            color: color,
            container: document.getElementById("color_picker"),
            onChange: function(color) {
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

        window.onload = function() {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body class="home page-template page-template-elementor_header_footer page page-id-6868 wp-embed-responsive sticky-header header-style-4 footer-style-3 has-topbar topbar-style-2 no-sidebar right-sidebar product-grid-view has-footer-widget elementor-default elementor-template-full-width elementor-kit-471 elementor-page elementor-page-6868">
    <div id="page" class="site">
        <!--Header-->
        <header id="masthead" class="site-header">
            <div id="header-4" class="header-area">

                <?php if ($results_layout->header == '1') {     ?>
                    <div id="tophead" class="header-top-bar align-items-center">
                        <div class="container">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="topbar-left">
                                    <div class="header-location header-item align-left-new-added-content">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?php if ($buscon->content1 == null) { ?>
                                            {{$bus->address}}, {{$bus->state}}, {{$bus->country}}
                                        <?php } else {
                                            echo $buscon->content1;
                                        } ?>
                                    </div>
                                    <div class="header-email header-item align-left-new-added-content">
                                        <i class="far fa-envelope"></i>
                                        <?php if ($buscon->content2 == null) {    ?>
                                            <a href="mailto:{{$bus->email}}" target="_blank">{{$bus->email}}</a>
                                        <?php } else {
                                            echo $buscon->content2;
                                        } ?>
                                    </div>
                                </div>
                                <div class="topbar-right">
                                    <div class="header-phone header-item align-left-new-added-content">
                                        <i class="fas fa-phone-alt"></i>
                                        <?php if ($buscon->content3 == null) {   ?>
                                            <a href="tel:{{$bus->phone}}">{{$bus->phone}}</a>
                                        <?php } else {
                                            echo $buscon->content3;
                                        }   ?>
                                    </div>
                                    <?php if ($buscon->content4 == null) {    ?>
                                        <ul id="social_icons">
                                            <li class="topbar-social">
                                                <div class="social-icon">
                                                    <a class="facebook_tag" target="_blank" href="https://www.facebook.com/1clx-101517669305364">
                                                        <i class="fab fa-facebook-f">&nbsp;</i>
                                                    </a>
                                                    <a class="twitter_tag" target="_blank" href="https://twitter.com/1clxusa">
                                                        <i class="fab fa-twitter">&nbsp;</i>
                                                    </a>
                                                    <a class="linkedin_tag" target="_blank" href="https://www.linkedin.com/company/1clx">
                                                        <i class="fab fa-linkedin-in">&nbsp;</i>
                                                    </a>
                                                    <a class="instagram_tag" target="_blank" href="https://www.instagram.com/1clxusa/">
                                                        <i class="fab fa-instagram">&nbsp;</i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php } else {
                                        echo $buscon->content4;
                                    }   ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php   }    ?>
                <div id="rt-sticky-placeholder"></div>
                <div class="header-menu mobile-menu menu-layout1" id="header-menu">
                    <div class="container">
                        <div class="menu-full-wrap">
                            <div class="site-branding-wrap">
                                <div class="site-branding logo">
                                    <a class="dark-logo" href="#">
                                        <?php if ($buscon->content5 != null) { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $buscon->content5 }}' alt='Logo'>
                                        <?php } elseif ($bus->logo != null) { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $bus->logo }}' alt='Logo'>
                                        <?php } else { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/public/theme/images/1clx_blue_logo.png' alt='Logo'>
                                        <?php } ?>
                                    </a>
                                    <a class="light-logo" href="#">
                                        <?php if ($buscon->content5 != null) { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $buscon->content5 }}' alt='Logo'>
                                        <?php } elseif ($bus->logo != null) { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $bus->logo }}' alt='Logo'>
                                        <?php } else { ?>
                                            <img width='192' height='47' src='https://www.1clxlite.com/public/theme/images/1clx_blue_logo.png' alt='Logo'>
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>
                            <div class="header-right" data-aos="fade-up" data-aos-delay="500" data-vvveb-disabled-area>
                                <div class="menu-wrap">
                                    <div id="site-navigation" class="main-navigation">
                                        <nav class="menu-main-menu-container">
                                            <ul id="menu-main-menu" class="menu">
                                                <?php if ($results_layout->header == '1') {     ?>
                                                    <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                                        <a href="#Home" aria-current="page">Home</a>
                                                    </li>
                                                <?php   }   ?>
                                                <?php if ($results_layout->layout_4 == '1') {     ?>
                                                    <li id="menu-item-4634" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                                        <a href="#About">About</a>
                                                    </li>
                                                <?php   }   ?>
                                                <?php if (($results_layout->layout_7 == '1') && ($results_layout->dash_service == '1')) {     ?>
                                                    <li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                                        <a href="#Services">Services </a>
                                                    </li>
                                                <?php   }   ?>
                                                <?php if (($results_layout->layout_16 == '1') && ($results_layout->dash_ecom == '1')) {     ?>
                                                    <li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                                        <a href="/{{ $bname }}/products">Products</a>
                                                    </li>
                                                <?php   }   ?>
                                                <?php if ($results_layout->layout_12 == '1') {     ?>
                                                    <!--<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">-->
                                                    <!--    <a href="#Gallery">Gallery</a>-->
                                                    <!--</li>-->
                                                <?php   }   ?>
                                                <!--<li id="menu-item-4970" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">-->
                                                <!--    <a href="#Testimonial">Testimonial</a>-->
                                                <!--</li>-->
                                                <?php if ($results_layout->footer == '1') {     ?>
                                                    <li id="menu-item-2052" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                                        <a href="#Contact">Contact</a>
                                                    </li>
                                                <?php   }   ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <ul class="info-wrap">
                                    @if(session()->has('busid') && session()->has('type') && ((session()->get('type'))=='user' || (session()->get('type'))=='socialuser'))
                                    <li>
                                        <div class="header-right-button">
                                            <a class="header-btn" href="/addbusiness">
                                                <span class="btn-text">Dashboard</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li style="margin: 0 10px;">
                                        <div class="header-right-button">
                                            <a class="header-btn" href="https://www.editor.1clxlite.com/{{ base64_encode($bus->bname) }}">
                                                <span class="btn-text">Site Editor</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-right-button">
                                            <a class="header-btn" href="/logout">
                                                <span class="btn-text">Logout</span>
                                            </a>
                                        </div>
                                    </li>
                                    @elseif(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
                                    @foreach($connect as $connects)
                                    <?php
                                    $string = $connects->connected_bus;
                                    $str_arr = explode(",", $string);
                                    ?>
                                    <?php if (in_array($ownerid, $str_arr) || $ownerid == session()->get('connection')) { ?>
                                        <!---->
                                    <?php   } else { ?>
                                        <li style="padding-right:10px">
                                            <div class="header-right-button">
                                                <button class="header-btn" id="connect" type="button" style="text-decoration:none;">
                                                    <span class="btn-text" id="connected">Connect</span>
                                                </button>
                                            </div>
                                        </li>
                                    <?php   }   ?>
                                    @endforeach
                                    <script>
                                        $("#connect").click(function() {
                                            $.ajax({
                                                url: '/join_connection',
                                                type: "POST",
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    connection_id: {{ $ownerid }}
                                                },
                                                cache: false,
                                                dataType: 'json',
                                                success: function(dataResult) {
                                                    console.log(dataResult);
                                                    $("#connected").html("connected");
                                                },
                                                error: function() {
                                                    // alert("error");
                                                }
                                            });
                                        });
                                    </script>
                                    <li style="padding-right:10px">
                                        <div class="header-right-button">
                                            <a class="header-btn" href="/ecx-dashboard">
                                                <span class="btn-text">Dashboard</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-right-button">
                                            <a class="header-btn" href="/ecx-logout">
                                                <span class="btn-text">Logout</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-right-button">
                                            <div class="cart_button">
                                                <!--<span class="btn-text">Cart</span>-->
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <?php
                                                // echo $ownerid;
                                                   $data1 = DB::table('products')
                                                        ->select('products.id as pID', 'products.name as pName', 'products.price as pPrice', 'products.main_img as img', 'products.main_img_alt_tag as alt', 'cart.bus_id as bid', 'cart.user_id as user', 'cart.qty as cartQty', 'cart.total_price as total', 'cart.id as id')
                                                        ->join('cart', 'cart.product_id', '=', 'products.id')
                                                        ->where('cart.bus_id', '=', $ownerid)
                                                        ->where('cart.user_id', '=', session()->get('busid'))
                                                        ->where('cart.removed', '=', '1')
                                                        ->get();

                                                 $data2 = DB::table('cart')
                                                    ->select('services.id as pID', 'services.name as pName', 'services.price as pPrice', 'services.image as img', 'services.alt_tag as alt', 'cart.bus_id as bid', 'cart.user_id as user', 'cart.qty as cartQty', 'cart.total_price as total', 'cart.id as id')
                                                    ->leftJoin('products', 'cart.product_id', '=', 'products.id')
                                                    ->leftjoin('services', 'cart.product_id', '=', 'services.id')
                                                    ->where('cart.bus_id', $ownerid)
                                                    ->where('cart.user_id',session()->get('busid'))
                                                    ->where('services.user_id',$ownerid)
                                                    ->where('cart.removed', '1')
                                                    ->get();
                                                $data = $data1->merge($data2)->whereNotNull('pID')->whereNotNull('pName')->whereNotNull('pPrice');
                                                $totalAmount = DB::table('cart')
                                                    ->select(DB::raw("SUM(total_price) as total"), DB::raw("SUM(qty) as qty"))
                                                    ->where('bus_id', '=', $ownerid)
                                                    ->where('user_id', '=', session()->get('busid'))
                                                    ->where('removed', '=', 1)
                                                    ->get();
                                                ?>
                                                <span class="count" id="cart_total_count">{{ $totalAmount[0]->qty }}</span>
                                                <!--Products-->
                                                <form action="/dir-checkout" method="get" id="paypal_form">
                                                    @csrf
                                                    <div class="shopping-cart">

                                                        <ul class="shopping-cart-items" id="cart_details_append">
                                                            <?php
                                                            $cart_i = 0;
                                                            $total = 0;
                                                            foreach ($data as $cart) {
                                                                $total += $cart->pPrice * $cart->cartQty;
                                                                $cart_i++;
                                                            ?>
                                                                <li class="clearfix" id="hide_cart_row{{ $cart->id }}">
                                                                    <div style="max-width: 70px;max-height: 95px;width: 70px;height: 95px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                                                        <img src="<?php if (file_exists('http://1clxlite.com/public/products/'.$cart->img)) {echo "http://1clxlite.com/public/products/" . $cart->img;}else{echo "http://1clxlite.com/public/service/" . $cart->img;} ?>" alt="{{ $cart->alt }}" />
                                                                    </div>
                                                                    <div style="margin-left: 5px;">
                                                                        <span class="item-name">{{ $cart->pName }}</span>
                                                                        <div>
                                                                            <span class="item-price">₹{{ $cart->pPrice }}</span>
                                                                            <span class="item-quantity">QTY:
                                                                                <input type="number" class="cart_qty" name="cart_qty" min="1" value="{{ $cart->cartQty }}" data-amount="{{ $cart->pPrice }}" user-id="{{ session()->get('busid') }}" bus-id="{{ $ownerid }}" style="max-width: 40px;border: 0px;" data-id="{{ $cart->id }}" onkeypress="return !(event.charCode < 48 || event.charCode > 57)" required>
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
                                                                    if ($totalAmount[0]->qty != 0) {
                                                                        foreach ($totalAmount as $totalAmounts) {
                                                                            echo "₹" . $total;
                                                                        }
                                                                    } else {
                                                                        echo "₹" . "0.00";
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?php if ($totalAmount[0]->qty != 0) { ?>
                                                            <a href="<?php echo "/ecx-dashboard/checkout/" . $ownerid; ?>" class="button">Checkout</a>
                                                        <?php } ?>
                                                    </div>
                                                </form>
                                                <!--End Products-->
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="header-right-button">
                                            <a class="header-btn" href="{{ '/'.$bname.'/login' }}">
                                                <span class="btn-text">Sign In | Sign Up</span>
                                            </a>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="rt-header-menu mean-container" id="meanmenu">
            <div class="mobile-top-bar" id="mobile-top-fix">
                <div class="header-top">
                    <div>
                        <div class="info-phone header-info "><span><i class="fa fa-phone"></i><a href="tel:{{$bus->phone}}">{{$bus->phone}}</a></span>
                        </div>
                    </div>
                </div>
                <div class="header-button">
                    <a href="#">Business Card</a>
                </div>
            </div>
            <div id="mobile-sticky-placeholder"></div>
            <div class="mobile-mene-bar" id="mobile-men-bar">
                <div class="mean-bar">
                    <a href="">
                        <?php if ($buscon->content5 != null) { ?>
                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $buscon->content5 }}' alt='Logo'>
                        <?php } elseif ($bus->logo != null) { ?>
                            <img width='192' height='47' src='https://www.1clxlite.com/business/{{ $bus->logo }}' alt='Logo'>
                        <?php } else { ?>
                            <img width='192' height='47' src='https://www.1clxlite.com/public/theme/images/1clx_blue_logo.png' alt='Logo'>
                        <?php } ?>
                    </a>
                    <span class="sidebarBtn_toggle">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </span>
                </div>
                <div class="rt-slide-nav" data-aos="fade-up" data-aos-delay="500" data-vvveb-disabled-area>
                    <div class="offscreen-navigation">
                        <nav class="menu-main-menu-container">
                            <ul id="menu-main-menu-1" class="menu">
                                <?php if ($results_layout->header == '1') {     ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <a href="#Home" aria-current="page">Home</a>
                                    </li>
                                <?php   }   ?>
                                <?php if ($results_layout->layout_4 == '1') {     ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <a href="#About">About</a>
                                    </li>
                                <?php   }   ?>
                                <?php if (($results_layout->layout_7 == '1') && ($results_layout->dash_service == '1')) {     ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <a href="#Services">Services</a>
                                    </li>
                                <?php   }   ?>
                                <?php if (($results_layout->layout_16 == '1') && ($results_layout->dash_ecom == '1')) {     ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <a href="#products">Product</a>
                                    </li>
                                <?php   }   ?>
                                <?php if ($results_layout->layout_12 == '1') {     ?>
                                    <!--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">-->
                                    <!--    <a href="#Gallery">Gallery</a>-->
                                    <!--</li>-->
                                <?php   }   ?>
                                <!--<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">-->
                                <!--    <a href="#Testimonial">Testimonial</a>-->
                                <!--</li>-->
                                <?php if ($results_layout->footer == '1') {     ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <a href="#Contact">Contact</a>
                                    </li>
                                <?php   }   ?>
                                @if(session()->has('busid') && session()->has('type') && ((session()->get('type'))=='user' || (session()->get('type'))=='socialuser'))
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="/userdashboard">Dashboard</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="https://www.editor.1clxlite.com/{{ base64_encode($bus->bname) }}">Site Editor</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="/logout">Logout</a>
                                </li>
                                @elseif(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
                                @foreach($connect as $connects)
                                <?php
                                $string = $connects->connected_bus;
                                $str_arr = explode(",", $string);
                                ?>
                                <?php if (in_array($ownerid, $str_arr) || $ownerid == session()->get('connection')) { ?>
                                    <!---->
                                <?php   } else { ?>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                        <button class="header-btn" id="connect" type="button" style="text-decoration:none;">
                                            <span class="btn-text" id="connected">Connect</span>
                                        </button>
                                    </li>
                                <?php   }   ?>
                                @endforeach
                                <script>
                                    $("#connect").click(function() {
                                        $.ajax({
                                            url: '/join_connection',
                                            type: "POST",
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                connection_id: {
                                                    {
                                                        $ownerid
                                                    }
                                                }
                                            },
                                            cache: false,
                                            dataType: 'json',
                                            success: function(dataResult) {
                                                console.log(dataResult);
                                                $("#connected").html("connected");
                                            },
                                            error: function() {
                                                // alert("error");
                                            }
                                        });
                                    });
                                </script>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="<?php echo "/ecx-dashboard"; ?>">Dashboard</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="<?php echo "/ecx-dashboard/checkout/" . $ownerid; ?>">Checkout</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a href="/ecx-logout">Logout</a>
                                </li>
                                @else
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4634">
                                    <a class="header-btn" href="{{ '/'.$bname.'/login' }}">
                                        <span class="btn-text">Sign In | Sign Up</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header-->

        <div id="content" class="site-content">
            <div data-elementor-type="wp-page" id="Home" data-elementor-id="6868" class="elementor elementor-6868" data-elementor-settings="[]">
                <div class="elementor-section-wrap">

                    <!--------slider------->
                    <?php
                    if ($results_layout->banner == '1') { ?>
                    <div id="slidesection">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div id="act1" class="carousel-item active" data-bs-interval="3000">
                                    <?php if ($buscon->slide1 != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $buscon->slide1 }}" class="d-block w-100" alt="...">
                                    <?php } elseif ($bus->header != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $bus->header }}" class="d-block w-100" alt="...">
                                    <?php   } else { ?>
                                        <img class="cimg" id="slisimg1" src='https://www.1clxlite.com/assets/images/slider-one.png' class="d-block w-100" alt="...">
                                    <?php    } ?>
                                    <div class="carousel-caption">
                                        <h3 id="htxt1" class="hetxt text-uppercase">
                                            <?php if ($buscon->banner_heading1 == null) { ?>
                                                START YOUR BUSINESS
                                            <?php } else { ?>
                                                {!! $buscon->banner_heading1 !!}
                                            <?php } ?>
                                        </h3>
                                        <p id="ctxt1" class="cotxt">
                                            <?php if ($buscon->banner_text1 == null) { ?>
                                                Our expertise, as well as our passion for web design set us aport from other agencies.
                                            <?php } else { ?>
                                                {!! $buscon->banner_text1 !!}
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                                <div id="act2" class="carousel-item" data-bs-interval="3000">
                                    <?php if ($buscon->slide2 != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $buscon->slide2 }}" class="d-block w-100" alt="...">
                                    <?php } elseif ($bus->header != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $bus->header }}" class="d-block w-100" alt="...">
                                    <?php   } else { ?>
                                        <img class="cimg" id="slisimg1" src='https://www.1clxlite.com/assets/images/slider-one.png' class="d-block w-100" alt="...">
                                    <?php    } ?>
                                    <div class="carousel-caption">
                                        <h3 id="htxt2" class="hetxt text-uppercase">
                                            <?php if ($buscon->banner_heading2 == null) { ?>
                                                START YOUR BUSINESS
                                            <?php } else { ?>
                                                {!! $buscon->banner_heading2 !!}
                                            <?php } ?>
                                        </h3>
                                        <p id="ctxt2" class="cotxt">
                                            <?php if ($buscon->banner_text2 == null) { ?>
                                                Our expertise, as well as our passion for web design set us aport from other agencies.
                                            <?php } else { ?>
                                                {!! $buscon->banner_text2 !!}
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                                <div id="act3" class="carousel-item" data-bs-interval="3000">
                                    <?php if ($buscon->slide3 != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $buscon->slide3 }}" class="d-block w-100" alt="...">
                                    <?php } elseif ($bus->header != null) { ?>
                                        <img class="cimg" id="slisimg1" src="https://www.1clxlite.com/business/{{ $bus->header }}" class="d-block w-100" alt="...">
                                    <?php   } else { ?>
                                        <img class="cimg" id="slisimg1" src='https://www.1clxlite.com/assets/images/slider-one.png' class="d-block w-100" alt="...">
                                    <?php    } ?>
                                    <div class="carousel-caption">
                                        <h3 id="htxt3" class="hetxt text-uppercase">
                                            <?php if ($buscon->banner_heading3 == null) { ?>
                                                START YOUR BUSINESS
                                            <?php } else { ?>
                                                {!! $buscon->banner_heading3 !!}
                                            <?php } ?>
                                        </h3>
                                        <p id="ctxt3" class="cotxt">
                                            <?php if ($buscon->banner_text3 == null) { ?>
                                                Our expertise, as well as our passion for web design set us aport from other agencies.
                                            <?php } else { ?>
                                                {!! $buscon->banner_text3 !!}
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                <?php   }
                    ?>
                    <!-- Slider -->

                    <!-- Section two -->
                    <?php
                    if ($results_layout->layout_3 == '1') {     ?>
                        <section class="elementor-section elementor-top-section elementor-element elementor-element-535511dd elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="535511dd" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6c0c0b10" data-id="6c0c0b10" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-77251dc1 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="77251dc1" data-element_type="section">
                                            <div class="elementor-container elementor-column-gap-default" style="flex-wrap: wrap !important;">
                                                <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-74d86cba" data-id="74d86cba" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-28a499d3 elementor-invisible elementor-widget elementor-widget-rt-info-box" data-id="28a499d3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:200}" data-widget_type="rt-info-box.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="info-box info-style6">
                                                                    <div class="info-item  media-image">
                                                                        <?php if ($buscon->content9 == null) { ?>
                                                                            <div class="info-box-content">
                                                                                <div class="rtin-media">
                                                                                    <span class="rtin-img">
                                                                                        <i class="fas fa-chart-line"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <div style=" margin-left: 20px;">
                                                                                    <h3 class="info-title">Design & Build</h3>
                                                                                    <!--<div class="info-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>-->
                                                                                    <div class="info-text wrapper">
                                                                                        <div>
                                                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                                        </div>
                                                                                        <div class="toggle_btn">
                                                                                            <span class="toggle_text">Show More</span> <span class="arrow">
                                                                                                <i class="fa fa-angle-down"></i>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="info-text wrapper">
                                                                                <div>
                                                                                    <?php echo $buscon->content9; ?>
                                                                                </div>
                                                                                <div class="toggle_btn">
                                                                                    <span class="toggle_text">Show More</span> <span class="arrow">
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        <?php   }   ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-693322c9" data-id="693322c9" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-2b814d7d elementor-invisible elementor-widget elementor-widget-rt-info-box" data-id="2b814d7d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="rt-info-box.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="info-box info-style6">
                                                                    <div class="info-item  media-image">
                                                                        <?php if ($buscon->content10 == null) { ?>

                                                                            <div class="info-box-content">
                                                                                <div class="rtin-media">
                                                                                    <span class="rtin-img">
                                                                                        <i class="fas fa-chart-line"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <div style=" margin-left: 20px;">
                                                                                    <h3 class="info-title">Best Innovation</h3>
                                                                                    <!--<div class="info-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>-->
                                                                                    <div class="info-text wrapper1">
                                                                                        <div>
                                                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                                        </div>
                                                                                        <div class="toggle_btn1">
                                                                                            <span class="toggle_text1">Show More</span> <span class="arrow">
                                                                                                <i class="fa fa-angle-down"></i>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="info-text wrapper1">
                                                                                <div>
                                                                                    <?php echo $buscon->content10; ?>
                                                                                </div>
                                                                                <div class="toggle_btn1">
                                                                                    <span class="toggle_text1">Show More</span> <span class="arrow">
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-41fd4fc1" data-id="41fd4fc1" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-29e04fe4 elementor-invisible elementor-widget elementor-widget-rt-info-box" data-id="29e04fe4" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:600}" data-widget_type="rt-info-box.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="info-box info-style6">
                                                                    <div class="info-item  media-image">
                                                                        <?php if ($buscon->content11 == null) { ?>
                                                                            <div class="info-box-content">
                                                                                <div class="rtin-media">
                                                                                    <span class="rtin-img">
                                                                                        <i class="fas fa-chart-line"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <div style=" margin-left: 20px;">
                                                                                    <h3 class="info-title">Great Expreiences</h3>
                                                                                    <div class="info-text wrapper2">
                                                                                        <div >
                                                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                                                        </div>
                                                                                        <div class="toggle_btn2">
                                                                                            <span class="toggle_text2">Show More</span> <span class="arrow">
                                                                                                <i class="fa fa-angle-down"></i>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="info-text wrapper2">
                                                                                <div>
                                                                                    <?php echo $buscon->content11; ?>
                                                                                </div>
                                                                                <div class="toggle_btn2">
                                                                                    <span class="toggle_text2">Show More</span> <span class="arrow">
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Section two -->
                    <?php   }
                    ?>

                    <!-- About Section -->
                    <?php
                    if ($results_layout->layout_4 == '1') {     ?>
                        <section id="About" class="elementor-section elementor-top-section elementor-element elementor-element-2ae4103e about-us-section motion-effects-wrap elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="2ae4103e" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-top-column elementor-element elementor-element-6323890e" data-id="6323890e" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-692c7612 elementor-widget elementor-widget-rt-image" data-id="692c7612" data-element_type="widget" data-widget_type="rt-image.default">
                                            <div class="elementor-widget-container">
                                                <div class="image-default rt-animate wow fadeInDown image-style6 motion-effects-wrap" data-wow-delay=".2s">
                                                    <div class="image-box">
                                                        <ul class="image-shape d-none d-xl-block">
                                                            <li class="motion-effects1">
                                                                <img src="https://1clxlite.com/assets/template/images/shape31.png" alt="">
                                                            </li>
                                                        </ul>
                                                        <?php if ($buscon->content12 == null) { ?>
                                                            <img width="570" height="650" src="https://1clxlite.com/assets/template/images/about.png" class="attachment-full size-full" alt="" loading="lazy" />
                                                        <?php } else { ?>
                                                            <img width="570" height="650" src="https://1clxlite.com/business/{{ $buscon->content12 }}" class="attachment-full size-full" alt="" loading="lazy" />
                                                        <?php }   ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-70ab8643 about-right rt-animate wow fadeInUp" data-id="70ab8643" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-f19b5b2 elementor-widget elementor-widget-rt-text-with-button" data-id="f19b5b2" data-element_type="widget" data-widget_type="rt-text-with-button.default">
                                            <div class="elementor-widget-container">
                                                <div class="title-text-button barshow text-style1">
                                                    <h4 class="subtitle style2">About Us<span class="title-bar1"></span><span class="title-bar2"></span></h4>

                                                <?php if ($buscon->content13 == null) { ?>

                                                    <h2 class="section-title" style="text-transform: uppercase;">Thinks we do for our clients<span class="dot">.</span></h2>
                                                    <div class="section-content">
                                                        <p>{{$bus->descript}}</p>
                                                    </div>

                                                <?php } else {
                                                    echo $buscon->content13;
                                                } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-342be4a6 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="342be4a6" data-element_type="section">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-40994c25" data-id="40994c25" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-208b3c78 elementor-widget elementor-widget-text-editor" data-id="208b3c78" data-element_type="widget" data-widget_type="text-editor.default">
                                                            <div class="elementor-widget-container">
                                                                <style>
                                                                    /*! elementor - v3.5.5 - 03-02-2022 */

                                                                    .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap {
                                                                        background-color: #818a91;
                                                                        color: #fff
                                                                    }

                                                                    .elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap {
                                                                        color: #818a91;
                                                                        border: 3px solid;
                                                                        background-color: transparent
                                                                    }

                                                                    .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap {
                                                                        margin-top: 8px
                                                                    }

                                                                    .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter {
                                                                        width: 1em;
                                                                        height: 1em
                                                                    }

                                                                    .elementor-widget-text-editor .elementor-drop-cap {
                                                                        float: left;
                                                                        text-align: center;
                                                                        line-height: 1;
                                                                        font-size: 50px
                                                                    }

                                                                    .elementor-widget-text-editor .elementor-drop-cap-letter {
                                                                        display: inline-block
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End About Section -->
                    <?php   }
                    ?>

                    <!-- Service Slider -->
                    <?php
                    if ($results_layout->layout_7 == '1') {
                        if ($results_layout->dash_service == '1') {
                    ?>
                            <section id="Services" class="elementor-section elementor-top-section elementor-element elementor-element-265b071f elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="265b071f" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4318e618" data-id="4318e618" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-10411367 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="10411367" data-element_type="section">
                                                <div class="elementor-container elementor-column-gap-default">
                                                    <div class="elementor-column elementor-col-60 elementor-inner-column elementor-element elementor-element-4bbe3e0d" data-id="4bbe3e0d" data-element_type="column">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div class="elementor-element elementor-element-67bcab18 elementor-widget elementor-widget-rt-text-with-button" data-id="67bcab18" data-element_type="widget" data-widget_type="rt-text-with-button.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="title-text-button barshow text-style1">
                                                                    <h4 class="subtitle style2">SERVICES<span class="title-bar1"></span><span class="title-bar2"></span></h4>

                                                                    <?php if ($buscon->content14 == null || $buscon->content14 == 'undefined' || $buscon->content14 == '<p>undefined</p>' ) { ?>
                                                                            <h2 class="section-title" style="text-transform: uppercase;">OUR SERVICES CART<span class="dot">.</span></h2>
                                                                            <div class="section-content"></div>
                                                                    <?php } else {
                                                                        if(isset($buscon->content14) && $buscon->content14!='undefined'){
                                                                            echo $buscon->content14;
                                                                        }
                                                                    } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-40 elementor-inner-column elementor-element elementor-element-44e9d990" data-id="44e9d990" data-element_type="column">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div class="elementor-element elementor-element-14c0718e elementor-widget elementor-widget-text-editor" data-id="14c0718e" data-element_type="widget" data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <?php if ($buscon->content15 == null || $buscon->content15 == 'undefined' || $buscon->content15 == '<p>undefined</p>' ) { ?>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipissed do eius mod tempor incididunt ut laboret amet.</p>
                                                                    <?php } else {
                                                                        if(isset($buscon->content15) && $buscon->content15!='undefined'){
                                                                            echo $buscon->content15;
                                                                        }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <?php
                                            $pi = 0;
                                            $userid = $bus->userid;
                                            $service_arr = DB::table('services')->select('*')->where('user_id', $userid)->where('visibility', '1')->where('is_active', '0')->orderBy('id', 'desc')->get();
                                            $ServiceCount = $service_arr->count();
                                            if ($ServiceCount != 0) {
                                                ?>
                                                <div class="elementor-section elementor-inner-section elementor-element elementor-element-2f6d7bd7 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="77817500" data-element_type="widget" data-widget_type="rt-portfolio.default">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <style>
                                                            .callback-btn.out_of_stock {
                                                                cursor: not-allowed !important;
                                                            }

                                                            .product-carousel .product-image {
                                                                align-self: center;
                                                                width: auto !important;
                                                                max-height: 300px;
                                                                height: auto;
                                                            }

                                                            .product-carousel .product-top {
                                                                height: 300px !important;
                                                                display: flex;
                                                                flex-direction: row;
                                                                align-content: center;
                                                                justify-content: center;
                                                                align-items: center;
                                                                flex-wrap: nowrap;
                                                            }

                                                            .product .callback-btn {
                                                                border-radius: 40px;
                                                                margin-top: 10px;
                                                                box-shadow: 0px 3px 12px 3px #ffffff17;
                                                                color: var(--primary-based-color);
                                                                font-size: 18px;
                                                                padding: 8px 20px;
                                                            }
                                                        </style>
                                                        <div class="product-carousel">
                                                            <?php
                                                            foreach ($service_arr as $services) {
                                                            ?>
                                                                <div class="product">
                                                                    <div class="product-top">
                                                                        <img class="product-image" src="https://www.1clxlite.com/public/service/{{ $services->image }}" alt="{{   $services->alt_tag   }}" />
                                                                    </div>
                                                                    <div class="product-bottom">
                                                                        <div class="product-name">
                                                                            <p style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 100%;">{{ $services->name     }}</p>
                                                                        </div>
                                                                        <p style="margin:auto;">
                                                                            ₹ {{$services->price}}
                                                                        </p>
                                                                        <!--<p class="product-prices" style="margin:auto;"> -->
                                                                        <!--<div class="check_price">-->
                                                                        <!--    <span class="price-save">₹ {{$services->price}}</span>-->
                                                                        <!--    @if($services->price!=0.00 && $services->price!="" && $services->price!=$services->price)-->
                                                                        <!--        <div class="price-was"> - ${{   $services->price     }}</div>-->
                                                                        <!--    @endif-->
                                                                        <!--</div>-->
                                                                        <!--</p>-->
                                                                        <p style="margin:auto;color:black !important">
                                                                            <?php
                                                                            if (session()->has('busid')) {
                                                                                if (session()->get('type') != 'user') { ?>
                                                                                    <a href="/checkout/{{ $services->id }}"><button type="button" class="callback-btn add_to_cart_btn subscribe_fun btn-sm" style="width: auto;">Subscribe</button></a>
                                                                                   <button type="button" class="callback-btn add_to_cart_btn" style="width: auto;" <?php if (session()->get('type') == 'user') { echo "disabled"; } ?> data-id="{{ $services->id }}" data-bus="{{ $ownerid }}" data-price="{{ $services->price }}" user-id="{{ session()->get('busid') }}">Add To Cart</button>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <button type="button" class="btn callback-btn add_to_cart_btn" style="background:#3659b2" onclick="checkoutcart()">
                                                                                    <span>Subscribe</span>
                                                                                </button>
                                                                            <?php } ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                                $pi++;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            else {
                                                if (session()->get('type') == 'user') { ?>
                                                    <div class="container">
                                                        <a href="/service/create" target="_blank"><button type="button">New item</button></a>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    <?php
                        }
                    }
                    ?>

                    <!-- Product Slider -->
                    <?php
                    if ($results_layout->layout_16 == '1') {
                        if ($results_layout->dash_ecom == '1') {
                    ?>
                            <section id="products" class="elementor-section elementor-top-section elementor-element elementor-element-265b071f elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="265b071f" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4318e618" data-id="4318e618" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <section class="elementor-section elementor-inner-section elementor-element elementor-element-10411367 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="10411367" data-element_type="section">
                                                <div class="elementor-container elementor-column-gap-default">
                                                    <div class="elementor-column elementor-col-60 elementor-inner-column elementor-element elementor-element-4bbe3e0d" data-id="4bbe3e0d" data-element_type="column">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div class="elementor-element elementor-element-67bcab18 elementor-widget elementor-widget-rt-text-with-button" data-id="67bcab18" data-element_type="widget" data-widget_type="rt-text-with-button.default">
                                                                <div class="elementor-widget-container">
                                                                    <div class="title-text-button barshow text-style1">
                                                                    <h4 class="subtitle style2">PRODUCTS<span class="title-bar1"></span><span class="title-bar2"></span></h4>
                                                                    <?php if ($buscon->content34 == null || $buscon->content34 == 'undefined' || $buscon->content34 == '<p>undefined</p>' ) { ?>
                                                                        <h2 class="section-title" style="text-transform: uppercase;">OUR PRODUCTS SHOPPING CART<span class="dot">.</span></h2>
                                                                            <div class="section-content"></div>
                                                                    <?php } else {
                                                                        if(isset($buscon->content34) && $buscon->content35!='undefined' && $buscon->content35!="<p>undefined</p>"){
                                                                            echo $buscon->content34;
                                                                        }
                                                                    } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-40 elementor-inner-column elementor-element elementor-element-44e9d990" data-id="44e9d990" data-element_type="column">
                                                        <div class="elementor-widget-wrap elementor-element-populated">
                                                            <div class="elementor-element elementor-element-14c0718e elementor-widget elementor-widget-text-editor" data-id="14c0718e" data-element_type="widget" data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <?php if ($buscon->content35 == null || $buscon->content35 == 'undefined' || $buscon->content35 == '<p>undefined</p>' ) { ?>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipissed do eius mod tempor incididunt ut laboret amet.</p>
                                                                    <?php } else {
                                                                        if(isset($buscon->content35) && $buscon->content35!='undefined' && $buscon->content35!="<p>undefined</p>"){
                                                                            echo $buscon->content35;
                                                                        }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <?php
                                            $pi = 0;
                                            $userid = $bus->userid;
                                            $product_arr = DB::table('products')->select('*')->where('user_id', $userid)->where('visibility', '1')->where('is_active', '0')->orderBy('id', 'desc')->get();
                                            $ProductCount = $product_arr->count();
                                            if ($ProductCount != 0) {
                                            ?>
                                                <div class="elementor-section elementor-inner-section elementor-element elementor-element-2f6d7bd7 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="77817500" data-element_type="widget" data-widget_type="rt-portfolio.default">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <style>
                                                            .callback-btn.out_of_stock {
                                                                cursor: not-allowed !important;
                                                            }

                                                            .product-carousel .product-image {
                                                                align-self: center;
                                                                width: auto !important;
                                                                max-height: 300px;
                                                                height: auto;
                                                            }

                                                            .product-carousel .product-top {
                                                                height: 300px !important;
                                                                display: flex;
                                                                flex-direction: row;
                                                                align-content: center;
                                                                justify-content: center;
                                                                align-items: center;
                                                                flex-wrap: nowrap;
                                                            }

                                                            .product .callback-btn {
                                                                border-radius: 40px;
                                                                margin-top: 10px;
                                                                box-shadow: 0px 3px 12px 3px #ffffff17;
                                                                color: var(--primary-based-color);
                                                                font-size: 18px;
                                                                padding: 8px 20px;
                                                            }
                                                        </style>
                                                        <div class="product-carousel">
                                                            <?php
                                                            foreach ($product_arr as $products) {
                                                            ?>
                                                                <div class="product">
                                                                    <div class="product-top">
                                                                        <img class="product-image" src="/public/products/{{ $products->main_img }}" alt="{{   $products->main_img_alt_tag     }}" />
                                                                    </div>
                                                                    <div class="product-bottom">
                                                                        <div class="product-name">
                                                                            <p style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 100%;">{{ $products->name     }}</p>
                                                                        </div>
                                                                        <p class="product-prices">
                                                                            <div class="check_price">
                                                                                <?php
                                                                                if($products->price_type=='1'){ ?>
                                                                                    <span class="price-save">₹{{ $products->price     }}</span>
                                                                                    @if($products->old_price!=0.00 && $products->old_price!="" && $products->old_price!=$products->price)
                                                                                    <div class="price-was">- ₹ {{ $products->old_price     }}</div>
                                                                                    @endif
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="star-rating">
                                                                                <?php
                                                                                $id = $products->id;
                                                                                $stars1 = DB::table('product_reviews')
                                                                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                                                                    ->where('product_reviews.rating', '=', 1)
                                                                                    ->where('product_reviews.product_id', '=', $id)
                                                                                    ->count();

                                                                                $stars2 = DB::table('product_reviews')
                                                                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                                                                    ->where('product_reviews.rating', '=', 2)
                                                                                    ->where('product_reviews.product_id', '=', $id)
                                                                                    ->count();

                                                                                $stars3 = DB::table('product_reviews')
                                                                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                                                                    ->where('product_reviews.rating', '=', 3)
                                                                                    ->where('product_reviews.product_id', '=', $id)
                                                                                    ->count();

                                                                                $stars4 = DB::table('product_reviews')
                                                                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                                                                    ->where('product_reviews.rating', '=', 4)
                                                                                    ->where('product_reviews.product_id', '=', $id)
                                                                                    ->count();

                                                                                $stars5 = DB::table('product_reviews')
                                                                                    ->select('product_reviews.rating', 'product_reviews.user_id')
                                                                                    ->where('product_reviews.rating', '=', 5)
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


                                                                                $val1 = $val2 = $val3 = $val4 = $val5 = $s1 = $s2 = $s3 = $s4 = $s5 = $all = "";

                                                                                if ($total_stars !== 0) {

                                                                                    $val1 = $star1 * 100 / $total_stars;
                                                                                    $val2 = $star2 * 100 / $total_stars;
                                                                                    $val3 = $star3 * 100 / $total_stars;
                                                                                    $val4 = $star4 * 100 / $total_stars;
                                                                                    $val5 = $star5 * 100 / $total_stars;

                                                                                    $all = round($sum_of_stars / $total_stars);

                                                                                    $s1 = round($val1, 2);
                                                                                    $s2 = round($val2, 2);
                                                                                    $s3 = round($val3, 2);
                                                                                    $s4 = round($val4, 2);
                                                                                    $s5 = round($val5, 2);
                                                                                }

                                                                                ?>
                                                                                <span>({{$total_stars}})</span>
                                                                                <input type="radio" id="5-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="5" disabled <?php if ($all == 5) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?> />
                                                                                <label for="5-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                                                                                <input type="radio" id="4-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="4" disabled <?php if ($all == 4) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?> />
                                                                                <label for="4-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                                                                                <input type="radio" id="3-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="3" disabled <?php if ($all == 3) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?> />
                                                                                <label for="3-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                                                                                <input type="radio" id="2-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="2" disabled <?php if ($all == 2) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?> />
                                                                                <label for="2-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                                                                                <input type="radio" id="1-star<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="1" disabled <?php if ($all == 1) {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?> />
                                                                                <label for="1-star<?php echo $pi; ?>" class="star">&#9733;</label>
                                                                            </div>
                                                                        </p>
                                                                        @if($products->qty<=0 || $products->stock==0)
                                                                            <button type="button" class="callback-btn out_of_stock" style="width: auto;">Out Of Stock</button>
                                                                        @else
                                                                        <p style="margin-bottom: 25px;"></p>
                                                                            <?php
                                                                            if($products->price_type=='0'){
                                                                                $pReq = DB::table('service_requests')->select('*')->where('product_id',$products->id)->where('owner_id', $products->user_id)->where('user_id', session()->get('busid'))->where('is_active', '0')->where('approved','!=', '2')->orderBy('id','desc')->first();
                                                                                if(!empty($pReq)){
                                                                                    if($pReq->approved==0){
                                                                                    ?>
                                                                                    <button type="button" class="callback-btn out_of_stock" style="width: auto;padding: 10px 15px;">Waiting Responce</button>
                                                                                    <?php
                                                                                    }
                                                                                    elseif($pReq->approved==1){
                                                                                        if($products->qty>=$pReq->expiry_date || $products->stock==2){
                                                                                            ?>
                                                                                            <a href="/checkout-product/{{ $pReq->id }}" class="callback-btn readmore" style="width: auto;padding: 10px 15px;">Payment Pending</a>
                                                                                            <?php
                                                                                        }
                                                                                        elseif($products->qty<=$pReq->expiry_date || $products->stock==0){
                                                                                            ?>
                                                                                            <button class="callback-btn readmore" onclick="cancel_invoice({{ $pReq->id }}, {{ $pReq->owner_id }})" type="button" style="width: auto;padding: 10px 15px;" title="Cancel Invoice">Qty Exceed</button>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    elseif($pReq->approved==2){
                                                                                        echo '<div class="row">';
                                                                                        if (session()->get('type') != 'user') {
                                                                                    ?>
                                                                                        <div class="col qty-box mb-3" id="hideqty{{ $products->id }}">
                                                                                            <p style="display:block !important; font-weight:400; margin-right:5px">Qty</p>
                                                                                            <input type="number" name="quantity" id="qty{{ $products->id }}" onkeypress="check_qty({{ $products->id }})" class="form-control input-number" min="1" value="1" onkeypress="return !(event.charCode < 48 || event.charCode > 57)">
                                                                                        </div>
                                                                                        <?php } ?>
                                                                                        <div class="col">
                                                                                            <button type="button" id="p_req_b{{ $products->id }}" onclick="product_reqest({{ $products->id }}, {{ $products->user_id }})" class="callback-btn readmore" style="width: auto;margin-top: 0;">Request</button>
                                                                                        </div>
                                                                                    <?php
                                                                                    echo '</div>';
                                                                                    }
                                                                                }
                                                                                else{
                                                                                    echo '<div class="row">';
                                                                                    if (session()->get('type') != 'user') {
                                                                            ?>
                                                                                <div class="col qty-box mb-3" id="hideqty{{ $products->id }}">
                                                                                    <div class="input-group">
                                                                                        <p style="display:block !important; font-weight:400; margin-right:5px">Qty</p>
                                                                                        <input type="number" name="quantity" id="qty{{ $products->id }}" onkeypress="check_qty({{ $products->id }})" class="form-control input-number" min="1" value="1" onkeypress="return !(event.charCode < 48 || event.charCode > 57)">
                                                                                    </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                                <div class="col">
                                                                                    <div class="product-buttons mb-0">
                                                                                        <button type="button" id="p_req_b{{ $products->id }}" onclick="product_reqest({{ $products->id }}, {{ $products->user_id }})" class="callback-btn readmore" style="width: auto;margin-top: 0;" <?php if (session()->get('type') == 'user') { echo "disabled"; } ?>>Request</button>
                                                                                    </div>
                                                                                </div>
                                                                        <?php
                                                                                echo '</div>';
                                                                                }
                                                                            }
                                                                            elseif($products->price_type=='1'){ ?>
                                                                                <button type="button" class="callback-btn add_to_cart_btn" style="width: auto;" <?php if (session()->get('type') == 'user') { echo "disabled"; } ?> data-id="{{ $products->id }}" data-bus="{{ $ownerid }}" data-price="{{ $products->price }}" user-id="{{ session()->get('busid') }}">Add To Cart</button>
                                                                            <?php } ?>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            <?php
                                                                $pi++;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else {
                                                if (session()->get('type') == 'user') { ?>
                                                <div class="container">
                                                    <a href="/product/create" target="_blank"><button type="button">New item</button></a>
                                                </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    <?php
                        }
                    }
                    ?>

                    <!-- Call To Action Three -->
                    <?php
                    if ($results_layout->layout_14 == '1') {     ?>
                        <section class="elementor-section elementor-top-section elementor-element elementor-element-5ffa141d elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="5ffa141d" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-44e69292" data-id="44e69292" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-54265fc0 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="54265fc0" data-element_type="section">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-column elementor-col-70 elementor-inner-column elementor-element elementor-element-57884931" data-id="57884931" data-element_type="column" style="width: 70%;">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-3cfbaa97 elementor-widget elementor-widget-rt-text-with-button" data-id="3cfbaa97" data-element_type="widget" data-widget_type="rt-text-with-button.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="title-text-button barhide text-style1 mb-4">
                                                                    <?php if ($buscon->content22 == null) { ?>


                                                                        <h2 class="section-title">Like our service? Subscribe us</h2>
                                                                        <div class="section-content serviceee">
                                                                            <p>sign up to get new exclusive offers from our latest solutions</p>
                                                                        </div>


                                                                    <?php } else {
                                                                        echo $buscon->content22;
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-column elementor-col-30 elementor-inner-column elementor-element elementor-element-62b73f66" data-id="62b73f66" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-23232619 fluentform-widget-submit-button-custom elementor-widget elementor-widget-fluent-form-widget" data-id="23232619" data-element_type="widget" data-widget_type="fluent-form-widget.default">
                                                            <div class="elementor-widget-container">

                                                                <div class="fluentform-widget-wrapper fluentform-widget-align-default">


                                                                    <div class='fluentform fluentform_wrapper_8'>
                                                                        <form data-form_id="8" id="fluentform_8" class="frm-fluent-form fluent_form_8 ff-el-form-top ff_form_instance_8_2 ff-form-loading" data-form_instance="ff_form_instance_8_2" method="POST"><input type='hidden' name='__fluent_form_embded_post_id' value='6868' /><input type="hidden" id="_fluentform_8_fluentformnonce" name="_fluentform_8_fluentformnonce" value="37f99a00a0" /><input type="hidden" name="_wp_http_referer" value="/demo/wordpress/themes/finbuzz/" />
                                                                            <div data-name="ff_cn_id_1" class='ff-t-container ff-column-container ff_columns_total_2 subscribe-form '>
                                                                                <div class='ff-t-cell ff-t-column-1'>
                                                                                    <div class='ff-el-group ff-el-form-hide_label'>
                                                                                        <div class='ff-el-input--content'>
                                                                                            <input type="hidden" id="news_bid" value="{{ $ownerid }}">
                                                                                            <input type="hidden" id="news_btype" value="{{session()->get('type')}}">
                                                                                            <input type="email" id="news_email" placeholder="Enter Email Address" value="" class="ff-el-form-control" autocomplete="off" style="width: 299px;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='ff-t-cell ff-t-column-2'>
                                                                                    <div class='ff-el-group ff-text-left ff_submit_btn_wrapper ff_submit_btn_wrapper_custom' style="float:right;">
                                                                                        <button class="ff-btn ff-btn-submit ff-btn-md ff_btn_style wpf_has_custom_css" type="button" onclick="newsletter();">Subscribe</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p id="msgge" class=""></p>
                                                                    </div>
                                                                    <!--<div id='fluentform_8_errors' class='ff-errors-in-stack ff_form_instance_8_2 ff-form-loading_errors ff_form_instance_8_2_errors'></div>-->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End Call To Action Three -->
                    <?php   }
                    ?>

                    <!-- Map -->
                    <?php
                    if ($results_layout->map == '1') { ?>
                        <div style="position:relative">
                            <div class="block_layout map <?php if ($results_layout->map == '0') { echo "hide_layout"; } ?>">
                                <section id="Contact" class="elementor-section elementor-top-section elementor-element elementor-element-4d9b34bb elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="4d9b34bb" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}" style="left: 0px;">
                                    <div class="elementor-container elementor-column-gap-default">
                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-c0150d1" data-id="c0150d1" data-element_type="column">
                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                <div class="elementor-element elementor-element-1a38112 elementor-widget elementor-widget-google_maps" data-id="1a38112" data-element_type="widget" data-widget_type="google_maps.default">
                                                    <div class="elementor-widget-container">
                                                        <style>
                                                            .elementor-widget-google_maps .elementor-widget-container {
                                                                overflow: hidden
                                                            }

                                                            .elementor-widget-google_maps iframe {
                                                                height: 500px
                                                            }
                                                        </style>

                                                        <div class="elementor-custom-embed">
                                                            <div data-component-maps="" style="min-height:500px;max-width:100%;position:relative">
                                                                <?php
                                                                    $mapsrc = "https://maps.google.com/maps?q=" . $business_lat . "," . $business_lag . "&hl=en&z=14&output=embed";
                                                                ?>
                                                                <iframe frameborder="0" src="{{ $mapsrc }}" width="300" height="170" style="width:100%;height:500px;left:0px;pointer-events:none" marginheight="0" marginwidth="0"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    <?php   }
                    ?>

                </div>
            </div>
        </div>
        <!--#content-->

        <?php
        if ($results_layout->footer == '1') {     ?>
            <footer>
                <div id="footer-3" class="footer-area">

                    <div class="footer-top-area has-footer-img">
                        <div class="container-fluid">
                            <div class="footer-top-widget container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">

                                        <div id="media_image-6" class="widget widget_media_image">
                                            <?php if ($buscon->content23 != null) { ?>
                                                <img height="45" src='https://www.1clxlite.com/business/{{ $buscon->content23 }}") }}' class="image wp-image-6739  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" />
                                            <?php } elseif ($bus->logo != null) { ?>
                                                <img height="45" src='https://www.1clxlite.com/business/{{ $bus->logo }}") }}' class="image wp-image-6739  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" />
                                            <?php } else { ?>
                                                <img height="45" src='https://www.1clxlite.com/public/theme/images/1clx_blue_logo.png' class="image wp-image-6739  attachment-medium size-medium" alt="" loading="lazy" style="max-width: 100%; height: auto;" />
                                            <?php } ?>
                                        </div>
                                        <div id="rt-about-social-5" class="widget rt_footer_social_widget">
                                            <div class="rt-about-widget">
                                                <?php if ($buscon->content24 == null) { ?>
                                                    <div class="footer-about">elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi nullam vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique</div>
                                                <?php } else {
                                                    echo $buscon->content24;
                                                } ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div id="finbuzz_address-5" class="widget widget_finbuzz_address">
                                            <?php if ($buscon->content25 == null) { ?>
                                                <h3 class="widgettitle ">Contact Details</h3>
                                                <p class="rtin-des"></p>
                                                <ul class="corporate-address">
                                                    <li><i class="fas fa-map-marker-alt"></i>{{$bus->address}},{{$bus->state}},{{$bus->country}},{{$bus->pincode}}</li>
                                                    <li><i class="fas fa-phone-alt"></i> <a href="tel:{{$bus->phone}}">{{$bus->phone}}</a></li>
                                                    <li><i class="far fa-envelope"></i> <a href="mailto:{{$bus->email}}">{{$bus->email}}</a></li>
                                                </ul>
                                            <?php } else {
                                                echo $buscon->content25;
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div id="media_gallery-3" class="widget widget_media_gallery">
                                            <h3 class="widgettitle ">Contact Form</h3>
                                            <div class="newsletter-form">
                                                <div class="form-group">
                                                    <div class="response"></div>
                                                </div>
                                                <div class="row" style="padding-bottom: 20px;">
                                                    <div class="col">
                                                        <input type="hidden" id="contact_btype" value="{{session()->get('type')}}">
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="">
                                                        <p id="namemsgge" class=""></p>
                                                    </div>
                                                    <div class="col">
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
                                                        <p id="emailmsgge" class=""></p>
                                                    </div>
                                                </div>
                                                <div class="row" style="padding-bottom: 20px;">
                                                    <div class="col">
                                                        <textarea name="message" id="msg" class="form-control" placeholder="Message"></textarea>
                                                        <p id="msgmsgge" class=""></p>
                                                    </div>
                                                </div>
                                                <div class="row" style="display: flex;justify-content: center;">
                                                    <button type="button" onclick="contactform()" class="callback-btn" style="width: auto;">Send Message</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid bottom_footer" style="background-color: var(--primary-color) !important;">
                                <div class="copyright_wrap container">
                                    <?php if ($buscon->content27 == null) { ?>
                                        <div class="copyright">&copy; Copyright 2022, All Rights Reserved</div>
                                    <?php } else {
                                        echo $buscon->content27;
                                    } ?>
                                    <?php if ($buscon->content26 == null) { ?>
                                        <ul class="footer-social" id="footer_social_icons">
                                            <li><a class="facebook_tag" href="https://www.facebook.com/1clx-101517669305364" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a class="twitter_tag" href="https://twitter.com/1clxusa" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a class="linkedin_tag" href="https://www.linkedin.com/company/1clx" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a class="instagram_tag" href="https://www.instagram.com/1clxusa/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    <?php } else {
                                        echo $buscon->content26;
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <?php   }
        ?>
    </div>
    <style>
        form.fluent_form_7 .wpf_has_custom_css.ff-btn-submit:hover {
            background-color: rgba(255, 255, 255, 1);
        }
    </style>

    <!--Cart-->
    <script>
        function checkoutcart() {
            modalBox.style = "display: flex;";
        }
        function cancel_invoice(a, b){
            var id = a;
            var pcx = b;

            $.ajax({
                url: "/cancel_invoice",
                type: "post",
                data: {
                    _token:'{{ csrf_token() }}',
                    id: id,
                    owner: pcx
                },
                cache: false,
                dataType: 'json',
                success: function (dataResult) {
                    var resultData = dataResult.statusCode;
                    if(resultData==100){
                        location.reload();
                    }
                    else{
                        alert(dataResult.value);
                    }
                    return false;
                },
            });
        }
        $("input.cart_qty").change(function() {
            var qty = $(this).val();
            var id = $(this).attr('data-id');
            var user_id = $(this).attr('user-id');
            var bid = $(this).attr('bus-id');
            var price = $(this).attr('data-amount');
            $.ajax({
                url: "/ajaxCartQty/12",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    qty: qty,
                    user_id: user_id,
                    bid: bid,
                    id: id,
                    price: price
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    var resultData = dataResult.statusCode;
                    if (resultData == 200) {
                        modalBox.style = "display: flex;";
                    }
                    if (resultData == 300) {
                        $("#checkout_ttl_amount").val(dataResult.total);
                        $("#cart_total_amount").html("₹" + dataResult.total);
                    }
                    return false;
                },
            });
        });
        function product_reqest(a, b){
            var id = a;
            var owner = b;
            var user = "{{ session()->get('busid') }}";
            $(".parent_loader").css('display', 'block');
            if($('#qty'+a).val()>0){
                $('#qty'+a).removeClass("border_red");
                $.ajax({
                    url: "/sendproductrequest",
                    type: "post",
                    data: {
                        _token:'{{ csrf_token() }}',
                        id: id,
                        owner: owner,
                        user: user,
                        qty: $('#qty'+a).val(),
                    },
                    cache: false,
                    dataType: 'json',
                    success: function (dataResult) {
                        var resultData = dataResult.statusCode;
                        if(resultData==300){
                            $('#hideqty'+id).css('display', 'none');
                            $("#p_req_b"+id).html('Waiting Responce');
                            $("#p_req_b"+id).attr("disabled", true);
                        }
                        else if(resultData==200){
                            alert('Maximum Quantity '+dataResult.value);
                        }
                        else{
                            $(".requestclass"+id).html(dataResult.value);
                            $(".requestclass"+id).attr("disabled", true);
                        }
                        $(".parent_loader").css('display', 'none');
                        return false;
                    },
                });
            }
            else{
                $('#qty'+a).addClass("border_red");
                $(".parent_loader").css('display', 'none');
            }
        }
        function check_qty(a){
            var id = a;
            var qty = $('#qty'+a).val();
            if(qty>0){
                $('#qty'+a).removeClass("border_red");
                $.ajax({
                    url: "/check-qty",
                    type: "post",
                    data: {
                        _token:'{{ csrf_token() }}',
                        id: id,
                        qty: $('#qty'+a).val()
                    },
                    cache: false,
                    dataType: 'json',
                    success: function (dataResult) {
                        var resultData = dataResult.statusCode;
                        if(resultData==200){
                            alert('Maximum Quantity '+dataResult.value);
                            $('#qty'+a).val('1');
                        }
                    },
                });
            }
            else{
                $('#qty'+a).addClass("border_red");
            }
        }

         $('.add_to_cart_btn').click(function() {
            var product_id = $(this).attr('data-id');
            var bus_id = $(this).attr('data-bus');
            var user_id = $(this).attr('user-id');

            $.ajax({
                url: "/ajaxCart/12",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    bus_id: bus_id,
                    user_id: user_id
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.statusCode;
                    if (resultData == 200) {
                        alert('Please Login Your Account');
                    }
                    if (resultData == 400) {
                        alert('Out Of Stock');
                    }
                    if (resultData == 100) {
                        $("#cart_total_count").html(dataResult.count);
                        $("#cart_details_append").html(dataResult.HTML);
                        $("#checkout_ttl_amount").val(dataResult.total);
                        $("#cart_total_amount").html("₹" + dataResult.total);
                    }
                    return false;
                },
            });
        });

        $('.subscribe_fun').click(function() {
            var product_id = $(this).attr('data-id');
            var bus_id = $(this).attr('data-bus');
            var user_id = $(this).attr('user-id');

            $.ajax({
                url: "/ajaxCart/12",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    bus_id: bus_id,
                    user_id: user_id
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.statusCode;
                    if (resultData == 200) {
                        // alert('Please Login Your Account');
                        modalBox.style = "display: flex;";
                    }
                    if (resultData == 400) {
                        alert('Out Of Stock');
                    }
                    if (resultData == 100) {
                        $("#cart_total_count").html(dataResult.count);
                        $("#cart_details_append").html(dataResult.HTML);
                        $("#checkout_ttl_amount").val(dataResult.total);
                        $("#cart_total_amount").html("₹" + dataResult.total);
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
            var hide = "hide_cart_row" + cart_id;
            if (confirm(text) == true) {
                $.ajax({
                    url: "/ajaxCartRemove/12",
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: cart_id,
                        bus_id: bus_id,
                        user_id: user_id
                    },
                    cache: false,
                    dataType: 'json',
                    success: function(dataResult) {
                        console.log(dataResult);
                        var resultData = dataResult.statusCode;
                        if (resultData == 200) {
                            alert('Something went wrong');
                        }
                        if (resultData == 300) {
                            $("#cart_total_count").html(dataResult.count);
                            $("#cart_details_append").html(dataResult.HTML);
                            $("#checkout_ttl_amount").val(dataResult.total);
                            $("#cart_total_amount").html("₹" + dataResult.total);
                        }
                        return false;
                    },
                });
            }
        }
    </script>
    <!--End Cart-->

    <!--Popup-->
    <script src="https://kit.fontawesome.com/28157a8fdb.js" crossorigin="anonymous"></script>
    <div class="login-modal-container">
        <div class="login-modal-content">
            <div class="login-modal-header" style="display:none">
              <h2>Title</h2>
              <i class="close-btn fas fa-close"></i>
            </div>
            <div class="login-modal-body">
                <div class="form1 mx-auto w-75">
                    <div id="signinform">
                        <div id="logo_signinform">
                            <img src="/assets/images/logo.png" class="logo1">
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <h1 class="text-center heading">Please login your account!</h1>
                            <div class="d-grid">
                                <h4 id="smsg"></h4>
                                <a href="/login" class="btn btn-primary">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modalBox = document.querySelector(".login-modal-container");
        // const modalBtn = document.querySelector(".modal-btn");
        const closeBtn = document.querySelector(".close-btn");

        // modalBtn.addEventListener("click", () => {
        //     modalBox.style = "display: flex;";
        // });

        closeBtn.addEventListener("click", () => {
            modalBox.style = "display: none;";
        });

        window.addEventListener("click", (e) => {
            if (e.target == modalBox) {
                modalBox.style = "display: none;";
            }
        });
    </script>
    <!--End Popup-->

    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://kenwheeler.github.io/slick/slick/slick.js'></script>

    <!--Product and Service Slider-->
    <script src='https://www.1clxlite.com/assets/js/custom/carousel-template-one.js'></script>

    <!--Map-->
    <script src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_MAP_API_KEY");}}&callback=initMap&libraries=&v=weekly" async></script>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: {{ $bus->lat }},
                lng: {{ $bus->lng }}
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 18,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
        $(".sidebarBtn_toggle").click(function() {
            $("#meanmenu .rt-slide-nav").toggleClass("show_nav");
        });
    </script>

    <script>
        // next button
        $(".carousel-control-next").click(function(){
            var slide1 = $('#act1').attr('class');
            var slide2 = $('#act2').attr('class');
            var slide3 = $('#act3').attr('class');
            var slide1_active = slide1.match("active");
            var slide2_active = slide2.match("active");
            var slide3_active = slide3.match("active");

            if(slide1_active == "active"){
                $('#act1').removeClass('active');
                $('#act2').addClass('active');
                $('#act3').removeClass('active');
            }else if(slide2_active == "active"){
                $('#act1').removeClass('active');
                $('#act2').removeClass('active');
                $('#act3').addClass('active');
            }else if(slide3_active == "active"){
                $('#act1').addClass('active');
                $('#act2').removeClass('active');
                $('#act3').removeClass('active');
            }else{
                 $('#act1').addClass('active');
                $('#act2').removeClass('active');
                $('#act3').removeClass('active');
            }

        });

        // prev button
        $(".carousel-control-prev").click(function(){
            var slide1 = $('#act1').attr('class');
            var slide2 = $('#act2').attr('class');
            var slide3 = $('#act3').attr('class');
            var slide1_active = slide1.match("active");
            var slide2_active = slide2.match("active");
            var slide3_active = slide3.match("active");

            if(slide1_active == "active"){
                $('#act1').removeClass('active');
                $('#act2').removeClass('active');
                $('#act3').addClass('active');
            }else if(slide2_active == "active"){
                $('#act1').addClass('active');
                $('#act2').removeClass('active');
                $('#act3').removeClass('active');
            }else if(slide3_active == "active"){
                $('#act1').removeClass('active');
                $('#act2').addClass('active');
                $('#act3').removeClass('active');
            }else{
                 $('#act1').addClass('active');
                $('#act2').removeClass('active');
                $('#act3').removeClass('active');
            }

        });

        $(document).ready(function () {
            $(".facebook_tag").attr('target', '_blank');
            $(".twitter_tag").attr('target', '_blank');
            $(".linkedin_tag").attr('target', '_blank');
            $(".instagram_tag").attr('target', '_blank');
        });

    </script>

    <!--Contact Form & Newsletter-->
    <script src='https://www.1clxlite.com/assets/js/custom/contact-newletter.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    <!--Service Section Toggle Content-->
    <script src="/assets/js/custom/toggle-content-template-one.js" charset="utf-8"></script>
</body>
</html>
<?php
}
?>
