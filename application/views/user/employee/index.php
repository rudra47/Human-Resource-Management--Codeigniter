<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

  <div class="container" style="padding-top: 50px;">
      <div class="row">
      <div class="col-md-4 offset-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Employee Login in</h3>
              <br>
          </div>

          <div class="text-danger">
            <?php
              echo $this->session->message;
            ?>
          </div>

          <div class="panel-body">
            <form action="<?php echo base_url('employee/login')?>" method="post" accept-charset="UTF-8" role="form">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="User Id" name="user_id" type="text" value="<?php echo set_value('user_id')?>">
                  <span style="color: red;"> <?php echo form_error('user_id')?> </span>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="">
                  <span style="color: red;"> <?php echo form_error('password')?> </span>
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                <br>
              </fieldset>
              </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>