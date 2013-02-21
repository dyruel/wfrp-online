<?php
  echo $this->Html->script('OpenLayers', array('inline' => false));
  echo $this->Html->script('worldmap', array('inline' => false));
?>

<div class="index">
	<h2><?php echo __('World map'); ?></h2>

    <div style="margin-left: auto; margin-right: auto; width:902px;">
      <div id="map" style="width:900px; height: 640; border: 2px solid rgb(93,57,21);"></div>
    </div>


  <div>
  Generated by <a href="http://www.maptiler.org/">MapTiler</a>/<a href="http://www.klokan.cz/projects/gdal2tiles/">GDAL2Tiles</a>, Copyright &copy; 2008 
  <a href="http://www.klokan.cz/">Klokan Petr Pridal</a>,  
  <a href="http://www.gdal.org/">GDAL</a> &amp; <a href="http://www.osgeo.org/">OSGeo</a> <a href="http://code.google.com/soc/">GSoC</a>
  </div>

  <script type="text/javascript"> resize();</script>

	<div class="paging">

	</div>
</div>

