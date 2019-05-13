<?php
	require_once('../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Voting Idea</title>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic SC">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  </head>
  <body>
	  <section class = "menu-item">
		<i class="fas fa-thumbs-down"></i>
		  <div class = "plate">
			<img src = "https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg" class = "item-image">
			<div class = 'alpha-bg'>
				<p>Chickpeas</p>
			</div>
		  </div>
	  	<i class="fas fa-thumbs-up"></i>
	  </section>
	<?php
		echo "start of php printout";
		echo createMenuItem("chickpeas");
		echo createMenuItem("rice");
		echo createMenuItem("apples");
		echo createMenuItem("tomatoe");
		echo createMenuItem("soup");
	?>


	<script>

		var upVoteCount = 0;

		function upVote()
		{
				console.log("in upvote");
				upVoteCount++;
				console.log(upVoteCount);
		}

		const THUMB_UP = document.querySelector(".fa-thumbs-up");
		THUMB_UP.style.color="green";
		THUMB_UP.addEventListener("click", upVote);
	</script>

  </body>
</html>
