<?php
$_FPREFIX = '../';
exit;
set_time_limit(0);
include('../init.php');
$file = file_get_contents('Spell.dbc.CSV');
$struct = " uint32    Id;                                           // 0        m_ID
    uint32    Category;                                     // 1        m_category
    uint32    Dispel;                                       // 2        m_dispelType
    uint32    Mechanic;                                     // 3        m_mechanic
    uint32    Attributes;                                   // 4        m_attribute
    uint32    AttributesEx;                                 // 5        m_attributesEx
    uint32    AttributesEx2;                                // 6        m_attributesExB
    uint32    AttributesEx3;                                // 7        m_attributesExC
    uint32    AttributesEx4;                                // 8        m_attributesExD
    uint32    AttributesEx5;                                // 9        m_attributesExE
    uint32    AttributesEx6;                                // 10       m_attributesExF
    uint32    Stances;                                      // 11       m_shapeshiftMask
    uint32    StancesNot;                                   // 12       m_shapeshiftExclude
    uint32    Targets;                                      // 13       m_targets
    uint32    TargetCreatureType;                           // 14       m_targetCreatureType
    uint32    RequiresSpellFocus;                           // 15       m_requiresSpellFocus
    uint32    FacingCasterFlags;                            // 16       m_facingCasterFlags
    uint32    CasterAuraState;                              // 17       m_casterAuraState
    uint32    TargetAuraState;                              // 18       m_targetAuraState
    uint32    CasterAuraStateNot;                           // 19       m_excludeCasterAuraState
    uint32    TargetAuraStateNot;                           // 20       m_excludeTargetAuraState
    uint32    casterAuraSpell;                              // 21       m_casterAuraSpell
    uint32    targetAuraSpell;                              // 22       m_targetAuraSpell
    uint32    excludeCasterAuraSpell;                       // 23       m_excludeCasterAuraSpell
    uint32    excludeTargetAuraSpell;                       // 24       m_excludeTargetAuraSpell
    uint32    CastingTimeIndex;                             // 25       m_castingTimeIndex
    uint32    RecoveryTime;                                 // 26       m_recoveryTime
    uint32    CategoryRecoveryTime;                         // 27       m_categoryRecoveryTime
    uint32    InterruptFlags;                               // 28       m_interruptFlags
    uint32    AuraInterruptFlags;                           // 29       m_auraInterruptFlags
    uint32    ChannelInterruptFlags;                        // 30       m_channelInterruptFlags
    uint32    procFlags;                                    // 31       m_procTypeMask
    uint32    procChance;                                   // 32       m_procChance
    uint32    procCharges;                                  // 33       m_procCharges
    uint32    maxLevel;                                     // 34       m_maxLevel
    uint32    baseLevel;                                    // 35       m_baseLevel
    uint32    spellLevel;                                   // 36       m_spellLevel
    uint32    DurationIndex;                                // 37       m_durationIndex
    uint32    powerType;                                    // 38       m_powerType
    uint32    manaCost;                                     // 39       m_manaCost
    uint32    manaCostPerlevel;                             // 40       m_manaCostPerLevel
    uint32    manaPerSecond;                                // 41       m_manaPerSecond
    uint32    manaPerSecondPerLevel;                        // 42       m_manaPerSecondPerLeve
    uint32    rangeIndex;                                   // 43       m_rangeIndex
    float     speed;                                        // 44       m_speed
    //uint32    modalNextSpell;                             // 45       m_modalNextSpell not used
    uint32    StackAmount;                                  // 46       m_cumulativeAura
    uint32    Totem[2];                                     // 47-48    m_totem
    int32     Reagent[8];                                   // 49-56    m_reagent
    uint32    ReagentCount[8];                              // 57-64    m_reagentCount
    int32     EquippedItemClass;                            // 65       m_equippedItemClass (value)
    int32     EquippedItemSubClassMask;                     // 66       m_equippedItemSubclass (mask)
    int32     EquippedItemInventoryTypeMask;                // 67       m_equippedItemInvTypes (mask)
    uint32    Effect[MAX_SPELL_EFFECTS];                    // 68-70    m_effect
    int32     EffectDieSides[MAX_SPELL_EFFECTS];            // 71-73    m_effectDieSides
    int32     EffectBaseDice[MAX_SPELL_EFFECTS];            // 74-76    m_effectBaseDice
    float     EffectDicePerLevel[MAX_SPELL_EFFECTS];        // 77-79    m_effectDicePerLevel
    float     EffectRealPointsPerLevel[MAX_SPELL_EFFECTS];  // 80-82    m_effectRealPointsPerLevel
    int32     EffectBasePoints[MAX_SPELL_EFFECTS];          // 83-85    m_effectBasePoints (don't must be used in spell/auras explicitly, must be used cached Spell::m_currentBasePoints)
    uint32    EffectMechanic[MAX_SPELL_EFFECTS];            // 86-88    m_effectMechanic
    uint32    EffectImplicitTargetA[MAX_SPELL_EFFECTS];     // 89-91    m_implicitTargetA
    uint32    EffectImplicitTargetB[MAX_SPELL_EFFECTS];     // 92-94    m_implicitTargetB
    uint32    EffectRadiusIndex[MAX_SPELL_EFFECTS];         // 95-97    m_effectRadiusIndex - spellradius.dbc
    uint32    EffectApplyAuraName[MAX_SPELL_EFFECTS];       // 98-100   m_effectAura
    uint32    EffectAmplitude[MAX_SPELL_EFFECTS];           // 101-103  m_effectAuraPeriod
    float     EffectMultipleValue[MAX_SPELL_EFFECTS];       // 104-106  m_effectAmplitude
    uint32    EffectChainTarget[MAX_SPELL_EFFECTS];         // 107-109  m_effectChainTargets
    uint32    EffectItemType[MAX_SPELL_EFFECTS];            // 110-112  m_effectItemType
    int32     EffectMiscValue[MAX_SPELL_EFFECTS];           // 113-115  m_effectMiscValue
    int32     EffectMiscValueB[MAX_SPELL_EFFECTS];          // 116-118  m_effectMiscValueB
    uint32    EffectTriggerSpell[MAX_SPELL_EFFECTS];        // 119-121  m_effectTriggerSpell
    float     EffectPointsPerComboPoint[MAX_SPELL_EFFECTS]; // 122-124  m_effectPointsPerCombo
    flag96    EffectSpellClassMask[MAX_SPELL_EFFECTS];      // 125-133
    uint32    SpellVisual[2];                               // 134-135  m_spellVisualID
    uint32    SpellIconID;                                  // 136      m_spellIconID
    uint32    activeIconID;                                 // 137      m_activeIconID
    //uint32    spellPriority;                              // 138 not used
    char*     SpellName[16];                                // 139-154  m_name_lang
    //uint32    SpellNameFlag;                              // 155 not used
    char*     Rank[16];                                     // 156-171  m_nameSubtext_lang
    //uint32    RankFlags;                                  // 172 not used
    //char*     Description[16];                            // 173-188  m_description_lang not used
    //uint32    DescriptionFlags;                           // 189 not used
    //char*     ToolTip[16];                                // 190-205  m_auraDescription_lang not used
    //uint32    ToolTipFlags;                               // 206 not used
    uint32    ManaCostPercentage;                           // 207      m_manaCostPct
    uint32    StartRecoveryCategory;                        // 208      m_startRecoveryCategory
    uint32    StartRecoveryTime;                            // 209      m_startRecoveryTime
    uint32    MaxTargetLevel;                               // 210      m_maxTargetLevel
    uint32    SpellFamilyName;                              // 211      m_spellClassSet
    flag96    SpellFamilyFlags;                             // 212-214
    uint32    MaxAffectedTargets;                           // 215      m_maxTargets
    uint32    DmgClass;                                     // 216      m_defenseType
    uint32    PreventionType;                               // 217      m_preventionType
    //uint32    StanceBarOrder;                             // 218      m_stanceBarOrder not used
    float     DmgMultiplier[3];                             // 219-221  m_effectChainAmplitude
    //uint32    MinFactionId;                               // 222      m_minFactionID not used
    //uint32    MinReputation;                              // 223      m_minReputation not used
    //uint32    RequiredAuraVision;                         // 224      m_requiredAuraVision not used
    uint32    TotemCategory[2];                             // 225-226  m_requiredTotemCategoryID
    int32     AreaGroupId;                                  // 227      m_requiredAreaGroupId
    uint32    SchoolMask;                                   // 228      m_schoolMask
    uint32    runeCostID;                                   // 229      m_runeCostID
    //uint32    spellMissileID;                             // 230      m_spellMissileID not used
    //uint32  PowerDisplayId;                               // 231 PowerDisplay.dbc, new in 3.1";

$st = explode("\n",$struct);
/*foreach($st as $record) {
	$record = explode(' ',$record);
	$rec=array();
	foreach($record as $cos) {
		if($cos!='') array_push($rec,str_replace(';','',$cos)); 
	}
	if(strpos($rec[1],'[')!==false) {
		$rec[1] = explode('[',$rec[1]);
		$rec[1] = $rec[1][0].'_';
		$range = explode('-',$rec[3]);
		$i = 1;
		while(($range[0]++)<=$range[1]) {
			$query .= '`'.$rec[1].($i++).'` ';
			if(strpos($rec[0],'int')!==false) $query .= 'INT(100)';
			else $query .= 'TEXT';
			$query.=' NOT NULL,
			';
			$co++;
		}
	}else{
		$query .= '`'.$rec[1].'` ';
		if(strpos($rec[0],'int')!==false) $query .= 'INT(100)';
		else $query .= 'TEXT';
		$query.=' NOT NULL,
		';
		$co++;
	}
	
}
echo $co;
*/

$need = array("Id","SpellName","Description","Rank","EffectBasePoints","EffectBaseDice","EffectDieSides","DurationIndex","EffectAmplitude","EffectChainTarget","MaxAffectedTargets","AffectedTargetLevel","StackAmount","EffectRadiusIndex","EffectPointsPerComboPoint","EffectMultipleValue","DmgMultiplier","EffectMiscValue","procChance","procCharges","SpellIconID");

$pola = array();

foreach($need as $ne) {
	$dane = false;
	foreach($st as $record) {
		$record = explode(' ',$record);
		$rec=array();
		foreach($record as $cos) {
			if($cos!='') array_push($rec,str_replace(';','',$cos)); 
		}
		$rec[1] = explode('[',$rec[1]);
		$rec[1] = $rec[1][0];
		//echo $rec[1];
		if($rec[1]==$ne) {
			$dane = $rec;
			break;
		}else; //echo $rec[1].' '.$ne.'<br>';
		
	}
	if($dane) {
		if($dane[1]=='Id') $dane[1] = 'id';
		if(strpos($dane[3],'-')!==false && $dane[1]!='SpellName' && $dane[1] !='Description' && $dane[1] !='Rank') {
			for($i=0;$i<3;$i++) {
				$query .= '`'.$dane[1].'_'.($i+1).'` ';
				$dane[3] = explode('-',$dane[3]);
				$dane[3] =$dane[3][0];
				if(strpos($dane[0],'int')!==false) $query .= 'BIGINT(20)';
				else $query .= 'TEXT';
				$query.=' NOT NULL, ';
				array_push($pola,array($dane[1].'_'.($i+1), $dane[3]+$i ) );
			}
		}else{
			$query .= '`'.$dane[1].'` ';
			if(strpos($dane[0],'int')!==false) $query .= 'BIGINT(20)';
			else $query .= 'TEXT';
			$query.=' NOT NULL, ';
			$dane[3] = explode('-',$dane[3]);
			$dane[3] =$dane[3][0];
			array_push($pola,array($dane[1], $dane[3]) );
		}
		
	}
}
//var_dump($pola);
echo 'CREATE TABLE spell_new ('.$query.'PRIMARY KEY  (`Id`))';
//echo $query;
//$file=array();
$file = explode("\n",$file);
foreach($file as $row) {
	$row = explode(',',$row);
	//echo count($row);exit;
	$q=$pl='';
	foreach($pola as $col) {
		//echo $row[$col[1]];
		if($q!='') $q.=', ';
		if($pl!='') $pl.=', ';
		$pl.="`".$col[0]."`";
		if($col[0] == 'Description') {
			for($i=1;$i<16;$i++) {
				if($row[$col[1]+$i][0]=='0') break;
				$row[$col[1]].=$row[$col[1]+$i];
			}
		}
		$q.="'".addslashes(str_replace('"','',$row[$col[1]]))."'";	
	}
if($mysql->query("insert into ?1.spell_new (?3) values(?2)",$config['armoryDB'],$q,$pl)) $ct++;
//else die($mysql->Query);
	//else ;//die(mysql_error());
	//else {if(mysql_error()=='')echo mysql_error().substr($q,0,-10);$cos=explode(',',substr($q,0,-15));echo 'da: '.count($cos);exit;}
	//echo '<br>';
}
echo $ct;
?>