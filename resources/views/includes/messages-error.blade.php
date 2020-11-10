@if(session('error'))
	<div id="toast-container" class="toast-top-right">
		<div class="toast toast-error toast-time-hide" aria-live="assertive" style="">
			<div class="toast-messages">
				{{session('error')}}
			</div>
		</div>		
	</div>	
@endif