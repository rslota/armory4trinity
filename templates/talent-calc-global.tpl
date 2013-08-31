<div class="full-list">
<div class="info-pane">
<script src="js/tools/talent-calc.js" type="text/javascript"></script><script type="text/javascript">
		$(document).ready(function(){		
			initTalentCalc("{$classId}", 
							"{$talstr}", 
							"Requires {0} point in {1}.",
							"Requires {0} points in {1}.",
							"Rank {0}/{1}",
							"Next Rank",
							"Requires {0} points in {1} Talents.",
							"calc",{$TBCLower});
			});	
	</script>
<div class="calcInfo" id="calcInfo">
<a href="talent-calc.php" id="linkToBuild"><span>
<div class="export">Link to this build</div>
</span></a><b>Points Spent</b>&nbsp;<span class="ptsHolder" id="pointsSpent">0</span><b>Points Left</b>&nbsp;<span class="ptsHolder" id="pointsLeft">0</span><b>Required Level</b>&nbsp;<span class="ptsHolder" id="requiredLevel">10</span>
</div>
<div id="talContainer">
<div class="talentFrame">
{$treeStr}
<a class="resetTalents" href="javascript:resetAllTalents()"><span>
<div class="reload" id="reloadButton">Reset All</div>
</span></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<talentTabs>
<talentTab classId="2" name="Paladin" url="class=Paladin"></talentTab>
<talentTab classId="4" name="Rogue" url="class=Rogue"></talentTab>
<talentTab classId="9" name="Warlock" url="class=Warlock"></talentTab>
<talentTab classId="8" name="Mage" url="class=Mage"></talentTab>
<talentTab classId="6" name="Death Knight" url="class=Death+Knight"></talentTab>
<talentTab classId="11" name="Druid" url="class=Druid"></talentTab>
<talentTab classId="1" name="Warrior" url="class=Warrior"></talentTab>
<talentTab classId="3" name="Hunter" url="class=Hunter"></talentTab>
<talentTab classId="7" name="Shaman" url="class=Shaman"></talentTab>
<talentTab classId="5" name="Priest" url="class=Priest"></talentTab>
</talentTabs>
</div>
</div>
</div>