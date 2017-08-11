<?php

class Utils {

    public static $master_id = 1;
    public static $pagesize = 7;

    public static function calculatePercentage($percent, $price) {
        return ($price * $percent) / 100;
    }

    public static function excludeTaxFromPrice($tax, $price) {
        //$a = "1,435";
      

        $taxDivisor = 1 + ($tax / 100);
        //Determine the price before Tax.
        $priceBeforeTax = $price / $taxDivisor;
        //Determine how much of the gross price was TAX.
        $taxAmount = $price - $priceBeforeTax;
        //Print out the price before TAX.
        return $priceBeforeTax;
    }

    public static function recipe_category() {
        $recipe_category = array('Flavour' => 'Flavour');
        return $recipe_category;
    }

    public static function billPrintType() {
        return array('Customer Copy', 'Duplicate for Transportation', 'Triplicate for self');        
    }
    public static function customerType() {
        return array(''=>'--Select--','customer'=>'Special Customer','special_cash'=>'Cash Customer');        
    }
    public static function taxType() {
        return array(''=>'--Select--','INCLUSIVE'=>'INCLUSIVE','EXCLUSIVE'=>'EXCLUSIVE');        
    }
    public static function billType() {
        return array(''=>'--Select--','cost_bill'=>'COST BILL','incremental_bill'=>'INCREMENTAL BILL');        
    }
    
    public static function postype() {
        $postype = array('' => '-POS Type-', 'ots' => 'OTS', 'menu' => 'MENU', 'aos' => 'AOS');
        return $postype;
    }

    public static function gender() {
        $gender = array('' => '-Select-', 'male' => 'Male', 'female' => 'Female');
        return $gender;
    }

    public static function martial() {
        $gender = array('' => '-Select-', 'married' => 'Married', 'unmarried' => 'UnMarried');
        return $gender;
    }

    public static function yes_no_list() {
        return array('' => '-Select-', 'Y' => 'Yes', 'N' => 'No');
    }

    public static function invoice_type() {
        return array('' => '-Select-', 'Tax Invoice' => 'Tax Invoice', 'Revised' => 'Revised');
    }

    public static function ticket() {
        $gender = array('Quality Control' => 'Quality Control', 'Technical S/W' => 'Technical S/W', 'Technical H/W' => 'Technical H/W', 'Sales' => 'Sales', 'Purchase' => 'Purchase', 'Human Resource' => 'Human Resource', 'General' => 'General');
        return $gender;
    }

    public static function ctype() {
        $gender = array('voucher' => 'Voucher', 'cash' => 'Cash');
        return $gender;
    }

    public static function stype() {
        $gender = array('s' => 'Stock', 'f' => 'Floor', 'k' => 'Kitchen');
        return $gender;
    }

    public static function vtype() {
        $gender = array('external' => 'External', 'internal' => 'Internal');
        return $gender;
    }

    public static function rtype() {
        $gender = array('weekly' => 'Weekly', 'monthly' => 'Monthly');
        return $gender;
    }

    public static function ptype() {
        $gender = array('0' => 'Un Paid', '1' => 'Paid');
        return $gender;
    }

    public static function scaled() {
        $gender = array('1' => 'Yes', '0' => 'No');
        return $gender;
    }

    public static function discount() {
        $gender = array('1' => 'Yes', '0' => 'No');
        return $gender;
    }

    public static function item_classify() {
        $postype = array('GST' => 'GST', 'NON-GST' => 'NON-GST', 'Exempt' => 'Exempt', 'NIL' => 'NIL', 'Reverse-Charge' => 'Reverse-Charge');
        return $postype;
    }

    public static function goods_service() {
        $postype = array('Good' => 'Good');
        return $postype;
    }

    public static function roles() {
        return array('sa' => 'Super Admin', 'cps' => 'CPS', 'cds' => 'CDS', 'gpu' => 'GPU', 'outlet_mgr' => 'Outlet Manager', 'ticket_mgr' => 'Ticket Manager', 'pos' => 'POS', 'kpos' => 'Kitchen POS');
    }

    public static function vroles() {
        return array('' => '-Select-', 'sa' => 'Super Admin', 'kitchen' => 'Kitchen', 'sales_man' => 'Sales Man', 'hr' => 'Human Resource');
    }

    public static function ptypes() {
        return array('' => '-Select-', 'Semi-finished' => 'Semi Finished', 'Finished' => 'Finished');
    }

    public static function staffrole() {
        return array('' => '-Select-', 'kitchen' => 'Kitchen', 'inventory' => 'Inventory', 'pos' => 'POS');
    }

    public static function paymode() {
        return array('' => '-Select-', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'DD' => 'DD', 'NEFT' => 'NEFT', 'RTGS' => 'RTGS');
    }

    public static function paymentmode() {
        return array('' => '-Select-', 'cash' => 'Cash', 'cheque' => 'Cheque', 'dd' => 'DD', 'neft' => 'NEFT', 'rtgs' => 'RTGS');
    }

    public static function stypes() {
        $gender = array('' => '-Select-', 'Finished' => 'Finished', 'Vscale' => 'Vendorscale');
        return $gender;
    }

    public static function payment_receiver_type() {
        $gender = array('' => '-Select-', 'employee' => 'Employee', 'vendor' => 'Vendor', 'expense_head' => 'Expense Head', 'others' => 'Others', 'customer' => 'Special Customer');
        return $gender;
    }

    public static function vnature() {
        $gender = array('' => '-Select-', 'credit' => 'Credit', 'debit' => 'Debit');
        return $gender;
    }

    public static function stypes_gpu() {
        $gender = array('' => '-Select-', 'Finished' => 'Finished');
        return $gender;
    }

    public static function taxtypes() {
        $gender = array('bill_cost' => 'Bill wise Tax');
        return $gender;
    }

    public static function purtype() {
        $gender = array('regular' => 'Regular', 'e-commerce' => 'E-commerce');
        return $gender;
    }

    public static function itype() {
        $gender = array('vendor' => 'Vendor', 'cash' => 'Cash');
        return $gender;
    }

    public static function purchase_type() {
        return array('' => '-Select-', 'regular' => 'Regular', 'e-commerce' => 'E-commerce');
    }

    public static function in_out_state() {
        return array('' => '-Select-', '0' => 'In State', '1' => 'Out State');
    }

    public static function invoice_format() {
        $gender = array('F2' => 'F2', 'F1' => 'F1');
        return $gender;
    }

    public static function discount_type() {
        $gender = array('' => '-Select-', 'item_discount' => 'Discount Item');
        return $gender;
    }

    public static function GSTtypes() {
        return array('' => '-Select-', 'HSN' => 'HSN', 'SAC' => 'SAC');
    }

    public static function GSTdetails() {
        return array('Goods' => 'Goods', 'Services' => 'Services');
    }

    public static function types() {
        $gender = array('' => '-Select-', 'Purchase' => 'Purchase', 'Processed' => 'Processed');
        return $gender;
    }

    public static function types_gpu() {
        $gender = array('' => '-Select-', 'Processed' => 'Processed');
        return $gender;
    }

    public static function type() {
        $gender = array('' => '-Select-', 'Bag' => 'Bag', 'Packet' => 'Packet', 'Litre' => 'Litre');
        return $gender;
    }

    public static function scale() {
        $gender = array('kg' => 'kg', 'ltr' => 'ltr');
        return $gender;
    }

    public static function schedule() {
        $gender = array('1' => 'Yes', '0' => 'No');
        return $gender;
    }

    public static function inputtype() {
        $gender = array('Direct' => 'Direct', 'Convert' => 'Convert');
        return $gender;
    }

    public static function choicetype() {
        $gender = array('itemwise' => 'Item Wise', 'allitem' => 'All Item');
        return $gender;
    }

    public static function typewise() {
        $gender = array('itemwise' => 'Item Wise', 'all' => 'All');
        return $gender;
    }

    public static function saletype() {
        $gender = array('' => '-Select-', 'selfitem' => 'Shelf Items',
            'menuitem' => 'Menu Items',
            'internal_item' => 'Internal Sale Items'
        );
        return $gender;
    }

    public static function saletypeforItem() {
        $gender = array('' => '-Select-', 'selfitem' => 'Shelf Items',
            'menuitem' => 'Menu Items',
        );
        return $gender;
    }

    public static function indenttype() {
        return array('Regular' => 'Regular', 'Urgent' => 'Urgent');
    }

    public static function indentOrderStatus() {
        return array('0' => 'Pending', '1' => 'Finished');
    }

    public static function purchasetype() {
        return array('Company' => 'Company');
    }

    public static function itempurpose() {
        return array('Supply' => 'Supply', 'Resale' => 'Resale');
    }

    public static function transtype() {
        return array('' => '-Select-', 'loan' => 'Loan', 'advance' => 'Advance', 'others' => 'Others');
    }

    public static function year_name() {
        return array('' => '-Select-', '1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June',
            '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
    }

    public static function days() {
        $days = array('1' => '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
            '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        return $days;
    }

    public static function tables() {
        $days = array('1' => '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20');
        return $days;
    }

    public static function years() {
        $year = array();
        for ($i = 2016; $i <= 2030; $i++) {
            $year[] = $i;
        }
        return $year;
    }

    public static function Thumb_Picture($files, $tmpfile, $path) {
        $uploaddir = $path;
        $file = $uploaddir . basename($files);
        if (move_uploaded_file($tmpfile, $file)) {
            // echo "success";
        } else {
            //   echo "error";
        }
        $imagename = $files;
        $source = $tmpfile;
        $target = $uploaddir . $imagename;
        move_uploaded_file($source, $target);

        $imagepath = $imagename;
        $save = $uploaddir . $imagename; //This is the new file you saving
        $file = $uploaddir . $imagename; //This is the original file

        list($width, $height) = getimagesize($file);


        $tn = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($file);
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);

        imagejpeg($tn, $save, 75);

        $save = $uploaddir . "thumb_" . $imagename; //This is the new file you saving
        $file = $uploaddir . $imagename; //This is the original file

        list($width, $height) = getimagesize($file);

        $modwidth = 177;

        $diff = $width / $modwidth;

        $modheight = 200;
        $tn = imagecreatetruecolor($modwidth, $modheight);
        $image = imagecreatefromjpeg($file);
        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);

        imagejpeg($tn, $save, 75);
    }

    public static function PageBar($pagecount, $currentpage = 1, $pagesize = 10, $dtarray = array(), $pagename = "list") {
        //current page bw 1to pagesize
        //show 1 to page size
        //current page > page size & less than (pagecount-pagesize)
        //show curr page to curr_page + page size with offset (pagesize/2)
        //pagecount -current page < page size
        //show curr page to last page(pagecount)
        $pagecount = ceil($pagecount / $pagesize);
        $s = "";
        $s = $s . "<table class='pager'>";
        $s = $s . "<tr>";

        $from = 1;
        $to = $pagesize;
        $x = ceil($pagesize / 2);

        if (empty($dtarray)) {
            if ($currentpage >= $x) {
                $from = ($currentpage - $x) + 1;
                $to = $currentpage + $x;
            }
            if ($pagecount - $currentpage <= $x) {
                $to = $pagecount;
            }

            if ($currentpage > 1) {
                $pre = $currentpage - 1;
                $s = $s . "<td><div class='pagination'>";
                $s = $s . "<span class='previous paginate_button  pageno'  pageno='$pre'>";
                $s = $s . "Prev";
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }
            for ($i = $from; $i <= $to; $i++) {
                $s = $s . "<td><div class='pagination'>";
                if ($i == $currentpage) {
                    $s = $s . "<span class='paginate_active pageno' pageno='$i' >";
                } else {
                    $s = $s . "<span class='paginate_button pageno'  pageno='$i'>";
                }

                $s = $s . $i;
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }
            if ($currentpage != $pagecount) {
                $nxt = $currentpage + 1;
                $s = $s . "<td><div class='pagination'>";
                $s = $s . "<span class='next paginate_button pageno'  pageno='$nxt'>";
                $s = $s . "Next";
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }

            $s = $s . "</tr>";
            $s = $s . "</table>";
            return $s;
        } else {//////////////////////////////////////////////
            $dt1 = '';
            foreach ($dtarray as $key => $value) {
                $dt1 = $dt1 . "&" . $key . "=" . $value;
                //$dt1
            }
            if ($currentpage >= $x) {
                $from = ($currentpage - $x) + 1;
                $to = $currentpage + $x;
            }
            if ($pagecount - $currentpage <= $x) {
                $to = $pagecount;
            }

            if ($currentpage != 1) {
                $pre = $currentpage - 1;
                $s = $s . "<td><div class='pagination'>";
                $s = $s . "<span class='previous paginate_button paginate_button_disabled pageno' pageno='$pre$dt1'>";
                $s = $s . "Prev";
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }
            for ($i = $from; $i <= $to; $i++) {
                $s = $s . "<td><div class='pagination'>";
                if ($i == $currentpage) {
                    $s = $s . "<span class='paginate_active pageno' pageno='$i$dt1' >";
                } else {
                    $s = $s . "<span class='paginate_button pageno' pageno='$i$dt1'>";
                }


                $s = $s . $i;
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }
            if ($currentpage != $pagecount) {
                $nxt = $currentpage + 1;
                $s = $s . "<td><div class='pagination'>";
                $s = $s . "<span class='next paginate_button pageno' pageno='$nxt$dt1'>";
                $s = $s . "Next";
                $s = $s . "</span> ";
                $s = $s . "</div></td>";
            }

            $s = $s . "</tr>";
            $s = $s . "</table>";
            return $s;
        }
    }

    public static function Admin_ajax_pagination($count, $per_page, $cur_page) {
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        /* --------------------------------------------- */
        $no_of_paginations = ceil($count / $per_page);

        /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
        /* ----------------------------------------------------------------------------------------------------------- */
        $msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $cur_page > 1) {
            $msg .= "<li p='1' class='active'>First</li>";
        } else if ($first_btn) {
            $msg .= "<li p='1' class='inactive'>First</li>";
        }

// FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $msg .= "<li p='$pre' class='active'>Previous</li>";
        } else if ($previous_btn) {
            $msg .= "<li class='inactive'>Previous</li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
            else
                $msg .= "<li p='$i' class='active'>{$i}</li>";
        }

// TO ENABLE THE NEXT BUTTON
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $msg .= "<li p='$nex' class='active'>Next</li>";
        } else if ($next_btn) {
            $msg .= "<li class='inactive'>Next</li>";
        }

// TO ENABLE THE END BUTTON
        if ($last_btn && $cur_page < $no_of_paginations) {
            $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
        } else if ($last_btn) {
            $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
        }


        $msg = $msg . "</ul>" . $goto . $total_string . "</div>"; // Content for pagination
        echo $msg;
    }

//================================================================
    public static function CreateRandomNumber() {

        $digits = 5;
        $number = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        return $number;
    }

    public static function CreateRandomPin() {

        $digits = 10;
        $number = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        return rand($number, 10);
    }

    public static function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public static function GetPriceRange() {
        $lst = array('100', '200', '300', '500');
        return $lst;
    }

    public static function GetMartial() {
        $lst = array('Male', 'Female');
        return $lst;
    }

    public static function GetPosition() {
        $lst = array('Commercial(640x480)', 'Promotion(611x560)', 'Front Big Ads(300x250)', 'Front Small Ads(330x140)');
        return $lst;
    }

    public static function random_id($format, $length = '') {
        $final_id = '';
        // Generate a random ID
        if ($format == "random") {
            $final_id = md5(uniqid(rand(), true));
        }
        // Generate a fixed-format ID
        else {
            // Set up a list of possible
            // letters, both lower case
            // and upper case.
            $letters_lower = 'abcdefghijklmnopqrstuvwxyz';
            $letters_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            // Split up the inputted format
            // for the ID into individual
            // characters for processing.
            $the_format = preg_split('//', $format, -1, PREG_SPLIT_NO_EMPTY);
            // Loop through the characters
            foreach ($the_format as $aLetter) {
                // Lower-case letter
                if ($aLetter == "l") {
                    $temp_rand = rand(0, 25);
                    $get_one = $letters_lower[$temp_rand];
                    $final_id .= $get_one;
                }
                // Upper-case letter
                elseif ($aLetter == "L") {
                    $temp_rand = rand(0, 25);
                    $get_one = $letters_upper[$temp_rand];
                    $final_id .= $get_one;
                }
                // Number
                elseif ($aLetter == "n") {
                    $temp_rand = rand(0, 9);
                    $final_id .= $temp_rand;
                }
                // All other characters
                else {
                    $final_id .= $aLetter;
                }
            }
        }
        // If limiting output ID to a specifc
        // length, cut the string to that length.
        if ($length > 0) {
            $final_id = substr($final_id, 0, $length);
        }
        return $final_id;
    }

    public static function toSlug($str, $replace = array(), $delimiter = '-') {
        if (!empty($replace)) {
            $str = str_replace((array) $replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }

    public static function GetMMDDONLY($dt) {
        $date = substr($dt, 0, 11);
        $dtArr = explode("-", $date);
        $ex = date("j M Y", mktime(0, 0, 0, $dtArr[1], $dtArr[2]));
        return $ex;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public static function mmddyyyy_to_yyyymmdd($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $mm = substr($dt, 0, $index1);
        $dd = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $yyyy = substr($dt, $index2 + 1);
        return $yyyy . $sep . $mm . $sep . $dd;
    }

//###########################################################

    public static function yyyymmdd_to_mmddyyyy($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $yyyy = substr($dt, 0, $index1);
        $mm = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $dd = substr($dt, $index2 + 1);
        return $mm . $sep . $dd . $sep . $yyyy;
    }

//###########################################################

    public static function yyyymmdd_to_ddmmyyyy($dt) {
        $sep = "-";
        if (strpos($dt, "/") > 0)
            $sep = "/";
        $index1 = strpos($dt, $sep);
        $index2 = strpos($dt, $sep, $index1 + 1);
        $yyyy = substr($dt, 0, $index1);
        $mm = substr($dt, $index1 + 1, $index2 - $index1 - 1);
        $dd = substr($dt, $index2 + 1);
        return $dd . $sep . $mm . $sep . $yyyy;
    }

//###########################################################


    public static function Getmonth($count) {

        if ($count == 1) {
            return "January";
        } elseif ($count == 2) {
            return "February";
        } elseif ($count == 3) {
            return "March";
        } elseif ($count == 4) {
            return "April";
        } elseif ($count == 5) {
            return "May";
        } elseif ($count == 6) {
            return "June";
        } elseif ($count == 7) {
            return "July";
        } elseif ($count == 8) {
            return "August";
        } elseif ($count == 9) {
            return "September";
        } elseif ($count == 10) {
            return "October";
        } elseif ($count == 11) {
            return "November";
        } elseif ($count == 12) {
            return "December";
        }
    }

    public static function convert_number_to_words($number) {

//   $number = 220693;

        $no = round($number);

        $point = round($number - $no, 2) * 100;

        $hundred = null;

        $digits_1 = strlen($no);

        $i = 0;

        $str = array();

        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');

        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');

        while ($i < $digits_1) {

            $divider = ($i == 2) ? 10 : 100;

            $number = floor($no % $divider);

            $no = floor($no / $divider);

            $i += ($divider == 10) ? 1 : 2;

            if ($number) {

                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else
                $str[] = null;
        }

        $str = array_reverse($str);

        $result = implode('', $str);

        $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';



        return ucfirst($result) . "Rupees  " . ucfirst($points);
    }

}

?>