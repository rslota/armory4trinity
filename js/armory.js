/*****************************************************
 * Master Armory Javascript File
 * Copyright (c) 2008 Blizzard Entertainment
 * !!! Requires jQuery  !!!
 * !!! Requires Sarissa !!!
 *****************************************************/

//GLOBAL VARS
var searchTimerId		= null; //timer id for search menu hiding
var IS_ENABLED_XSLT		= $.browser.mozilla; //is xslt enabled
var region				= ""; //for determining region
var region			= ""; //region

function initializeArmory(){

	//binds
	bindDropDownMenu();
	bindLanguageLinks();
	
	//only bind bookmark menu if they are logged in
	if(isLoggedIn)
		bindBookmarkMenu();
	else		
		bindLoginLink();

	//always bind tooltips last
	bindToolTips();

	//ads are dead last so we don't wait for them
	initializeAds();
}

function initializeAds()
{
	var randomNum = Math.round(Math.random() * 100000000);
	if (!pageNum) var pageNum = Math.round(Math.random() * 100000000);

	//ad source vars
	var longAdiFrameSrc = "";
	var longAdjsSrc		= "";
	var boxAdiFrameSrc  = "";
	var boxAdjsSrc 		= "";

	if(!isHomepage){
		longAdiFrameSrc	 = 'http://cgm.adbureau.net/hserver/acc_random='+randomNum+
							'/SITE=WOW.ARMORY.COM/AREA=NETWORK/AAMSZ=728X90/pageid='+pageNum;
		longAdjsSrc		 = 'http://cgm.adbureau.net/jnserver/acc_random='+randomNum+
						   '/SITE=WOW.ARMORY.COM/AREA=NETWORK/AAMSZ=728X90/pageid='+pageNum;
						   
		boxAdiFrameSrc	 = 'http://cgm.adbureau.net/hserver/acc_random='+randomNum+
						   '/SITE=WOW.ARMORY.COM/AREA=NETWORK/AAMSZ=300X250/pageid='+pageNum;
		boxAdjsSrc		 = 'http://cgm.adbureau.net/jnserver/acc_random='+randomNum+
						   '/SITE=WOW.ARMORY.COM/AREA=NETWORK/AAMSZ=300X250/pageid='+pageNum;

		//top, long ad
		$("#ad_728x90").html('<iframe width="728" height="90" marginwidth="0" marginheight="0" ' + 
			'src="'+longAdiFrameSrc+'" frameborder="0" scrolling="no">'+
			'<script type="text/javacript" '+
			'src="'+longAdjsSrc+'"></script>'+				
			'</iframe>');	
		
	}else{
		boxAdiFrameSrc	 = 'http://cgm.adbureau.net/hserver/acc_random='+randomNum+
						   '/SITE=WOW.ARMORY.COM.HOME/AREA=NETWORK/AAMSZ=300X250/pageid='+pageNum;
		boxAdjsSrc		 = 'http://cgm.adbureau.net/jnserver/acc_random='+randomNum+
						   '/SITE=WOW.ARMORY.COM.HOME/AREA=NETWORK/AAMSZ=300X250/pageid='+pageNum;
	}
		
	//region specific ads
	if(region == "KR"){
		if(!isHomepage){
			longAdiFrameSrc = "http://gamead.smartad.co.kr/NMR?VNHTML&MN3&SN3&PN6&TN10&DNgamead.smartad.co.kr"; //iframe source
			longAdjsSrc		= "http://gamead.smartad.co.kr/NMR?VNJS&MN3&SN3&PN6&TN10&DNgamead.smartad.co.kr"; //script source 
			boxAdiFrameSrc  = "http://gamead.smartad.co.kr/NMR?VNHTML&MN3&SN3&PN6&TN9&DNgamead.smartad.co.kr"; //iframe source
			boxAdjsSrc		= "http://gamead.smartad.co.kr/NMR?VNJS&MN3&SN3&PN6&TN9&DNgamead.smartad.co.kr"; //script source

			//top, long ad
			$("#ad_728x90").html('<iframe width="728" height="90" marginwidth="0" marginheight="0" ' + 
				'src="'+longAdiFrameSrc+'" frameborder="0" scrolling="no">'+
				'<script type="text/javacript" '+
				'src="'+longAdjsSrc+'"></script>'+
				'</iframe>');			
		}else{
			boxAdiFrameSrc  = "http://gamead.smartad.co.kr/NMR?VNHTML&MN3&SN3&PN5&TN8&DNgamead.smartad.co.kr"; //iframe source
			boxAdjsSrc		= "http://gamead.smartad.co.kr/NMR?VNJS&MN3&SN3&PN5&TN8&DNgamead.smartad.co.kr"; //script source
		}		
	}

	//middle box ad
	$("#ad_300x250").html('<iframe width="300" height="250" marginwidth="0" marginheight="0" ' + 
		'src="'+boxAdiFrameSrc+'" frameborder="0" scrolling="no">'+
		'<script type="text/javascript" '+
		'src="'+boxAdjsSrc+'"></script>'+
		'</iframe>');

}

//begin UTF8
var Utf8 = {
    // public method for url encoding
    encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";
		var sLength = string.length;

        for (var n = 0; n < sLength; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // public method for url decoding
    decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;
		var textLength = utftext.length;
        while ( i <  textLength) {
            c = utftext.charCodeAt(i);
            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}
//end UTF8








var pathnameParse=document.location.href.split(window.location.protocol + "//")[1].split("/")[1];
var hashParse=pathnameParse.split("#")[1];
pathnameParse=pathnameParse.split("#")[0];

//if a hash url is present but this is not an XSLT enabled browser, interpret the hash and send the browser to the correct page
if(!IS_ENABLED_XSLT && hashParse && hashParse.indexOf(".xml")>-1){
	document.location.hash="";
	document.location=hashParse;
}

if(IS_ENABLED_XSLT && Browser.ie){

	if(!pathnameParse && !hashParse){//if url path is blank
		setcookie("currentPage","index.xml","session");
		setcookie("historyStorage","","session")
		document.location.href=document.location.href+'?';
	}

}


function PageQuery(q) {
	// we want to store everything to the right of the ? in a key value pair array
	var qSplit = q.split("?");

	if (qSplit.length > 1)
		this.q = qSplit[qSplit.length - 1];    // use the right-most element since there may be ? chars in a hash
	else
		this.q = null;

	this.keyValuePairs = new Array();

	if(this.q) {
		for(var i=0; i < this.q.split("&").length; i++) {
			this.keyValuePairs[i] = this.q.split("&")[i];
		}
	}


        this.getKeyValuePairs = function() { return this.keyValuePairs; }

        this.getValue = function(s) {
            for(var j=0; j < this.keyValuePairs.length; j++) {
                if(this.keyValuePairs[j].split("=")[0] == s)
                    return this.keyValuePairs[j].split("=")[1];
            }
            return false;
        }

        this.getParameters = function() {
            var a = new Array(this.getLength());
            for(var j=0; j < this.keyValuePairs.length; j++) {
                a[j] = this.keyValuePairs[j].split("=")[0];
            }
            return a;
        }
        this.getLength = function() { return this.keyValuePairs.length; }
   }

    function queryString(key, defaultValue){
        // try extracting query params from a hash first
        //alert('window.location.hash = ' + window.location.hash);


		var theHash;
		var pageHash;
		var queryValueHash

		if(IS_ENABLED_XSLT && !window.location.search){
			if(Browser.ie6)
				theHash = window.location.href.split('#')[1];
			else
				theHash = window.location.hash;

			if(!theHash)
				theHash = window.historyStorage.getCurrentPage();


			pageHash = new PageQuery(theHash);
			queryValueHash = pageHash.getValue(key);

		}

        if (queryValueHash) {
            return (decodeURI(queryValueHash));
        } else {
            // there weren't any query params in the hash so try again without the hash
            var page = new PageQuery(window.location.search);
            var queryValue = page.getValue(key);
            //alert("window.location.search = " + window.location.search);
			//alert("failed to get value for hash key = " + key + ", non-hash value = " + queryValue);

            if (queryValue)
			    return (decodeURI(queryValue));
            else
                return defaultValue;
        }
    }

    function setSelectIndexToValue(selectObject, optionValue) {
        if ((selectObject != "") && (optionValue != "") && (selectObject.selectedIndex > -1) && (selectObject[selectObject.selectedIndex].value != optionValue)) {
            var newIndex = 0;
			var objectLength = selectObject.length;
            for (var i = 0; i < objectLength; i++) {
                if (selectObject[i].value == optionValue) {
                    newIndex = i;
                    break;
                }
            }
            selectObject.selectedIndex = newIndex;
        }
     }

    function appendUrlParam(source, paramName, paramValue) {
        var result = "";
        if (source != "")
            result = source + '&';
        result = result + paramName + "=" + encodeURI(paramValue);
        return result;
    }

    function appendUrlMapParam(source, mapName, paramName, paramValue) {
        var result = "";
        if (source != "")
            result = source + '&';
        result = result + mapName + "[" + paramName + "]=" + encodeURI(paramValue);
        return result;
    }

    function insertUrlParam(source, paramName, paramValue) {
        var tempUrl = "";
        var anchorArray = source.split("#");
        var queryArray = anchorArray[0].split("?");
        tempUrl = queryArray[0] + "?";
        if (queryArray.length > 1)
           tempUrl = tempUrl + queryArray[1] + "&";
        tempUrl = tempUrl + paramName + "=" + escape(paramValue);
        if (anchorArray.length > 1)
           tempUrl = tempUrl + "#" + anchorArray[1];
        return tempUrl;
    }



    var armoryJSLoaded=1;


//begin cookies section
function getexpirydate(nodays){
	var UTCstring;
	Today = new Date();
	nomilli=Date.parse(Today);
	Today.setTime(nomilli+nodays*24*60*60*1000);
	UTCstring = Today.toUTCString();
	return UTCstring;
}

function getcookie2(cookiename) {
	 var cookiestring=""+document.cookie;

	 var index1=cookiestring.indexOf(cookiename);
		if (index1 == -1 || cookiename == "") return "";
	 var index2=cookiestring.indexOf(';',index1);
		if (index2 == -1) index2 = cookiestring.length;
	 return unescape(cookiestring.substring(index1+cookiename.length+1,index2));
}
function setcookie(name,value,expire){
	var expireString="EXPIRES="+ getexpirydate(365)+";"
	if(expire=="session")
		expireString="";
	cookiestring=name+"="+escape(value)+";"+expireString+"PATH=/";
	document.cookie=cookiestring;
}

// this deletes the cookie when called
function deletecookie( name, path, domain ) {
if ( getcookie2( name ) ) document.cookie = name + "=" +
( ( path ) ? ";path=" + path : "") +
( ( domain ) ? ";domain=" + domain : "" ) +
";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}
//end cookies section





function truncateString (theString, maxChars) {
		
	if (theString.length > maxChars && maxChars)
		return theString.substring(0, maxChars - 3) + "...";
	else
		return theString;
}

function sortNumberRightAs(a, b) {
	a = a[0][0] + a[1];
	b = b[0][0] + b[1];
	return a == b ? 0 : (a < b ? -1 : 1)
}

function selectLang(theDisplay, cookieValue) {
	document.getElementById("dropdownHiddenLang").style.display = "none";
	document.getElementById("displayLang").innerHTML = theDisplay;
	setcookie("cookieLangId", cookieValue);
	document.location.reload();
}

 var Url = {

     // public method for url encoding
     encode : function (string) {
         return escape(this._utf8_encode(string));
     },

     // public method for url decoding
     decode : function (string) {
         return this._utf8_decode(unescape(string));
     },

     // private method for UTF-8 encoding
     _utf8_encode : function (string) {
         string = string.replace(/\r\n/g,"\n");
         var utftext = "";

         for (var n = 0; n < string.length; n++) {

             var c = string.charCodeAt(n);

             if (c < 128) {
                 utftext += String.fromCharCode(c);
             }
             else if((c > 127) && (c < 2048)) {
                 utftext += String.fromCharCode((c >> 6) | 192);
                 utftext += String.fromCharCode((c & 63) | 128);
             }
             else {
                 utftext += String.fromCharCode((c >> 12) | 224);
                 utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                 utftext += String.fromCharCode((c & 63) | 128);
             }

         }

         return utftext;
     },

     // private method for UTF-8 decoding
     _utf8_decode : function (utftext) {
         var string = "";
         var i = 0;
         var c = c1 = c2 = 0;

         while ( i < utftext.length ) {

             c = utftext.charCodeAt(i);

             if (c < 128) {
                 string += String.fromCharCode(c);
                 i++;
             }
             else if((c > 191) && (c < 224)) {
                 c2 = utftext.charCodeAt(i+1);
                 string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                 i += 2;
             }
             else {
                 c2 = utftext.charCodeAt(i+1);
                 c3 = utftext.charCodeAt(i+2);
                 string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                 i += 3;
             }

         }

         return string;
     }

 }



function addEvent(obj, evType, fn) {

    if (obj.addEventListener) {

        obj.addEventListener(evType, fn, false);
        return true;
    } else if (obj.attachEvent) {

        var r = obj.attachEvent("on"+evType, fn);
        return r;
    } else {

        return false;
    }
}

//flash detection
var MM_contentVersion = 8;
var plugin = (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
if ( plugin ) {
        var words = navigator.plugins["Shockwave Flash"].description.split(" ");
		var wordsLength = words.length;
        for (var i = 0; i < wordsLength; ++i)
        {
        if (isNaN(parseInt(words[i])))
        continue;
        var MM_PluginVersion = words[i];
        }
    var MM_FlashCanPlay = MM_PluginVersion >= MM_contentVersion;
}
else if (navigator.userAgent && navigator.userAgent.indexOf("MSIE")>=0
   && (navigator.appVersion.indexOf("Win") != -1)) {
    document.write('<SCR' + 'IPT LANGUAGE=VBScript\> \n'); //FS hide this from IE4.5 Mac by splitting the tag
    document.write('on error resume next \n');
    document.write('MM_FlashCanPlay = ( IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & MM_contentVersion)))\n');
    document.write('</SCR' + 'IPT\> \n');
}

var flashString;
var tempObj;
var flashCount=1;
//printFlash uses innerHTML to render flash objs to get around the IE flash rendering issue
function printFlash(id, src, wmode, menu, bgcolor, width, height, quality, base, flashvars, noflash){


	
    if(MM_FlashCanPlay){

        flashString = '<object id= "' + id + 'Flash" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + width + '" height="' + height + '"><param name="movie" value="' + src + '"></param><param name="quality" value="' + quality + '"></param>';
        if(base){
			flashString+='<param name="base" value="' + base + '"/>';
        }

        

		if(menu == ""){
			flashString+='<param name="flashvars" value="' + flashvars + '"></param><param name="bgcolor" value="' + bgcolor + '"></param></param><param name="wmode" value="' + wmode + '"></param><param name="salign" value="tl"></param><embed name= "' + id + 'Flash" src="' + src + '" wmode="' + wmode + '" menu="' + menu + '" bgcolor="' + bgcolor + '" width="' + width + '" height="' + height + '" quality="' + quality + '" pluginspage="http://www.macromedia.com/go/getflas/new-hplayer" type="application/x-shockwave-flash" salign="tl" base="' + base + '" flashvars="' + flashvars + '" /></object>';			
		}else{
			flashString+='<param name="flashvars" value="' + flashvars + '"></param><param name="bgcolor" value="' + bgcolor + '"></param><param name="menu" value="' + menu + '"></param><param name="wmode" value="' + wmode + '"></param><param name="salign" value="tl"></param><embed name= "' + id + 'Flash" src="' + src + '" wmode="' + wmode + '" menu="' + menu + '" bgcolor="' + bgcolor + '" width="' + width + '" height="' + height + '" quality="' + quality + '" pluginspage="http://www.macromedia.com/go/getflas/new-hplayer" type="application/x-shockwave-flash" salign="tl" base="' + base + '" flashvars="' + flashvars + '" /></object>';	
		}

    }else{
        flashString = noflash;
    }

    if((id == "loader") && (!Browser.moz)){
        flashString = noflash;
	}
	


	 
	
	
	document.getElementById(id).innerHTML = flashString;
	document.getElementById(id).style.display = "block";
	
	
}


function hideTip() {

}




var resultsSideState="middle";

function resultsSideRight(){
    if(resultsSideState=="middle"){
        document.getElementById("results-side-switch").className = "results-side-collapsed";
        resultsSideState="right";
    }
}

function resultsSideLeft(redirectUrl){
    if(resultsSideState=="right"){
        document.getElementById("results-side-switch").className = "results-side-expanded";
        resultsSideState="middle";
    } else {
        if (redirectUrl) {
			window.location.href = redirectUrl;
        }
    }
}



function thisMovie(movieName) {
  // IE and Netscape refer to the movie object differently.
  // This function returns the appropriate syntax depending on the browser.
  if (navigator.appName.indexOf ("Microsoft") !=-1) {
    return window[movieName]
  } else {
    return document[movieName]
  }
}

function popIconLarge(movieName,mcName) {
    if(MM_FlashCanPlay){
        try {
            if(Browser.ie)
                try {thisMovie(movieName).TGotoFrame(mcName,1);}catch(e){throw e;}
            else if(!Browser.opera && thisMovie(movieName) && thisMovie(movieName).TGotoFrame) //exclude opera
                    thisMovie(movieName).TGotoFrame(mcName,1);
        }catch(e){
            throw e;
        }
    }
}

function popIconSmall(movieName,mcName) {
    if(MM_FlashCanPlay){
        try {
            if(Browser.ie)
                try {thisMovie(movieName).TGotoFrame(mcName,2);}catch(e){throw e;}
            else
                if(!Browser.opera && thisMovie(movieName) && thisMovie(movieName).TGotoFrame) //exclude opera
                    thisMovie(movieName).TGotoFrame(mcName,2);
        }catch(e){
            throw e;
        }
    }
}

var currentFaq=1;

function faqSwitch(faqId){

	$("#faqlink"+currentFaq).attr("class","faq-off");
	$("#faqlink"+faqId).attr("class","faq-over");

    
    currentFaq = faqId;
	
    $('#faq-container').html($("#faq"+faqId).html());
}


var pageChangerXsltProcessor;

function initXsltProcessor(xsltProc, xslUrl) {
    var xslDoc = Sarissa.getDomDocument();
    xslDoc.async = true;
    if(Browser.ie)
        xslDoc.async = false;
    xslDoc.load(xslUrl);
    xsltProc.importStylesheet(xslDoc);
}


function xmlDataLoadSarissa(xmlSource, xslSource, container){

    pageChangerXsltProcessor = new XSLTProcessor();
    initXsltProcessor(pageChangerXsltProcessor, xslSource);

    //code added to apend the language of the xml request.  Use to fight rouge caching.
    if(xmlSource.indexOf('?')==-1)
        xmlSource+='?';

    xmlSource+="&lang="+getcookie2("cookieLangId");

    fetchXmlData(xmlSource, container, pageChangerXsltProcessor);
    //move the search box if it's the index
    var urlSplit = xmlSource.split('?');
    var xmlName = urlSplit[0].split('.')[0];
    if(xmlName.indexOf("index")>-1 && !document.location.hash)
        document.getElementById('indexChange1').className="home";
    else
        document.getElementById('indexChange1').className="other";
}

var ajaxOverride=false;


      /** Our callback to receive history change
          events. */
    var historyChangeBool=0;

function historyChange(newLocation)
{

	if((!historyChangeBool && window.historyStorage.getCurrentPage() == parseXMLurl(document.location.href).escapeUrl) || (!document.location.hash && historyChangeBool==1) || (window.historyStorage.getCurrentPage()=="index.xml")){
		//DO NOTHING
	}else{
		if(!newLocation)
			newLocation=window.historyStorage.getCurrentPage();
		var urlObj=parseXMLurl(newLocation);
		window.historyStorage.setCurrentPage(urlObj.url);
		xmlDataLoadSarissa(newLocation,urlObj.xsl,'dataElement')
	}
}

function parseXMLurl(xmlUrl, xslUrl, escapeBool){



    if(xmlUrl.lastIndexOf('/')>=0)
        xmlUrl=xmlUrl.substring(xmlUrl.lastIndexOf('/')+1,xmlUrl.length)

    var urlSplit = xmlUrl.split('?');

    xmlUrl = urlSplit[0];
    xml = xmlUrl;

    if (xslUrl) {
        xsl = xslUrl;
    } else {
        xsl = 'layout/' + xml.split('.')[0] + '-ajax.xsl';
    }
    query = urlSplit[1];

    var pageObject = new Object();
    pageObject.xml = xml;
    pageObject.xsl = xsl;
    pageObject.query=query;
    pageObject.url = xml;
    if(query)pageObject.url+="?"+query;

    pageObject.escapeUrl=xml;
    pageObject.escapeQuery="";

    if (query){

		var queryConstructor = new PageQuery("?"+query);
		var queryParams = queryConstructor.getParameters();
		var queryParamsLength = queryParams.length;
		for(i=0; i<queryParamsLength; i++){
			if(Browser.ie || escapeBool || Browser.opera)
				pageObject.escapeQuery +=  queryParams[i] + "=" + encodeURI(Utf8.decode(queryConstructor.getValue(queryParams[i])));
			else{
				pageObject.escapeQuery +=  queryParams[i] + "=" + encodeURI(queryConstructor.getValue(queryParams[i]));
			}

			if(i!=queryParams.length-1)
				pageObject.escapeQuery += "&";

		}
		pageObject.escapeQuery = pageObject.escapeQuery.replace("'","%27");//escape single quote
		pageObject.escapeQuery = pageObject.escapeQuery.replace("%25","%");
		pageObject.escapeQuery = pageObject.escapeQuery.replace("%20","+");
		pageObject.escapeUrl += "?" + pageObject.escapeQuery;

    }
    return pageObject;
}

//initialize current page cookie and call DHTML init on page load
if(IS_ENABLED_XSLT){

	if(!hashParse){
		var urlObj=parseXMLurl(document.location.href);
		setcookie("currentPage",urlObj.escapeUrl,"session");
	}
}

//function which takes xml, xsl, and query params and transforms them into a format the dhtml history library can understand
function addHistory(url){
    dhtmlHistory.add(url,"a");
    window.historyStorage.setCurrentPage(url);
}

function ajaxLink(xmlUrl, xslUrl, appendRandomNumber){

	if (Browser.safari && region == "TW") {
		theUrl = xmlUrl;
		theUrl = encodeURI(theUrl);
	    window.location.href = theUrl;
	} else if (!Browser.moz && region == "TW") {
		theUrl = Url.decode(xmlUrl);
		theUrl = encodeURI(theUrl);
	    window.location.href = theUrl;
	} else if (Browser.safari && region == "KR") {
		theUrl = xmlUrl;
		theUrl = encodeURI(theUrl);
	    window.location.href = theUrl;
	} else if (!Browser.moz && region == "KR") {
		theUrl = Url.decode(xmlUrl);
		theUrl = encodeURI(theUrl);
	    window.location.href = theUrl;
	} else
	    window.location.href = xmlUrl;
}

var ajaxXmlUrl;
var ajaxDataElementName;
var ajaxXsltProcessor;

function fetchXmlData(xmlUrl, dataElementName, xsltProcessor) {
    historyChangeBool=1;
    ajaxXmlUrl = xmlUrl;
    ajaxDataElementName = dataElementName;
    ajaxXsltProcessor = xsltProcessor;
    window.setTimeout("fetchXmlData2()",50);
}

function fetchXmlData2() {

    if (!IS_ENABLED_XSLT) {
        window.location.replace(ajaxXmlUrl);
        return;
    }
	isItems = 0;
	isArenaTeams = 0;
    updateDataContent(ajaxXmlUrl, document.getElementById(ajaxDataElementName), ajaxXsltProcessor);

}

function ieFix(){
    var tempDiv = document.createElement("div");
    tempDiv.style.position="absolute";
    tempDiv.style.top="-100px";
    document.body.appendChild(tempDiv);
}

var head;
var numHeadNodes=0;

function initHead(){
    head = document.getElementsByTagName("head");
    numHeadNodes = head[0].childNodes.length;
}
addEvent(window, 'load', initHead);

var jsLoaded=true;
var jsLoadCount=1;
var tempString;
var jsArrayLength;

function checkJSLoad(){
    while(jsLoadCount<jsArrayLength && jsLoaded){
        scriptString=tempArray[jsLoadCount].split('</SCRIPT>')[0];
        theSrc="";
        theScript="";
        srcStartLoc=scriptString.substring(0,6).indexOf(" src=");//look for a src attribute in the script tag within the first 7 characters
        scriptTagEndLoc=scriptString.indexOf(" type=text/javascript>");

        if(srcStartLoc!=-1)
            theSrc=scriptString.substring(srcStartLoc+6,scriptTagEndLoc-1)

        theScript=scriptString.substring(scriptTagEndLoc+22,scriptString.length);

        script = document.createElement("script");
        head[0].appendChild(script);

        if(theSrc)jsLoaded=false;

        script.type = "text/javascript";
        if(theSrc)script.src = theSrc;
        if(theScript)script.text = theScript;

        jsLoadCount++;

        if(theSrc)
            return false;

    }

    if(jsLoadCount>=jsArrayLength){
        jsLoaded=true;
        jsLoadCount=1;
        clearInterval(checkLoadInterval)
    }

}

var checkLoadInterval = 0;

function updateDataContent(sFromUrl, oTargetElement, xsltproc) {
    try {
        oTargetElement.style.cursor = "wait";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", sFromUrl, true);
        function sarissa_dhtml_loadHandler() {
            if (xmlhttp.readyState == 4) {
                oTargetElement.style.cursor = "auto";
                if (xmlhttp.responseXML != null) {
                    var procer = xsltproc;
                    if(Browser.ie){
                        //purge any scripts that have been loaded into Head via ajax
                        while(numHeadNodes!=head[0].childNodes.length)
                            head[0].removeChild(head[0].lastChild)
                    }

                    var newFrag = procer.transformToFragment(xmlhttp.responseXML,window.document);
                    oTargetElement.innerHTML="";
                    oTargetElement.appendChild(newFrag);
                    if(Browser.ie){
                        //load any new embedded stylesheets into head
                        embeddedStyles=oTargetElement.getElementsByTagName("link");
						embeddedStylesLength = embeddedStyles.length;
                        for(count=0;count<embeddedStylesLength;count++){
                                embeddedStyle = document.createElement("link");
                                head[0].appendChild(embeddedStyle);
                                embeddedStyle.type = embeddedStyles[count].type
                                embeddedStyle.rel = embeddedStyles[count].rel;
                                embeddedStyle.href = embeddedStyles[count].href;
                                embeddedStyle.media = embeddedStyles[count].media;
                        }

                        tempString=document.getElementById("dataElement").innerHTML;
                        tempArray=tempString.split('<SCRIPT');
                        jsArrayLength=tempArray.length;

                        window.setTimeout("ieFix()",100)
                        checkLoadInterval=window.setInterval("checkJSLoad()",100)
                    } else {
                       // rePosition(); //reposition menu after contents change
                    }
                }
            }
        }
        xmlhttp.onreadystatechange = sarissa_dhtml_loadHandler;
        xmlhttp.send(null);
        oTargetElement.style.cursor = "auto";
    } catch(e) {
        oTargetElement.style.cursor = "auto";
        throw e;
    }
}

function arenaLadderLink(battlegroup, teamSize, misc) {

	var url;

	if(!battlegroup)
	{
		var cook = getcookie2(misc == 'tournament' ? 'tournament-arena-battlegroup' : 'default-arena-battlegroup');
		if(cook && cook.length)
			battlegroup = cook;
	}
	
	if(battlegroup) {
		url = '/arena-ladder.xml?b=' + urlEncode(battlegroup) + '&ts=' + teamSize;
	} else {
		url = '/battlegroups.xml';
	}
	
	location.href = url;
}

function goToPropass() {

	arenaLadderLink(null, 3, 'tournament');
}

function guildLink() {
   window.location.href = guildUrl;
}

function forumLink(forumName,lang)
{
	switch(region)
	{
		case "US": window.location.href = "http://forums.worldofwarcraft.com/board.html?forumName="+escape(forumName); break;
		case "EU": window.location.href = "http://forums.wow-europe.com/board.html?forumName="+escape(forumName); break;
		case "KR": window.location.href = "http://www.worldofwarcraft.co.kr/community/forum/index.html"; break;
		case "TW": window.location.href = "http://forum.wowtaiwan.com.tw/twow_forums_page1.asp"; break;
		case "CN": window.location.href = "http://bbs.wowchina.com/"; break;
		default: break;
	}
}

//end functions section

//start searchbox

function menuCheckLength(formReference){
	if((formReference.searchQuery.value).length <= 1){
		$('#'+formReference.name + '_errorSearchLength').html('<div class="error-container2">'+
			'<div class="error-message">'+
			'<p></p>Search must be at least 2 characters long.</div></div>');
		return false;
	}
    formReference.submit();
}


//shows the search options menu and sets a timeout


//resets the search box at the top of the page
function resetSearch()
{
	//remove class and value
	$("#armorySearch").removeClass();
	$("#armorySearch").val("");

	//hide the dropdown menu
	$('#searchCat').hide();
	$('#searchOptions').css('background-position','')
}
//end searchbox


// Guild Banks login window
function displayNone(whichBlock) {
	document.getElementById(whichBlock).style.display='none';
}

function changeBlock(whichBlock) {
	document.getElementById(whichBlock).style.display='block';
}

//sets the icons on the character sheet
function setCharSheetIcons()
{
	//go through each image with class "charSheetImg" and set its bg
	$(".charSheetImg").each(function(){
		if(this.id != "")	$(this).css("background-image","url('/wow-icons/_images/51x51/"+this.id+".jpg')");
		else				$(this).attr("src","images/pixel.gif");
	});
}

//function to set the links to items
function setCharSheetLinks()
{
	//go through each link with class "itemToolTip" (and "staticTip") and set link
	$("a.itemToolTip").each(function(){
		if($(this).hasClass("staticTip")){
			if(this.id !="")	$(this).attr("href","item-info.xml?i="+this.id);
			else				$(this).attr("href","javascript:void(0)");
		}
	});
}


//transforms the #nav ul set into a drop down menu
function bindDropDownMenu()
{
	$("#nav ul").css({display: "none"}); //fix for opera
	$("#nav li").hover(
		function(){
			//mouseover actions
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
			$(this).children("a:first").attr("style", "background-color: #101615; color: #FFF");
			$(this).children("span:first").attr("style", "background-color: #101615;font-weight:bold;cursor:pointer;color:#FFF;");

			if(($.browser.msie) && ($.browser.version == "6.0")){
				$("select").hide();
			}

		},
		function(){
			//mouseout actions
			$(this).find('ul:first').css({visibility: "hidden"});
			$(this).children("a:first").removeAttr("style"); //clear the added style
			$(this).children("span:first").removeAttr("style"); //clear the added style

			if(($.browser.msie) && ($.browser.version == "6.0")){
				$("select").show();
			}

		});
}


//creates the "find upgrade" flyout menu on character sheet
function setCharSheetUpgradeMenu()
{
	
	//**************************************************************
	// Custom CSS for menu depending on location on char sheet
	// NOTE: "Combining" common functionality causes issues in ie7
	//**************************************************************
	//mouseout/mouseover on the "find upgrade" flyout menu
	$(".leftItems .fly-horz").hover(
		function(){
			//mouseover actions
			$(this).prev().attr("style", "background-position: -3px 0px");
			$(this).css("display","block");
		},
		function(){
			//mouseout actions
			$(this).prev().attr("style", "");
			$(this).css("display","none");
		});

	$(".rightItems .fly-horz").hover(
		function(){
			//mouseover actions
			$(this).prev().attr("style", "background-position: -75px 0");
			$(this).css("display","block");
		},
		function(){
			//mouseout actions
			$(this).prev().attr("style", "");
			$(this).css("display","none");
		});
	$(".bottomItems .fly-horz").hover(
		function(){
			//mouseover actions
			$(this).prev().attr("style", "background-position: 5px -75px");
			$(this).css("display","block");
		},
		function(){
			//mouseout actions
			$(this).prev().attr("style", "");
			$(this).css("display","none");
		});

	

	$(".upgradeBox").hover(
		function(){
			//mouseover actions		
			$(this).parent().next().css("display","block");			
		},
		function(){
			//mouseout actions
			$(this).parent().next().css("display","none");			
		});

}


//appends appropriate parameters to the links that change the languages
function bindLanguageLinks()
{
	$("#languageFooter .langLink").each(function(){
		var currLink	 = location.href; //current url
		var theLangHref  = $(this).attr("href"); //current language href

		//look for parameters
		if(currLink.indexOf("?") != -1){
			//single out params
			currLink = currLink.substr(currLink.indexOf("?") + 1);

			//check if the language href already has parameters
			if(theLangHref.indexOf("?") == -1)
				$(this).attr("href", $(this).attr("href") + "?"+currLink);
			else
				$(this).attr("href", $(this).attr("href") + "&"+currLink);
		}
	});
}

//appends appropriate parameters to the login link
function bindLoginLink()
{
	var currLink = location.href; //current url

	//check if the current page already has parameters
	if(currLink.indexOf("?") == -1){
		$("#loginLinkRedirect").attr("href", currLink + "?login=1");
		$("#bmcLink").attr("href", currLink + "?login=1");
	}else{
		$("#loginLinkRedirect").attr("href", currLink + "&login=1");
		$("#bmcLink").attr("href", currLink + "&login=1");
	}
}

if(!this['L10n'])
	L10n = {};

// uses printf from common.js
// operates on timestamps that are a subset of the XML Schema date-time production
L10n.formatTimestamps = function(domQuery, formatConfig) {
	var datePartRegex = /([\d]{4})-([\d]{2})-([\d]{2})(?:T([\d]{2}):([\d]{2}):([\d]{2})(?:([+-])([\d]{2}):([\d]{2}))?)?/;
	var curTime = (new Date()).getTime();

	$(domQuery).each(function(i) {
		var node = $(this);
		var p = datePartRegex.exec(node.text());
		var d = new Date(Date.UTC(p[1], p[2] - 1, p[3], p[4], p[5], p[6]));

		if(p[8] || p[9])
			d.setUTCMilliseconds((p[8] * 3600000 + p[9] * 60000) * (p[7] == "-" ? 1 : -1));

		var timeDiff = curTime - d.getTime();
		var formattedDate = "";

		if(timeDiff < 172800000 && timeDiff >=0 ) { // within 2 days in the past
			if(timeDiff < 86400000) { // 1 day
				var units, format;

				if(timeDiff < 3600000) { // 1 hour
					units = Math.round(timeDiff / 60000); // minutes
					format = units == 1 ? (formatConfig.withinHourSingular || formatConfig.withinHour) : formatConfig.withinHour;
				} else {
					units = Math.round(timeDiff / 3600000); // hours
					format = units == 1 ? (formatConfig.withinDaySingular || formatConfig.withinDay) : formatConfig.withinDay;
				}
				formattedDate = printf(formatConfig.today, printf(format, units));
			} else {
				formattedDate = formatConfig.yesterday;
			}
		} else {
			formattedDate = formatConfig.date.replace(/([a-zA-Z]+)/g, function(token) {
				switch(token) {
				case "yyyy":
					return d.getFullYear();
				case "M":
					return d.getMonth() + 1;
				case "d":
					return d.getDate();
				default:
					return "?";
				}
			});
		}

		node.text(formattedDate);
		node.show();
	});
}

function urlEncode(value) {
	return encodeURIComponent(value).replace(/%20/g, '+');
}