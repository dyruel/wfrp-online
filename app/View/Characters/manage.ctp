<?php

$this->Html->scriptStart(array('inline' => false));
echo "
function itemInSpot(drag_item,spot)
{
	var oldSpotItem = $(spot).find('img');		
	if(oldSpotItem.length>0) {
		oldSpotItem.appendTo('#'+drag_item.parent().attr('id')).draggable({ revert: 'invalid' });
	}

	var item = $('<img />');
	item.attr('src',drag_item.attr('src')).attr('id',drag_item.attr('id')).attr('class',drag_item.attr('class')).appendTo(spot).draggable({ revert: 'invalid' });
	item.attr('width', drag_item.attr('width'));
	item.attr('height', drag_item.attr('height'));
	item.attr('onmouseover', drag_item.attr('onmouseover'));
	item.attr('onmouseout', drag_item.attr('onmouseout'));
	item.attr('onmousedown', drag_item.attr('onmousedown'));
	drag_item.remove(); // remove the old object

	update_spots();
}

function update_spots()
{
	var i;
	var list_inv = '';
	var list_eq = '';
	
	for(i=0; i<=16; i++) {
		if($('#slot'+i+'_equip img').length > 0) {
			list_eq = list_eq + $('#slot'+i+'_equip img').attr('id') + ',';
		} else {
			list_eq = list_eq + '0,';
		}
	}
	if($('#slot'+i+'_equip img').length > 0) {
		list_eq = list_eq + $('#slot'+i+'_equip img').attr('id');
	} else {
		list_eq = list_eq + '0';
	}		
	
	for(i=0; i<=38; i++) {
		if($('#slot'+i+' img').length > 0) {
			list_inv = list_inv + $('#slot'+i+' img').attr('id') + ',';
		} else {
			list_inv = list_inv + '0,';
		}
	}
	if($('#slot'+i+' img').length > 0) {
		list_inv = list_inv + $('#slot'+i+' img').attr('id');
	} else {
		list_inv = list_inv + '0';
	}
	
  $('#list_inv').val(list_inv);
  $('#list_equip').val(list_eq);
  $('#inventory_form').submit();
/*		$.post('{S_UCP_ACTION}', { list_inv: list_inv, list_equip: list_eq, act: 0 } , function( data ) {alert(data);} );*/
}

var g_selectedSlot = -1;
var g_lock = false;

function setSelectedSlot(id) {
  g_selectedSlot = id;
}

function unsetSelectedSlot() {
  g_selectedSlot = -1;
}

function my_reset() {
    UnTip();
    g_selectedSlot = -1;
}

$(document).keydown(function(e) { 
  if(e.which == 16 && g_selectedSlot>=0 && !g_lock) {
  g_lock = true;
    $.post('./legend.php?act=item&id='+g_selectedSlot, { }, 
          function( data ) {
            Tip(data, DELAY, 0, FADEIN, 0, FADEOUT, 0, WIDTH, 200, FOLLOWMOUSE, false, CLICKCLOSE, true, BGCOLOR, '#000000', BORDERCOLOR, '#b0b0b0', FONTCOLOR, '#ffffff');
          }
    );      
  }
});

$(document).keyup(function() { 
  UnTip();
g_lock = false;
});


$(document).ready(function() {
	var i;
	
  $('#rpg-tabs').tabs();

  $('.rpg-accordion').accordion({
    collapsible: true,
    active: false,
    heightStyle: 'content'
  });

  $('.head,.neck,.shoulder,.chest,.shirt,.tabard,.wrists,.hands,.waist,.legs,feet,.trinket,.relic,.mainhand,.sechand,.onehand,.twohand,.ranged,.object').draggable({ revert: 'invalid'});

	for(i=0; i<40; i++) {
		$('#slot'+i).droppable().bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	}

	$('#slot0_equip').droppable({ accept: '.head'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot1_equip').droppable({ accept: '.neck'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot2_equip').droppable({ accept: '.shoulder'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot3_equip').droppable({ accept: '.chest'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot4_equip').droppable({ accept: '.shirt'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot5_equip').droppable({ accept: '.tabard'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot6_equip').droppable({ accept: '.wrists'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	
	$('#slot7_equip').droppable({ accept: '.hands'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot8_equip').droppable({ accept: '.waist'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot9_equip').droppable({ accept: '.legs'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot10_equip').droppable({ accept: '.feet'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot11_equip,#slot12_equip').droppable({ accept: '.trinket'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot13_equip').droppable({ accept: '.relic'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	
	$('#slot14_equip').droppable({ accept: '.onehand,.mainhand,.twohand'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot15_equip').droppable({ accept: '.onehand,.sechand'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot16_equip').droppable({ accept: '.ranged'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });

});
";
$this->Html->scriptEnd();

?>


<h2><?php echo __('Your character\'s sheet'); ?></h2>
  <div id="rpg-tabs">
    <ul>
      <li><a href="#rpg-tabs-1"><?php echo __('Character'); ?></a></li>
      <li><a href="#rpg-tabs-2"><?php echo __('Inventory'); ?></a></li>
      <li><a href="#rpg-tabs-3"><?php echo __('Options'); ?></a></li>
    </ul>

    <div id="rpg-tabs-1">

      <div class="rpg-info-box" style="float:left;">
        <img src="<?php echo '/img/portraits/'.$char['Character']['gender'].'/'.$char['Race']['id'].'/'.$char['Character']['portrait_id'] ?>.jpg" title="Portrait " width="110" height="170" alt="portrait-id" />
      </div>
      <div style="padding-left:20em;">
        <p><b>Nom :</b> <?php echo $char['Character']['name']; ?></p>
        <p><b>Race :</b> <?php echo $char['Race']['name']; ?></p>
        <p><b>Genre :</b> <?php echo intval($char['Character']['gender']) > 0 ? 'Feminin' : 'Masculin' ; ?></p>
        <p><b>Carrière :</b> <?php echo $char['Career']['name']; ?></p>
        <p><b>Argent :</b> <?php echo $char['Character']['money'][0]; ?> co, <?php echo $char['Character']['money'][1]; ?> pa, <?php echo $char['Character']['money'][2]; ?> s</p>
      </div>

      <div style="clear:left;">

      <h3><?php echo __('Statistics'); ?></h3>

      <p><?php echo __('Main profile'); ?></p>

      <table class="statstable">
          <tr>
              <th>&nbsp;</th>
              <th><a href="#" title="<?php echo __('Weapon skill'); ?>"><?php echo __('WS'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_BS}"><?php echo __('BS'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_STRENGTH}"><?php echo __('S'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_TOUGHNESS}"><?php echo __('T'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_AGILITY}"><?php echo __('Ag'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_INTELLIGENCE}"><?php echo __('Int'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_WILLPOWER}"><?php echo __('WP'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_FELLOWSHIP}"><?php echo __('Fel'); ?></a></th>
          </tr>
          <tr>
              <td>Base</td>
              <td><?php echo $char['Character']['profile']['base'][0]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][1]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][2]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][3]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][4]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][5]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][6]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['base'][7]; ?> &#37;</td>
          </tr>
          <tr>
              <td>Plan</td>
              <td>+<?php echo $char['Career']['profile'][0]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][1]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][2]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][3]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][4]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][5]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][6]; ?> &#37;</td>
              <td>+<?php echo $char['Career']['profile'][7]; ?> &#37;</td>
          </tr>
          <tr>
              <td>Actuel</td>
              <td><?php echo $char['Character']['profile']['current'][0]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][1]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][2]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][3]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][4]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][5]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][6]; ?> &#37;</td>
              <td><?php echo $char['Character']['profile']['current'][7]; ?> &#37;</td>
          </tr>
      </table>

      <br />

      <p><?php echo __('Secondary profile'); ?></p>
      <table class="statstable">
          <tr>
              <th>&nbsp;</th>
              <th><a href="#" title="{L_RPG_L_ATTACKS}"><?php echo __('A'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_WOUNDS}"><?php echo __('W'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_SBONUS}"><?php echo __('SB'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_TBONUS}"><?php echo __('TB'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_MOVE}"><?php echo __('M'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_MAGIC}"><?php echo __('Mag'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_INSANITY}"><?php echo __('IP'); ?></a></th>
              <th><a href="#" title="{L_RPG_L_FATE}"><?php echo __('FP'); ?></a></th>
          </tr>
          <tr>
              <td>Base</td>
              <td><?php echo $char['Character']['profile']['base'][8]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][9]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][10]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][11]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][12]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][13]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][14]; ?> </td>
              <td><?php echo $char['Character']['profile']['base'][15]; ?> </td>
          </tr>
          <tr>
              <td>Plan</td>
              <td>+<?php echo $char['Career']['profile'][8]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][9]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][10]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][11]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][12]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][13]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][14]; ?> </td>
              <td>+<?php echo $char['Career']['profile'][15]; ?> </td>
          </tr>
          <tr>
              <td>Actuel</td>
              <td><?php echo $char['Character']['profile']['current'][8]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][9]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][10]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][11]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][12]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][13]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][14]; ?> </td>
              <td><?php echo $char['Character']['profile']['current'][15]; ?> </td>
          </tr>
      </table>

      <h3><?php echo __('Skills'); ?></h3>

      <?php if(sizeof($char['CharactersSkillsSkillspec']) > 0): ?>
        <div class="rpg-accordion">
          <?php foreach ($char['CharactersSkillsSkillspec'] as $skill): ?>
            <h3>
            <?php echo $skill['Skill']['name']; ?>
            <?php if(!empty($skill['Skillspec'])): ?>
              : <?php echo $skill['Skillspec']['name']; ?>
            <?php endif; ?>
              <span style="color:#B40404">[<?php echo $char['Character']['profile']['current'][$skill['Skill']['carac']]; ?>
              <?php if(intval($skill['bonus']) > 0): ?>
              + <?php echo $skill['bonus']; ?> = <?php echo intval($char['Character']['profile']['current'][$skill['Skill']['carac']]) + intval($skill['bonus']); ?>    
              <?php endif; ?>
              &#37;]</span>
            </h3>
            <div>
            <p><?php echo __('Characteristic'); ?>: <?php echo $t_statsStr[$skill['Skill']['carac']]; ?></p>
            <p>
            <?php echo $skill['Skill']['desc']; ?>
            </p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Pas de compétences</p>
      <?php endif; ?>
       
      <h3><?php echo __('Talents'); ?></h3>
      <?php if(sizeof($char['CharactersTalentsTalentspec']) > 0): ?>
        <div class="rpg-accordion">
          <?php foreach ($char['CharactersTalentsTalentspec'] as $talent): ?>
            <h3>
            <?php echo $talent['Talent']['name']; ?>
            <?php if(!empty($talent['Talentspec'])): ?>
              : <?php echo $talent['Talentspec']['name']; ?>
            <?php endif; ?>
            </h3>
            <div>
            <p>
            <?php echo $talent['Talent']['desc']; ?>
            </p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Pas de talents</p>
      <?php endif; ?>

      </div>
    </div>
    <div id="rpg-tabs-2">
	    <div class='equip'>
	    <div class='equip_structure' style='background-image: url("/img/inv_<?php echo $char['Character']['gender']; ?>.png");'>&nbsp;</div>
		    <!-- BEGIN equip -->
		    <div id="slot{equip.ID_SLOT}_equip" class='slot{equip.ID_SLOT}_class'>
			    <!-- IF equip.S_OCCUPIED --> <img onmouseover="setSelectedSlot({equip.ITEM_ID})" onmouseout="unsetSelectedSlot()" onmousedown="my_reset()" src="http://88.191.120.58/forum/rpg/img/items/{equip.ITEM_IMG}.png" width="48" height="48" class="{equip.ITEM_TYPE}" alt="{equip.ITEM_NAME}" id="{equip.ITEM_ID}" /> <!-- ENDIF -->
		    </div>
		    <!-- END equip -->


		    <!-- BEGIN inv -->
		    <div id="slot{inv.ID_SLOT}" style='position:absolute; left:{inv.X_SLOT}px; top:{inv.Y_SLOT}px; width:48px; height:48px;'>
			    <!-- IF inv.S_OCCUPIED --> <img onmouseover="setSelectedSlot({inv.ITEM_ID})" onmouseout="unsetSelectedSlot()" onmousedown="my_reset()" src="http://88.191.120.58/forum/rpg/img/items/{inv.ITEM_IMG}.png" width="48" height="48" class="{inv.ITEM_TYPE}" alt="{inv.ITEM_NAME}" id="{inv.ITEM_ID}" /> <!-- ENDIF -->
		    </div>
		    <!-- END inv -->
	    </div>


    <form id="inventory_form" method="post" action="{S_UCP_ACTION}">
      <input type="hidden" id="list_inv" name="list_inv" value="">
      <input type="hidden" id="list_equip" name="list_equip" value="">
      <input type="hidden" id="act" name="act" value="0">
    </form>


    <h3><?php echo __('Sell'); ?></h3>

    <p>Vous pouvez vendre ici tout objet pour la moitié de sa valeur.</p>

    <!-- IF .items --> 
    <span>
    <form id="sell_form" method="post" action="{S_UCP_ACTION}">
    <select name="object_to_sell">
    <!-- BEGIN items -->
    <option value="{items.ITEM_ID}">{items.ITEM_NAME} ({items.ITEM_PRICE} {L_GOLD})</option>
    <!-- END items -->
    </select>
    <input type="submit" value="vendre"> 
    </form>
    </span>
    <!-- ELSE -->
    <p><i>Vous n'avez pas d'objets.</i></p>
    <!-- ENDIF -->
    </div>
    <div id="rpg-tabs-3">
      <p>Hello World!</p>
    </div>
  </div>