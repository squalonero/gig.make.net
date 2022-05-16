!function($){function e(){this.customPlaceholderText=!1,this.wrapperClass="autocomplete-dropdown",this.inputClass=!1,this.allowAdditions=!0,this.noResultsText="No results found",this.onChange=null,this.onSelect=null}e.prototype={constructor:e,instances:{},init:function(e,t){var s=this;$.extend(s,t),s.isTouch="ontouchend"in document,s.$select=$(e),dataSettings=s.$select.data()||{},isMultiple=!!s.$select.context.multiple,s.id=e.id,s.name=e.name,s.options=[],s.$options=s.$select.find("option"),s.selected=[],s.$select.is(":disabled")&&(s.disabled=!0),s.$options.length&&(s.$options.each(function(e){var t=$(this);t.hasClass("label")&&0===e?(s.hasLabel=!0,s.label=t.text(),t.attr("value","")):s.options.push({domNode:t[0],title:t.text(),value:t.val(),selected:t.is(":selected")}),t.is(":selected")&&!t.hasClass("label")&&(s.selected={index:e,value:t.val(),title:t.text()},s.selected.push(selectedData),s.focusIndex=e)}),s.render())},render:function(){var e=this,t=e.isTouch&&e.nativeTouch?" touch":"",s=e.disabled?" disabled":"",n=e.readonly?" readonly":"",o=e.customPlaceholderText?e.customPlaceholderText:e.hasLabel?e.label:"",a=e.inputClass?e.inputClass:"",l=isMultiple?" multi-select":"",i=[];e.$container=e.$select.wrap('<div class="'+e.wrapperClass+s+t+n+l+'"><div class="old" /></div>').parent().parent(),e.$searchbox=$('<input type="text" class="'+a+'" placeholder="'+o+'" '+n+" />").appendTo(e.$container),e.$searchResults=$('<div class="results"><ul /></div>').appendTo(e.$container),e.$list=e.$searchResults.find("ul"),e.selected.length>0&&(e.multiSelect?($.each(e.selected,function(e,t){i.push(" "+t.title)}),e.readonly?e.$searchbox.val(i):($.each(e.selected,function(t,s){e.$searchbox.parent().append('<span class="option-tag">'+s.title+' <span class="remove-tag" data-option-value="'+s.value+'"></span></span>')}),e.tagClick())):e.$searchbox.val(e.selected[0].title)),e.bindHandlers()},getMaxHeight:function(){var e=this;e.maxHeight=0;for(var t=0;t<e.$items.length;t++){var s=e.$items.eq(t);if(e.maxHeight+=s.outerHeight(),e.cutOff===t+1)break}},bindTouchHandlers:function(){var e=this;e.$container.on("click.autocompleteDropdown",function(){e.$select.focus()}),e.$select.on({change:function(){var t=$(this).find("option:selected"),s=t.text(),n=t.val();e.$searchbox.val(s),"function"==typeof e.onSelect&&e.onSelect.call(e.$select[0],{title:s,value:n})},focus:function(){e.$container.addClass("focus")},blur:function(){e.$container.removeClass("focus")}})},bindHandlers:function(){var e=this;e.$searchbox.on({"focus.autocompleteDropdown":function(){e.$container.addClass("focus"),e.inFocus=!0},"blur.autocompleteDropdown":function(){e.$container.removeClass("focus"),e.inFocus=!1},"keyup.autocompleteDropdown":function(){e.query=e.$searchbox.val().toUpperCase(),0!==e.query.length?e.search():e.close()}})},unbindHandlers:function(){var e=this;e.$container.add(e.$select).add(e.$searchbox).off(".autocompleteDropdown")},tagClick:function(){var e=this,t=e.$searchbox.siblings(".option-tag").children(".remove-tag"),s=e.$select.val();t.on({click:function(){var t=$(this).data("option-value").toString();s=$.grep(s,function(e){return e!=t}),e.$select.val(s),$(this).parent().remove()}})},tagClick:function(){var e=this,t=e.$searchbox.siblings(".option-tag").children(".remove-tag"),s=e.$select.val();t.on({click:function(){var t=$(this).data("option-value").toString(),n=e.$select.children('option[value="'+t+'"]');s=$.grep(s,function(e){return e!=t}),e.$select.val(s),n.prop("selected",!1),$(this).parent().remove()}})},open:function(){var e=this;e.$select.focus(),e.$container.addClass("open"),e.$searchResults.css("height",e.maxHeight+"px")},close:function(){var e=this;$(e.$searchResults.find("ul")).html(""),e.$container.removeClass("open")},closeAll:function(){var e=this,t=Object.getPrototypeOf(e).instances;for(var s in t){t[s].close()}},search:function(){var e=this,t=function(t){return e.options[t].title.toUpperCase()},s=new RegExp(e.query.replace(/[^\w\s]/gi,""),"i");e.search_results=[];for(var n=0;n<e.options.length;n++){var o=t(n);o.match(s)&&e.search_results.push(e.options[n])}if(e.resultsNumber=e.search_results.length,$(e.$searchResults.find("ul")).html(""),e.resultsNumber>0)$.each(e.search_results,function(){$('<li data-value="'+this.value+'">'+this.title+"</li>").appendTo(e.$searchResults.find("ul"))});else if(!1===e.allowAdditions||!1===dataSettings.allowadditions){var a=e.noResultsText||dataSettings.noresultstext;$("<li>"+a+"</li>").appendTo(e.$searchResults.find("ul"))}else $('<li>Add "'+e.$searchbox.val()+'"</li>').appendTo(e.$searchResults.find("ul"));e.$results=e.$list.find("li"),e.$results.on({click:function(){var t=$(this),s=t.data("value"),n=t.text(),a=e.$searchbox.val();if(""===s||void 0===s?($('<option value="'+a+'" selected></option>').appendTo(e.$select),e.$searchbox.val(a)):(null!=e.$select.val()&&isMultiple?e.$select.val().push(s):e.$select.val(s),e.$searchbox.val(n)),isMultiple){var l=null!=e.$select.val()?e.$select.val():[],i=""===s||void 0===s?a:n;e.$searchbox.val(""),e.$searchbox.parent().append('<span class="option-tag">'+i+' <span class="remove-tag" data-option-value="'+i+'"></span></span>'),void 0!=s&&l.push(s.toString()),$.each(l,function(t,s){e.$select.children('option[value="'+s+'"]').prop("selected",!0)}),e.tagClick()}"function"==typeof e.onChange&&e.onChange.call(e.$select[0],{title:o,value:s}),e.close()}}),e.open()},notInViewport:function(e){var t=this,s={min:e,max:e+(window.innerHeight||document.documentElement.clientHeight)},n=t.$searchResults.offset().top+t.maxHeight;return n>=s.min&&n<=s.max?0:n-s.max+5},destroy:function(){var e=this;e.unbindHandlers(),e.$select.unwrap().siblings().remove(),e.$select.unwrap(),delete Object.getPrototypeOf(e).instances[e.$select[0].id]}};var t=function(t,n){t.id=t.id?t.id:"AutocompleteDropdown"+s();var o=new e;o.instances[t.id]||(o.instances[t.id]=o,o.init(t,n))},s=function(){return("00000"+(16777216*Math.random()<0).toString(16)).substr(-6).toUpperCase()};$.fn.autocompleteDropdown=function(){var s=arguments,n=[],o;return o=this.each(function(){if(s&&"string"==typeof s[0]){var o=e.prototype.instances[this.id][s[0]](s[1],s[2]);o&&n.push(o)}else t(this,s[0])}),n.length?n.length>1?n:n[0]:o},$(function(){"function"!=typeof Object.getPrototypeOf&&("object"==typeof"test".prototype?Object.getPrototypeOf=function(e){return e.prototype}:Object.getPrototypeOf=function(e){return e.constructor.prototype}),$("select.autocomplete").each(function(){var e=$(this).attr("data-settings"),s=e?$.parseJSON(e):{};t(this,s)})})}(jQuery);