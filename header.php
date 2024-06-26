<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

<title><?php echo wp_get_document_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() ) {
	wp_enqueue_script( 'comment-reply' );}
?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page">

<div id="header" role="banner">
	<div id="headerimg">
		<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="description"><?php bloginfo( 'description' ); ?></div>
	</div>
</div>
<hr />
<table border="1" style="margin-inline: auto;" cellspacing="0" cellpadding="0">
	<tr>
		<th>ID</th>
		<th>Value</th>
	</tr>
	<?php $mods = get_theme_mods(); ?>
	<?php foreach ( $mods as $key => $value ) : ?>
		<tr>
			<td style="padding: 5px;"><?php echo $key; // phpcs:ignore ?></td>
			<td style="padding: 5px;"><pre><?php var_export( $value ); // phpcs:ignore ?></pre></td>
		</tr>
	<?php endforeach; ?>
</table>
