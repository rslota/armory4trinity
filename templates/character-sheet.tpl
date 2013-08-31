<script type="text/javascript">
								var theClassId 		= {$class_nr};
								var theRaceId 		= {$race_nr};
								var theClassName 	= "{$class}";
								var theLevel 		= {$level};
								var theRealmName 	= "{$realm}";
								var theCharName 	= "{$name}";


								var talentsTreeArray = new Array;

								$(document).ready(function(){

									talentsTreeArray["group1"] = [];
									talentsTreeArray["group2"] = [];

									talentsTreeArray["group1"][0] = [1, 0,
																"{$talentSpec0}"];
									talentsTreeArray["group1"][1] = [2, 0,
																"{$talentSpec1}"];
									talentsTreeArray["group1"][2] = [3, 0,
																""];

									talentsTreeArray["group2"][0] = [1, 0,
																""];
									talentsTreeArray["group2"][1] = [2, 0,
																""];
									talentsTreeArray["group2"][2] = [3, 0,
																""];

									//calcTalentSpecs();

									setCharSheetUpgradeMenu();

								});
							</script>
{$tabs}
<div class="profile-master2">
<div class="leftItems">
{$leftItems}
</div>
<div class="rightItems">
{$rightItems}
</div>
<div class="bottomItems">
{$bottomItems}
</div>
<div class="profileCenter">
<div class="statsLeft">
<div class="brownBox" style="height: 120px;">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<div class="spec">
<h4>Talent Specialization:</h4>
{$talentPreHtml0}
<div style="position:absolute; left:12px;">
<img id="talentSpecImage2" src="{$talentIconSrc0}"></div>
<h4>
<span id="replaceTalentSpecText">{$talentSpec0}</span>
</h4>
<span>{$talentCount0_0} / {$talentCount0_1} / {$talentCount0_2}</span>
</div>
{$talentPreHtml1}
<div style="position:absolute; left:12px;">
<img id="talentSpecImage2" src="{$talentIconSrc1}">
</div>
<h4>
<span id="replaceTalentSpecText2">{$talentSpec1}</span>
</h4>
<span>{$talentCount1_0} / {$talentCount1_1} / {$talentCount1_2}</span>
</div>
</div>
<div class="clear"></div>
</div>
<div class="brownBox" style="margin-top: 2px; height: 70px;">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<h4>Primary Professions:</h4>
{$profs}
<div class="clear"></div>
</div>
<div class="brownBox hp_mana_stats">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<div class="health-stat">
<p>
<span>Health:&nbsp;&nbsp;{$max_health}</span>
</p>
</div>
<div class="{$power_type_l}-stat">
<p>
<span>{$power_type}:&nbsp;&nbsp;{$max_power}</span>
</p>
</div>
<div class="clear"></div>
</div>
</div>
<div class="achRight">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<h4>Achievements</h4>
<a class="achPointsLink" href="character-achievements.php?Realm={$realm}&name={$name}"><span style="color: #FFF; float: right; margin: 0 0px 0 0;">{$achievement_points}</span>Points</a>
{$achievements}
</div>
<script type="text/javascript">

    var varOverLeft = 0;

	function dropdownMenuToggle(whichOne){
		theStyle = document.getElementById(whichOne).style;

		if (theStyle.display == "none")	theStyle.display = "block";
		else							theStyle.display = "none";

	}
</script>
<div class="dropdown1" onMouseOut="javascript: varOverLeft = 0;" onMouseOver="javascript: varOverLeft = 1;">
<a class="profile-stats" href="javascript: document.formDropdownLeft.dummyLeft.focus();" id="displayLeft">Base Stats</a>
</div>
<div style="position: relative;">
<div style="position: absolute;">
<form id="formDropdownLeft" name="formDropdownLeft" style="height: 0px;">
<input id="dummyLeft" onBlur="javascript: if(!varOverLeft) document.getElementById('dropdownHiddenLeft').style.display='none';" onFocus="javascript: dropdownMenuToggle('dropdownHiddenLeft');" size="2" style="position: relative; left: -5000px;" type="button">
</form>
</div>
</div>
<div class="drop-stats" id="dropdownHiddenLeft" onMouseOut="javascript: varOverLeft=0;" onMouseOver="javascript: varOverLeft=1;" style="display: none; z-index: 99999;">
<div class="tooltip">
<table width="98%">
<tr>
<td class="tl"></td><td class="t"></td><td class="tr"></td>
</tr>
<tr>
<td class="l"></td><td class="bg">
<ul>
<li>
<a href="#" onClick="changeStats('Left', replaceStringBaseStats, 'BaseStats', baseStatsDisplay); return false;">Base Stats<img class="checkmark" id="checkLeftBaseStats" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: visible;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Left', replaceStringMelee, 'Melee', meleeDisplay); return false;">Melee<img class="checkmark" id="checkLeftMelee" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Left', replaceStringRanged, 'Ranged', rangedDisplay); return false;">Ranged<img class="checkmark" id="checkLeftRanged" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Left', replaceStringSpell, 'Spell', spellDisplay); return false;">Spell<img class="checkmark" id="checkLeftSpell" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Left', replaceStringDefenses, 'Defenses', defensesDisplay); return false;">Defense<img class="checkmark" id="checkLeftDefenses" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
</ul>
</td><td class="r"></td>
</tr>
<tr>
<td class="bl"></td><td class="b"></td><td class="br"></td>
</tr>
</table>
</div>
</div>
<script type="text/javascript">

    var varOverRight = 0;

	function dropdownMenuToggle(whichOne){
		theStyle = document.getElementById(whichOne).style;

		if (theStyle.display == "none")	theStyle.display = "block";
		else							theStyle.display = "none";

	}
</script>
<div class="dropdown2" onMouseOut="javascript: varOverRight = 0;" onMouseOver="javascript: varOverRight = 1;">
<a class="profile-stats" href="javascript: document.formDropdownRight.dummyRight.focus();" id="displayRight">Base Stats</a>
</div>
<div style="position: relative;">
<div style="position: absolute;">
<form id="formDropdownRight" name="formDropdownRight" style="height: 0px;">
<input id="dummyRight" onBlur="javascript: if(!varOverRight) document.getElementById('dropdownHiddenRight').style.display='none';" onFocus="javascript: dropdownMenuToggle('dropdownHiddenRight');" size="2" style="position: relative; left: -5000px;" type="button">
</form>
</div>
</div>
<div class="drop-stats" id="dropdownHiddenRight" onMouseOut="javascript: varOverRight=0;" onMouseOver="javascript: varOverRight=1;" style="display: none; z-index: 9999999; left: 190px;">
<div class="tooltip">
<table width="98%">
<tr>
<td class="tl"></td><td class="t"></td><td class="tr"></td>
</tr>
<tr>
<td class="l"></td><td class="bg">
<ul>
<li>
<a href="#" onClick="changeStats('Right', replaceStringBaseStats, 'BaseStats', baseStatsDisplay); return false;">Base Stats<img class="checkmark" id="checkRightBaseStats" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Right', replaceStringMelee, 'Melee', meleeDisplay); return false;">Melee<img class="checkmark" id="checkRightMelee" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Right', replaceStringRanged, 'Ranged', rangedDisplay); return false;">Ranged<img class="checkmark" id="checkRightRanged" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Right', replaceStringSpell, 'Spell', spellDisplay); return false;">Spell<img class="checkmark" id="checkRightSpell" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
<li>
<a href="#" onClick="changeStats('Right', replaceStringDefenses, 'Defenses', defensesDisplay); return false;">Defense<img class="checkmark" id="checkRightDefenses" src="images/icons/icon-check.gif" tppabs="http://www.wowarmory.com/images/icons/icon-check.gif" style="visibility: hidden;"></a>
</li>
</ul>
</td><td class="r"></td>
</tr>
<tr>
<td class="bl"></td><td class="b"></td><td class="br"></td>
</tr>
</table>
</div>
</div>
<div class="stats1">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<div class="character-stats">
<div id="replaceStatsLeft"></div>
</div>
</div>
<div class="stats2">
<em class="ptl">
<!----></em><em class="ptr">
<!----></em><em class="pbl">
<!----></em><em class="pbr">
<!----></em>
<div class="character-stats">
<div id="replaceStatsRight"></div>
</div>
</div>
<script src="js/character/functions.js" tppabs="http://www.wowarmory.com/js/character/functions.js" type="text/javascript"></script><script type="text/javascript">

		function strengthObject() {
			this.base={$strength_base};
			this.effective={$strength_bonus}+{$strength_base};
			this.block=-1;
			this.attack={$melee_ap_mod};

			this.diff=this.effective - this.base;
		}

		function agilityObject() {
			this.base={$agility_base};
			this.effective={$agility_base}+{$agility_bonus};
			this.critHitPercent=0;
			this.attack={$melee_ap_mod_agility};
			this.armor={$armor_mod};

			this.diff=this.effective - this.base;
		}

		function staminaObject(base, effective, health, petBonus) {
			this.base={$stamina_base};
			this.effective={$stamina_base}+{$stamina_bonus};
			this.health={$health_mod_stamina};
			this.petBonus="-1";

			this.diff=this.effective - this.base;
		}

		function intellectObject() {
			this.base={$intellect_base};
			this.effective={$intellect_base}+{$intellect_bonus};
			this.mana={$mana_mod_intellect};
			this.critHitPercent="-1";
			this.petBonus="-1";

			this.diff=this.effective - this.base;
		}

		function spiritObject() {
			this.base={$spirit_base};
			this.effective={$spirit_base}+{$spirit_bonus};
			this.healthRegen="-1";
			this.manaRegen="-1";

			this.diff=this.effective - this.base;
		}

		function armorObject() {
			this.base={$armor_base};
			this.effective={$armor_base}+{$armor_bonus};
			this.reductionPercent="{$armor_mod_proc}";
			this.petBonus="-1";

			this.diff=this.effective - this.base;
		}

		function resistancesObject() {
			this.arcane=new resistArcaneObject("0", "-1");
			this.nature=new resistNatureObject("0", "-1");
			this.fire=new resistFireObject("0", "-1");
			this.frost=new resistFrostObject("0", "-1");
			this.shadow=new resistShadowObject("0", "-1");
		}

		function meleeMainHandWeaponSkillObject() {
			this.value={$melee_expertise};
			this.rating={$melee_expertise};
			this.additional="0";
			this.percent={$melee_expertise_proc};
		}

		function meleeOffHandWeaponSkillObject() {
			this.value={$melee_expertise_off};
			this.rating={$melee_expertise_off};
		}

		function meleeMainHandDamageObject() {
			this.speed={$melee_speed};
			this.min={$melee_damage_min};
			this.max={$melee_damage_max};
			this.percent="0";
			this.dps={$melee_dps};

			if (this.percent > 0)		this.effectiveColor="class='mod'";
			else if (this.percent < 0)	this.effectiveColor="class='moddown'";
		}

		function meleeOffHandDamageObject() {
			this.speed={$melee_speed_off};
			this.min={$melee_damage_min_off};
			this.max={$melee_damage_max_off};
			this.percent="0";
			this.dps={$melee_dps_off};
		}


		function meleeMainHandSpeedObject() {
			this.value={$melee_speed};
			this.hasteRating="-1";
			this.hastePercent="-1";
		}

		function meleeOffHandSpeedObject() {
			this.value={$melee_speed_off};
			this.hasteRating="-1";
			this.hastePercent="-1";
		}

		function meleePowerObject() {
			this.base={$melee_ap_base};
			this.effective={$melee_ap_base}+{$melee_ap_bonus};
			this.increasedDps={$melee_dps_mod};

			this.diff=this.effective - this.base;
		}

		function meleeHitRatingObject() {
			this.value={$melee_hit_rating};
			this.increasedHitPercent="?";
			this.armorPenetration="0";
			this.reducedArmorPercent="?";
		}

		function meleeCritChanceObject() {
			this.percent={$melee_crit};
			this.rating={$melee_crit_rating};
			this.plusPercent="-1";
		}

		function rangedWeaponSkillObject() {
			this.value=5;
			this.rating=0;
		}

		function rangedDamageObject() {
			this.speed={$ranged_speed};
			this.min={$ranged_damage_min};
			this.max={$ranged_damage_max};
			this.dps={$ranged_dps};
			this.percent=0;

			if (this.percent > 0)		this.effectiveColor="class='mod'";
			else if (this.percent < 0)	this.effectiveColor="class='moddown'";

		}

		function rangedSpeedObject() {
			this.value={$ranged_speed};
			this.hasteRating={$ranged_haste_rating};
			this.hastePercent="-1";
		}

		function rangedPowerObject() {
			this.base={$ranged_ap_base};
			this.effective={$ranged_ap_base}+{$ranged_ap_bonus};
			this.increasedDps={$ranged_dps_mod};
			this.petAttack=-1.00;
			this.petSpell=-1.00;

			this.diff=this.effective - this.base;
		}

		function rangedHitRatingObject() {
			this.value={$ranged_hit_rating};
			this.increasedHitPercent="0.00";
			this.armorPenetration="0";
			this.reducedArmorPercent="0.00";
		}

		function rangedCritChanceObject() {
			this.percent={$ranged_crit};
			this.rating={$ranged_crit_rating};
			this.plusPercent=0;
		}

		function spellBonusDamageObject() {
			this.holy={$spell_bonus_holy};
			this.arcane={$spell_bonus_arcane};
			this.fire={$spell_bonus_fire};
			this.nature={$spell_bonus_nature};
			this.frost={$spell_bonus_frost};
			this.shadow={$spell_bonus_shadow};
			this.petBonusAttack=-1;
			this.petBonusDamage=-1;
			this.petBonusFromType="";

			this.value=this.holy;

			if (this.value > this.arcane)	this.value=this.arcane;
			if (this.value > this.fire)		this.value=this.fire;
			if (this.value > this.nature)	this.value=this.nature;
			if (this.value > this.frost)		this.value=this.frost;
			if (this.value > this.shadow)	this.value=this.shadow;
		}

		function spellBonusHealingObject() {
			this.value={$spell_bonus_healing};
		}

		function spellHasteRatingObject(){
			this.value={$spell_haste_rating};
			this.percent=0;
		}

		function spellHitRatingObject() {
			this.value={$spell_hit_rating};
			this.increasedHitPercent=0.00;
			this.spellPenetration= 0;
		}

		function spellCritChanceObject() {
			this.rating={$spell_crit_rating};
			this.holy={$spell_crit_holy};
			this.arcane={$spell_crit_arcane};
			this.fire={$spell_crit_fire};
			this.nature={$spell_crit_nature};
			this.frost={$spell_crit_frost};
			this.shadow={$spell_crit_shadow};

			this.percent=this.holy;

			if (this.percent > this.arcane)	this.percent=this.arcane;
			if (this.percent > this.fire)	this.percent=this.fire;
			if (this.percent > this.nature)	this.percent=this.nature;
			if (this.percent > this.frost)	this.percent=this.frost;
			if (this.percent > this.shadow)	this.percent=this.shadow;
		}

		function spellPenetrationObject() {
			this.value=0;
		}

		function spellManaRegenObject() {
			this.casting={$mana_regen}*0.33;
			this.notCasting={$mana_regen};
		}

		function defensesArmorObject() {
			this.base={$armor_base};
			this.effective={$armor_base}+{$armor_bonus};
			this.percent={$armor_mod_proc};
			this.petBonus=-1;

			this.diff=this.effective - this.base;
		}

		function defensesDefenseObject() {
			this.rating="?";
			this.plusDefense=0;
			this.increasePercent="?";
			this.decreasePercent=0.00;
			this.value="?";
		}

		function defensesDodgeObject() {
			this.percent={$dodge};
			this.rating=0;
			this.increasePercent=0.00;
		}

		function defensesParryObject() {
			this.percent={$parry};
			this.rating=0;
			this.increasePercent=0.00;
		}

		function defensesBlockObject() {
			this.percent={$block};
			this.rating=0;
			this.increasePercent=0.00;
		}

		function defensesResilienceObject() {
			this.value={$resilience};
			this.hitPercent="?";
			this.damagePercent="?";
		}

		var theCharacter = new characterObject();
		var theCharUrl = "Realm={$realm}&name={$name}";

	</script><script src="js/_lang/en_us/character-sheet.js" tppabs="http://www.wowarmory.com/js/_lang/en_us/character-sheet.js" type="text/javascript"></script><script src="js/character/textObjects.js" tppabs="http://www.wowarmory.com/js/character/textObjects.js" type="text/javascript"></script>
</div>
</div>
<div style="width: 500px; margin: 5px auto 20px;">
<span style="float: right">Lifetime Honorable Kills: <strong>{$hk}</strong></span>
Last Updated:&nbsp;
		<strong>{$lastupdate}</strong>
</div>

<div class="bonus-stats">
<table class="deco-frame">
<thead>
<tr>
<td class="sl"></td><td class="ct st"></td><td class="sr"></td>
</tr>
</thead>
<tbody>
<tr>
<td class="sl"><b><em class="port"></em></b></td><td class="ct">
<div class="arena-ranking">
<h2>Arena</h2>
</div>
<ul class="badges-pvp">
{$arenacontent}
</ul>
<ul class="badges-pvp personalrating">
{$arenacontent2}
</ul>
</td><td class="sr"><b><em class="star"></em></b></td>
</tr>
</tbody>
<tfoot>
<tr>
<td class="sl"></td><td align="center" class="ct sb"></td><td class="sr"></td>
</tr>
</tfoot>
</table>
</div>
<div class="clear"></div>
<br>
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