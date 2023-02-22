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
<html lang="en">
<head>
    <?php
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url_str_get = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $bname = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
        $BDetails = DB::table('business')->select('userid', 'category')->where('bname','=',$bname)->get();
        $ownerid = '';
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $business_category }} | {{ $bname }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="{{ $bname }}">
    <meta name="author" content="{{ $bname }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="" type="image/x-icon">
    <!-- / favicon -->
    <!-- css links start -->
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/glide.core.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/ionicons.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/basiclightbox.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/main.css"); ?>">
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/responsive.css"); ?>">
    <!-- / css likns end -->
    <!-- navbar -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/navbar.css"); ?>">
    <script src='<?php echo url("assets/templatethree/js/navbar.js"); ?>'></script>
    <!-- End navbar -->
    <!-- Gallery -->
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/gallery.css"); ?>">
    <!-- End Gallery -->
    <!-- List portfolio -->
    <link rel="stylesheet" href="<?php echo url("assets/templatethree/css/ptf-main.min.css"); ?>">
    <!-- End List portfolio -->

    <!--Smooth Scroll-->
    <style>
        @media only screen and (max-width: 991px) {
            section#about {
                min-height: 60vh;
            }
            #about .col-xl-6.col-lg-6.order-lg-0{
                margin-bottom:60px;
            }
        }
        @media only screen and (max-width: 413px) {
            .collapse:not(.show) {
                display: contents !important;
            }
            a.navbar-brand{
                max-width: 100px !important;
                max-height: 100px !important;
            }
        }
        p:empty {
            display:none;
        }
        .out_of_stock {
            cursor: not-allowed !important;
        }
        #product_carousal ul.list-unstyled.light.contacts-share.list_style_unique * {
            color: var(--heading-color) !important;
            font-weight: 400 !important;
            text-align: center !important;
        }
        section#about {
            background-color: var(--background-color) !important;
        }
        section#about .bg-white.block.full_height {
            background-color: var(--background-color) !important;
        }
        section#about .bg-white.block.full_height .sub-title-content * {
            color: var(--opposite-color) !important;
        }
        #contact .col-xl-6.col-lg-6.order-lg-0 {
            background-color: var(--background-color) !important;
        }
        #contact .col-xl-6.col-lg-6.order-lg-0 form h3 {
            color: var(--opposite-color);
        }
        .row.footer_link * {
            text-align: center !important;
            color: #fff !important;
        }
        #menu_popup li button {
            color: var(--primary-based-color);
            text-decoration: none;
            font-size: 3em;
            padding: 5px 20px;
            display: inline-flex;
            font-weight: 700;
            transition: 0.5s;
            background: transparent !important;
            border: none !important;
        }
        @media (min-width: 1020px) {
            /* Custom Code */
            div#gallery_include .full_height {
                min-height: 100vh;
                display: flex;
                align-content: center;
                align-items: inherit;
                width: 100%;
            }
            #call_to_action .bg-white.block-2.full_height {
                min-height: 100vh;
                display: flex;
                align-content: center;
                align-items: center;
                flex-direction: column;
                justify-content: center;
            }
            p.before_cfluid {
                position: relative;
                top: 0;
            }
            .full_height {
                min-height: 100vh;
                display: flex;
                align-content: center;
                align-items: center;
                flex-wrap: wrap;
                max-height: 100vh;
                overflow-y: scroll;
                height: 100vh;
                overflow-x: hidden;
            }
            section#about .bg-white.block.full_height {
                /* min-height: calc(100vh - 20px); */
            }
            #service .bg-black.block-2.full_height {
                padding-top: 65px;
                padding-bottom: 0;
            }
            #why_choose_us .bg-white.block-2.full_height {
                padding-top: 90px;
                padding-bottom: 0;
            }
            div#gallery_include .full_height .grid {
                min-height: 100vh;
            }
            /* End Custom Code */
            .scrollMajicFix {
                top: 0 !important;
            }

            .slide {
                width: 100%;
                min-height: auto;
                margin: 0 auto;
                position: relative;
            }

            .module-background {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
            }

            .module-background h1 {
                position: absolute;
                color: white;
                font-size: 30px;
            }

            .slide1 .module-background {
                background-color: green;
            }

            .slide2 .module-background {
                background-color: blue;
            }

            .slide3 .module-background {
                background-color: orange;
            }

            .slide4 .module-background {
                background-color: brown;
            }
        }
        @media only screen and (min-device-width: 1020px) and (max-device-width: 1300px){
            #service .bg-black.block-2.full_height .container-fluid {
                margin-top: 345px;
            }
            #product_carousal .action-buttons button.down-button {
                top: 90%;
            }
            #product_carousal .action-buttons button.up-button {
                top: 10%;
            }
            #contact iframe.w-100 {
                height: calc(100vh + 90px) !important;
                max-height: max-content !important;
            }
            #contact form h3 {
                margin-top: 110px;
                margin-right: 10px;
            }
            footer .Footer_height {
                margin-top: 130px;
            }
        }
    </style>
    <style>
        #service .fa.fa {
            color: var(--primary-based-color) !important;
            font-size: 65px;
        }
        #product_carousal .right-slide {
            height: 100%;
            position: absolute;
            /* top: 50%; */
            left: 50%;
            right: 0px;
            width: 50%;
            transition: transform 0.5s ease-in-out;
            margin: auto;
        }
    </style>
    <link rel="stylesheet" href="{{ url('assets/fa-fa-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fa-all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
</head>
<body>
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

    <!--======----
        To-top
    ----======--->
    <div id="cursor">
        <div id="cursorScroll">
            <div id="cursorProgress"></div>
        </div>
    </div>
    <!--==============---
          Preloader
    ---===============-->
    <div id="preloader">
        <div id="status">
            <div id="content">
                <div class="bounceball"></div>
            </div>
        </div>
    </div>
    <!--==============---
        Header section
     --===============-->
    <?php
        // echo $ownerid;
        $data= DB::table('products')
                ->select('products.id as pID', 'products.name as pName', 'products.price as pPrice', 'products.main_img as img', 'products.main_img_alt_tag as alt', 'cart.bus_id as bid', 'cart.user_id as user', 'cart.qty as cartQty', 'cart.total_price as total', 'cart.id as id')
                ->join('cart','cart.product_id','=','products.id')
                ->where('cart.bus_id','=',$ownerid)
                ->where('cart.user_id','=',session()->get('busid'))
                ->where('cart.removed','=','1')
                ->get();
        $totalAmount = DB::table('cart')
                            ->select(DB::raw("SUM(total_price) as total"))
                            ->where('bus_id','=',$ownerid)
                            ->where('user_id','=',session()->get('busid'))
                            ->where('removed','=',1)
                            ->get();
        $dataCount = $data->count();
        $qty = 0;
        foreach($data as $data){
            $qty += $data->cartQty;
        }
    ?>
    @if(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
    <ul class="navbar-nav">
        <button onclick="sideNav(1)" class="cart_icon"><i class="fa fa-shopping-cart" style="font-size:2rem;"></i></button>
        <span class="total-qty count" id="cart_total_count">{{ $qty }}</span>
    </ul>
    @endif
    <header  id="header">

        <div class="block-header" id="top-fixed">

            <div class="container-fluid">
                <!-- navbar -->
                <nav class="navbar dark navbar-expand-lg nav">

                    <a class="navbar-brand" href="#" style="max-width: 150px;max-height: 150px;">
						<?php if($buscon->content5 == null){?>
                            <img style="width: 100%;" src='<?php echo url("business/$bus->logo"); ?>' alt='Logo'>
                        <?php }else{ ?>
                            <img style="width: 100%;" style="width:100px; height:auto;" src='<?php echo url("business/$buscon->content5"); ?>' alt='Logo'>
                        <?php } ?>
                    </a>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <button class="toggle-menu">
                            <span></span>
                        </button>
                    </div>
                </nav>
                <!-- / navbar -->
            </div>
        </div>
    </header>
    <div id="menu" class="">
        <nav class="main-nav">
            <ul id="menu_popup">
                <?php if($results_layout->banner=='1'){     ?>
                <li>
                    <a href="#home" data-text="Home">Home</a>
                </li>
                <?php   }   ?>
                <?php if($results_layout->layout_4=='1'){     ?>
                <li>
                    <a href="#about" data-text="About">About</a>
                </li>
                <?php   }   ?>
                <?php if($results_layout->layout_7=='1'){     ?>
                <li>
                    <a href="#service" data-text="Services">Services</a>
                </li>
                <?php   }   ?>
                <li>
                    <a href="/{{ $bname }}/products" data-text="Products">Products</a>
                </li>
                <?php if($results_layout->map=='1'){     ?>
                <li>
                    <a href="#contact" data-text="Contact">Contact</a>
                </li>
                <?php   }   ?>
                @if(session()->has('busid') && session()->has('type') && ((session()->get('type'))=='user' || (session()->get('type'))=='socialuser'))
                <li>
                    <a href="<?php echo url("userdashboard"); ?>" data-text="Dashboard">Dashboard</a>
                </li>
                <li>
                    <a href="https://www.editor.1clxlite.com/{{ base64_encode($bus->bname) }}" data-text="Site Editor">Site Editor</a>
                </li>
                <li>
                    <a href="{{ url('logout') }}" data-text="Logout">Logout</a>
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
                                <a href="javascript:void(0)" onclick="connection()" data-text="Connect">
                                    <span class="btn-text" id="connected">Connect</span>
                                </a>
                            </li>
                        <?php   }   ?>
                    @endforeach
                    <script>
                        function connection() {
                            $.ajax({
                                url: '<?php echo url("join_connection"); ?>',
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
                        <a href="{{ url('ecx-dashboard') }}" data-text="Dashboard">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ url('ecx-logout') }}" data-text="Logout">Logout</a>
                    </li>
                @else
                <li>
                    <a href="{{ url($bname.'/login') }}" data-text="Login">Login</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    <!--============---
        Home section
    ----============-->
    <?php if($results_layout->banner=='1'){     ?>
    <section id="home" class="slide slide1 scrollMajicFix">
        <div class="full-height-slider position-relative">
            <!-- glide slider -->
            <div class="glide home-background">
                <div class="glide__track" data-glide-el="track" style='background-image: url("<?php echo url("/assets/templatethree/img/background/right-img3.png"); ?>");'>
                    <!-- glide parts box -->
                    <ul class="glide__slides">
                        <!-- glide slider item -->
                        <li class="glide__slide">
                            <div class="background full-height-slider block">
                                <div class="container-fluid h-100">
                                    <div class="home-text-block left dark">
                                        <div class="home-text">
                                            <span class="large">
                                                <?php if($buscon->banner_heading1 == null){?>
                                                    START YOUR BUSINESS
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_heading1 }}
                                                <?php } ?>
                                            </span>
                                            <span class="medium">
                                                <?php if($buscon->banner_text1 == null){?>
                                                    Our expertise, as well as our passion for web design set us aport from other agencies.
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_text1 }}
                                                <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="home-text-block left dark">
                                        <div class="home-text">

                                            <?php if($buscon->slide1 == null){?>
                                            <img src="<?php echo url("business/$bus->header"); ?>" >
                                            <?php }else{ ?>
                                            <img src="<?php echo url("business/$buscon->slide1"); ?>" >
                                            <?php    }?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="background full-height-slider block">
                                <div class="container-fluid h-100">
                                    <div class="home-text-block left dark">
                                        <div class="home-text">
                                            <span class="large">
                                                <?php if($buscon->banner_heading2 == null){?>
                                                    START YOUR BUSINESS
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_heading2 }}
                                                <?php } ?>
                                            </span>
                                            <span class="medium">
                                                <?php if($buscon->banner_text2 == null){?>
                                                    Our expertise, as well as our passion for web design set us aport from other agencies.
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_text2 }}
                                                <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="home-text-block left dark">
                                        <div class="home-text">
                                            <?php if($buscon->slide2 == null){?>
                                            <img src="<?php echo url("business/$bus->header"); ?>" >
                                            <?php }else{ ?>
                                            <img src="<?php echo url("business/$buscon->slide2"); ?>" >
                                            <?php    }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div class="background full-height-slider block">
                                <div class="container-fluid h-100">
                                    <div class="home-text-block left dark">
                                        <div class="home-text">
                                            <span class="large">
                                                <?php if($buscon->banner_heading3 == null){?>
                                                    START YOUR BUSINESS
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_heading3 }}
                                                <?php } ?>
                                            </span>
                                            <span class="medium">
                                                <?php if($buscon->banner_text3 == null){?>
                                                    Our expertise, as well as our passion for web design set us aport from other agencies.
                                            	<?php }else{ ?>
                                                    {{ $buscon->banner_text3 }}
                                                <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="home-text-block left dark">
                                        <div class="home-text">
                                             <?php if($buscon->slide3 == null){?>
                                            <img src="<?php echo url("business/$bus->header"); ?>" >
                                            <?php }else{ ?>
                                            <img src="<?php echo url("business/$buscon->slide3"); ?>" >
                                            <?php    }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- glide parts box -->
                </div>
                <!-- glide slider controls -->
                <div class="glide">
                    <div class="home-controls">
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            <button class="glide__bullet" data-glide-dir="=0"></button>
                            <button class="glide__bullet" data-glide-dir="=1"></button>
                            <button class="glide__bullet" data-glide-dir="=2"></button>
                        </div>
                    </div>
                </div>
                <!-- / glide slider contrlos -->
            </div>
            <!--  / glide slider -->
            <!-- <span class="section-title-assistant dark right-bottom"></span> -->
        </div>
    </section>
    <?php  }    ?>
    <!--===============---
       About section
    ----===============-->
    <?php if($results_layout->layout_4=='1'){     ?>
    <section id="about" class="slide slide2 scrollMajicFix">
        <div class="bg-white block full_height">
            <div class="container-fluid">
                <div class="row">
                    <!-- / col -->
                    <div class="col-xl-6 col-lg-6 order-lg-0">
                        <div class="widget-block no-padding contact">
                            <?php if($buscon->content12 == null){?>
                                <img src="<?php echo url("assets/template/images/about.png"); ?>" class="left_img" />
                            <?php }else{ ?>
                                <img src="<?php echo url("business/$buscon->content12"); ?>" class="left_img" />
                            <?php }   ?>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="widget-block no-padding contact">
                            <div class="box-contact-info no-bg">
                                <div class="sub-title-block left md-media-left">
                                    <div class="sub-title-content">
                                        <?php if($buscon->content13 == null){?>
                                            <h3 class="sub-title">Thanks We Do For Our Clients</h3>
                                            <p class="about_p">{{$bus->descript}}</p>
                                            <ul class="list-unstyled light contacts-share">
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-building"></i>
                                                        <div>
                                                            <span>VISION</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-building"></i>
                                                        <div>
                                                            <span>MISSION</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        <?php }else{
                                            echo $buscon->content13;
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="section-title-assistant light left-top"></span>
            <span class="section-title left">
                <?php if($buscon->about_section_heading == null){?>
                About Us
                <?php }else{
                    echo $buscon->about_section_heading;
                }?>
            </span>
        </div>
    </section>
    <?php  }    ?>
    <!--===============---
        Service section
    ----===============-->
    <?php if($results_layout->layout_7=='1'){     ?>
    <section id="service" class="slide slide3 scrollMajicFix">
        <div class="bg-black block-2 full_height">
            <!-- section-title and section-assistant start -->
            <span class="section-title dark right">
                <?php if($buscon->service_section_heading == null){?>
                our services
                <?php }else{
                    echo $buscon->service_section_heading;
                }?>
            </span>
            <span class="section-title-assistant dark right-top"></span>
            <!-- section-title and section-assistant end -->
            <div class="container-fluid">
                <div class="row">
                    <style>
                        .image_changer {
                            position: relative;
                        }
                        @if($buscon->content16 == null)
                        .widget-blockss.service1:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service1:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content16); ?>) !important;
                        }
                        @endif
                        @if($buscon->content17 == null)
                        .widget-blockss.service2:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service2:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content17); ?>) !important;
                        }
                        @endif
                        @if($buscon->content18 == null)
                        .widget-blockss.service3:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service3:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content18); ?>) !important;
                        }
                        @endif
                        @if($buscon->content19 == null)
                        .widget-blockss.service4:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service4:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content19); ?>) !important;
                        }
                        @endif
                        @if($buscon->content20 == null)
                        .widget-blockss.service5:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service5:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content20); ?>) !important;
                        }
                        @endif
                        @if($buscon->content21 == null)
                        .widget-blockss.service6:hover {
                            background-image: url({{ url('assets/templatethree/img/about.png') }}) !important;
                        }
                        @else
                        .widget-blockss.service6:hover {
                            background-image: url(<?php echo url('business/'.$buscon->content21); ?>) !important;
                        }
                        @endif
                    </style>
                    <!-- col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark bottom-left service1">
                            <?php if($buscon->fafaservice1 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice1;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content28 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content28 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_1 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_1;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark bottom-left service2">
                            <?php if($buscon->fafaservice2 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice2;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content29 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content29 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_2 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_2;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- / col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark bottom-left service3">
                            <?php if($buscon->fafaservice3 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice3;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content30 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content30 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_3 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_3;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- / col -->
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark top-right service4">
                            <?php if($buscon->fafaservice4 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice4;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content31 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content31 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_4 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_4;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- / col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark top-right service5">
                            <?php if($buscon->fafaservice5 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice5;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content32 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content32 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_5 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_5;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- / col -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="widget-blockss widget-block service dark top-right service6">
                            <?php if($buscon->fafaservice6 == null){?>
                                <i class="fa fa-building">&nbsp;</i>
                            <?php }else{
                                echo $buscon->fafaservice6;
                            }?>
                            <h4 class="w-title">
                                <?php if($buscon->content33 == null){?>
                                    <span>SERVICE 1</span>
                                <?php }else{ ?>
                                    <span>{{ $buscon->content33 }}</span>
                                <?php }?>
                            </h4>
                            <p class="w-info mb-0">
                                <?php if($buscon->service_description_6 == null){?>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                <?php }else{
                                    echo $buscon->service_description_6;
                                }?>
                            </p>
                        </div>
                    </div>
                    <!-- / col -->
                </div>
            </div>
        </div>
    </section>
    <?php  }    ?>
    <!--===============---
       Product Slider section
    ----===============-->
    <?php
        $pi = 0;
        $userid = $bus->userid;
        $product_arr = DB::table('products')
                            ->select('*')
                            ->where('user_id', $userid)
                            ->where('visibility', '1')
                            ->orderBy('id','desc')
                            ->get();
        $ProductCount = $product_arr->count();
        if($ProductCount>0){
    ?>
    <div class="slider-container slide slide11 scrollMajicFix" id="product_carousal">
        <div class="left-slide">
            <?php
                foreach ($product_arr as $products) {
            ?>
            <div>
                <h1 style="width:70%; text-align:center;">{{   $products->name    }}</h1>
                <div class="check_price">
                    <span class="price-save">${{   $products->price     }}</span>
                    @if($products->old_price!=0.00 && $products->old_price!="" && $products->old_price!=$products->price)
                        <div class="price-was">- ${{   $products->old_price     }}</div>
                    @endif
                </div>
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
                    <input type="radio" id="5-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="5" disabled <?php if($all == 5){ echo "checked"; } ?>/>
                    <label for="5-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                    <input type="radio" id="4-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="4" disabled <?php if($all == 4){ echo "checked"; } ?>/>
                    <label for="4-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                    <input type="radio" id="3-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="3" disabled <?php if($all == 3){ echo "checked"; } ?>/>
                    <label for="3-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                    <input type="radio" id="2-stars<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="2" disabled <?php if($all == 2){ echo "checked"; } ?>/>
                    <label for="2-stars<?php echo $pi; ?>" class="star">&#9733;</label>

                    <input type="radio" id="1-star<?php echo $pi; ?>" name="rating<?php echo $pi; ?>" value="1" disabled <?php if($all == 1){ echo "checked"; } ?>/>
                    <label for="1-star<?php echo $pi; ?>" class="star">&#9733;</label>
                </div>
                <ul class="list-unstyled light contacts-share list_style_unique">
                    <span><?php echo $products->description; ?></span>
                </ul>
                @if($products->qty!=0)
                    @if(session()->has('busid') && session()->has('type') && (session()->get('type')=='enduser' || (session()->get('type'))=='manual'))
                    <button type="button" id="add_to_cart_btn{{ $products->id }}" class="btn-default order add_to_cart_btn" style="width: auto;" data-id="{{ $products->id }}" data-bus="{{ $ownerid }}" data-price="{{ $products->price }}" user-id="{{ session()->get('busid') }}">Add To Cart</button>
                    @else
                    <button class="btn-default order" type="button">Add To Cart</button>
                    @endif
                @else
                <button type="button" class="btn-default order out_of_stock">Out Of Stock</button>
                @endif
            </div>
            <?php
                    $pi++;
                }
            ?>
        </div>
        <?php $product_arr1 = DB::table('products')->select('*')->where('user_id', $userid)->where('visibility', '1')->orderBy('id','asc')->get(); ?>
        <div class="right-slide" style="">
            <?php
                foreach ($product_arr1 as $products) {
            ?>
            <div class="aj1" style="text-align:center; margin:auto !important; vertical-align:middle !important;">
                <img style="margn:auto;min-height: 100vh;height: 100vh;" class="product-image" src="<?php echo url('public/products/'.$products->main_img); ?>" alt="{{   $products->main_img_alt_tag     }}"/>
            </div>
            <?php
                    $pi++;
                }
            ?>
        </div>
        <div class="action-buttons">
            <button class="down-button">
                <i class="fa fa-angle-down"></i>
            </button>
            <button class="up-button">
                <i class="fa fa-angle-up"></i>
            </button>
        </div>
        <!-- section-title and section-assistant start -->
        <span class="section-title left">Our Products</span>
        <span class="section-title-assistant left-top"></span>
        <!-- section-title and section-assistant end -->
    </div>
    <?php
        }
    ?>
    <!--===============---
       Contact section
    ----===============-->
    <?php if($results_layout->map=='1'){     ?>
    <section id="contact" class="slide slide12 scrollMajicFix">
        <div class="bg-white full_height">
            <div class="container-fluid">
                <div class="row">
                    <!-- col -->
                    <div class="col-xl-6 col-lg-6" style="padding: 0;">
                        <div id="map" class="w-100 full_height"></div>
                    </div>
                    <!-- / col -->
                    <div class="col-xl-6 col-lg-6 order-lg-0" style="padding: 0 70px;display: flex;align-content: center;align-items: center;">
                        <div class="widget-block no-padding contact">
                            <form>
                                <h3 style="font-size: 40px;text-align: right;margin-bottom: 20px;">
                                    Text Us
                                </h3>
                                <div class="row">
                                    <!-- / col -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <input type="text" name="fname" class="form-item" placeholder="First Name">
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <input type="text" name="name" class="form-item" placeholder="Last Name">
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <input type="email" name="email" class="form-item" placeholder="Email">
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <input type="text" name="phone" class="form-item" placeholder="Phone">
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <textarea name="message" cols="30" rows="10" class="form-textarea" placeholder="Message"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <button href="#" class="btn-default blue">
                                                    Send A Message
                                                    <i class="ion-ios-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php  }    ?>
    <!--===============---
            Footer
    ----===============-->
    <?php if($results_layout->footer=='1'){     ?>
    <footer class="slide slide13 scrollMajicFix">
        <div class="footer-block full_height" style="background: linear-gradient(0deg, #0000004d, #0000004d), url(<?php echo url("assets/templatethree/img/background/footer.png);"); ?>">
            <div class="container-fluid">
                <div class="row Footer_height">
                    <!-- / col -->
                    <div class="col-xl-12">
                        <div class="widget-block dark footer main no-padding">
                            <div class="inline-center">
                                <h3 class="head">
                                    Get In Touch
                                </h3>

                                <div class="row footer_link">
                                    <div class="col-lg-4 col-sm-12">
                                        <i class="fa fa-phone"></i>
                                        <p class="about_p">
                                            <?php if($buscon->content3 == null){?>
                                                <a href="tel:{{$bus->phone}}" style="color:#fff;;">{{$bus->phone}}</a>
                                            <?php }else{
                                                echo $buscon->content3;
                                            }?>
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <i class="fa fa-map-marker"></i>
                                         <p class="about_p" style="color:#fff">
                                            <?php if($buscon->content1 == null){?>
                                                {{$bus->address}},{{$bus->state}},{{$bus->country}},{{$bus->pincode}}
                                            <?php }else{
                                                echo $buscon->content1;
                                            }?>
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <i class="fa fa-envelope"></i>
                                        <p class="about_p">
                                            <?php if($buscon->content2 == null){?>
                                            <a href="mailto:{{$bus->email}}" target="_blank" style="color:#fff !important;text-align: center;">{{$bus->email}}</a>
                                            <?php }else{
                                                echo $buscon->content2;
                                            }?>
                                        </p>
                                        <!--<p class="about_p">-->
                                        <!--    <a href="mailto:contact@abcservice.com" style="color:#fff">contact@abcservice.com</a>-->
                                        <!--</p>-->
                                    </div>
                                </div>

                                <h4 class="head">
                                    NEWSLETTER SIGNUP
                                </h4>

                                <form class="row newsletter">
                                    <div class="col-12">
                                        <input type="email" name="email" class="newsletter_input">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="submit" class="btn-default blue">
                                            Send A Message
                                        </button>
                                    </div>
                                </form>

                                <div class="social_icon">
                                    <?php if($buscon->content4 == null){?>
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <?php }else{
                                        echo $buscon->content4;
                                    }?>
                                </div>

                                <?php if($buscon->content27 == null){?>
                                    <p class="about_p" style="color:#fff">© Copyright <?php echo  date("Y"); ?>, All Rights Reserved</p>
                                <?php }else{
                                    echo $buscon->content27;
                                }?>

                            </div>
                        </div>
                    </div>
                    <!-- / col -->
                </div>
            </div>
        </div>
    </footer>
    <?php  }    ?>
    @include('chatbot')
    <!-- js links start -->
    <script src="<?php echo url("assets/templatethree/js/vendor/bootstrap.js"); ?>"></script>
    <script src="<?php echo url("assets/templatethree/js/vendor/glide.js"); ?>"></script>
    <script src="<?php echo url("assets/templatethree/js/vendor/basiclightbox.js"); ?>"></script>
    <script src="<?php echo url("assets/templatethree/js/vendor/lax.js"); ?>"></script>
    <script src="<?php echo url("assets/templatethree/js/main.js"); ?>"></script>
    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!-- js links end -->
    <!-- List portfolio -->
     <!--<script src="<?php echo url("assets/templatethree/js/ptf-plugins.min.js"); ?>"></script> -->
    <script src="<?php echo url("assets/templatethree/js/ptf-helpers.js"); ?>"></script>
    <script src="<?php echo url("assets/templatethree/js/ptf-controllers.min.js"); ?>"></script>
    <!-- End List portfolio -->
    <script>
        // Client say
        var glide = new Glide('.client-say', {
            type: 'loop',
            perView: 1,
            autoplay: 2300,
            //focusAt: 'center',
            breakpoints: {
                1300: {
                    perView: 1
                },
                900: {
                    perView: 1
                }
            }
        }).mount();

        //Lax effect
        window.onload = function () {
            lax.init()

            // Add a driver that we use to control our animations
            lax.addDriver('scrollY', function () {
                return window.scrollY
            });
            initPicker();
            updateColor(color);
        };
    </script>
    <script>
        var glide = new Glide('.home-background', {
            type: 'carousel',
            gap: 0,
            perView: 1,
            autoplay: 5000,
            animationDuration: 800,
            rewindDuration: 1000,
            breakpoints: {
                1300: {
                    perView: 1
                },
                900: {
                    perView: 1
                }
            }
        }).mount();
    </script>
    <script>
        $('.toggle-menu').click(function() {
            $(this).toggleClass('active');
            $('#menu').toggleClass('open');
        });
        const sliderContainer = document.querySelector('.slide-container'),
            slideRight = document.querySelector('.right-slide'),
            slideLeft = document.querySelector('.left-slide'),
            upButton = document.querySelector('.up-button'),
            downButton = document.querySelector('.down-button'),
            slidesLength = slideRight.querySelectorAll('div').length;

        let activeSlideIndex = 0;

        slideLeft.style.top = `-${(slidesLength - 1) * 100}vh`;

        upButton.addEventListener('click', () => changeSlide('up'));
        downButton.addEventListener('click', () => changeSlide('down'));

        const changeSlide = direction => {
            // const sliderHeight = sliderContainer.clientHeight;
            if (direction === 'up') {
                activeSlideIndex++;
                if (activeSlideIndex > slidesLength - 1) {
                    activeSlideIndex = 0;
                }
            } else if (direction === 'down') {
                activeSlideIndex--;
                if (activeSlideIndex < 0) {
                    activeSlideIndex = slidesLength - 1;
                }
            }

            // slideRight.style.transform = `translateY(-${
            //   activeSlideIndex * sliderHeight
            // }px)`;
            // slideLeft.style.transform = `translateY(${
            //   activeSlideIndex * sliderHeight
            // }px)`;
            slideRight.style.transform = `translateY(-${activeSlideIndex * 100}vh)`;
            slideLeft.style.transform = `translateY(${activeSlideIndex * 100}vh)`;
        };
        //# sourceURL=pen.js
    </script>
    <!--Map Location-->
    <script
      src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_MAP_API_KEY");}}&callback=initMap&libraries=&v=weekly"
      async
    ></script>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = { lat: <?php echo $bus->lat; ?>, lng: <?php echo $bus->lng; ?> };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>
    <!-- Scroll Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/plugins/ScrollToPlugin.min.js"></script>
    <script>
        if (window.matchMedia('(min-width: 1020px)').matches) {
            var ctrl = new ScrollMagic.Controller({});

            // This each sets the animation
            $(".slide").each(function (index, element) {

                ////////// scroll up //////////
                new ScrollMagic.Scene({
                    triggerHook: 0,
                    triggerElement: this,
                    offset: -50, // small offset added to prevent overscrolling accidentally triggering
                })

                .on("leave", function () {
                    TweenLite.to(window, 0.2, { scrollTo: { y: $(window).height() * (index - 1), autoKill: false }, ease: Linear.easeNone });
                })
                .addTo(ctrl); // scene end

                //////////scroll down //////////

                new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: 0,
                    offset: 50, // small offset added to prevent overscrolling accidentally triggering
                })

                .on("enter", function () {
                    TweenLite.to(window, 0.2, { scrollTo: { y: $(window).height() * (index + 1), autoKill: false }, ease: Linear.easeNone });
                })
                .addTo(ctrl); // scene end

            });
        }
    </script>
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
                        $("#add_to_cart_btn"+product_id).text("Added");
                    }
                    return false;
                },
            });
        });
    </script>
    <!--End Cart-->
</body>
</html>
<?php } ?>
