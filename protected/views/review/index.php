<?php 
    $Config = new Configweb_model();
?>
<?php if (count($review) > 0) { ?>
    <ol class="comment-list" style=" border: none; padding: 0px;">
        <?php foreach ($review as $reviews): ?>
            <li style="border-bottom: silver solid 1px; margin-bottom: 10px;">
                <div class="the-comment">
                    <div class="comment-box font-THK">
                        <div class="comment-author meta">
                            <h3 class="font-THK"><?php echo $reviews['name'] ?></h3>
                            <p class="time" style=" font-size: 18px;"><?php echo $Config->thaidate($reviews['d_update']) ?></p>
                            <p style=" font-size: 20px; color: #666666;"><?php echo $reviews['reviews'] ?></p>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
<?php } ?>