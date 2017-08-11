<?php

class Reports {

    public function getWeekSales($tdate, $fdate) {
        $sql = "SELECT SUM(cash_price) AS total FROM rest_account_setting WHERE dated between '" . $tdate . "' and '" . $fdate . "'";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getMonthSales($month) {
        $sql = "SELECT SUM(cash_price) FROM rest_account_setting WHERE month(dated)=" . $month . "";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getTotalSales($date) {
        $sql = "SELECT SUM(netamount) AS total FROM rest_orders WHERE orderdate='" . $date . "' and ispaid=1";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getTotalExpenses($date) {
        $sql = "SELECT SUM(totalprice) AS total FROM rest_expenses_master WHERE dated='" . $date . "'";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getTotalDeposit($date) {
        $sql = "SELECT SUM(amount) AS total FROM rest_voucher WHERE category='deposit' and dated='" . $date . "'";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getTotalCounter($date) {
        $sql = "SELECT SUM(amount) AS total FROM rest_voucher WHERE category='capital' and dated='" . $date . "'";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getNoOrders($date) {
        $sql = "SELECT COUNT(*) AS total FROM rest_orders WHERE orderdate='" . $date . "'";

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getCountTotalOrders($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM `user_orders`";

        if (!empty($data['filter_order_status'])) {
            $implode = array();

            $order_statuses = explode(',', $data['filter_order_status']);

            foreach ($order_statuses as $order_status_id) {
                $implode[] = "isactive = '" . (int) $order_status_id . "'";
            }

            if ($implode) {
                $sql .= " WHERE (" . implode(" OR ", $implode) . ")";
            }
        } else {
            $sql .= " WHERE isactive = 0";
        }

        if (!empty($data['filter_order_id'])) {
            $sql .= " AND id = '" . (int) $data['filter_order_id'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(ordersdate) = DATE('" . $data['filter_date_added'] . "')";
        }


        if (!empty($data['filter_total'])) {
            $sql .= " AND totalamount = '" . (float) $data['filter_total'] . "'";
        }

        //echo $sql;
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getTotalOrdersByDay() {
//        $implode = array();
//
//        foreach ($_GET('config_complete_status') as $order_status_id) {
//            $implode[] = "'" . (int) $order_status_id . "'";
//        }

        $order_data = array();

        for ($i = 0; $i < 24; $i++) {
            $order_data[$i] = array(
                'hour' => $i,
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, HOUR(ordersdate) AS hour FROM user_orders WHERE DATE(ordersdate) = DATE(NOW()) GROUP BY HOUR(ordersdate) ORDER BY ordersdate ASC")->queryAll();

        foreach ($query as $result) {
            $order_data[$result['hour']] = array(
                'hour' => $result['hour'],
                'total' => $result['total']
            );
        }

        return $order_data;
    }

    public function getTotalOrdersByWeek() {
//        $implode = array();
//
//        foreach ($_GET('config_complete_status') as $order_status_id) {
//            $implode[] = "'" . (int) $order_status_id . "'";
//        }

        $order_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $order_data[date('w', strtotime($date))] = array(
                'day' => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, ordersdate FROM user_orders WHERE DATE(ordersdate) >= DATE('" . date('Y-m-d', $date_start) . "') GROUP BY DAYNAME(ordersdate)")->queryAll();

        foreach ($query as $result) {
            $order_data[date('w', strtotime($result['ordersdate']))] = array(
                'day' => date('D', strtotime($result['ordersdate'])),
                'total' => $result['total']
            );
        }

        return $order_data;
    }

    public function getOrdersByWeek($account_id) {
        $order_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $order_data[date('w', strtotime($date))] = array(
                'day' => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $sql = "SELECT u.first_name, os.* FROM user_ordersitem os,users u WHERE account_id=$account_id AND os.usersid=u.id AND DATE(os.ordersdate) >= DATE('" . date('Y-m-d', $date_start) . "')";

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getTotalOrdersByMonth() {
//        $implode = array();
//
//        foreach ($_GET('config_complete_status') as $order_status_id) {
//            $implode[] = "'" . (int) $order_status_id . "'";
//        }

        $order_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $order_data[date('j', strtotime($date))] = array(
                'day' => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, ordersdate FROM user_orders WHERE DATE(ordersdate) >= '" . date('Y') . '-' . date('m') . '-1' . "' GROUP BY DATE(ordersdate)")->queryAll();
        //echo "SELECT COUNT(*) AS total, ordersdate FROM user_orders WHERE DATE(ordersdate) >= '" . date('Y') . '-' . date('m') . '-1' . "' GROUP BY DATE(ordersdate)";

        foreach ($query as $result) {
            $order_data[date('j', strtotime($result['ordersdate']))] = array(
                'day' => date('d', strtotime($result['ordersdate'])),
                'total' => $result['total']
            );
        }
        return $order_data;
    }

    public function getTotalOrdersByYear() {
//        $implode = array();
//
//        foreach ($_GET('config_complete_status') as $order_status_id) {
//            $implode[] = "'" . (int) $order_status_id . "'";
//        }

        $order_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $order_data[$i] = array(
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, ordersdate FROM user_orders WHERE YEAR(ordersdate) = YEAR(NOW()) GROUP BY MONTH(ordersdate)")->queryAll();

        foreach ($query as $result) {
            $order_data[date('n', strtotime($result['ordersdate']))] = array(
                'month' => date('M', strtotime($result['ordersdate'])),
                'total' => $result['total']
            );
        }

        return $order_data;
    }

    public function getTotalCustomersByDay() {
        $customer_data = array();

        for ($i = 0; $i < 24; $i++) {
            $customer_data[$i] = array(
                'hour' => $i,
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, HOUR(created) AS hour FROM `users` WHERE DATE(created) = DATE(NOW()) GROUP BY HOUR(created) ORDER BY created ASC")->queryAll();

        foreach ($query as $result) {
            $customer_data[$result['hour']] = array(
                'hour' => $result['hour'],
                'total' => $result['total']
            );
        }

        return $customer_data;
    }

    public function getTotalCustomersByWeek() {
        $customer_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $order_data[date('w', strtotime($date))] = array(
                'day' => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, created FROM `users` WHERE DATE(created) >= DATE('" . date('Y-m-d', $date_start) . "') GROUP BY DAYNAME(created)")->queryAll();

        foreach ($query as $result) {
            $customer_data[date('w', strtotime($result['created']))] = array(
                'day' => date('D', strtotime($result['created'])),
                'total' => $result['total']
            );
        }

        return $customer_data;
    }

    public function getTotalCustomersByMonth() {
        $customer_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $customer_data[date('j', strtotime($date))] = array(
                'day' => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, created FROM `users` WHERE DATE(created) >= '" . date('Y') . '-' . date('m') . '-1' . "' GROUP BY DATE(created)")->queryAll();

        foreach ($query as $result) {
            $customer_data[date('j', strtotime($result['created']))] = array(
                'day' => date('d', strtotime($result['created'])),
                'total' => $result['total']
            );
        }

        return $customer_data;
    }

    public function getTotalCustomersByYear() {
        $customer_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $customer_data[$i] = array(
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }

        $query = Yii::app()->db->createCommand("SELECT COUNT(*) AS total, created FROM `users` WHERE YEAR(created) = YEAR(NOW()) GROUP BY MONTH(created)")->queryall();

        foreach ($query as $result) {
            $customer_data[date('n', strtotime($result['created']))] = array(
                'month' => date('M', strtotime($result['created'])),
                'total' => $result['total']
            );
        }

        return $customer_data;
    }

    public function getfreshitem($data = array()) {
        $sql = "SELECT pc.name as category,psc.name as scategory,pi.itemname as item_name,pi.brand as brand,pi.item_scale as scale,i.stock_qty as stock_qty,i.discard_date as discard_date from purchase_category pc,purchase_sub_category psc,purchase_item pi,item_stock i";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE pi.isfreshstock = 1";
        } else {
            $sql .= " WHERE pi.isfreshstock = 1";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(i.created_date) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(i.created_date) <= '" . $data['filter_date_end'] . "'";
        }

        $sql .= " and pi.p_category_id=pc.id and pi.p_sub_category_id=psc.id and pi.id=i.item_id";

        //echo $sql;
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        return $query;
    }

    public function getrawmaterial($data = array()) {
        if (!empty($data['choice_item'])) {
            if ($data['choice_item'] == "all") {
                $sql = "SELECT inv.id as invoice_id,inv.invoice_no as invoice_no,inv.invoice_date as invoice_date,pi.id as item_id,pi.itemname as item_name,pi.brand as brand,pi.item_scale as scale,sum(pii.stock_qty) as stock_qty,pii.rate as rate,pii.amount as amount,
pc.name as category,psc.name as scategory
from purchase_invoice_items pii 
join purchase_item pi ON pii.item_id=pi.id
join purchase_invoice inv ON inv.id=pii.invoice_id
join purchase_category pc ON pc.id=pii.p_category_id
join purchase_sub_category psc ON psc.id=pii.p_sub_category_id
where inv.is_reviewed=1 ";
                if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(inv.created_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(inv.created_date) <= '" . $data['filter_date_end'] . "'";
                }
                $sql .= " group by pii.item_id";
             //  echo $sql;        
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            } else {

              $sql = "select inv.id as invoice_id,inv.invoice_no as invoice_no,inv.invoice_date as invoice_date,inv.invoice_type as invoice_type,pii.stock_qty as stock_qty,inv.total_amount as amount,concat(v.firm_name ,' / ', v.name) as vendorinfo
  from purchase_invoice_items pii 
 join purchase_invoice inv ON inv.id=pii.invoice_id
 join vendor v ON v.id=inv.vendor_id where inv.is_reviewed=1";
                if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(inv.created_date) >= '" . $data['filter_date_start'] . "'";
                }
                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(inv.created_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['p_category_id'])) {
                    $sql .= " AND pii.p_category_id=" . $data['p_category_id'];
                }
                if (!empty($data['p_sub_category_id'])) {
                    $sql .= " AND pii.p_sub_category_id=" . $data['p_sub_category_id'];
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND pii.item_id=" . $data['item_id'];
                }
              //  $sql .= " group by pii.item_id";
              //  echo $sql;
                $query = Yii::app()->db->createCommand($sql)->queryAll();
            }
        }
        return $query;
    }

    public function getAvailableQty($item,$f_dt,$t_dt) {
      $sql="select sum(isk.stock_qty) as avl_stock_qty from item_stock isk where DATE(isk.created_date) >= '$f_dt' AND DATE(isk.created_date) <= '$t_dt' and isk.item_id=$item";
      return Yii::app()->db->createCommand($sql)->queryAll();
    }
    public function getsalesitem($data = array()) {
        if (!empty($data['choice_item'])) {
                 if ($data['choice_item'] == "internal_item") {
                $sql = "SELECT ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,pi.itemname as item_name,pi.brand as brand,si.description as description,si.qty as stock_qty,si.amount as amount from purchase_item pi,off_shelf_sale ss,off_shelf_sale_items si";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(ss.order_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(ss.order_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND si.item_id=" . $data['item_id'];
                }

                $sql .= " and si.item_id=pi.id and si.shelf_sale_id=ss.id and ss.txn_type='internal' order by ss.order_date desc";
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            }else  if ($data['choice_item'] == "selfitem") {
//                $sql = "SELECT ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,pi.itemname as item_name,pi.brand as brand,si.description as description,si.qty as stock_qty,si.amount as amount from purchase_item pi,off_shelf_sale ss,off_shelf_sale_items si";
                //description is the itemname
                $sql = "SELECT ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,description,pi.brand as brand,si.qty as stock_qty,si.amount as amount from purchase_item pi,off_shelf_sale ss,off_shelf_sale_items si";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(ss.order_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(ss.order_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND si.item_id=" . $data['item_id'];
                }

                $sql .= " and si.item_id=pi.id and si.shelf_sale_id=ss.id and ss.txn_type!='internal' order by ss.order_date desc";
               //echo $sql;
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            } else if($data['choice_item'] == "menuitem") {

                $sql = "SELECT ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,pi.itemname as description,pi.brand as brand,mi.qty as stock_qty,mi.amount as amount from purchase_item pi,menu_sale ss,menu_sale_items mi";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(ss.order_date) >= '" . $data['filter_date_start'] . "'";
                }
                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(ss.order_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND mi.item_id=" . $data['item_id'];
                }
               $sql .= " and mi.item_id=pi.id and mi.menu_sale_id=ss.id";
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            }
        }
        return $query;
    }

    public function getsalesbill($data = array()) {
        if (!empty($data['choice_item'])) {
            if ($data['choice_item'] == "selfitem") {
                $sql = "SELECT sum(ss.amount) as amount,o.invoice_number,o.order_date as orderdate,o.order_time as time,o.txn_type from off_shelf_sale_items ss join off_shelf_sale o ON ss.shelf_sale_id=o.id";
                //$sql = "SELECT ss.id,ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,ss.txn_type from off_shelf_sale ss";
                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(o.order_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(o.order_date) <= '" . $data['filter_date_end'] . "'";
                }
                $sql .= " group by ss.shelf_sale_id";
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            } else {
                $sql = "SELECT sum(ss.amount) as amount,o.invoice_number,o.order_date as orderdate,o.order_time as time,o.txn_type from menu_sale_items ss join menu_sale o ON ss.menu_sale_id=o.id";
                //$sql = "SELECT ss.invoice_number,ss.order_date as orderdate,ss.order_time as time,ss.txn_type as txn_type from menu_sale ss";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(o.order_date) >= '" . $data['filter_date_start'] . "'";
                }
                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(o.order_date) <= '" . $data['filter_date_end'] . "'";
                }
                $sql .= "  group by ss.menu_sale_id";
                $query = Yii::app()->db->createCommand("$sql")->queryAll();
            }
        }
        return $query;
    }

//     public static function getsingle($choice_item,$id) {
//        if(!empty($choice_item)){ 
//        if($choice_item=="selfitem"){
//        $sql = "SELECT sum(amount) FROM `off_shelf_sale_items` WHERE shelf_sale_id=$id";
//        $query = Yii::app()->db->createCommand("$sql")->queryScalar();
//
//        }else{
//        $sql = "SELECT sum(amount) FROM `menu_sale_items` WHERE menu_sale_id=$id";    
//        $query = Yii::app()->db->createCommand("$sql")->queryScalar();            
//        }
//     }
//        return $query;
//    }
    public function getgritem($data = array()) {
        $sql = "SELECT i.invoice_no as invoice_no,pi.itemname as item_name,pi.brand as brand,pis.stock_qty as stock_qty,pis.amount as amount from purchase_item pi,purchase_invoice i,purchase_invoice_items pis";

        if (!empty($data['filter_date_start'])) {
            $sql .= " WHERE DATE(i.invoice_date) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(i.invoice_date) <= '" . $data['filter_date_end'] . "'";
        }

        $sql .= " and pis.item_id=pi.id and pis.invoice_id=i.id and pis.is_added_to_stock=0 and pis.is_good_return=1";
        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getvendorduepayment($data = array()) {
        $sql = "SELECT * FROM vendor";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE is_active = 1";
        } else {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " and id NOT IN (SELECT receiver_id FROM voucher where payment_receiver_type='vendor' ";
        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(dated) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(dated) <= '" . $data['filter_date_end'] . "'";
        }

        $sql .= " ) and vendor_bal>0";

        //echo $sql;
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        return $query;
    }

    public function getallvendorduepayment($data = array()) {
        $sql = "SELECT * FROM vendor";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE is_active = 1";
        } else {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " and vendor_bal>0";

        //echo $sql;
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        return $query;
    }

    public function getcalculatedsalary($data = array()) {
        $sql = "SELECT e.empcode as empcode,e.empname as empname,e.dob as dob,es.total_present_days as tpresent,es.total_absent_days as tabsent,es.total_leave_days as tleave,es.amount as basic,es.advance as advance,es.ta as ta,es.da as da,es.hra as hra, es.salary_deduction as salary_deduction,es.total_salary as tsalary from hr_employee e,employee_salary es";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE e.is_active = 1";
        } else {
            $sql .= " WHERE e.is_active = 1";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(es.dated) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(es.dated) <= '" . $data['filter_date_end'] . "'";
        }

        $sql .= " and e.id=es.employee_id";

        //echo $sql;
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        return $query;
    }

    public function getExpensesitem($data = array()) {
        $sql = "SELECT expense_master_id as eid,subcategory_id as sid, dated as date, qty AS qty,totalprice AS total FROM `rest_expenses`";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE isactive = 1";
        } else {
            $sql .= " WHERE isactive=1";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(dated) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(dated) <= '" . $data['filter_date_end'] . "'";
        }

        if (!empty($data['filter_item'])) {
            $sql .= " AND subcategory_id = " . $data['filter_item'] . "";
        }

        $sql .= " ORDER BY dated DESC";

        //GROUP BY o.item_id, o.dated
        // echo $sql;

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getloglist($data = array()) {
        $sql = "SELECT u.name,l.log_type,l.in_out FROM users_logins l,users u where l.user_id=u.id";

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(l.in_out) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(l.in_out) <= '" . $data['filter_date_end'] . "'";
        }

        if (!empty($data['filter_name'])) {
            $sql .= " AND user_id = " . $data['filter_name'] . "";
        }

        $sql .= " ORDER BY l.id DESC";

        //GROUP BY o.item_id, o.dated
        // echo $sql;

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getTodayOrdersitem($data = array()) {
        $sql = "SELECT orderdate,id,type,tableno,customername,mobileno,netamount FROM `rest_orders` ";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE isactive = 1";
        } else {
            $sql .= " WHERE isactive=1";
        }

        if (!empty($data['filter_date'])) {
            $sql .= " AND DATE(orderdate) = '" . $data['filter_date'] . "'";
        }

        if (!empty($data['filter_cat'])) {
            $sql .= " AND type = " . $data['filter_cat'] . "";
        }

        if (!empty($data['filter_item'])) {
            $sql .= " AND item_id = " . $data['filter_item'] . "";
        }

        $sql .= " ORDER BY orderdate DESC";

        //GROUP BY o.item_id, o.dated
        // echo $sql;

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getOrders($data = array()) {
        $sql = "SELECT MIN(o.orderdate) AS date_start, MAX(o.orderdate) AS date_end, COUNT(*) AS `orders`, SUM(o.netamount) AS `total` FROM `rest_orders` o";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE o.isactive = 1";
        } else {
            $sql .= " WHERE o.isactive=1";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(o.orderdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(o.orderdate) <= '" . $data['filter_date_end'] . "'";
        }

        if (!empty($data['filter_group'])) {
            $group = $data['filter_group'];
        } else {
            //$group = 'week';
        }

        switch ($group) {
            case 'day';
                $sql .= " GROUP BY YEAR(o.orderdate), MONTH(o.orderdate), DAY(o.orderdate)";
                break;
            default:
            case 'week':
                $sql .= " GROUP BY YEAR(o.orderdate), WEEK(o.orderdate)";
                break;
            case 'month':
                $sql .= " GROUP BY YEAR(o.orderdate), MONTH(o.orderdate)";
                break;
            case 'year':
                $sql .= " GROUP BY YEAR(o.orderdate)";
                break;
        }

        $sql .= " ORDER BY o.orderdate DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        //echo $sql;

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getTotalOrders($data = array()) {
        if (!empty($data['filter_group'])) {
            $group = $data['filter_group'];
        } else {
            $group = 'week';
        }

        switch ($group) {
            case 'day';
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), MONTH(ordersdate), DAY(ordersdate)) AS total FROM user_ordersitem";
                break;
            default:
            case 'week':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), WEEK(ordersdate)) AS total FROM user_ordersitem";
                break;
            case 'month':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), MONTH(ordersdate)) AS total FROM user_ordersitem";
                break;
            case 'year':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate)) AS total FROM user_ordersitem";
                break;
        }

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE isactive= '" . (int) $data['filter_order_status_id'] . "' and account_id=" . $data['account_id'];
        } else {
            $sql .= " WHERE account_id=" . $data['account_id'];
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(ordersdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(ordersdate) <= '" . $data['filter_date_end'] . "'";
        }

        //echo $sql;
        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getCustomersOrders($data = array()) {
        $sql = "SELECT c.id, CONCAT(c.first_name, ' ', c.last_name) AS customer, c.email, c.isactive, COUNT(*) AS `orders`, SUM((SELECT SUM(op.qty) FROM `user_ordersitem` op WHERE op.orderid = o.id GROUP BY op.orderid)) AS products, SUM(o.totalamount) AS `total` FROM `user_orders` o,users c";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE o.isactive = '" . (int) $data['filter_order_status_id'] . "' and o.usersid=c.id";
        } else {
            $sql .= " WHERE o.isactive = 0 and o.usersid=c.id";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(o.ordersdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(o.ordersdate) <= '" . $data['filter_date_end'] . "'";
        }

        if (!empty($data['filter_group'])) {
            $group = $data['filter_group'];
        } else {
            $group = 'week';
        }

        switch ($group) {
            case 'day';
                $sql .= " GROUP BY YEAR(o.ordersdate), MONTH(o.ordersdate), DAY(o.ordersdate)";
                break;
            default:
            case 'week':
                $sql .= " GROUP BY YEAR(o.ordersdate), WEEK(o.ordersdate)";
                break;
            case 'month':
                $sql .= " GROUP BY YEAR(o.ordersdate), MONTH(o.ordersdate)";
                break;
            case 'year':
                $sql .= " GROUP BY YEAR(o.ordersdate)";
                break;
        }

        $sql .= " ORDER BY o.ordersdate DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        //echo $sql;

        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getCustomersTotalOrders($data = array()) {
        if (!empty($data['filter_group'])) {
            $group = $data['filter_group'];
        } else {
            $group = 'week';
        }

        switch ($group) {
            case 'day';
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), MONTH(ordersdate), DAY(ordersdate)) AS total FROM user_orders";
                break;
            default:
            case 'week':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), WEEK(ordersdate)) AS total FROM user_orders";
                break;
            case 'month':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate), MONTH(ordersdate)) AS total FROM user_orders";
                break;
            case 'year':
                $sql = "SELECT COUNT(DISTINCT YEAR(ordersdate)) AS total FROM user_orders";
                break;
        }

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE isactive= '" . (int) $data['filter_order_status_id'] . "'";
        } else {
            $sql .= " WHERE isactive = 0";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(ordersdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(ordersdate) <= '" . $data['filter_date_end'] . "'";
        }

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

    public function getPurchased($data = array()) {
        $sql = "SELECT op.item, op.qty AS quantity, op.totalamount AS total FROM user_ordersitem op";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE op.isactive = '" . (int) $data['filter_order_status_id'] . "' and op.account_id=" . $data['account_id'];
        } else {
            $sql .= " WHERE op.account_id=" . $data['account_id'];
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(op.ordersdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(op.ordersdate) <= '" . $data['filter_date_end'] . "'";
        }

        $sql .= " ORDER BY total DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
//echo $sql;        
        $query = Yii::app()->db->createCommand("$sql")->queryAll();

        return $query;
    }

    public function getTotalPurchased($data) {
        $sql = "SELECT COUNT(DISTINCT op.pid) AS total FROM `user_ordersitem` op LEFT JOIN `user_orders` o ON (op.orderid = o.id)";

        if (!empty($data['filter_order_status_id'])) {
            $sql .= " WHERE o.isactive = '" . (int) $data['filter_order_status_id'] . "'";
        } else {
            $sql .= " WHERE o.isactive = 0";
        }

        if (!empty($data['filter_date_start'])) {
            $sql .= " AND DATE(o.ordersdate) >= '" . $data['filter_date_start'] . "'";
        }

        if (!empty($data['filter_date_end'])) {
            $sql .= " AND DATE(o.ordersdate) <= '" . $data['filter_date_end'] . "'";
        }

        $total = Yii::app()->db->createCommand("$sql")->queryScalar();
        return $total;
    }

}
