!function(){var t=function(){"use strict";function t(){}var o=tinymce.util.Tools.resolve("tinymce.PluginManager"),e=function(t,o){var e;return t.dom.getParents(t.selection.getStart(),function(t){var r;(r=t.style["forecolor"===o?"color":"background-color"])&&(e=r)}),e},r=function(t){var o,e=[];for(o=0;o<t.length;o+=2)e.push({text:t[o+1],color:"#"+t[o]});return e},n=function(t,o,e){t.undoManager.transact(function(){t.focus(),t.formatter.apply(o,{value:e}),t.nodeChanged()})},l=function(t,o){t.undoManager.transact(function(){t.focus(),t.formatter.remove(o,{value:null},null,!0),t.nodeChanged()})},a={getCurrentColor:e,mapColors:r,applyFormat:n,removeFormat:l},c=function(t){t.addCommand("mceApplyTextcolor",function(o,e){a.applyFormat(t,o,e)}),t.addCommand("mceRemoveTextcolor",function(o){a.removeFormat(t,o)})},i={register:c},u=tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),s=tinymce.util.Tools.resolve("tinymce.util.Tools"),m=["000000","Black","993300","Burnt orange","333300","Dark olive","003300","Dark green","003366","Dark azure","000080","Navy Blue","333399","Indigo","333333","Very dark gray","800000","Maroon","FF6600","Orange","808000","Olive","008000","Green","008080","Teal","0000FF","Blue","666699","Grayish blue","808080","Gray","FF0000","Red","FF9900","Amber","99CC00","Yellow green","339966","Sea green","33CCCC","Turquoise","3366FF","Royal blue","800080","Purple","999999","Medium gray","FF00FF","Magenta","FFCC00","Gold","FFFF00","Yellow","00FF00","Lime","00FFFF","Aqua","00CCFF","Sky blue","993366","Red violet","FFFFFF","White","FF99CC","Pink","FFCC99","Peach","FFFF99","Light yellow","CCFFCC","Pale green","CCFFFF","Pale cyan","99CCFF","Light sky blue","CC99FF","Plum"],g=function(t){return t.getParam("textcolor_map",m)},d=function(t){return t.getParam("forecolor_map",g(t))},f=function(t){return t.getParam("backcolor_map",g(t))},C=function(t){return t.getParam("textcolor_rows",5)},F=function(t){return t.getParam("textcolor_cols",8)},b=function(t){return t.getParam("forecolor_rows",C(t))},p=function(t){return t.getParam("backcolor_rows",C(t))},y=function(t){return t.getParam("forecolor_cols",F(t))},k=function(t){return t.getParam("backcolor_cols",F(t))},v=function(t){return t.getParam("color_picker_callback",null)},h=function(t){return"function"==typeof v(t)},P={getForeColorMap:d,getBackColorMap:f,getForeColorRows:b,getBackColorRows:p,getForeColorCols:y,getBackColorCols:k,getColorPickerCallback:v,hasColorPicker:h},x=tinymce.util.Tools.resolve("tinymce.util.I18n"),B=function(t,o,e,r){var n,l,c,i,s,m,g,d=0,f=u.DOM.uniqueId("mcearia"),C=function(t,o){var e="transparent"===t;return'<td class="mce-grid-cell'+(e?" mce-colorbtn-trans":"")+'"><div id="'+f+"-"+d+++'" data-mce-color="'+(t||"")+'" role="option" tabIndex="-1" style="'+(t?"background-color: "+t:"")+'" title="'+x.translate(o)+'">'+(e?"&#215;":"")+"</div></td>"};for(n=a.mapColors(e),n.push({text:x.translate("No color"),color:"transparent"}),c='<table class="mce-grid mce-grid-border mce-colorbutton-grid" role="list" cellspacing="0"><tbody>',i=n.length-1,m=0;m<o;m++){for(c+="<tr>",s=0;s<t;s++)g=m*t+s,g>i?c+="<td></td>":(l=n[g],c+=C(l.color,l.text));c+="</tr>"}if(r){for(c+='<tr><td colspan="'+t+'" class="mce-custom-color-btn"><div id="'+f+'-c" class="mce-widget mce-btn mce-btn-small mce-btn-flat" role="button" tabindex="-1" aria-labelledby="'+f+'-c" style="width: 100%"><button type="button" role="presentation" tabindex="-1">'+x.translate("Custom...")+"</button></div></td></tr>",c+="<tr>",s=0;s<t;s++)c+=C("","Custom color");c+="</tr>"}return c+="</tbody></table>"},T={getHtml:B},w=function t(o,e){o.style.background=e,o.setAttribute("data-mce-color",e)},M=function(t){return function(o){var e=o.control;e._color?t.execCommand("mceApplyTextcolor",e.settings.format,e._color):t.execCommand("mceRemoveTextcolor",e.settings.format)}},_=function(t,o){return function(e){var r=this.parent(),n,l=a.getCurrentColor(t,r.settings.format),c=function(o){r.hidePanel(),r.color(o),t.execCommand("mceApplyTextcolor",r.settings.format,o)},i=function(){r.hidePanel(),r.resetColor(),t.execCommand("mceRemoveTextcolor",r.settings.format)};if(u.DOM.getParent(e.target,".mce-custom-color-btn")){r.hidePanel();P.getColorPickerCallback(t).call(t,function(t){var e=r.panel.getEl().getElementsByTagName("table")[0],n,l,a;for(n=s.map(e.rows[e.rows.length-1].childNodes,function(t){return t.firstChild}),a=0;a<n.length&&(l=n[a],l.getAttribute("data-mce-color"));a++);if(a===o)for(a=0;a<o-1;a++)w(n[a],n[a+1].getAttribute("data-mce-color"));w(l,t),c(t)},l)}n=e.target.getAttribute("data-mce-color"),n?(this.lastId&&u.DOM.get(this.lastId).setAttribute("aria-selected","false"),e.target.setAttribute("aria-selected",!0),this.lastId=e.target.id,"transparent"===n?i():c(n)):null!==n&&r.hidePanel()}},R=function(t,o){return function(){var e=o?P.getForeColorCols(t):P.getBackColorCols(t),r=o?P.getForeColorRows(t):P.getBackColorRows(t),n=o?P.getForeColorMap(t):P.getBackColorMap(t),l=P.hasColorPicker(t);return T.getHtml(e,r,n,l)}},A=function(t){t.addButton("forecolor",{type:"colorbutton",tooltip:"Text color",format:"forecolor",panel:{role:"application",ariaRemember:!0,html:R(t,!0),onclick:_(t,P.getForeColorCols(t))},onclick:M(t)}),t.addButton("backcolor",{type:"colorbutton",tooltip:"Background color",format:"hilitecolor",panel:{role:"application",ariaRemember:!0,html:R(t,!1),onclick:_(t,P.getBackColorCols(t))},onclick:M(t)})},D={register:A};return o.add("textcolor",function(t){i.register(t),D.register(t)}),t}()}();