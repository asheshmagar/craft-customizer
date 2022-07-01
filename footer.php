<hr />
<div id="footer" role="contentinfo">
	<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
	<p>
		<?php
			printf(
			/* translators: 1: Blog name, 2: WordPress */
				__( '%1$s is proudly powered by %2$s' ),
				get_bloginfo( 'name' ),
				'<a href="https://wordpress.org/">WordPress</a>'
			);
			?>
	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

<?php wp_footer(); ?>
</body>
</html>
