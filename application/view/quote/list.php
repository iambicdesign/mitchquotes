<div class="quote-list">
	<h3><?php echo $this->title; ?></h3>
	<?php foreach($quotes as $quote) {
		include APP . 'view/quote/index.php';
	} ?>
</div>