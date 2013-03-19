<?php

	$item_id = $_GET['id'] ;

?>

<div id="cart-modal" class="modal hide fade" aria-hidden="false">
	<div class="modal-body">
		<p>Item name</p>
		<p> Quantity + form </p>
		<p> Submit button that turns green when request is sucessful then the modal fades away.</p>
	</div>
</div>

<script type="text/javascript">

    $(function()
        {
            $("#cart-modal").modal('show');
        });

</script>