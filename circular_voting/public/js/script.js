var upVoteCount = 0;

function upVote()
{
		console.log("in upvote");
		upVoteCount++;
		console.log(upVoteCount);
}

//const THUMB_UP = document.querySelector(".fa-thumbs-up");
//THUMB_UP.style.color="green";
//THUMB_UP.addEventListener("click", upVote);

const THUMBS_UP = document.querySelectorAll(".fa-thumbs-up");
//THUMBS_UP.style.color="green";


for(i=0; i < THUMBS_UP.length; i++) {
	THUMBS_UP.item(i).addEventListener("click", upVote);
}
