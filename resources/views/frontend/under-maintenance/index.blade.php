<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Free coming soon template with jQuery countdown">

  <title>Waratime - Under Constraction and Coming Soon</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{!! asset($pathp.'assets/maintenance/css/bootstrap.css') !!}">
  <link rel="stylesheet" href="{!! asset($pathp.'assets/maintenance/css/bootstrap-theme.css') !!}">
  <link rel="stylesheet" href="{!! asset($pathp.'assets/maintenance/css/font-awesome.css') !!}">
  <link rel="stylesheet" href="{!! asset($pathp.'assets/maintenance/css/style.css') !!}">
</head>

<body>

  <div id="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <img src="{{ asset($pathp.'assets/frontend/images/logo.png') }}" alt="logo" width="200" height="50">
          <h1>Our website is under construction.</h1>
          <h2 class="subtitle">We'll be here soon with our new awesome site.</h2>
          <div id="countdown"></div>
          <!-- <form class="form-inline signup" role="form">
            <div class="form-group">
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
            </div>
            <button type="submit" class="btn btn-theme">Get notified!</button>
          </form> -->

          <div class="social">
           <!--  <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> -->
          </div>
        </div>
      </div>

      <div class="row contctform">
        <div class="col-md-8 col-md-offset-2">
          <!-- <h3>Contact Us</h3>
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div> -->
        </div>
        <!-- <form action="" method="post" role="form" class="contactForm">
          <div class="col-md-4 col-md-offset-2">
            <div class="form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form">
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-theme">Send Message</button></div>
            </div>
          </div>
        </form> -->

      </div>

      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <p class="copyright">&copy; Waratime - All Rights Reserved</p>
          <div class="credits">
            <!-- <a href="https://bootstrapmade.com/">Free Bootstrap Themes</a> by BootstrapMade -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="{!! asset($pathp.'assets/maintenance/js/bootstrap.min.js') !!}"></script>
  <script src="{!! asset($pathp.'assets/maintenance/js/jquery.countdown.min.js') !!}"></script>
  <script type="text/javascript">
    $('#countdown').countdown('2018/04/01', function(event) {
      $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
    });
  </script>

  <script src="contactform/contactform.js"></script>

</body>

</html>
