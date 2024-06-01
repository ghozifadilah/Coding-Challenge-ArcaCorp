
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p class="mb-1">&copy; Copyright Ghozi Fadhillah. All Rights Reserved</p>
        <div class="credits">
          <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=MyPortfolio
        -->
        
        </div>
      </div>
      <div class="col-sm-6 social text-md-end">
        <!-- <a href="#"><span class="bi bi-twitter"></span></a>
        <a href="#"><span class="bi bi-facebook"></span></a> -->
        <a href="#"><span class="bi bi-instagram"></span></a>
        <a href="#"><span class="bi bi-linkedin"></span></a>
      </div>
    </div>
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url('assets/vendor/aos/aos.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/theaterjs/dist/theater.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<!-- Template Main JS File -->
<script src="<?php echo base_url('assets/js/main.js') ?>"></script>
</body>

</html>

<!-- <script>
var theater = theaterJS();
theater.
on('type:start, erase:start', function () {
theater.getCurrentActor().$element.classList.add('actor__content--typing');
}).
on('type:end, erase:end', function () {
theater.getCurrentActor().$element.classList.remove('actor__content--typing');
});

theater.
addActor('example', { speed: 0.8, accuracy: 0.6 }).
addScene('example:CSS', 600).
addScene('example:Script', 400).
addScene('example:Com.', 1600).
addScene('example:CSSScript.com.', 1000).addScene(theater.replay.bind(theater));
</script> -->

<script>
var theater = theaterJS();
theater.
on('type:start, erase:start', function () {
theater.getCurrentActor().$element.classList.add('actor__content--typing');
})


theater.
addActor('example', { speed: 0.8, accuracy: 0.6 }).
addScene('example:Ghozi', 400).
addScene('example:Ghozi Fadhillah <br> Himma', 1600)
</script>