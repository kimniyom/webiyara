<style>
    .inputGroup {
        background-color: none;
        display: block;
        margin: 0px 0;
        position: relative;
    }
    .inputGroup label {
        padding: 12px 30px;
        width: 100%;
        display: block;
        text-align: left;
        color: #e0cd8b;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
    }
    .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: none;
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
    }
    .inputGroup label:after {
        width: 32px;
        height: 32px;
        content: '';
        border: 0px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
    }
    .inputGroup input:checked ~ label {
        color: #ffffff;
    }
    .inputGroup input:checked ~ label:before {
        -webkit-transform: translate(-50%, -50%) scale3d(56, 56, 1);
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
    }
    .inputGroup input:checked ~ label:after {
        background-color: #000000;
        border-color: #000000;
    }
    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }

    .form {
        padding: 0 16px;
        max-width: 550px;
        margin: 50px auto;
        font-size: 18px;
        font-weight: 600;
        line-height: 36px;
    }



    .styled-input-single {
        position: relative;
        padding: 5px 0 0px 40px;
        text-align: left;
    }
    .styled-input-single label {
        cursor: pointer;
        color: #000\9;
    }
    .styled-input-single label:before, .styled-input-single label:after {
        content: '';
        position: absolute;
        top: 50%;
        border-radius: 50%;
    }
    .styled-input-single label:before {
        left: 0;
        width: 30px;
        height: 30px;
        margin: -15px 0 0;
        background: #f7f7f7;
        box-shadow: 0 0 1px grey;
    }
    .styled-input-single label:after {
        left: 5px;
        width: 20px;
        height: 20px;
        margin: -10px 0 0;
        opacity: 0;
        background: #000000;
        -webkit-transform: translate3d(-40px, 0, 0) scale(0.5);
        transform: translate3d(-40px, 0, 0) scale(0.5);
        transition: opacity 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
        transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out;
        transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
    }
    .styled-input-single input[type="radio"],
    .styled-input-single input[type="checkbox"] {
        position: absolute;
        top: 0;
        left: -9999px;
        visibility: hidden;
    }
    .styled-input-single input[type="radio"]:checked + label:after,
    .styled-input-single input[type="checkbox"]:checked + label:after {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }

    .styled-input--square label:before, .styled-input--square label:after {
        border-radius: 0;
    }

    .styled-input--rounded label:before {
        border-radius: 10px;
    }
    .styled-input--rounded label:after {
        border-radius: 6px;
    }

    .styled-input--diamond .styled-input-single {
        padding-left: 45px;
    }
    .styled-input--diamond label:before, .styled-input--diamond label:after {
        border-radius: 0;
    }
    .styled-input--diamond label:before {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .styled-input--diamond input[type="radio"]:checked + label:after,
    .styled-input--diamond input[type="checkbox"]:checked + label:after {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        opacity: 1;
    }
    /*
        #filter{
            display: none;
        }
    */
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var width = $(window).width();
        if (width >= 768) {
            var styles = {
                "white-space": "nowrap",
                "width": "220px",
                "overflow": "hidden",
                "text - overflow": "ellipsis"
            };
            $(".caption").css(styles);
            $("#btn-filter").hide();
            //$(".box_product").css("height", "350px");
        } else {
            $("#filter").hide();
        }
    });
</script>

<?php
/*
  $this->breadcrumbs = array(
  "SHOP",
  );
 * */
?>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="popupfilter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#000000; color:#e0cd8b">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#e0cd8b">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">FILTER</h4>
            </div>
            <div class="modal-body" style=" background: #000000;">
                <div class="filter"></div>
            </div>
        </div>
    </div>
</div>

<div class="container" style=" padding-top: 30px;">
    <!--
    <div class="row" id="btn-filter">
        <div class="col-lg-3 col-md-3">
            <button type="button" class="btn btn-primary btn-block" onclick="popupfilter()" style="margin-bottom:20px; background:#e0cd8b; border:none;">
                <i class="fa fa-search"></i> FILTER
            </button>
        </div>
    </div>
    -->
    <div class="row" style=" margin: 0px;">
        <!--
        <div class="col-lg-3 col-md-3" id="filter">
            <div id="box-footer">

                <div class="panel-heading" style=" background: none; border-bottom: none;">
                    <h4 class="font-supermarket" style="color: #e0cd8b; font-size: 20px;">Category</h4>

                </div>

                <ul class="list-group" id="category" style=" border: none; background: none;">
        <?php //foreach ($categorys as $category): ?>
                        <li class="list-group-item" style="padding:0px; background:none; border: none;">
                            <div class="inputGroup">
                                <input id="checkbox-example-<?php //echo $category['id']      ?>" type="checkbox" name="options[]" value="<?php //cho $category['id']      ?>" checked="checked" onclick="Getpage()"/>
                                <label for="checkbox-example-<?php //echo $category['id']      ?>"><?php //echo $category['categoryname']      ?></label>
                            </div>
                        </li>
        <?php //endforeach; ?>
                </ul>
                <input type="hidden" id="categoryfilter" />


            </div>
        </div>
        -->
        <div class="col-lg-12 col-md-12" style="padding:0px;">
            <div id="defaultpage"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //category();
    Getpage();
    function category() {
        var arr = $.map($('#category input:checkbox:checked'), function(e, i) {
            return +e.value;
        });
        $('#categoryfilter').val(arr.join(','));
    }

    $('#category').delegate('input:checkbox', 'click', category);


    function Getpage() {
        this.category();
        var url = "<?php echo Yii::app()->createUrl('frontend/product/defaultpage') ?>";
        var category = $("#categoryfilter").val();
        var data = {category: category};
        $.post(url, data, function(datas) {
            $("#defaultpage").html(datas);
        });
    }

    function popupfilter() {
        $("#popupfilter").modal();
        $(".filter").html($("#box-footer"));

    }
</script>

