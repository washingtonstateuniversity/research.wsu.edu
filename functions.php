<?php

add_action( 'wp_enqueue_scripts', 'research_enqueue_scripts');
/*
 * Enqueue custom scripting in child theme.
 */
function research_enqueue_scripts() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom-research.css' );
	$post = get_post();
	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'wsu_inline_svg' ) ) {
		wp_enqueue_script( 'animate-svg', get_stylesheet_directory_uri() . '/assets/js/animate-svg.js', array( 'jquery' ) );	}
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
	if ( is_array( $post ) && ! empty ( $post['featured_media'] ) && ! empty( $post['_links']['wp:featuredmedia'] ) ) {
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
function register_svgs() {
    ob_start();
    ?>
    <!-- project-sponsor-awards is pasted here -->
<svg class="animate svg-graph project-sponsor-award" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 430 375">
	<defs>
		<linearGradient id="psa-a" x1="184.75" y1="193.48" x2="184.75" y2="144.78" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#89b43f"/>
			<stop offset="1" stop-color="#56aa46"/>
		</linearGradient>
		<linearGradient id="psa-b" x1="299.98" y1="190.23" x2="299.98" y2="126.92" xlink:href="#psa-a"/>
		<linearGradient id="psa-c" x1="184.75" y1="193.48" x2="184.75" y2="304.69" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/><stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="psa-d" x1="299.98" y1="190.23" x2="299.98" y2="304.69" xlink:href="#psa-c"/>
		<linearGradient id="psa-e" x1="60.97" y1="51.26" x2="60.97" y2="36.09" xlink:href="#psa-a"/>
		<linearGradient id="psa-f" x1="151.64" y1="36.09" x2="151.64" y2="51.26" xlink:href="#psa-c"/>
	</defs>
	<line x1="127.13" y1="304.69" x2="357.6" y2="304.69" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="304.69" x2="127.13" y2="299.61" style="fill:none;stroke:#000;stroke-miterlimit:10"/>
	<line x1="242.36" y1="304.69" x2="242.36" y2="299.61" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="357.6" y1="304.69" x2="357.6" y2="299.61" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<text transform="translate(118.39 308.74)" style="font-size:9px;">0</text>
	<text transform="translate(72.81 268.15)" style="font-size:9px;">$50,000,000</text>
	<text transform="translate(67.66 227.56)" style="font-size:9px;">$100,000,000</text>
	<text transform="translate(67.66 186.98)" style="font-size:9px;">$150,000,000</text>
	<text transform="translate(67.66 146.39)" style="font-size:9px;">$200,000,000</text>
	<text transform="translate(67.66 105.81)" style="font-size:9px;">$250,000,000</text>
	<line x1="127.13" y1="304.69" x2="127.13" y2="101.75" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="304.69" x2="132.9" y2="304.69" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="264.1" x2="132.9" y2="264.1" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="223.51" x2="132.9" y2="223.51" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="182.93" x2="132.9" y2="182.93" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="142.34" x2="132.9" y2="142.34" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="127.13" y1="101.75" x2="132.9" y2="101.75" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<g>
		<rect x="143.27" y="144.78" width="82.97" height="48.7" style="fill:url(#psa-a)"/>
		<rect x="258.5" y="126.92" width="82.97" height="63.31" style="fill:url(#psa-b)"/>
		<rect x="143.27" y="193.48" width="82.97" height="111.21" style="fill:url(#psa-c)"/>
		<rect x="258.5" y="190.23" width="82.97" height="114.45" style="fill:url(#psa-d)"/>
	</g>
	<text transform="translate(166.23 318.84)" style="font-size:8px;">FY 2015</text>
	<text transform="translate(281.73 318.84)" style="font-size:8px;">FY 2016</text>
	<text transform="translate(150.55 211.84)" style="font-size:11px;font-family:OpenSans-Semibold;font-weight:700">$137,237,387</text>
	<text transform="translate(264.55 208.84)" style="font-size:11px;font-family:OpenSans-Semibold;font-weight:700">$140,714,791</text>
	<text transform="translate(154.29 163.84)" style="font-size:11px;font-family:OpenSans-Semibold;font-weight:700">$59,852,123</text>
	<text transform="translate(270.83 146.34)" style="font-size:11px;font-family:OpenSans-Semibold;font-weight:700">$78,454,069</text>
	<text transform="translate(150.05 130.34)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$197,089,510</text>
	<text  transform="translate(264.05 113.84)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$219,168,860</text>
	<rect x="53.39" y="36.09" width="15.17" height="15.17" style="fill:url(#psa-e)"/>
	<text transform="translate(75.59 47.01)" style="font-size:9px;">Non-federal</text><rect x="144.05" y="36.09" width="15.17" height="15.17" style="fill:url(#psa-f)"/>
	<text transform="translate(166.11 47.01)" style="font-size:9px;">Federal</text>
</svg>
<?php
    $svg_1 = ob_get_contents();
    ob_end_clean();
    ob_start();
    ?>
    <!-- royalty-revenue is pasted here -->
<svg class="animate svg-graph royalty-revenue" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 427.34 375">
	<defs>
		<linearGradient id="ra-a" x1="125.94" y1="223.09" x2="125.94" y2="305.78" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="ra-b" x1="183.56" y1="205.74" x2="183.56" y2="305.78" xlink:href="#ra-a"/>
		<linearGradient id="ra-c" x1="241.17" y1="178.34" x2="241.17" y2="305.78" xlink:href="#ra-a"/>
		<linearGradient id="ra-d" x1="298.79" y1="102.85" x2="298.79" y2="305.78" xlink:href="#ra-a"/>
	</defs>
		<line x1="97.13" y1="305.78" x2="327.6" y2="305.78" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="305.78" x2="97.13" y2="300.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="154.75" y1="305.78" x2="154.75" y2="300.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="212.36" y1="305.78" x2="212.36" y2="300.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="269.98" y1="305.78" x2="269.98" y2="300.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="327.6" y1="305.78" x2="327.6" y2="300.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<text transform="translate(88.39 309.84)" style="font-size:9px;">0</text>
		<text transform="translate(85.99 259.1)" style="font-size:9px;">.5</text>
		<text transform="translate(80.85 208.37)" style="font-size:9px;">1.0</text>
		<text transform="translate(80.85 157.64)" style="font-size:9px;">1.5</text>
		<text transform="translate(80.85 106.9)" style="font-size:9px;">2.0</text>
		<line x1="97.13" y1="305.78" x2="97.13" y2="102.85" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="305.78" x2="102.9" y2="305.78" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="255.05" x2="102.9" y2="255.05" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="204.32" x2="102.9" y2="204.32" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="153.58" x2="102.9" y2="153.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="97.13" y1="102.85" x2="102.9" y2="102.85" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<rect x="105.2" y="223.09" width="41.48" height="82.7" style="fill:url(#ra-a)"/>
		<rect x="162.82" y="205.74" width="41.48" height="100.05" style="fill:url(#ra-b)"/>
		<rect x="220.43" y="178.34" width="41.48" height="127.44" style="fill:url(#ra-c)"/>
		<rect x="278.05" y="102.85" width="41.48" height="202.93" style="fill:url(#ra-d)"/>
		<text transform="translate(114.58 319.84)" style="font-size:8px;">2013</text>
		<text transform="translate(173.08 319.84)" style="font-size:8px;">2014</text>
		<text transform="translate(231.58 319.84)" style="font-size:8px;">2015</text>
		<text transform="translate(291.08 319.84)" style="font-size:8px;">2016</text>
		<text transform="translate(113.27 219.84) rotate(-45)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$814,907</text>
		<text transform="translate(171.27 202.18) rotate(-45)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$985,785</text>
		<text transform="translate(229.08 174.37) rotate(-45)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$1,255,399</text>
		<text transform="translate(286.58 98.87) rotate(-45)" style="font-size:11px;font-family:OpenSans-Bold;font-weight:700">$1,955,051</text>
</svg>
<?php
    $svg_2 = ob_get_contents();
    ob_end_clean();
 ob_start();
    ?>
    <!-- commercialization-activity is pasted here -->
<svg class="animate svg-graph commercialization-activity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 427.34 375">
	<defs>
		<linearGradient id="ca-a" x1="114.89" y1="305.34" x2="114.89" y2="233.01" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#f47623"/>
			<stop offset="1" stop-color="#f7a51c"/>
		</linearGradient>
		<linearGradient id="ca-b" x1="181.59" y1="305.34" x2="181.59" y2="139.09" xlink:href="#ca-a"/>
		<linearGradient id="ca-c" x1="248.29" y1="305.34" x2="248.29" y2="249.93" xlink:href="#ca-a"/>
		<linearGradient id="ca-d" x1="314.99" y1="305.34" x2="314.99" y2="263.93" xlink:href="#ca-a"/>
		<linearGradient id="ca-e" x1="381.69" y1="305.34" x2="381.69" y2="301.26" xlink:href="#ca-a"/>
		<linearGradient id="ca-f" x1="101.55" y1="239.43" x2="101.55" y2="305.34" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="ca-g" x1="168.25" y1="170.01" x2="168.25" y2="305.34" xlink:href="#ca-f"/>
		<linearGradient id="ca-h" x1="234.95" y1="269.76" x2="234.95" y2="305.34" xlink:href="#ca-f"/>
		<linearGradient id="ca-i" x1="301.65" y1="273.26" x2="301.65" y2="305.34" xlink:href="#ca-f"/>
		<linearGradient id="ca-j" x1="368.35" y1="300.09" x2="368.35" y2="305.34" xlink:href="#ca-f"/>
		<linearGradient id="ca-k" x1="82.21" y1="275.3" x2="94.21" y2="275.3" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#ef395f"/>
			<stop offset="0.74" stop-color="#f04d4c"/>
		</linearGradient>
		<linearGradient id="ca-l" x1="148.91" y1="232.43" x2="160.91" y2="232.43" xlink:href="#ca-k"/>
		<linearGradient id="ca-m" x1="215.61" y1="285.22" x2="227.61" y2="285.22" xlink:href="#ca-k"/>
		<linearGradient id="ca-n" x1="282.31" y1="291.05" x2="294.31" y2="291.05" xlink:href="#ca-k"/>
		<linearGradient id="ca-o" x1="349.01" y1="303.89" x2="361.01" y2="303.89" xlink:href="#ca-k"/>
		<linearGradient id="ca-p" x1="74.87" y1="266.84" x2="74.87" y2="305.34" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#89b43f"/>
			<stop offset="1" stop-color="#56aa46"/>
		</linearGradient>
		<linearGradient id="ca-q" x1="141.57" y1="192.18" x2="141.57" y2="305.34" xlink:href="#ca-p"/>
		<linearGradient id="ca-r" x1="208.27" y1="256.93" x2="208.27" y2="305.34" xlink:href="#ca-p"/>
		<linearGradient id="ca-s" x1="274.97" y1="280.26" x2="274.97" y2="305.34" xlink:href="#ca-p"/>
		<linearGradient id="ca-t" x1="341.67" y1="303.01" x2="341.67" y2="305.34" xlink:href="#ca-p"/>
		<linearGradient id="ca-u" x1="55.28" y1="51.26" x2="55.28" y2="36.09" xlink:href="#ca-p"/>
		<linearGradient id="ca-v" x1="111.95" y1="36.09" x2="111.95" y2="51.26" xlink:href="#ca-k"/>
		<linearGradient id="ca-w" x1="166.95" y1="51.26" x2="166.95" y2="36.09" xlink:href="#ca-f"/>
		<linearGradient id="ca-x" x1="219.61" y1="51.26" x2="219.61" y2="36.09" xlink:href="#ca-a"/>
	</defs>
	<text transform="translate(72.9 320.34)" style="font-size:8px;">Disclosures</text>
	<text transform="translate(143.58 320.34)" style="font-size:8px;">Inventions</text>
	<text transform="translate(214.84 320.84)" style="font-size:8px;">Patent <tspan x="-9.29" y="9.6">applications</tspan></text>
	<text transform="translate(271.07 320.84)" style="font-size:8px;">U.S. licenses<tspan x="10.98" y="9.6">issued</tspan></text>
	<line x1="61.53" y1="305.34" x2="395.03" y2="305.34" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="305.34" x2="61.53" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="128.23" y1="305.34" x2="128.23" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="194.93" y1="305.34" x2="194.93" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="261.63" y1="305.34" x2="261.63" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="328.33" y1="305.34" x2="328.33" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="395.03" y1="305.34" x2="395.03" y2="300.97" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<text transform="translate(51.17 311.21)" style="font-size:9px;">0</text>
	<text transform="translate(46.03 282.04)" style="font-size:9px;">50</text>
	<text transform="translate(40.88 252.87)" style="font-size:9px;">100</text>
	<text transform="translate(40.88 223.71)" style="font-size:9px;">150</text>
	<text transform="translate(40.88 194.54)" style="font-size:9px;">200</text>
	<text transform="translate(40.88 165.37)" style="font-size:9px;">250</text>
	<text transform="translate(40.88 136.21)" style="font-size:9px;">300</text>
	<line x1="61.53" y1="305.34" x2="61.53" y2="130.34" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="305.34" x2="69.87" y2="305.34" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="276.18" x2="69.87" y2="276.18" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="247.01" x2="69.87" y2="247.01" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="217.84" x2="69.87" y2="217.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="188.68" x2="69.87" y2="188.68" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="159.51" x2="69.87" y2="159.51" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="61.53" y1="130.34" x2="69.87" y2="130.34" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<rect x="108.89" y="233.01" width="12.01" height="72.33" style="fill:url(#ca-a)"/>
	<rect x="175.59" y="139.09" width="12.01" height="166.25" style="fill:url(#ca-b)"/>
	<rect x="242.29" y="249.93" width="12.01" height="55.42" style="fill:url(#ca-c)"/>
	<rect x="308.99" y="263.93" width="12.01" height="41.42" style="fill:url(#ca-d)"/>
	<rect x="375.69" y="301.26" width="12.01" height="4.08" style="fill:url(#ca-e)"/>
	<rect x="95.55" y="239.43" width="12.01" height="65.92" style="fill:url(#ca-f)"/>
	<rect x="162.25" y="170.01" width="12.01" height="135.33" style="fill:url(#ca-g)"/>
	<rect x="228.95" y="269.76" width="12.01" height="35.58" style="fill:url(#ca-h)"/>
	<rect x="295.65" y="273.26" width="12.01" height="32.08" style="fill:url(#ca-i)"/>
	<rect x="362.35" y="300.09" width="12.01" height="5.25" style="fill:url(#ca-j)"/>
	<rect x="82.21" y="245.26" width="12.01" height="60.08" style="fill:url(#ca-k)"/>
	<rect x="148.91" y="159.51" width="12.01" height="145.83" style="fill:url(#ca-l)"/>
	<rect x="215.61" y="265.09" width="12.01" height="40.25" style="fill:url(#ca-m)"/>
	<rect x="282.31" y="276.76" width="12.01" height="28.58" style="fill:url(#ca-n)"/>
	<rect x="349.01" y="302.43" width="12.01" height="2.92" style="fill:url(#ca-o)"/>
	<rect x="68.87" y="266.84" width="12.01" height="38.5" style="fill:url(#ca-p)"/>
	<rect x="135.57" y="192.18" width="12.01" height="113.17" style="fill:url(#ca-q)"/>
	<rect x="202.27" y="256.93" width="12.01" height="48.42" style="fill:url(#ca-r)"/>
	<rect x="268.97" y="280.26" width="12.01" height="25.08" style="fill:url(#ca-s)"/>
	<rect x="335.67" y="303.01" width="12.01" height="2.33" style="fill:url(#ca-t)"/>
	<text transform="translate(342.7 321.34)" style="font-size:8px;">Number of<tspan x="4.93" y="9.6">startups</tspan></text>
	<text transform="translate(77.88 263.32) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">66</text>
	<text transform="translate(90.06 242.2) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">103</text>
	<text transform="translate(104.06 236.7) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">113</text>
	<text transform="translate(117.53 229.7) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">124</text>
	<text transform="translate(143.88 190.46) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">194</text>
	<text transform="translate(157.38 157.46) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">250</text>
	<text transform="translate(170.88 167.96) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">232</text>
	<text transform="translate(184.53 136.96) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">285</text>
	<text transform="translate(210.38 255.12) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">83</text>
	<text transform="translate(224.38 263.12) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">69</text>
	<text transform="translate(237.38 267.62) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">61</text>
	<text transform="translate(251.38 247.62) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">95</text>
	<text transform="translate(277.38 278.12) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">43</text>
	<text transform="translate(291.38 274.62) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">49</text>
	<text transform="translate(304.88 271.62) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">55</text>
	<text transform="translate(317.88 260.62) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">71</text>
	<text transform="translate(343.88 298.98) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">4</text>
	<text transform="translate(356.88 298.98) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">5</text>
	<text transform="translate(370.88 296.98) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">9</text>
	<text transform="translate(384.38 298.98) rotate(-90)" style="font-size:9px;font-family:OpenSans-Bold;font-weight:700">7</text>
	<rect x="47.7" y="36.09" width="15.17" height="15.17" style="fill:url(#ca-u)"/>
	<text transform="translate(69.74 48.01)" style="font-size:9px;">2013</text>
	<rect x="104.36" y="36.09" width="15.17" height="15.17" style="fill:url(#ca-v)"/>
	<text transform="translate(126.74 48.01)" style="font-size:9px;">2014</text>
	<rect x="159.36" y="36.09" width="15.17" height="15.17" style="fill:url(#ca-w)"/>
	<text transform="translate(180.41 48.01)" style="font-size:9px;">2015</text>
	<rect x="212.03" y="36.09" width="15.17" height="15.17" style="fill:url(#ca-x)"/>
	<text transform="translate(233.07 48.01)" style="font-size:9px;">2016</text>
</svg>
<?php
    $svg_3 = ob_get_contents();
    ob_end_clean();

    wsu_register_inline_svg( 'project-sponsor-awards', $svg_1 );
    wsu_register_inline_svg( 'royalty-revenue', $svg_2 );
    wsu_register_inline_svg( 'commercialization-activity', $svg_3 );
}
