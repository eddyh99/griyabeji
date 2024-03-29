<?php if (@$_SESSION["logged_status"]["is_login"]) { ?>
	<!-- ====== Start Footer Page ====== -->
	<div id="kt_app_footer" class="app-footer mt-auto fixed-bottom">
		<!-- ====== STart Footer container ====== -->
		<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
			<div class="text-dark order-2 order-md-1">
				<span class="text-muted fw-semibold me-1">
					<script>
						document.write(new Date().getFullYear())
					</script>
				</span>
				<a href="https://www.softwarebali.com/" target="_blank" class="text-gray-800 text-hover-primary">SoftwareBali.com</a>
			</div>
			<!-- ===== Start Menu ====== -->
			<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
				<li class="menu-item">
					<a href="https://www.softwarebali.com/" target="_blank" class="menu-link px-2">About</a>
				</li>
				<li class="menu-item">
					<a href="https://www.softwarebali.com/" target="_blank" class="menu-link px-2">Support</a>
				</li>
				<li class="menu-item">
					<a href="https://www.softwarebali.com/" target="_blank" class="menu-link px-2">Purchase</a>
				</li>
			</ul>
			<!-- ====== End Menu ====== -->

		</div>
		<!--====== End Footer container ====== -->
	</div>
<?php } ?>
<!--====== End Footer Page ====== -->
</div>
<!--====== End Main Content ====== -->
</div>
<!-- ======  End Wrapper Side Bar ====== -->
</div>
<!-- ====== End Page ====== -->
</div>
<!-- ====== End App ====== -->



<!-- ======= Start Scrolltop ====== -->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">

	<span class="svg-icon">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
			<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
		</svg>
	</span>

</div>
<!--======= End Scrolltop ====== -->

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3 m-3" style="z-index: 11">
	<div id="notifToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
		<div class="toast-header">
			<img src="<?= base_url() ?>assets/img/logo.webp" class="rounded me-2" alt="..." height="20">
			<strong class="me-auto">Pesan</strong>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body" id="message_toast">
		</div>
	</div>
</div>


<script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>
<script src="<?= base_url() ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="<?= base_url() ?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- AUTO NUMERIC -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.8.2/autoNumeric.js"></script>

<?php
if (isset($extra)) {
	$this->load->view($extra);
}
?>
<script>
	$(".typeMoney").autoNumeric('init', {
		aSep: ',',
		// aDec: '.',
		aForm: true,
		vMax: '99999999999',
		vMin: '0'
	});

	document.addEventListener("DOMContentReady", function() {
		$("#notifToast").toast();
	});
</script>

</body>

</html>