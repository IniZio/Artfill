<?php $message .= '<table style=\"font-family: Arial, Helvetica, sans-serif; font-size: 13px; background: #eee; border: 1px solid #DCDCDC; box-shadow: 0 0 1px 0 #CCCCCC;\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" width=\"650\" align=\"center\">
<tbody>
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650\" align=\"center\">
<tbody>
<tr>
<td style=\"padding: 5px 7px; font-weight: bold; color: #d15511; font-size: 17px;\"><a href=\"'.base_url().'\"><img src=\"'.base_url().'images/logo/'.$logo.'\" alt=\"'.$meta_title.'\" /></a></td>
</tr>
</tbody>
</table>
<table style=\"margin-top: 10px; border: 1px solid #DCDCDC; padding: 15px; background: #fff; border-radius: 3px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650\" align=\"center\">
<tbody>
<tr>
<td style=\"padding: 10px 0px; color: #5a5a5a; font-size: 15px;\">Hi '.$userName.',</td>
</tr>
<tr>
<td style=\"padding: 6px 0px; color: #5a5a5a; font-size: 15px;\">The email address for your '.$email_title.' account - '.$userName.' - was changed today to '.$newMailID.'.</td>
</tr>
<tr>
<td style=\"padding: 10px 0px; color: #5a5a5a; font-size: 15px;\">If you made this change, then it\'s all good! just follow the instruction in the email we sent to your new email address.</td>
</tr>
<tr>
<td style=\"padding: 10px 0px; color: #5a5a5a; font-size: 15px;\">If you didn\'t make this change, <a href=\"'.base_url().'pages/contact-us\">Contact Support</a> and we\'ll look into it for you.</td>
</tr>
<tr>
<td style=\"padding: 10px 0 4px 0px; color: #5a5a5a; font-size: 15px;\">Thanks,</td>
</tr>
<tr>
<td style=\"padding: 0px 0px 15px 0; color: #5a5a5a; font-size: 15px;\">'.$email_title.'</td>
</tr>
</tbody>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650\" align=\"center\">
<tbody>
<tr>
<td style=\"padding: 15px 7px; color: #8b8b8b; font-size: 13px;\">'.$footer_content.'</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';  ?>