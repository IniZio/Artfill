/*-----------------------Script for Auctions------------------------------------*/
$(document).ready(function(e) {
	$("#makeBid").click(function(){
		var aID=$("#makeBid").attr("data-aid");
		var uID=$("#makeBid").attr("data-uid");
		popupContent(aID,uID,'makeBid');
	});
	
	$("#increseBid").click(function(){
		var aID=$("#increseBid").attr("data-aid");
		var uID=$("#increseBid").attr("data-uid");
		popupContent(aID,uID,'increaseBid');
	});
	
	$(".chkBid").click(function(){
		var aID=$(this).attr("data-aid");
		var uID=$(this).attr("data-uid");
		var chk=$(this).attr("data-chk");
		popupContent(aID,uID,chk);
	});
});

function bidAmount(elID){
	var aID=$("#"+elID.id).attr("data-aid");
	var amt=parseFloat($("#"+elID.id).attr("data-amt"));
	makeBidding(aID,amt);
}
function customBid(){
	var aID=$("#custBid").attr("data-aid");
	var amt=$("#custBidAmt").val();
	makeBidding(aID,amt);
}
function ajaxError(jqXHR, exception) {
	if (jqXHR.status === 0) {
		alert('Not connect.\n Verify Network.');
	} else if (jqXHR.status == 404) {
		alert('Requested page not found. [404]');
	} else if (jqXHR.status == 500) {
		alert('Internal Server Error [500].');
	} else if (exception === 'parsererror') {
		alert('Requested JSON parse failed.');
	} else if (exception === 'timeout') {
		alert('Time out error.');
	} else if (exception === 'abort') {
		alert('Ajax request aborted.');
	} else {
		alert('Uncaught Error.\n' + jqXHR.responseText);
	}
}
function popupContent(aID,uIDs,chk,bID,content,bAmts){
	if (typeof(uIDs) == "undefined"){
		var uIDs='';
	}
	if (typeof(bID) == "undefined"){
		var bID='';
	}
	if (typeof(content) == "undefined"){
		var content='';
	}
	if (typeof(bAmts) == "undefined"){
		var bAmts='ref';
	}
	if (typeof(chk) == "undefined"){
		var chk='makeBid';
	}

	if(bAmts=='ref'){
		var bAmt=$("#bid_amount").val();
	}else{
		var bAmt=bAmts;
	}
	var pType=chk;
	if(bAmt>0 && pType=='makeBid' ){
		makeBidding(aID,bAmt);
	}else{
		$.ajax({
			beforeSend: function(be) {
				$('#bidPopContent').html('');
				$('#popUpLoad').show();
			},
			type: 'POST',
			url:baseURL+'site/auction/popupContent',
			data: {'pType':pType,'auctionId':aID,'userId':uIDs,'bid_amount':bAmt,'bidID':bID,'content':content},
			//dataType: 'json',
			success: function(data){
				$('#popUpLoad').hide();
				$('#bidPopContent').html(data);
			},
			error: function (jqXHR, exception) {
				ajaxError(jqXHR,exception);				
			}/* ,
			complete:function(){
				window.location.reload();
				window.location.href = window.location.pathname;
			}*/
		});
	}
}

function makeBidding(aID,bAmt){
	$.ajax({
		beforeSend: function(be) {
			if(bAmt==null || isNaN(bAmt) || bAmt<=0){
				$("#alert_wrong").show();
				$("#alert_wrong p").html("Enter a valid amount for your bid.");
				return false
			}else{
				$("#alert_wrong").hide();
			}
		},
		type: 'POST',
		url:baseURL+'site/auction/tempBid',
		data: {'auctionId':aID,'bid_amount':bAmt},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				var content=$("#bidPopContent").html();
				if(content!=''){
					$("#alert_wrong").show();
					$("#alert_wrong p").html(json.content);
				}else{
					if(json.usrId!=""){
						popupContent(json.auctId,json.usrId,'makeBids','',json.content);
					}
					$("#alert_wrong").show();
					$("#alert_wrong p").html(json.content);
				}
			}else if(json.status==1){
				popupContent(aID,json.usrId,'confirmBid',json.bidId);
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}
function changeBid(aID,uID,bidId){
	popupContent(aID,uID,'editBid',bidId);
}
function confirmBid(aID,uID,bidId){
	popupContent(aID,uID,'confirmBid',bidId);
}
function updateBid(aID,uID,bidId,bAmt){
	var newAmt=$("#newBidAmt").val();
	$.ajax({
		beforeSend: function(be) {
			if(newAmt==null || isNaN(newAmt)){
				$("#alert_wrong").show();
				$("#alert_wrong p").html("Enter a valid amount for your bid.");
				return false
			}else if(newAmt<=bAmt){
				$("#alert_wrong").show();
				$("#alert_wrong p").html("Maximum bids can't be lowered once they're submitted.");
				return false
			}else{
				$("#alert_wrong").hide();
			}
		},
		type: 'POST',
		url:baseURL+'site/auction/editBid',
		data: {'bidding_id':bidId,'bid_amount':newAmt},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				$("#alert_wrong").show();
				$("#alert_wrong p").html(json.content);
			}else if(json.status==1){
				popupContent(aID,uID,'confirmBid',bidId);
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}

function removeBid(bidId){
	$.ajax({
		beforeSend: function(be) {
			$('#bidPopContent').hide();
			$('#popUpLoad').show();
		},
		type: 'POST',
		url:baseURL+'site/auction/removeBid',
		data: {'bidding_id':bidId},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				$('#bidPopContent').show();
				$('#popUpLoad').hide();
				$("#alert_wrong").show();
				$("#alert_wrong p").html(json.content);
			}else if(json.status==1){
				//window.location.reload();
				window.location.href = window.location.pathname;
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}

function saveBidding(bidId){
	$.ajax({
		beforeSend: function(be) {
			$('#bidPopContent').hide();
			$('#popUpLoad').show();
		},
		type: 'POST',
		url:baseURL+'site/auction/saveBidding',
		data: {'bidding_id':bidId},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				$('#bidPopContent').show();
				$('#popUpLoad').hide();
				$("#alert_wrong").show();
				$("#alert_wrong p").html(json.content);
			}else if(json.status==1){
				//window.location.reload();
				window.location.href = window.location.pathname;
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}


function increaseBid(aID,uID,bAmt){
	var newAmt=$("#newBidAmt").val();
	$.ajax({
		beforeSend: function(be) {
			$("#alert_success").hide();
			$("#alert_wrong").hide();
			if(newAmt==null || isNaN(newAmt)){
				$("#alert_wrong").show();
				$("#alert_wrong p").html("Enter a valid amount for your bid.");
				return false
			}else if(newAmt<=bAmt){
				$("#alert_wrong").show();
				$("#alert_wrong p").html("Maximum bids can't be lowered once they're submitted.");
				return false
			}
		},
		type: 'POST',
		url:baseURL+'site/auction/tempBid',		
		data: {'auctionId':aID,'userId':uID,'bid_amount':newAmt},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				$("#alert_wrong").show();
				$("#alert_wrong p").html(json.content);
			}else if(json.status==1){
				popupContent(aID,json.usrId,'confirmBid',json.bidId);
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}

function deleteBid(aID,bID){
	$.ajax({
		beforeSend: function(be) {
		},
		type: 'POST',
		url:baseURL+'site/store/deleteBid',		
		data: {'auctionId':aID,'bidId':bID},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				alert(json.content);
			}else if(json.status==1){
				window.location.reload();
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}

function deleteAuction(aID,bID){
	$.ajax({
		beforeSend: function(be) {
		},
		type: 'POST',
		url:baseURL+'site/store/deleteBid',		
		data: {'auctionId':aID,'bidId':bID},
		dataType: 'json',
		success: function(json){
			if(json.status==0){
				alert(json.content);
			}else if(json.status==1){
				window.location.reload();
			}
		},
		error: function (jqXHR, exception) {
			ajaxError(jqXHR,exception);
		}
	});
}
function validate_contact_seller(){
	var subject=$('#subject').val();
	var message_text=$('#message').val();
	if(subject.length<3){
		$('#ErrPOP').html('Type Subject minimum 3 characters');
		$('#ErrPOP').show().delay('3000').fadeOut();
		return false;
	}if(message_text.length<5){
		$('#ErrPOP').html('Type message minimum 5 characters');
		$('#ErrPOP').show().delay('3000').fadeOut();
		return false;
	}else{
		return true;
	}
}