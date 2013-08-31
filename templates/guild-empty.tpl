{$tabs}
<div class="filtercrest">
<div class="filterTitle">Guild Roster Filters</div>
</div>
<div class="filtercontainer">
<div class="filterBox" id="nameFilter">Character Name: <br>
<input class="filterInput" id="filCharName" maxlength="20" style="width: 150px;" type="text" value="">
</div>
<div class="filterBox" id="nameFilter">Level<br>
<input class="filterInput" id="filMinLevel" maxlength="2" size="2" style="width: 30px;" type="text" value="10"><span class="inlineTxt"> - </span><input class="filterInput" id="filMaxLevel" maxlength="2" size="2" style="width: 30px;" type="text" value="80">
</div>
<div class="filterBox" id="nameFilter">Race<br>
<select id="filRaceSelect" onchange="runGuildRosterFilters();"><option value="-1">All</option><option value="2">Orc</option><option value="5">Undead</option><option value="10">Blood Elf</option><option value="6">Tauren</option><option value="8">Troll</option></select>
</div>
<div class="filterBox" id="nameFilter">Gender:<br>
<select id="filGenderSelect" onchange="runGuildRosterFilters();"><option value="-1">Both</option><option value="0">Male</option><option value="1">Female</option></select>
</div>
<div class="filterBox" id="nameFilter">Class<br>
<select id="filClassSelect" onchange="runGuildRosterFilters();"><option value="-1">All</option><option value="6">Death Knight</option><option value="11">Druid</option><option value="2">Paladin</option><option value="3">Hunter</option><option value="4">Rogue</option><option value="5">Priest</option><option value="7">Shaman</option><option value="8">Mage</option><option value="9">Warlock</option><option value="1">Warrior</option></select>
</div>
<div class="filterBox" id="nameFilter">Rank<br>
<select id="filRankSelect" onchange="runGuildRosterFilters();"><option value="-1">All</option><option value="0">Guild Leader</option><option value="3">Rank 3</option><option value="1">Rank 1</option><option value="2">Rank 2</option></select>
</div>
<div class="clear"></div>
<div id="filterButtonHolder">
<a href="javascript:void(0)" id="runFilterButton" onclick="resetRosterFilters();" style="cursor: pointer;"><span class="btnRight">Reset Filters</span></a>
</div>
</div>
<div class="bottomshadow"></div>
<div class="filterTitle">Members</div>
<div class="pager page-body" id="pager" style="text-align:right;">
<form id="pagingForm" onsubmit="return false;" style="margin: 0; padding: 0; display: inline;">
<div id="searchTypeHolder"></div>
{$rep}

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