//Make a offer
function makeOffer(){
		//alert();
		var product_id=$('#product_id').val();
		var seller_id=$('#seller_id').val();
		var product_name=$('#product_name').val();
		var buyer_id=$('#buyer_id').val();
		var offer_price=$('#offer_price').val();
		var trans_id=$('#trans_id').val();
		if(offer_price==''){
			$('#ErrPUP').html(lg_please_enter_the_amount);
			return false;
		}else if(isNaN(offer_price)){
			$('#ErrPUP').html(lg_characters_not_allowed);
			return false;
		}else{
		if(trans_id!=''){			
			$.ajax({
				type:'post',
				url	: baseURL+'site/offers/make_offer',
				dataType: 'html',			
				data:{'product_id':product_id,'seller_id':seller_id,'product_name':product_name,'buyer_id':buyer_id,'offer_price':offer_price,'trans_id':trans_id,},
				complete:function(){
					
					window.location.reload();
					} 
				
				} );
		}else{
			$.ajax({
				type:'post',
				url	: baseURL+'site/offers/make_offer',
				dataType: 'html',			
				data:{'product_id':product_id,'seller_id':seller_id,'product_name':product_name,'buyer_id':buyer_id,'offer_price':offer_price,},
				 error:function(a,b,c){
				 alert(c);
				 return false;
				 },
				 complete:function(){
					window.location.reload();
					} 
			} );
		}return false;	
	}
}	
	
//buyer cancel offer
	function cancelOffer(){
		var r = confirm(lg_Are_you_Sure_to_Cancel_it);
		if(r == true){
		var product_id=$('#product_id').val();
		var seller_id=$('#seller_id').val();
		var buyer_id=$('#buyer_id').val();
		var requested_price=$('#requested_price').val();
		$.ajax({
			type:'post',
			url	: baseURL+'site/offers/cancel_offer',
			dataType: 'html',			
			data:{'product_id':product_id,'seller_id':seller_id,'buyer_id':buyer_id,'requested_price':requested_price,},
			/* success: function(response){ 
				alert(response);
			} */
			 complete:function(){
				
				window.location.reload();
			}
			
		}); 
		}else{
			return false;
		}
		
}
//accept the offer
function acceptOffer(){
		var r = confirm("Are you Sure to Accept it?");
		if(r == true){
			var product_id=$('#product_id').val();
			var seller_id=$('#seller_id').val();
			var buyer_id=$('#buyer_id').val();
			var requested_price=$('#requested_price').val();
			var trans_id=$('#trans_id').val();
			$.ajax({
				type:'post',
				url	: baseURL+'site/offers/accept_offer',
				dataType: 'html',			
				data:{'product_id':product_id,'seller_id':seller_id,'buyer_id':buyer_id,'requested_price':requested_price,'trans_id':trans_id},
					 complete:function(){
					window.location.reload();
				}
				
			}); 
		}else{
			return false;
		}
}
//rejectOffer

function rejectOffer(){
	var r = confirm("Are you Sure to Reject it?");
		if(r == true){
			var product_id=$('#product_id').val();
			var seller_id=$('#seller_id').val();
			var buyer_id=$('#buyer_id').val();
			var requested_price=$('#requested_price').val();
			var trans_id=$('#trans_id').val();
			$.ajax({
				type:'post',
				url	: baseURL+'site/offers/reject_offer',
				dataType: 'html',			
				data:{'product_id':product_id,'seller_id':seller_id,'buyer_id':buyer_id,'requested_price':requested_price,'trans_id':trans_id},
			
				 complete:function(){
					window.location.reload();
				}
				
			}); 
		}else{
			return false;
		}
}

//Decline offer
function declineOffer(){
	var r = confirm("Are you Sure to Decline it?");
		if(r == true){
			var product_id=$('#product_id').val();
			var seller_id=$('#seller_id').val();
			var buyer_id=$('#buyer_id').val();
			var requested_price=$('#requested_price').val();
			var trans_id=$('#trans_id').val();
			$.ajax({
				type:'post',
				url	: baseURL+'site/offers/decline_offer',
				dataType: 'html',			
				data:{'product_id':product_id,'seller_id':seller_id,'buyer_id':buyer_id,'requested_price':requested_price,'trans_id':trans_id},
				
				 complete:function(){
				 window.location.reload();
				}
				
			}); 
		}else{
			return false;
		}
}

//chat validation
function chatCheck(){
	var message_text=$('#message_text').val();
	if(message_text.length<5){
		$('#ErrPUP').html(lg_msg_min);
		$('#ErrPUP').show().delay('3000').fadeOut();
		return false;
	}else{
		return true;
	}
}
//Add to Cart
function addToCart(){
			var r = confirm("Are you Sure to Add it to Cart?");
		if(r == true){
			var quantity='1';
			var product_id=$('#cart_product_id').val();
			var sell_id=$('#cart_sell_id').val();
			var price=$('#cart_requested_price').val();
			var mqty=$('#cart_mqty').val();
			var buyer_id=$('#cart_buyer_id').val();
			var trans_id=$('#cart_trans_id').val();
			var digital_files=$('#digital_item').val();
			var error='0';
			$.ajax({

				type: 'POST',
				url: baseURL+'site/cart/usercartadd',
				data: {'mqty':mqty,'quantity':quantity, 'product_id':product_id, 'sell_id':sell_id, 'price':price,'digital_files':digital_files,},
				success: function(response){
					var arr = response.split('|');
					if(arr[0] =='login'){
						window.location.href= baseURL+"login";	
					}else if(arr[0] == 'Error'){
						error='1';
						$.ajax({
								type:'post',
								url	: baseURL+'site/offers/offer_status_cart',
								dataType: 'html',			
								data:{'error':error,},
								
								 complete:function(){
									window.location.reload();
								}
						}); 	
					}else{
						$.ajax({
							type:'post',
							url	: baseURL+'site/offers/offer_status_cart',
							dataType: 'html',			
							data:{'product_id':product_id,'seller_id':sell_id,'buyer_id':buyer_id,'requested_price':price,'trans_id':trans_id,'error':error},
							
							 complete:function(){
							window.location.reload();
							} 
						}); 
					}
				}
			});
		}else{
			return false;
		}
	}



//edit button
function edit_offer(){
	$(".edit_offer_btn").css("display", "none");
	$("#make_offer").css("display", "block");
}