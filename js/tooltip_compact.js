/*****************************************************
 * Compact Tooltips
 * Copyright (c) 2008 Blizzard Entertainment
 * !!! Requires jQuery !!!
 *****************************************************/

//GLOBAL VARS
var itemToolTipXSLLoaded = false;
var theGlobalToolTip	 = null; //global tooltip
var xsltProcessor		 = null;
var dualTipsEnabled		 = false;
var isOnCharSheet		 = false;
var toolVault 			 = [];


//set the (left,top) / (x,y) position of the tooltip
function setToolTipPosition(tooltipObj,e)
{
	var tipPosition = getXYCoords(tooltipObj,e);
	
	//set the position
	$(theGlobalToolTip).css("left",tipPosition[0]);
	$(theGlobalToolTip).css("top",tipPosition[1]);
	$(theGlobalToolTip).show();
}


//finds the best (x,y) position to put the tooltip
function getXYCoords(tooltipObj,e)
{	
	//boolean to see if we use mouse position or not
	var useMousePosition = false;
	
	//find current x,y position
	var xPos = $(tooltipObj).offset().left;
	var yPos = $(tooltipObj).offset().top;
	
	//if the position comes back as (0,0) use the mouse position instead
	//(also adjust for scrolling!)
	if(((xPos - $(window).scrollLeft()) <= 0) && ((yPos - $(window).scrollTop()) <= 0)){
		useMousePosition =  true;
	}
	
	//get the width of the tooltip box and item we are adding tooltip to
	var tooltipWidth = -1;
	var itemWidth 	 = $(tooltipObj).outerWidth();
	
	//find out if we're on the character sheet and if we have comparison tooltips on
	if((isOnCharSheet) && (dualTipsEnabled) && (isLoggedIn) && $(tooltipObj).hasClass("itemToolTip")){
				
		//hide div and set all the way to the left so we can get proper width
		$(theGlobalToolTip).hide();
		$(theGlobalToolTip).css("left",0);
		
		tooltipWidth = $(theGlobalToolTip).outerWidth();	
		
		//for character sheet we want to put the tooltip below the item, and center it		
		xPos = xPos - (tooltipWidth/2);
		yPos = yPos + $(tooltipObj).outerHeight() + 7; //add item height
				
		//if tooltip is going to cause horizontal scrolling, nudge it over
		if((itemWidth + xPos + tooltipWidth + 5) > $(window).width()){
			xPos = $(window).width() - tooltipWidth;
		}
		
		//if it goes negative to the left, set the x to 5
		if(xPos < 0){
			xPos = 5;
		}
	}else{
		tooltipWidth = $(theGlobalToolTip).outerWidth();
		
		//if we didnt get good coordinates, use the mouse position
		if(useMousePosition == true){
			xPos = e.pageX + 7;
			yPos = e.pageY + 15;
		}
		
		//if tooltip is going to cause horizontal scrolling,
		//put it to the left of the link instead
		if((itemWidth + xPos + tooltipWidth + 5) > $(window).width()){
			xPos = xPos - tooltipWidth - 5;			
		}else{
			xPos = xPos + itemWidth + 5;
		}
	}
		
	return [xPos,yPos];
}


//sets the html of thetooltip (div)
function setTipText(tipStr)
{
	//store scoped reference
	var tooltipTxt = $("#globalToolTip_text");	
	
	$(tooltipTxt).html("");
	$(tooltipTxt).append(tipStr);	
		
	//if dual tooltips are enabled, add some borders and some text
	if(dualTipsEnabled){
		$(tooltipTxt).find("td:eq(0)").attr("style","padding-right: 10px; width: 275px;");		

		//ie6 is fail
		if(($.browser.msie) && ($.browser.version == "6.0")){
			$(".myTable").css("width","300px");
		}else{			
			if(!isOnCharSheet){
				$(tooltipTxt).css("max-width","275px");
				$(theGlobalToolTip).css("max-width","275px");
			}else{
				$(tooltipTxt).css("max-width","none");
				$(theGlobalToolTip).css("max-width","none");
			}
		}
	}else{
		if(($.browser.msie) && ($.browser.version == "6.0")){
			if($(tooltipTxt).outerWidth() > 300){
				$(tooltipTxt).css("width","300px");	
			}
		}else{
			//set max width to avoid huge tooltips
			$(theGlobalToolTip).css("max-width","400px");
			$(tooltipTxt).css("max-width","400px");			
		}
		
		//hide 2nd and 3rd column
		//$(tooltipTxt).find("td:eq(1)").css("display","none");
		//$(tooltipTxt).find("td:eq(2)").css("display","none");
		
	}
	
}

//get the html for an item via ajax
function getItemHtml(itemUrl)
{
	//load XSL stylesheet if we haven't yet	
	if(!($.browser.opera) && !($.browser.safari)){
		if(itemToolTipXSLLoaded == false)
		{
			//get the stylesheet			
			var xslDoc = Sarissa.getDomDocument();
			xslDoc.async = false;
			xslDoc.load("/layout/item-tooltip.xsl");
			
			xsltProcessor = new XSLTProcessor();
			xsltProcessor.importStylesheet(xslDoc);		
			
			itemToolTipXSLLoaded = true;
		}
	}	
	
	$.ajax({
		type: "GET",
		url: itemUrl,
		success: function(msg){		
			
			//cache the tooltip text based on browser
			if(($.browser.opera) || ($.browser.safari)){
				toolVault[itemUrl] = msg;
				
				if(toolVault[itemUrl].length <= 4)
					toolVault[itemUrl] = errorLoadingToolTip;
			}else{
				var bufferedDiv = document.createElement("div");
				bufferedDiv.innerHTML = "";
				bufferedDiv.appendChild(xsltProcessor.transformToFragment(msg,window.document));					
				toolVault[itemUrl] = bufferedDiv.innerHTML;
				
				//set error message
				if(toolVault[itemUrl].length <= 4)
					toolVault[itemUrl] = errorLoadingToolTip;					
			}
		},
		error: function(msg){				
			toolVault[itemUrl] = errorLoadingToolTip;
		}
	});
	
	
	return toolVault[itemUrl];	
}




//gets the "pretty" html for an item tooltip via ajax
function getTipHTML(itemID, itemWithTip, mouseEvent, slotNum)
{
	//load XSL stylesheet if we haven't yet	
	if(!($.browser.opera) && !($.browser.safari)){
		if(itemToolTipXSLLoaded == false)
		{
			//get the stylesheet			
			var xslDoc = Sarissa.getDomDocument();
			xslDoc.async = false;
			xslDoc.load("/layout/item-tooltip.xsl");
			
			xsltProcessor = new XSLTProcessor();
			xsltProcessor.importStylesheet(xslDoc);		
			
			itemToolTipXSLLoaded = true;
		}
	}
	
	//get the "pretty-html" for the tooltip
	if(toolVault[itemID] == null)
	{		
		//set loading text  
		setTipText(tLoading+"...");
		setToolTipPosition(itemWithTip,mouseEvent);
		
		var urlstr = "";
		
		if(slotNum)
			urlstr = "/item-tooltip.xml?i="+itemID+"&"+theCharUrl+"&s="+slotNum;
		else
			urlstr = "/item-tooltip.xml?i="+itemID;
		
		$.ajax({
			type: "GET",
			url: urlstr,
			success: function(msg){				
				//cache the tooltip text based on browser
				if(($.browser.opera) || ($.browser.safari)){
					toolVault[itemID] = msg;
					
					if(toolVault[itemID].length <= 4)
						toolVault[itemID] = errorLoadingToolTip;
				}else{
					var bufferedDiv = document.createElement("div");
					bufferedDiv.innerHTML = "";
					bufferedDiv.appendChild(xsltProcessor.transformToFragment(msg,window.document));					
					toolVault[itemID] = bufferedDiv.innerHTML;
					
					//set error message
					if(toolVault[itemID].length <= 4)
						toolVault[itemID] = errorLoadingToolTip;					
				}
				
				//prevent showing the wrong item or an empty tooltip
				if(currItemID == itemID){					
					setTipText(toolVault[itemID]);
					setToolTipPosition(itemWithTip,mouseEvent); //set the position of the tooltip	
				}
			},
			error: function(msg){				
				setTipText(errorLoadingToolTip);
			}
		});
	}else{
		setTipText(toolVault[itemID]);
		setToolTipPosition(itemWithTip,mouseEvent); //set the position of the tooltip	
	}
}

//initialize tooltips on armory page
function bindToolTips()
{	
	//check to see if dual-tooltips are enabled
	if(getcookie2("armory.cookieDualTooltip") == 1)
		dualTipsEnabled = true;
	
	//see if we're on character sheet
	if(location.href.indexOf("character-sheet.php") != -1)
		isOnCharSheet = true;

	//store reference to the tooltip
	theGlobalToolTip = $(".globalToolTip");	
	
	//bind mouseover function for objects with class='tooltip'
	$(".staticTip").mouseover(function (e){
		
		//need ajax call for tooltip text for items
		if($(this).hasClass("itemToolTip"))
		{	
			//only show an "ajax" tooltip if the item we moused over has an ID
			if(this.id != "")
			{
				//set current item id to prevent async mixups (and clean the id)
				currItemID = cleanID(this.id);		
				
				//get the html to put in the div
				getTipHTML(currItemID, this, e,getSlotNum($(this).parent().attr("id")))
				
				//show the tooltip
				if($(theGlobalToolTip).css("display") != "block")
					$(theGlobalToolTip).show();

			}else{
				//no id means no item, character sheet items have tooltip placeholders
				if(isOnCharSheet){					
					//get id of parent (that will tell us the slot)
					setToolTipPosition(this,e);
					setTipText(getEmptySlotToolTip($(this).parent().attr("id")));
					
					$(theGlobalToolTip).show();
				}else{
					//if not on char sheet hide tip
					$(theGlobalToolTip).hide();	
				}				
			}
		}else{
			//normal tooltips (static text)
			setToolTipPosition(this,e); //set the position of the tooltip			
			$(theGlobalToolTip).show();
		}		
	});

	//mouseout event for objects with class='tooltip' (hide the tooltip)
	$(".staticTip").mouseout(function (){
		$(theGlobalToolTip).hide();	
		currItemID = null; //set itemid to null (for preventing async messups)
	});

}

//some item ids have "i=" in them, so remove it
function cleanID(itemid)
{
	if(itemid.indexOf("i=") != -1){
		itemid = itemid.substr(itemid.indexOf("i=")+2);
	}
	
	return itemid;	
}


//get the slot number based on the id (strip out _slot)
function getSlotNum(slotid)
{
	return slotid.substr(5);	
}


//get the text for an empty character sheet slot
function getEmptySlotToolTip(slotid, classId)
{
	//slotid = getSlotNum(slotid);
	
	var slottext = "";
	
	switch (slotid) {
		case "0":
			slottext = textHead;
			break;
		case "1":
			slottext = textNeck;
			break;
		case "2":
			slottext = textShoulders;
			break;
		case "3":
			slottext = textShirt;
			break;
		case "4":
			slottext = textChest;
			break;
		case "5":
			slottext = textWaist;
			break;
		case "6":
			slottext = textLegs;
			break;
		case "7":
			slottext = textFeet;
			break;
		case "8":
			slottext = textWrists;
			break;
		case "9":
			slottext = textHands;
			break;
		case "10":
		case "11":
			slottext = textFinger;
			break;
		case "12":
		case "13":
			slottext = textTrinket;
			break;
		case "14":
			slottext = textBack;
			break;
		case "15":
			slottext = textMainHand;
			break;
		case "16":
			slottext = textOffHand;
			break;
		case "17":
			if((classId == 6) || (classId == 11) || (classId == 2) || (classId == 7))
				slottext = textRelic;
			else
				slottext = textRanged;
			break;
		case "18":
			slottext = textTabard;
			break;
	}
	
	return slottext;	
}