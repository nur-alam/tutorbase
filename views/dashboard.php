<?php
/**
 * Admin page
 *
 * @package Tutorowl
 */

$template_list = TEMPLATE_LIST;

?>
<div id="tutorowl-demo-import">
	<div class="tutorowl-demo-importer-ui">
		<div class="tutorowl-demo-importer-wrapper">
			<div class="tutorowl-demo-importer-top">
				<div class="tutorowl-demo-importer-top-left">
					<div class="tutorowl-top-left-icon">
						<svg width="32" height="32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.667 11.666v10.667a4 4 0 0 0 4 4h5.666M3.667 11.667v-2a4 4 0 0 1 4-4h16.666a4 4 0 0 1 4 4v2m-24.666 0h9.666m0 14.666h11a4 4 0 0 0 4-4V11.667m-15 14.666V11.667m15 0h-15" stroke="#4B505C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<div>
						<div class="tutorowl-top-left-heading"><?php esc_html_e( 'Themes', 'tutorowl' ); ?></div>
						<div class="tutorowl-top-left-text"><?php esc_html_e( 'Leverage the collection of magnificent Tutor starter themes to make a jumpstart.', 'tutorowl' ); ?></div>
					</div>
				</div>
				<div class="tutorowl-demo-importer-top-right">
					<div class="tutorowl-template-search-wrapper">
						<input type="text" placeholder="Search...">
						<svg class="tutorowl-template-search-icon" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.858 1.524a5.334 5.334 0 1 0 0 10.667 5.334 5.334 0 0 0 0-10.667ZM0 6.858a6.858 6.858 0 1 1 12.216 4.28l3.56 3.561a.762.762 0 1 1-1.077 1.078l-3.561-3.561A6.858 6.858 0 0 1 0 6.858Z" fill="#9197A8"/></svg>
					</div>
				</div>
			</div>
			<ul class="tutorowl-demo-importer-list">
				<?php
				$i = 0;
				if ( ! empty( $template_list ) ) {
					foreach ( $template_list as $key => $template ) {
						$template = (object) $template;
						?>
						<li class="tutorowl-single-template">
							<div class="tutorowl-single-template-inner">
								<div class="tutorowl-template-preview-img">
									<!-- <img src="<?php echo esc_url( $prev_img[ $i++ ] ); ?>" loading="lazy" alt="icon"> -->
									<img src="<?php echo esc_url( $template->preview_image ); ?>" loading="lazy" alt="icon">
									<button 
										data-template="<?php echo esc_attr( $key ); ?>"
										class="tutor-template-import-btn">
										<?php esc_html_e( 'Get this', 'tutorowl' ); ?>
									</button>
								</div>
								<!-- <div class="tutorowl-template-actions">
									<a class="preview-url btn btn-light" href="https://preview.tutorlms.com/singlecourse/"
										target="_blank"><?php esc_html_e( 'Preview', 'tutorowl' ); ?></a>
									<button 
										data-template="<?php echo esc_attr( $key ); ?>"
										class="tutor-template-import-btn btn btn-primary primary-btn">
										<span><?php esc_html_e( 'Import', 'tutorowl' ); ?></span>
									</button>
								</div> -->
							</div>
							<div class="tutorowl-single-template-footer">
								<div class="tutorowl-template-name">
									<span><?php echo esc_html( $template->name ); ?></span>
									<span class="tutorowl-template-badge"> <?php esc_html_e( 'Pro', 'tutorowl' ); ?> </span>
								</div>
								<a class="tutorowl-template-preview" href="<?php echo esc_url( '#', 'tutorowl' ); ?>">
									<svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.343 3.879a.889.889 0 0 0-.888.889v8.889a.889.889 0 0 0 .888.889h8.89a.889.889 0 0 0 .888-.89V8.809a.727.727 0 0 1 1.455 0v4.849A2.343 2.343 0 0 1 11.232 16H2.343A2.343 2.343 0 0 1 0 13.657v-8.89a2.343 2.343 0 0 1 2.343-2.343h4.849a.727.727 0 0 1 0 1.455H2.343ZM9.697.727c0-.401.326-.727.727-.727h4.849c.401 0 .727.326.727.727v4.849a.727.727 0 0 1-1.454 0V1.455h-4.122a.727.727 0 0 1-.727-.728Z" fill="#9197A8"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15.787.213a.727.727 0 0 1 0 1.029L6.898 10.13A.727.727 0 0 1 5.87 9.102L14.758.213a.727.727 0 0 1 1.029 0Z" fill="#9197A8"/></svg>
								</a>
							</div>
						</li>
						<?php
					}
				} else {
					?>
						<h3 style="text-align: center; margin-top: 30px;">
						<?php esc_html_e( 'No template available.', 'tutorowl' ); ?></h3>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>



<div id="modal-wrapper">
	<div class="modal-wrapper-overlay"></div>
	<div class="modal-content">
		<div class="modal-head">
			<h3><?php esc_html_e( 'Music Template', 'tutorowl' ); ?></h3>
		</div>
		<div class="import-item-wrapper">
			<div class="installation-progress-wrapper">
				<div class="progress">
					<div class="progress-status"></div>
				</div>
				<div class="percentage-number">0%</div>
			</div>
			<div class="success-block-wrapper">
				<div class="success-block">
					<div class="success-heading">
						<svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M24 41C33.3888 41 41 33.3888 41 24C41 14.6112 33.3888 7 24 7C14.6112 7 7 14.6112 7 24C7 33.3888 14.6112 41 24 41ZM15.5663 24.8555C15.6107 24.9627 15.6747 25.0607 15.7552 25.1443L21.7787 31.1456C21.8582 31.2383 21.9567 31.3128 22.0675 31.3641C22.3046 31.462 22.5708 31.462 22.8079 31.3641C22.9187 31.3128 23.0172 31.2383 23.0967 31.1456L33.7628 20.535C33.8432 20.4514 33.9073 20.3535 33.9516 20.2463C34.0401 20.0074 34.0401 19.7447 33.9516 19.5058C33.9082 19.3981 33.844 19.3 33.7628 19.217L32.4226 17.9138C32.3442 17.8238 32.2476 17.7514 32.1391 17.7016C32.0305 17.6518 31.9126 17.6257 31.7932 17.6251C31.666 17.6235 31.5399 17.6487 31.423 17.6991C31.3103 17.7509 31.2085 17.8238 31.1231 17.9138L22.4451 26.5919L18.4023 22.5416C18.3145 22.451 18.2102 22.3781 18.095 22.3269C17.9784 22.2757 17.8521 22.2504 17.7247 22.2529C17.6073 22.2532 17.4912 22.2785 17.3841 22.3269C17.2729 22.3758 17.1742 22.4492 17.0954 22.5416L15.7552 23.8263C15.674 23.9093 15.6098 24.0074 15.5663 24.1151C15.4779 24.354 15.4779 24.6166 15.5663 24.8555Z"
								fill="#24A148"></path>
						</svg>
						<h3><?php esc_html_e( 'Import Successful!', 'tutorowl' ); ?></h3>
					</div>
					<p><?php esc_html_e( 'Bingo! Your demo site is ready. Check how it looks.', 'tutorowl' ); ?></p>
					<a href="<?php echo esc_url( home_url() ); ?>" class="btn btn-primary view-site-now"
						target="_blank">
						<?php esc_html_e( 'View Site', 'tutorowl' ); ?>
					</a>
				</div>
			</div>
			<div class="import-item">
				<svg class="svg-circle" style="width: 15px; height: 15px;">
					<circle class="circle-full" cx="8" cy="8" r="8" fill="#5FAC23"></circle>
					<path class="check-mark"
						d="M6.138 8.9714L3.9427 6.776 3 7.7187l3.138 3.138L12 4.9427l-.9427-.9426L6.138 8.9714z"
						fill="#fff"></path>
				</svg>
				<svg class="svg-spinner" viewBox="0 0 50 50">
					<circle class="path" cx="25" cy="25" r="20" fill="none"></circle>
				</svg>
				<div class="title"><?php esc_html_e( 'Tutor LMS', 'tutorowl' ); ?></div>
			</div>
			<div class="import-item">
				<svg class="svg-circle" style="width: 15px; height: 15px;">
					<circle class="circle-full" cx="8" cy="8" r="8" fill="#5FAC23"></circle>
					<path class="check-mark"
						d="M6.138 8.9714L3.9427 6.776 3 7.7187l3.138 3.138L12 4.9427l-.9427-.9426L6.138 8.9714z"
						fill="#fff"></path>
				</svg>
				<svg class="svg-spinner" viewBox="0 0 50 50">
					<circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
				</svg>
				<div class="title"><?php esc_html_e( 'Droip', 'tutorowl' ); ?></div>
			</div>
			<div class="import-item">
				<svg class="svg-circle" style="width: 15px; height: 15px;">
					<circle class="circle-full" cx="8" cy="8" r="8" fill="#5FAC23"></circle>
					<path class="check-mark"
						d="M6.138 8.9714L3.9427 6.776 3 7.7187l3.138 3.138L12 4.9427l-.9427-.9426L6.138 8.9714z"
						fill="#fff"></path>
				</svg>
				<svg class="svg-spinner" viewBox="0 0 50 50">
					<circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
				</svg>
				<div class="title"><?php esc_html_e( 'Contents', 'tutorowl' ); ?></div>
			</div>
			<div id="content-details"></div>
		</div>
		<div class="danger-block"></div>
		<div class="modal-footer">
			<button id="import-cancel-btn" class="preview-url btn btn-light"><?php esc_html_e( 'Cancel', 'tutorowl' ); ?></button>
			<button class="btn btn-primary primary-btn import-now"><?php esc_html_e( 'Import Now', 'tutorowl' ); ?></button>
		</div>
	</div>
</div>