<body onLoad="load__()">
<div id="loading-box" style="display: none;"></div>
<div id="dhtmltooltip"></div>
<script src="js/dhtmlHistory.js" tppabs="http://www.wowarmory.com/js/dhtmlHistory.js" type="text/javascript"></script><script src="js/_lang/en_us/strings.js" tppabs="http://www.wowarmory.com/js/_lang/en_us/strings.js" type="text/javascript"></script><script type="text/javascript">global_nav_lang = 'en_us'</script>

<noscript><div class="noscript-bg" style="z-index:10000;"><span style="z-index:10001;color:#FFF;left:20%;font-size:36px;top:40%;position:absolute;">Please enable JavaScript in your browser.</span></div></noscript>
<form id="historyStorageForm" method="GET">
<textarea id="historyStorageField" name="historyStorageField"></textarea>
</form>
<div class="outer-container">
<div class="inner-container">
<div class="int-top">
<div class="logo">
<a href="index.php"><span>The World of Warcraft Armory</span></a>
</div>

</div>
<div class="int">
<div class="search-bar">
<div class="module">
<div class="search-container">
<div class="search-module">
<em class="search-icon"></em>
<form action="search.php " method="get" name="formSearch" onSubmit="javascript: return menuCheckLength(document.formSearch);">
<input id="armorySearch" maxlength="72" name="searchQuery" size="16" type="text" value=""><a class="submit" href="javascript:void(0);" onclick="javascript: return menuCheckLength(document.formSearch);"><span>Search</span></a>
<div id="errorSearchType"></div>
<div id="formSearch_errorSearchLength" onmouseover="javascript: this.innerHTML = '';"></div>
<input name="searchType" type="hidden" value="all">
</form>
{$menu}
</div>
</div>
</div>
</div>
<div class="data-container">
<div class="data-shadow-top">
<!---->
</div>
<div class="data-shadow-sides">
<div class="parch-int">
<div class="parch-bot">
<div id="replaceMain">
<div id="dataElement">
<div class="parchment-top">
<div class="parchment-content">
{$content}
<div class="data-shadow-bot">
<!---->
</div>
</div>