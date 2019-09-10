<div class="container">

  <div class="contact">
    <div class="form-wrapper">
      <div class="container">
        <div class="form">
          <div class="alert-wrapper">
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Thank You For Filling out Our Form!
            </div>
          </div>
          <div class="h-name">
            <h2><span>get in touch</span></h2>
          </div>
          <form action="" method="GET" id="s-form">
            <div class="f-row">
              <input type="text" name="fullName" placeholder="Full Name" required>
              <input type="tel" name="phoneNumber" placeholder="Phone Number" pattern="[0-9]{10}" required>
            </div>
            <div class="s-row">
              <input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>
            <div class="t-row">
              <textarea rows="7" placeholder="Message" maxlength="50"></textarea>
            </div>
            <span id="chars">50</span><span id="chars-text"> Characters Remaining</span>
            <div class="btn">
              <button type="submit" class="btn-hover" id="sumbit-btn">SUBMIT</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>