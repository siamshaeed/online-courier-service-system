<?php 
include_once('classes/contact_usClass.php');
include_once('hdr-not-check-session.php');
$Contact = new Contact();
?>
<section class="contact-banner-wrp">
<div class="overlay">
	<h1>Say hello</h1>
</div>
</section>
<section class="contact-wrp">
	<div class="contact-content clearfix">
		<div class="office-location">
			<h3>contact</h3>
			<span>Phone:</span>
			<p class="con-number">+8801636693129</p>
			<p class="con-number">+8801718552892</p>
			<p class="con-number">+8801687835849</p><br/>
			<span>Email:</span>
			<p class="con-number">hasibur15-5259@die.edu.bd</p>
			<p class="con-number">sabuj15-4742@diu.edu.bd</p>
			<p class="con-number">saiful15-5472@diu.edu.bd</p>
		</div>
		<div class="contact-form">
<?php if(isset($_POST['send'])){
$Contact->ContactUs($_POST);
}?>
			<form action="contact-us.php" method="POST">

<?php
if(isset($_SESSION['msg'])){
echo $_SESSION['msg'];
unset($_SESSION['msg']);
}
?>				
				<h3>contact with us</h3>
				<div class="input-box-row clearfix">
					<div class="contact-input-box">
						<input type="text" name="name" placeholder="Your Name">
					</div>
					<div class="contact-input-box">
						<input type="email" name="email" placeholder="Your Email">
					</div>
				</div>

				<div class="input-box-row clearfix">
					<div class="contact-input-box">
						<input type="text" name="phone" placeholder="Your Phone">
					</div>
					<div class="contact-input-box">
						<input type="text" name="company" placeholder="Company Name">
					</div>
				</div>

				<div class="contact-address">
					<textarea placeholder="Your Message" name="message"></textarea>
				</div>

				<div class="submit-form">
					<input type="submit" name="send" value="send your message">
				</div>
			</form>
		</div>
	</div>
</section>
<?php include_once('footer.php');?>