<?php 
if ( ! defined( 'ABSPATH' ) ) { die; } 
?>

<div class="row">
  <div class="col">
    <h4>ERP LOGIN</h4>
  </div>
</div>

<form class="row g-3" id="erp-valid" method="post" action="">
  <div class="col-md-6">
    <input type="text" class="form-control arr-validator" name="erp-username" value="<?php echo $erp_options['erp_username']; ?>" placeholder="Korisničko ime">
  </div>
  <div class="col-md-6">
    <input type="password" class="form-control arr-validator btn-show-hide-pass" name="erp-password" value="<?php echo $erp_options['erp_password']; ?>" placeholder="Lozinka">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-sm btn-primary btn-erp-valid">Spremi</button>
  </div>
</form>