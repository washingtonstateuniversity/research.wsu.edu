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
<svg class="animate svg-graph royalty-revenue" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294.67 260.17">
	<defs>
		<linearGradient id="cla-a" x1="118.6" y1="99.9" x2="118.6" y2="51.2" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#89b43f"/>
			<stop offset="1" stop-color="#56aa46"/>
		</linearGradient>
		<linearGradient id="cla-b" x1="233.83" y1="96.65" x2="233.83" y2="33.34" xlink:href="#cla-a"/>
		<linearGradient id="cla-c" x1="118.6" y1="99.9" x2="118.6" y2="211.11" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="cla-d" x1="233.83" y1="96.65" x2="233.83" y2="211.11" xlink:href="#cla-c"/>
		<linearGradient id="cla-e" x1="68.75" y1="254.83" x2="68.75" y2="239.67" xlink:href="#cla-a"/>
		<linearGradient id="cla-f" x1="159.42" y1="239.67" x2="159.42" y2="254.83" xlink:href="#cla-c"/>
	</defs>
	<title>Sponsored project awards received</title>
	<line x1="60.99" y1="211.11" x2="291.45" y2="211.11" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="211.11" x2="60.99" y2="206.03" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="176.22" y1="211.11" x2="176.22" y2="206.03" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="291.45" y1="211.11" x2="291.45" y2="206.03" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<text transform="translate(52.24 215.16)" style="font-size:9px;">0</text>
	<text transform="translate(6.66 174.57)" style="font-size:9px;">$50,000,000</text>
	<text transform="translate(1.51 133.99)" style="font-size:9px;">$100,000,000</text>
	<text transform="translate(1.51 93.4)" style="font-size:9px;">$150,000,000</text>
	<text transform="translate(1.51 52.81)" style="font-size:9px;">$200,000,000</text>
	<text transform="translate(1.51 12.23)" style="font-size:9px;">$250,000,000</text>
	<line x1="60.99" y1="211.11" x2="60.99" y2="8.18" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="211.11" x2="66.75" y2="211.11" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="170.52" x2="66.75" y2="170.52" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="129.93" x2="66.75" y2="129.93" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="89.35" x2="66.75" y2="89.35" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
		<line x1="60.99" y1="48.76" x2="66.75" y2="48.76" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="60.99" y1="8.18" x2="66.75" y2="8.18" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<rect x="77.12" y="51.2" width="82.97" height="48.7" style="fill:url(#cla-a)"/><rect x="192.35" y="33.34" width="82.97" height="63.31" style="fill:url(#cla-b)"/>
	<rect x="77.12" y="99.9" width="82.97" height="111.21" style="fill:url(#cla-c)"/><rect x="192.35" y="96.65" width="82.97" height="114.45" style="fill:url(#cla-d)"/>
	<text transform="translate(100.85 223.17)" style="font-size:8px;">FY 2015</text>
	<text transform="translate(216.35 223.17)" style="font-size:8px;">FY 2016</text>
	<text transform="translate(85.17 118.43)" style="font-size:11px;font-weight:700">$137,237,387</text>
	<text transform="translate(199.17 114.45)" style="font-size:11px;font-weight:700">$140,714,791</text>
	<text transform="translate(88.9 69.48)" style="font-size:11px;font-weight:700">$59,852,123</text>
	<text transform="translate(202.53 50.93)" style="font-size:11px;font-weight:700">$78,454,069</text>
	<text transform="translate(84.66 44.69)" style="font-size:11px;font-weight:700">$197,089,510</text>
	<text transform="translate(198.66 27.1)" style="font-size:11px;font-weight:700">$219,168,860</text>
	<rect x="61.17" y="239.67" width="15.17" height="15.17" style="fill:url(#cla-e)"/>
	<text transform="translate(82.37 250.58)" style="font-size:9px;">Non-federal</text>		<rect x="151.83" y="239.67" width="15.17" height="15.17" style="fill:url(#cla-f)"/>
	<text transform="translate(172.89 250.58)" style="font-size:9px;">Federal</text>
</svg>
<?php
    $svg_1 = ob_get_contents();
    ob_end_clean();
    ob_start();
    ?>
    <!-- royalty-revenue is pasted here -->
<svg class="animate svg-graph royalty-revenue" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 254.67 269.75">
	<defs>
		<linearGradient id="ra-a" x1="48.57" y1="173.21" x2="48.57" y2="255.91" gradientUnits="userSpaceOnUse">
			<stop offset="0" stop-color="#00a5bd"/>
			<stop offset="1" stop-color="#1b9e85"/>
		</linearGradient>
		<linearGradient id="ra-b" x1="106.18" y1="155.86" x2="106.18" y2="255.91" xlink:href="#ra-a"/><linearGradient id="ra-c" x1="163.8" y1="128.47" x2="163.8" y2="255.91" xlink:href="#ra-a"/>
		<linearGradient id="ra-d" x1="221.41" y1="52.98" x2="221.41" y2="255.91" xlink:href="#ra-a"/>
	</defs>
	<title>Royalty revenue</title>
	<line x1="19.76" y1="255.91" x2="250.22" y2="255.91" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="255.91" x2="19.76" y2="250.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="77.37" y1="255.91" x2="77.37" y2="250.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="134.99" y1="255.91" x2="134.99" y2="250.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="192.6" y1="255.91" x2="192.6" y2="250.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="250.22" y1="255.91" x2="250.22" y2="250.84" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<text transform="translate(11.01 259.96)" style="font-size:9px;">0</text>
	<text transform="translate(8.62 209.23)" style="font-size:9px;">.5</text>
	<text transform="translate(3.47 158.49)" style="font-size:9px;">1.0</text>
	<text transform="translate(3.47 107.76)" style="font-size:9px;">1.5</text>
	<text transform="translate(3.47 57.03)" style="font-size:9px;">2.0</text>
	<line x1="19.76" y1="255.91" x2="19.76" y2="52.98" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="255.91" x2="25.52" y2="255.91" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="205.18" x2="25.52" y2="205.18" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="154.44" x2="25.52" y2="154.44" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="103.71" x2="25.52" y2="103.71" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<line x1="19.76" y1="52.98" x2="25.52" y2="52.98" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
	<rect x="27.83" y="173.21" width="41.48" height="82.7" style="fill:url(#ra-a)"/>
	<rect x="85.44" y="155.86" width="41.48" height="100.05" style="fill:url(#ra-b)"/>
	<rect x="143.06" y="128.47" width="41.48" height="127.44" style="fill:url(#ra-c)"/>
	<rect x="200.67" y="52.98" width="41.48" height="202.93" style="fill:url(#ra-d)"/>
	<text transform="translate(37.2 266.42)" style="font-size:8px;">2013</text>
	<text transform="translate(95.7 266.42)" style="font-size:8px;">2014</text>
	<text transform="translate(154.2 266.42)" style="font-size:8px;">2015</text>
	<text transform="translate(213.7 266.42)" style="font-size:8px;">2016</text>
	<text transform="translate(33.2 170.93) rotate(-45)" style="font-size:11px;font-weight:700">$814,907</text>
	<text transform="translate(90.56 152.5) rotate(-45)" style="font-size:11px;font-weight:700">$985,785</text>
	<text transform="translate(147.37 125.03) rotate(-45)" style="font-size:11px;font-weight:700">$1,255,399</text>
	<text transform="translate(209.2 49) rotate(-45)" style="font-size:11px;font-weight:700">$1,955,051</text>
</svg>
<?php
    $svg_2 = ob_get_contents();
    ob_end_clean();
 ob_start();
    ?>
    <!-- commercialization-activity is pasted here -->
		<svg class="animate svg-graph commercialization-activity" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 370 258.38">
			<defs>
				<linearGradient id="a" x1="93.82" y1="194.95" x2="93.82" y2="122.62" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#f47623"/>
					<stop offset="1" stop-color="#f7a51c"/>
				</linearGradient>
				<linearGradient id="b" x1="177.19" y1="194.95" x2="177.19" y2="28.7" xlink:href="#a"/>
				<linearGradient id="c" x1="260.57" y1="194.95" x2="260.57" y2="139.54" xlink:href="#a"/>
				<linearGradient id="d" x1="343.94" y1="194.95" x2="343.94" y2="153.54" xlink:href="#a"/>
				<linearGradient id="e" x1="77.14" y1="129.04" x2="77.14" y2="194.95" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#00a5bd"/>
					<stop offset="1" stop-color="#1b9e85"/>
				</linearGradient>
				<linearGradient id="f" x1="160.52" y1="59.62" x2="160.52" y2="194.95" xlink:href="#e"/>
				<linearGradient id="g" x1="243.89" y1="159.37" x2="243.89" y2="194.95" xlink:href="#e"/>
				<linearGradient id="h" x1="327.27" y1="162.87" x2="327.27" y2="194.95" xlink:href="#e"/>
				<linearGradient id="i" x1="52.97" y1="164.91" x2="67.97" y2="164.91" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#ef395f"/>
					<stop offset="0.74" stop-color="#f04d4c"/>
				</linearGradient>
				<linearGradient id="j" x1="136.34" y1="122.04" x2="151.35" y2="122.04" xlink:href="#i"/>
				<linearGradient id="k" x1="219.72" y1="174.83" x2="234.72" y2="174.83" xlink:href="#i"/>
				<linearGradient id="l" x1="303.09" y1="180.66" x2="318.1" y2="180.66" xlink:href="#i"/>
				<linearGradient id="m" x1="43.79" y1="156.45" x2="43.79" y2="194.95" gradientUnits="userSpaceOnUse">
					<stop offset="0" stop-color="#89b43f"/>
					<stop offset="1" stop-color="#56aa46"/>
				</linearGradient>
				<linearGradient id="n" x1="127.17" y1="81.79" x2="127.17" y2="194.95" xlink:href="#m"/>
				<linearGradient id="o" x1="210.54" y1="146.54" x2="210.54" y2="194.95" xlink:href="#m"/>
				<linearGradient id="p" x1="293.92" y1="169.87" x2="293.92" y2="194.95" xlink:href="#m"/>
				<linearGradient id="q" x1="34.51" y1="251.54" x2="34.51" y2="236.38" xlink:href="#m"/>
				<linearGradient id="r" x1="91.18" y1="236.38" x2="91.18" y2="251.54" xlink:href="#i"/>
				<linearGradient id="s" x1="146.18" y1="251.54" x2="146.18" y2="236.38" xlink:href="#e"/>
				<linearGradient id="t" x1="198.85" y1="251.54" x2="198.85" y2="236.38" xlink:href="#a"/>
			</defs>
			<title>Commercialization activity</title>
			<text transform="translate(49.15 209.45)" style="font-size:8px;">Disclosures</text>
			<text transform="translate(132.5 209.45)" style="font-size:8px;">Inventions</text>
			<text transform="translate(229.73 209.45)" style="font-size:8px;">Patent <tspan x="-9.29" y="9.6">applications</tspan></text>
			<text transform="translate(298.66 209.95)" style="font-size:8px;">U.S. licenses<tspan x="10.98" y="9.6">issued</tspan></text>
			<line x1="27.12" y1="194.95" x2="360.62" y2="194.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="194.95" x2="27.12" y2="190.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="110.49" y1="194.95" x2="110.49" y2="190.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="193.87" y1="194.95" x2="193.87" y2="190.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="277.24" y1="194.95" x2="277.24" y2="190.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="360.62" y1="194.95" x2="360.62" y2="190.58" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<text transform="translate(16.76 200.82)" style="font-size:9px;">0</text>
			<text transform="translate(11.62 171.65)" style="font-size:9px;">50</text>
			<text transform="translate(6.47 142.48)" style="font-size:9px;">100</text>
			<text transform="translate(6.47 113.32)" style="font-size:9px;">150</text>
			<text transform="translate(6.47 84.15)" style="font-size:9px;">200</text>
			<text transform="translate(6.47 54.98)" style="font-size:9px;">250</text>
			<text transform="translate(6.47 25.82)" style="font-size:9px;">300</text>
			<line x1="27.12" y1="194.95" x2="27.12" y2="19.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="194.95" x2="35.46" y2="194.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="165.79" x2="35.46" y2="165.79" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="136.62" x2="35.46" y2="136.62" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="107.45" x2="35.46" y2="107.45" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="78.29" x2="35.46" y2="78.29" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="49.12" x2="35.46" y2="49.12" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<line x1="27.12" y1="19.95" x2="35.46" y2="19.95" style="fill:none;stroke:#717272;stroke-miterlimit:10"/>
			<rect x="86.32" y="122.62" width="15.01" height="72.33" style="fill:url(#a)"/>
			<rect x="169.69" y="28.7" width="15.01" height="166.25" style="fill:url(#b)"/>
			<rect x="253.07" y="139.54" width="15.01" height="55.42" style="fill:url(#c)"/>
			<rect x="336.44" y="153.54" width="15.01" height="41.42" style="fill:url(#d)"/>
			<rect x="69.64" y="129.04" width="15.01" height="65.92" style="fill:url(#e)"/>
			<rect x="153.02" y="59.62" width="15.01" height="135.33" style="fill:url(#f)"/>
			<rect x="236.39" y="159.37" width="15.01" height="35.58" style="fill:url(#g)"/>
			<rect x="319.77" y="162.87" width="15.01" height="32.08" style="fill:url(#h)"/>
			<rect x="52.97" y="134.87" width="15.01" height="60.08" style="fill:url(#i)"/>
			<rect x="136.34" y="49.12" width="15.01" height="145.83" style="fill:url(#j)"/>
			<rect x="219.72" y="154.7" width="15.01" height="40.25" style="fill:url(#k)"/>
			<rect x="303.09" y="166.37" width="15.01" height="28.58" style="fill:url(#l)"/>
			<rect x="36.29" y="156.45" width="15.01" height="38.5" style="fill:url(#m)"/>
			<rect x="119.67" y="81.79" width="15.01" height="113.17" style="fill:url(#n)"/>
			<rect x="203.04" y="146.54" width="15.01" height="48.42" style="fill:url(#o)"/>
			<rect x="286.42" y="169.87" width="15.01" height="25.08" style="fill:url(#p)"/>
			<text transform="translate(46.09 153.97) rotate(-90)" style="font-size:9px;font-weight:700">66</text>
			<text transform="translate(61.61 132.85) rotate(-90)" style="font-size:9px;font-weight:700">103</text>
			<text transform="translate(79.61 127.35) rotate(-90)" style="font-size:9px;font-weight:700">113</text>
			<text transform="translate(97.08 120.35) rotate(-90)" style="font-size:9px;font-weight:700">124</text>
			<text transform="translate(129.84 80.1) rotate(-90)" style="font-size:9px;font-weight:700">194</text>
			<text transform="translate(146.26 47.03) rotate(-90)" style="font-size:9px;font-weight:700">250</text>
			<text transform="translate(163.42 57.53) rotate(-90)" style="font-size:9px;font-weight:700">232</text>
			<text transform="translate(179.41 26.93) rotate(-90)" style="font-size:9px;font-weight:700">285</text>
			<text transform="translate(212.92 144.77) rotate(-90)" style="font-size:9px;font-weight:700">83</text>
			<text transform="translate(229.92 152.43) rotate(-90)" style="font-size:9px;font-weight:700">69</text>
			<text transform="translate(246.26 157.27) rotate(-90)" style="font-size:9px;font-weight:700">61</text>
			<text transform="translate(262.92 137.27) rotate(-90)" style="font-size:9px;font-weight:700">95</text>
			<text transform="translate(296.49 168.27) rotate(-90)" style="font-size:9px;font-weight:700">43</text>
			<text transform="translate(313.48 164.27) rotate(-90)" style="font-size:9px;font-weight:700">49</text>
			<text transform="translate(330.42 161.27) rotate(-90)" style="font-size:9px;font-weight:700">55</text>
			<text transform="translate(347.42 150.27) rotate(-90)" style="font-size:9px;font-weight:700">71</text>
			<rect x="26.93" y="236.38" width="15.17" height="15.17" style="fill:url(#q)"/>
			<text transform="translate(48.97 248.29)" style="font-size:9px;">2013</text>
			<rect x="83.6" y="236.38" width="15.17" height="15.17" style="fill:url(#r)"/>
			<text transform="translate(105.97 248.29)" style="font-size:9px;">2014</text>
			<rect x="138.6" y="236.38" width="15.17" height="15.17" style="fill:url(#s)"/>
			<text transform="translate(159.64 248.29)" style="font-size:9px;">2015</text>
			<rect x="191.26" y="236.38" width="15.17" height="15.17" style="fill:url(#t)"/>
			<text transform="translate(212.3 248.29)" style="font-size:9px;">2016</text>
		</svg>
<?php
    $svg_3 = ob_get_contents();
    ob_end_clean();

    wsu_register_inline_svg( 'project-sponsor-awards', $svg_1 );
    wsu_register_inline_svg( 'royalty-revenue', $svg_2 );
    wsu_register_inline_svg( 'commercialization-activity', $svg_3 );
}
