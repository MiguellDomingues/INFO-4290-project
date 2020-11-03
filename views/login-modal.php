<div class="modal fade" id="login">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="process/login.php">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn border-success" data-dismiss="modal" data-toggle="modal" data-target="#register">Create Account</button>
                  <button id="" type="submit" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>