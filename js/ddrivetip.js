var offsetxpoint=10 //Customize x offset of tooltip
var offsetypoint=-10 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)

var tooltipStart='<table class="tooltip-table" cellspacing="0" cellpadding="0" style="max-width:500px;"><tr><td class="tooltip-tl tooltip-corner"><img src="images/spacer.gif" width="1" height="1"></td><td class="tooltip-top content-top"><img src="images/spacer.gif" width="1" height="1"></td><td class="tooltip-tr tooltip-corner"><img src="css/images/spacer.gif" width="1" height="1"></td></tr><tr><td class="tooltip-left tooltip-corner"><img src="images/spacer.gif" width="1" height="1"></td><td class="tooltip-content" style="max-width:500px;">'
var tooltipEnd='</td><td class="tooltip-right tooltip-corner"><img src="css/images/spacer.gif" width="1" height="1"></td></tr><tr><td class="tooltip-bl tooltip-corner"><img src="css/images/spacer.gif" width="1" height="1"></td><td class="tooltip-bottom content-top"><img src="css/images/spacer.gif" width="1" height="1"></td><td class="tooltip-br tooltip-corner"><img src="css/images/spacer.gif" width="1" height="1"></td></tr></table>'
function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function tooltip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor

tipobj.innerHTML=tooltipStart + thetext + tooltipEnd
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20
var screenheight = ie&&!window.opera? ietruebody().clientHeight : window.innerHeight
var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000
var topedge = -10

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"

tipobj.style.visibility="visible"


tipobj.style.visibility="visible"
}
}

function tooltip_hide(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip
