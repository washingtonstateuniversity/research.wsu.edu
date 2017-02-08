<?php

add_action( 'wp_enqueue_scripts', 'research_enqueue_scripts' );
/*
 * Enqueue custom scripting in child theme.
 */
function research_enqueue_scripts() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom-research.css' );

	$post = get_post();
	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'wsu_inline_svg' ) ) {
		wp_enqueue_script( 'animate-svg', get_stylesheet_directory_uri() . '/js/animate-svg.min.js', array( 'jquery' ), false, true );
	}
}

add_filter( 'wsu_content_syndicate_host_data', 'research_filter_syndicate_host_data', 10, 2 );
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

add_action( 'wp_head', 'research_add_meta_tags' );
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

add_action( 'wsu_register_inline_svg', 'register_svgs' );
/**
 * Register SVG data for the WSU Inline SVG plugin.
 */
function register_svgs() {
	// Sponsored project awards
	ob_start();
	?>
	<svg class="animate svg-graph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 270">
		<defs>
			<linearGradient id="spa-a" x1="121.27" y1="104.82" x2="121.27" y2="56.11" gradientUnits="userSpaceOnUse">
				<stop offset="0" stop-color="#89b43f"/>
				<stop offset="1" stop-color="#56aa46"/>
			</linearGradient>
			<linearGradient id="spa-b" x1="236.5" y1="101.57" x2="236.5" y2="38.26" xlink:href="#spa-a"/>
			<linearGradient id="spa-c" x1="121.27" y1="104.82" x2="121.27" y2="216.02" gradientUnits="userSpaceOnUse">
				<stop offset="0" stop-color="#00a5bd"/>
				<stop offset="1" stop-color="#1b9e85"/>
			</linearGradient>
			<linearGradient id="spa-d" x1="236.5" y1="101.57" x2="236.5" y2="216.02" xlink:href="#spa-c"/>
			<linearGradient id="spa-e" x1="71.42" y1="267.58" x2="71.42" y2="252.42" xlink:href="#spa-a"/>
			<linearGradient id="spa-f" x1="162.08" y1="252.42" x2="162.08" y2="267.58" xlink:href="#spa-c"/>
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
		<rect x="79.79" y="56.11" width="82.97" height="48.7" style="fill:url(#spa-a)">
			<animate attributeName="height" to="48.7" from="0" dur="2s" begin="indefinite" fill=”freeze” />
			<animate attributeName="y" to="56.11" from="112.22" dur="2s" begin="indefinite" fill=”freeze” />
		</rect>
		<rect x="195.02" y="38.26" width="82.97" height="63.31" style="fill:url(#spa-b)">
			<animate attributeName="height" to="63.31" from="0" dur="2s" begin="indefinite" fill=”freeze” />
			<animate attributeName="y" to="38.26" from="76.52" dur="2s" begin="indefinite" fill=”freeze” />
		</rect>
		<rect x="79.79" y="104.82" width="82.97" height="111.21" style="fill:url(#spa-c)">
			<animate attributeName="height" to="111.21" from="0" dur="2s" begin="indefinite" fill=”freeze” />
			<animate attributeName="y" to="104.82" from="209.64" dur="2s" begin="indefinite" fill=”freeze” />
		</rect>
		<rect x="195.02" y="101.57" width="82.97" height="114.45" style="fill:url(#spa-d)">
			<animate attributeName="height" to="114.45" from="0" dur="2s" begin="indefinite" fill=”freeze” />
			<animate attributeName="y" to="101.57" from="203.14" dur="2s" begin="indefinite" fill=”freeze” />
		</rect>
		<text transform="translate(103.52 228.08)" style="font-size:8px;">FY 2015</text>
		<text transform="translate(219.02 228.08)" style="font-size:8px;">FY 2016</text>
		<text transform="translate(87.84 123.34)" style="font-size:11px;font-weight:700">$137,237,387</text>
		<text transform="translate(201.84 119.37)" style="font-size:11px;font-weight:700">$140,714,791</text>
		<text transform="translate(91.57 74.4)" style="font-size:11px;font-weight:700">$59,852,123</text>
		<text transform="translate(205.19 55.84)" style="font-size:11px;font-weight:700">$78,454,069</text>
		<text transform="translate(87.33 49.61)" style="font-size:11px;font-weight:700">$197,089,510</text>
		<text transform="translate(201.33 32.01)" style="font-size:11px;font-weight:700">$219,168,860</text>
		<rect x="63.83" y="252.42" width="15.17" height="15.17" style="fill:url(#spa-e)"/>
		<text transform="translate(85.04 262.64)" style="font-size:9px;">Non-federal</text>
		<rect x="154.5" y="252.42" width="15.17" height="15.17" style="fill:url(#spa-f)"/>
		<text transform="translate(175.56 262.64)" style="font-size:9px;">Federal</text>
	</svg>
	<?php
	$svg_1 = ob_get_contents();
	ob_end_clean();

	// Royalty revenue
	ob_start();
	?>
	<svg class="animate svg-graph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 270">
		<defs>
			<linearGradient id="rr-a" x1="71.23" y1="173.34" x2="71.23" y2="256.03" gradientUnits="userSpaceOnUse">
				<stop offset="0" stop-color="#00a5bd"/>
				<stop offset="1" stop-color="#1b9e85"/>
			</linearGradient>
			<linearGradient id="rr-b" x1="128.85" y1="155.99" x2="128.85" y2="256.03" xlink:href="#rr-a"/>
			<linearGradient id="rr-c" x1="186.46" y1="128.59" x2="186.46" y2="256.03" xlink:href="#rr-a"/>
			<linearGradient id="rr-d" x1="244.08" y1="53.1" x2="244.08" y2="256.03" xlink:href="#rr-a"/>
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
		<rect x="50.49" y="173.34" width="41.48" height="82.7" style="fill:url(#rr-a)"/>
		<rect x="108.11" y="155.99" width="41.48" height="100.05" style="fill:url(#rr-b)"/>
		<rect x="165.72" y="128.59" width="41.48" height="127.44" style="fill:url(#rr-c)"/>
		<rect x="223.34" y="53.1" width="41.48" height="202.93" style="fill:url(#rr-d)"/>
		<text transform="translate(59.87 266.54)" style="font-size:8px;">2013</text>
		<text transform="translate(118.37 266.54)" style="font-size:8px;">2014</text>
		<text transform="translate(176.87 266.54)" style="font-size:8px;">2015</text>
		<text transform="translate(236.37 266.54)" style="font-size:8px;">2016</text>
		<text transform="translate(55.91 169.09) rotate(-45)" style="font-size:10.950329780578613px;font-weight:700">$814,907</text>
		<text transform="translate(113.23 151.63) rotate(-45)" style="font-size:11px;font-weight:700">$985,785</text>
		<text transform="translate(170.04 124.16) rotate(-45)" style="font-size:11px;font-weight:700">$1,255,399</text>
		<text transform="translate(231.87 48.12) rotate(-45)" style="font-size:11px;font-weight:700">$1,955,051</text>
	</svg>
	<?php
	$svg_2 = ob_get_contents();
	ob_end_clean();

	// Commercialization activity
	ob_start();
	?>
<svg class="animate svg-graph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 600 270">
	<defs>
			<linearGradient id="ca-a" x1="109.09" y1="175.19" x2="129.43" y2="175.19" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f47623"/>
			<stop offset="1" stop-color="#f7a51c"/>
		</linearGradient>
		<linearGradient id="ca-b" x1="222.09" y1="122.7" x2="242.43" y2="122.7" xlink:href="#ca-a"/>
		<linearGradient id="ca-c" x1="335.09" y1="184.65" x2="355.43" y2="184.65" xlink:href="#ca-a"/>
		<linearGradient id="ca-d" x1="448.09" y1="192.47" x2="468.43" y2="192.47" xlink:href="#ca-a"/>
		<linearGradient id="ca-e" x1="561.09" y1="213.34" x2="581.43" y2="213.34" xlink:href="#ca-a"/>
		<linearGradient id="ca-f" x1="86.49" y1="178.78" x2="106.83" y2="178.78" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="ca-g" x1="199.49" y1="139.98" x2="219.83" y2="139.98" xlink:href="#ca-f"/>
		<linearGradient id="ca-h" x1="312.49" y1="195.73" x2="332.83" y2="195.73" xlink:href="#ca-f"/>
		<linearGradient id="ca-i" x1="425.49" y1="197.69" x2="445.83" y2="197.69" xlink:href="#ca-f"/>
		<linearGradient id="ca-j" x1="538.49" y1="212.69" x2="558.83" y2="212.69" xlink:href="#ca-f"/>
		<linearGradient id="ca-k" x1="176.89" y1="134" x2="197.23" y2="134" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#ef395f"/>
			<stop offset="0.74" stop-color="#f04d4c"/>
		</linearGradient>
		<linearGradient id="ca-l" x1="63.89" y1="182.04" x2="84.23" y2="182.04" xlink:href="#ca-k"/>
		<linearGradient id="ca-m" x1="289.89" y1="193.12" x2="310.23" y2="193.12" xlink:href="#ca-k"/>
		<linearGradient id="ca-n" x1="402.89" y1="199.65" x2="423.23" y2="199.65" xlink:href="#ca-k"/>
		<linearGradient id="ca-o" x1="515.89" y1="213.99" x2="536.23" y2="213.99" xlink:href="#ca-k"/>
		<linearGradient id="ca-p" x1="41.29" y1="194.1" x2="61.63" y2="194.1" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#89b43f"/>
			<stop offset="1" stop-color="#56aa46"/>
		</linearGradient>
		<linearGradient id="ca-q" x1="154.29" y1="152.37" x2="174.63" y2="152.37" xlink:href="#ca-p"/>
		<linearGradient id="ca-r" x1="267.29" y1="188.56" x2="287.63" y2="188.56" xlink:href="#ca-p"/>
		<linearGradient id="ca-s" x1="380.29" y1="201.6" x2="400.63" y2="201.6" xlink:href="#ca-p"/>
		<linearGradient id="ca-t" x1="493.29" y1="214.32" x2="513.63" y2="214.32" xlink:href="#ca-p"/>
		<linearGradient id="ca-u" x1="36.12" y1="268.22" x2="36.12" y2="253.05" xlink:href="#ca-p"/>
		<linearGradient id="ca-v" x1="92.79" y1="253.05" x2="92.79" y2="268.22" xlink:href="#ca-k"/>
		<linearGradient id="ca-w" x1="147.79" y1="268.22" x2="147.79" y2="253.05" xlink:href="#ca-f"/>
		<linearGradient id="ca-x" x1="200.46" y1="268.22" x2="200.46" y2="253.05" xlink:href="#ca-a"/>
	</defs>
	<title>Commercialization activity</title>
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
	<rect x="109.09" y="134.76" width="20.34" height="80.86" style="fill:url(#ca-a)"/>
	<rect x="222.09" y="29.78" width="20.34" height="185.84" style="fill:url(#ca-b)"/>
	<rect x="335.09" y="153.67" width="20.34" height="61.95" style="fill:url(#ca-c)"/>
	<rect x="448.09" y="169.32" width="20.34" height="46.3" style="fill:url(#ca-d)"/>
	<rect x="561.09" y="211.06" width="20.34" height="4.56" style="fill:url(#ca-e)"/>
	<rect x="86.49" y="141.94" width="20.34" height="73.68" style="fill:url(#ca-f)"/>
	<rect x="199.49" y="64.34" width="20.34" height="151.28" style="fill:url(#ca-g)"/>
	<rect x="312.49" y="175.84" width="20.34" height="39.78" style="fill:url(#ca-h)"/>
	<rect x="425.49" y="179.76" width="20.34" height="35.86" style="fill:url(#ca-i)"/>
	<rect x="538.49" y="209.75" width="20.34" height="5.87" style="fill:url(#ca-j)"/>
	<rect x="176.89" y="52.49" width="20.34" height="163.02" style="fill:url(#ca-k)"/>
	<rect x="63.89" y="148.46" width="20.34" height="67.16" style="fill:url(#ca-l)"/>
	<rect x="289.89" y="170.63" width="20.34" height="44.99" style="fill:url(#ca-m)"/>
	<rect x="402.89" y="183.67" width="20.34" height="31.95" style="fill:url(#ca-n)"/>
	<rect x="515.89" y="212.36" width="20.34" height="3.26" style="fill:url(#ca-o)"/>
	<rect x="41.29" y="172.58" width="20.34" height="43.04" style="fill:url(#ca-p)"/>
	<rect x="154.29" y="89.12" width="20.34" height="126.5" style="fill:url(#ca-q)"/>
	<rect x="267.29" y="161.5" width="20.34" height="54.12" style="fill:url(#ca-r)"/>
	<rect x="380.29" y="187.58" width="20.34" height="28.04" style="fill:url(#ca-s)"/>
	<rect x="493.29" y="213.01" width="20.34" height="2.61" style="fill:url(#ca-t)"/>
	<text transform="translate(54.54 170.37) rotate(-90)" style="font-size:11px;font-weight:700">66</text>
	<text transform="translate(77.87 146.14) rotate(-90)" style="font-size:11px;font-weight:700">103</text>
	<text transform="translate(100.04 140.17) rotate(-90)" style="font-size:11px;font-weight:700">113</text>
	<text transform="translate(122.87 132.81) rotate(-90)" style="font-size:11px;font-weight:700">124</text>
	<text transform="translate(166.54 86.34) rotate(-90)" style="font-size:11px;font-weight:700">194</text>
	<text transform="translate(189.96 50.68) rotate(-90)" style="font-size:11px;font-weight:700">250</text>
	<text transform="translate(212.54 61.55) rotate(-90)" style="font-size:11px;font-weight:700">232</text>
	<text transform="translate(234.96 26.64) rotate(-90)" style="font-size:11px;font-weight:700">285</text>
	<text transform="translate(280.21 159.53) rotate(-90)" style="font-size:11px;font-weight:700">85</text>
	<text transform="translate(303.04 169.53) rotate(-90)" style="font-size:11px;font-weight:700">69</text>
	<text transform="translate(325.62 173.98) rotate(-90)" style="font-size:11px;font-weight:700">61</text>
	<text transform="translate(348.62 151.98) rotate(-90)" style="font-size:11px;font-weight:700">95</text>
	<text transform="translate(393.79 185.58) rotate(-90)" style="font-size:11px;font-weight:700">43</text>
	<text transform="translate(415.46 181.58) rotate(-90)" style="font-size:11px;font-weight:700">49</text>
	<text transform="translate(439.79 177.98) rotate(-90)" style="font-size:11px;font-weight:700">55</text>
	<text transform="translate(461.46 168.2) rotate(-90)" style="font-size:11px;font-weight:700">71</text>
	<text transform="translate(505.79 210.31) rotate(-90)" style="font-size:11px;font-weight:700">4</text>
	<text transform="translate(528.62 210.31) rotate(-90)" style="font-size:11px;font-weight:700">5</text>
	<text transform="translate(551.46 207.03) rotate(-90)" style="font-size:11px;font-weight:700">9</text>
	<text transform="translate(573.12 208.31) rotate(-90)" style="font-size:11px;font-weight:700">7</text>
	<rect x="28.54" y="253.05" width="15.17" height="15.17" style="fill:url(#ca-u)"/>
	<text transform="translate(50.58 263.27)" style="font-size:9px;">2013</text>
	<rect x="85.21" y="253.05" width="15.17" height="15.17" style="fill:url(#ca-v)"/>
	<text transform="translate(107.58 263.27)" style="font-size:9px;">2014</text>
	<rect x="140.21" y="253.05" width="15.17" height="15.17" style="fill:url(#ca-w)"/>
	<text transform="translate(161.25 263.27)" style="font-size:9px;">2015</text>
	<rect x="192.87" y="253.05" width="15.17" height="15.17" style="fill:url(#ca-x)"/>
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
