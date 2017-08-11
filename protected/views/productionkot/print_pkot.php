<?php 
if ($pkot->status == 'pending') {
        $pkot_status = 'Pending';
    }
    if ($pkot->status == 'accept') {
        $pkot_status = 'Accept';
    }
    if ($pkot->status == 'reject') {
       $pkot_status = 'Reject';
    }
    if ($pkot->status == 'done') {
        $pkot_status = 'Done';
    }
?>
<style>
    @media print {
        .no-print{
            display:none; 
        }
        tr td,th {
            font-size:12px;  
        }
        #bill_area {
            overflow: no-display;
        }
        .border_on_print{
            border-bottom:1px dotted #000; 
        }
        .border_on_print_tb{
            border-bottom:1px dotted #000; 
            border-top: 1px dotted #000; 
        }
        *{
            font-family:monospace; 
        }
    }

    @media only screen{
        .no-screen{
            display:none; 
        }
        #bill_area {
            overflow: scroll;
        }
    }


    @media print {
        #circle {
            text-align: center;
            width: 75px;
            height: 75px;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
            background: #6d7eb7;
        }

        #text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }

        p.speech,.left-speech {
            position: relative;
            margin-left: -15px;
            padding: 5px;
            width: 90%;
            height: auto;
            text-align: left;
            line-height: 20px;
            background-color: #fff;
            border: 1px solid #666;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            -webkit-box-shadow: 2px 2px 4px #888;
            -moz-box-shadow: 2px 2px 4px #888;
            box-shadow: 2px 2px 4px #888;
        }

        p.speech,.right-speech {
            position: relative;
            margin-left: 10%;
            padding: 5px;
            width: 90%;
            height: auto;
            text-align: left;
            line-height: 20px;
            background-color: #fff;
            border: 1px solid #666;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            -webkit-box-shadow: 2px 2px 4px #888;
            -moz-box-shadow: 2px 2px 4px #888;
            box-shadow: 2px 2px 4px #888;
        }

        .no-print{
            display: none;
        }
    }
</style>

<div id="printorder">
    <div class="row">
        <div class="col-xs-4" style="text-align: left;"><h5><?php echo date('d-m-Y'); ?></h5></div> 
        <div class="col-xs-4" style="text-align: center;"><div id="circle"><strong id="text">PKOT No <br/> <?php echo $pkot->kot_no; ?></strong></div></div> 
        <div class="col-xs-4" style="text-align: right;"><h4><?php echo $pkot->delivery_status; ?></h4></div> 
    </div> <hr/>   
    <div class="card">    
        <table class="table no-margin">
            <thead>
            <th>S No.</th>
            <th>Item</th>
            <th>Qty</th>
            </thead>
            <tbody>
                <?php
                $c = 1;
                foreach ($pkot_items as $item) {
                    ?>
                    <tr>
                        <td><?php echo $c++; ?></td>
                        <td><?php echo Productionkotitems::getItem($item); ?></td>
                        <td><?php echo $item->qty; ?></td>
                    </tr>  
                <?php } ?>
                <tr>
                    <td colspan="4">
                        <h4>Delivery By : <?php echo $pkot->deliver_by; ?></h4>
                        <h4>Comments : </h4><hr/>
                        <div id="comment_box">
                            <?php
                            foreach ($pkot_comments as $comment) {
                                if ($comment->from_id == Yii::app()->user->id) {
                                    ?>
                                    <p class="right-speech"></span><?php echo $comment->comments; ?></p>
                                <?php } else {
                                    ?>
                                    <p class="left-speech"><?php echo $comment->comments; ?></p>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    window.print();
</script>