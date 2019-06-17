<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="text-align: left">
        <form action="user.php" method="post" class="user-register">
          <div class="row" style="margin-bottom: 1rem">
            <div class="col">
              <input type="text" id="validationCustom01" name="first_name" class="form-control" placeholder="First name" required>
              <div class="invalid-feedback">
                Please provide valid name
              </div>
            </div>
            <div class="col">
              <input type="text" id="validationCustom02" name="last_name"class="form-control" placeholder="Last name" required>
              <div class="invalid-feedback">
                Please provide valid name
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="email" aria-invalid="email" class="form-control" id="validationCustom03" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <div class="invalid-feedback">
              Please provide valid email
            </div>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="validationCustom04" name="password" placeholder="Password" required>
            <div class="invalid-feedback">
              Please provide valid password
            </div>
          </div>
          <button type="submit" name="register_btn" class="btn btn-success">Sign Up</button>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Register Modal End -->