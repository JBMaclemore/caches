import{m as v,b as T,a as A}from"./vuex.esm-bundler.2b955043.js";import{A as j,T as B}from"./TitleDescription.93f64e81.js";import{C as F}from"./Card.3fe33c7e.js";import{C as x}from"./Tabs.33846a24.js";import{C as w}from"./Tooltip.876fbafa.js";import{C as D,S as O}from"./Schema.b5a29b63.js";import{B as U}from"./Textarea.33898a18.js";import{C as q}from"./Blur.ff94edf5.js";import{C as L}from"./SettingsRow.010c4bbe.js";import{C as P}from"./Index.d2a7b6fb.js";import{_ as y,q as i,o as r,c as h,z as c,k as n,a as l,t as a,x as _,j as f,b as C,F as z,E,B as N,l as V,T as M}from"./_plugin-vue_export-helper.a2c961b3.js";import{S as H}from"./index.24cd8e71.js";import"./default-i18n.ab92175e.js";import"./_commonjsHelpers.f84db168.js";import"./WpTable.4156f8c9.js";import"./helpers.ad3850ca.js";import"./RequiresUpdate.fe231e49.js";import"./postContent.ce215f52.js";import"./index.a915b491.js";import"./isArrayLikeObject.5b92a7d2.js";import"./Caret.8213645d.js";import"./cleanForSlug.d1b7ba11.js";import"./constants.145da60f.js";import"./html.c2b89264.js";import"./Index.e14a5090.js";import"./JsonValues.870a4901.js";import"./MaxCounts.12b45bab.js";import"./SaveChanges.6857467d.js";import"./RadioToggle.3b298d3e.js";import"./ProBadge.267c3a94.js";import"./RobotsMeta.03a16901.js";import"./Checkbox.8db0d2b3.js";import"./Checkmark.1fb57726.js";import"./Row.f8e3a585.js";import"./GoogleSearchPreview.3c1aa703.js";import"./HtmlTagsEditor.6beeae44.js";import"./Editor.d117041b.js";import"./UnfilteredHtml.fc538563.js";import"./Slide.170b1e50.js";import"./TruSeoScore.76897846.js";import"./Information.342d90e5.js";const I={components:{BaseTextarea:U,CoreBlur:q,CoreSettingsRow:L,Cta:P},props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data(){return{strings:{customFields:this.$t.__("Custom Fields",this.$td),customFieldsDescription:this.$t.__("List of custom field names to include as post content for tags and the SEO Page Analysis. Add one per line.",this.$td),ctaDescription:this.$t.sprintf(this.$t.__("%1$s %2$s gives you advanced customizations for our page analysis feature, letting you add custom fields to analyze.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Custom Fields",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Custom Fields are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},computed:{...v(["options"])},methods:{getSchemaTypeOption(t){return this.schemaTypes.find(m=>m.value===t)}}},R={class:"aioseo-sa-ct-custom-fields lite"},G={class:"aioseo-description"};function Q(t,m,e,$,s,d){const p=i("base-textarea"),u=i("core-settings-row"),g=i("core-blur"),b=i("cta");return r(),h("div",R,[c(g,null,{default:n(()=>[c(u,{name:s.strings.customFields,align:""},{content:n(()=>[c(p,{"min-height":200}),l("div",G,a(s.strings.customFieldsDescription),1)]),_:1},8,["name"])]),_:1}),c(b,{"cta-link":t.$links.getPricingUrl("custom-fields","custom-fields-upsell",`${e.object.name}-post-type`),"button-text":s.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("custom-fields",e.object.name,"home")},{"header-text":n(()=>[_(a(s.strings.ctaHeader),1)]),description:n(()=>[_(a(s.strings.ctaDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link"])])}const J=y(I,[["render",Q]]),K={components:{CustomFields:D,CustomFieldsLite:J},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:{...T(["isUnlicensed"])}},W={class:"aioseo-sa-ct-custom-fields-view"};function X(t,m,e,$,s,d){const p=i("custom-fields",!0),u=i("custom-fields-lite");return r(),h("div",W,[t.isUnlicensed?C("",!0):(r(),f(p,{key:0,type:e.type,object:e.object,options:e.options,"show-bulk":e.showBulk},null,8,["type","object","options","show-bulk"])),t.isUnlicensed?(r(),f(u,{key:1,type:e.type,object:e.object,options:e.options,"show-bulk":e.showBulk},null,8,["type","object","options","show-bulk"])):C("",!0)])}const Y=y(K,[["render",X]]);const Z={components:{Advanced:j,CoreCard:F,CoreMainTabs:x,CoreTooltip:w,CustomFields:Y,Schema:O,SvgCircleQuestionMark:H,TitleDescription:B},data(){return{internalDebounce:null,strings:{label:this.$t.__("Label:",this.$td),name:this.$t.__("Slug:",this.$td)},tabs:[{slug:"title-description",name:this.$t.__("Title & Description",this.$td),access:"aioseo_search_appearance_settings",pro:!1},{slug:"schema",name:this.$t.__("Schema Markup",this.$td),access:"aioseo_search_appearance_settings",pro:!0},{slug:"custom-fields",name:this.$t.__("Custom Fields",this.$td),access:"aioseo_search_appearance_settings",pro:!0},{slug:"advanced",name:this.$t.__("Advanced",this.$td),access:"aioseo_search_appearance_settings",pro:!1}]}},computed:{...v(["options","dynamicOptions","settings"]),postTypes(){return this.$aioseo.postData.postTypes.filter(t=>t.name!=="attachment")}},methods:{...A(["changeTab"]),processChangeTab(t,m){this.internalDebounce||(this.internalDebounce=!0,this.changeTab({slug:`${t}SA`,value:m}),setTimeout(()=>{this.internalDebounce=!1},50))}}},tt={class:"aioseo-search-appearance-content-types"},et={class:"aioseo-description"},st=l("br",null,null,-1),ot=l("br",null,null,-1);function nt(t,m,e,$,s,d){const p=i("svg-circle-question-mark"),u=i("core-tooltip"),g=i("core-main-tabs"),b=i("core-card");return r(),h("div",tt,[(r(!0),h(z,null,E(d.postTypes,(o,k)=>(r(),f(b,{key:k,slug:`${o.name}SA`},{header:n(()=>[l("div",{class:N(["icon dashicons",`${o.icon||"dashicons-admin-post"}`])},null,2),_(" "+a(o.label)+" ",1),c(u,{"z-index":"99999"},{tooltip:n(()=>[l("div",et,[_(a(s.strings.label)+" ",1),l("strong",null,a(o.label),1),st,_(" "+a(s.strings.name)+" ",1),l("strong",null,a(o.name),1),ot])]),default:n(()=>[c(p)]),_:2},1024)]),tabs:n(()=>[c(g,{tabs:s.tabs,showSaveButton:!1,active:t.settings.internalTabs[`${o.name}SA`],internal:"",onChanged:S=>d.processChangeTab(o.name,S)},null,8,["tabs","active","onChanged"])]),default:n(()=>[c(M,{name:"route-fade",mode:"out-in"},{default:n(()=>[(r(),f(V(t.settings.internalTabs[`${o.name}SA`]),{object:o,separator:t.options.searchAppearance.global.separator,options:t.dynamicOptions.searchAppearance.postTypes[o.name],type:"postTypes"},null,8,["object","separator","options"]))]),_:2},1024)]),_:2},1032,["slug"]))),128))])}const Gt=y(Z,[["render",nt]]);export{Gt as default};