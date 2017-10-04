wp.textWidgets=function(t){"use strict";var e={dismissedPointers:[]};return e.TextWidgetControl=Backbone.View.extend({events:{},initialize:function(e){var i=this;if(!e.el)throw new Error("Missing options.el");if(!e.syncContainer)throw new Error("Missing options.syncContainer");Backbone.View.prototype.initialize.call(i,e),i.syncContainer=e.syncContainer,i.$el.addClass("text-widget-fields"),i.$el.html(wp.template("widget-text-control-fields")),i.customHtmlWidgetPointer=i.$el.find(".wp-pointer.custom-html-widget-pointer"),i.customHtmlWidgetPointer.length&&(i.customHtmlWidgetPointer.find(".close").on("click",function(e){e.preventDefault(),i.customHtmlWidgetPointer.hide(),t("#"+i.fields.text.attr("id")+"-html").focus(),i.dismissPointers(["text_widget_custom_html"])}),i.customHtmlWidgetPointer.find(".add-widget").on("click",function(t){t.preventDefault(),i.customHtmlWidgetPointer.hide(),i.openAvailableWidgetsPanel()})),i.pasteHtmlPointer=i.$el.find(".wp-pointer.paste-html-pointer"),i.pasteHtmlPointer.length&&i.pasteHtmlPointer.find(".close").on("click",function(t){t.preventDefault(),i.pasteHtmlPointer.hide(),i.editor.focus(),i.dismissPointers(["text_widget_custom_html","text_widget_paste_html"])}),i.fields={title:i.$el.find(".title"),text:i.$el.find(".text")},_.each(i.fields,function(t,e){t.on("input change",function(){var n=i.syncContainer.find(".sync-input."+e);n.val()!==t.val()&&(n.val(t.val()),n.trigger("change"))}),t.val(i.syncContainer.find(".sync-input."+e).val())})},dismissPointers:function(t){_.each(t,function(t){wp.ajax.post("dismiss-wp-pointer",{pointer:t}),e.dismissedPointers.push(t)})},openAvailableWidgetsPanel:function(){var t;wp.customize.section.each(function(e){e.extended(wp.customize.Widgets.SidebarSection)&&e.expanded()&&(t=wp.customize.control("sidebars_widgets["+e.params.sidebarId+"]"))}),t&&setTimeout(function(){wp.customize.Widgets.availableWidgetsPanel.open(t),wp.customize.Widgets.availableWidgetsPanel.$search.val("HTML").trigger("keyup")})},updateFields:function(){var t,e=this;e.fields.title.is(document.activeElement)||(t=e.syncContainer.find(".sync-input.title"),e.fields.title.val(t.val())),t=e.syncContainer.find(".sync-input.text"),e.fields.text.is(":visible")?e.fields.text.is(document.activeElement)||e.fields.text.val(t.val()):e.editor&&!e.editorFocused&&t.val()!==e.fields.text.val()&&e.editor.setContent(wp.editor.autop(t.val()))},initializeEditor:function(){function i(){var o,r,u;if(document.getElementById(n)){if(void 0===window.tinymce)return void wp.editor.initialize(n,{quicktags:!0});if(tinymce.get(n)&&(l=tinymce.get(n).isHidden(),wp.editor.remove(n)),wp.editor.initialize(n,{tinymce:{wpautop:!0},quicktags:!0}),u=function(e){e.show(),e.find(".close").focus(),wp.a11y.speak(e.find("h3, p").map(function(){return t(this).text()}).get().join("\n\n"))},!(o=window.tinymce.get(n)))throw new Error("Failed to initialize editor");r=function(){t(o.getWin()).on("unload",function(){_.defer(i)}),l&&switchEditors.go(n,"html"),t("#"+n+"-html").on("click",function(){s.pasteHtmlPointer.hide(),-1===e.dismissedPointers.indexOf("text_widget_custom_html")&&u(s.customHtmlWidgetPointer)}),t("#"+n+"-tmce").on("click",function(){s.customHtmlWidgetPointer.hide()}),o.on("pastepreprocess",function(t){var i=t.content;-1===e.dismissedPointers.indexOf("text_widget_paste_html")&&i&&/&lt;\w+.*?&gt;/.test(i)&&_.delay(function(){u(s.pasteHtmlPointer)},250)})},o.initialized?r():o.on("init",r),s.editorFocused=!1,o.on("focus",function(){s.editorFocused=!0}),o.on("paste",function(){o.setDirty(!0),d()}),o.on("NodeChange",function(){c=!0}),o.on("NodeChange",_.debounce(d,a)),o.on("blur hide",function(){s.editorFocused=!1,d()}),s.editor=o}}var n,o,d,s=this,a=1e3,l=!1,c=!1;o=s.fields.text,n=o.attr("id"),d=function(){s.editor.isDirty()&&(wp.customize&&wp.customize.state&&(wp.customize.state("processing").set(wp.customize.state("processing").get()+1),_.delay(function(){wp.customize.state("processing").set(wp.customize.state("processing").get()-1)},300)),s.editor.isHidden()||s.editor.save()),c&&(o.trigger("change"),c=!1)},s.syncContainer.closest(".widget").find("[name=savewidget]:first").on("click",function(){d()}),i()}}),e.widgetControls={},e.handleWidgetAdded=function(i,n){var o,d,s,a,l,c,r,u;o=n.find("> .widget-inside > .form, > .widget-inside > form"),"text"===(d=o.find("> .id_base").val())&&(a=o.find(".widget-id").val(),e.widgetControls[a]||o.find(".visual").val()&&(r=t("<div></div>"),u=n.find(".widget-content:first"),u.before(r),s=new e.TextWidgetControl({el:r,syncContainer:u}),e.widgetControls[a]=s,l=n.parent(),(c=function(){l.is(":animated")?setTimeout(c,50):s.initializeEditor()})()))},e.setupAccessibleMode=function(){var i,n,o,d,s;i=t(".editwidget > form"),0!==i.length&&"text"===(n=i.find("> .widget-control-actions > .id_base").val())&&i.find(".visual").val()&&(d=t("<div></div>"),s=i.find("> .widget-inside"),s.before(d),o=new e.TextWidgetControl({el:d,syncContainer:s}),o.initializeEditor())},e.handleWidgetUpdated=function(t,i){var n,o,d,s;n=i.find("> .widget-inside > .form, > .widget-inside > form"),"text"===(s=n.find("> .id_base").val())&&(o=n.find("> .widget-id").val(),(d=e.widgetControls[o])&&d.updateFields())},e.init=function(){var i=t(document);i.on("widget-added",e.handleWidgetAdded),i.on("widget-synced widget-updated",e.handleWidgetUpdated),t(function(){var i;"widgets"===window.pagenow&&(i=t(".widgets-holder-wrap:not(#available-widgets)").find("div.widget"),i.one("click.toggle-widget-expanded",function(){var i=t(this);e.handleWidgetAdded(new jQuery.Event("widget-added"),i)}),t(window).on("load",function(){e.setupAccessibleMode()}))})},e}(jQuery);