		
<style>
body{
	width: 100%;
	padding: 0;
	margin: 0;
	font-family: "Century Gothic", sans-serif;
	font-size: 90%;
}
#wrapper{
	width: 90%;
	max-width: 800px;
	margin: 0 auto;
}
h2{
	margin: 100px 0px 10px 0px;
}
#header{
	margin-bottom: 5px;
}
#author{
	margin: 5px 0px 50px 0px;
	padding-bottom: 15px;
	border-bottom: 1px solid #bdbdbd;
}
#footer{
	margin: 150px 0px 100px 0px;
}
</style>
</head>

<body>

<div id="wrapper">
	<h1 id="header">How to use the Fancybox</h1>
	<p id="author">Author: Olivia Hoback, <a target="blank" href="http://www.olivia.nu">www.olivia.nu</a></p>
	
	
	
	
	<!--use Fancybox to show an image-->
	<h2>Images</h2>
	<a class="fancybox" href="images/demo-image.jpg">Text link opening an image in Fancybox</a><br />
	<p>Single image thumb link<br /><a class="fancybox" href="images/demo-image.jpg"><img src="images/thumb-image.jpg" /></a></p>
	<p>Image gallery<br />
		<a class="fancybox" rel="myGallery" href="images/demo-image.jpg"><img src="images/thumb-image.jpg" /></a>
		<a class="fancybox" rel="myGallery" href="images/demo-image01.jpg"><img src="images/thumb-image01.jpg" /></a>
		<a class="fancybox" rel="myGallery" href="images/demo-image02.jpg"><img src="images/thumb-image02.jpg" /></a>
	</p>
  
  
  
	
	<!--use Fancybox to show different kind of media-->
	<h2>Other media</h2>
	<p>
		<a class="various" data-fancybox-type="iframe" href="http://www.the-perfect-life.org/html-5-css-3-php-wordpress-jquery-javascript-photoshop-illustrator-tutorial">Show external page using Iframe in a fancybox</a><br />
		<a class="fancybox" data-fancybox-type="iframe" href="http://www.the-perfect-life.org/html-5-css-3-php-wordpress-jquery-javascript-photoshop-illustrator-tutorial/source-code/PDF.pdf">pdf in the fancybox</a><br />
		<a class="various" href="http://www.the-perfect-life.org/html-5-css-3-php-wordpress-jquery-javascript-photoshop-illustrator-tutorial/source-code/movie.swf">swf in the fancybox</a><br />
		<a class="fancybox-media" href="http://www.youtube.com/watch?v=hIXC5PH1ehw">Youtube video in the fancybox</a><br />
		<a class="fancybox-media" href="http://vimeo.com/69700933">Vimeo video in the fancybox</a><br />
		<a class="fancybox-media" href="http://instagr.am/p/IejkuUGxQn">Instagram image in the fancybox</a><br />
		<a class="various fancybox.iframe" href="https://maps.google.com/maps?q=North+Pole,+Alaska,+United+States&hl=en&ll=64.751143,-147.349663&spn=0.049791,0.181789&sll=37.0625,-95.677068&sspn=46.764446,93.076172&oq=northpole+ala&t=h&hnear=North+Pole,+Fairbanks+North+Star,+Alaska&z=13">This link opens Google maps in a fancybox</a>
								
	</p>

		

		
  
  
</div><!--end of wrapper-->	




</body>
</html>