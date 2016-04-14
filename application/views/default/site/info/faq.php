<link href="css/default/front/bootstrap.css" rel="stylesheet">
<link hrefimages/="css/default/front/font-awesome.css" rel="stylesheet">
<link href="css/default/front/main.css" rel="stylesheet">
<link href="css/default/front/deal.css" rel="stylesheet">
<link href="css/default/front/browse.css" rel="stylesheet">
<link href="css/default/front/home.css" rel="stylesheet">
<link href="css/default/front/art.css" rel="stylesheet">
<link href="css/default/front/seller.css" rel="stylesheet">
<link href="css/default/front/custom.css" rel="stylesheet"> 
<link href="css/default/site/responsive-dev.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/shopsy_style_1.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/account_master.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/popup.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/site/help.css"/>
<link rel="stylesheet" type="text/css" media="all" href="css/default/front/auction.css"/>
<!---<link rel="stylesheet" type="text/css" media="all" href="css/default/site/my_shop.css"/>
 <link href="css/default/front/new-style.css" rel="stylesheet">  -->
<link href="css/default/front/edit-css.css" rel="stylesheet">
<link href="css/default/site/shop-add.css" rel="stylesheet">
<link href="css/default/front/menu-horizontal.css" rel="stylesheet">
<link href="css/default/front/zo-cas-style.css" rel="stylesheet">
<link href="css/default/front/style-responsive.css" rel="stylesheet">
<link href="css/default/front/responsive-style-sheet.css" rel="stylesheet">
<?php 
$this->load->view('site/templates/header');
?>

<link href="css/animate.css" rel="stylesheet">
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Home-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>

<div id="info">
<section class="container">

<div style="min-height:600px;color:#4c4c4c;border:1px;background-color:#ffffff;padding:10px;">
<h1 style="color:#8dbad4;margin-top:300px;text-align:center;"> 常見問題 </h1>

<hr/>

<p>
<b><u>退貨政策</u></b><br/>
Artfill讓賣家自行釐訂退貨政策，不會干涉買賣雙方之協議，因此各商店的退貨政策可能有所不同，顧客必須留意並向店舖查詢。然而，本公司要求賣家設定退貨日期的上限為20天。
<br/>
若買賣雙方協議退貨，必須自行協商發還貨品的方法，本公司並不參與發還貨品的過程，但將根據買賣雙方所選擇的方式發出退款, 而運費及手續費將不獲退還。不同退款方式需時各異, 過程需時最多14個工作天。
</p>
<br/>
<br/>
<p>
<b><u>最新情報及優惠</u></b><br/>
請立即登記成為Artfill會員，並訂閱電子報。<br/>
顧客只需在www.artfill.co填寫電郵地址及基本個人資料，即可定期獲得最新情報及不定期之優惠。<br/>
您亦可讚好Artfill 的Facebook專頁及於Instagra追蹤Artfill.co，緊貼手作潮流。<br/>
<br/>
*優惠受條款及細則約束。本公司將保留一切決定權。 
<br/><br/>
<u><i>訂購商品方法</i></u><br/>
顧客首先要成為Artfill之網上會員才可進行交易。成功註冊者將收到電郵確認身份及會籍。在選購過程中，顧客只需點擊圖片便可獲得商品更多詳情。及後可以自訂顏色、設計、尺寸，再點擊「購物籃」保存商品。若欲訂購，可點擊「確認付款」並選擇付款方法。結帳後將收到電郵確定交易。

</p>
<br/>

<p>
<b><u>忘記密碼</u></b><br/>
您可以隨時登入本網頁接“忘記密碼”，先核對個人資料，再確認電郵以重新設定密碼。
</p>
<br/>

<p>
<b><u>更新帳戶資料</u></b><br/>
先點擊「編輯」，再在更新資料後點擊「儲存變更」。
</p>
<br/>

<p>
<b><u>信用卡不被接納</u></b><br/>
請聯絡你的銀行以確保其服務運作正常。如問題尚未解決, 請電郵至admin＠artfill.co 聯絡我們。
</p>
<br/>

<p>
<b><u>逾期未收貨品</u></b><br/>
買家可向設計師詢問商品出貨進度。若未｀得到確實回應，請聯絡我們， 我們會立即替您處理問題,保陣買家權益
</p>
<br/>

<p>
<b><u>後補或更正資訊</u></b><br/>
買家可透過Artfill.co向設計師更正及補充資訊， 了解處理程序。
</p>
<br/>

<p>
<b><u>退換貨服務</u></b><br/>
每位賣家均有不同退貨或退款條款，買家應在付款前留意條款，亦可向賣家查詢詳情。
</p>
<br/>

<p>
<b><u>我的信用卡資料會否被保存??</u></b><br/>
為了提供一個流暢愉快的購物體驗, 您可選擇儲存部分付款資料, 例如您的姓名及信用卡號碼。但為保障您的私隱及安全, 信用卡的驗證編碼不會被保存。
</p>
<br/>

</div>

</section>
</div>

<?php 
$this->load->view('site/templates/footer');
?>