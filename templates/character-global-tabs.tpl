<style type="text/css">
	@import "css/character/sheet.css";
	@import "css/character/global.css";
	@import "css/character/reputation.css";
</style>

<div class="list">
<div class="tabs">
<div class="tab" id="characterTab">
<a href="character-sheet.php?Realm={$realm}&name={$name}">Character</a>
</div>
<div class="tab" id="guildTab">
<a href="guild-info.php?Realm={$realm}&name={$guildname}&characterName={$name}" {$guildtabdisplay}>Guild</a>
</div>
<div class="clear"></div>
</div>
<div class="subTabs">
<div class="upperLeftCorner"></div>
<div class="upperRightCorner"></div>
<a id="sheetSubTab" class="subTab" href="character-sheet.php?Realm={$realm}&name={$name}"><span>Profile</span></a>
<a id="talentsSubTab" class="subTab" href="character-talents.php?Realm={$realm}&name={$name}"><span>Talents and Glyphs</span></a>
<a id="reputationSubTab" class="subTab" href="character-reputation.php?Realm={$realm}&name={$name}"><span>Reputation</span></a>
<a id="skillsSubTab" class="subTab" href="character-skills.php?Realm={$realm}&name={$name}"><span>Skills</span></a>
<a id="achievementsSubTab" class="subTab" href="character-achievements.php?Realm={$realm}&name={$name}" style="{$achievementLock}"><span>Achievements</span></a>
<a id="statisticsSubTab" class="subTab" href="character-statistics.php?Realm={$realm}&name={$name}" style="{$achievementLock}"><span>Statistics</span></a>
<a id="arenaSubTab" class="subTab" href="character-arena.php?Realm={$realm}&name={$name}" {$arenatabdisplay}><span>Arena</span></a>
</div>
<script type="text/javascript">
selectTab(characterTab);
selectSubTab(characterSubTab);
GUID = {$guid};
</script>
<div class="full-list">
<div class="info-pane">
<div class="profile-wrapper">
<div class="profile">
<div class="faction-{$faction_name}">
<div class="profile-right" id="profileRight">
<a class="bmcLink" id="bmcLink" href="javascript:viewIn3D('race={$race_nr}&gender={$gender_nr}&items={$jsitemlist}')"><span>View in 3D</span><em></em></a>
</div>
<div class="profile-achieve">
<img src="images/portraits/wow{$portrait_type}/{$gender_nr}-{$race_nr}-{$class_nr}.gif">
<div class="points">
<a href="character-achievements.php?Realm={$realm}&name={$name}">{$achievement_points}</a>
</div>
<div id="leveltext" style="display:none;"></div>
<div class="level-noflash">{$level}<em>{$level}</em></div>
</div>
<div id="charHeaderTxt_Dark">
<span class="emptyPrefix"></span>
<div class="charNameHeader">{$name}<span class="suffix"></span>
</div>
{$guild}<span class="charLvl">Level&nbsp;{$level}&nbsp;{$race}&nbsp;{$class}</span>
</div>
<div id="charHeaderTxt_Light">
<span class="emptyPrefix"></span>
<div class="charNameHeader">{$name}<span class="suffix"></span>
</div>
{$guild}<span class="charLvl">Level&nbsp;{$level}&nbsp;{$race}&nbsp;{$class}</span>
</div>
<div id="forumLinks">
<a class="smFrame" href="javascript:void(0)">
<div>{$realm}</div>
<img src="images/icon-header-realm.gif"></a>
</div>
</div>
<div style="display:none;" id="wowhead3D">
	<br>
	<div style="width:600px;margin:auto;">
	<object height="400" width="600" type="application/x-shockwave-flash" data="http://static.wowhead.com/modelviewer/ModelView.swf">
	<param name="quality" value="high"></param>
	<param name="allowscriptaccess" value="always"></param>
	<param name="menu" value="false"></param>
	<param name="bgcolor" value="#181818"></param>
	<param name="flashvars" value="model={$race3D}{$gender3D}&modelType=16&contentPath=http://static.wowhead.com/modelviewer/&blur=1&equipList={$items3D}"></param>
	</object>
	<br>
	<a class="submit" onclick="this.parentNode.parentNode.style.display = 'none';" href="javascript:void(0);"><span>Close</span></a>
	</div>
</div>

