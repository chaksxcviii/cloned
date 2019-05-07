<?php
include 'fetch-data.php';


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>CBN CoinCap</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
  <!-- Docs CSS -->
  <link type="text/css" href="assets/css/docs.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>

</head>

<body>
  <header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
      <div class="container">
        <a class="navbar-brand mr-lg-5" href="../index.html">
          <img src="assets/img/brand/white.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="ni ni-ui-04 d-lg-none"></i>
                <span class="nav-link-inner--text">Components</span>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                <i class="fa fa-facebook-square"></i>
                <span class="nav-link-inner--text d-lg-none">Facebook</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
                <i class="fa fa-instagram"></i>
                <span class="nav-link-inner--text d-lg-none">Instagram</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
                <i class="fa fa-twitter-square"></i>
                <span class="nav-link-inner--text d-lg-none">Twitter</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial/argon-design-system" target="_blank" data-toggle="tooltip" title="Star us on Github">
                <i class="fa fa-github"></i>
                <span class="nav-link-inner--text d-lg-none">Github</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="position-relative">
      <!-- shape Hero -->
      <section class="section section-lg section-shaped pb-250">
        <div class="shape shape-style-1 shape-default">
        </div>
        <div class="container py-lg-md d-flex">
          <div class="col px-0">
            <div class="row text-center">
              <div class="col-lg-12">
                <h1 class="display-3  text-white">CBN's Crypto Price Listing</h1>
                <p class="lead  text-white">List of top 100 Cryptocurrencies with their prices updated regularly</p>
              </div>
            </div>
          </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>
      <!-- 1st Hero Variation -->
    </div>
    <section class="section section-lg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="heading" class="table-responsive">
                    <table id="crypto-list" class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Circulating Supply</th>
                                <th>Market Cap</th>
                                <th>Volume</th>
                                <th>Per Change (24hrs)</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = 'select * from listing order by marketCapUsd desc';
                                $request = $connection->query($query);
                                $i=1;
                                while($row=$request->fetch_assoc()){
                                    if($row['price']<= 0.01){
                                        $price = number_format($row['price'],5);
                                    }else{
                                        $price = number_format($row['price'],2);
                                    }
                                    $change24h = '<td>'.number_format($row['changepercent24'],2).'<span>%</span></td>';
                                    if($row['changepercent24']>= 0.0){
                                        $change24h = '<td class="green">'.number_format($row['changepercent24'],2).'<span>%</span></td>';
                                    }
                                    elseif($row['changepercent24']<= 0.0){
                                        $change24h = '<td class="red">'.number_format($row['changepercent24'],2).'<span>%</span></td>';
                                    }
                                    $logo = 'assets/cryptocurrency-icons/32/color/'.$row['symbol'].'.png';
                                    if(file_exists($logo)){
                                        $logo = '<img src="assets/cryptocurrency-icons/32\color/'.$row['symbol'].'.png" alt="">';
                                    }else{
                                        $logo = '<b>'.$row['symbol'].'</b>';
                                    }
                                    echo '<tr>
                                    <td>'.($i++).'</td>
                                    <td><b>'.$row['name'].'</b></td>
                                    <td>'.$logo.'</td>
                                    <td>'.number_format($row['supply']).'</td>
                                    <td><span>$</span>'.number_format($row['marketCapUsd']).'</td>
                                    <td><span>$</span>'.number_format($row['volume24']).'</td>
                                    '.$change24h.'
                                    <td><span>$</span>'.$price.'</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                        </div>  
                </div>
            </div>
        </div>
    </section>
    
    
  </main>
  <footer class="footer has-cards">
    
    <div class="container">
      <div class="row row-grid align-items-center my-md">
        <div class="col-lg-6">
          <h3 class="text-primary font-weight-light mb-2">This website was created by Caribbean Blockchain Network</h3>
          <h4 class="mb-0 font-weight-light">Get in touch on any of these platforms.</h4>
        </div>
        <div class="col-lg-6 text-lg-center btn-wrapper">
          <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip" data-original-title="Follow us">
            <i class="fa fa-twitter"></i>
          </a>
          <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" data-original-title="Like us">
            <i class="fa fa-facebook-square"></i>
          </a>
          <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-neutral btn-icon-only btn-telegram btn-lg btn-round" data-toggle="tooltip" data-original-title="Follow us">
            <i class="fa fa-telegram"></i>
          </a>
          <a target="_blank" href="https://github.com/creativetimofficial" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip" data-original-title="Star on Github">
            <i class="fa fa-github"></i>
          </a>
        </div>
      </div>
      <hr>
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-3">
          <div class="copyright">
            &copy; 2018
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
        <div class="col-md-9">
          <ul class="nav nav-footer justify-content-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item ">
                 <a href="coincap.io" class="nav-link">API provided by: CoinCap.io</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Core -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/popper/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.1"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
  <script>
      $(document).ready(function(){
          $('#crypto-list').dataTable({
              "iDisplayLength":25
          });
      });

      $('html, body').animate({
          scrollTop: $("#heading").offset().top
      },2500);

      setTimeout(() => {
          window.location.href="http://localhost/cloned/"
      }, 120000);
  </script>
</body>

</html>

