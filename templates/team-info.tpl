<div class="list">
<div class="tabs">
<div class="selected-tab">
<a href="team-info.php?Realm={$realm}&type={$type}&name={$name}">Team Profile</a>
</div>
</div>
<div class="clear"></div>
</div>
<div class="subTabs" style="height: 1px;">
<div class="upperLeftCorner" style="height: 5px;"></div>
<div class="upperRightCorner" style="height: 5px;"></div>
</div>
<div class="full-list">
<div class="info-pane">
<div class="arenareport-header-single">
<div class="arenareport-moldingleft-s">
<div class="reldiv">
<div class="arenareport-moldingleft-s-flash">
<div id="teamicon3" style="display:block; padding:2px;"><img height="71" width="71" src="{$icon}" border="0"></div>
</div>
<div class="arenareport-moldingleft-name">
<div class="reldiv">
<div class="teamnameshadow">{$name}<span style="font-family:Arial, Helvetica, sans-serif;">
                            &lt;{$type}v{$type}&gt;
                            </span>
</div>
<div class="teamnamehighlight">
<a class="teamnamehighlight" href="javascript:void(0)">{$name}<span style="font-family:Arial, Helvetica, sans-serif; display: inline;">
                            &lt;{$type}v{$type}&gt;
                            </span></a>
</div>
</div>
</div>
<div class="arenareport-moldingleft-info">
<div class="reports-icon-space"></div>
<div style="float: left;">
<div class="reldiv">
<div style="position: absolute; top:-1px;">
<a class="reports-subtitle" href="javascript:void(0)">{$realm}</a>
</div>
</div>{$realm}</div>
<div style="float: left;">
<a class="realm-icon-reports staticTip" onMouseOver="javascript: setTipText(&quot;Realm&quot;);"></a>
</div>
</div>
</div>
</div>
</div>
<div class="arena-badge-container" style="float: right; margin-top: 20px;">
<div class="arenaTeam-badge" style="margin: 0 auto; float: none; padding: 1px;">
<div class="teamSide{$faction}"></div>
<div class="teamRank">
<span>Last Week's</span>
<p>Rank</p>
<p  class="position">{$place}</p>
</div>
<div class="arenaBadge-icon" style="background-image:url(images/icons/badges/arena/arena-{$rank}.jpg);">
<img class="p" src="images/badge-border-arena-{$rank_border}.gif"></div>
</div>
</div>
<div class="filterTitle">Statistics</div>
<div class="stats-container" style="margin-bottom: 10px;">
<div class="arenaTeam-data">
<div class="innerData">
<table>
<tr class="team-header">
<td></td><td align="center"><strong>Games</strong></td><td align="center"><strong>Win - Loss</strong></td><td align="center"><strong>Win %</strong></td><td align="center"><strong>Team Rating</strong></td>
</tr>
<tr class="hl">
<td>
<p>This Week</p>
</td><td align="center">
<p>{$wg}</p>
</td><td align="center">
<p>{$ww} - {$wl}</p>
</td><td align="center">
<p>{$wp}%</p>
</td><td align="center">
<p class="rating">{$wr}</p>
</td>
</tr>
<tr>
<td>
<p>Season</p>
</td><td align="center">
<p>{$sg}</p>
</td><td align="center">
<p>{$sw} - {$sl}</p>
</td><td align="center">
<p>{$sp}%</p>
</td><td align="center">
<p class="rating">{$wr}</p>
</td>
</tr>
</table>
</div>
</div>
</div>
<div class="data">
<table cellpadding="0" cellspacing="0" class="data-table sortTable" id="teamsTable" style="width: 100%">
<thead>
<tr class="masthead">
<th style="text-align:left; width: 150px;"><a>Team Members<span class="sortArw"></span></a></th><th style="text-align:left; width: 240px;"><a>Guild<span class="sortArw"></span></a></th><th style="text-align:left; width: 130px;"><a>Race/Class<span class="sortArw"></span></a></th><th><a class="staticTip" onmouseover="setTipText('Matches Played')">MP<span class="sortArw"></span></a></th><th><a class="staticTip" onmouseover="setTipText('Wins')">W<span class="sortArw"></span></a></th><th><a class="staticTip" onmouseover="setTipText('Losses')">L<span class="sortArw"></span></a></th><th><a>Win %<span class="sortArw"></span></a></th><th><a class="staticTip" onmouseover="setTipText('Personal Rating')">PR<span class="sortArw"></span></a></th>
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
</teamInfo>
</div>
</div>
</div>
</div>