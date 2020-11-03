<div class="modal fade" id="register">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="process/register.php">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputfirstname1">First Name</label>
                    <input name="first_name" type="text" class="form-control" id="exampleInputfirstname1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputlastname1">Last Name</label>
                    <input name="last_name" type="text" class="form-control" id="exampleInputlastname1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputlastname1">Phone</label>
                    <input name="phone" type="number" class="form-control" id="exampleInputphone1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputlastname1">Gender</label>
                    <select name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                  </div>
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn border-success" data-dismiss="modal" data-toggle="modal" data-target="#login">Login</button>
                  <button type="submit" class="btn btn-success">Create Account</button>
                </div>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>