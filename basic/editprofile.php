<h2 class="text-center mb-5">Edit Profile</h2>
<div class="container">
    <div class="col-md-9 mx-auto">
          <form method="POST">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $data["fullname"]; ?>" >
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $data["email"]; ?>">
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $data["contact"]; ?>">
            </div>
              <button type="submit" class="btn btn-primary btn-block" name="editbtn">update</button>
          </form>
    </div>
</div>