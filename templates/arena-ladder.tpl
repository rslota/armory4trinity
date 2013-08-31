<div class="list">
<div class="tabs">
<div class="tab" id="arena2">
<a href="arena-ladder.php?Realm={$realm}&type=2">2v2 Ladder</a>
</div>
<div class="tab" id="arena3">
<a href="arena-ladder.php?Realm={$realm}&type=3">3v3 Ladder</a>
</div>
<div class="tab" id="arena5">
<a href="arena-ladder.php?Realm={$realm}&type=5">5v5 Ladder</a>
</div>
<div class="clear"></div>
</div>
<div class="full-list">
<div class="info-pane">
<blockquote>
<b class="iarenateams">
<h4 style="width: 300px;">
{$realmlist}
</h4>
<h3 style="width: 300px;">{$type}v{$type} Arena Ladder Results</h3>
</b>
</blockquote>
<div id="ladderContent">
<div class="data">
<script type="text/javascript">
function zoomInArenaIcon(tr) {
	img = tr.getElementsByTagName('img')[0];
	img.style.width = 54+'px';
	img.style.height = 54+'px';
	img.style.left= '-36px';
	img.style.top= '-15px';
	img.style.zIndex = '2000';
}
function zoomOutArenaIcon(tr) {
	img = tr.getElementsByTagName('img')[0];
	img.style.width = 20+'px';
	img.style.height = 20+'px';
	img.style.left= '0px';
	img.style.top= '4px';
	img.style.zIndex = '1';
}
</script>
<table cellpadding="0" cellspacing="0" class="data-table sortTable" id="ladderTable" style="width: 100%">
<thead>
<tr class="masthead">
<th class="header headerSortUp" style="width:80px !important;"><a href="javascript:void(0);">Rank<span class="sortArw"></span></a></th><th style="width: 100%;"><a href="javascript:void(0);">Team Name<span class="sortArw"></span></a>
<div id="teamIconBoxContainer">
<div id="teamIconBox" style="position:absolute; z-index: 2000; zoom: 1;"></div>
</div>
</th><th style="width: 250px;"><a href="javascript:void(0);">Realm<span class="sortArw"></span></a></th><th><a href="javascript:void(0);">Faction<span class="sortArw"></span></a></th><th><a href="javascript:void(0);" onclick="arenaLadder.toggleSort('sgw')">Wins<span class="sortArw"></span></a></th><th><a href="javascript:void(0);">Losses<span class="sortArw"></span></a></th><th><a href="javascript:void(0);">Rating<span class="sortArw"></span></a></th>
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