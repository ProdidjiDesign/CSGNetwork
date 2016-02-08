
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
<?php if($mobile){ ?>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<?php } ?>
<script type = "text/javascript">
$(document).ready( function() {
    $(".ui-loader").hide();
});
</script>
<script type = "text/javascript" src="./js/jquery.mosaicflow.min.js"></script>
<script src=<?php echo PATH."js/main.js"; ?> type = "text/javascript"></script>