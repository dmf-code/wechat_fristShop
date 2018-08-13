
<div id="list" class="content-padded infinite">
    <div class="container">
            <div id="J_CommentsWrapper" class="review-content">

                <ul class="list">
                    <div class="startPointer" style="padding-top: 0px;"></div>
                    <?php
                        foreach($comments as $k=>$v){
                            ?>
                            <li class="item">
                                <div class="info">
                                    <div class="author">
                                        <span>
                                            <img class="tags-img" src="<?php echo $v['headimgurl'];?>">
                                        </span>
                                        <span class="nick"><?php echo $v['nickname'];?></span>
                                    </div>
                                    <time><?php echo $v['createtime'];?> </time>
                                </div>
                                <blockquote><?php echo $v['content'];?></blockquote>

                                <ul class="pics">
                                    <?php
                                        if(!empty($v['commentGoodsUrl']))
                                        foreach(explode(',',$v['commentGoodsUrl']) as $k=>$v) {
                                            ?>
                                            <li>
                                                <img class="comment-pic" data-url="<?php echo $v; ?>"
                                                     src="http://wx.dmf95.cn/<?php echo $v; ?>" alt="用户评论">
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>

                            </li>
                            <div class="endPointer" style="clear: both; padding-bottom: 0px;"></div>
                            <?php
                        }
                    ?>

                </ul>
            </div>
    </div>
</div>




<!--                <div class="weui-loadmore">-->
<!--                    <i class="weui-loading"></i>-->
<!--                    <span class="weui-loadmore__tips">正在加载</span>-->
<!--                </div>-->

