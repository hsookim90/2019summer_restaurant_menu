  // TODO: find way to combine upVote and downVote functions

printMenuItems();

// in functions where change in code for desktop can use mobile boolean
var mobile=false;

if (matchMedia)
{
	// for some reason chrome dev device emulator doesn't work for px less than 985px
	// eg putting this at 1000px will work in chrome dev tools
	// but the 600px gets recgonized in normal browser, not sure why?
	const mq = window.matchMedia("(min-width:600px)");
	mq.addListener(widthChange);
	widthChange(mq);
}

function widthChange(mq)
{
	if (mq.matches)
	{
		mobile = false;
	}
	else
	{
		mobile = true;
	}
		printMenuItems();
}


function printMenuItems()
{
	var menuDisplayHtml = "";

	if (typeof menuItemsDetails !== "undefined")
	{
	  for (var i = 0; i < menuItemsDetails.length; i++)
	  {
			if (mobile == true)
			{
				menuDisplayHtml += getMobileItemHTMLString(menuItemsDetails[i], i);
			}
			else
			{
	    	menuDisplayHtml += getDesktopItemDBHTMLString(menuItemsDetails[i], i);
			}
	  }
	}
	var menuDisplay = document.querySelector(".menu-items-display");
	menuDisplay.innerHTML = menuDisplayHtml;
	addThumbsUpListners();
	addThumbsDownListners();
}

function upVote() {

  var parent = this.parentElement;
	// triple parent if menu desktop html
	// b/c up-votes-num is in vertical-align class (parent 1)
	// vertical-align-class in thumbs-and-nums class (parent 2)
	// thumbs-and-nums class is in the menu-item-# class (parent 3)
	if (mobile==false)
	{
		parent = parent.parentElement;
		parent = parent.parentElement;
	}

  var xhr = new XMLHttpRequest();
  xhr.open('POST', getSiteRoot() + '/public/upvote.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {

      var menuItems = JSON.parse(xhr.responseText);
			menuItemsDetails = menuItems;

			printMenuItems();
    }
  };
  // multiple values maybe like so: xhr.send( "cmd=ping&url=www.google.com" );
  xhr.send("id=" + parent.id);
}

function downVote() {
  var parent = this.parentElement;
	// triple parent if menu desktop html
	if (mobile==false)
	{
		parent = parent.parentElement;
		parent = parent.parentElement;
	}

  var xhr = new XMLHttpRequest();
  xhr.open('POST', getSiteRoot() + '/public/downvote.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {

      var menuItems = JSON.parse(xhr.responseText);
			menuItemsDetails = menuItems;

			printMenuItems();
    }
  };
  xhr.send("id=" + parent.id);
}

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

function getMobileItemHTMLString(itemObj, position)
{
	var displayCode = "<section id = 'menu-item-" + escapeHTML(position)
	+ "' class = 'menu-item'>";
	displayCode += "<h1>" + escapeHTML(itemObj.itemName) + "</h1>";
	displayCode += "<div class = 'plate'>";
	displayCode += "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
	displayCode += "</div>";
	displayCode += "<p class='price-num'>$" + escapeHTML(itemObj.price) + "</p>";
	displayCode += "<i class='fas fa-thumbs-down'></i>";
	displayCode += "<i class='fas fa-thumbs-up'></i>";
	displayCode += "<div class='votes-bar'>";
	displayCode += "<span class ='down-votes-num'>" + escapeHTML(itemObj.downVoteNumber) + "</span>";
	displayCode += "<span class ='up-votes-num'>" + escapeHTML(itemObj.upVoteNumber) + "</span>";
	displayCode += "</div>";
	displayCode += "</section>";
	return displayCode;
}

function getDesktopItemDBHTMLString(itemObj, position)
{
	var displayCode = "<section id = 'menu-item-" + escapeHTML(position)
		+ "' class = 'menu-item'>";

    displayCode += "<section class = 'thumbs-and-nums'>";
    displayCode += "<span class='vertical-align'>";
	displayCode += "<span class ='up-votes-num'>" + escapeHTML(itemObj.upVoteNumber) + "</span>";
	displayCode += "<span class ='down-votes-num'>" + escapeHTML(itemObj.downVoteNumber) + "</span>";
    displayCode += "</span>";
    displayCode += "<span class='vertical-align'>";
    displayCode += "<i class='fas fa-thumbs-up'></i>";
    displayCode += "<i class='fas fa-thumbs-down'></i>";
    displayCode += "</span>";
    displayCode += "</section>";
  	displayCode += "<div class = 'plate'>";
    displayCode += "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
  	displayCode += "</div>";
    displayCode += "<span class = 'vertical-align item-and-price'>";
	displayCode += "<h1>" + escapeHTML(itemObj.itemName) + "</h1>";
	displayCode += "<p class='price-num'>$" + escapeHTML(itemObj.price) + "</p>";
  	displayCode += "</span>";
    displayCode += "<div class = 'ingredients'>";
    displayCode += "<p>";
    displayCode += "Garbanzo Beans, zucchiini, mushrooms, tomato, garlic, oregano, cilantro.";
    displayCode += "<p>";
    displayCode += "<div>";
	displayCode += "</section>";

	return displayCode;
}

function escapeHTML(html)
{
  var temp = document.createElement('div');
  temp.textContent = html;
  return temp.innerHTML;
}

// source: https://www.codeproject.com/Questions/192023/Getting-absolute-path-with-JavaScript
function getSiteRoot()
{
    var rootPath = window.location.protocol + "//" + window.location.host + "/";
    if (window.location.hostname == "localhost")
    {
        var path = window.location.pathname;
        if (path.indexOf("/") == 0)
        {
            path = path.substring(1);
        }
        path = path.split("/", 1);
        if (path != "")
        {
            rootPath = rootPath + path + "/";
        }
    }
    return rootPath;
}
