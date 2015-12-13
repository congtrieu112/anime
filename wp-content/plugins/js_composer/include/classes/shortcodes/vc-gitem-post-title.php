<?php

class WPBakeryShortCode_VC_Gitem_Post_title extends WPBakeryShortCode_VC_Gitem_Post_Data {
	protected function getFileName() {
		return 'vc_gitem_post_data';
	}

	/**
	 * Get data_source attribute value
	 *
	 * @param array $atts - list of shortcode attributes
	 *
	 * @return string
	 */
	public function getDataSource( array $atts ) {
		return 'post_title';
	}
}