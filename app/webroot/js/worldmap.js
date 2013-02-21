var map;
var mapBounds = new OpenLayers.Bounds( 0.0, -22528.0, 29952.0, 0.0);
OpenLayers.ImgPath = "js/worldmap/dark/";

//  var mapMinZoom = 1;
//  var mapMaxZoom = 7;

// avoid pink tiles
OpenLayers.IMAGE_RELOAD_ATTEMPTS = 3;
OpenLayers.Util.onImageLoadErrorColor = "transparent";

function init() {
  var options = {
      controls: [],
      maxExtent: new OpenLayers.Bounds(  0.0, -22528.0, 29952.0, 0.0 ),
      maxResolution: 128.000000,
      numZoomLevels: 8
  };

  map = new OpenLayers.Map('map', options);

  var layer = new OpenLayers.Layer.TMS( "TMS Layer","",
            {url: '', serviceVersion: '.', layername: '.', alpha: true, type: 'png', getURL: overlay_getTileURL});



  map.addLayer(layer);
  var markers = new OpenLayers.Layer.Markers( "Markers" );
  map.addLayer(markers);

	map.zoomToExtent( mapBounds );


  map.addControl(new OpenLayers.Control.PanZoomBar());
/*    map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));*/
  map.addControl(new OpenLayers.Control.Permalink());
  map.addControl(new OpenLayers.Control.Permalink('permalink'));
  map.addControl(new OpenLayers.Control.MousePosition());
//    map.addControl(new OpenLayers.Control.OverviewMap());
  map.addControl(new OpenLayers.Control.KeyboardDefaults());
  map.addControl(new OpenLayers.Control.Navigation({dragPanOptions: {enableKinetic: !0}}));

  map.setCenter(new OpenLayers.LonLat(13742, -8246), 4);

  var size = new OpenLayers.Size(24,24);
  var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
  var icon = new OpenLayers.Icon('js/worldmap/icons/Skull_64Red.png', size, offset);

  var newMark = new OpenLayers.Marker(new OpenLayers.LonLat(16580,-13740),icon);

  newMark.events.register('click',newMark,function(evt) {
  this.map.addPopup(new OpenLayers.Popup("chicken",
                   new OpenLayers.LonLat(16580,-13740),
                   new OpenLayers.Size(200,50),
                   "<a href='http://wiki.castlecerf.asso.st/karak_azgal'><b>Ruines de Karak Azgal</b></a>",
                   true));
  });
  markers.addMarker(newMark);
}
		
function overlay_getTileURL(bounds) {
  var res = this.map.getResolution();
  var x = Math.round((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
  var y = Math.round((bounds.bottom - this.maxExtent.bottom) / (res * this.tileSize.h));
  var z = this.map.getZoom();
  if (x >= 0 && y >= 0) {
    return "js/worldmap/" + z + "/" + x + "/" + y + "." + this.type;				
  } else {
    return "http://www.maptiler.org/img/none.png";
  }
}

function getWindowHeight() {
  if (self.innerHeight) return self.innerHeight;
  if (document.documentElement && document.documentElement.clientHeight)
    return document.documentElement.clientHeight;
  if (document.body) return document.body.clientHeight;
    return 0;
}

function getWindowWidth() {
  if (self.innerWidth) return self.innerWidth;
  if (document.documentElement && document.documentElement.clientWidth)
      return document.documentElement.clientWidth;
  if (document.body) return document.body.clientWidth;
      return 0;
}

function resize() {  
  var map = document.getElementById("map");
  map.style.height = "640px";
  map.style.width = "900px";
  if (map.updateSize) { 
    map.updateSize();
  }
}

onresize = function(){ resize(); };

$(document).ready(init);
