jQuery(document).ready(function(){

    //jQuery("body").hide();

    jQuery("select#order-status").on('change', function(){
        let value = jQuery(this).val();

        jQuery(".hide-text").hide();
        jQuery("#"+value+"").show();

    });

});