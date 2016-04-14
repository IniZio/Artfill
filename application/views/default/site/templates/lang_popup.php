<form action="currency" method="post" id="preferencesForm" name="preferencesForm" onsubmit="return change_currency_ajax()" >
	<div id="Language" BehaviorID ="ModalBehaviour" class="modal in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
            
            <div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_default_1"  id="languageTab" data-toggle="tab">
								<?php if($this->lang->line('user_language') != '') { echo stripslashes($this->lang->line('user_language')); } else echo 'Language'; ?> 
							</a>
						</li>
						<li>
							<a href="#tab_default_2" id="currencyTab" data-toggle="tab">
								<?php if($this->lang->line('user_currency') != '') { echo stripslashes($this->lang->line('user_currency')); } else echo 'Currency'; ?>
							</a>
						</li>						
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_default_1">
							<div class="tab-content">
								<div class="tab_box">
									<div class="popup_tab_content" style="min-height: 400px;">
										<div class="footer_popup_left">
											<h2>Choose your Language:</h2>
											<div class="verticalslider">
												<ul style="border:none;" class="preference_split">                                       
													 <?php foreach($languagesList->result() as $LList){ 
													 
													 if($languageCode == ''){
														$languageCode='en';
													 }
													 
													 ?>
														<li class="languageLi  <?php if($LList->lang_code == $languageCode){ echo 'currencyactive';}?>" id="<?php echo $LList->lang_code;?>"  data-name="<?php echo $LList->name;?>">
														<a><?php echo $LList->name; ?></a>
													</li>
													<?php } ?>
													
												</ul>
											</div>
										</div>
									</div>										
								</div>
							</div>    
							
							<!--<div class="modal-footer footer_tab_footer">
									<div class="btn-group">
									<a class="btn btn-default submit_btn" data-dismiss="modal"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
									<button class="btn btn-default submit_btn"><?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?></button>
								</div>
							</div>-->
								
						</div>
					    <div class="tab-pane" id="tab_default_2">						
						    <div class="tab-content">
                                <div class="popup_tab_content" style="min-height: 400px;">
                                   <div class="footer_popup_left">
                                    	<h2>Choose your Currency:</h2>
                                        <div class="pass">
                                            <ul style="border:none;" class="preference_split" id="currency_pop">
                                               <?php foreach($currencyList->result() as $crnylist) {?>
                                            	<li class="currencyLi  <?php if($crnylist->currency_code == $currencyType){ echo 'currencyactive';}?>" id="<?php echo $crnylist->currency_code;?>">
                                                    <input type="hidden" id="<?php echo 'cur'.$crnylist->currency_code;?>" value="<?php echo $crnylist->currency_symbol.' '.$crnylist->currency_name;?>" />
                                                    <input type="hidden" id="cursymbol<?php echo $crnylist->currency_code;?>" value="<?php echo $crnylist->currency_symbol;?>">
                                                    <span><?php echo $crnylist->currency_symbol; ?></span>
                                                    <a class="split_link" ><?php echo $crnylist->currency_name; ?></a>
                                                    <span style="margin:4px 0 0 0px;"> <?php echo $crnylist->currency_code; ?></span>
                                                </li>
                                            <?php } ?>   
                                            </ul>
                                        </div>
                                    </div>
                                </div>                           
                	        </div>
                		
							
						</div>
						
						<div class="modal-footer footer_tab_footer">
						
						<div class="footer_tab_content">
							<span id="selectedLanguage"><?php echo $languageName; ?></span>/
							<span id="selectedCurrency"><?php echo $currencySymbol;?> <?php echo $currencyName;?> </span>
						</div>
								<div class="btn-group">
									<div style="float:left; display:none;">
										<span id="selectedLanguage"><?php echo $languageName; ?></span>/ 
										<span id="selectedCurrency"><?php echo $currencySymbol;?> <?php echo $currencyName;?> </span>
										<!--/ <span id="selectedReligion"><?php echo $regionName;?> </span>-->
									</div>	
													
									<input type="hidden" name="returnUrl" value="<?php echo current_url();?>">
									<input type="hidden" name="currency" id="currency" value="<?php echo $currencyType;?>" />  
									<input type="hidden" name="language" id="language" value="<?php echo $languageCode;?>" />
									
									<span id="loginloadErr" style="padding: 12px; display: inline; display:none;">
										<img src="images/indicator.gif" alt="Loading...">
									</span>
									
									<a class="btn btn-default submit_btn" id="cancel" data-dismiss="modal"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
 									<button class="btn btn-default submit_btn"><?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?></button>
									
								</div>
							</div>

					</div>
				</div>
			</div>
            
            </div>
        </div>
	</div>
</form>	

<script>


function change_currency_ajax(){
	//$.noConflict();
	var currency = $("#currency").val();
	var language = $("#language").val();

	$("#loginloadErr").show();
	
// 	alert(currency);
// 	alert(language);
	
	$.ajax({
		type:'post',
		url:baseURL+'site/user_settings/change_currency_ajax',
		data:{'currency':currency,'language':language},
		dataType: 'html',
		success: function(data){ 
			var sel = $("#selectedLanguage").text()
			//alert(sel);
			$("#language_href").text(sel);
			//$("#currency_href").text($("#selectedCurrency").text());
			//$("#currency_href").text(currency);
			
			var curr = $("#cursymbol"+currency).val() +" "+currency;
			//alert(curr);
			$("#currency_href").text(curr);

			//alert("rere");
			
			$("#loginloadErr").hide();
			//$('#Language').modal('toggle');
			$("#Language")[0].click();
			$(".language-setting").show();


// 			var r = confirm("Press Ok to reload");
// 			if (r == true) {
// 			    window.location.reload();
// 			} else {
// 			}
			
			
		}
	});

	//$('#Language').modal('toggle');
	return false;
}
</script>
