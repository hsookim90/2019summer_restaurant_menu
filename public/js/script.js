  // TODO: find way to combine upVote and downVote functions

var menuDisplayHtml = "";

if (typeof menuItemsDetails !== "undefined")
{
  for (var i = 0; i < menuItemsDetails.length; i++)
  {
    menuDisplayHtml += getMobileItemHTMLString(menuItemsDetails[i]);
  }
}

var menuDisplay = document.querySelector(".menu-items-display");
menuDisplay.innerHTML = menuDisplayHtml;

function upVote() {

  var parent = this.parentElement;
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'upvote.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {

      var menuItems = JSON.parse(xhr.responseText);
      var menuDisplayHtml = "";

	    for (var i = 0; i < menuItems.length; i++)
      {
        menuDisplayHtml += getMobileItemHTMLString(menuItems[i]);
      }

      var menuDisplay = document.querySelector(".menu-items-display");
      menuDisplay.innerHTML = menuDisplayHtml;

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

      var menuItems = JSON.parse(xhr.responseText);
      var menuDisplayHtml = "";

	    for (var i = 0; i < menuItems.length; i++)
      {
        menuDisplayHtml += getMobileItemHTMLString(menuItems[i]);
      }

      var menuDisplay = document.querySelector(".menu-items-display");
      menuDisplay.innerHTML = menuDisplayHtml;

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

function getMobileItemHTMLString(itemObj)
{
		var displayCode = "<section id = 'menu-item-" + escapeHTML(itemObj.itemNumber)
		+ "' class = 'menu-item'>";
		displayCode += "<h1>" + escapeHTML(itemObj.itemName) + "</h1>";
		displayCode += "<div class = 'plate'>";
		displayCode += "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
		displayCode += "</div>";
		displayCode += "<p class='price-num'>$" + escapeHTML(itemObj.price) + "</p>";
		displayCode += "<i class='fas fa-thumbs-down'></i>";
		displayCode += "<i class='fas fa-thumbs-up'></i>";
		displayCode += "<div class='votes-bar'</div>";
		displayCode += "<span class ='down-votes-num'>" + escapeHTML(itemObj.downVoteNumber) + "</span>";
		displayCode += "<span class ='up-votes-num'>" + escapeHTML(itemObj.upVoteNumber) + "</span>";
		displayCode += "</div>";
		displayCode += "</section>";
		return displayCode;
}

function escapeHTML(html)
{
  var temp = document.createElement('div');
  temp.textContent = html;
  return temp.innerHTML;
}
