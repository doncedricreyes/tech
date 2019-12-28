<!DOCTYPE html>

<html>
<style>
        #logo{
            position: relative;
            float: left;
        }
        #nav{
            position: relative;
            top:80px;
            
          
        }
        a:link    {color:#000;}  /* unvisited link  */
        a:visited {color:#000;}  /* visited link    */
        a:hover   {color:#000;}  /* mouse over link */
        a:active  {color:#000;}  /* selected link   */ 
</style>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
          
      <title>{{ config('PIOLINX ENGINEERING SERVICES', 'PIOLINX ENGINEERING SERVICES') }}</title>
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  
  
  </head>
  <body>
     <nav class="navbar navbar-expand-md navbar-dark fixed-top">
      <a class="navbar-brand" href="/"> <img src="/storage/images/logo.png" id="logo" width="200"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
              <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item {{Request::is('about') ? 'active' : ''}}">
            <a class="nav-link" href="/about">HELLO</a>
          </li>
          <li class="nav-item {{Request::is('projects') ? 'active' : ''}}">
            <a class="nav-link" href="/projects">Projects & Services</a>
          </li>
          <li class="nav-item {{Request::is('careers') ? 'active' : ''}}">
            <a class="nav-link" href="/careers">Careers</a>
          </li>
          <li class="nav-item {{Request::is('contacts') ? 'active' : ''}}">
            <a class="nav-link" href="/contacts">Contact</a>
          </li>
          <li class="nav-item {{Request::is('/customer/service') ? 'active' : ''}}">
            <a class="nav-link" href="/customer/service">Service</a>
          </li>
               <li class="nav-item {{Request::is('/customer/service') ? 'active' : ''}}">
            <a class="nav-link" href="/customer/service/tickets">My tickets</a>
          </li>
          <li class="nav-item {{Request::is('/customer/login') ? 'active' : ''}}">
            <a class="nav-link" href="/customer/login">Login</a>
          </li>
        </ul>
      </div>
    </nav>
    <section class="content">
        @yield('content')
        <div class="home-footer">
          <div>
              <h5>Site Links</h5>
              <p><a href="/">Home</a></p>
              <p><a href="/about">About</a></p>
              <p><a href="/projects">Projects</a></p>
              <p><a href="/careers">Careers</a></p>
          </div>
          <div><h5>Get in touch</h5>
              <p><a href="/contact">Contact Us</a></p>
              <p>Phone: (+63) 927 655 8584</p>
              <p>Email: piolinxengineering@gmail.com</p>
              <p>On Social Media: </p>
              <p><a href="#"><i class="fab fa-facebook-square"></i></a><a href="#"><i class="fab fa-facebook-messenger"></i></a><a href="#"><i class="fab fa-twitter-square"></i></a><a href="#"><i class="fab fa-google-plus-square"></i></a></p>
          </div>
          <div><h5>Location</h5><p>Poblacion, Muntinlupa City, Philippines</p></div>
        </div>
        <div class="foot-note">© Piolinx — Engineering Services, 2019 All Rights Reserved. </div>
    </section>
      <!--nav class="navbar navbar-expand-lg navbar-light ">
              <img src="/storage/images/logo.jpg" class="navbar-brande" id="logo" width="600" height="200">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/projects">Projects</a>
                  </li>
                  <li class="nav-item">
                          <a class="nav-link" href="/careers">Careers</a>
                        </li>
                        <li class="nav-item">
                              <a class="nav-link" href="/contacts">Contact</a>
                            </li>
                </ul>
                <span class="navbar-text">
        
                </span>
              </div>
            </nav-->
      <script src="{{ asset('js/app.js') }}"></script>        
      @yield('js')
  </body>
</html>