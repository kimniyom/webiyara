<?php
$Config = new Configweb_model();
?>
<?php if (count($review) > 0) { ?>
    <ol class="comment-list" style=" border: none; padding: 0px;">
        <?php foreach ($review as $reviews): ?>
            <li style="border-bottom: silver solid 1px; margin-bottom: 10px;">
                <div class="the-comment">
                    <button type="button" class="btn btn-danger pull-right" onclick="deleteReview('<?php echo $reviews['id'] ?>')"><i class="fa fa-trash-o"></i></button>
                    <div class="comment-box font-THK">
                        <div class="comment-author meta">
                            <h4 class="font-THK"><?php echo $reviews['name'] ?>(Email:<?php echo $reviews['email'] ?>)</h4>
                            <p class="time" style=" font-size: 12px;"><?php echo $Config->thaidate($reviews['d_update']) ?>(Ip:<?php echo $reviews['ip'] ?>)</p>
                            <p style=" font-size: 14px; color: #666666;"><?php echo $reviews['reviews'] ?></p>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
<?php } ?>
