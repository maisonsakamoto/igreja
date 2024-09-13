/*
jQWidgets v3.4.0 (2014-June-23)
Copyright (c) 2011-2014 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(b){var a=0;b.jqx.jqxWidget("jqxScrollView","",{});b.extend(b.jqx._jqxScrollView.prototype,{defineInstance:function(){this.width=320;this.height=320;this.buttonsOffset=[0,0];this.moveThreshold=0.5;this.currentPage=0;this.animationDuration=300;this.showButtons=true;this.bounceEnabled=true;this.slideShow=false;this.slideDuration=3000;this.disabled=false;this._mouseDown=false;this._movePermited=false;this._startX=-1;this._startOffset=-1;this._lastOffset=-1;this._events=["pageChanged"];this._eventsMap={mousedown:b.jqx.mobile.getTouchEventName("touchstart"),mouseup:b.jqx.mobile.getTouchEventName("touchend"),mousemove:b.jqx.mobile.getTouchEventName("touchmove")}},createInstance:function(){a+=1;this._instanceId=a;this._isTouchDevice=b.jqx.mobile.isTouchDevice();var c=this;b.jqx.utilities.resize(this.host,function(){c.refresh()})},resize:function(d,c){this.width=d;this.height=c;this.refresh()},refresh:function(){this.host.width(this.width);this.host.height(this.height);this._render();this._performLayout();if(this.moveThreshold.toString().indexOf("%")>=0){this.moveThreshold=parseInt(this.moveThreshold,10)/100}this._refreshPages();this._refreshButtons();this._removeEventListeners();this._addEventListeners();this._changePage(this.currentPage,false,0);if(this.slideShow){var c=this;this.slideShowTimer=setInterval(function(){if(c.currentPage>=c._pages.length-1){c._changePage(0,true,c.animationDuration)}else{c._changePage(c.currentPage+1,true,c.animationDuration)}},this.slideDuration)}else{if(this.slideShowTimer!=undefined){clearInterval(this.slideShowTimer)}}},destroy:function(){this.host.remove()},_getEvent:function(c){if(this._isTouchDevice){return this._eventsMap[c]}return c},_eventNamespace:function(){return".scrollview"+this._instanceId},_removeEventListeners:function(){this.removeHandler(this._innerWrapper);this.removeHandler(this.host,this._getEvent("mousemove")+this._eventNamespace());this.removeHandler(b(document),this._getEvent("mouseup")+this._eventNamespace())},_getCoordinate:function(c,d){if(this._isTouchDevice){var e=b.jqx.position(c);if(d=="pageX"){return e.left}if(d=="pageY"){return e.top}if(c.originalEvent.touches){return c.originalEvent.touches[0][d]}}return c[d]},_draggedRight:function(){if(this.currentPage>0){var e=this.currentPage-1,d=b(this._pages[e]),c=d.offset().left+d.outerWidth(),f=c-this.host.offset().left;if(f>=(this.host.width()*this.moveThreshold)){this.changePage(e);return true}}return false},_draggedLeft:function(){if(this.currentPage+1<this._pages.length){var d=this.currentPage+1,c=b(this._pages[d]),e=this.host.width()-(c.offset().left-this.host.offset().left);if(e>=(this.host.width()*this.moveThreshold)){this.changePage(d);return true}}return false},_dropTarget:function(){var c;if(this._movedLeft){c=this._draggedLeft()}else{c=this._draggedRight()}if(!c){this.changePage(this.currentPage,false)}},_scrollEnabled:function(c){if(!this._mouseDown){return false}if(!this._movePermited){if(Math.abs(this._getCoordinate(c,"pageX")-this._startX)>=15){this._movePermited=true}}return this._movePermited},_setMoveDirection:function(c){if(this._lastOffset>c){this._movedLeft=true}else{this._movedLeft=false}},_getBounceOffset:function(d){var c=-(this._innerWrapper.width()-this.host.width());if(d>0){d=0}else{if(d<c){d=c}}return d},_addEventListeners:function(){var c=this;this.addHandler(this._innerWrapper,this._getEvent("mousedown")+this._eventNamespace(),function(f){c._mouseDown=true;c._startX=c._getCoordinate(f,"pageX");c._startOffset=c._lastOffset=parseInt(c._innerWrapper.css("margin-left"),10)});this.addHandler(this.host,"dragstart",function(){return false});this.addHandler(this.host,this._getEvent("mousemove")+this._eventNamespace(),function(f){if(c._scrollEnabled(f)){var g=c._startOffset+c._getCoordinate(f,"pageX")-c._startX;if(!c.bounceEnabled){g=c._getBounceOffset(g)}c._innerWrapper.css("margin-left",g);c._setMoveDirection(g);c._lastOffset=g;f.preventDefault();return false}return true});this.addHandler(b(document),this._getEvent("mouseup")+this._eventNamespace(),function(f){if(c._movePermited){c._dropTarget()}c._movePermited=false;c._mouseDown=false});try{if(document.referrer!=""||window.frameElement){if(window.top!=null){if(window.parent&&document.referrer){parentLocation=document.referrer}}if(parentLocation.indexOf(document.location.host)!=-1){var e=function(f){if(c._movePermited){c._dropTarget()}c._movePermited=false;c._mouseDown=false};if(window.top.document.addEventListener){window.top.document.addEventListener("mouseup",e,false)}else{if(window.top.document.attachEvent){window.top.document.attachEvent("onmouseup",e)}}}}}catch(d){}},_render:function(){this.host.addClass(this.toThemeProperty("jqx-scrollview"));this.host.css({overflow:"hidden",position:"relative"})},_performLayout:function(){this.host.css({width:this.width,height:this.height})},_renderPages:function(){if(!this._innerWrapper){this._innerWrapper=b("<div/>");this.host.wrapInner(this._innerWrapper);this._innerWrapper=this.host.children().first()}this._innerWrapper.addClass(this.toThemeProperty("jqx-scrollview-inner-wrapper"));this._innerWrapper.height(this.host.height())},_refreshPage:function(c){c.addClass(this.toThemeProperty("jqx-scrollview-page"));this._performPageLayout(c)},_refreshPages:function(){var c=this,d=0;this._renderPages();this._pages=this._innerWrapper.children();this._pages.each(function(){c._refreshPage(b(this));d+=b(this).outerWidth(true)});this._innerWrapper.width(d)},_performPageLayout:function(c){c.css("float","left");c.width(this.host.width());c.height(this.host.height())},_refreshButtons:function(){this._renderButtons();this._removeButtonsEventListeners();this._addButtonsEventListeners();this._performButtonsLayout()},_removeButtonsEventListeners:function(){var c=this;this._buttonsContainer.children().each(function(){c.removeHandler(b(this))})},_addButtonsEventListeners:function(){var c=this;this._buttonsContainer.children().each(function(d){c.addHandler(b(this),"click",function(){c.changePage(d)})})},_performButtonsLayout:function(){var d=(this.host.width()-this._buttonsContainer.width())/2;var c=this._buttonsContainer.outerHeight()!=0?this._buttonsContainer.outerHeight():14;this._buttonsContainer.css({position:"absolute",left:d+parseInt(this.buttonsOffset[0],10),top:this.host.height()-2*c+parseInt(this.buttonsOffset[1],10)-1})},_renderButtons:function(){if(this._buttonsContainer){this._buttonsContainer.remove()}var e,d;this._buttons=[];this._buttonsContainer=b("<span/>");for(var c=0;c<this._pages.length;c+=1){d=b('<span class="'+this.toThemeProperty("jqx-scrollview-button")+" "+this.toThemeProperty("jqx-fill-state-normal")+'"></span>');this._buttonsContainer.append(d);this._buttons[c]=d}this._buttonsContainer.appendTo(this.host);if(!this.showButtons){this._buttonsContainer.hide()}},_raiseEvent:function(c,e){var d=new b.Event(this._events[c]);d.args=e;return this.host.trigger(d)},_swapButtons:function(c,d){this._buttons[c].removeClass(this.toThemeProperty("jqx-scrollview-button-selected"));this._buttons[c].removeClass(this.toThemeProperty("jqx-fill-state-pressed"));this._buttons[d].addClass(this.toThemeProperty("jqx-scrollview-button-selected"));this._buttons[d].addClass(this.toThemeProperty("jqx-fill-state-pressed"))},_changePage:function(d,f,i){if(this.disabled){return}var h=b(this._pages[d]),g=(this.host.width()-h.width())/2,e=h.offset().left-this._innerWrapper.offset().left-g,j=this.currentPage,c=this;if(typeof i==="undefined"){i=this.animationDuration}this._innerWrapper.stop();this._swapButtons(this.currentPage,d);this.currentPage=d;this._innerWrapper.animate({marginLeft:-e},i,function(){if(f){c._raiseEvent(0,{currentPage:d,oldPage:j})}})},propertyChangedHandler:function(c,d,f,e){if(d==="currentPage"){c.currentPage=f;c.changePage(e)}else{if((/(buttonsOffset|width|height)/).test(d)){c.refresh()}else{if(d==="showButtons"){if(!e){c._buttonsContainer.css("display","none")}else{c._buttonsContainer.css("display","block")}return}else{if(d=="slideShow"){c.refresh()}}}}},changePage:function(c){if(c>=this._pages.length||c<0){throw new Error("Invalid index!")}this._changePage(c,true)},forward:function(){if(this.currentPage+1<this._pages.length){this.changePage(this.currentPage+1)}},back:function(){if(this.currentPage-1>=0){this.changePage(this.currentPage-1)}}})}(jQuery));