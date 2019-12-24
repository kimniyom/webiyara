<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>IYARA,iyara,iyaraaudio,audio</title>
        <meta name="keywords" content="iyara,IYARA,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home,audio,studio,หูฟัง" />
        <meta name="description" content="iyara,IYARA,ไอยารา,เครื่องเสียง,หูฟัง,ลำโพง,sound,music,home,audio,studio,หูฟัง" />
        <?php
header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
?>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/css/font-awesome-4.3.0/css/font-awesome.min.css">
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Roboto');

            /*Background*/

            html,
            body {
                margin: 0px;
                padding: 0px;
            }

            * {
                box-sizing: border-box;
            }

            .popup {
                background: #000000;
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 200;
                display: none;
                background: rgba(0, 0, 0, 0.9);
            }

            .popup .over-ray {
                position: absolute;
                float: left;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                z-index: 250;
            }

            .video-background {
                background: #000;
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: -99;
            }

            #video-foreground,
            .video-background iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            @media (min-aspect-ratio: 16/9) {
                #video-foreground {
                    height: 300%;
                    top: -100%;
                }
            }

            @media (max-aspect-ratio: 16/9) {
                #video-foreground {
                    width: 300%;
                    left: -100%;
                }
            }

            /* Content
         * You can remove below when adapting to your project
         */
            h1,
            p,
            i {
                color: white;
            }

            p {
                font-family: 'Roboto', sans-serif;
                font-size: 16px;
            }

            h1 {
                font-size: 62px;
                font-family: 'Roboto', sans-serif;
                font-weight: 600;
                text-transform: uppercase;
            }

            .main-content {
                margin: 0px;
                background: rgba(0, 0, 0, 0.5);
                position: relative;
                height: 100%;
            }

            .main-content .txt-center {
                position: absolute;
                float: left;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }

            .open-sound {
                top:0px;
                width: 100%;
                margin: 0px;
                position: absolute;
                height: 100%;
                z-index: 10;
            }

            .btnpage{
                border: solid #e0cd8b 3px;
                border-radius: 50px;
                color: #e0cd8b;
                background: rgba(0, 0, 0, 0.5);
                padding: 15px;
                transition: 0.3s;
                font-size: 20px;
                font-weight: bold;
            }

            .btnpage:hover{
                border: solid #e0cd8b 3px;
                background: #ffffff;
                color: #000000;

            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
        <!--
        <script async src="https://www.youtube.com/iframe_api"></script>
    -->
    </head>

    <body>
        <span class="fa-stack fa-lg sound" style=" position: absolute; bottom: 10px; right: 10px; z-index: 100;">
            <i class="fa fa-circle-o fa-stack-2x"></i>
            <i class="fa fa-volume-off fa-stack-1x volume-icon"></i>
        </span>
        <div class="popup">
            <div class="over-ray">
                <div style="width: 400px; height: 200px; background: #ffffff;">
                    <button type="button" class="btn btn-success sound" onclick="closePopup()">
                        <i class="fa fa-volume-off fa-5x"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="video-background">
            <div id="video-foreground" class="mute"></div>
        </div>
        <div  style="margin:0px;">
            <div class="col-md-12 main-content">
                <div class="text-center">
                    <div class="txt-center">
                        <h1>I Y A R A</h1>
                        <p>
                            IYARA is an art combining with science,<br/>
                            an upgrade cable for music appreciation.<br/>
                            From the ground up, Kstudio work passionately to provide only the best,<br/>
                            start from a top quality material, delicately process with hand and perform with heart and soul.<br/>
                            With your beloved earphone, together with a IYARA cable, the sound goes beyond imagination.<br/>
                            It is a privilege for Kstudio to deliver you a masterpiece which takes your<br/>
                            headphone to a new frontier and fulfill you music satisfaction.<br/>
                            IYARA, the pinnacle of cable<br/>
                            Kstudio
                        </p>
                        <br/>
                        <a href="<?php echo Yii::app()->createUrl('site/index') ?>">
                            <button type="button" class="btnpage">Enter Site <i class="fa fa-angle-double-right" aria-hidden="true" style="color:#e0cd8b;"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="alert-home">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color:#000000;">Allow unmute</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary sound" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var tag = document.createElement('script');

                        tag.src = "https://www.youtube.com/iframe_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                        var size = window.innerWidth;
                        if (size < 1024) {
                            window.location = "<?php echo Yii::app()->createUrl('site/index') ?>";
                        }



                        var player;
                        function onYouTubeIframeAPIReady() {
                            player = new YT.Player('video-foreground', {
                                videoId: 'cIx0b28geB0', // YouTube Video ID
                                playerVars: {
                                    autoplay: 1, // Auto-play the video on load
                                    controls: 0, // Show pause/play buttons in player
                                    showinfo: 0, // Hide the video title
                                    modestbranding: 1, // Hide the Youtube Logo
                                    loop: 1, // Run the video in a loop
                                    fs: 0, // Hide the full screen button
                                    cc_load_policy: 0, // Hide closed captions
                                    iv_load_policy: 3, // Hide the Video Annotations
                                    autohide: 0, // Hide video controls when playing
                                    playlist: 'cIx0b28geB0'
                                },
                                events: {
                                    'onReady': playVideo
                                            /*
                                             onReady: function(e) {
                                             e.target.mute();
                                             }
                                             */
                                }
                            });
                        }
                        /* Sound Control
                         * You can remove below if you don't want to show the icon. Video will be muted by default.
                         */

                        function playVideo() {
                            $('#video-foreground').toggleClass('mute');
                            $('.volume-icon').toggleClass('fa-volume-up', 'fa-volume-off');
                            if ($('#video-foreground').hasClass('mute')) {
                                player.mute();
                            } else {
                                player.unMute();
                            }
                        }
                        $(document).ready(function(e) {
                            //$(".popup").show();
                            //$("#alert-home").modal();
                            $('.sound').on('click', function() {
                                $('#video-foreground').toggleClass('mute');
                                $('.volume-icon').toggleClass('fa-volume-up', 'fa-volume-off');
                                if ($('#video-foreground').hasClass('mute')) {
                                    player.mute();
                                } else {
                                    player.unMute();
                                }
                            });
                        });

                        function closePopup() {
                            $(".popup").hide();
                        }
        </script>
    </body>
</html>