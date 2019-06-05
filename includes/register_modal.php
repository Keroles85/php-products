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
        <form action="user.php" method="post">
          <div class="row" style="margin-bottom: 1rem">
            <div class="col">
              <input type="text" name="first_name" class="form-control" placeholder="First name">
            </div>
            <div class="col">
              <input type="text" name="last_name"class="form-control" placeholder="Last name">
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <button type="submit" name="register_btn" class="btn btn-success">Sign Up</button>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Register Modal End -->