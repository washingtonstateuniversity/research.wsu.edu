<?php

add_action( 'wp_enqueue_scripts', 'research_enqueue_scripts');
/*
 * Enqueue custom scripting in child theme.
 */
function research_enqueue_scripts() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom-research.css' );
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
/**
 * Register SVG data for the WSU Inline SVG plugin.
 */
function register_svgs() {
    ob_start();
    ?>
    <!-- project-sponsor-awards is pasted here -->
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
	<rect x="79.79" y="56.11" width="82.97" height="48.7" style="fill:url(#spa-a)"/>
	<rect x="195.02" y="38.26" width="82.97" height="63.31" style="fill:url(#spa-b)"/>
	<rect x="79.79" y="104.82" width="82.97" height="111.21" style="fill:url(#spa-c)"/>
	<rect x="195.02" y="101.57" width="82.97" height="114.45" style="fill:url(#spa-d)"/>
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
    ob_start();
    ?>
    <!-- royalty-revenue is pasted here -->
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
 ob_start();
    ?>
    <!-- commercialization-activity is pasted here -->
<svg class="animate svg-graph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 370 270">
	<defs>
		<linearGradient id="ca-a" x1="93.82" y1="200.77" x2="93.82" y2="128.43" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#f47623"/>
			<stop offset="1" stop-color="#f7a51c"/>
		</linearGradient>
		<linearGradient id="ca-b" x1="177.19" y1="200.77" x2="177.19" y2="34.52" xlink:href="#ca-a"/>
		<linearGradient id="ca-c" x1="260.57" y1="200.77" x2="260.57" y2="145.35" xlink:href="#ca-a"/>
		<linearGradient id="ca-d" x1="343.94" y1="200.77" x2="343.94" y2="159.35" xlink:href="#ca-a"/>
		<linearGradient id="ca-e" x1="77.14" y1="134.85" x2="77.14" y2="200.77" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="ca-f" x1="160.52" y1="65.43" x2="160.52" y2="200.77" xlink:href="#ca-e"/>
		<linearGradient id="ca-g" x1="243.89" y1="165.18" x2="243.89" y2="200.77" xlink:href="#ca-e"/>
		<linearGradient id="ca-h" x1="327.27" y1="168.68" x2="327.27" y2="200.77" xlink:href="#ca-e"/>
		<linearGradient id="ca-i" x1="52.97" y1="170.72" x2="67.97" y2="170.72" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#ef395f"/>
			<stop offset="0.74" stop-color="#f04d4c"/>
		</linearGradient>
		<linearGradient id="ca-j" x1="136.34" y1="127.85" x2="151.35" y2="127.85" xlink:href="#ca-i"/>
		<linearGradient id="ca-k" x1="219.72" y1="180.64" x2="234.72" y2="180.64" xlink:href="#ca-i"/>
		<linearGradient id="ca-l" x1="303.09" y1="186.47" x2="318.1" y2="186.47" xlink:href="#ca-i"/>
		<linearGradient id="ca-m" x1="43.79" y1="162.27" x2="43.79" y2="200.77" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#89b43f"/>
			<stop offset="1" stop-color="#56aa46"/>
		</linearGradient>
		<linearGradient id="ca-n" x1="127.17" y1="87.6" x2="127.17" y2="200.77" xlink:href="#ca-m"/>
		<linearGradient id="ca-o" x1="210.54" y1="152.35" x2="210.54" y2="200.77" xlink:href="#ca-m"/>
		<linearGradient id="ca-p" x1="293.92" y1="175.68" x2="293.92" y2="200.77" xlink:href="#ca-m"/>
		<linearGradient id="ca-q" x1="34.51" y1="267.58" x2="34.51" y2="252.42" xlink:href="#ca-m"/>
		<linearGradient id="ca-r" x1="91.18" y1="252.42" x2="91.18" y2="267.58" xlink:href="#ca-i"/>
		<linearGradient id="ca-s" x1="146.18" y1="267.58" x2="146.18" y2="252.42" xlink:href="#ca-e"/>
		<linearGradient id="ca-t" x1="198.85" y1="267.58" x2="198.85" y2="252.42" xlink:href="#ca-a"/>
	</defs>
	<title>Commercialization activity</title>
	<text transform="translate(49.15 215.26)" style="font-size:8px;">Disclosures</text>
	<text transform="translate(132.5 215.26)" style="font-size:8px;">Inventions</text>
	<text transform="translate(229.73 215.27)" style="font-size:8px;">Patent <tspan x="-9.29" y="9.6">applications</tspan></text>
	<text transform="translate(298.66 215.76)" style="font-size:8px;">U.S. licenses<tspan x="10.98" y="9.6">issued</tspan></text>
	<line x1="27.12" y1="200.77" x2="360.62" y2="200.77" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="200.77" x2="27.12" y2="196.39" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="110.49" y1="200.77" x2="110.49" y2="196.39" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="193.87" y1="200.77" x2="193.87" y2="196.39" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="277.24" y1="200.77" x2="277.24" y2="196.39" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="360.62" y1="200.77" x2="360.62" y2="196.39" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<text transform="translate(16.76 206.63)" style="font-size:9px;">0</text>
	<text transform="translate(11.62 177.46)" style="font-size:9px;">50</text>
	<text transform="translate(6.47 148.29)" style="font-size:9px;">100</text>
	<text transform="translate(6.47 119.13)" style="font-size:9px;">150</text>
	<text transform="translate(6.47 89.96)" style="font-size:9px;">200</text>
	<text transform="translate(6.47 60.79)" style="font-size:9px;">250</text>
	<text transform="translate(6.47 31.63)" style="font-size:9px;">300</text>
	<line x1="27.12" y1="200.77" x2="27.12" y2="25.77" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="200.77" x2="35.46" y2="200.77" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="171.6" x2="35.46" y2="171.6" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="142.43" x2="35.46" y2="142.43" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="113.27" x2="35.46" y2="113.27" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="84.1" x2="35.46" y2="84.1" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="54.93" x2="35.46" y2="54.93" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="27.12" y1="25.77" x2="35.46" y2="25.77" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<rect x="86.32" y="128.43" width="15.01" height="72.33" style="fill:url(#ca-a)"/>
	<rect x="169.69" y="34.52" width="15.01" height="166.25" style="fill:url(#ca-b)"/>
	<rect x="253.07" y="145.35" width="15.01" height="55.42" style="fill:url(#ca-c)"/>
	<rect x="336.44" y="159.35" width="15.01" height="41.42" style="fill:url(#ca-d)"/>
	<rect x="69.64" y="134.85" width="15.01" height="65.92" style="fill:url(#ca-e)"/>
	<rect x="153.02" y="65.43" width="15.01" height="135.33" style="fill:url(#ca-f)"/>
	<rect x="236.39" y="165.18" width="15.01" height="35.58" style="fill:url(#ca-g)"/>
	<rect x="319.77" y="168.68" width="15.01" height="32.08" style="fill:url(#ca-h)"/>
	<rect x="52.97" y="140.68" width="15.01" height="60.08" style="fill:url(#ca-i)"/>
	<rect x="136.34" y="54.93" width="15.01" height="145.83" style="fill:url(#ca-j)"/>
	<rect x="219.72" y="160.52" width="15.01" height="40.25" style="fill:url(#ca-k)"/>
	<rect x="303.09" y="172.18" width="15.01" height="28.58" style="fill:url(#ca-l)"/>
	<rect x="36.29" y="162.27" width="15.01" height="38.5" style="fill:url(#ca-m)"/>
	<rect x="119.67" y="87.6" width="15.01" height="113.17" style="fill:url(#ca-n)"/>
	<rect x="203.04" y="152.35" width="15.01" height="48.42" style="fill:url(#ca-o)"/>
	<rect x="286.42" y="175.68" width="15.01" height="25.08" style="fill:url(#ca-p)"/>
	<text transform="translate(46.09 158.78) rotate(-90)" style="font-size:9px;font-weight:700">66</text>
	<text transform="translate(61.61 138.66) rotate(-90)" style="font-size:9px;font-weight:700">103</text>
	<text transform="translate(79.61 133.16) rotate(-90)" style="font-size:9px;font-weight:700">113</text>
	<text transform="translate(97.08 126.16) rotate(-90)" style="font-size:9px;font-weight:700">124</text>
	<text transform="translate(129.84 85.91) rotate(-90)" style="font-size:9px;font-weight:700">194</text>
	<text transform="translate(146.26 52.84) rotate(-90)" style="font-size:9px;font-weight:700">250</text>
	<text transform="translate(163.42 63.34) rotate(-90)" style="font-size:9px;font-weight:700">232</text>
	<text transform="translate(179.41 32.75) rotate(-90)" style="font-size:9px;font-weight:700">285</text>
	<text transform="translate(212.92 149.58) rotate(-90)" style="font-size:9px;font-weight:700">83</text>
	<text transform="translate(229.92 157.24) rotate(-90)" style="font-size:9px;font-weight:700">69</text>
	<text transform="translate(246.26 162.08) rotate(-90)" style="font-size:9px;font-weight:700">61</text>
	<text transform="translate(262.92 142.08) rotate(-90)" style="font-size:9px;font-weight:700">95</text>
	<text transform="translate(296.49 172.08) rotate(-90)" style="font-size:9px;font-weight:700">43</text>
	<text transform="translate(313.48 169.08) rotate(-90)" style="font-size:9px;font-weight:700">49</text>
	<text transform="translate(330.42 165.08) rotate(-90)" style="font-size:9px;font-weight:700">55</text>
	<text transform="translate(347.42 156.08) rotate(-90)" style="font-size:9px;font-weight:700">71</text>
	<rect x="26.93" y="252.42" width="15.17" height="15.17" style="fill:url(#ca-q)"/>
	<text transform="translate(48.97 262.64)" style="font-size:9px;">2013</text>
	<rect x="83.6" y="252.42" width="15.17" height="15.17" style="fill:url(#ca-r)"/>
	<text transform="translate(105.97 262.64)" style="font-size:9px;">2014</text>
	<rect x="138.6" y="252.42" width="15.17" height="15.17" style="fill:url(#ca-s)"/>
	<text transform="translate(159.64 262.64)" style="font-size:9px;">2015</text>
	<rect x="191.26" y="252.42" width="15.17" height="15.17" style="fill:url(#ca-t)"/>
	<text transform="translate(212.3 262.64)" style="font-size:9px;">2016</text>
</svg>
<?php
    $svg_3 = ob_get_contents();
    ob_end_clean();

    wsu_register_inline_svg( 'project-sponsor-awards', $svg_1 );
    wsu_register_inline_svg( 'royalty-revenue', $svg_2 );
    wsu_register_inline_svg( 'commercialization-activity', $svg_3 );
}
