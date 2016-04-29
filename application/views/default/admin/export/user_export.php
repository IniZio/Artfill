<?php
$this->load->view('admin/templates/header.php');
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>User Details Export</h6>
             <div id="widget_tab">
                <ul>
                    <li><a href="#tab1" class="active_tab">Export All</a></li>
                     <li><a href="#tab2">Customize</a></li>
                </ul>
                </div>
          </div>
          <div class="widget_content">
            <?php $attributes = array('class' => 'form_container left_label','id' => 'display_form','name'=>'export_form');
			
				echo form_open('',$attributes) 
			?>
             <div id="tab1">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">User Details</label>
                    <div class="form_input">
                    <input type="radio" id="userexp" name="exporttable" value="admin/admin_export/export_user" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Seller Details </label>
                    <div class="form_input">
                    <input type="radio" id="sellerexp" name="exporttable" value="admin/admin_export/export_seller" />
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="amounts">Product Details</label>
                    <div class="form_input">
                    <input type="radio" id="productexp" name="exporttable" value="admin/admin_export/export_product" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="default_amount">Orders Pending</label>
                    <div class="form_input">
                      <input type="radio" id="order1exp" name="exporttable" value="admin/admin_export/export_order1" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="expiry_days">Orders Paid</label>
                    <div class="form_input">
                     <input type="radio" id="order2exp" name="exporttable" value="admin/admin_export/export_order2" />
                    </div>
                  </div>
                </li>
              </ul>
              </div>
               <div id="tab2">
               <ul>
               <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">From Date</label>
                    <div class="form_input">
                   <input name="fromDate" id="eventDate1" autocomplete="off" type="text" tabindex="6" class="required small tipTop" title="Please select the date"/> 
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">To Date</label>
                    <div class="form_input">
                     <input name="toDate" id="eventDate2" autocomplete="off" type="text" tabindex="6" class="required small tipTop" title="Please select the date"/> 
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">User Details</label>
                    <div class="form_input">
                    <input type="radio" id="userexp" name="exporttable" value="admin/admin_export/export_user" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Seller Details </label>
                    <div class="form_input">
                    <input type="radio" id="sellerexp" name="exporttable" value="admin/admin_export/export_seller" />
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="amounts">Product Details</label>
                    <div class="form_input">
                    <input type="radio" id="productexp" name="exporttable" value="admin/admin_export/export_product" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="default_amount">Orders Pending</label>
                    <div class="form_input">
                      <input type="radio" id="order1exp" name="exporttable" value="admin/admin_export/export_order1" />
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="expiry_days">Orders Paid</label>
                    <div class="form_input">
                     <input type="radio" id="order2exp" name="exporttable" value="admin/admin_export/export_order2" />
                    </div>
                  </div>
                </li>
              </ul>
               </div>
            <ul style="border:none;"><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15" onClick="return changeAction();" ><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>

<script>
function changeVisible(a)
{ $("#eventDate1").val("");
$("#eventDate2").val("");
 if(a==2)
 {
  if($("div.customfields").css("display")=="none")
  {
   $("div.customfields").show(300);
   $("div.customfields").css("display","block");
  }
 
 }
 else
 {
  $("div.customfields").hide(300);
   $("div.customfields").css("display","none");
 } 
}
function changeAction()
{
  var act=document.export_form.exporttable;
  var flag=false;
  for(i=0;i<act.length;i++)
  {
    if(act[i].checked==true)
	{
	  document.export_form.setAttribute("action",act[i].value);
	  flag=true;
	  break;
	}
  }
  
      if(($("#eventDate1").val()!=""&&$("#eventDate2").val()=="")||($("#eventDate1").val()==""&&$("#eventDate2").val()!=""))
	  {
	    alert("Fill both date filter or leave custom filters"); 
	  }
 
   if(flag==false)
   {
          alert("Select any option to export details");
   }
  return flag;
  
}

	window.onload = function(){
		
		new JsDatePick({
			useMode:2,
			target:"eventDate1",
			limitToToday:false,
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		new JsDatePick({
			useMode:2,
			target:"eventDate2",
			limitToToday:false,
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>

<?php 
$this->load->view('admin/templates/footer.php');
?>
