<?php
session_start();
require_once 'db.php';

// Giriş yapılmışsa favori URL’lerini topla
$favUrls = [];
if (isset($_SESSION['kullanici_id'])) {
    $stmt = $conn->prepare("SELECT recipe_url FROM favorites WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['kullanici_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $favUrls[] = $row['recipe_url'];
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <title>Enfes Tarifler</title>
    <!--
    

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <header class="header-area header-sticky">
        <div class="container">
            <nav class="main-nav">
                <a href="index.php" class="logo">
                    <img src="assets/images/klassy-logo.png">
                </a>
                <ul class="nav">
                    <li class="scroll-to-section"><a href="#top" class="active">Anasayfa</a></li>
                    <li class="scroll-to-section"><a href="#about">Hakkımızda</a></li>
                    <li class="scroll-to-section"><a href="#menu">Menü</a></li>
                    <li class="scroll-to-section"><a href="#chefs">Şefler</a></li>
                    <li class="submenu">
                        <a href="#tarif-basligi">Tarifler</a>
                        <ul>
                            <li><a href="tarifler.html">Kahvaltılık</a></li>
                            <li><a href="atistarmalik.html">Atıştırmalık</a></li>
                            <li><a href="aksam.html">Akşam Yemeği</a></li>
                            <li><a href="tatlı.html">Tatlı</a></li>
                        </ul>
                    </li>
                    <li class="scroll-to-section"><a href="#reservation">İletişim</a></li>
                    <?php if(!isset($_SESSION['kullanici'])): ?>
                    <li class="scroll-to-section">
                        <a href="login.html" class="logout-button">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <button id="favoriteButton" class="btn btn-outline-dark ms-2">
                            <i class="fa fa-heart"></i>
                        </button>
                    </li>
                    <?php else: ?>
                    <li class="scroll-to-section">
                        <a href="logout.php" class="logout-button">Çıkış Yap</a>
                    </li>
                    <li class="nav-item">
                        <button id="favoriteButton" class="btn btn-outline-dark ms-2">
                            <i class="fa fa-heart"></i>
                        </button>
                    </li>
                     <li class="scroll-to-section">
                        <span class="welcome-text">Hoşgeldin, <?= htmlspecialchars($_SESSION['kullanici']) ?></span>
                    </li>
                    <?php endif; ?>

                    
                </ul>

                <!-- Modalları NAV içinden çıkardık -->
                <div id="loginModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeModal">×</span>
                        <p>Lütfen giriş yapınız.</p>
                        <button id="redirectToLogin">Tamam</button>
                    </div>
                </div>

                <div id="favoritesModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeFavorites">×</span>
                        <h3>Favorileriniz</h3>
                        <div id="favoritesList">
                            <!-- AJAX ile yüklenecek -->
                        </div>
                    </div>
                </div>

                <a class="menu-trigger"><span>Menu</span></a>
            </nav>
        </div>
    </header>


    <!-- Favoriler Modal -->
    <div id="favoritesModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeFavorites">&times;</span>
            <h3>Favorileriniz</h3>
            <div class="modal-body" id="favoritesList">
                <!-- AJAX ile yüklenecek -->
            </div>
        </div>
    </div>


    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h4>Efsane Tarifler</h4>
                            <h5>Enfes Tariflerle Sizlerleyiz.</h5>
                            <div class="main-white-button scroll-to-section">
                                <a href="#reservation">İletişim</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 410px;">
                                <img class="img-fluid" src="assets/images/fajita-yemekcom.jpg" alt="Image">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Lezzetin Tek
                                            Adresi</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Leziz Yemek
                                            Tarifleri</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" src="assets/images/melanzane-one-cikan.jpg" alt="Image">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">Lezzetin Tek
                                            Adresi</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Leziz Yemek
                                            Tarifleri</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>Hakkımızda</h6>
                            <h2>Enfes Anılarımız</h2>
                        </div>
                        <p>2025 yılında küçük bir kanal olarak başladığımız yemek tarifi serüvenimize büyük bir aile ile
                            devam ediyoruz. Geçen süreç içerisinde sizden gelen geri bildirimlerle tariflerimizi daha
                            güvenilir ve lezzetli şekilde sizlere sunmaya devam ediyoruz.</p>
                        <div class="row">
                            <div class="col-4">
                                <img src="assets/images/acili-tavuk-kanatlari-yemekcom.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img src="assets/images/limonlu-levrek-yemekcom.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img src="assets/images/airfryerda-izmir-kofte-onecikan.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-content">
                        <div class="thumb">
                            <a rel="nofollow" href="https://www.youtube.com/@NefisYemekTarifleri"><i
                                    class="fa fa-play"></i></a>
                            <img src="assets/images/hamburger-yemekcom.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->

    <!-- ***** Menu Area Starts ***** -->
    <section class="section" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>En Beğenilen Menüler</h6>
                        <h2>Kaliteli Lezzete Sahip Menulerimiz</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item-carousel">
            <div class="col-lg-12">
                <div class="owl-menu-item owl-carousel">
                    <div class="item">
                        <div class='card card1'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#sebzeli-guvec">
                                    <h1 class='title'>Sebzeli Güveç</h1>
                                </a>
                                <p class='description'>Taze sebzelerle hazırlanan, nefis aromalı, sağlıklı ve doyurucu
                                    bir lezzet.</p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class='card card2'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#balkabagi-dolmasi">
                                    <h1 class='title'>Bal Kabağı Dolması </h1>
                                </a>
                                <p class='description'>Özel iç harcıyla doldurulmuş, fırında pişen bal kabağı ziyafeti.
                                </p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class='card card3'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#un-kurabiyesi">
                                    <h1 class='title'>Un Kurabiyesi</h1>
                                </a>
                                <p class='description'>Ağızda dağılan, bol tereyağlı ve pudra şekerli nefis kurabiye.
                                </p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class='card card4'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#patates-oturtma">
                                    <h1 class='title'>Patates Oturtma</h1>
                                </a>
                                <p class='description'>Kızarmış patates dilimleri arasında etli harçla mükemmel uyum
                                    sağlıyor.</p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class='card card5'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#lahmacun">
                                    <h1 class='title'>Lahmacun</h1>
                                </a>
                                <p class='description'>İncecik çıtır hamur üzerine serili bol baharatlı, nefis kıymalı
                                    harç.</p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class='card card6'>
                            <div class="favorite-button">
                                <i class="fa fa-heart-o"></i>
                            </div>
                            <div class='info'>
                                <a href="aksam.html#doner">
                                    <h1 class='title'>Döner</h1>
                                </a>
                                <p class='description'>Pratik ve lezzetli, tereyağlı sosuyla zenginleştirilmiş döner
                                    keyfi.</p>
                                <div class="main-text-button">
                                    <div class="scroll-to-section"><a href="#reservation">İletişim <i
                                                class="fa fa-angle-down"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Menu Area Ends ***** -->

    <!-- ***** Chefs Area Starts ***** -->
    <section class="section" id="chefs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Şefler</h6>
                        <h2>Sizin İçin En İyi Şefleri Sunuyoruz.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            <ul class="social-icons">
                                <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li><a href="https://x.com/?lang=tr" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>

                            </ul>
                            <img src="assets/images/ekin.jpg" alt="Chef #2">
                        </div>
                        <div class="down-content">
                            <h4>Ekin Sıla Göktaş</h4>
                            <span>Executive Chef</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            <ul class="social-icons">
                                <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li><a href="https://x.com/?lang=tr" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                            </ul>
                            <img src="assets/images/ayca.jpg" alt="Chef #3">
                        </div>
                        <div class="down-content">
                            <h4>Ayça Büşra Yarımca</h4>
                            <span>Executive Chef</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** -->

    <!-- ***** Reservation Us Area Starts ***** -->
    <section class="section" id="reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>İletişim</h6>
                            <h2>Bizimle İletişime Geç</h2>
                        </div>
                        <p>Bizimle iletişime geçmek için bu alanı kullanabilirsiniz. Özel istek ve ekleme yapmak
                            istediğiniz konuları mesaj olarak site üzerinden bizlere iletebilirsiniz.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <h4>Telefon</h4>
                                    <span><a href="#">+0232 444 15</a><br><a href="#">+0232 444 16</a></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="message">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Mail</h4>
                                    <span><a href="#">yemek@gmail.com</a><br><a
                                            href="#">efsanetarif@gmail.com</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <form id="contact" action="iletisim.php" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>İLETİŞİM</h4>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" id="name" placeholder="İsim*" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                            placeholder="Mail" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="surname" type="text" id="surname" placeholder="Soyad*" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <input name="phone" type="text" id="phone" placeholder="Telefon*" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" id="message" placeholder="Mesaj"
                                            required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button-icon">GÖNDER</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Reservation Area Ends ***** -->

    <!-- ***** Menu Area Starts ***** -->
    <section class="section" id="offers">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading" id="tarif-basligi">
                        <h6>Klasik Hafta</h6>
                        <h2>Günlük İsteklerini Sen Belirle</h2>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="tabs">
                        <div class="col-lg-12">
                            <div class="heading-tabs">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-3">
                                        <ul>
                                            <li><a href='#tabs-1'><img src="assets/images/tab-icon-01.png"
                                                        alt="">Breakfast</a></li>
                                            <li><a href='#tabs-2'><img src="assets/images/tab-icon-02.png"
                                                        alt="">Lunch</a></a></li>
                                            <li><a href='#tabs-3'><img src="assets/images/tab-icon-03.png"
                                                        alt="">Dinner</a></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <section class="tabs-content">

                                <article id="tabs-1">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Pankek"
                                                            data-recipe-url="kahvalti.html#pankek">
                                                            <a href="kahvalti.html#pankek">
                                                                <img src="assets/images/pancake-yemekcom.jpg" alt="">
                                                            </a>
                                                            <h4>Pankek</h4>
                                                            <p>Taze meyvelerle servis edilen yumuşacık ev yapımı
                                                                pankekler.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Sigara Böreği"
                                                            data-recipe-url="kahvalti.html#sigara-boregi">
                                                            <a href="kahvalti.html#sigara-boregi">
                                                                <img src="assets/images/patatesli-sigara-boregi-onecikan.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Sigara Böreği</h4>
                                                            <p>İncecik yufkada kızarmış, patates dolgulu nefis lezzet.
                                                            </p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Kıymalı Börek"
                                                            data-recipe-url="kahvalti.html#kiymali-borek">
                                                            <a href="kahvalti.html#kiymali-borek">
                                                                <img src="assets/images/kiymali-borek-guncelleme-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Kıymalı Börek</h4>
                                                            <p>Özenle kavrulmuş kıymayla hazırlanan çıtır börekler.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Menemen"
                                                            data-recipe-url="kahvalti.html#menemen">
                                                            <a href="kahvalti.html#menemen">
                                                                <img src="assets/images/cakalli-menemen-yeni.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Menemen</h4>
                                                            <p>Domates, biber ve yumurtayla hazırlanan geleneksel Türk
                                                                lezzeti.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Yumurta Kapama"
                                                            data-recipe-url="kahvalti.html#yumurta-kapama">
                                                            <a href="kahvalti.html#yumurta-kapama">
                                                                <img src="assets/images/yumurta-kapama-onecikan-yeni.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Yumurta Kapama</h4>
                                                            <p>Tereyağında kızartılmış yumurtaların enfes baharatla
                                                                buluşması.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Peynirli Ekmek"
                                                            data-recipe-url="kahvalti.html#peynirli-ekmek">
                                                            <a href="kahvalti.html#peynirli-ekmek">
                                                                <img src="assets/images/firinda-peynirli-ekmek-site.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Peynirli Ekmek</h4>
                                                            <p>Fırında pişmiş, eritilmiş peynirle kaplı nefis
                                                                kahvaltılık ekmek.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <article id="tabs-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Yumurtalı Otlu Pide"
                                                            data-recipe-url="atistarmalik.html#pide">
                                                            <a href="atistarmalik.html#pide">
                                                                <img src="assets/images/yumurtali-otlu-pide.jpg" alt="">
                                                            </a>
                                                            <h4>Yumurtalı Otlu Pide</h4>
                                                            <p>Taze otlar ve yumurtayla hazırlanan nefis, fırından çıkan
                                                                lezzet.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Sandvic Ekmeği"
                                                            data-recipe-url="atistarmalik.html#sandvic">
                                                            <a href="atistarmalik.html#sandvic">
                                                                <img src="assets/images/sandvic-ekmegi-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Sandvic Ekmeği</h4>
                                                            <p>Yumuşacık dokusu ve pratikliğiyle her öğüne uygun ev
                                                                ekmeği.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Kıymalı Milföy Rulo"
                                                            data-recipe-url="atistarmalik.html#rulo">
                                                            <a href="atistarmalik.html#rulo">
                                                                <img src="assets/images/kiymali-milfoy-rulo.jpg" alt="">
                                                            </a>
                                                            <h4>Kıymalı Milföy Rulo</h4>
                                                            <p>Kat kat milföy arasında lezzetli kıyma harcıyla
                                                                fırınlanmış tarif.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Kolay Pizza"
                                                            data-recipe-url="atistarmalik.html#pizza">
                                                            <a href="atistarmalik.html#pizza">
                                                                <img src="assets/images/kolay-pizza-tarifi.jpg" alt="">
                                                            </a>
                                                            <h4>Kolay Pizza</h4>
                                                            <p>Evde hazırlanan pratik hamurla, bol malzemeli nefis pizza
                                                                keyfi.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Avokado Ruloları"
                                                            data-recipe-url="atistarmalik.html#avakado">
                                                            <a href="atistarmalik.html#avakado">
                                                                <img src="assets/images/avokado-rulolari-tarifi.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Avokado Ruloları</h4>
                                                            <p>Hafif, sağlıklı ve modern sunumuyla sofralara renk katan
                                                                lezzet.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Kolay Lavaş Tako"
                                                            data-recipe-url="atistarmalik.html#taco">
                                                            <a href="atistarmalik.html#taco">
                                                                <img src="assets/images/kolay-lavas-taco-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Kolay Lavaş Tako</h4>
                                                            <p>Lavaş ile dakikalar içinde yapılan doyurucu, eğlenceli
                                                                atıştırmalık.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <article id="tabs-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Beyti Sarma"
                                                            data-recipe-url="aksam.html#sarma">
                                                            <a href="aksam.html#sarma">
                                                                <img src="assets/images/Firinda-Beyti-Kebabi-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Beyti Sarma</h4>
                                                            <p>Lavaşa sarılmış köfte, yoğurt ve sosla sunulan nefis ana
                                                                yemek.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Yalancı Mantı"
                                                            data-recipe-url="aksam.html#mantı">
                                                            <a href="aksam.html#mantı">
                                                                <img src="assets/images/yalanci-manti-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Yalancı Mantı</h4>
                                                            <p>Pratik hazırlanışıyla gerçek mantıyı aratmayan doyurucu
                                                                tarif.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Karnıyarık"
                                                            data-recipe-url="aksam.html#karnıyarık">
                                                            <a href="aksam.html#karnıyarık">
                                                                <img src="assets/images/karniyarik-yemekcom.jpg" alt="">
                                                            </a>
                                                            <h4>Karnıyarık</h4>
                                                            <p>Kıymalı iç harçla doldurulan, fırında pişmiş geleneksel
                                                                patlıcan yemeği.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Fellah Köftesi"
                                                            data-recipe-url="aksam.html#kofte">
                                                            <a href="aksam.html#kofte">
                                                                <img src="assets/images/fellah-kofte-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Fellah Köftesi</h4>
                                                            <p>Bulgurlu köftelerin sarımsaklı sosla buluştuğu yöresel
                                                                bir lezzet.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Kuru Fasulye"
                                                            data-recipe-url="aksam.html#kuru">
                                                            <a href="aksam.html#kuru">
                                                                <img src="assets/images/kuru-fasulye-yemekcom.jpg"
                                                                    alt="">
                                                            </a>
                                                            <h4>Kuru Fasulye</h4>
                                                            <p>Türk mutfağının vazgeçilmezi, pilavla birlikte enfes bir
                                                                uyum.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="tab-item" data-recipe-name="Tavuk Patates"
                                                            data-recipe-url="aksam.html#tavuk">
                                                            <a href="aksam.html#tavuk">
                                                                <img src="assets/images/tavuk-sote-yemekcom.jpg" alt="">
                                                            </a>
                                                            <h4>Tavuk Patates</h4>
                                                            <p>Fırında pişmiş baharatlı tavuk ve patatesle hazırlanan
                                                                kolay yemek.</p>
                                                            <div class="favorite-button">
                                                                <i class="fa fa-heart-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                        <ul class="social-icons">
                            <li><a href="https://www.facebook.com/nefisyemektarifleri/?locale=tr_TR" target="_blank"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="https://x.com/NefisYT?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"
                                    target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li>
                                <a href="https://www.youtube.com/results?search_query=nefis+yemek+tarifleri"
                                    target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>

                            <li><a href="https://www.instagram.com/nefisyemektarifleri/?hl=tr" target="_blank"><i
                                        class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/white-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Efsane Tarifler.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/modal.js"></script>
    <style>
    /* Modal’lar hep üstte kalsın */
    #loginModal {
        position: fixed;
        z-index: 2000;
    }

    #favoritesModal {
        position: fixed;
        z-index: 3000;
    }
    </style>

    <script>
    // 0) PHP’den gelen oturum ve favori URL’lerini JS’e aktar
    window.loggedIn = <?= isset($_SESSION['kullanici']) ? 'true' : 'false'; ?>;
    window.favUrls = <?= json_encode($favUrls, JSON_HEX_TAG) ?>;
    console.log("★★ window.loggedIn =", window.loggedIn);
    console.log("★★ favUrls =", window.favUrls);

    $(function() {

        // 1) Carousel ve klon öğeleri de dahîl olmak üzere tüm .item’leri işle
        function markCarouselHearts() {
            $('.owl-menu-item.owl-carousel .item').each(function() {
                var $it = $(this),
                    href = $it.find('a').first().attr('href');
                if (window.favUrls.includes(href)) {
                    $it.find('.favorite-button i')
                        .removeClass('fa-heart-o')
                        .addClass('fa-heart');
                }
            });
            console.log("[Fav] Carousel hearts updated");
        }

        // 2) Owl Carousel init bittikten sonra ve her yenilemede çalıştır
        var $owl = $('.owl-menu-item.owl-carousel');
        $owl
            .on('initialized.owl.carousel refreshed.owl.carousel translated.owl.carousel', markCarouselHearts)
            // eğer init kodunuz ayrıysa, aşağıdaki trigger’a ihtiyaç var:
            .trigger('refresh.owl.carousel');

        // 3) Yine de yüklendikten 1 saniye sonra bir kez daha garantileyelim
        $(window).on('load', function() {
            setTimeout(markCarouselHearts, 1000);
        });



        // Kalpleri güncelleyen fonksiyon
        function updateHearts() {
            window.favUrls.forEach(function(url) {
                var $els = $('.item[data-recipe-url="' + url + '"], .tab-item[data-recipe-url="' + url +
                    '"]');
                $els.find('.favorite-button i')
                    .removeClass('fa-heart-o')
                    .addClass('fa-heart');
            });
            console.log("[Fav] Hearts updated");
        }

        // 1) Owl Carousel elementini seç
        var $owl = $('.owl-menu-item.owl-carousel');
        // 2) Henüz init edilmemişse, init olayına bağla
        $owl
            .on('initialized.owl.carousel refreshed.owl.carousel translated.owl.carousel', updateHearts);

        // 3) Carousel zaten init edildiyse hemen refresh tetikle
        $owl.trigger('refresh.owl.carousel');

        // 4) Yine de yüklendikten 500ms sonra bir kez daha çalıştır
        setTimeout(updateHearts, 500);

        // --- Favori click handler’ları aşağıda ---
        $('#favoriteButton').off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (!window.loggedIn) return $('#loginModal').show();
            $('#loginModal').hide();
            $.get('get_favorites.php', function(html) {
                $('#favoritesList').html(html);
                $('#favoritesModal').css('z-index', 3000).show();
            });
        });
        $('#closeFavorites').off('click').on('click', function() {
            $('#favoritesModal').hide();
        });
        $(document).off('click', '.favorite-button').on('click', '.favorite-button', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (!window.loggedIn) return $('#loginModal').show();
            var btn = $(this),
                container = btn.closest('.item, .tab-item'),
                name = container.data('recipe-name') || container.find('h4, .title').first().text()
                .trim(),
                url = container.data('recipe-url') || container.find('a').first().attr('href');
            console.log("[Fav] Toggling favorite:", {
                recipe_name: name,
                recipe_url: url
            });
            $.post('add_favorite.php', {
                    recipe_name: name,
                    recipe_url: url
                },
                function(res) {
                    if (res.success) {
                        var icon = btn.find('i');
                        if (res.action === 'added') icon.removeClass('fa-heart-o').addClass(
                            'fa-heart');
                        else if (res.action === 'removed') icon.removeClass('fa-heart').addClass(
                            'fa-heart-o');
                    }
                }, 'json'
            ).fail(function(jqXHR, ts, err) {
                console.error("[Fav] AJAX error:", ts, err, jqXHR.responseText);
            });
        });
        $('#closeModal, #redirectToLogin').off('click').on('click', function() {
            $('#loginModal').hide();
            if (this.id === 'redirectToLogin') window.location.href = 'login.html';
        });
    });
    </script>




    <script src="assets/js/custom.js"></script>
    <script>
    $(function() {
        var selectedClass = "";
        $("p").click(function() {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function() {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });
    </script>
</body>

</html>