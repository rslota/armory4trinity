<div class="full-list">
<div class="info-pane">
<script src="js/tools/talent-calc.js" type="text/javascript"></script><script type="text/javascript">
		$(document).ready(function(){		
			initTalentCalc("6", 
							"{$talstr}", 
							"Requires {0} point in {1}.",
							"Requires {0} points in {1}.",
							"Rank {0}/{1}",
							"Next Rank",
							"Requires {0} points in {1} Talents.",
							"calc");
			});	
	</script>
<div class="calcInfo" id="calcInfo">
<a href="talent-calc.php" id="linkToBuild"><span>
<div class="export">Link to this build</div>
</span></a><b>Points Spent</b>&nbsp;<span class="ptsHolder" id="pointsSpent">0</span><b>Points Left</b>&nbsp;<span class="ptsHolder" id="pointsLeft">0</span><b>Required Level</b>&nbsp;<span class="ptsHolder" id="requiredLevel">10</span>
</div>
<div id="talContainer">
<div class="talentFrame">
<div class="talentTree" id="DeathKnightBlood_tree" style="margin-right: 5px; background-image: url('images/talents/bg/DeathKnightBlood.jpg')">
<div class="tier" id="DeathKnightBlood_tier0">
<div class="talent staticTip col0" id="Butchery_iconHolder" style="background-image:url('images/icon43/inv_axe_68.gif');">
<div class="talentHolder tier1" id="Butchery" onmousedown="addTalent(event, 'Butchery');" onmouseover="makeTalentTooltip('Butchery');">
<span id="rank1_Butchery" style="display: none">Whenever you kill an enemy that grants experience or honor, you generate up to 10 runic power.  In addition, you generate 1 runic power per 5 sec while in combat.</span><span id="rank2_Butchery" style="display: none">Whenever you kill an enemy that grants experience or honor, you generate up to 20 runic power.  In addition, you generate 2 runic power per 5 sec while in combat.</span>
<div class="iconhighlight"></div>
<span id="Butchery_name" style="display: none;">Butchery</span><span id="Butchery_icon" style="display: none;">inv_axe_68</span>
<div class="rankCtr">
<span id="count_Butchery">0</span><span>/</span><span id="total_Butchery">2</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Subversion_iconHolder" style="background-image:url('images/icon43/spell_deathknight_subversion.gif');">
<div class="talentHolder tier1" id="Subversion" onmousedown="addTalent(event, 'Subversion');" onmouseover="makeTalentTooltip('Subversion');">
<span id="rank1_Subversion" style="display: none">Increases the critical strike chance of Blood Strike, Heart Strike and Obliterate by 3%, and reduces threat generated while in Blood or Unholy Presence by 8%.</span><span id="rank2_Subversion" style="display: none">Increases the critical strike chance of Blood Strike, Heart Strike and Obliterate by 6%, and reduces threat generated while in Blood or Unholy Presence by 16%.</span><span id="rank3_Subversion" style="display: none">Increases the critical strike chance of Blood Strike, Heart Strike and Obliterate by 9%, and reduces threat generated while in Blood or Unholy Presence by 25%.</span>
<div class="iconhighlight"></div>
<span id="Subversion_name" style="display: none;">Subversion</span><span id="Subversion_icon" style="display: none;">spell_deathknight_subversion</span>
<div class="rankCtr">
<span id="count_Subversion">0</span><span>/</span><span id="total_Subversion">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="BladeBarrier_iconHolder" style="background-image:url('images/icon43/ability_upgrademoonglaive.gif');">
<div class="talentHolder tier1" id="BladeBarrier" onmousedown="addTalent(event, 'BladeBarrier');" onmouseover="makeTalentTooltip('BladeBarrier');">
<span id="rank1_BladeBarrier" style="display: none">Whenever your Blood Runes are on cooldown, you gain the Blade Barrier effect, which decreases damage taken by 1% for the next 10 sec.</span><span id="rank2_BladeBarrier" style="display: none">Whenever your Blood Runes are on cooldown, you gain the Blade Barrier effect, which decreases damage taken by 2% for the next 10 sec.</span><span id="rank3_BladeBarrier" style="display: none">Whenever your Blood Runes are on cooldown, you gain the Blade Barrier effect, which decreases damage taken by 3% for the next 10 sec.</span><span id="rank4_BladeBarrier" style="display: none">Whenever your Blood Runes are on cooldown, you gain the Blade Barrier effect, which decreases damage taken by 4% for the next 10 sec.</span><span id="rank5_BladeBarrier" style="display: none">Whenever your Blood Runes are on cooldown, you gain the Blade Barrier effect, which decreases damage taken by 5% for the next 10 sec.</span>
<div class="iconhighlight"></div>
<span id="BladeBarrier_name" style="display: none;">Blade Barrier</span><span id="BladeBarrier_icon" style="display: none;">ability_upgrademoonglaive</span>
<div class="rankCtr">
<span id="count_BladeBarrier">0</span><span>/</span><span id="total_BladeBarrier">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier1">
<div class="talent staticTip col0" id="BladedArmor_iconHolder" style="background-image:url('images/icon43/grey/inv_shoulder_36.gif');">
<div class="talentHolder tier2 disabled" id="BladedArmor" onmousedown="addTalent(event, 'BladedArmor');" onmouseover="makeTalentTooltip('BladedArmor');">
<span id="rank1_BladedArmor" style="display: none">Increases your attack power by 1 for every 180 armor value you have.</span><span id="rank2_BladedArmor" style="display: none">Increases your attack power by 2 for every 180 armor value you have.</span><span id="rank3_BladedArmor" style="display: none">Increases your attack power by 3 for every 180 armor value you have.</span><span id="rank4_BladedArmor" style="display: none">Increases your attack power by 4 for every 180 armor value you have.</span><span id="rank5_BladedArmor" style="display: none">Increases your attack power by 5 for every 180 armor value you have.</span>
<div class="iconhighlight"></div>
<span id="BladedArmor_name" style="display: none;">Bladed Armor</span><span id="BladedArmor_icon" style="display: none;">inv_shoulder_36</span>
<div class="rankCtr">
<span id="count_BladedArmor">0</span><span>/</span><span id="total_BladedArmor">5</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="ScentofBlood_iconHolder" style="background-image:url('images/icon43/grey/ability_rogue_bloodyeye.gif');">
<div class="talentHolder tier2 disabled" id="ScentofBlood" onmousedown="addTalent(event, 'ScentofBlood');" onmouseover="makeTalentTooltip('ScentofBlood');">
<span id="rank1_ScentofBlood" style="display: none">You have a 15% chance after dodging, parrying or taking  direct damage to gain the Scent of Blood effect, causing your next melee hit to generate 5 runic power.  This effect cannot occur more often than once every 10 sec.</span><span id="rank2_ScentofBlood" style="display: none">You have a 15% chance after dodging, parrying or taking  direct damage to gain the Scent of Blood effect, causing your next 2 melee hits to generate 5 runic power.  This effect cannot occur more often than once every 10 sec.</span><span id="rank3_ScentofBlood" style="display: none">You have a 15% chance after dodging, parrying or taking  direct damage to gain the Scent of Blood effect, causing your next 3 melee hits to generate 5 runic power.  This effect cannot occur more often than once every 10 sec.</span>
<div class="iconhighlight"></div>
<span id="ScentofBlood_name" style="display: none;">Scent of Blood</span><span id="ScentofBlood_icon" style="display: none;">ability_rogue_bloodyeye</span>
<div class="rankCtr">
<span id="count_ScentofBlood">0</span><span>/</span><span id="total_ScentofBlood">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="TwoHandedWeaponSpecialization_iconHolder" style="background-image:url('images/icon43/grey/inv_sword_68.gif');">
<div class="talentHolder tier2 disabled" id="TwoHandedWeaponSpecialization" onmousedown="addTalent(event, 'TwoHandedWeaponSpecialization');" onmouseover="makeTalentTooltip('TwoHandedWeaponSpecialization');">
<span id="rank1_TwoHandedWeaponSpecialization" style="display: none">Increases the damage you deal with two-handed melee weapons by 2%.</span><span id="rank2_TwoHandedWeaponSpecialization" style="display: none">Increases the damage you deal with two-handed melee weapons by 4%.</span>
<div class="iconhighlight"></div>
<span id="TwoHandedWeaponSpecialization_name" style="display: none;">Two-Handed Weapon Specialization</span><span id="TwoHandedWeaponSpecialization_icon" style="display: none;">inv_sword_68</span>
<div class="rankCtr">
<span id="count_TwoHandedWeaponSpecialization">0</span><span>/</span><span id="total_TwoHandedWeaponSpecialization">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier2">
<div class="talent staticTip col0" id="RuneTap_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_runetap.gif');">
<div class="talentHolder tier3 disabled" id="RuneTap" onmousedown="addTalent(event, 'RuneTap');" onmouseover="makeTalentTooltip('RuneTap');">
<span id="rank1_RuneTap" style="display: none">Converts 1 Blood Rune into 10% of your maximum health.</span><span id="spellInfo_RuneTap" style="display: none;"><span style="float: left;">1 Blood</span>
<br>
<span style="float: right;">1 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="RuneTap_name" style="display: none;">Rune Tap</span><span id="RuneTap_icon" style="display: none;">spell_deathknight_runetap</span>
<div class="rankCtr">
<span id="count_RuneTap">0</span><span>/</span><span id="total_RuneTap">1</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="DarkConviction_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_darkconviction.gif');">
<div class="talentHolder tier3 disabled" id="DarkConviction" onmousedown="addTalent(event, 'DarkConviction');" onmouseover="makeTalentTooltip('DarkConviction');">
<span id="rank1_DarkConviction" style="display: none">Increases your chance to critically hit with weapons, spells and abilities by 1%.</span><span id="rank2_DarkConviction" style="display: none">Increases your chance to critically hit with weapons, spells and abilities by 2%.</span><span id="rank3_DarkConviction" style="display: none">Increases your chance to critically hit with weapons, spells and abilities by 3%.</span><span id="rank4_DarkConviction" style="display: none">Increases your chance to critically hit with weapons, spells and abilities by 4%.</span><span id="rank5_DarkConviction" style="display: none">Increases your chance to critically hit with weapons, spells and abilities by 5%.</span>
<div class="iconhighlight"></div>
<span id="DarkConviction_name" style="display: none;">Dark Conviction</span><span id="DarkConviction_icon" style="display: none;">spell_deathknight_darkconviction</span>
<div class="rankCtr">
<span id="count_DarkConviction">0</span><span>/</span><span id="total_DarkConviction">5</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="DeathRuneMastery_iconHolder" style="background-image:url('images/icon43/grey/inv_sword_62.gif');">
<div class="talentHolder tier3 disabled" id="DeathRuneMastery" onmousedown="addTalent(event, 'DeathRuneMastery');" onmouseover="makeTalentTooltip('DeathRuneMastery');">
<span id="rank1_DeathRuneMastery" style="display: none">Whenever you hit with Death Strike or Obliterate there is a 33% chance that the Frost and Unholy Runes will become Death Runes when they activate.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank2_DeathRuneMastery" style="display: none">Whenever you hit with Death Strike or Obliterate there is a 66% chance that the Frost and Unholy Runes will become Death Runes when they activate.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank3_DeathRuneMastery" style="display: none">Whenever you hit with Death Strike or Obliterate there is a 100% chance that the Frost and Unholy Runes will become Death Runes when they activate.  Death Runes count as a Blood, Frost or Unholy Rune.</span>
<div class="iconhighlight"></div>
<span id="DeathRuneMastery_name" style="display: none;">Death Rune Mastery</span><span id="DeathRuneMastery_icon" style="display: none;">inv_sword_62</span>
<div class="rankCtr">
<span id="count_DeathRuneMastery">0</span><span>/</span><span id="total_DeathRuneMastery">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier3">
<div class="talent staticTip col0" id="ImprovedRuneTap_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_runetap.gif');">
<div class="talentHolder tier4 requires t_RuneTap disabled" id="ImprovedRuneTap" onmousedown="addTalent(event, 'ImprovedRuneTap');" onmouseover="makeTalentTooltip('ImprovedRuneTap');">
<span id="rank1_ImprovedRuneTap" style="display: none">Increases the health provided by Rune Tap by 33% and lowers its cooldown by 10 sec.</span><span id="rank2_ImprovedRuneTap" style="display: none">Increases the health provided by Rune Tap by 66% and lowers its cooldown by 20 sec.</span><span id="rank3_ImprovedRuneTap" style="display: none">Increases the health provided by Rune Tap by 100% and lowers its cooldown by 30 sec.</span>
<div class="iconhighlight"></div>
<span id="ImprovedRuneTap_name" style="display: none;">Improved Rune Tap</span><span id="ImprovedRuneTap_icon" style="display: none;">spell_deathknight_runetap</span>
<div class="rankCtr">
<span id="count_ImprovedRuneTap">0</span><span>/</span><span id="total_ImprovedRuneTap">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="SpellDeflection_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_spelldeflection.gif');">
<div class="talentHolder tier4 disabled" id="SpellDeflection" onmousedown="addTalent(event, 'SpellDeflection');" onmouseover="makeTalentTooltip('SpellDeflection');">
<span id="rank1_SpellDeflection" style="display: none">You have a chance equal to your Parry chance of taking 15% less damage from a direct damage spell.</span><span id="rank2_SpellDeflection" style="display: none">You have a chance equal to your Parry chance of taking 30% less damage from a direct damage spell.</span><span id="rank3_SpellDeflection" style="display: none">You have a chance equal to your Parry chance of taking 45% less damage from a direct damage spell.</span>
<div class="iconhighlight"></div>
<span id="SpellDeflection_name" style="display: none;">Spell Deflection</span><span id="SpellDeflection_icon" style="display: none;">spell_deathknight_spelldeflection</span>
<div class="rankCtr">
<span id="count_SpellDeflection">0</span><span>/</span><span id="total_SpellDeflection">3</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="Vendetta_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_vendetta.gif');">
<div class="talentHolder tier4 disabled" id="Vendetta" onmousedown="addTalent(event, 'Vendetta');" onmouseover="makeTalentTooltip('Vendetta');">
<span id="rank1_Vendetta" style="display: none">Heals you for up to 2% of your maximum health whenever you kill a target that yields experience or honor.</span><span id="rank2_Vendetta" style="display: none">Heals you for up to 4% of your maximum health whenever you kill a target that yields experience or honor.</span><span id="rank3_Vendetta" style="display: none">Heals you for up to 6% of your maximum health whenever you kill a target that yields experience or honor.</span>
<div class="iconhighlight"></div>
<span id="Vendetta_name" style="display: none;">Vendetta</span><span id="Vendetta_icon" style="display: none;">spell_deathknight_vendetta</span>
<div class="rankCtr">
<span id="count_Vendetta">0</span><span>/</span><span id="total_Vendetta">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier4">
<div class="talent staticTip col0" id="BloodyStrikes_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_deathstrike.gif');">
<div class="talentHolder tier5 disabled" id="BloodyStrikes" onmousedown="addTalent(event, 'BloodyStrikes');" onmouseover="makeTalentTooltip('BloodyStrikes');">
<span id="rank1_BloodyStrikes" style="display: none">Increases the damage of Blood Strike and Heart Strike by 15%, and increases the damage of Blood Boil by 10%.</span><span id="rank2_BloodyStrikes" style="display: none">Increases the damage of Blood Strike and Heart Strike by 30%, and increases the damage of Blood Boil by 20%.</span><span id="rank3_BloodyStrikes" style="display: none">Increases the damage of Blood Strike and Heart Strike by 45%, and increases the damage of Blood Boil by 30%.</span>
<div class="iconhighlight"></div>
<span id="BloodyStrikes_name" style="display: none;">Bloody Strikes</span><span id="BloodyStrikes_icon" style="display: none;">spell_deathknight_deathstrike</span>
<div class="rankCtr">
<span id="count_BloodyStrikes">0</span><span>/</span><span id="total_BloodyStrikes">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="VeteranoftheThirdWar_iconHolder" style="background-image:url('images/icon43/grey/spell_misc_warsongfocus.gif');">
<div class="talentHolder tier5 disabled" id="VeteranoftheThirdWar" onmousedown="addTalent(event, 'VeteranoftheThirdWar');" onmouseover="makeTalentTooltip('VeteranoftheThirdWar');">
<span id="rank1_VeteranoftheThirdWar" style="display: none">Increases your total Strength and Stamina by 2%, and your expertise by 2.</span><span id="rank2_VeteranoftheThirdWar" style="display: none">Increases your total Strength and Stamina by 4%, and your expertise by 4.</span><span id="rank3_VeteranoftheThirdWar" style="display: none">Increases your total Strength and Stamina by 6%, and your expertise by 6.</span>
<div class="iconhighlight"></div>
<span id="VeteranoftheThirdWar_name" style="display: none;">Veteran of the Third War</span><span id="VeteranoftheThirdWar_icon" style="display: none;">spell_misc_warsongfocus</span>
<div class="rankCtr">
<span id="count_VeteranoftheThirdWar">0</span><span>/</span><span id="total_VeteranoftheThirdWar">3</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="MarkofBlood_iconHolder" style="background-image:url('images/icon43/grey/ability_hunter_rapidkilling.gif');">
<div class="talentHolder tier5 disabled" id="MarkofBlood" onmousedown="addTalent(event, 'MarkofBlood');" onmouseover="makeTalentTooltip('MarkofBlood');">
<span id="rank1_MarkofBlood" style="display: none">Place a Mark of Blood on an enemy.  Whenever the marked enemy deals damage to a target, that target is healed for 4% of its maximum health.  Lasts for 20 sec or up to 20 hits.</span><span id="spellInfo_MarkofBlood" style="display: none;"><span style="float: right;">30 yd range</span><span style="float: left;">1 Blood</span>
<br>
<span style="float: right;">3 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="MarkofBlood_name" style="display: none;">Mark of Blood</span><span id="MarkofBlood_icon" style="display: none;">ability_hunter_rapidkilling</span>
<div class="rankCtr">
<span id="count_MarkofBlood">0</span><span>/</span><span id="total_MarkofBlood">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier5">
<div class="talent staticTip col1" id="BloodyVengeance_iconHolder" style="background-image:url('images/icon43/grey/ability_backstab.gif');">
<div class="talentHolder tier6 requires t_DarkConviction disabled" id="BloodyVengeance" onmousedown="addTalent(event, 'BloodyVengeance');" onmouseover="makeTalentTooltip('BloodyVengeance');">
<span id="rank1_BloodyVengeance" style="display: none">Gives you a 1% bonus to physical damage you deal for 30 sec after dealing a critical strike from a weapon swing, spell, or ability.  This effect stacks up to 3 times.</span><span id="rank2_BloodyVengeance" style="display: none">Gives you a 2% bonus to physical damage you deal for 30 sec after dealing a critical strike from a weapon swing, spell, or ability.  This effect stacks up to 3 times.</span><span id="rank3_BloodyVengeance" style="display: none">Gives you a 3% bonus to physical damage you deal for 30 sec after dealing a critical strike from a weapon swing, spell, or ability.  This effect stacks up to 3 times.</span>
<div class="iconhighlight"></div>
<span id="BloodyVengeance_name" style="display: none;">Bloody Vengeance</span><span id="BloodyVengeance_icon" style="display: none;">ability_backstab</span>
<div class="rankCtr">
<span id="count_BloodyVengeance">0</span><span>/</span><span id="total_BloodyVengeance">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="AbominationsMight_iconHolder" style="background-image:url('images/icon43/grey/ability_warrior_intensifyrage.gif');">
<div class="talentHolder tier6 disabled" id="AbominationsMight" onmousedown="addTalent(event, 'AbominationsMight');" onmouseover="makeTalentTooltip('AbominationsMight');">
<span id="rank1_AbominationsMight" style="display: none">Your Blood Strikes and Heart Strikes have a 25% chance and your Death Strikes and Obliterates have a 50% chance to increase the attack power by 10% of raid members within 45 yards for 10 sec.  Also increases your total Strength by 1%.</span><span id="rank2_AbominationsMight" style="display: none">Your Blood Strikes and Heart Strikes have a 50% chance and your Death Strikes and Obliterates have a 100% chance to increase the attack power by 10% of raid members within 45 yards for 10 sec.  Also increases your total Strength by 2%.</span>
<div class="iconhighlight"></div>
<span id="AbominationsMight_name" style="display: none;">Abomination's Might</span><span id="AbominationsMight_icon" style="display: none;">ability_warrior_intensifyrage</span>
<div class="rankCtr">
<span id="count_AbominationsMight">0</span><span>/</span><span id="total_AbominationsMight">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier6">
<div class="talent staticTip col0" id="Bloodworms_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_soulleech.gif');">
<div class="talentHolder tier7 disabled" id="Bloodworms" onmousedown="addTalent(event, 'Bloodworms');" onmouseover="makeTalentTooltip('Bloodworms');">
<span id="rank1_Bloodworms" style="display: none">Your weapon hits have a 3% chance to cause the target to spawn 2-4 Bloodworms.  Bloodworms attack your enemies, healing you as they do damage for 20 sec or until killed.</span><span id="rank2_Bloodworms" style="display: none">Your weapon hits have a 6% chance to cause the target to spawn 2-4 Bloodworms.  Bloodworms attack your enemies, healing you as they do damage for 20 sec or until killed.</span><span id="rank3_Bloodworms" style="display: none">Your weapon hits have a 9% chance to cause the target to spawn 2-4 Bloodworms.  Bloodworms attack your enemies, healing you as they do damage for 20 sec or until killed.</span>
<div class="iconhighlight"></div>
<span id="Bloodworms_name" style="display: none;">Bloodworms</span><span id="Bloodworms_icon" style="display: none;">spell_shadow_soulleech</span>
<div class="rankCtr">
<span id="count_Bloodworms">0</span><span>/</span><span id="total_Bloodworms">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Hysteria_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_bladedarmor.gif');">
<div class="talentHolder tier7 disabled" id="Hysteria" onmousedown="addTalent(event, 'Hysteria');" onmouseover="makeTalentTooltip('Hysteria');">
<span id="rank1_Hysteria" style="display: none">Induces a friendly unit into a killing frenzy for 30 sec.  The target is Enraged, which increases their physical damage by 20%, but causes them to lose health equal to 1% of their maximum health every second.</span><span id="spellInfo_Hysteria" style="display: none;"><span style="float: left;">30 yd range</span>
<br>
<span style="float: right;">3 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="Hysteria_name" style="display: none;">Hysteria</span><span id="Hysteria_icon" style="display: none;">spell_deathknight_bladedarmor</span>
<div class="rankCtr">
<span id="count_Hysteria">0</span><span>/</span><span id="total_Hysteria">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="BloodAura_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_bloodpresence.gif');">
<div class="talentHolder tier7 disabled" id="BloodAura" onmousedown="addTalent(event, 'BloodAura');" onmouseover="makeTalentTooltip('BloodAura');">
<span id="rank1_BloodAura" style="display: none">While in Frost Presence or Unholy Presence, you retain 2% healing from Blood Presence, and healing done to you is increased by 5% in Blood Presence.</span><span id="rank2_BloodAura" style="display: none">While in Frost Presence or Unholy Presence, you retain 4% healing from Blood Presence, and healing done to you is increased by 10% in Blood Presence.</span>
<div class="iconhighlight"></div>
<span id="BloodAura_name" style="display: none;">Improved Blood Presence</span><span id="BloodAura_icon" style="display: none;">spell_deathknight_bloodpresence</span>
<div class="rankCtr">
<span id="count_BloodAura">0</span><span>/</span><span id="total_BloodAura">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier7">
<div class="talent staticTip col0" id="ImprovedDeathStrike_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_butcher2.gif');">
<div class="talentHolder tier8 disabled" id="ImprovedDeathStrike" onmousedown="addTalent(event, 'ImprovedDeathStrike');" onmouseover="makeTalentTooltip('ImprovedDeathStrike');">
<span id="rank1_ImprovedDeathStrike" style="display: none">Increases the damage of your Death Strike by 15%, increases its critical strike chance by 3%, and increases the healing granted by 25%.</span><span id="rank2_ImprovedDeathStrike" style="display: none">Increases the damage of your Death Strike by 30%, increases its critical strike chance by 6%, and increases the healing granted by 50%.</span>
<div class="iconhighlight"></div>
<span id="ImprovedDeathStrike_name" style="display: none;">Improved Death Strike</span><span id="ImprovedDeathStrike_icon" style="display: none;">spell_deathknight_butcher2</span>
<div class="rankCtr">
<span id="count_ImprovedDeathStrike">0</span><span>/</span><span id="total_ImprovedDeathStrike">2</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="SuddenDoom_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_painspike.gif');">
<div class="talentHolder tier8 disabled" id="SuddenDoom" onmousedown="addTalent(event, 'SuddenDoom');" onmouseover="makeTalentTooltip('SuddenDoom');">
<span id="rank1_SuddenDoom" style="display: none">Your Blood Strikes and Heart Strikes have a 5% chance to launch a free Death Coil at your target.</span><span id="rank2_SuddenDoom" style="display: none">Your Blood Strikes and Heart Strikes have a 10% chance to launch a free Death Coil at your target.</span><span id="rank3_SuddenDoom" style="display: none">Your Blood Strikes and Heart Strikes have a 15% chance to launch a free Death Coil at your target.</span>
<div class="iconhighlight"></div>
<span id="SuddenDoom_name" style="display: none;">Sudden Doom</span><span id="SuddenDoom_icon" style="display: none;">spell_shadow_painspike</span>
<div class="rankCtr">
<span id="count_SuddenDoom">0</span><span>/</span><span id="total_SuddenDoom">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="VampiricBlood_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_lifedrain.gif');">
<div class="talentHolder tier8 disabled" id="VampiricBlood" onmousedown="addTalent(event, 'VampiricBlood');" onmouseover="makeTalentTooltip('VampiricBlood');">
<span id="rank1_VampiricBlood" style="display: none">Temporarily grants the Death Knight 15% of maximum health and increases the amount of health generated through spells and effects by 35% for 20 sec.  After the effect expires, the health is lost.</span><span id="spellInfo_VampiricBlood" style="display: none;"><span style="float: left;">1 Blood</span>
<br>
<span style="float: right;">2 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="VampiricBlood_name" style="display: none;">Vampiric Blood</span><span id="VampiricBlood_icon" style="display: none;">spell_shadow_lifedrain</span>
<div class="rankCtr">
<span id="count_VampiricBlood">0</span><span>/</span><span id="total_VampiricBlood">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier8">
<div class="talent staticTip col0" id="WilloftheNecropolis_iconHolder" style="background-image:url('images/icon43/grey/ability_creature_cursed_02.gif');">
<div class="talentHolder tier9 disabled" id="WilloftheNecropolis" onmousedown="addTalent(event, 'WilloftheNecropolis');" onmouseover="makeTalentTooltip('WilloftheNecropolis');">
<span id="rank1_WilloftheNecropolis" style="display: none">Damage that would take you below 35% health or taken while you are at 35% health is reduced by 5%.  This effect cannot occur more often than once every 15 sec and cannot be triggered by damage which deals less than 5% of your health.</span><span id="rank2_WilloftheNecropolis" style="display: none">Damage that would take you below 35% health or taken while you are at 35% health is reduced by 10%.  This effect cannot occur more often than once every 15 sec and cannot be triggered by damage which deals less than 5% of your health.</span><span id="rank3_WilloftheNecropolis" style="display: none">Damage that would take you below 35% health or taken while you are at 35% health is reduced by 15%.  This effect cannot occur more often than once every 15 sec and cannot be triggered by damage which deals less than 5% of your health.</span>
<div class="iconhighlight"></div>
<span id="WilloftheNecropolis_name" style="display: none;">Will of the Necropolis</span><span id="WilloftheNecropolis_icon" style="display: none;">ability_creature_cursed_02</span>
<div class="rankCtr">
<span id="count_WilloftheNecropolis">0</span><span>/</span><span id="total_WilloftheNecropolis">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="HeartStrike_iconHolder" style="background-image:url('images/icon43/grey/inv_weapon_shortblade_40.gif');">
<div class="talentHolder tier9 disabled" id="HeartStrike" onmousedown="addTalent(event, 'HeartStrike');" onmouseover="makeTalentTooltip('HeartStrike');">
<span id="rank1_HeartStrike" style="display: none">Instantly strike the target and his nearest ally, causing 50% weapon damage plus 125, total damage increased by 10% for each of your diseases on the target.</span><span id="spellInfo_HeartStrike" style="display: none;"><span style="float: right;">Melee range</span><span style="float: left;">1 Blood</span>
<br>
<span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="HeartStrike_name" style="display: none;">Heart Strike</span><span id="HeartStrike_icon" style="display: none;">inv_weapon_shortblade_40</span>
<div class="rankCtr">
<span id="count_HeartStrike">0</span><span>/</span><span id="total_HeartStrike">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="MightofMograine_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_classicon.gif');">
<div class="talentHolder tier9 disabled" id="MightofMograine" onmousedown="addTalent(event, 'MightofMograine');" onmouseover="makeTalentTooltip('MightofMograine');">
<span id="rank1_MightofMograine" style="display: none">Increases the critical strike damage damage bonus of your Blood Boil, Blood Strike, Death Strike, and Heart Strike abilities by 15%.</span><span id="rank2_MightofMograine" style="display: none">Increases the critical strike damage damage bonus of your Blood Boil, Blood Strike, Death Strike, and Heart Strike abilities by 30%.</span><span id="rank3_MightofMograine" style="display: none">Increases the critical strike damage damage bonus of your Blood Boil, Blood Strike, Death Strike, and Heart Strike abilities by 45%.</span>
<div class="iconhighlight"></div>
<span id="MightofMograine_name" style="display: none;">Might of Mograine</span><span id="MightofMograine_icon" style="display: none;">spell_deathknight_classicon</span>
<div class="rankCtr">
<span id="count_MightofMograine">0</span><span>/</span><span id="total_MightofMograine">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier9">
<div class="talent staticTip col1" id="BloodGorged_iconHolder" style="background-image:url('images/icon43/grey/spell_nature_reincarnation.gif');">
<div class="talentHolder tier10 disabled" id="BloodGorged" onmousedown="addTalent(event, 'BloodGorged');" onmouseover="makeTalentTooltip('BloodGorged');">
<span id="rank1_BloodGorged" style="display: none">When you are above 75% health, you deal 2% more damage.  In addition, your attacks ignore up to 2% of your opponent's armor at all times.</span><span id="rank2_BloodGorged" style="display: none">When you are above 75% health, you deal 4% more damage.  In addition, your attacks ignore up to 4% of your opponent's armor at all times.</span><span id="rank3_BloodGorged" style="display: none">When you are above 75% health, you deal 6% more damage.  In addition, your attacks ignore up to 6% of your opponent's armor at all times.</span><span id="rank4_BloodGorged" style="display: none">When you are above 75% health, you deal 8% more damage.  In addition, your attacks ignore up to 8% of your opponent's armor at all times.</span><span id="rank5_BloodGorged" style="display: none">When you are above 75% health, you deal 10% more damage.  In addition, your attacks ignore up to 10% of your opponent's armor at all times.</span>
<div class="iconhighlight"></div>
<span id="BloodGorged_name" style="display: none;">Blood Gorged</span><span id="BloodGorged_icon" style="display: none;">spell_nature_reincarnation</span>
<div class="rankCtr">
<span id="count_BloodGorged">0</span><span>/</span><span id="total_BloodGorged">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightBlood_tier10">
<div class="talent staticTip col1" id="DancingRuneblade_iconHolder" style="background-image:url('images/icon43/grey/inv_sword_07.gif');">
<div class="talentHolder tier11 disabled" id="DancingRuneblade" onmousedown="addTalent(event, 'DancingRuneblade');" onmouseover="makeTalentTooltip('DancingRuneblade');">
<span id="rank1_DancingRuneblade" style="display: none">Unleashes all available runic power to summon a second rune weapon that fights on its own for 5 sec plus 1 sec per 10 additional runic power, doing the same attacks as the Death Knight but for 50% reduced damage.</span><span id="spellInfo_DancingRuneblade" style="display: none;"><span style="float: right;">30 yd range</span><span style="float: left;">40 Runic Power</span>
<br>
<span style="float: right;">1.5 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="DancingRuneblade_name" style="display: none;">Dancing Rune Weapon</span><span id="DancingRuneblade_icon" style="display: none;">inv_sword_07</span>
<div class="rankCtr">
<span id="count_DancingRuneblade">0</span><span>/</span><span id="total_DancingRuneblade">1</span>
</div>
</div>
</div>
</div>
<a class="subtleResetButton" href="javascript:void(0)" onclick="resetTalents('DeathKnightBlood_tree', true);"><span>Reset</span></a>
<div class="talentTreeInfo" style="background: url(images/icon21.spell_deathknight_bloodpresence.png) 0 0 no-repeat;">
<span id="treeName_DeathKnightBlood_tree" style="font-weight: bold;">Blood</span> &nbsp;<span id="treespent_DeathKnightBlood_tree">0</span>
</div>
</div>
<div class="talentTree" id="DeathKnightFrost_tree" style="margin-right: 5px; background-image: url('images/talents/bg/DeathKnightFrost.jpg')">
<div class="tier" id="DeathKnightFrost_tier0">
<div class="talent staticTip col0" id="ImprovedIcyTouch_iconHolder" style="background-image:url('images/icon43/spell_deathknight_icetouch.gif');">
<div class="talentHolder tier1" id="ImprovedIcyTouch" onmousedown="addTalent(event, 'ImprovedIcyTouch');" onmouseover="makeTalentTooltip('ImprovedIcyTouch');">
<span id="rank1_ImprovedIcyTouch" style="display: none">Your Icy Touch does an additional 5% damage and your Frost Fever reduces melee and ranged attack speed by an additional 2%.</span><span id="rank2_ImprovedIcyTouch" style="display: none">Your Icy Touch does an additional 10% damage and your Frost Fever reduces melee and ranged attack speed by an additional 4%.</span><span id="rank3_ImprovedIcyTouch" style="display: none">Your Icy Touch does an additional 15% damage and your Frost Fever reduces melee and ranged attack speed by an additional 6%.</span>
<div class="iconhighlight"></div>
<span id="ImprovedIcyTouch_name" style="display: none;">Improved Icy Touch</span><span id="ImprovedIcyTouch_icon" style="display: none;">spell_deathknight_icetouch</span>
<div class="rankCtr">
<span id="count_ImprovedIcyTouch">0</span><span>/</span><span id="total_ImprovedIcyTouch">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="RunicPowerMastery_iconHolder" style="background-image:url('images/icon43/spell_arcane_arcane01.gif');">
<div class="talentHolder tier1" id="RunicPowerMastery" onmousedown="addTalent(event, 'RunicPowerMastery');" onmouseover="makeTalentTooltip('RunicPowerMastery');">
<span id="rank1_RunicPowerMastery" style="display: none">Increases your maximum Runic Power by 15.</span><span id="rank2_RunicPowerMastery" style="display: none">Increases your maximum Runic Power by 30.</span>
<div class="iconhighlight"></div>
<span id="RunicPowerMastery_name" style="display: none;">Runic Power Mastery</span><span id="RunicPowerMastery_icon" style="display: none;">spell_arcane_arcane01</span>
<div class="rankCtr">
<span id="count_RunicPowerMastery">0</span><span>/</span><span id="total_RunicPowerMastery">2</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Toughness_iconHolder" style="background-image:url('images/icon43/spell_holy_devotion.gif');">
<div class="talentHolder tier1" id="Toughness" onmousedown="addTalent(event, 'Toughness');" onmouseover="makeTalentTooltip('Toughness');">
<span id="rank1_Toughness" style="display: none">Increases your armor value from items by 3% and reduces the duration of all movement slowing effects by 6%.</span><span id="rank2_Toughness" style="display: none">Increases your armor value from items by 6% and reduces the duration of all movement slowing effects by 12%.</span><span id="rank3_Toughness" style="display: none">Increases your armor value from items by 9% and reduces the duration of all movement slowing effects by 18%.</span><span id="rank4_Toughness" style="display: none">Increases your armor value from items by 12% and reduces the duration of all movement slowing effects by 24%.</span><span id="rank5_Toughness" style="display: none">Increases your armor value from items by 15% and reduces the duration of all movement slowing effects by 30%.</span>
<div class="iconhighlight"></div>
<span id="Toughness_name" style="display: none;">Toughness</span><span id="Toughness_icon" style="display: none;">spell_holy_devotion</span>
<div class="rankCtr">
<span id="count_Toughness">0</span><span>/</span><span id="total_Toughness">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier1">
<div class="talent staticTip col1" id="IcyReach_iconHolder" style="background-image:url('images/icon43/grey/spell_frost_manarecharge.gif');">
<div class="talentHolder tier2 disabled" id="IcyReach" onmousedown="addTalent(event, 'IcyReach');" onmouseover="makeTalentTooltip('IcyReach');">
<span id="rank1_IcyReach" style="display: none">Increases the range of your Icy Touch,  Chains of Ice and Howling Blast by 5 yards.</span><span id="rank2_IcyReach" style="display: none">Increases the range of your Icy Touch, Chains of Ice and Howling Blast by 10 yards.</span>
<div class="iconhighlight"></div>
<span id="IcyReach_name" style="display: none;">Icy Reach</span><span id="IcyReach_icon" style="display: none;">spell_frost_manarecharge</span>
<div class="rankCtr">
<span id="count_IcyReach">0</span><span>/</span><span id="total_IcyReach">2</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="BlackIce_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_darkritual.gif');">
<div class="talentHolder tier2 disabled" id="BlackIce" onmousedown="addTalent(event, 'BlackIce');" onmouseover="makeTalentTooltip('BlackIce');">
<span id="rank1_BlackIce" style="display: none">Increases your Frost and Shadow damage by 2%.</span><span id="rank2_BlackIce" style="display: none">Increases your Frost and Shadow damage by 4%.</span><span id="rank3_BlackIce" style="display: none">Increases your Frost and Shadow damage by 6%.</span><span id="rank4_BlackIce" style="display: none">Increases your Frost and Shadow damage by 8%.</span><span id="rank5_BlackIce" style="display: none">Increases your Frost and Shadow damage by 10%.</span>
<div class="iconhighlight"></div>
<span id="BlackIce_name" style="display: none;">Black Ice</span><span id="BlackIce_icon" style="display: none;">spell_shadow_darkritual</span>
<div class="rankCtr">
<span id="count_BlackIce">0</span><span>/</span><span id="total_BlackIce">5</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="NervesofColdSteel_iconHolder" style="background-image:url('images/icon43/grey/ability_dualwield.gif');">
<div class="talentHolder tier2 disabled" id="NervesofColdSteel" onmousedown="addTalent(event, 'NervesofColdSteel');" onmouseover="makeTalentTooltip('NervesofColdSteel');">
<span id="rank1_NervesofColdSteel" style="display: none">Increases your chance to hit with one-handed melee weapons by 1% and increases the damage done by your offhand weapon by 5%.</span><span id="rank2_NervesofColdSteel" style="display: none">Increases your chance to hit with one-handed melee weapons by 2% and increases the damage done by your offhand weapon by 10%.</span><span id="rank3_NervesofColdSteel" style="display: none">Increases your chance to hit with one-handed melee weapons by 3% and increases the damage done by your offhand weapon by 15%.</span>
<div class="iconhighlight"></div>
<span id="NervesofColdSteel_name" style="display: none;">Nerves of Cold Steel</span><span id="NervesofColdSteel_icon" style="display: none;">ability_dualwield</span>
<div class="rankCtr">
<span id="count_NervesofColdSteel">0</span><span>/</span><span id="total_NervesofColdSteel">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier2">
<div class="talent staticTip col0" id="IcyTalons_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_icytalons.gif');">
<div class="talentHolder tier3 requires t_ImprovedIcyTouch disabled" id="IcyTalons" onmousedown="addTalent(event, 'IcyTalons');" onmouseover="makeTalentTooltip('IcyTalons');">
<span id="rank1_IcyTalons" style="display: none">You leech heat from victims of your Frost Fever, so that when their melee attack speed is reduced, yours increases by 4% for the next 20 sec.</span><span id="rank2_IcyTalons" style="display: none">You leech heat from victims of your Frost Fever, so that when their melee attack speed is reduced, yours increases by 8% for the next 20 sec.</span><span id="rank3_IcyTalons" style="display: none">You leech heat from victims of your Frost Fever, so that when their melee attack speed is reduced, yours increases by 12% for the next 20 sec.</span><span id="rank4_IcyTalons" style="display: none">You leech heat from victims of your Frost Fever, so that when their melee attack speed is reduced, yours increases by 16% for the next 20 sec.</span><span id="rank5_IcyTalons" style="display: none">You leech heat from victims of your Frost Fever, so that when their melee attack speed is reduced, yours increases by 20% for the next 20 sec.</span>
<div class="iconhighlight"></div>
<span id="IcyTalons_name" style="display: none;">Icy Talons</span><span id="IcyTalons_icon" style="display: none;">spell_deathknight_icytalons</span>
<div class="rankCtr">
<span id="count_IcyTalons">0</span><span>/</span><span id="total_IcyTalons">5</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Lichborne_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_raisedead.gif');">
<div class="talentHolder tier3 disabled" id="Lichborne" onmousedown="addTalent(event, 'Lichborne');" onmouseover="makeTalentTooltip('Lichborne');">
<span id="rank1_Lichborne" style="display: none">Draw upon unholy energy to become undead for 15 sec.  While undead, you are immune to Charm, Fear and Sleep effects.</span><span id="spellInfo_Lichborne" style="display: none;"><span style="float: right;">3 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="Lichborne_name" style="display: none;">Lichborne</span><span id="Lichborne_icon" style="display: none;">spell_shadow_raisedead</span>
<div class="rankCtr">
<span id="count_Lichborne">0</span><span>/</span><span id="total_Lichborne">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Annihilation_iconHolder" style="background-image:url('images/icon43/grey/inv_weapon_hand_18.gif');">
<div class="talentHolder tier3 disabled" id="Annihilation" onmousedown="addTalent(event, 'Annihilation');" onmouseover="makeTalentTooltip('Annihilation');">
<span id="rank1_Annihilation" style="display: none">Increases the critical strike chance of your melee special abilities by 1%.  In addition, there is a 33% chance that your Obliterate will do its damage without consuming diseases.</span><span id="rank2_Annihilation" style="display: none">Increases the critical strike chance of your melee special abilities by 2%.  In addition, there is a 66% chance that your Obliterate will do its damage without consuming diseases.</span><span id="rank3_Annihilation" style="display: none">Increases the critical strike chance of your melee special abilities by 3%.  In addition, there is a 100% chance that your Obliterate will do its damage without consuming diseases.</span>
<div class="iconhighlight"></div>
<span id="Annihilation_name" style="display: none;">Annihilation</span><span id="Annihilation_icon" style="display: none;">inv_weapon_hand_18</span>
<div class="rankCtr">
<span id="count_Annihilation">0</span><span>/</span><span id="total_Annihilation">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier3">
<div class="talent staticTip col1" id="KillingMachine_iconHolder" style="background-image:url('images/icon43/grey/inv_sword_122.gif');">
<div class="talentHolder tier4 disabled" id="KillingMachine" onmousedown="addTalent(event, 'KillingMachine');" onmouseover="makeTalentTooltip('KillingMachine');">
<span id="rank1_KillingMachine" style="display: none">Your melee attacks have a chance to make your next Icy Touch, Howling Blast or Frost Strike a critical strike.</span><span id="rank2_KillingMachine" style="display: none">Your melee attacks have a chance to make your next Icy Touch, Howling Blast or Frost Strike a critical strike.  Effect occurs more often than Killing Machine (Rank 1).</span><span id="rank3_KillingMachine" style="display: none">Your melee attacks have a chance to make your next Icy Touch, Howling Blast or Frost Strike a critical strike.  Effect occurs more often than Killing Machine (Rank 2).</span><span id="rank4_KillingMachine" style="display: none">Your melee attacks have a chance to make your next Icy Touch, Howling Blast or Frost Strike a critical strike.  Effect occurs more often than Killing Machine (Rank 3).</span><span id="rank5_KillingMachine" style="display: none">Your melee attacks have a chance to make your next Icy Touch, Howling Blast or Frost Strike a critical strike.  Effect occurs more often than Killing Machine (Rank 4).</span>
<div class="iconhighlight"></div>
<span id="KillingMachine_name" style="display: none;">Killing Machine</span><span id="KillingMachine_icon" style="display: none;">inv_sword_122</span>
<div class="rankCtr">
<span id="count_KillingMachine">0</span><span>/</span><span id="total_KillingMachine">5</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="ChilloftheGrave_iconHolder" style="background-image:url('images/icon43/grey/spell_frost_frostshock.gif');">
<div class="talentHolder tier4 disabled" id="ChilloftheGrave" onmousedown="addTalent(event, 'ChilloftheGrave');" onmouseover="makeTalentTooltip('ChilloftheGrave');">
<span id="rank1_ChilloftheGrave" style="display: none">Your Chains of Ice, Howling Blast, Icy Touch and Obliterate generate 2.5 additional runic power.</span><span id="rank2_ChilloftheGrave" style="display: none">Your Chains of Ice, Howling Blast, Icy Touch and Obliterate generate 5 additional runic power.</span>
<div class="iconhighlight"></div>
<span id="ChilloftheGrave_name" style="display: none;">Chill of the Grave</span><span id="ChilloftheGrave_icon" style="display: none;">spell_frost_frostshock</span>
<div class="rankCtr">
<span id="count_ChilloftheGrave">0</span><span>/</span><span id="total_ChilloftheGrave">2</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="EndlessWinter_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_twilight.gif');">
<div class="talentHolder tier4 disabled" id="EndlessWinter" onmousedown="addTalent(event, 'EndlessWinter');" onmouseover="makeTalentTooltip('EndlessWinter');">
<span id="rank1_EndlessWinter" style="display: none">Your Chains of Ice has a 50% chance to cause Frost Fever and the cost of your Mind Freeze is reduced to 10 runic power.</span><span id="rank2_EndlessWinter" style="display: none">Your Chains of Ice has a 100% chance to cause Frost Fever and the cost of your Mind Freeze is reduced to no runic power.</span>
<div class="iconhighlight"></div>
<span id="EndlessWinter_name" style="display: none;">Endless Winter</span><span id="EndlessWinter_icon" style="display: none;">spell_shadow_twilight</span>
<div class="rankCtr">
<span id="count_EndlessWinter">0</span><span>/</span><span id="total_EndlessWinter">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier4">
<div class="talent staticTip col1" id="FrigidDreadplate_iconHolder" style="background-image:url('images/icon43/grey/inv_chest_mail_04.gif');">
<div class="talentHolder tier5 disabled" id="FrigidDreadplate" onmousedown="addTalent(event, 'FrigidDreadplate');" onmouseover="makeTalentTooltip('FrigidDreadplate');">
<span id="rank1_FrigidDreadplate" style="display: none">Reduces the chance melee attacks will hit you by 1%.</span><span id="rank2_FrigidDreadplate" style="display: none">Reduces the chance melee attacks will hit you by 2%.</span><span id="rank3_FrigidDreadplate" style="display: none">Reduces the chance melee attacks will hit you by 3%.</span>
<div class="iconhighlight"></div>
<span id="FrigidDreadplate_name" style="display: none;">Frigid Dreadplate</span><span id="FrigidDreadplate_icon" style="display: none;">inv_chest_mail_04</span>
<div class="rankCtr">
<span id="count_FrigidDreadplate">0</span><span>/</span><span id="total_FrigidDreadplate">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="GlacierRot_iconHolder" style="background-image:url('images/icon43/grey/spell_nature_removedisease.gif');">
<div class="talentHolder tier5 disabled" id="GlacierRot" onmousedown="addTalent(event, 'GlacierRot');" onmouseover="makeTalentTooltip('GlacierRot');">
<span id="rank1_GlacierRot" style="display: none">Diseased enemies take 7% more damage from your Icy Touch, Howling Blast and Frost Strike.</span><span id="rank2_GlacierRot" style="display: none">Diseased enemies take 13% more damage from your Icy Touch, Howling Blast and Frost Strike.</span><span id="rank3_GlacierRot" style="display: none">Diseased enemies take 20% more damage from your Icy Touch, Howling Blast and Frost Strike.</span>
<div class="iconhighlight"></div>
<span id="GlacierRot_name" style="display: none;">Glacier Rot</span><span id="GlacierRot_icon" style="display: none;">spell_nature_removedisease</span>
<div class="rankCtr">
<span id="count_GlacierRot">0</span><span>/</span><span id="total_GlacierRot">3</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="Deathchill_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_soulleech_2.gif');">
<div class="talentHolder tier5 disabled" id="Deathchill" onmousedown="addTalent(event, 'Deathchill');" onmouseover="makeTalentTooltip('Deathchill');">
<span id="rank1_Deathchill" style="display: none">When activated, makes your next Icy Touch, Howling Blast, Frost Strike or Obliterate a critical hit if used within 30 sec.</span><span id="spellInfo_Deathchill" style="display: none;"><span style="float: right;">2 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="Deathchill_name" style="display: none;">Deathchill</span><span id="Deathchill_icon" style="display: none;">spell_shadow_soulleech_2</span>
<div class="rankCtr">
<span id="count_Deathchill">0</span><span>/</span><span id="total_Deathchill">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier5">
<div class="talent staticTip col0" id="ImprovedIcyTalons_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_icytalons.gif');">
<div class="talentHolder tier6 requires t_IcyTalons disabled" id="ImprovedIcyTalons" onmousedown="addTalent(event, 'ImprovedIcyTalons');" onmouseover="makeTalentTooltip('ImprovedIcyTalons');">
<span id="rank1_ImprovedIcyTalons" style="display: none">Your Icy Talons effect increases the melee haste of your group or raid by 20% for the next 20 sec.  In addition, increases your haste by 5% at all times.</span>
<div class="iconhighlight"></div>
<span id="ImprovedIcyTalons_name" style="display: none;">Improved Icy Talons</span><span id="ImprovedIcyTalons_icon" style="display: none;">spell_deathknight_icytalons</span>
<div class="rankCtr">
<span id="count_ImprovedIcyTalons">0</span><span>/</span><span id="total_ImprovedIcyTalons">1</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="MercilessCombat_iconHolder" style="background-image:url('images/icon43/grey/inv_sword_112.gif');">
<div class="talentHolder tier6 disabled" id="MercilessCombat" onmousedown="addTalent(event, 'MercilessCombat');" onmouseover="makeTalentTooltip('MercilessCombat');">
<span id="rank1_MercilessCombat" style="display: none">Your Icy Touch, Howling Blast, Obliterate and Frost Strike do an additional 6% damage when striking targets with less than 35% health.</span><span id="rank2_MercilessCombat" style="display: none">Your Icy Touch, Howling Blast, Obliterate and Frost Strike do an additional 12% damage when striking targets with less than 35% health.</span>
<div class="iconhighlight"></div>
<span id="MercilessCombat_name" style="display: none;">Merciless Combat</span><span id="MercilessCombat_icon" style="display: none;">inv_sword_112</span>
<div class="rankCtr">
<span id="count_MercilessCombat">0</span><span>/</span><span id="total_MercilessCombat">2</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Rime_iconHolder" style="background-image:url('images/icon43/grey/spell_frost_freezingbreath.gif');">
<div class="talentHolder tier6 disabled" id="Rime" onmousedown="addTalent(event, 'Rime');" onmouseover="makeTalentTooltip('Rime');">
<span id="rank1_Rime" style="display: none">Increases the critical strike chance of your Icy Touch and Obliterate by 5% and casting Obliterate has a 5% chance to reset the cooldown on Howling Blast and cause your next Howling Blast to consume no runes.</span><span id="rank2_Rime" style="display: none">Increases the critical strike chance of your Icy Touch and Obliterate by 10% and casting Obliterate has a 10% chance to reset the cooldown on Howling Blast and cause your next Howling Blast to consume no runes.</span><span id="rank3_Rime" style="display: none">Increases the critical strike chance of your Icy Touch and Obliterate by 15% and casting Obliterate has a 15% chance to reset the cooldown on Howling Blast and cause your next Howling Blast to consume no runes.</span>
<div class="iconhighlight"></div>
<span id="Rime_name" style="display: none;">Rime</span><span id="Rime_icon" style="display: none;">spell_frost_freezingbreath</span>
<div class="rankCtr">
<span id="count_Rime">0</span><span>/</span><span id="total_Rime">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier6">
<div class="talent staticTip col0" id="Chilblains_iconHolder" style="background-image:url('images/icon43/grey/spell_frost_wisp.gif');">
<div class="talentHolder tier7 disabled" id="Chilblains" onmousedown="addTalent(event, 'Chilblains');" onmouseover="makeTalentTooltip('Chilblains');">
<span id="rank1_Chilblains" style="display: none">Victims of your Frost Fever disease are Chilled, reducing movement speed by 15% for 10 sec.</span><span id="rank2_Chilblains" style="display: none">Victims of your Frost Fever disease are Chilled, reducing movement speed by 30% for 10 sec.</span><span id="rank3_Chilblains" style="display: none">Victims of your Frost Fever disease are Chilled, reducing movement speed by 50% for 10 sec.</span>
<div class="iconhighlight"></div>
<span id="Chilblains_name" style="display: none;">Chilblains</span><span id="Chilblains_icon" style="display: none;">spell_frost_wisp</span>
<div class="rankCtr">
<span id="count_Chilblains">0</span><span>/</span><span id="total_Chilblains">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="HungeringCold_iconHolder" style="background-image:url('images/icon43/grey/inv_staff_15.gif');">
<div class="talentHolder tier7 disabled" id="HungeringCold" onmousedown="addTalent(event, 'HungeringCold');" onmouseover="makeTalentTooltip('HungeringCold');">
<span id="rank1_HungeringCold" style="display: none">Purges the earth around the Death Knight of all heat.  Enemies within 10 yards are trapped in ice, preventing them from performing any action for 10 sec and infecting them with Frost Fever.  Enemies are considered Frozen, but any damage other than diseases will break the ice.</span><span id="spellInfo_HungeringCold" style="display: none;"><span style="float: left;">40 Runic Power</span>
<br>
<span style="float: right;">1 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="HungeringCold_name" style="display: none;">Hungering Cold</span><span id="HungeringCold_icon" style="display: none;">inv_staff_15</span>
<div class="rankCtr">
<span id="count_HungeringCold">0</span><span>/</span><span id="total_HungeringCold">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="FrostAura_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_frostpresence.gif');">
<div class="talentHolder tier7 disabled" id="FrostAura" onmousedown="addTalent(event, 'FrostAura');" onmouseover="makeTalentTooltip('FrostAura');">
<span id="rank1_FrostAura" style="display: none">While in Blood Presence or Unholy Presence, you retain 5% health from Frost Presence, and damage done to you is decreased by an additional 1% in Frost Presence.</span><span id="rank2_FrostAura" style="display: none">While in Blood Presence or Unholy Presence, you retain 10% health from Frost Presence, and damage done to you is decreased by an additional 2% in Frost Presence.</span>
<div class="iconhighlight"></div>
<span id="FrostAura_name" style="display: none;">Improved Frost Presence</span><span id="FrostAura_icon" style="display: none;">spell_deathknight_frostpresence</span>
<div class="rankCtr">
<span id="count_FrostAura">0</span><span>/</span><span id="total_FrostAura">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier7">
<div class="talent staticTip col1" id="BloodoftheNorth_iconHolder" style="background-image:url('images/icon43/grey/inv_weapon_shortblade_79.gif');">
<div class="talentHolder tier8 disabled" id="BloodoftheNorth" onmousedown="addTalent(event, 'BloodoftheNorth');" onmouseover="makeTalentTooltip('BloodoftheNorth');">
<span id="rank1_BloodoftheNorth" style="display: none">Increases Blood Strike and Frost Strike damage by 3%.  In addition, whenever you hit with Blood Strike or Pestilence there is a 20% chance that the Blood Rune will become a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank2_BloodoftheNorth" style="display: none">Increases Blood Strike and Frost Strike damage by 6%.  In addition, whenever you hit with Blood Strike or Pestilence there is a 40% chance that the Blood Rune will become a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank3_BloodoftheNorth" style="display: none">Increases Blood Strike and Frost Strike damage by 9%.  In addition, whenever you hit with Blood Strike or Pestilence there is a 60% chance that the Blood Rune will become a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank4_BloodoftheNorth" style="display: none">Increases Blood Strike and Frost Strike damage by 12%.  In addition, whenever you hit with Blood Strike or Pestilence there is a 80% chance that the Blood Rune will become a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank5_BloodoftheNorth" style="display: none">Increases Blood Strike and Frost Strike damage by 15%.  In addition, whenever you hit with Blood Strike or Pestilence there is a 100% chance that the Blood Rune will become a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span>
<div class="iconhighlight"></div>
<span id="BloodoftheNorth_name" style="display: none;">Blood of the North</span><span id="BloodoftheNorth_icon" style="display: none;">inv_weapon_shortblade_79</span>
<div class="rankCtr">
<span id="count_BloodoftheNorth">0</span><span>/</span><span id="total_BloodoftheNorth">5</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="UnbreakableArmor_iconHolder" style="background-image:url('images/icon43/grey/inv_armor_helm_plate_naxxramas_raidwarrior_c_01.gif');">
<div class="talentHolder tier8 disabled" id="UnbreakableArmor" onmousedown="addTalent(event, 'UnbreakableArmor');" onmouseover="makeTalentTooltip('UnbreakableArmor');">
<span id="rank1_UnbreakableArmor" style="display: none">Reinforces your armor with a thick coat of ice, reducing damage from all attacks by 100 and increasing your Strength by 25% for 20 sec.  The amount of damage reduced increases as your armor increases.</span><span id="spellInfo_UnbreakableArmor" style="display: none;"><span style="float: left;">1 Frost</span>
<br>
<span style="float: right;">2 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="UnbreakableArmor_name" style="display: none;">Unbreakable Armor</span><span id="UnbreakableArmor_icon" style="display: none;">inv_armor_helm_plate_naxxramas_raidwarrior_c_01</span>
<div class="rankCtr">
<span id="count_UnbreakableArmor">0</span><span>/</span><span id="total_UnbreakableArmor">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier8">
<div class="talent staticTip col0" id="Acclimation_iconHolder" style="background-image:url('images/icon43/grey/spell_fire_elementaldevastation.gif');">
<div class="talentHolder tier9 disabled" id="Acclimation" onmousedown="addTalent(event, 'Acclimation');" onmouseover="makeTalentTooltip('Acclimation');">
<span id="rank1_Acclimation" style="display: none">When you are hit by a spell, you have a 10% chance to boost your resistance to that type of magic for 18 sec.  Stacks up to 3 times.</span><span id="rank2_Acclimation" style="display: none">When you are hit by a spell, you have a 20% chance to boost your resistance to that type of magic for 18 sec.  Stacks up to 3 times.</span><span id="rank3_Acclimation" style="display: none">When you are hit by a spell, you have a 30% chance to boost your resistance to that type of magic for 18 sec.  Stacks up to 3 times.</span>
<div class="iconhighlight"></div>
<span id="Acclimation_name" style="display: none;">Acclimation</span><span id="Acclimation_icon" style="display: none;">spell_fire_elementaldevastation</span>
<div class="rankCtr">
<span id="count_Acclimation">0</span><span>/</span><span id="total_Acclimation">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="FrostStrike_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_empowerruneblade2.gif');">
<div class="talentHolder tier9 disabled" id="FrostStrike" onmousedown="addTalent(event, 'FrostStrike');" onmouseover="makeTalentTooltip('FrostStrike');">
<span id="rank1_FrostStrike" style="display: none">Instantly strike the enemy, causing 60% weapon damage plus 52 as Frost damage.  Can't be dodged, blocked, or parried.</span><span id="spellInfo_FrostStrike" style="display: none;"><span style="float: right;">Melee range</span><span style="float: left;">40 Runic Power</span>
<br>
<span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="FrostStrike_name" style="display: none;">Frost Strike</span><span id="FrostStrike_icon" style="display: none;">spell_deathknight_empowerruneblade2</span>
<div class="rankCtr">
<span id="count_FrostStrike">0</span><span>/</span><span id="total_FrostStrike">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="GuileofGorefiend_iconHolder" style="background-image:url('images/icon43/grey/inv-sword_53.gif');">
<div class="talentHolder tier9 disabled" id="GuileofGorefiend" onmousedown="addTalent(event, 'GuileofGorefiend');" onmouseover="makeTalentTooltip('GuileofGorefiend');">
<span id="rank1_GuileofGorefiend" style="display: none">Increases the critical strike damage bonus of your Blood Strike, Frost Strike, Howling Blast and Obliterate abilities by 15%, and increases the duration of your Icebound Fortitude by 2 secs.</span><span id="rank2_GuileofGorefiend" style="display: none">Increases the critical strike damage bonus of your Blood Strike, Frost Strike, Howling Blast and Obliterate abilities by 30%, and increases the duration of your Icebound Fortitude by 4 secs.</span><span id="rank3_GuileofGorefiend" style="display: none">Increases the critical strike damage bonus of your Blood Strike, Frost Strike, Howling Blast and Obliterate abilities by 45%, and increases the duration of your Icebound Fortitude by 6 secs.</span>
<div class="iconhighlight"></div>
<span id="GuileofGorefiend_name" style="display: none;">Guile of Gorefiend</span><span id="GuileofGorefiend_icon" style="display: none;">inv-sword_53</span>
<div class="rankCtr">
<span id="count_GuileofGorefiend">0</span><span>/</span><span id="total_GuileofGorefiend">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier9">
<div class="talent staticTip col1" id="TundraStalker_iconHolder" style="background-image:url('images/icon43/grey/spell_nature_tranquility.gif');">
<div class="talentHolder tier10 disabled" id="TundraStalker" onmousedown="addTalent(event, 'TundraStalker');" onmouseover="makeTalentTooltip('TundraStalker');">
<span id="rank1_TundraStalker" style="display: none">Your spells and abilities deal 3% more damage to targets infected with Frost Fever.  Also increases your expertise by 1.</span><span id="rank2_TundraStalker" style="display: none">Your spells and abilities deal 6% more damage to targets infected with Frost Fever.  Also increases your expertise by 2.</span><span id="rank3_TundraStalker" style="display: none">Your spells and abilities deal 9% more damage to targets infected with Frost Fever.  Also increases your expertise by 3.</span><span id="rank4_TundraStalker" style="display: none">Your spells and abilities deal 12% more damage to targets infected with Frost Fever.  Also increases your expertise by 4.</span><span id="rank5_TundraStalker" style="display: none">Your spells and abilities deal 15% more damage to targets infected with Frost Fever.  Also increases your expertise by 5.</span>
<div class="iconhighlight"></div>
<span id="TundraStalker_name" style="display: none;">Tundra Stalker</span><span id="TundraStalker_icon" style="display: none;">spell_nature_tranquility</span>
<div class="rankCtr">
<span id="count_TundraStalker">0</span><span>/</span><span id="total_TundraStalker">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightFrost_tier10">
<div class="talent staticTip col1" id="HowlingBlast_iconHolder" style="background-image:url('images/icon43/grey/spell_frost_arcticwinds.gif');">
<div class="talentHolder tier11 disabled" id="HowlingBlast" onmousedown="addTalent(event, 'HowlingBlast');" onmouseover="makeTalentTooltip('HowlingBlast');">
<span id="rank1_HowlingBlast" style="display: none">Blast the target with a frigid wind dealing 198 to 214 Frost damage to all enemies within 10 yards.</span><span id="spellInfo_HowlingBlast" style="display: none;"><span style="float: right;">20 yd range</span><span style="float: left;">1 Unholy,1 Frost</span>
<br>
<span style="float: right;">8 sec cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="HowlingBlast_name" style="display: none;">Howling Blast</span><span id="HowlingBlast_icon" style="display: none;">spell_frost_arcticwinds</span>
<div class="rankCtr">
<span id="count_HowlingBlast">0</span><span>/</span><span id="total_HowlingBlast">1</span>
</div>
</div>
</div>
</div>
<a class="subtleResetButton" href="javascript:void(0)" onclick="resetTalents('DeathKnightFrost_tree', true);"><span>Reset</span></a>
<div class="talentTreeInfo" style="background: url(images/icon21.spell_deathknight_frostpresence.png) 0 0 no-repeat;">
<span id="treeName_DeathKnightFrost_tree" style="font-weight: bold;">Frost</span> &nbsp;<span id="treespent_DeathKnightFrost_tree">0</span>
</div>
</div>
<div class="talentTree" id="DeathKnightUnholy_tree" style="background-image: url('images/talents/bg/DeathKnightUnholy.jpg');">
<div class="tier" id="DeathKnightUnholy_tier0">
<div class="talent staticTip col0" id="ViciousStrikes_iconHolder" style="background-image:url('images/icon43/spell_deathknight_plaguestrike.gif');">
<div class="talentHolder tier1" id="ViciousStrikes" onmousedown="addTalent(event, 'ViciousStrikes');" onmouseover="makeTalentTooltip('ViciousStrikes');">
<span id="rank1_ViciousStrikes" style="display: none">Increases the critical strike chance by 3% and critical strike damage bonus by 15% of your Plague Strike and Scourge Strike.</span><span id="rank2_ViciousStrikes" style="display: none">Increases the critical strike chance by 6% and critical strike damage bonus by 30% of your Plague Strike and Scourge Strike.</span>
<div class="iconhighlight"></div>
<span id="ViciousStrikes_name" style="display: none;">Vicious Strikes</span><span id="ViciousStrikes_icon" style="display: none;">spell_deathknight_plaguestrike</span>
<div class="rankCtr">
<span id="count_ViciousStrikes">0</span><span>/</span><span id="total_ViciousStrikes">2</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Virulence_iconHolder" style="background-image:url('images/icon43/spell_shadow_burningspirit.gif');">
<div class="talentHolder tier1" id="Virulence" onmousedown="addTalent(event, 'Virulence');" onmouseover="makeTalentTooltip('Virulence');">
<span id="rank1_Virulence" style="display: none">Increases your chance to hit with your spells by 1% and reduces the chance that your damage over time diseases can be cured by 10%.</span><span id="rank2_Virulence" style="display: none">Increases your chance to hit with your spells by 2% and reduces the chance that your damage over time diseases can be cured by 20%.</span><span id="rank3_Virulence" style="display: none">Increases your chance to hit with your spells by 3% and reduces the chance that your damage over time diseases can be cured by 30%.</span>
<div class="iconhighlight"></div>
<span id="Virulence_name" style="display: none;">Virulence</span><span id="Virulence_icon" style="display: none;">spell_shadow_burningspirit</span>
<div class="rankCtr">
<span id="count_Virulence">0</span><span>/</span><span id="total_Virulence">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Anticipation_iconHolder" style="background-image:url('images/icon43/spell_nature_mirrorimage.gif');">
<div class="talentHolder tier1" id="Anticipation" onmousedown="addTalent(event, 'Anticipation');" onmouseover="makeTalentTooltip('Anticipation');">
<span id="rank1_Anticipation" style="display: none">Increases your Dodge chance by 1%.</span><span id="rank2_Anticipation" style="display: none">Increases your Dodge chance by 2%.</span><span id="rank3_Anticipation" style="display: none">Increases your Dodge chance by 3%.</span><span id="rank4_Anticipation" style="display: none">Increases your Dodge chance by 4%.</span><span id="rank5_Anticipation" style="display: none">Increases your Dodge chance by 5%.</span>
<div class="iconhighlight"></div>
<span id="Anticipation_name" style="display: none;">Anticipation</span><span id="Anticipation_icon" style="display: none;">spell_nature_mirrorimage</span>
<div class="rankCtr">
<span id="count_Anticipation">0</span><span>/</span><span id="total_Anticipation">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier1">
<div class="talent staticTip col0" id="Epidemic_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_shadowwordpain.gif');">
<div class="talentHolder tier2 disabled" id="Epidemic" onmousedown="addTalent(event, 'Epidemic');" onmouseover="makeTalentTooltip('Epidemic');">
<span id="rank1_Epidemic" style="display: none">Increases the duration of Blood Plague and Frost Fever by 3 sec.</span><span id="rank2_Epidemic" style="display: none">Increases the duration of Blood Plague and Frost Fever by 6 sec.</span>
<div class="iconhighlight"></div>
<span id="Epidemic_name" style="display: none;">Epidemic</span><span id="Epidemic_icon" style="display: none;">spell_shadow_shadowwordpain</span>
<div class="rankCtr">
<span id="count_Epidemic">0</span><span>/</span><span id="total_Epidemic">2</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Morbidity_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_deathanddecay.gif');">
<div class="talentHolder tier2 disabled" id="Morbidity" onmousedown="addTalent(event, 'Morbidity');" onmouseover="makeTalentTooltip('Morbidity');">
<span id="rank1_Morbidity" style="display: none">Increases the damage and healing of Death Coil by 5% and reduces the cooldown on Death and Decay by 5 sec.</span><span id="rank2_Morbidity" style="display: none">Increases the damage and healing of Death Coil by 10% and reduces the cooldown on Death and Decay by 10 sec.</span><span id="rank3_Morbidity" style="display: none">Increases the damage and healing of Death Coil by 15% and reduces the cooldown on Death and Decay by 15 sec.</span>
<div class="iconhighlight"></div>
<span id="Morbidity_name" style="display: none;">Morbidity</span><span id="Morbidity_icon" style="display: none;">spell_shadow_deathanddecay</span>
<div class="rankCtr">
<span id="count_Morbidity">0</span><span>/</span><span id="total_Morbidity">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="UnholyCommand_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_strangulate.gif');">
<div class="talentHolder tier2 disabled" id="UnholyCommand" onmousedown="addTalent(event, 'UnholyCommand');" onmouseover="makeTalentTooltip('UnholyCommand');">
<span id="rank1_UnholyCommand" style="display: none">Reduces the cooldown of your Death Grip ability by 5 sec.</span><span id="rank2_UnholyCommand" style="display: none">Reduces the cooldown of your Death Grip ability by 10 sec.</span>
<div class="iconhighlight"></div>
<span id="UnholyCommand_name" style="display: none;">Unholy Command</span><span id="UnholyCommand_icon" style="display: none;">spell_deathknight_strangulate</span>
<div class="rankCtr">
<span id="count_UnholyCommand">0</span><span>/</span><span id="total_UnholyCommand">2</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="RavenousDead_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_gnaw_ghoul.gif');">
<div class="talentHolder tier2 disabled" id="RavenousDead" onmousedown="addTalent(event, 'RavenousDead');" onmouseover="makeTalentTooltip('RavenousDead');">
<span id="rank1_RavenousDead" style="display: none">Increases your total Strength by 1% and the contribution your Ghouls get from your Strength and Stamina by 20%.</span><span id="rank2_RavenousDead" style="display: none">Increases your total Strength by 2% and the contribution your Ghouls get from your Strength and Stamina by 40%.</span><span id="rank3_RavenousDead" style="display: none">Increases your total Strength by 3% and the contribution your Ghouls get from your Strength and Stamina by 60%</span>
<div class="iconhighlight"></div>
<span id="RavenousDead_name" style="display: none;">Ravenous Dead</span><span id="RavenousDead_icon" style="display: none;">spell_deathknight_gnaw_ghoul</span>
<div class="rankCtr">
<span id="count_RavenousDead">0</span><span>/</span><span id="total_RavenousDead">3</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier2">
<div class="talent staticTip col0" id="Outbreak_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_plaguecloud.gif');">
<div class="talentHolder tier3 disabled" id="Outbreak" onmousedown="addTalent(event, 'Outbreak');" onmouseover="makeTalentTooltip('Outbreak');">
<span id="rank1_Outbreak" style="display: none">Increases the damage of Plague Strike by 10% and Scourge Strike by 7%.</span><span id="rank2_Outbreak" style="display: none">Increases the damage of Plague Strike by 20% and Scourge Strike by 13%.</span><span id="rank3_Outbreak" style="display: none">Increases the damage of Plague Strike by 30% and Scourge Strike by 20%.</span>
<div class="iconhighlight"></div>
<span id="Outbreak_name" style="display: none;">Outbreak</span><span id="Outbreak_icon" style="display: none;">spell_shadow_plaguecloud</span>
<div class="rankCtr">
<span id="count_Outbreak">0</span><span>/</span><span id="total_Outbreak">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Necrosis_iconHolder" style="background-image:url('images/icon43/grey/inv_weapon_shortblade_60.gif');">
<div class="talentHolder tier3 disabled" id="Necrosis" onmousedown="addTalent(event, 'Necrosis');" onmouseover="makeTalentTooltip('Necrosis');">
<span id="rank1_Necrosis" style="display: none">Your auto attacks deal an additional 4% Shadow damage.</span><span id="rank2_Necrosis" style="display: none">Your auto attacks deal an additional 8% Shadow damage.</span><span id="rank3_Necrosis" style="display: none">Your auto attacks deal an additional 12% Shadow damage.</span><span id="rank4_Necrosis" style="display: none">Your auto attacks deal an additional 16% Shadow damage.</span><span id="rank5_Necrosis" style="display: none">Your auto attacks deal an additional 20% Shadow damage.</span>
<div class="iconhighlight"></div>
<span id="Necrosis_name" style="display: none;">Necrosis</span><span id="Necrosis_icon" style="display: none;">inv_weapon_shortblade_60</span>
<div class="rankCtr">
<span id="count_Necrosis">0</span><span>/</span><span id="total_Necrosis">5</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="CorpseExplosion_iconHolder" style="background-image:url('images/icon43/grey/ability_creature_disease_02.gif');">
<div class="talentHolder tier3 disabled" id="CorpseExplosion" onmousedown="addTalent(event, 'CorpseExplosion');" onmouseover="makeTalentTooltip('CorpseExplosion');">
<span id="rank1_CorpseExplosion" style="display: none">Cause a corpse to explode for 166 Shadow damage to all enemies within 10 yards.  Will use a nearby corpse if the target is not a corpse.  Does not affect mechanical or elemental corpses.</span><span id="spellInfo_CorpseExplosion" style="display: none;"><span style="float: right;">30 yd range</span><span style="float: left;">40 Runic Power</span>
<br>
<span style="float: right;">5 sec cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="CorpseExplosion_name" style="display: none;">Corpse Explosion</span><span id="CorpseExplosion_icon" style="display: none;">ability_creature_disease_02</span>
<div class="rankCtr">
<span id="count_CorpseExplosion">0</span><span>/</span><span id="total_CorpseExplosion">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier3">
<div class="talent staticTip col1" id="OnaPaleHorse_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_summondeathcharger.gif');">
<div class="talentHolder tier4 disabled" id="OnaPaleHorse" onmousedown="addTalent(event, 'OnaPaleHorse');" onmouseover="makeTalentTooltip('OnaPaleHorse');">
<span id="rank1_OnaPaleHorse" style="display: none">You become as hard to stop as death itself.  The duration of all Stun and Fear effects used against you is reduced by 10%, and your mounted speed is increased by 10%.  This does not stack with other movement speed increasing effects.</span><span id="rank2_OnaPaleHorse" style="display: none">You become as hard to stop as death itself.  The duration of all Stun and Fear effects used against you is reduced by 20%, and your mounted speed is increased by 20%.  This does not stack with other movement speed increasing effects.</span>
<div class="iconhighlight"></div>
<span id="OnaPaleHorse_name" style="display: none;">On a Pale Horse</span><span id="OnaPaleHorse_icon" style="display: none;">spell_deathknight_summondeathcharger</span>
<div class="rankCtr">
<span id="count_OnaPaleHorse">0</span><span>/</span><span id="total_OnaPaleHorse">2</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="BloodCakedBlade_iconHolder" style="background-image:url('images/icon43/grey/ability_criticalstrike.gif');">
<div class="talentHolder tier4 disabled" id="BloodCakedBlade" onmousedown="addTalent(event, 'BloodCakedBlade');" onmouseover="makeTalentTooltip('BloodCakedBlade');">
<span id="rank1_BloodCakedBlade" style="display: none">Your auto attacks have a 10% chance to cause a Blood-Caked Strike, which hits for 25% weapon damage plus 12.5% for each of your diseases on the target.</span><span id="rank2_BloodCakedBlade" style="display: none">Your auto attacks have a 20% chance to cause a Blood-Caked Strike, which hits for 25% weapon damage plus 12.5% for each of your diseases on the target.</span><span id="rank3_BloodCakedBlade" style="display: none">Your auto attacks have a 30% chance to cause a Blood-Caked Strike, which hits for 25% weapon damage plus 12.5% for each of your diseases on the target.</span>
<div class="iconhighlight"></div>
<span id="BloodCakedBlade_name" style="display: none;">Blood-Caked Blade</span><span id="BloodCakedBlade_icon" style="display: none;">ability_criticalstrike</span>
<div class="rankCtr">
<span id="count_BloodCakedBlade">0</span><span>/</span><span id="total_BloodCakedBlade">3</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="NightoftheDead_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_armyofthedead.gif');">
<div class="talentHolder tier4 disabled" id="NightoftheDead" onmousedown="addTalent(event, 'NightoftheDead');" onmouseover="makeTalentTooltip('NightoftheDead');">
<span id="rank1_NightoftheDead" style="display: none">Reduces the cooldown on Raise Dead by 45 sec. and the cooldown on Army of the Dead by 5 min.  Also reduces the damage your pet takes from area of effect attacks by 40%.</span><span id="rank2_NightoftheDead" style="display: none">Reduces the cooldown on Raise Dead by 90 sec. and the cooldown on Army of the Dead by 10 min.  Also reduces the damage your pet takes from area of effect attacks by 70%.</span>
<div class="iconhighlight"></div>
<span id="NightoftheDead_name" style="display: none;">Night of the Dead</span><span id="NightoftheDead_icon" style="display: none;">spell_deathknight_armyofthedead</span>
<div class="rankCtr">
<span id="count_NightoftheDead">0</span><span>/</span><span id="total_NightoftheDead">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier4">
<div class="talent staticTip col0" id="UnholyBlight_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_contagion.gif');">
<div class="talentHolder tier5 disabled" id="UnholyBlight" onmousedown="addTalent(event, 'UnholyBlight');" onmouseover="makeTalentTooltip('UnholyBlight');">
<span id="rank1_UnholyBlight" style="display: none">A vile swarm of unholy insects surrounds the Death Knight for a 10 yard radius.  Enemies caught in the area take 21 Shadow damage per sec.  Lasts 20 sec.</span><span id="spellInfo_UnholyBlight" style="display: none;"><span style="float: left;">40 Runic Power</span>
<br>
<span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="UnholyBlight_name" style="display: none;">Unholy Blight</span><span id="UnholyBlight_icon" style="display: none;">spell_shadow_contagion</span>
<div class="rankCtr">
<span id="count_UnholyBlight">0</span><span>/</span><span id="total_UnholyBlight">1</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="Impurity_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_shadowandflame.gif');">
<div class="talentHolder tier5 disabled" id="Impurity" onmousedown="addTalent(event, 'Impurity');" onmouseover="makeTalentTooltip('Impurity');">
<span id="rank1_Impurity" style="display: none">The attack power bonus of your spells is increased by 4%.</span><span id="rank2_Impurity" style="display: none">The attack power bonus of your spells is increased by 8%.</span><span id="rank3_Impurity" style="display: none">The attack power bonus of your spells is increased by 12%.</span><span id="rank4_Impurity" style="display: none">The attack power bonus of your spells is increased by 16%.</span><span id="rank5_Impurity" style="display: none">Your spells receive an additional 20% benefit from your attack power.</span>
<div class="iconhighlight"></div>
<span id="Impurity_name" style="display: none;">Impurity</span><span id="Impurity_icon" style="display: none;">spell_shadow_shadowandflame</span>
<div class="rankCtr">
<span id="count_Impurity">0</span><span>/</span><span id="total_Impurity">5</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Dirge_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_shadesofdarkness.gif');">
<div class="talentHolder tier5 disabled" id="Dirge" onmousedown="addTalent(event, 'Dirge');" onmouseover="makeTalentTooltip('Dirge');">
<span id="rank1_Dirge" style="display: none">Your Death Strike, Obliterate, Plague Strike and Scourge Strike generate 2.5 additional runic power.</span><span id="rank2_Dirge" style="display: none">Your Death Strike, Obliterate, Plague Strike and Scourge Strike generate 5 additional runic power.</span>
<div class="iconhighlight"></div>
<span id="Dirge_name" style="display: none;">Dirge</span><span id="Dirge_icon" style="display: none;">spell_shadow_shadesofdarkness</span>
<div class="rankCtr">
<span id="count_Dirge">0</span><span>/</span><span id="total_Dirge">2</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier5">
<div class="talent staticTip col1" id="MagicSuppression_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_antimagicshell.gif');">
<div class="talentHolder tier6 disabled" id="MagicSuppression" onmousedown="addTalent(event, 'MagicSuppression');" onmouseover="makeTalentTooltip('MagicSuppression');">
<span id="rank1_MagicSuppression" style="display: none">You take 2% less damage from all magic.  In addition, your Anti-Magic Shell absorbs an additional 8% of spell damage.</span><span id="rank2_MagicSuppression" style="display: none">You take 4% less damage from all magic.  In addition, your Anti-Magic Shell absorbs an additional 16% of spell damage.</span><span id="rank3_MagicSuppression" style="display: none">You take 6% less damage from all magic.  In addition, your Anti-Magic Shell absorbs an additional 25% of spell damage.</span>
<div class="iconhighlight"></div>
<span id="MagicSuppression_name" style="display: none;">Magic Suppression</span><span id="MagicSuppression_icon" style="display: none;">spell_shadow_antimagicshell</span>
<div class="rankCtr">
<span id="count_MagicSuppression">0</span><span>/</span><span id="total_MagicSuppression">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="Reaping_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_shadetruesight.gif');">
<div class="talentHolder tier6 disabled" id="Reaping" onmousedown="addTalent(event, 'Reaping');" onmouseover="makeTalentTooltip('Reaping');">
<span id="rank1_Reaping" style="display: none">Whenever you hit with Blood Strike or Pestilence there is a 33% chance that the Blood Rune becomes a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank2_Reaping" style="display: none">Whenever you hit with Blood Strike or Pestilence there is a 66% chance that the Blood Rune becomes a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span><span id="rank3_Reaping" style="display: none">Whenever you hit with Blood Strike or Pestilence there is a 100% chance that the Blood Rune becomes a Death Rune when it activates.  Death Runes count as a Blood, Frost or Unholy Rune.</span>
<div class="iconhighlight"></div>
<span id="Reaping_name" style="display: none;">Reaping</span><span id="Reaping_icon" style="display: none;">spell_shadow_shadetruesight</span>
<div class="rankCtr">
<span id="count_Reaping">0</span><span>/</span><span id="total_Reaping">3</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="MasterofGhouls_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_animatedead.gif');">
<div class="talentHolder tier6 requires t_NightoftheDead disabled" id="MasterofGhouls" onmousedown="addTalent(event, 'MasterofGhouls');" onmouseover="makeTalentTooltip('MasterofGhouls');">
<span id="rank1_MasterofGhouls" style="display: none">Reduces the cooldown on Raise Dead by 60 sec., and the Ghoul summoned by your Raise Dead spell is considered a pet under your control.  Unlike normal Death Knight Ghouls, your pet does not have a limited duration.</span>
<div class="iconhighlight"></div>
<span id="MasterofGhouls_name" style="display: none;">Master of Ghouls</span><span id="MasterofGhouls_icon" style="display: none;">spell_shadow_animatedead</span>
<div class="rankCtr">
<span id="count_MasterofGhouls">0</span><span>/</span><span id="total_MasterofGhouls">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier6">
<div class="talent staticTip col0" id="Desecration_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_shadowfiend.gif');">
<div class="talentHolder tier7 disabled" id="Desecration" onmousedown="addTalent(event, 'Desecration');" onmouseover="makeTalentTooltip('Desecration');">
<span id="rank1_Desecration" style="display: none">Your Plague Strikes and Scourge Strikes cause the Desecrated Ground effect.  Targets in the area are slowed by 10% by the grasping arms of the dead while you cause 1% additional damage while standing on the unholy ground.  Lasts 12 sec.</span><span id="rank2_Desecration" style="display: none">Your Plague Strikes and Scourge Strikes cause the Desecrated Ground effect.  Targets in the area are slowed by 20% by the grasping arms of the dead while you cause 2% additional damage while standing on the unholy ground.  Lasts 12 sec.</span><span id="rank3_Desecration" style="display: none">Your Plague Strikes and Scourge Strikes cause the Desecrated Ground effect.  Targets in the area are slowed by 30% by the grasping arms of the dead while you cause 3% additional damage while standing on the unholy ground.  Lasts 12 sec.</span><span id="rank4_Desecration" style="display: none">Your Plague Strikes and Scourge Strikes cause the Desecrated Ground effect.  Targets in the area are slowed by 40% by the grasping arms of the dead while you cause 4% additional damage while standing on the unholy ground.  Lasts 12 sec.</span><span id="rank5_Desecration" style="display: none">Your Plague Strikes and Scourge Strikes cause the Desecrated Ground effect.  Targets in the area are slowed by 50% by the grasping arms of the dead while you cause 5% additional damage while standing on the unholy ground.  Lasts 12 sec.</span>
<div class="iconhighlight"></div>
<span id="Desecration_name" style="display: none;">Desecration</span><span id="Desecration_icon" style="display: none;">spell_shadow_shadowfiend</span>
<div class="rankCtr">
<span id="count_Desecration">0</span><span>/</span><span id="total_Desecration">5</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="AntiMagicZone_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_antimagiczone.gif');">
<div class="talentHolder tier7 requires t_MagicSuppression disabled" id="AntiMagicZone" onmousedown="addTalent(event, 'AntiMagicZone');" onmouseover="makeTalentTooltip('AntiMagicZone');">
<span id="rank1_AntiMagicZone" style="display: none">Places a large, stationary Anti-Magic Zone that reduces spell damage done to party or raid members inside it by 75%.  The Anti-Magic Zone lasts for 10 sec or until it absorbs 10052 spell damage.</span><span id="spellInfo_AntiMagicZone" style="display: none;"><span style="float: left;">1 Unholy</span>
<br>
<span style="float: right;">2 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="AntiMagicZone_name" style="display: none;">Anti-Magic Zone</span><span id="AntiMagicZone_icon" style="display: none;">spell_deathknight_antimagiczone</span>
<div class="rankCtr">
<span id="count_AntiMagicZone">0</span><span>/</span><span id="total_AntiMagicZone">1</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="UnholyAura_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_unholypresence.gif');">
<div class="talentHolder tier7 disabled" id="UnholyAura" onmousedown="addTalent(event, 'UnholyAura');" onmouseover="makeTalentTooltip('UnholyAura');">
<span id="rank1_UnholyAura" style="display: none">While in Blood Presence or Frost Presence, you retain 8% increased movement speed from Unholy Presence, and your runes finish their cooldowns 5% faster in Unholy Presence.</span><span id="rank2_UnholyAura" style="display: none">While in Blood Presence or Frost Presence, you retain 15% increased movement speed from Unholy Presence, and your runes finish their cooldowns 10% faster in Unholy Presence.</span>
<div class="iconhighlight"></div>
<span id="UnholyAura_name" style="display: none;">Improved Unholy Presence</span><span id="UnholyAura_icon" style="display: none;">spell_deathknight_unholypresence</span>
<div class="rankCtr">
<span id="count_UnholyAura">0</span><span>/</span><span id="total_UnholyAura">2</span>
</div>
</div>
</div>
<div class="talent staticTip col3" id="GhoulFrenzy_iconHolder" style="background-image:url('images/icon43/grey/ability_ghoulfrenzy.gif');">
<div class="talentHolder tier7 requires t_MasterofGhouls disabled" id="GhoulFrenzy" onmousedown="addTalent(event, 'GhoulFrenzy');" onmouseover="makeTalentTooltip('GhoulFrenzy');">
<span id="rank1_GhoulFrenzy" style="display: none">Grants your pet 25% haste for 30 sec and  heals it for 60% of its health over the duration.</span><span id="spellInfo_GhoulFrenzy" style="display: none;"><span style="float: right;">45 yd range</span><span style="float: left;">1 Unholy</span>
<br>
<span style="float: right;">10 sec cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="GhoulFrenzy_name" style="display: none;">Ghoul Frenzy</span><span id="GhoulFrenzy_icon" style="display: none;">ability_ghoulfrenzy</span>
<div class="rankCtr">
<span id="count_GhoulFrenzy">0</span><span>/</span><span id="total_GhoulFrenzy">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier7">
<div class="talent staticTip col1" id="CryptFever_iconHolder" style="background-image:url('images/icon43/grey/spell_nature_nullifydisease.gif');">
<div class="talentHolder tier8 disabled" id="CryptFever" onmousedown="addTalent(event, 'CryptFever');" onmouseover="makeTalentTooltip('CryptFever');">
<span id="rank1_CryptFever" style="display: none">Your diseases also cause Crypt Fever, which increases disease damage taken by the target by 10%.</span><span id="rank2_CryptFever" style="display: none">Your diseases also cause Crypt Fever, which increases disease damage taken by the target by 20%.</span><span id="rank3_CryptFever" style="display: none">Your diseases also cause Crypt Fever, which increases disease damage taken by the target by 30%.</span>
<div class="iconhighlight"></div>
<span id="CryptFever_name" style="display: none;">Crypt Fever</span><span id="CryptFever_icon" style="display: none;">spell_nature_nullifydisease</span>
<div class="rankCtr">
<span id="count_CryptFever">0</span><span>/</span><span id="total_CryptFever">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="BoneShield_iconHolder" style="background-image:url('images/icon43/grey/inv_chest_leather_13.gif');">
<div class="talentHolder tier8 disabled" id="BoneShield" onmousedown="addTalent(event, 'BoneShield');" onmouseover="makeTalentTooltip('BoneShield');">
<span id="rank1_BoneShield" style="display: none">The Death Knight is surrounded by 4 whirling bones.  While at least 1 bone remains, he takes 20% less damage from all sources and deals 2% more damage with all attacks, spells and abilities.  Each damaging attack that lands consumes 1 bone.  Lasts 5 min.</span><span id="spellInfo_BoneShield" style="display: none;"><span style="float: left;">1 Unholy</span>
<br>
<span style="float: right;">2 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="BoneShield_name" style="display: none;">Bone Shield</span><span id="BoneShield_icon" style="display: none;">inv_chest_leather_13</span>
<div class="rankCtr">
<span id="count_BoneShield">0</span><span>/</span><span id="total_BoneShield">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier8">
<div class="talent staticTip col0" id="WanderingPlague_iconHolder" style="background-image:url('images/icon43/grey/spell_shadow_callofbone.gif');">
<div class="talentHolder tier9 disabled" id="WanderingPlague" onmousedown="addTalent(event, 'WanderingPlague');" onmouseover="makeTalentTooltip('WanderingPlague');">
<span id="rank1_WanderingPlague" style="display: none">When your diseases damage an enemy, there is a chance equal to your melee critical strike chance that they will cause 33% additional damage to the target and all enemies within 8 yards.  Ignores any target under the effect of a spell that is cancelled by taking damage.</span><span id="rank2_WanderingPlague" style="display: none">When your diseases damage an enemy, there is a chance equal to your melee critical strike chance that they will cause 66% additional damage to the target and all enemies within 8 yards.  Ignores any target under the effect of a spell that is cancelled by taking damage.</span><span id="rank3_WanderingPlague" style="display: none">When your diseases damage an enemy, there is a chance equal to your melee critical strike chance that they will cause 100% additional damage to the target and all enemies within 8 yards.  Ignores any target under the effect of a spell that is cancelled by taking damage.</span>
<div class="iconhighlight"></div>
<span id="WanderingPlague_name" style="display: none;">Wandering Plague</span><span id="WanderingPlague_icon" style="display: none;">spell_shadow_callofbone</span>
<div class="rankCtr">
<span id="count_WanderingPlague">0</span><span>/</span><span id="total_WanderingPlague">3</span>
</div>
</div>
</div>
<div class="talent staticTip col1" id="EbonPlaguebringer_iconHolder" style="background-image:url('images/icon43/grey/ability_creature_cursed_03.gif');">
<div class="talentHolder tier9 requires t_CryptFever disabled" id="EbonPlaguebringer" onmousedown="addTalent(event, 'EbonPlaguebringer');" onmouseover="makeTalentTooltip('EbonPlaguebringer');">
<span id="rank1_EbonPlaguebringer" style="display: none">Your Crypt Fever morphs into Ebon Plague, which increases magic damage taken by 4% in addition to increasing disease damage taken.  Improves your critical strike chance with weapons and spells by 1% at all times.</span><span id="rank2_EbonPlaguebringer" style="display: none">Your Crypt Fever morphs into Ebon Plague, which increases magic damage taken by 9% in addition to increasing disease damage taken.  Improves your critical strike chance with weapons and spells by 2% at all times.</span><span id="rank3_EbonPlaguebringer" style="display: none">Your Crypt Fever morphs into Ebon Plague, which increases magic damage taken by 13% in addition to increasing disease damage taken.  Improves your critical strike chance with weapons and spells by 3% at all times.</span>
<div class="iconhighlight"></div>
<span id="EbonPlaguebringer_name" style="display: none;">Ebon Plaguebringer</span><span id="EbonPlaguebringer_icon" style="display: none;">ability_creature_cursed_03</span>
<div class="rankCtr">
<span id="count_EbonPlaguebringer">0</span><span>/</span><span id="total_EbonPlaguebringer">3</span>
</div>
</div>
</div>
<div class="talent staticTip col2" id="ScourgeStrike_iconHolder" style="background-image:url('images/icon43/grey/spell_deathknight_scourgestrike.gif');">
<div class="talentHolder tier9 disabled" id="ScourgeStrike" onmousedown="addTalent(event, 'ScourgeStrike');" onmouseover="makeTalentTooltip('ScourgeStrike');">
<span id="rank1_ScourgeStrike" style="display: none">An unholy strike that deals 45% of weapon damage as Shadow damage plus 152, total damage increased 11% per each of your diseases on the target.</span><span id="spellInfo_ScourgeStrike" style="display: none;"><span style="float: right;">Melee range</span><span style="float: left;">1 Unholy,1 Frost</span>
<br>
<span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="ScourgeStrike_name" style="display: none;">Scourge Strike</span><span id="ScourgeStrike_icon" style="display: none;">spell_deathknight_scourgestrike</span>
<div class="rankCtr">
<span id="count_ScourgeStrike">0</span><span>/</span><span id="total_ScourgeStrike">1</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier9">
<div class="talent staticTip col1" id="RageofRivendare_iconHolder" style="background-image:url('images/icon43/grey/inv_weapon_halberd14.gif');">
<div class="talentHolder tier10 disabled" id="RageofRivendare" onmousedown="addTalent(event, 'RageofRivendare');" onmouseover="makeTalentTooltip('RageofRivendare');">
<span id="rank1_RageofRivendare" style="display: none">Your spells and abilities deal 2% more damage to targets infected with Blood Plague.  Also increases your expertise by 1.</span><span id="rank2_RageofRivendare" style="display: none">Your spells and abilities deal 4% more damage to targets infected with Blood Plague.  Also increases your expertise by 2.</span><span id="rank3_RageofRivendare" style="display: none">Your spells and abilities deal 6% more damage to targets infected with Blood Plague.  Also increases your expertise by 3.</span><span id="rank4_RageofRivendare" style="display: none">Your spells and abilities deal 8% more damage to targets infected with Blood Plague.  Also increases your expertise by 4.</span><span id="rank5_RageofRivendare" style="display: none">Your spells and abilities deal 10% more damage to targets infected with Blood Plague.  Also increases your expertise by 5.</span>
<div class="iconhighlight"></div>
<span id="RageofRivendare_name" style="display: none;">Rage of Rivendare</span><span id="RageofRivendare_icon" style="display: none;">inv_weapon_halberd14</span>
<div class="rankCtr">
<span id="count_RageofRivendare">0</span><span>/</span><span id="total_RageofRivendare">5</span>
</div>
</div>
</div>
</div>
<div class="tier" id="DeathKnightUnholy_tier10">
<div class="talent staticTip col1" id="SummonGargoyle_iconHolder" style="background-image:url('images/icon43/grey/ability_hunter_pet_bat.gif');">
<div class="talentHolder tier11 disabled" id="SummonGargoyle" onmousedown="addTalent(event, 'SummonGargoyle');" onmouseover="makeTalentTooltip('SummonGargoyle');">
<span id="rank1_SummonGargoyle" style="display: none">A Gargoyle flies into the area and bombards the target with Nature damage modified by the Death Knight's attack power.  Persists for 10 sec plus 1 sec per 3 runic power up to 40 sec.</span><span id="spellInfo_SummonGargoyle" style="display: none;"><span style="float: right;">30 yd range</span><span style="float: left;">50 Runic Power</span>
<br>
<span style="float: right;">3 min cooldown</span><span style="float: left;">Instant</span></span>
<div class="iconhighlight"></div>
<span id="SummonGargoyle_name" style="display: none;">Summon Gargoyle</span><span id="SummonGargoyle_icon" style="display: none;">ability_hunter_pet_bat</span>
<div class="rankCtr">
<span id="count_SummonGargoyle">0</span><span>/</span><span id="total_SummonGargoyle">1</span>
</div>
</div>
</div>
</div>
<a class="subtleResetButton" href="javascript:void(0)" onclick="resetTalents('DeathKnightUnholy_tree', true);"><span>Reset</span></a>
<div class="talentTreeInfo" style="background: url(images/icon21.spell_deathknight_unholypresence.png) 0 0 no-repeat;">
<span id="treeName_DeathKnightUnholy_tree" style="font-weight: bold;">Unholy</span> &nbsp;<span id="treespent_DeathKnightUnholy_tree">0</span>
</div>
</div>
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
</div>