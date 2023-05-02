							<?php if (@$_SESSION["logged_status"]["is_login"]){?>
							<!-- ====== Start Footer Page ====== -->
							<div id="kt_app_footer" class="app-footer">
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
							<?php }?>
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


		<script>var hostUrl = "<?= base_url()?>assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url()?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url()?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?= base_url()?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="<?= base_url()?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>
		<!--end::Vendors Javascript-->

        <?php 
            if (isset($extra)){
                $this->load->view($extra);
            }
        ?>

	</body>

</html>