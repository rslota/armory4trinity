{$tabs}
<div class="filtercrest">
<div class="filterTitle">Guild Roster Filters</div>
</div>
<div class="filtercontainer">
<div class="filterBox" id="nameFilter">Character Name: <br>
<input class="filterInput" id="filCharName" maxlength="20" style="width: 150px;" type="text" name="name" onKeyUp="setCharacterFilter(this.name,this.value)" value="">
</div>
<div class="filterBox" id="nameFilter">Level<br>
<input class="filterInput" id="filMinLevel" maxlength="2" size="2" style="width: 30px;" type="text" value="1" name="lvldown" onKeyUp="setCharacterFilter(this.name,this.value)"><span class="inlineTxt"> - </span><input class="filterInput" id="filMaxLevel" maxlength="2" size="2" style="width: 30px;" type="text" value="80" name="lvlup" onKeyUp="setCharacterFilter(this.name,this.value)">
</div>
<div class="filterBox" id="nameFilter">Race<br>
<select id="filRaceSelect" name="race" onchange="setCharacterFilter(this.name,this.value)"><option value="-1">All</option>{$races}</select>
</div>
<div class="filterBox" id="nameFilter">Gender:<br>
<select id="filGenderSelect" name="gender" onchange="setCharacterFilter(this.name,this.value)"><option value="-1">Both</option><option value="0">Male</option><option value="1">Female</option></select>
</div>
<div class="filterBox" id="nameFilter">Class<br>
<select id="filClassSelect" name="class" onchange="setCharacterFilter(this.name,this.value)"><option value="-1">All</option><option value="6">Death Knight</option><option value="11">Druid</option><option value="2">Paladin</option><option value="3">Hunter</option><option value="4">Rogue</option><option value="5">Priest</option><option value="7">Shaman</option><option value="8">Mage</option><option value="9">Warlock</option><option value="1">Warrior</option></select>
</div>
<div class="filterBox" id="nameFilter">Rank<br>
<select id="filRankSelect" name="guildrank" onchange="setCharacterFilter(this.name,this.value)"><option value="-1">All</option>{$ranks}</select>
</div>
<div class="clear"></div>
<div id="filterButtonHolder">
<a href="javascript:void(0)" id="runFilterButton" onclick="resetCharacterFilters();" style="cursor: pointer;"><span class="btnRight">Reset Filters</span></a>
</div>
</div>
<div class="bottomshadow"></div>
<div class="filterTitle">Members</div>
<div class="pager page-body" id="pager" style="text-align:right;">
</div>
<div class="data">
<table cellpadding="0" cellspacing="0" class="data-table sortTable" style="width: 100%">
<thead id="searchTableHeader">
</thead>
<tbody id="searchResultsTable">
</tbody>
</table>
<script type="text/javascript">
section = 'character';
setSearchHeader(5);
guildid = {$guildid};
RealmID = {$realmid};
view();
</script>
</div>
<div class="clear">
<!---->
</div>
<br>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>