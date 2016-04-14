/**
 * jQuery Live CSS Editor (LCE)
 * 
 * @author Milan Rukavina 2012
 */

(function($)
{
    var opts = {}, self = null, preview = null, inspector = null, properties = null, propEditors = {};    
    
    /**
     * main jquery plugin function
     */
    $.fn.livecsseditor = function(options,params)
    {
        
        //create options
        opts = $.extend({}, $.fn.livecsseditor.defaults, options);
        if(options == 'getCss'){
			//alert();
			
            opts = self.data('opts');
            var pagePath = null;
            if(params && params['pagePath']){
                pagePath = params['pagePath'];
            }
			//alert(pagePath);
            return getCss(pagePath);
        }
		if(options == 'get_header_Css'){
            opts = self.data('opts');
            var pagePath = null;
            if(params && params['pagePath']){
                pagePath = params['pagePath'];
            }
            return get_header_Css(pagePath);
        }
		if(options == 'get_footer_Css'){
            opts = self.data('opts');
            var pagePath = null;
            if(params && params['pagePath']){
                pagePath = params['pagePath'];
            }
            return get_footer_Css(pagePath);
        }
		if(options == 'get_body_Css'){
            opts = self.data('opts');
            var pagePath = null;
            if(params && params['pagePath']){
                pagePath = params['pagePath'];
            }
            return get_body_Css(pagePath);
        }

        // return the object back to the chained call flow
        return this.each(function()
        {
            self = $(this);
            //store opts
            self.data('opts',opts);
			//alert(opts);
            loadTpl(opts.layout_tpl,function renderLayout(tplStr){
                self.html(tmpl(tplStr,{'pages':opts.pages}));
                preview = self.find('#lcePreview');
                inspector = self.find('#lceInspector');
                properties = self.find('#lceProperties');
                //get first page	
				//alert(opts.pages);
                for(var pagePath in opts.pages){break;}
                //load page
                loadPage(pagePath);
                //on change page
                inspector.find('#lcePages').change(function(){
					//$("#page_name").val("sdf");
					//alert();
					$(document).find('#page_name').val(this.options[this.selectedIndex].text);
										
                    loadPage($(this).val())
                });
            }); 
        });               
    };

    /**
     * Get css code - for all pages or just pagePath
     */
    function getCss(pagePath){
        var css = '';
		//alert("getcss");
        var cssForPage = function cssForPage(props){
            var css = '';
            for(var propSelector in props){
				//alert(props);
                var selectorCss = '';
                props[propSelector].values = props[propSelector].values || {};
                for(var i = 0; i < props[propSelector].props.length; i++){
                    var prop = props[propSelector].props[i];
                    if(props[propSelector].values[prop]){
                        selectorCss += prop + ':' + props[propSelector].values[prop] + '; '
                    }
                }				
                if(selectorCss != ''){
                    css += propSelector + '{' + selectorCss + "}\n";
                }
            }
			
            return css;
        }
        if(pagePath){
			//alert(opts.pages[pagePath].def);
            css += cssForPage(opts.pages[pagePath].def);
        }
        else{
            for(var currPagePath in opts.pages){
                css += cssForPage(opts.pages[currPagePath].def);
            }
        } 

        return css;
    } 
	//header css
	function get_header_Css(pagePath){
        var css1 = '';
		var header_arr= ['div.header_top','input#search_items','input.search-bt','button.browse','span.icon-text,div.cart-top a','a#signin-icon ','span#CartCount1'];
		
        var cssForPage = function cssForPage(props){
            var css1 = '';
            for(var propSelector in props){
				//
				if(jQuery.inArray(propSelector,header_arr) != -1){
					 var selectorCss = '';
					props[propSelector].values = props[propSelector].values || {};
					//alert(props[propSelector].values );
					for(var i = 0; i < props[propSelector].props.length; i++){
						var prop = props[propSelector].props[i];
						
						if(props[propSelector].values[prop]){
							
							selectorCss += prop + ':' + props[propSelector].values[prop] +";"
						}
					}	
					
					if(selectorCss != ''){
						css1 += propSelector + '{' + selectorCss + "}\n";
					} 
				}
            }
			//alert(css1);
            return css1;
        }
         if(pagePath){
			css1 += cssForPage(opts.pages[pagePath].def);
        }
        else{
            for(var currPagePath in opts.pages){
                css1 += cssForPage(opts.pages[currPagePath].def);
            }
        } 
        return css1;
    }
	//footer css
	function get_footer_Css(pagePath){
        var css2 = '';
		var header_arr= ['section.foot-bg','div.footer-block ul.footer-list li a','div.footer-block span','ul.locale-settings li a,ul.locale-settings','div.footer-row a div.help-bt','ul.bt-menu li#copy,ul.bt-menu li a','a div.search-bt'];
		
        var cssForPage = function cssForPage(props){
            var css2 = '';
            for(var propSelector in props){				
				if(jQuery.inArray(propSelector,header_arr) != -1){
					//alert(propSelector);
					 var selectorCss = '';
					props[propSelector].values = props[propSelector].values || {};
					
					for(var i = 0; i < props[propSelector].props.length; i++){
						var prop = props[propSelector].props[i];
						
						if(props[propSelector].values[prop]){
							
							selectorCss += prop + ':' + props[propSelector].values[prop] +";"
						}
					}	
					//alert(selectorCss);
					if(selectorCss != ''){
						css2 += propSelector + '{' + selectorCss + "}\n";
					} 
				}
            }
			//alert(css1);
            return css2;
        }
         if(pagePath){
			css2 += cssForPage(opts.pages[pagePath].def);
        }
        else{
            for(var currPagePath in opts.pages){
                css2 += cssForPage(opts.pages[currPagePath].def);
            }
        } 
        return css2;
    }
	//body css
	function get_body_Css(pagePath){
        var css3 = '';
		var header_arr= ['body','div.get-pro','span.subcribe-box  form input.search-bt','div.community_right','div.community_right,div.split_prefile h2,div.split_prefile p,span#display_first_name,div.profile_field span,div.field_account label,div.convers,div.pro_check label','div.split_prefile a,input#profile_submit','div#landing_div, div#landing_div h1','div#cart_div','div#product_search_div','div#product_detail_div','div#shop_page_seller,div#shop_page_seller p.pay_p','div.art,div.listings-title,div.product_box,div.list_wrap,div#shop-info,div.shop-sections-container_left,div.shop-sections-container_right,div.sh_border,div.sh_border1,div#add-photos .list_inner_fields,div#variation_one .list_inner_fields,div#variation_two .list_inner_fields,table.table.table-striped,div.sh_border h4,table#tbNames td ,table#tbNames th,table.tab_form_list_table,table.tab_form_list_table tr th,div.list_div1,div.list_div1  div.list_inner_fields,div.list_div,div.payment_hide p,div.payment_hide  table label,div.payment_btn,div.community_right','div#seller_div','div#profile_div','span.owner-details em,span.owner-details span','div#secondary','body,section.container','ul.search-restrictions','h2,div.s-cart-bl-header','ul.suggestion-list','div.card_for_temp,div.cart_details,ul.suggestion-list','a.s-cart-button','ul.owner-fav li a,ul.owner-fav li a span','div.favorite_box1','div#fav_list_tag','div.seller-wrapper','div.content-seller, body','div.middel-detail,div.col-md-12.realated-this-item','div.add_shop,div.add_shop ul.add_steps,div.add_shop ul.add_steps a','div.community_div','div#fav_shop_list','div.add_steps,div.add_steps ul.add_steps  li,div.add_steps ul.add_steps li a','div.product_box,div.art,div.listings-title,body','nav#nav-main a,div.add_steps','div.community_right, body','div#bio','div.add_steps div.main nav#nav-main a,div.add_steps','div.community_right,div.community_right h2,div.community_right p,body','div.community_right,body','div.tab-content,div.related-listing-inner','div.tab-content,div.related-listing-inner,div.favorites-nag,div.listing-page-cart,div.listing-page-cart-inner,div#favoriting-and-sharing','div.middel-detail,div.col-md-12.realated-this-item,div.seller-wrapper,div.content-seller','div.art,div.listings-title,div.product_box,div.list_wrap,div#shop-info','div#community_tag','div.hole_content,div#property_table_info,div#property_table_filter label','div#activeInactiveTop a.see_more','table#property_table,table#property_table thead tr,table.property_table td','div.community_right,div.split_prefile h2,div.split_prefile p,span#display_first_name,div.pro_check label,div.profile_field span,div.field_account label,div.convers,div.shipping_field label,div.cart-list,div.cart-list div.card-payment div#complete-payment,div.cart-list.chept2 div.card-payment,div.cart-list.chept2  div.hotel-booking-left,div#complete-payment b,div#complete-payment span,div#complete-payment label,div#complete-payment,div.hotel-booking-left  div.hotel-booking-noti,div.cart-list.chept2  div.card-payment  div.card-payment-foot,div#complete-payment big,div.community_right span.order_text,div.community_right span.trans_text,div.community_right span.date-no,div.community_right label.order_text-number,div.community_right div.order_side-right1 p,table#order_table_view'];
		
        var cssForPage = function cssForPage(props){
            var css3 = '';
            for(var propSelector in props){
				//
				if(jQuery.inArray(propSelector,header_arr) != -1){
					 var selectorCss = '';
					props[propSelector].values = props[propSelector].values || {};
					
					for(var i = 0; i < props[propSelector].props.length; i++){
						var prop = props[propSelector].props[i];
						
						if(props[propSelector].values[prop]){
							
							selectorCss += prop + ':' + props[propSelector].values[prop] +";"
						}
					}	
					
					if(selectorCss != ''){
						css3 += propSelector + '{' + selectorCss + "}\n";
					} 
				}
            }
			//alert(css3);
            return css3;
        }
         if(pagePath){
			css3 += cssForPage(opts.pages[pagePath].def);
        }
        else{
            for(var currPagePath in opts.pages){
                css3 += cssForPage(opts.pages[currPagePath].def);
            }
        } 
        return css3;
    }

    /**
     * Assign editor to a property
     *
     */
    function assignEditor(props, propSelector, prop, valueContainer, editor, selectorIndex, propertyIndex){
		
        props[propSelector].editors[prop] = editor({
            'id':'editor-' + selectorIndex + '-' + propertyIndex,
            'container':valueContainer,
            'selector': propSelector,			
            'prop':prop,
            'value':props[propSelector].values[prop],
            'setValue':function(value){
				//alert(value);
                props[propSelector].values[prop] = value;
                preview.contents().find(propSelector).css(prop,value);
            },
            'preview':preview,
            'previewId':'lcePreview'
        }); 
		//alert(page_path);
    }
	
    /**
     * Load page
     */
    function loadPage(pagePath){
		//alert(pagePath);
        var props = opts.pages[pagePath].def, currEditor;
		var page_path = pagePath;
		//alert(page_path);
        //load iframe
        preview.attr("src", pagePath);
        preview.load(function(){
            loadTpl(opts.props_tpl,function renderProperties(tplStr){
                properties.html(tmpl(tplStr,{'properties':props}));                
                //set editors, read values
                var selectorIndex = 0;
                for(var propSelector in props){
                    props[propSelector].editors = props[propSelector].editors || {};
                    props[propSelector].values = props[propSelector].values || {};
                    for(var i = 0; i < props[propSelector].props.length; i++){
                        var prop = props[propSelector].props[i];
                        //if values are not empty - we might come back from previous page
                        //so we need to re-apply style
                        if(props[propSelector].values[prop]){
                            preview.contents().find(propSelector).css(prop,props[propSelector].values[prop]);
                        }
                        else{
                            //read value
                            props[propSelector].values[prop] = preview.contents().find(propSelector).css(prop);
                        }
                        var query = '#properties-' + selectorIndex + ' li.prop-index-' + i + ' > div.lcePropValue';
                        var valueContainer = properties.find(query).first();
                        //currEditor = (propEditors[prop])?propEditors[prop]:propEditors['default']; 
						currEditor = propEditors['color'];
						assignEditor(props, propSelector, prop, valueContainer, currEditor, selectorIndex, i);
                    }
                    preview.contents().find(propSelector).data('selectorIndex',selectorIndex).click(function(){
                        properties.find('.collapse').removeClass('in');
                        properties.find('#properties-' + $(this).data('selectorIndex')).addClass('in');
						
                    });
					$(document).find('#cssBtn1').attr('path',pagePath);					
                    selectorIndex++;
                }
                //mark selected selector
                properties.find('.collapse').on('show', function () {
                    var selected = preview.contents().find($(this).data('selector'));
                    var selectedBgColor = selected.css('background-color');
                    selected.animate({'background-color':'yellow'},500,function(){
                        $(this).css('background-color',selectedBgColor);
                    });
                });
				
            }); 
			
        })
		
    }    
    
    var tpls = {};

    /**
     * Ajax call to a page and parse microtpl
     */
    function loadTpl(url,callback){
        if(tpls[url] == null){
            $.get(url, function(data){
                tpls[url] = data;
                if(callback){
                    callback(data);
                }
            }, 'html');
        }
        else{
            if(callback){
                callback(tpls[url]);
            }
        }
        return tpls[url];
    }    

    /*
    function getCssDefinition(iframe,path){
        var sheets = iframe[0].contentDocument.styleSheets, definition = {};
        for(var i = 0; i < sheets.length; i++) {
            if(sheets[i].href.indexOf(path) == -1){
                continue;
            }
            var rules = sheets[i].rules || sheets[i].cssRules;
            for(var r = 0; r < rules.length; r++) {
                //console.log(rules[r]);
                definition[rules[r].selectorText] = css2json(rules[r].style);
            }
        }
        return definition;
    }

    function css2json(css){
        var s = {};
        if(!css) return s;
        for(var i = 0; i < css.length; i++) {
            if((css[i]).toLowerCase) {
                s[(css[i]).toLowerCase()] = (css[css[i]]);
            }
        }
        return s;
    }*/

    /**
     * Attach custom editor for a property
     */
    $.fn.livecsseditor.setPropertyEditor = function setPropertyEditor(property,editorCallback){
        if(property instanceof Array){
            for(var i = 0; i < property.length; i++){
                propEditors[property[i]] = editorCallback;
            }
        }
        else{
            propEditors[property] = editorCallback;
        }        
    }  

    
    
    /**
     * default options
     */
    $.fn.livecsseditor.defaults =
    {
        'layout_tpl':'tmpl/layout.html',
        'props_tpl':'tmpl/properties.html'
    };
})(jQuery);   // pass the jQuery object to this function


