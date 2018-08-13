
 <div id="shop-img-detail">
    <ul class="detail-ul">
         <?php
              $imgs = empty($good['introductionImgs'])?null:explode(',',$good['introductionImgs']);

              foreach($imgs as $k=>$v) {
                     ?>
                     <li>
                         <img align="absmiddle"
                              src="<?php if($v[0]=='h')echo $v;else echo 'http://wx.dmf95.cn/'.$v; ?>">
                     </li>
                     <?php
              }
         ?>
    </ul>
</div>
