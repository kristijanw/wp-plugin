<?php 
if ( ! defined( 'ABSPATH' ) ) { die; } 

$erp_options = $this->webp_helper->erp_options_data('erp-login');

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>WebPro Home</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'component/home-erp.php'; ?>
                        </div>
                        <div class="col">
                            <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'component/manual-import.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-right">
                    <?php echo date('d.m.Y H:i:s', time()); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function() {

    jQuery('.btn-erp-valid').on('click', function(e) {
        e.preventDefault();

        var isValid = false;
        isValid = jQuery('#erp-valid').valid();

        console.log(isValid);

        if(isValid == true) {
            var params = {};
            jQuery('.arr-validator').each(function(i, obj) {
                params[obj.name] = obj.value;
            });

            jQuery.ajax({
                type: "POST",
                dataType: 'JSON',
                url: webproAjax.ajaxurl,
                data: {'action' : 'update_erp_settings', data: params, 'security': webproAjax.ajaxnonce}
            }).done(function(data) {
                if(data.status == 'success') {
                    alert(data.message);

                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

                if(data.status == 'error'){
                    alert(data.message);
                }
            });
        }
        else {
            alert('Polja su obavezna za spremanje podataka.');
        }
    });

    jQuery('#erp-valid').validate({
        debug: false,
        errorPlacement: function(error, element) {}, 
        rules: {
            'erp-username': {
                required: true
            },
            'erp-password': {
                required: true
            },
        }
    });

});
</script>