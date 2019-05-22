var upVoteCount = 0;

function upVoteOld()
{
		console.log("in upvote");
		upVoteCount++;
		console.log(upVoteCount);
}
  function upVote() {
    var parent = this.parentElement;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upvote.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        if (result == 'true')
        {
					parent.style.backgroundColor = "green";
					var upVoteText = document.querySelector('#' + parent.id + ' #upVotesID');

					// TODO replace hardcode below with relevant info
					var num = 9;
					upVoteText.innerText = ('upvotes ' + num);
					num++;
					upVoteText.innerText = ('upvotes ' + num);
        }
        console.log('Result: ' + result);
      }
    };
    // multiple values maybe like so: xhr.send( "cmd=ping&url=www.google.com" );
    xhr.send("id=" + parent.id);
  }

const THUMBS_UP = document.querySelectorAll(".fa-thumbs-up");
//THUMBS_UP.style.color="green";

for(i=0; i < THUMBS_UP.length; i++) {
	THUMBS_UP.item(i).addEventListener("click", upVote);
}
