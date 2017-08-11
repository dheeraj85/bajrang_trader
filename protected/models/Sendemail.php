<?php

class Sendemail {

    //public static $baseUrl = "http://localhost/toc/";
    public static $baseUrl = "http://52.41.103.98/";

    public static function getSmtp($to, $message, $subject) {

        $headers = "From:admin@toc.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);
    }
    public static function getSmtpMail($to, $message, $subject) {

        $headers =  "From: TOC Software <admin@toc.com>\r\n";
        $headers .= "Cc: toc@live.in\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Bcc: consultamit@gmail.com\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    public static function getPropSmtp($to, $message, $subject) {

        $headers = "From:contact@toc.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);
    }
    
    public static function SendPurchaseOrderdetails($pono,$to,$vname,$podetails) {
        $subject = " $pono KASA";
        $message = "<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #FFFFFF;' bgcolor='#FFFFFF' leftmargin='0'>
<table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#FFFFFF'>
    <tr>
        <td>

            <table cellspacing='0' border='0' align='center' cellpadding='0' width='624'>
                <tr>
                    <td>
                        <table cellspacing='0' border='0' cellpadding='0' width='624'>
                            <tr>
                                <td valign='top'> <img src='" . self::$baseUrl . "/dist/img/spacer-top.jpg' height='12' width='624' />

                                    <table cellspacing='0' border='0' cellpadding='0' width='624'>
                                        <tr>
                                            <td>
                                               <img src='" . self::$baseUrl . "/dist/img/toc-logo.jpg'/>
                                            </td>
                                            <td width='380'></td>
                                            <td>
                                            <h3>The Oven Classics</h3>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                        <table cellspacing='0' border='0' cellpadding='0' width='624'>
                            <tr>
                                <td height='50' valign='middle' width='624'><img src='" . self::$baseUrl . "/dist/img/line-break-2.jpg' height='13' width='624' /></td>
                            </tr>
                        </table>
                        <table cellspacing='0' border='0' id='email-content' cellpadding='0' width='624'>
                            <tr>
                                <td>
                                    <table cellspacing='0' border='0' cellpadding='0' width='624'>
                                        <tr>
                                            <td>
                                                <h2 style='font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333 !important; margin: 0px;'>Dear $vname</h2>";
                                        $message .= "<br/>Kindly Process the $pono and deliver the order by Required Date.<br/><br/>";    
                                        if (!empty($podetails)) {
                                               $message .= "<table width='100%'>
                                                        <thead>
                                                            <tr>
                                                                <th style='border:1px solid #ddd;padding:5px;text-align: left;'>Item with Scale</th>
                                                                <th style='border:1px solid #ddd;padding:5px;text-align: left;'>Qty</th>  
                                                                <th style='border:1px solid #ddd;padding:5px;text-align: left;'>Require Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>";
                                                            foreach ($podetails as $vs) {
                                                             $message .= "<tr>
                                                                    <td style='border:1px solid #ddd;padding:5px;text-align: left;'>".$vs->item_name."(".$vs->qty_scale." )</td>
                                                                    <td style='border:1px solid #ddd;padding:5px;text-align: left;'>".$vs->qty_req."</td>
                                                                     <td style='border:1px solid #ddd;padding:5px;text-align: left;'>".$vs->req_date."</td>
                                                                </tr>"; 
                                                            }
                                                       $message .= "</tbody></table>";
                                                    }                                        
                                                                $message .= "</td>
                                        </tr>
                                    </table>

                                    <table cellspacing='0' border='0' cellpadding='0' width='624'>
                                        <tr>
                                            <td height='30' valign='middle' width='624'><img src='" . self::$baseUrl . "/dist/img/line-break-2.jpg' height='13' width='624' /></td>
                                        </tr>
                                    </table>

                                    <table cellspacing='0' border='0' cellpadding='0' width='624'>
                                        <tr>
                                            <td>
                                                <p style='font-size: 11px; line-height: 12px; font-family: Arial; color: #333; margin: 0px;'>
                                                    Copyright &copy; 2015-2016 TOC Application. All rights reserved.
                                                    <br />
                                                </p>
                                             </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>";
        //echo $subject . "<br/>" . $message . "<hr>";
        self::getSmtpMail($to, $message, $subject);
    }

}
?>