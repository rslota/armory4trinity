<body>
<form id="historyStorageForm" method="GET">
<textarea id="historyStorageField" name="historyStorageField"></textarea>
</form>
<div class="outer-container">
<div class="inner-container">
<div id="replaceMain">
<div class="front-top">
<div class="logo">
<a href="/index.php"><span>World of Warcraft Armory</span></a>
</div>
</div>
<div class="data-container">
<div class="data-shadow-top">
<!---->
</div>
<div class="data-shadow-sides">
<div class="parch-front">
<div class="search-module">
<em class="search-icon"></em>
<form action="search.php" method="get" name="formSearch" onSubmit="javascript: return menuCheckLength(document.formSearch);">
<input id="armorySearch" maxlength="72" name="searchQuery" size="16" type="text" value=""><a class="submit" href="javascript:void(0);" onclick="javascript: return menuCheckLength(document.formSearch);"><span>Search</span></a>
<div id="errorSearchType"></div>
<div id="formSearch_errorSearchLength" onmouseover="javascript: this.innerHTML = '';"></div>
<input name="searchType" type="hidden" value="all">
</form>
{$menu}
</div>
</div>
</div>
<div class="data-shadow-bot">
<!---->
</div>
</div>
