	</div><!-- #content -->

	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper clear text-center">
			<div class="foot-inside clear">
				<?php  
					$address_line_1 = get_field('address_line_1','option');
					$address_line_2 = get_field('address_line_2','option');
					$phone = get_field('phone','option');
					$email_address = get_field('email_address','option');
				?>
				<div class="contact-col column">
					<div class="row clear">
						<div class="col">
							<?php if ($address_line_1) { ?>
								<div class="info"><?php echo $address_line_1 ?></div>	
							<?php } ?>
							<?php if ($address_line_2) { ?>
								<div class="info"><?php echo $address_line_2 ?></div>	
							<?php } ?>
						</div>
						<div class="col">
							<?php if ($phone) { ?>
								<div class="info"><b>O:</b><?php echo $phone ?></div>	
							<?php } ?>
							<?php if ($email_address) { ?>
								<div class="info"><b>E:</b><a href="mailto:<?php echo antispambot($email_address,1) ?>"><?php echo antispambot($email_address); ?></a></div>	
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="menu-col column">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','container'=>false ) ); ?>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="ml-loader-wrap"><div class="ml-loader"> <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>       
<?php wp_footer(); ?>


</body>
</html>
