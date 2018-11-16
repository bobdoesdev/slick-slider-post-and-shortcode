<div class="wrap">
	<h2>How to use this plugin</h2>


	<p>This plugin allows for you to create Slick slider image galleries that can be grouped into slideshows and displayed with various options via shortcodes across your website.</p>

	<div class="half">
		<h3>To use shortcodes:</h3>
		<p>Paste this code into the text editor to create a three column layout:</p>

		<p><b>[slick]</b></p>

		<p>But don't stop there! You'll need to either add some ids or a gallery before the shortcode will generate any content. For example:</p>

		<p><b>[slick id="1,2,3"]</b></p>

		<p><b>[slick gallery="main"]</b></p>

		<p>Do that and you'll have a gallery, and all of the other options will be default for Slick. If you want to configure these options more specifically, read on!

		<h4>Options</h4>
		Here are a list of options at your disposal:

		<ul>
			<li><b>autoplay</b> - default is false. Determines whether your slider will slide without having to drag or hit the arrow.</li>
			<li><b>autoplaySpeed</b> - default is 3000 (3000ms = 3 seconds). Determines how long the slide pauses between slides.</li>
			
			<li><b>fade</b> - change default transition from slide to fade</li>
			<li><b>pauseOnHover</b> - default is hover, no pause when set to false</li>
			<li><b>gallery</b> - the name of the gallery you would like to include. Either this or the specific ids are required for the shortcode to work.</li>
			<li><b>ids</b> - the list of ids you'd like to include in the gallery. If both gallery and ids options are set, will use ids.</li>
			<li><b>infinite</b> - determines if the slider will keep going forever in one direction, or if it will slide in reverse when it gets to the last slide. Default is false.</li>
			<li><b>slidesToScroll</b> - default is 1. Determines how many slides are slid when the arrows are clicked.</li>
			<li><b>slidesToShow</b> - default is 1. Determines how many slides are shown on the page at any give time.</li>			
			<li><b>order</b> - ASC for ascending, DSC for descending</li>
			<li><b>orderby</b> - menu order, date, etc</li>
			<li><b>height</b> - set the height of the carousel</li>
			<li><b>width</b> - set the width of the caorusel</li>
			<li><b>captions</b> - include captions and titles along with images. Default is false</li>
			<li><b>posts_per_page</b> - how many images from a gallery should be included, set to all images by default</li>
			<li><b>arrows</b> - default is to show arrows, false hides them</li>
			<li><b>dots</b> - default is to show dots, false hides them</li>
			<li><b>testimonials</b> - testimonial sliders do not include images, just title and content. No videos or images will appear. Default is false.</li>

		</ul>

		<p>To make use of these options, simply add the shortcode and add the options inside of the brackets after 'slick', like so: </p>
		<p>[slick autoplaySpeed="4000" gallery="main" arrows="false" posts_per_page="8" infinite="true" slidesToShow="2" slidesToScroll="2"] </p>
	</div>
</div>
	    

