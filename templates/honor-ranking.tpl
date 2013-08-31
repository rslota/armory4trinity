<div class="list">
<div class="tabs">
<div class="tab" id="charhk">
<a href="honor-ranking.php?Realm={$realm}&type=hk">HK Ranking</a>
</div>
<div class="tab" id="charhonor">
<a href="honor-ranking.php?Realm={$realm}&type=honor">Honor Ranking</a>
</div>
<div class="clear"></div>
</div>
<div class="full-list">
<div class="info-pane">
<blockquote>
<b class="icharacters">
<h4 style="width: 300px;">
{$realmlist}
</h4>
<h3 style="width: 300px;">{$type} Ranking Results</h3>
</b>
</blockquote>
<div id="ladderContent">
<div class="data">
<table cellpadding="0" cellspacing="0" class="data-table sortTable" id="ladderTable" style="width: 100%">
<thead>
<tr class="masthead">
<th class="header headerSortUp" style="width:80px !important;"><a href="javascript:void(0);">Rank<span class="sortArw"></span></a></th><th style="width: 100%;"><a href="javascript:void(0);">Character Name<span class="sortArw"></span></a>
</th><th style="width: 50px;"><a href="javascript:void(0);">Level<span class="sortArw"></span></a></th><th><a href="javascript:void(0);">Race/Class<span class="sortArw"></span></a><th><a href="javascript:void(0);">Faction<span class="sortArw"></span></a></th><th><a href="javascript:void(0);" onclick="arenaLadder.toggleSort('sgw')" style="width:150px;">Guild<span class="sortArw"></span></a></th><th><a href="javascript:void(0);">{$type}<span class="sortArw"></span></a></th>
</tr>
</thead>
<tbody>
{$table}
</tbody>
</table>
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