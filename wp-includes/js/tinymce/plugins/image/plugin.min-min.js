!function(){"use strict";function e(){return new(s.getOrDie("FileReader"))}function t(){return new(s.getOrDie("XMLHttpRequest"))}function n(e){var n=function(n,r,a,i){var o,l;(o=new t).open("POST",e.url),o.withCredentials=e.credentials,o.upload.onprogress=function(e){i(e.loaded/e.total*100)},o.onerror=function(){a("Image upload failed due to a XHR Transport error. Code: "+o.status)},o.onload=function(){var t;o.status<200||300<=o.status?a("HTTP Error: "+o.status):(t=JSON.parse(o.responseText))&&"string"==typeof t.location?r(de(e.basePath,t.location)):a("Invalid JSON: "+o.responseText)},(l=new FormData).append("file",n.blob(),n.filename()),o.send(l)};return e=d.extend({credentials:!1,handler:n},e),{upload:function(t){return e.url||e.handler!==n?(r=t,a=e.handler,new c(function(e,t){try{a(r,e,t,ce)}catch(e){t(e.message)}})):c.reject("Upload url missing from the settings.");var r,a}}}function r(e){function t(t){var n,r,a=X(e);if(t&&(r={type:"listbox",label:"Image list",name:"image-list",values:m.buildListItems(t,function(t){t.value=e.convertURL(t.value||t.url,"src")},[{text:"None",value:""}]),value:a.src&&e.convertURL(a.src,"src"),onselect:function(e){var t=n.find("#alt");(!t.value()||e.lastControl&&t.value()===e.lastControl.text())&&t.value(e.control.text()),n.find("#src").value(e.control.value()).fire("change")},onPostRender:function(){r=this}}),i.hasAdvTab(e)||i.hasUploadUrl(e)||i.hasUploadHandler(e)){var o=[ie.makeTab(e,r)];i.hasAdvTab(e)&&o.push(Q.makeTab(e)),(i.hasUploadUrl(e)||i.hasUploadHandler(e))&&o.push(me.makeTab(e)),n=e.windowManager.open({title:"Insert/edit image",data:a,bodyType:"tabpanel",body:o,onSubmit:he.curry(ve,e)})}else n=e.windowManager.open({title:"Insert/edit image",data:a,body:ie.getGeneralItems(e,r),onSubmit:he.curry(ve,e)});ne.syncSize(n)}return{open:function(){m.createImageList(e,t)}}}var a=tinymce.util.Tools.resolve("tinymce.PluginManager"),i={hasDimensions:function(e){return!1!==e.settings.image_dimensions},hasAdvTab:function(e){return!0===e.settings.image_advtab},getPrependUrl:function(e){return e.getParam("image_prepend_url","")},getClassList:function(e){return e.getParam("image_class_list")},hasDescription:function(e){return!1!==e.settings.image_description},hasImageTitle:function(e){return!0===e.settings.image_title},hasImageCaption:function(e){return!0===e.settings.image_caption},getImageList:function(e){return e.getParam("image_list",!1)},hasUploadUrl:function(e){return e.getParam("images_upload_url",!1)},hasUploadHandler:function(e){return e.getParam("images_upload_handler",!1)},getUploadUrl:function(e){return e.getParam("images_upload_url")},getUploadHandler:function(e){return e.getParam("images_upload_handler")},getUploadBasePath:function(e){return e.getParam("images_upload_base_path")},getUploadCredentials:function(e){return e.getParam("images_upload_credentials")}},o="undefined"!=typeof window?window:Function("return this;")(),l=function(e,t){for(var n=void 0!==t&&null!==t?t:o,r=0;r<e.length&&void 0!==n&&null!==n;++r)n=n[e[r]];return n},u=function(e,t){var n=e.split(".");return l(n,t)},s={getOrDie:function(e,t){var n=u(e,t);if(void 0===n||null===n)throw e+" not available on this browser";return n}},c=tinymce.util.Tools.resolve("tinymce.util.Promise"),d=tinymce.util.Tools.resolve("tinymce.util.Tools"),f=tinymce.util.Tools.resolve("tinymce.util.XHR"),g=function(e,t){return Math.max(parseInt(e,10),parseInt(t,10))},m={getImageSize:function(e,t){function n(e,n){r.parentNode&&r.parentNode.removeChild(r),t({width:e,height:n})}var r=document.createElement("img");r.onload=function(){n(g(r.width,r.clientWidth),g(r.height,r.clientHeight))},r.onerror=function(){n(0,0)};var a=r.style;a.visibility="hidden",a.position="fixed",a.bottom=a.left="0px",a.width=a.height="auto",document.body.appendChild(r),r.src=e},buildListItems:function(e,t,n){return function e(n,r){return r=r||[],d.each(n,function(n){var a={text:n.text||n.title};n.menu?a.menu=e(n.menu):(a.value=n.value,t(a)),r.push(a)}),r}(e,n||[])},removePixelSuffix:function(e){return e&&(e=e.replace(/px$/,"")),e},addPixelSuffix:function(e){return 0<e.length&&/^[0-9]+$/.test(e)&&(e+="px"),e},mergeMargins:function(e){if(e.margin){var t=e.margin.split(" ");switch(t.length){case 1:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[0],e["margin-bottom"]=e["margin-bottom"]||t[0],e["margin-left"]=e["margin-left"]||t[0];break;case 2:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[0],e["margin-left"]=e["margin-left"]||t[1];break;case 3:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[2],e["margin-left"]=e["margin-left"]||t[1];break;case 4:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[2],e["margin-left"]=e["margin-left"]||t[3]}delete e.margin}return e},createImageList:function(e,t){var n=i.getImageList(e);"string"==typeof n?f.send({url:n,success:function(e){t(JSON.parse(e))}}):"function"==typeof n?n(t):t(n)},waitLoadImage:function(e,t,n){function r(){n.onload=n.onerror=null,e.selection&&(e.selection.select(n),e.nodeChanged())}n.onload=function(){t.width||t.height||!i.hasDimensions(e)||e.dom.setAttribs(n,{width:n.clientWidth,height:n.clientHeight}),r()},n.onerror=r},blobToDataUri:function(t){return new c(function(n,r){var a=new e;a.onload=function(){n(a.result)},a.onerror=function(){r(e.error.message)},a.readAsDataURL(t)})}},p=tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),h=function(e){return function(t){return function(e){if(null===e)return"null";var t=typeof e;return"object"===t&&Array.prototype.isPrototypeOf(e)?"array":"object"===t&&String.prototype.isPrototypeOf(e)?"string":t}(t)===e}},v={isString:h("string"),isObject:h("object"),isArray:h("array"),isNull:h("null"),isBoolean:h("boolean"),isUndefined:h("undefined"),isFunction:h("function"),isNumber:h("number")},b=function(e){return function(){for(var t=new Array(arguments.length),n=0;n<t.length;n++)t[n]=arguments[n];if(0===t.length)throw new Error("Can't merge zero objects");for(var r={},a=0;a<t.length;a++){var i=t[a];for(var o in i)i.hasOwnProperty(o)&&(r[o]=e(r[o],i[o]))}return r}},y=b(function(e,t){return v.isObject(e)&&v.isObject(t)?y(e,t):t}),x=b(function(e,t){return t}),w={deepMerge:y,merge:x},S=p.DOM,U=function(e){return e.style.marginLeft&&e.style.marginRight&&e.style.marginLeft===e.style.marginRight?m.removePixelSuffix(e.style.marginLeft):""},C=function(e){return e.style.marginTop&&e.style.marginBottom&&e.style.marginTop===e.style.marginBottom?m.removePixelSuffix(e.style.marginTop):""},T=function(e){return e.style.borderWidth?m.removePixelSuffix(e.style.borderWidth):""},P=function(e,t){return e.hasAttribute(t)?e.getAttribute(t):""},I=function(e,t){return e.style[t]?e.style[t]:""},N=function(e){return null!==e.parentNode&&"FIGURE"===e.parentNode.nodeName},A=function(e,t,n){e.setAttribute(t,n)},L=function(e){var t,n,r,a;N(e)?(a=(r=e).parentNode,S.insertAfter(r,a),S.remove(a)):(t=e,n=S.create("figure",{class:"image"}),S.insertAfter(n,t),n.appendChild(t),n.appendChild(S.create("figcaption",{contentEditable:!0},"Caption")),n.contentEditable="false")},_=function(e,t){var n=e.getAttribute("style"),r=t(null!==n?n:"");0<r.length?(e.setAttribute("style",r),e.setAttribute("data-mce-style",r)):e.removeAttribute("style")},O=function(e,t){return function(e,n,r){e.style[n]?(e.style[n]=m.addPixelSuffix(r),_(e,t)):A(e,n,r)}},R=function(e,t){return e.style[t]?m.removePixelSuffix(e.style[t]):P(e,t)},D=function(e,t){var n=m.addPixelSuffix(t);e.style.marginLeft=n,e.style.marginRight=n},k=function(e,t){var n=m.addPixelSuffix(t);e.style.marginTop=n,e.style.marginBottom=n},z=function(e,t){var n=m.addPixelSuffix(t);e.style.borderWidth=n},M=function(e,t){e.style.borderStyle=t},E=function(e){return"FIGURE"===e.nodeName},H=function(e,t){var n=document.createElement("img");return A(n,"style",t.style),(U(n)||""!==t.hspace)&&D(n,t.hspace),(C(n)||""!==t.vspace)&&k(n,t.vspace),(T(n)||""!==t.border)&&z(n,t.border),(I(n,"borderStyle")||""!==t.borderStyle)&&M(n,t.borderStyle),e(n.getAttribute("style"))},j=function(e,t){return{src:P(t,"src"),alt:P(t,"alt"),title:P(t,"title"),width:R(t,"width"),height:R(t,"height"),class:P(t,"class"),style:e(P(t,"style")),caption:N(t),hspace:U(t),vspace:C(t),border:T(t),borderStyle:I(t,"borderStyle")}},B=function(e,t,n,r,a){n[r]!==t[r]&&a(e,r,n[r])},F=function(e,t){return function(n,r,a){e(n,a),_(n,t)}},W=function(e,t,n){var r=j(e,n);B(n,r,t,"caption",function(e,t,n){return L(e)}),B(n,r,t,"src",A),B(n,r,t,"alt",A),B(n,r,t,"title",A),B(n,r,t,"width",O(0,e)),B(n,r,t,"height",O(0,e)),B(n,r,t,"class",A),B(n,r,t,"style",F(function(e,t){return A(e,"style",t)},e)),B(n,r,t,"hspace",F(D,e)),B(n,r,t,"vspace",F(k,e)),B(n,r,t,"border",F(z,e)),B(n,r,t,"borderStyle",F(M,e))},G=function(e,t){var n=e.dom.styles.parse(t),r=m.mergeMargins(n),a=e.dom.styles.parse(e.dom.styles.serialize(r));return e.dom.styles.serialize(a)},J=function(e){var t=e.selection.getNode(),n=e.dom.getParent(t,"figure.image");return n?e.dom.select("img",n)[0]:t&&("IMG"!==t.nodeName||t.getAttribute("data-mce-object")||t.getAttribute("data-mce-placeholder"))?null:t},V=function(e,t){var n=e.dom,r=n.getParent(t.parentNode,function(t){return e.schema.getTextBlockElements()[t.nodeName]});return r?n.split(r,t):t},X=function(e){var t=J(e);return t?j(function(t){return G(e,t)},t):{src:"",alt:"",title:"",width:"",height:"",class:"",style:"",caption:!1,hspace:"",vspace:"",border:"",borderStyle:""}},q=function(e,t){var n=function(e,t){var n=document.createElement("img");if(W(e,w.merge(t,{caption:!1}),n),A(n,"alt",t.alt),t.caption){var r=S.create("figure",{class:"image"});return r.appendChild(n),r.appendChild(S.create("figcaption",{contentEditable:!0},"Caption")),r.contentEditable="false",r}return n}(function(t){return G(e,t)},t);e.dom.setAttrib(n,"data-mce-id","__mcenew"),e.focus(),e.selection.setContent(n.outerHTML);var r=e.dom.select('*[data-mce-id="__mcenew"]')[0];if(e.dom.setAttrib(r,"data-mce-id",null),E(r)){var a=V(e,r);e.selection.select(a)}else e.selection.select(r)},K=function(e,t){var n=J(e);n?t.src?function(e,t){var n,r=J(e);if(W(function(t){return G(e,t)},t,r),n=r,e.dom.setAttrib(n,"src",n.getAttribute("src")),E(r.parentNode)){var a=r.parentNode;V(e,a),e.selection.select(r.parentNode)}else e.selection.select(r),m.waitLoadImage(e,t,r)}(e,t):function(e,t){if(t){var n=e.dom.is(t.parentNode,"figure.image")?t.parentNode:t;e.dom.remove(n),e.focus(),e.nodeChanged(),e.dom.isEmpty(e.getBody())&&(e.setContent(""),e.selection.setCursorLocation())}}(e,n):t.src&&q(e,t)},$=function(e,t){t.find("#style").each(function(n){var r=H(function(t){return G(e,t)},w.merge({src:"",alt:"",title:"",width:"",height:"",class:"",style:"",caption:!1,hspace:"",vspace:"",border:"",borderStyle:""},t.toJSON()));n.value(r)})},Q={makeTab:function(e){return{title:"Advanced",type:"form",pack:"start",items:[{label:"Style",name:"style",type:"textbox",onchange:(t=e,function(e){var n=t.dom,r=e.control.rootControl;if(i.hasAdvTab(t)){var a=r.toJSON(),o=n.parseStyle(a.style);r.find("#vspace").value(""),r.find("#hspace").value(""),((o=m.mergeMargins(o))["margin-top"]&&o["margin-bottom"]||o["margin-right"]&&o["margin-left"])&&(o["margin-top"]===o["margin-bottom"]?r.find("#vspace").value(m.removePixelSuffix(o["margin-top"])):r.find("#vspace").value(""),o["margin-right"]===o["margin-left"]?r.find("#hspace").value(m.removePixelSuffix(o["margin-right"])):r.find("#hspace").value("")),o["border-width"]?r.find("#border").value(m.removePixelSuffix(o["border-width"])):r.find("#border").value(""),o["border-style"]?r.find("#borderStyle").value(o["border-style"]):r.find("#borderStyle").value(""),r.find("#style").value(n.serializeStyle(n.parseStyle(n.serializeStyle(o))))}})},{type:"form",layout:"grid",packV:"start",columns:2,padding:0,defaults:{type:"textbox",maxWidth:50,onchange:function(t){$(e,t.control.rootControl)}},items:[{label:"Vertical space",name:"vspace"},{label:"Border width",name:"border"},{label:"Horizontal space",name:"hspace"},{label:"Border style",type:"listbox",name:"borderStyle",width:90,maxWidth:90,onselect:function(t){$(e,t.control.rootControl)},values:[{text:"Select...",value:""},{text:"Solid",value:"solid"},{text:"Dotted",value:"dotted"},{text:"Dashed",value:"dashed"},{text:"Double",value:"double"},{text:"Groove",value:"groove"},{text:"Ridge",value:"ridge"},{text:"Inset",value:"inset"},{text:"Outset",value:"outset"},{text:"None",value:"none"},{text:"Hidden",value:"hidden"}]}]}]};var t}},Y=function(e,t){e.state.set("oldVal",e.value()),t.state.set("oldVal",t.value())},Z=function(e,t){var n=e.find("#width")[0],r=e.find("#height")[0],a=e.find("#constrain")[0];n&&r&&a&&t(n,r,a.checked())},ee=function(e,t,n){var r=e.state.get("oldVal"),a=t.state.get("oldVal"),i=e.value(),o=t.value();n&&r&&a&&i&&o&&(i!==r?(o=Math.round(i/r*o),isNaN(o)||t.value(o)):(i=Math.round(o/a*i),isNaN(i)||e.value(i))),Y(e,t)},te=function(e){Z(e,ee)},ne={createUi:function(){var e=function(e){te(e.control.rootControl)};return{type:"container",label:"Dimensions",layout:"flex",align:"center",spacing:5,items:[{name:"width",type:"textbox",maxLength:5,size:5,onchange:e,ariaLabel:"Width"},{type:"label",text:"x"},{name:"height",type:"textbox",maxLength:5,size:5,onchange:e,ariaLabel:"Height"},{name:"constrain",type:"checkbox",checked:!0,text:"Constrain proportions"}]}},syncSize:function(e){Z(e,Y)},updateSize:te},re=function(e){e.meta=e.control.rootControl.toJSON()},ae=function(e,t){var n=[{name:"src",type:"filepicker",filetype:"image",label:"Source",autofocus:!0,onchange:function(t){var n,r,a,o,l,u,s,c,f;r=e,u=(n=t).meta||{},s=n.control,c=s.rootControl,(f=c.find("#image-list")[0])&&f.value(r.convertURL(s.value(),"src")),d.each(u,function(e,t){c.find("#"+t).value(e)}),u.width||u.height||(a=r.convertURL(s.value(),"src"),o=i.getPrependUrl(r),l=new RegExp("^(?:[a-z]+:)?//","i"),o&&!l.test(a)&&a.substring(0,o.length)!==o&&(a=o+a),s.value(a),m.getImageSize(r.documentBaseURI.toAbsolute(s.value()),function(e){e.width&&e.height&&i.hasDimensions(r)&&(c.find("#width").value(e.width),c.find("#height").value(e.height),ne.syncSize(c))}))},onbeforecall:re},t];return i.hasDescription(e)&&n.push({name:"alt",type:"textbox",label:"Image description"}),i.hasImageTitle(e)&&n.push({name:"title",type:"textbox",label:"Image Title"}),i.hasDimensions(e)&&n.push(ne.createUi()),i.getClassList(e)&&n.push({name:"class",type:"listbox",label:"Class",values:m.buildListItems(i.getClassList(e),function(t){t.value&&(t.textStyle=function(){return e.formatter.getCssText({inline:"img",classes:[t.value]})})})}),i.hasImageCaption(e)&&n.push({name:"caption",type:"checkbox",label:"Caption"}),n},ie={makeTab:function(e,t){return{title:"General",type:"form",items:ae(e,t)}},getGeneralItems:ae},oe=function(){return s.getOrDie("URL")},le=function(e){return oe().createObjectURL(e)},ue=function(e){oe().revokeObjectURL(e)},se=tinymce.util.Tools.resolve("tinymce.ui.Factory"),ce=function(){},de=function(e,t){return e?e.replace(/\/$/,"")+"/"+t.replace(/^\//,""):t},fe=function(e){return function(t){var r=se.get("Throbber"),a=t.control.rootControl,o=new r(a.getEl()),l=t.control.value(),u=le(l),s=n({url:i.getUploadUrl(e),basePath:i.getUploadBasePath(e),credentials:i.getUploadCredentials(e),handler:i.getUploadHandler(e)}),c=function(){o.hide(),ue(u)};return o.show(),m.blobToDataUri(l).then(function(t){var n=e.editorUpload.blobCache.create({blob:l,blobUri:u,name:l.name?l.name.replace(/\.[^\.]+$/,""):null,base64:t.split(",")[1]});return s.upload(n).then(function(e){var t=a.find("#src");return t.value(e),a.find("tabpanel")[0].activateTab(0),t.fire("change"),c(),e})}).catch(function(t){e.windowManager.alert(t),c()})}},ge=".jpg,.jpeg,.png,.gif",me={makeTab:function(e){return{title:"Upload",type:"form",layout:"flex",direction:"column",align:"stretch",padding:"20 20 20 20",items:[{type:"container",layout:"flex",direction:"column",align:"center",spacing:10,items:[{text:"Browse for an image",type:"browsebutton",accept:ge,onchange:fe(e)},{text:"OR",type:"label"}]},{text:"Drop an image here",type:"dropzone",accept:ge,height:100,onchange:fe(e)}]}}},pe=function(e){return function(){return e}},he={noop:function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t]},noarg:function(e){return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return e()}},compose:function(e,t){return function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];return e(t.apply(null,arguments))}},constant:pe,identity:function(e){return e},tripleEquals:function(e,t){return e===t},curry:function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];for(var r=new Array(arguments.length-1),a=1;a<arguments.length;a++)r[a-1]=arguments[a];return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];for(var a=new Array(arguments.length),i=0;i<a.length;i++)a[i]=arguments[i];var o=r.concat(a);return e.apply(null,o)}},not:function(e){return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return!e.apply(null,arguments)}},die:function(e){return function(){throw new Error(e)}},apply:function(e){return e()},call:function(e){e()},never:pe(!1),always:pe(!0)},ve=function(e,t){var n=t.control.getRoot();ne.updateSize(n),e.undoManager.transact(function(){var t=w.merge(X(e),n.toJSON());K(e,t)}),e.editorUpload.uploadImagesAuto()},be=function(e){e.addCommand("mceImage",r(e).open)},ye=function(e){return function(t){for(var n,r,a=t.length,i=function(t){t.attr("contenteditable",e?"true":null)};a--;)n=t[a],(r=n.attr("class"))&&/\bimage\b/.test(r)&&(n.attr("contenteditable",e?"false":null),d.each(n.getAll("figcaption"),i))}},xe=function(e){e.on("preInit",function(){e.parser.addNodeFilter("figure",ye(!0)),e.serializer.addNodeFilter("figure",ye(!1))})},we=function(e){e.addButton("image",{icon:"image",tooltip:"Insert/edit image",onclick:r(e).open,stateSelector:"img:not([data-mce-object],[data-mce-placeholder]),figure.image"}),e.addMenuItem("image",{icon:"image",text:"Image",onclick:r(e).open,context:"insert",prependToContext:!0})};a.add("image",function(e){xe(e),we(e),be(e)})}();