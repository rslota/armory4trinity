//global vars
var bookmarkTimerId	 = 0; //timer id to keep menu open or close 
var asyncType 		 = (!($.browser.msie) && !($.browser.mozilla)) ? false : true;

//bookmarks a character
function ajaxBookmarkChar()
{
	//change "bookmark this character" img
	if(asyncType == true){
		$("#profileRight")[0].innerHTML = "<div class=\"bmcEnabled\"></div>";
	}
		
	buildBookmarkMenu("/vault/bookmarks.xml?" + charUrl + "&action=1");
}

//removes a bookmarked character from the drop down list
function ajaxRemoveChar(removedLink, clickedItem)
{	
	//hide tooltip
	$(theGlobalToolTip).hide();	
	
	buildBookmarkMenu("/vault/bookmarks.xml?" + removedLink + "&action=2");	
}


function buildBookmarkMenu(url)
{	
	$(".bmlist").remove();
	$(".nobookmark").remove();	
	
	//force refresh for crummy browsers
	if(asyncType == false) 
		Sarissa.updateContentFromURI(url, $("#bookmarkHolder")[0],null, function() { window.location.reload() });		
	else
		Sarissa.updateContentFromURI(url, $("#bookmarkHolder")[0],null,bindBookmarkMenu);
}

//keeps bookmark menu dropdown open
function persistBookMarkMenu()
{
	if(bookmarkTimerId != null)
		clearTimeout(bookmarkTimerId);
		
	bookmarkTimerId = setTimeout('$("#menuHolder").hide(); $("#menuHolder").css("z-index","-1");', 500);	
}

//initialize the bookmark dropdown menu
function bindBookmarkMenu(sFromUrl, oTargetElement)
{
	
	//bind timers for bookmark menu
	setBookmarkPersistTimers();
	
	//bind function for removing a bookmark
	$(".rmBookmark").click(function(){
			
		//get the link that tells us what character we want to remove	
		var removeBookmarkLink = $(this).prev().attr("href");		
				
		//remove the "/character-sheet.xml?" portion
		removeBookmarkLink = removeBookmarkLink.substr(removeBookmarkLink.indexOf(".xml?")+5);	
		
		//theCharUrl doesnt always exist, so wrap in "try/catch" to avoid errors
		try{
			//remove potential spaces in realm names
			charUrl				= charUrl.replace(/ /g,"+");
			charUrl			    = charUrl.replace(/\%20/g,"+");
			removeBookmarkLink  = removeBookmarkLink.replace(/ /g,"+");
			removeBookmarkLink  = removeBookmarkLink.replace(/\%20/g,"+");	
			
			//means we're on this page, so change the green check to "add bookmark"	
			if(charUrl == removeBookmarkLink){
				document.getElementById("profileRight").innerHTML = "<a id=\"bmcLink\" href=\"javascript:ajaxBookmarkChar()\"><span>"+bookmarkThisChar+"</span><em/></a>";
			}
		}catch(e){ }
		
		//call ajax function to remove the item
		ajaxRemoveChar(removeBookmarkLink,this);	
	});
	
	//rebind tooltips
	bindToolTips();	
}

//binds certain elements to show/persist the bookmark menu
function setBookmarkPersistTimers()
{
	//show bookmark menu and keep it open
	$("#bookmark-user").mouseover(function() {
		persistBookMarkMenu();	
		$("#menuHolder").show();
		$("#menuHolder").css("z-index","10");
		clearTimeout(bookmarkTimerId);
	});
	
	//when leaving bookmark icon, start timer again to prevent menu
	//from not closing if they dont mouse over the menu portion
	$("#bookmark-user").mouseout(function() {
		persistBookMarkMenu();		   
	});
		
	//keep bookmarkmenu open (stop timer)	
	$("#menuHolder .menuItem").mouseover(function(){
		clearTimeout(bookmarkTimerId);
	});	
	
	$("#menuHolder").mouseover(function(){
		clearTimeout(bookmarkTimerId);
	});	
	
	$("#menuHolder").mouseout(function(){
		persistBookMarkMenu();
	});	
	
	//when mousing over parchment, hide the menu
	$(".parchment-top").mouseover(function(){
		$("#menuHolder").hide()						   
	});
	
	//get page vals
	var currPage = $("#bm-currPage").html()*1;
	var totalPages = $("#bm-totalPages").html()*1;
	
	checkArrows();
		
	$("#bmFwd").click(function(){		
		if($(this).hasClass("disabled")) return;
		
		currPage = $("#bm-currPage").html()*1;
		
		if((currPage != totalPages) && (totalPages != 0)){
			$("#bookmarkHolder #page" + currPage).hide();
			$("#bookmarkHolder #page" + (currPage+1)).show();
			
			$("#bm-currPage").html((currPage+1));
			
			checkArrows();
		}
	});
	
	//page back
	$("#bmBack").click(function(){
		if($(this).hasClass("disabled")) return;
		
		currPage = $("#bm-currPage").html()*1;
		
		if(currPage > 1){
			$("#bookmarkHolder #page" + currPage).hide();
			$("#bookmarkHolder #page" + (currPage-1)).show();
			
			$("#bm-currPage").html((currPage-1));
			
			checkArrows();
		}
	});
}


function checkArrows(){
	var currPage = $("#bm-currPage").html()*1;
	var totalPages = $("#bm-totalPages").html()*1;
	
	var arrows = {
		prev: $("#bmBack"),
		next: $("#bmFwd")		
	}
	
	$(arrows.next).removeClass("bmDisabled");
	$(arrows.prev).removeClass("bmDisabled");
	
	if(totalPages == 0){
		$(arrows.next).addClass("bmDisabled");
		$(arrows.prev).addClass("bmDisabled");
	}
	
	if(currPage == 1)
		$(arrows.prev).addClass("bmDisabled");
	
	if(currPage == totalPages)
		$(arrows.next).addClass("bmDisabled");
		
	$("#currPageTxt").html(currPage);
	$("#totalPageTxt").html(totalPages);	
}
