  // TODO: find way to combine upVote and downVote functions
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
				// var bodyElement = document.body;
				// bodyElement.innerHTML = result;

        var menuDisplay = document.querySelector(".menu-items-display");
        menuDisplay.innerHTML = result;

				addThumbsUpListners();
				addThumbsDownListners();
      }
    };
    // multiple values maybe like so: xhr.send( "cmd=ping&url=www.google.com" );
    xhr.send("id=" + parent.id);
  }

  function downVote() {
    var parent = this.parentElement;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'downvote.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        console.log('Result: ' + result);
				// var bodyElement = document.body;
				// bodyElement.innerHTML = result;
        var menuDisplay = document.querySelector(".menu-items-display");
        menuDisplay.innerHTML = result;
				addThumbsUpListners();
				addThumbsDownListners();
      }
    };
    // multiple values maybe like so: xhr.send( "cmd=ping&url=www.google.com" );
    xhr.send("id=" + parent.id);
  }


addThumbsUpListners();
addThumbsDownListners();

function addThumbsUpListners()
{
	const THUMBS_UP = document.querySelectorAll(".fa-thumbs-up");
	for(i=0; i < THUMBS_UP.length; i++) {
		THUMBS_UP.item(i).addEventListener("click", upVote);
	}
}

function addThumbsDownListners()
{
	const THUMBS_DOWN = document.querySelectorAll(".fa-thumbs-down");
	for(i=0; i < THUMBS_DOWN.length; i++) {
		THUMBS_DOWN.item(i).addEventListener("click", downVote);
	}
}
