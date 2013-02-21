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
/*		$.post("{S_UCP_ACTION}", { list_inv: list_inv, list_equip: list_eq, act: 0 } , function( data ) {alert(data);} );*/
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
    $.post("./legend.php?act=item&id="+g_selectedSlot, { }, 
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
	
  $("#rpg-tabs").tabs();

  $(".rpg-accordion").accordion({
    collapsible: true,
    active: false,
    heightStyle: "content"
  });

  $(".head,.neck,.shoulder,.chest,.shirt,.tabard,.wrists,.hands,.waist,.legs,feet,.trinket,.relic,.mainhand,.sechand,.onehand,.twohand,.ranged,.object").draggable({ revert: 'invalid'});

	for(i=0; i<40; i++) {
		$('#slot'+i).droppable().bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	}

	$('#slot0_equip').droppable({ accept: '.head'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot1_equip').droppable({ accept: '.neck'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$('#slot2_equip').droppable({ accept: '.shoulder'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
	$("#slot3_equip").droppable({ accept: '.chest'}).bind('drop', function(ev,ui) { itemInSpot(ui.draggable,this); });
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
