<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <h2 style="text-align: center;">
                You can't have access for this counter please make sure you are a authorized user or not.....!!!!     
                </h2>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" class="btn btn-default">Close</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#myModal").modal({backdrop: 'static', keyboard: false});
    });
</script>