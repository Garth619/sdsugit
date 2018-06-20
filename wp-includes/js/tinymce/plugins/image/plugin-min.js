!function(){var e=function(){"use strict";function e(){return new(A.getOrDie("FileReader"))}function t(){return new(A.getOrDie("XMLHttpRequest"))}function n(e){var n=function(n,r,i,a){var o,l;o=new t,o.open("POST",e.url),o.withCredentials=e.credentials,o.upload.onprogress=function(e){a(e.loaded/e.total*100)},o.onerror=function(){i("Image upload failed due to a XHR Transport error. Code: "+o.status)},o.onload=function(){var t;return o.status<200||o.status>=300?void i("HTTP Error: "+o.status):(t=JSON.parse(o.responseText))&&"string"==typeof t.location?void r(at(e.basePath,t.location)):void i("Invalid JSON: "+o.responseText)},l=new FormData,l.append("file",n.blob(),n.filename()),o.send(l)},r=function(e,t){return new O(function(n,r){try{t(e,n,r,it)}catch(e){r(e.message)}})},i=function(e){return e===n},a=function(t){return!e.url&&i(e.handler)?O.reject("Upload url missing from the settings."):r(t,e.handler)};return e=R.extend({credentials:!1,handler:n},e),{upload:a}}function r(e){function t(t){var n=Oe(e),r,i;if(t&&(i={type:"listbox",label:"Image list",name:"image-list",values:W.buildListItems(t,function(t){t.value=e.convertURL(t.value||t.url,"src")},[{text:"None",value:""}]),value:n.src&&e.convertURL(n.src,"src"),onselect:function(e){var t=r.find("#alt");(!t.value()||e.lastControl&&t.value()===e.lastControl.text())&&t.value(e.control.text()),r.find("#src").value(e.control.value()).fire("change")},onPostRender:function(){i=this}}),x.hasAdvTab(e)||x.hasUploadUrl(e)||x.hasUploadHandler(e)){var a=[Ye.makeTab(e,i)];x.hasAdvTab(e)&&a.push(He.makeTab(e)),(x.hasUploadUrl(e)||x.hasUploadHandler(e))&&a.push(ct.makeTab(e)),r=e.windowManager.open({title:"Insert/edit image",data:n,bodyType:"tabpanel",body:a,onSubmit:Ut.curry(Ct,e)})}else r=e.windowManager.open({title:"Insert/edit image",data:n,body:Ye.getGeneralItems(e,i),onSubmit:Ut.curry(Ct,e)});$e.syncSize(r)}function n(){W.createImageList(e,t)}return{open:n}}function i(){}var a=tinymce.util.Tools.resolve("tinymce.PluginManager"),o=function(e){return!1!==e.settings.image_dimensions},l=function(e){return!0===e.settings.image_advtab},u=function(e){return e.getParam("image_prepend_url","")},c=function(e){return e.getParam("image_class_list")},s=function(e){return!1!==e.settings.image_description},d=function(e){return!0===e.settings.image_title},f=function(e){return!0===e.settings.image_caption},g=function(e){return e.getParam("image_list",!1)},m=function(e){return e.getParam("images_upload_url",!1)},p=function(e){return e.getParam("images_upload_handler",!1)},h=function(e){return e.getParam("images_upload_url")},v=function(e){return e.getParam("images_upload_handler")},b=function(e){return e.getParam("images_upload_base_path")},y=function(e){return e.getParam("images_upload_credentials")},x={hasDimensions:o,hasAdvTab:l,getPrependUrl:u,getClassList:c,hasDescription:s,hasImageTitle:d,hasImageCaption:f,getImageList:g,hasUploadUrl:m,hasUploadHandler:p,getUploadUrl:h,getUploadHandler:v,getUploadBasePath:b,getUploadCredentials:y},w="undefined"!=typeof window?window:Function("return this;")(),S=function(e,t){for(var n=void 0!==t&&null!==t?t:w,r=0;r<e.length&&void 0!==n&&null!==n;++r)n=n[e[r]];return n},U=function(e,t){var n=e.split(".");return S(n,t)},C=function(e,t){return void 0!==e[t]&&null!==e[t]||(e[t]={}),e[t]},T=function(e,t){for(var n=void 0!==t?t:w,r=0;r<e.length;++r)n=C(n,e[r]);return n},P=function(e,t){var n=e.split(".");return T(n,t)},I={path:S,resolve:U,forge:T,namespace:P},L=function(e,t){return I.resolve(e,t)},N=function(e,t){var n=L(e,t);if(void 0===n||null===n)throw e+" not available on this browser";return n},A={getOrDie:N},O=tinymce.util.Tools.resolve("tinymce.util.Promise"),R=tinymce.util.Tools.resolve("tinymce.util.Tools"),_=tinymce.util.Tools.resolve("tinymce.util.XHR"),k=function(e,t){return Math.max(parseInt(e,10),parseInt(t,10))},D=function(e,t){function n(e,n){r.parentNode&&r.parentNode.removeChild(r),t({width:e,height:n})}var r=document.createElement("img");r.onload=function(){n(k(r.width,r.clientWidth),k(r.height,r.clientHeight))},r.onerror=function(){n(0,0)};var i=r.style;i.visibility="hidden",i.position="fixed",i.bottom=i.left="0px",i.width=i.height="auto",document.body.appendChild(r),r.src=e},j=function(e,t,n){function r(e,n){return n=n||[],R.each(e,function(e){var i={text:e.text||e.title};e.menu?i.menu=r(e.menu):(i.value=e.value,t(i)),n.push(i)}),n}return r(e,n||[])},z=function(e){return e&&(e=e.replace(/px$/,"")),e},M=function(e){return e.length>0&&/^[0-9]+$/.test(e)&&(e+="px"),e},E=function(e){if(e.margin){var t=e.margin.split(" ");switch(t.length){case 1:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[0],e["margin-bottom"]=e["margin-bottom"]||t[0],e["margin-left"]=e["margin-left"]||t[0];break;case 2:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[0],e["margin-left"]=e["margin-left"]||t[1];break;case 3:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[2],e["margin-left"]=e["margin-left"]||t[1];break;case 4:e["margin-top"]=e["margin-top"]||t[0],e["margin-right"]=e["margin-right"]||t[1],e["margin-bottom"]=e["margin-bottom"]||t[2],e["margin-left"]=e["margin-left"]||t[3]}delete e.margin}return e},H=function(e,t){var n=x.getImageList(e);"string"==typeof n?_.send({url:n,success:function(e){t(JSON.parse(e))}}):"function"==typeof n?n(t):t(n)},B=function(e,t,n){function r(){n.onload=n.onerror=null,e.selection&&(e.selection.select(n),e.nodeChanged())}n.onload=function(){t.width||t.height||!x.hasDimensions(e)||e.dom.setAttribs(n,{width:n.clientWidth,height:n.clientHeight}),r()},n.onerror=r},F=function(t){return new O(function(n,r){var i=new e;i.onload=function(){n(i.result)},i.onerror=function(){r(e.error.message)},i.readAsDataURL(t)})},W={getImageSize:D,buildListItems:j,removePixelSuffix:z,addPixelSuffix:M,mergeMargins:E,createImageList:H,waitLoadImage:B,blobToDataUri:F},G=tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),J=function(e){if(null===e)return"null";var t=typeof e;return"object"===t&&Array.prototype.isPrototypeOf(e)?"array":"object"===t&&String.prototype.isPrototypeOf(e)?"string":t},V=function(e){return function(t){return J(t)===e}},X={isString:V("string"),isObject:V("object"),isArray:V("array"),isNull:V("null"),isBoolean:V("boolean"),isUndefined:V("undefined"),isFunction:V("function"),isNumber:V("number")},q=function(e,t){return t},K=function(e,t){return X.isObject(e)&&X.isObject(t)?Y(e,t):t},Q=function(e){return function(){for(var t=new Array(arguments.length),n=0;n<t.length;n++)t[n]=arguments[n];if(0===t.length)throw new Error("Can't merge zero objects");for(var r={},i=0;i<t.length;i++){var a=t[i];for(var o in a)a.hasOwnProperty(o)&&(r[o]=e(r[o],a[o]))}return r}},Y=Q(K),Z=Q(q),ee={deepMerge:Y,merge:Z},te=G.DOM,ne=function(e){return e.style.marginLeft&&e.style.marginRight&&e.style.marginLeft===e.style.marginRight?W.removePixelSuffix(e.style.marginLeft):""},re=function(e){return e.style.marginTop&&e.style.marginBottom&&e.style.marginTop===e.style.marginBottom?W.removePixelSuffix(e.style.marginTop):""},ie=function(e){return e.style.borderWidth?W.removePixelSuffix(e.style.borderWidth):""},ae=function(e,t){return e.hasAttribute(t)?e.getAttribute(t):""},oe=function(e,t){return e.style[t]?e.style[t]:""},le=function(e){return null!==e.parentNode&&"FIGURE"===e.parentNode.nodeName},ue=function(e,t,n){e.setAttribute(t,n)},ce=function(e){var t=te.create("figure",{class:"image"});te.insertAfter(t,e),t.appendChild(e),t.appendChild(te.create("figcaption",{contentEditable:!0},"Caption")),t.contentEditable="false"},se=function(e){var t=e.parentNode;te.insertAfter(e,t),te.remove(t)},de=function(e){le(e)?se(e):ce(e)},fe=function(e,t){var n=e.getAttribute("style"),r=t(null!==n?n:"");r.length>0?(e.setAttribute("style",r),e.setAttribute("data-mce-style",r)):e.removeAttribute("style")},ge=function(e,t){return function(e,n,r){e.style[n]?(e.style[n]=W.addPixelSuffix(r),fe(e,t)):ue(e,n,r)}},me=function(e,t){return e.style[t]?W.removePixelSuffix(e.style[t]):ae(e,t)},pe=function(e,t){var n=W.addPixelSuffix(t);e.style.marginLeft=n,e.style.marginRight=n},he=function(e,t){var n=W.addPixelSuffix(t);e.style.marginTop=n,e.style.marginBottom=n},ve=function(e,t){var n=W.addPixelSuffix(t);e.style.borderWidth=n},be=function(e,t){e.style.borderStyle=t},ye=function(e){return oe(e,"borderStyle")},xe=function(e){return"FIGURE"===e.nodeName},we=function(){return{src:"",alt:"",title:"",width:"",height:"",class:"",style:"",caption:!1,hspace:"",vspace:"",border:"",borderStyle:""}},Se=function(e,t){var n=document.createElement("img");return ue(n,"style",t.style),(ne(n)||""!==t.hspace)&&pe(n,t.hspace),(re(n)||""!==t.vspace)&&he(n,t.vspace),(ie(n)||""!==t.border)&&ve(n,t.border),(ye(n)||""!==t.borderStyle)&&be(n,t.borderStyle),e(n.getAttribute("style"))},Ue=function(e,t){var n=document.createElement("img");if(Ie(e,ee.merge(t,{caption:!1}),n),ue(n,"alt",t.alt),t.caption){var r=te.create("figure",{class:"image"});return r.appendChild(n),r.appendChild(te.create("figcaption",{contentEditable:!0},"Caption")),r.contentEditable="false",r}return n},Ce=function(e,t){return{src:ae(t,"src"),alt:ae(t,"alt"),title:ae(t,"title"),width:me(t,"width"),height:me(t,"height"),class:ae(t,"class"),style:e(ae(t,"style")),caption:le(t),hspace:ne(t),vspace:re(t),border:ie(t),borderStyle:oe(t,"borderStyle")}},Te=function(e,t,n,r,i){n[r]!==t[r]&&i(e,r,n[r])},Pe=function(e,t){return function(n,r,i){e(n,i),fe(n,t)}},Ie=function(e,t,n){var r=Ce(e,n);Te(n,r,t,"caption",function(e,t,n){return de(e)}),Te(n,r,t,"src",ue),Te(n,r,t,"alt",ue),Te(n,r,t,"title",ue),Te(n,r,t,"width",ge("width",e)),Te(n,r,t,"height",ge("height",e)),Te(n,r,t,"class",ue),Te(n,r,t,"style",Pe(function(e,t){return ue(e,"style",t)},e)),Te(n,r,t,"hspace",Pe(pe,e)),Te(n,r,t,"vspace",Pe(he,e)),Te(n,r,t,"border",Pe(ve,e)),Te(n,r,t,"borderStyle",Pe(be,e))},Le=function(e,t){var n=e.dom.styles.parse(t),r=W.mergeMargins(n),i=e.dom.styles.parse(e.dom.styles.serialize(r));return e.dom.styles.serialize(i)},Ne=function(e){var t=e.selection.getNode(),n=e.dom.getParent(t,"figure.image");return n?e.dom.select("img",n)[0]:t&&("IMG"!==t.nodeName||t.getAttribute("data-mce-object")||t.getAttribute("data-mce-placeholder"))?null:t},Ae=function(e,t){var n=e.dom,r=n.getParent(t.parentNode,function(t){return e.schema.getTextBlockElements()[t.nodeName]});return r?n.split(r,t):t},Oe=function(e){var t=Ne(e);return t?Ce(function(t){return Le(e,t)},t):we()},Re=function(e,t){var n=Ue(function(t){return Le(e,t)},t);e.dom.setAttrib(n,"data-mce-id","__mcenew"),e.focus(),e.selection.setContent(n.outerHTML);var r=e.dom.select('*[data-mce-id="__mcenew"]')[0];if(e.dom.setAttrib(r,"data-mce-id",null),xe(r)){var i=Ae(e,r);e.selection.select(i)}else e.selection.select(r)},_e=function(e,t){e.dom.setAttrib(t,"src",t.getAttribute("src"))},ke=function(e,t){if(t){var n=e.dom.is(t.parentNode,"figure.image")?t.parentNode:t;e.dom.remove(n),e.focus(),e.nodeChanged(),e.dom.isEmpty(e.getBody())&&(e.setContent(""),e.selection.setCursorLocation())}},De=function(e,t){var n=Ne(e);if(Ie(function(t){return Le(e,t)},t,n),_e(e,n),xe(n.parentNode)){var r=n.parentNode;Ae(e,r),e.selection.select(n.parentNode)}else e.selection.select(n),W.waitLoadImage(e,t,n)},je=function(e,t){var n=Ne(e);n?t.src?De(e,t):ke(e,n):t.src&&Re(e,t)},ze=function(e){return function(t){var n=e.dom,r=t.control.rootControl;if(x.hasAdvTab(e)){var i=r.toJSON(),a=n.parseStyle(i.style);r.find("#vspace").value(""),r.find("#hspace").value(""),a=W.mergeMargins(a),(a["margin-top"]&&a["margin-bottom"]||a["margin-right"]&&a["margin-left"])&&(a["margin-top"]===a["margin-bottom"]?r.find("#vspace").value(W.removePixelSuffix(a["margin-top"])):r.find("#vspace").value(""),a["margin-right"]===a["margin-left"]?r.find("#hspace").value(W.removePixelSuffix(a["margin-right"])):r.find("#hspace").value("")),a["border-width"]?r.find("#border").value(W.removePixelSuffix(a["border-width"])):r.find("#border").value(""),a["border-style"]?r.find("#borderStyle").value(a["border-style"]):r.find("#borderStyle").value(""),r.find("#style").value(n.serializeStyle(n.parseStyle(n.serializeStyle(a))))}}},Me=function(e,t){t.find("#style").each(function(n){var r=Se(function(t){return Le(e,t)},ee.merge(we(),t.toJSON()));n.value(r)})},Ee=function(e){return{title:"Advanced",type:"form",pack:"start",items:[{label:"Style",name:"style",type:"textbox",onchange:ze(e)},{type:"form",layout:"grid",packV:"start",columns:2,padding:0,defaults:{type:"textbox",maxWidth:50,onchange:function(t){Me(e,t.control.rootControl)}},items:[{label:"Vertical space",name:"vspace"},{label:"Border width",name:"border"},{label:"Horizontal space",name:"hspace"},{label:"Border style",type:"listbox",name:"borderStyle",width:90,maxWidth:90,onselect:function(t){Me(e,t.control.rootControl)},values:[{text:"Select...",value:""},{text:"Solid",value:"solid"},{text:"Dotted",value:"dotted"},{text:"Dashed",value:"dashed"},{text:"Double",value:"double"},{text:"Groove",value:"groove"},{text:"Ridge",value:"ridge"},{text:"Inset",value:"inset"},{text:"Outset",value:"outset"},{text:"None",value:"none"},{text:"Hidden",value:"hidden"}]}]}]}},He={makeTab:Ee},Be=function(e,t){e.state.set("oldVal",e.value()),t.state.set("oldVal",t.value())},Fe=function(e,t){var n=e.find("#width")[0],r=e.find("#height")[0],i=e.find("#constrain")[0];n&&r&&i&&t(n,r,i.checked())},We=function(e,t,n){var r=e.state.get("oldVal"),i=t.state.get("oldVal"),a=e.value(),o=t.value();n&&r&&i&&a&&o&&(a!==r?(o=Math.round(a/r*o),isNaN(o)||t.value(o)):(a=Math.round(o/i*a),isNaN(a)||e.value(a))),Be(e,t)},Ge=function(e){Fe(e,Be)},Je=function(e){Fe(e,We)},Ve=function(){var e=function(e){Je(e.control.rootControl)};return{type:"container",label:"Dimensions",layout:"flex",align:"center",spacing:5,items:[{name:"width",type:"textbox",maxLength:5,size:5,onchange:e,ariaLabel:"Width"},{type:"label",text:"x"},{name:"height",type:"textbox",maxLength:5,size:5,onchange:e,ariaLabel:"Height"},{name:"constrain",type:"checkbox",checked:!0,text:"Constrain proportions"}]}},$e={createUi:Ve,syncSize:Ge,updateSize:Je},Xe=function(e,t){var n,r,i,a=e.meta||{},o=e.control,l=o.rootControl,u=l.find("#image-list")[0];u&&u.value(t.convertURL(o.value(),"src")),R.each(a,function(e,t){l.find("#"+t).value(e)}),a.width||a.height||(n=t.convertURL(o.value(),"src"),r=x.getPrependUrl(t),i=new RegExp("^(?:[a-z]+:)?//","i"),r&&!i.test(n)&&n.substring(0,r.length)!==r&&(n=r+n),o.value(n),W.getImageSize(t.documentBaseURI.toAbsolute(o.value()),function(e){e.width&&e.height&&x.hasDimensions(t)&&(l.find("#width").value(e.width),l.find("#height").value(e.height),$e.syncSize(l))}))},qe=function(e){e.meta=e.control.rootControl.toJSON()},Ke=function(e,t){var n=[{name:"src",type:"filepicker",filetype:"image",label:"Source",autofocus:!0,onchange:function(t){Xe(t,e)},onbeforecall:qe},t];return x.hasDescription(e)&&n.push({name:"alt",type:"textbox",label:"Image description"}),x.hasImageTitle(e)&&n.push({name:"title",type:"textbox",label:"Image Title"}),x.hasDimensions(e)&&n.push($e.createUi()),x.getClassList(e)&&n.push({name:"class",type:"listbox",label:"Class",values:W.buildListItems(x.getClassList(e),function(t){t.value&&(t.textStyle=function(){return e.formatter.getCssText({inline:"img",classes:[t.value]})})})}),x.hasImageCaption(e)&&n.push({name:"caption",type:"checkbox",label:"Caption"}),n},Qe=function(e,t){return{title:"General",type:"form",items:Ke(e,t)}},Ye={makeTab:Qe,getGeneralItems:Ke},Ze=function(){return A.getOrDie("URL")},et=function(e){return Ze().createObjectURL(e)},tt=function(e){Ze().revokeObjectURL(e)},nt={createObjectURL:et,revokeObjectURL:tt},rt=tinymce.util.Tools.resolve("tinymce.ui.Factory"),it=function(){},at=function(e,t){return e?e.replace(/\/$/,"")+"/"+t.replace(/^\//,""):t},ot=function(e){return function(t){var r=rt.get("Throbber"),i=t.control.rootControl,a=new r(i.getEl()),o=t.control.value(),l=nt.createObjectURL(o),u=n({url:x.getUploadUrl(e),basePath:x.getUploadBasePath(e),credentials:x.getUploadCredentials(e),handler:x.getUploadHandler(e)}),c=function(){a.hide(),nt.revokeObjectURL(l)};return a.show(),W.blobToDataUri(o).then(function(t){var n=e.editorUpload.blobCache.create({blob:o,blobUri:l,name:o.name?o.name.replace(/\.[^\.]+$/,""):null,base64:t.split(",")[1]});return u.upload(n).then(function(e){var t=i.find("#src");return t.value(e),i.find("tabpanel")[0].activateTab(0),t.fire("change"),c(),e})}).catch(function(t){e.windowManager.alert(t),c()})}},lt=".jpg,.jpeg,.png,.gif",ut=function(e){return{title:"Upload",type:"form",layout:"flex",direction:"column",align:"stretch",padding:"20 20 20 20",items:[{type:"container",layout:"flex",direction:"column",align:"center",spacing:10,items:[{text:"Browse for an image",type:"browsebutton",accept:lt,onchange:ot(e)},{text:"OR",type:"label"}]},{text:"Drop an image here",type:"dropzone",accept:lt,height:100,onchange:ot(e)}]}},ct={makeTab:ut},st=function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t]},dt=function(e){return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return e()}},ft=function(e,t){return function(){for(var n=[],r=0;r<arguments.length;r++)n[r]=arguments[r];return e(t.apply(null,arguments))}},gt=function(e){return function(){return e}},mt=function(e){return e},pt=function(e,t){return e===t},ht=function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];for(var r=new Array(arguments.length-1),i=1;i<arguments.length;i++)r[i-1]=arguments[i];return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];for(var i=new Array(arguments.length),a=0;a<i.length;a++)i[a]=arguments[a];var o=r.concat(i);return e.apply(null,o)}},vt=function(e){return function(){for(var t=[],n=0;n<arguments.length;n++)t[n]=arguments[n];return!e.apply(null,arguments)}},bt=function(e){return function(){throw new Error(e)}},yt=function(e){return e()},xt=function(e){e()},wt=gt(!1),St=gt(!0),Ut={noop:st,noarg:dt,compose:ft,constant:gt,identity:mt,tripleEquals:pt,curry:ht,not:vt,die:bt,apply:yt,call:xt,never:wt,always:St},Ct=function(e,t){var n=t.control.getRoot();$e.updateSize(n),e.undoManager.transact(function(){var t=ee.merge(Oe(e),n.toJSON());je(e,t)}),e.editorUpload.uploadImagesAuto()},Tt=function(e){e.addCommand("mceImage",r(e).open)},Pt={register:Tt},It=function(e){var t=e.attr("class");return t&&/\bimage\b/.test(t)},Lt=function(e){return function(t){for(var n=t.length,r,i=function(t){t.attr("contenteditable",e?"true":null)};n--;)r=t[n],It(r)&&(r.attr("contenteditable",e?"false":null),R.each(r.getAll("figcaption"),i))}},Nt=function(e){e.on("preInit",function(){e.parser.addNodeFilter("figure",Lt(!0)),e.serializer.addNodeFilter("figure",Lt(!1))})},At={setup:Nt},Ot=function(e){e.addButton("image",{icon:"image",tooltip:"Insert/edit image",onclick:r(e).open,stateSelector:"img:not([data-mce-object],[data-mce-placeholder]),figure.image"}),e.addMenuItem("image",{icon:"image",text:"Image",onclick:r(e).open,context:"insert",prependToContext:!0})},Rt={register:Ot};return a.add("image",function(e){At.setup(e),Rt.register(e),Pt.register(e)}),i}()}();