<?php
/**
 * Template Name: Staff Training Videos
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header('intranet'); ?>
		
		<div id="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			
			<div class="content_wrapper" style="width:100%;">
				<div id="content">
					
					<h1><?php the_title();?></h1>
					
					<p>Below are some basic topics that I cover on how to update basic pages within our Wordpress site. These videos apply to people who get extra permissions added to their staff intranet profiles. Please look through these videos. If you have any additional questions please fill out the form on this page and I will help you out further. Also, if there are any other video topics you would like me to cover, please let me know. In the future, I would like to make to some pdf instructions to go along with these videos that you can download for your reference.</p>
					
					<p>Thank You,<br/>
						<img class="garrett_basics" width="100" src="<?php bloginfo('template_directory');?>/images/garrett.jpg"/><br/>
						Garrett Cullen<br/>
						Webmaster</p>
					
					
					<div class="wp_vid_wrapper">
						
						<h2 class="wp_vid_header">Introduction</h2>
					
					<div class='embed-container wp_vid_content'>
						<iframe src='https://www.youtube.com/embed/mMcxtcp-mBE' frameborder='0' allowfullscreen></iframe>
					</div><!-- embed-container -->
						
						
					</div><!-- wp_vid_wrapper -->
					
					
					<div class="wp_vid_wrapper">
					
					
					<h2 class="wp_vid_header">Overview and Page Run Through</h2>
					
					<div class='embed-container wp_vid_content'>
						<iframe src='https://www.youtube.com/embed/DQ6Sekpi9tk' frameborder='0' allowfullscreen></iframe>
					</div>
					
					</div><!-- wp_vid_wrapper -->
					
					<div class="wp_vid_wrapper">
					
					<h2 class="wp_vid_header">Create a New Page Part 1</h2>
					
					
					<div class='embed-container wp_vid_content'><iframe src='https://www.youtube.com/embed/yOh0Qbjjm44' frameborder='0' allowfullscreen></iframe></div>
					
					</div>
					
					<div class="wp_vid_wrapper">
					
					<h2 class="wp_vid_header">Create a New Page Part 2</h2>
					
					<div class='embed-container wp_vid_content'><iframe src='https://www.youtube.com/embed/sy0FMle05PQ' frameborder='0' allowfullscreen></iframe></div>
					
					</div>
					
					
					<div class="wp_vid_wrapper">
					
					<h2 class="wp_vid_header">Uploading Media</h2>
					
					<div class='embed-container wp_vid_content'><iframe src='https://www.youtube.com/embed/doJiIy_oKgw' frameborder='0' allowfullscreen></iframe></div>
					
					</div>
					
					<div class="wp_vid_wrapper">
					
					<h2 class="wp_vid_header">Embed a Youtube Video</h2>
					
					
					<div class='embed-container wp_vid_content'><iframe src='https://www.youtube.com/embed/CO7JI-jAb5c' frameborder='0' allowfullscreen></iframe></div>
					
					</div>
					
					<div class="wp_vid_wrapper">
					
					<h2 class="wp_vid_header">Custom Post Types</h2>
					
					
					<div class='embed-container wp_vid_content'><iframe src='https://www.youtube.com/embed/TprWnkSEuzg' frameborder='0' allowfullscreen></iframe></div>
					
					</div>
					
					<h2 style="margin-top:35px;">Things to Remember</h2>
					
					<p><strong>Organization and Best Practices</strong></p>
					
					<ul>
						<li>Add ATT categories to each uploaded file</li>
						<li>Add ALT information to all images</li>
						<li>Use link text rather than full URL</li>
						<li>Do not duplicate same link on one page</li>
						<li>Test your page</li>
					</ul>
					
					<p><strong>Preparing Files for Upload to the Website</strong></p>
					
					<p>Rules for file naming:</p>
					
					<ul>
						<li>Lower case</li>
						<li>Dashes (preferred over underscore)</li>
						<li>No spaces</li>
						<li>No commas</li>
						<li>No periods (dots)</li>
						<li>No parentheses</li>
						<li>No special characters (e.g.%, =,#,$,!)</li>
						<li>Consistently name files</li>
						<li>Name files with the most distinctive word, leave out conjunctions and articles (e.g. the, and)</li>
					</ul>
					
					<p>Acceptable File Formats - All the options below are cross-compatible:</p>
					
					<ul>
						<li>PDF's - leave them as they are or reduce file size</li>
						<li>Video - mp4</li>
						<li>Audio - mp3</li>
						<li>PPT - PDF, PPT, show</li>
						<li>docx - PDF or Doc</li>
						<li>xls - PDF or XLS</li>
						<li>Google Doc - PDF or ppt, xls, or doc</li>
						<li>Images - JPG, PNG, GIF</li>
					</ul>
					
					<p>Strategies for Keeping File Size Small</p>
					
					<ul>
						<li>Keep all files under 5MB. Anything larger is too big for the website and must be compressed</li>
						<li>Audio and Videos: Upload to Academy You Tube Channel or compress</li>
						<li>PDFs: Compress files using Adobe Acrobat Professional (File>Save as other>reduced file PDF)</li>
						<li>Images: save for web in Photoshop</li>
						<li>Find the same document on another website (e.g. CalSWEC or .gov site)</li>
					</ul>
					
					<div class="basic_form">
						
						<h2>Questions or Comments?</h2>
					
						<?php gravity_form(1, false, false, false, '', true, 12); ?>
					
					</div><!-- basic_form -->
					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer('intranet'); ?>
