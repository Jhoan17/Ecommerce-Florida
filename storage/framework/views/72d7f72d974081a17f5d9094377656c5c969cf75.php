<?php if(session('message')): ?>
	<div id="toast-container" class="toast-top-right">
		<div class="toast toast-success toast-time-hide" aria-live="assertive" style="">
			<div class="toast-message">
				<?php echo e(session('message')); ?>

			</div>
		</div>		
	</div>	
<?php endif; ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/includes/messages.blade.php ENDPATH**/ ?>