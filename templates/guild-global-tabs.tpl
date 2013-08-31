<div class="list">
<div class="tabs">
<div class="tab" id="characterTab">
<a href="character-sheet.php?Realm={$realm}&name={$name}" {$charactertabdisplay}>Character</a>
</div>
<div class="tab" id="guildTab">
<a href="guild-info.php?Realm={$realm}&name={$guild}{$mode}">Guild</a>
</div>
<div class="clear"></div>
</div>
<div class="subTabs">
<div class="upperLeftCorner"></div>
<div class="upperRightCorner"></div>
<a id="rosterSubTab" class="subTab" href="guild-info.php?Realm={$realm}&name={$guild}{$mode}"><span>Roster</span></a>
<a id="statsSubTab" class="subTab" href="guild-stats.php?Realm={$realm}&name={$guild}{$mode}"><span>Statistics</span></a>
</div>
<script type="text/javascript">
selectTab(characterTab);
selectSubTab(characterSubTab);
</script>
<div class="full-list">
<div class="info-pane">
<div class="profile-wrapper">
<div class="profile">
<div class="guildbanks-faction-{$faction2}" style="margin-bottom: 40px;">
<div class="profile-left">
<div class="profile-right">
<div style="height: 140px; width: 100%;">
<div class="reldiv">
<div class="guildheadertext">
<div class="guild-details">
<div class="guild-shadow">
<table>
<tr>
<td>
<h1>{$guild}</h1>
<h2>{$members}&nbsp;Members</h2>
</td>
</tr>
</table>
</div>
<div class="guild-white">
<table>
<tr>
<td>
<h1>{$guild}</h1>
<h2>{$members}&nbsp;Members</h2>
</td>
</tr>
</table>
</div>
</div>
</div>
<div style="position: absolute; margin: -10px 0 0 -10px; z-index: 10000;">
<div id="guild_emblem" style="display:none;"></div>
<script type="text/javascript">
		var flashId="guild_emblem";
		if ((Browser.safari && flashId=="flashback") || (Browser.linux && flashId=="flashback")){//kill the searchbox flash for safari or linux
		   document.getElementById("searchFlash").innerHTML = '<div class="search-noflash"></div>';
		}else
			printFlash("guild_emblem", "images/emblem_ex.swf", "transparent", "", "", "230", "200", "best", "", "emblemstyle=100&emblemcolor=14&embborderstyle=4&embbordercolor=16&bgcolor=45&faction=", "")
		
		</script>
</div>
<div style="position: absolute; margin: 116px 0 0 210px;">
<a class="smFrame" href="javascript:void(0)">
<div>{$realm}</div>
<img src="images/icon-header-realm.gif" tppabs="http://www.wowarmory.com/images/icon-header-realm.gif"></a>
</div>
<div style="position: absolute; margin: 116px 0 0 210px;">
<a class="smFrame" href="javascript:void(0)">
<div>{$realm}</div>
<img src="images/icon-header-realm.gif" tppabs="http://www.wowarmory.com/images/icon-header-realm.gif"></a>
</div>
</div>
</div>
</div>
</div>
</div>