<?php

class WSU_Research_Theme {
	/**
	 * @since 0.3.0
	 *
	 * @var string String used for busting cache on scripts.
	 */
	var $script_version = '0.3.0';

	/**
	 * @since 0.3.0
	 *
	 * @var WSU_Research_Theme
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance and initiate hooks when
	 * called the first time.
	 *
	 * @since 0.3.0
	 *
	 * @return \WSU_Research_Theme
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSU_Research_Theme();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}
	/**
	 * Setup hooks to include.
	 *
	 * @since 0.3.0
	 */
	public function setup_hooks() {
		add_filter( 'spine_child_theme_version', array( $this, 'theme_version' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'research_enqueue_scripts' ) );
		add_filter( 'wsu_content_syndicate_host_data', array( $this, 'research_filter_syndicate_host_data' ), 10, 2 );
		add_action( 'wp_head', array( $this, 'research_add_meta_tags' ) );
		add_action( 'wsu_register_inline_svg', array( $this, 'register_svgs' ) );
	}

	/**
	 * Provide a theme version for use in cache busting.
	 *
	 * @since 0.3.0
	 *
	 * @return string
	 */
	function theme_version() {
		return $this->script_version;
	}

	/*
	 * Enqueue custom scripting in child theme.
	 */
	function research_enqueue_scripts() {
		wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom-research.css', array(), $this->script_version );

		global $is_IE;
		$post = get_post();
		if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'wsu_inline_svg' ) && ! $is_IE ) {
			wp_enqueue_script( 'animate-svg', get_stylesheet_directory_uri() . '/js/animate-svg.min.js', array( 'jquery' ), $this->script_version, true );
		}
	}

	/**
	 * Filter the thumbnail used from a remote host with WSU Content Syndicate
	 *
	 * @param object $subset Data associated with a single remote item.
	 * @param object $post   Original data used to build the subset.
	 *
	 * @return object Modified data.
	 */
	function research_filter_syndicate_host_data( $subset, $post ) {
		if ( is_array( $post ) && ! empty( $post['featured_media'] ) && ! empty( $post['_links']['wp:featuredmedia'] ) ) {
			$media_request_url = $post['_links']['wp:featuredmedia'][0]['href'];
			$media_request = WP_REST_Request::from_url( $media_request_url );
			$media_response = rest_do_request( $media_request );
			$data = $media_response->data;
			$data = $data['media_details']['sizes'];

			if ( isset( $data['spine-medium-size'] ) ) {
				$subset->thumbnail = $data['spine-medium-size']['source_url'];
			} else {
				$subset->thumbnail = $media_response->data['source_url'];
			}
		} elseif ( isset( $post->featured_media ) && isset( $post->_embedded->{'wp:featuredmedia'} ) && 0 < count( $post->_embedded->{'wp:featuredmedia'} ) ) {
			$subset_feature = $post->_embedded->{'wp:featuredmedia'}[0]->media_details;

			if ( isset( $subset_feature->sizes->{'spine-medium_size'} ) ) {
				$subset->thumbnail = $subset_feature->sizes->{'spine-medium_size'}->source_url;
			} else {
				$subset->thumbnail = $post->_embedded->{'wp:featuredmedia'}[0]->source_url;
			}
		} else {
			$subset->thumbnail = false;
		}

		return $subset;
	}

	/**
	 * Output a mobile specific meta tag on stage.research.wsu.edu
	 */
	function research_add_meta_tags() {
		global $current_blog;

		if ( 'research.wsu.edu' !== $current_blog->domain ) {
			return;
		}

		?><meta name="apple-mobile-web-app-capable" content="yes"><?php
	}

	/**
	 * Register SVG data for the WSU Inline SVG plugin.
	 */
	function register_svgs() {
		global $is_IE;

		// Sponsored project awards
		ob_start();
		?>
		<svg class="svg-graph<?php if ( ! $is_IE ) { echo ' animate'; } ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 270">
			<defs>
				<linearGradient id="spa-green" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#89b43f"/>
					<stop offset="100%" stop-color="#56aa46"/>
				</linearGradient>
				<linearGradient id="spa-blue" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#00a5bd"/>
					<stop offset="100%" stop-color="#1b9e85"/>
				</linearGradient>
			</defs>
			<title>Sponsored project awards received</title>
			<line x1="63.65" y1="216.02" x2="294.12" y2="216.02" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="216.02" x2="63.65" y2="210.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="178.88" y1="216.02" x2="178.88" y2="210.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="294.12" y1="216.02" x2="294.12" y2="210.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<text transform="translate(54.91 220.08)" style="font-size:9px;">0</text>
			<text transform="translate(9.33 179.49)" style="font-size:9px;">$50,000,000</text>
			<text transform="translate(4.18 138.9)" style="font-size:9px;">$100,000,000</text>
			<text transform="translate(4.18 98.32)" style="font-size:9px;">$150,000,000</text>
			<text transform="translate(4.18 57.73)" style="font-size:9px;">$200,000,000</text>
			<text transform="translate(4.18 17.14)" style="font-size:9px;">$250,000,000</text>
			<line x1="63.65" y1="216.02" x2="63.65" y2="13.09" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="216.02" x2="69.42" y2="216.02" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="175.44" x2="69.42" y2="175.44" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="134.85" x2="69.42" y2="134.85" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="94.26" x2="69.42" y2="94.26" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="53.68" x2="69.42" y2="53.68" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="63.65" y1="13.09" x2="69.42" y2="13.09" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<rect x="79.79" y="56.11" width="82.97" height="48.7" fill="url(#spa-green)" class="bar">
				<animate attributeName="height" to="48.7" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="56.11" from="104.81" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="195.02" y="38.26" width="82.97" height="63.31" fill="url(#spa-green)" class="bar">
				<animate attributeName="height" to="63.31" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="38.26" from="101.57" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="79.79" y="104.82" width="82.97" height="111.21" fill="url(#spa-blue)" class="bar">
				<animate attributeName="height" to="111.21" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="104.82" from="216.03" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="195.02" y="101.57" width="82.97" height="114.45" fill="url(#spa-blue)" class="bar">
				<animate attributeName="height" to="114.45" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="101.57" from="216.02" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<text transform="translate(103.52 228.08)" style="font-size:8px;">FY 2015</text>
			<text transform="translate(219.02 228.08)" style="font-size:8px;">FY 2016</text>
			<text transform="translate(87.84 123.34)" class="numbers">$137,237,387</text>
			<text transform="translate(201.84 119.37)" class="numbers">$140,714,791</text>
			<text transform="translate(91.57 74.4)" class="numbers">$59,852,123</text>
			<text transform="translate(205.19 55.84)" class="numbers">$78,454,069</text>
			<text transform="translate(87.33 49.61)" class="numbers">$197,089,510</text>
			<text transform="translate(201.33 32.01)" class="numbers">$219,168,860</text>
			<rect x="63.83" y="252.42" width="15.17" height="15.17" fill="url(#spa-green)"/>
			<text transform="translate(85.04 262.64)" style="font-size:9px;">Non-federal</text>
			<rect x="154.5" y="252.42" width="15.17" height="15.17" fill="url(#spa-blue)"/>
			<text transform="translate(175.56 262.64)" style="font-size:9px;">Federal</text>
		</svg>
		<?php
		$svg_1 = ob_get_contents();
		ob_end_clean();

		// Royalty revenue
		ob_start();
		?>
		<svg class="svg-graph<?php if ( ! $is_IE ) { echo ' animate'; } ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 270">
			<defs>
				<linearGradient id="rr-blue" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#00a5bd"/>
					<stop offset="100%" stop-color="#1b9e85"/>
				</linearGradient>
			</defs>
			<title>Royalty revenue</title>
			<line x1="42.43" y1="256.03" x2="272.89" y2="256.03" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="256.03" x2="42.43" y2="250.96" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="100.04" y1="256.03" x2="100.04" y2="250.96" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="157.66" y1="256.03" x2="157.66" y2="250.96" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="215.27" y1="256.03" x2="215.27" y2="250.96" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="272.89" y1="256.03" x2="272.89" y2="250.96" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<text transform="translate(33.68 260.09)" style="font-size:9px;">0</text>
			<text transform="translate(31.28 209.35)" style="font-size:9px;">.5</text>
			<text transform="translate(26.14 158.62)" style="font-size:9px;">1.0</text>
			<text transform="translate(26.14 107.89)" style="font-size:9px;">1.5</text>
			<text transform="translate(26.14 57.15)" style="font-size:9px;">2.0</text>
			<line x1="42.43" y1="256.03" x2="42.43" y2="53.1" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="256.03" x2="48.19" y2="256.03" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="205.3" x2="48.19" y2="205.3" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="154.57" x2="48.19" y2="154.57" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="103.83" x2="48.19" y2="103.83" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="42.43" y1="53.1" x2="48.19" y2="53.1" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<rect x="50.49" y="173.34" width="41.48" height="82.7" class="bar" fill="url(#rr-blue)">
				<animate attributeName="height" to="82.7" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="173.34" from="256.04" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="108.11" y="155.99" width="41.48" height="100.05" fill="url(#rr-blue)" class="bar">
				<animate attributeName="height" to="100.05" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="155.99" from="256.04" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="165.72" y="128.59" width="41.48" height="127.44" fill="url(#rr-blue)" class="bar">
				<animate attributeName="height" to="127.44" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="128.59" from="256.04" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="223.34" y="53.1" width="41.48" height="202.93" fill="url(#rr-blue)" class="bar">
				<animate attributeName="height" to="202.93" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="53.1" from="256.03" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<text transform="translate(59.87 266.54)" style="font-size:8px;">2013</text>
			<text transform="translate(118.37 266.54)" style="font-size:8px;">2014</text>
			<text transform="translate(176.87 266.54)" style="font-size:8px;">2015</text>
			<text transform="translate(236.37 266.54)" style="font-size:8px;">2016</text>
			<text transform="translate(55.91 169.09) rotate(-45)" class="numbers">$814,907</text>
			<text transform="translate(113.23 151.63) rotate(-45)" class="numbers">$985,785</text>
			<text transform="translate(170.04 124.16) rotate(-45)" class="numbers">$1,255,399</text>
			<text transform="translate(231.87 48.12) rotate(-45)" class="numbers">$1,955,051</text>
		</svg>
		<?php
		$svg_2 = ob_get_contents();
		ob_end_clean();

		// Commercialization activity
		ob_start();
		?>
		<svg class="svg-graph<?php if ( ! $is_IE ) { echo ' animate'; } ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 600 270">
			<defs>
				<linearGradient id="ca-green" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#89b43f"/>
					<stop offset="100%" stop-color="#56aa46"/>
				</linearGradient>
				<linearGradient id="ca-blue" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#00a5bd"/>
					<stop offset="100%" stop-color="#1b9e85"/>
				</linearGradient>
				<linearGradient id="ca-red" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#ef395f"/>
					<stop offset="100%" stop-color="#f04d4c"/>
				</linearGradient>
				<linearGradient id="ca-orange" x1="0" x2="0" y1="0" y2="1">
					<stop offset="0%" stop-color="#f47623"/>
					<stop offset="100%" stop-color="#f7a51c"/>
				</linearGradient>
			</defs>
			<title>Commercialization activity</title>
			<rect x="-379.83" y="-25.64" width="1623.66" height="390.79" style="stroke:#354049;stroke-miterlimit:10;fill:url(#ca-a)"/>
			<line x1="28.86" y1="215.62" x2="593.86" y2="215.62" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="215.62" x2="28.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="141.86" y1="215.62" x2="141.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="254.86" y1="215.62" x2="254.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="367.86" y1="215.62" x2="367.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="480.86" y1="215.62" x2="480.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="593.86" y1="215.62" x2="593.86" y2="210.73" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<text transform="translate(14.89 222.5)" style="font-size:9px;">0</text>
			<text transform="translate(9.74 189.89)" style="font-size:9px;">50</text>
			<text transform="translate(4.6 157.29)" style="font-size:9px;">100</text>
			<text transform="translate(4.6 124.69)" style="font-size:9px;">150</text>
			<text transform="translate(4.6 92.08)" style="font-size:9px;">200</text>
			<text transform="translate(4.6 59.48)" style="font-size:9px;">250</text>
			<text transform="translate(4.6 26.88)" style="font-size:9px;">300</text>
			<line x1="28.86" y1="215.62" x2="28.86" y2="20" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="215.62" x2="42.99" y2="215.62" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="183.02" x2="42.99" y2="183.02" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="150.41" x2="42.99" y2="150.41" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="117.81" x2="42.99" y2="117.81" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="85.21" x2="42.99" y2="85.21" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="52.6" x2="42.99" y2="52.6" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="28.86" y1="20" x2="42.99" y2="20" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<rect x="109.09" y="134.76" width="20.34" height="80.86" fill="url(#ca-orange)" class="bar">
				<animate attributeName="height" to="80.86" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="134.76" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="222.09" y="29.78" width="20.34" height="185.84" fill="url(#ca-orange)" class="bar">
				<animate attributeName="height" to="185.84" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="29.78" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="335.09" y="153.67" width="20.34" height="61.95" fill="url(#ca-orange)" class="bar">
				<animate attributeName="height" to="61.95" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="153.67" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="448.09" y="169.32" width="20.34" height="46.3" fill="url(#ca-orange)" class="bar">
				<animate attributeName="height" to="46.3" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="169.32" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="561.09" y="211.06" width="20.34" height="4.56" fill="url(#ca-orange)" class="bar">
				<animate attributeName="height" to="4.56" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="211.06" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="86.49" y="141.94" width="20.34" height="73.68" fill="url(#ca-blue)" class="bar">
				<animate attributeName="height" to="73.68" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="141.94" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="199.49" y="64.34" width="20.34" height="151.28" fill="url(#ca-blue)" class="bar">
				<animate attributeName="height" to="151.28" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="64.34" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="312.49" y="175.84" width="20.34" height="39.78" fill="url(#ca-blue)" class="bar">
				<animate attributeName="height" to="39.78" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="175.84" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="425.49" y="179.76" width="20.34" height="35.86" fill="url(#ca-blue)" class="bar">
				<animate attributeName="height" to="35.86" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="179.76" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="538.49" y="209.75" width="20.34" height="5.87" fill="url(#ca-blue)" class="bar">
				<animate attributeName="height" to="5.87" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="209.75" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="176.89" y="52.49" width="20.34" height="163.02" fill="url(#ca-red)" class="bar">
				<animate attributeName="height" to="163.02" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="52.49" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="63.89" y="148.46" width="20.34" height="67.16" fill="url(#ca-red)" class="bar">
				<animate attributeName="height" to="67.16" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="148.46" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="289.89" y="170.63" width="20.34" height="44.99" fill="url(#ca-red)" class="bar">
				<animate attributeName="height" to="44.99" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="170.63" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="402.89" y="183.67" width="20.34" height="31.95" fill="url(#ca-red)" class="bar">
				<animate attributeName="height" to="31.95" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="183.67" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="515.89" y="212.36" width="20.34" height="3.26" fill="url(#ca-red)" class="bar">
				<animate attributeName="height" to="3.26" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="212.36" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="41.29" y="172.58" width="20.34" height="43.04" fill="url(#ca-green)" class="bar">
				<animate attributeName="height" to="43.04" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="172.58" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="154.29" y="89.12" width="20.34" height="126.5" fill="url(#ca-green)" class="bar">
				<animate attributeName="height" to="126.5" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="89.12" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="267.29" y="161.5" width="20.34" height="54.12" fill="url(#ca-green)" class="bar">
				<animate attributeName="height" to="54.12" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="161.5" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="380.29" y="187.58" width="20.34" height="28.04" fill="url(#ca-green)" class="bar">
				<animate attributeName="height" to="28.04" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="187.58" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<rect x="493.29" y="213.01" width="20.34" height="2.61" fill="url(#ca-green)" class="bar">
				<animate attributeName="height" to="2.61" from="0" dur="2s" begin="indefinite" fill="freeze" />
				<animate attributeName="y" to="213.01" from="215.62" dur="2s" begin="indefinite" fill="freeze" />
			</rect>
			<text transform="translate(54.54 170.37) rotate(-90)" class="numbers">66</text>
			<text transform="translate(77.87 146.14) rotate(-90)" class="numbers">103</text>
			<text transform="translate(100.04 140.17) rotate(-90)" class="numbers">113</text>
			<text transform="translate(122.87 132.81) rotate(-90)" class="numbers">124</text>
			<text transform="translate(166.54 86.34) rotate(-90)" class="numbers">194</text>
			<text transform="translate(189.96 50.68) rotate(-90)" class="numbers">250</text>
			<text transform="translate(212.54 61.55) rotate(-90)" class="numbers">232</text>
			<text transform="translate(234.96 26.64) rotate(-90)" class="numbers">285</text>
			<text transform="translate(280.21 159.53) rotate(-90)" class="numbers">83</text>
			<text transform="translate(303.04 169.53) rotate(-90)" class="numbers">69</text>
			<text transform="translate(325.62 173.98) rotate(-90)" class="numbers">61</text>
			<text transform="translate(348.62 151.98) rotate(-90)" class="numbers">95</text>
			<text transform="translate(393.79 185.58) rotate(-90)" class="numbers">43</text>
			<text transform="translate(415.46 181.58) rotate(-90)" class="numbers">49</text>
			<text transform="translate(439.79 177.98) rotate(-90)" class="numbers">55</text>
			<text transform="translate(461.46 168.2) rotate(-90)" class="numbers">71</text>
			<text transform="translate(505.79 210.31) rotate(-90)" class="numbers">4</text>
			<text transform="translate(528.62 210.31) rotate(-90)" class="numbers">5</text>
			<text transform="translate(551.46 207.03) rotate(-90)" class="numbers">9</text>
			<text transform="translate(573.12 208.31) rotate(-90)" class="numbers">7</text>
			<rect x="28.54" y="253.05" width="15.17" height="15.17" fill="url(#ca-green)"/>
			<text transform="translate(50.58 263.27)" style="font-size:9px;">2013</text>
			<rect x="85.21" y="253.05" width="15.17" height="15.17" fill="url(#ca-red)"/>
			<text transform="translate(107.58 263.27)" style="font-size:9px;">2014</text>
			<rect x="140.21" y="253.05" width="15.17" height="15.17" fill="url(#ca-blue)"/>
			<text transform="translate(161.25 263.27)" style="font-size:9px;">2015</text>
			<rect x="192.87" y="253.05" width="15.17" height="15.17" fill="url(#ca-green)"/>
			<text transform="translate(214.92 263.27)" style="font-size:9px;">2016</text>
			<text transform="translate(62.66 228.08)" style="font-size:8px;">Disclosures</text>
			<text transform="translate(170.09 228.08)" style="font-size:8px;">Inventions</text>
			<text transform="translate(295.67 228.08)" style="font-size:8px;">Patent <tspan x="-9.29" y="9.6">applications</tspan></text>
			<text transform="translate(392.49 228.08)" style="font-size:8px;">U.S. licenses<tspan x="10.98" y="9.6">issued</tspan></text>
			<text transform="translate(518.87 228.08)" style="font-size:8px;">Number of<tspan x="4.93" y="9.6">startups</tspan></text>
		</svg>
		<?php
		$svg_3 = ob_get_contents();
		ob_end_clean();

		wsu_register_inline_svg( 'project-sponsor-awards', $svg_1 );
		wsu_register_inline_svg( 'royalty-revenue', $svg_2 );
		wsu_register_inline_svg( 'commercialization-activity', $svg_3 );
	}
}

add_action( 'after_setup_theme', 'WSU_Research_Theme' );
/**
 * Start things up.
 *
 * @since 0.3.0
 *
 * @return \WSU_Research_Theme
 */
function WSU_Research_Theme() {
	return WSU_Research_Theme::get_instance();
}
