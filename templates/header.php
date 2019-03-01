<div class="row" style="margin-bottom:0;">
	<div class="col s12 login right-align" style="height:35px; background-color:rgb(55, 201, 238);">
		<ul>
		<?php	if (empty($_SESSION['id_kor'])): ?>
			<li><i class="inline-icon material-icons" style="color:#368ce7;">person</i><a href="prijava.php">Login</a></li>
			<li><i class="inline-icon material-icons" style="color:#368ce7;">person_add</i><a href="registracija.php">Registration</a></li>
	<?php else: ?>
			<li><i class="inline-icon material-icons" style="color:#368ce7;">dashboard</i><a href="adminPanel.php">Admin panel</a></li>
			<li>|<i class="inline-icon material-icons" style="color:#368ce7;">exit_to_app</i><a href="odjava.php">Logout</a></li>
			<?php endif?>
		</ul>
	</div>
</div>
<div class="row" style="margin-bottom: 10px;">
	<div class="col s12" style="padding:0;">
		<nav style="height: 350px; background-image: url('images/havaji2.jpg');">
			<div class="nav-wrapper">
				<a href="index.php" class="brand-logo"><img src="images/logo.png" alt=""></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php" >About as</a></li>
						<li><a href="blog.php" >Blog</a></li>
						<li><a href="#">Gallery</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
			</div>
		</nav>
	</div>
</div>
