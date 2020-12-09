<!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Car Managaement Admin Area</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">{{date('l jS \of F Y H:i:s A')}} <i class="mdi mdi-heart text-danger"></i>
        </span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- The Modal -->
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('theme/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('theme/assets/vendors/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('theme/assets/js/shared/off-canvas.js')}}"></script>
<script src="{{asset('theme/assets/js/shared/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('theme/assets/js/demo_1/dashboard.js')}}"></script>
<!-- End custom js for this page-->
</body>
</html>