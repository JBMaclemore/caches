import{m as A,b as M}from"./vuex.esm-bundler.2b955043.js";import{T as L}from"./WpTable.4156f8c9.js";import"./default-i18n.ab92175e.js";import"./constants.145da60f.js";import{_ as k,q as l,o,c as y,z as d,k as s,j as r,b as n,x as _,t as c,a as w}from"./_plugin-vue_export-helper.a2c961b3.js";import"./index.a915b491.js";import{J as G}from"./JsonValues.870a4901.js";import{M as S}from"./MaxCounts.12b45bab.js";import"./SaveChanges.6857467d.js";import{B}from"./RadioToggle.3b298d3e.js";import{C as T}from"./index.24cd8e71.js";import{C as j}from"./ProBadge.267c3a94.js";import{C as x}from"./RobotsMeta.03a16901.js";import{C}from"./SettingsRow.010c4bbe.js";import{C as I}from"./GoogleSearchPreview.3c1aa703.js";import{C as D}from"./HtmlTagsEditor.6beeae44.js";const R={components:{BaseRadioToggle:B,CoreAlert:T,CoreProBadge:j,CoreRobotsMeta:x,CoreSettingsRow:C},mixins:[G,S],props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean,noMetaBox:Boolean,includeKeywords:Boolean},data(){return{titleCount:0,descriptionCount:0,strings:{robotsSetting:this.$t.__("Robots Meta Settings",this.$td),bulkEditing:this.$t.__("Bulk Editing",this.$td),readOnly:this.$t.__("Read Only",this.$td),otherOptions:this.$t.__("Other Options",this.$td),showDateInGooglePreview:this.$t.__("Show Date in Google Preview",this.$td),keywords:this.$t.__("Keywords",this.$td),removeCatBase:this.$t.__("Remove Category Base Prefix",this.$td),removeCatBaseUpsell:this.$t.sprintf(this.$t.__("This feature is only for licensed %1$s users. %2$s",this.$td),"<strong>AIOSEO Pro</strong>",this.$links.getUpsellLink("search-appearance-advanced",this.$constants.GLOBAL_STRINGS.learnMore,"remove-category-base-prefix",!0))}}},computed:{...A({mainOptions:"options"}),...M(["isUnlicensed"]),removeCatBase:{get(){return this.$isPro?this.mainOptions.searchAppearance.advanced.removeCatBase:!1},set(t){this.mainOptions.searchAppearance.advanced.removeCatBase=t}},title(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},showPostThumbnailInSearch(){return this.$t.sprintf(this.$t.__("Show %1$s Thumbnail in Google Custom Search",this.$td),this.object.singular)},showMetaBox(){return this.$t.sprintf(this.$t.__("Show %1$s Meta Box",this.$td),"AIOSEO")}}},$={class:"aioseo-sa-ct-advanced"},U=["innerHTML"],N={class:"other-options"};function P(t,a,e,O,i,u){const f=l("core-robots-meta"),m=l("core-settings-row"),g=l("base-radio-toggle"),v=l("core-pro-badge"),b=l("core-alert"),h=l("base-toggle"),V=l("base-select");return o(),y("div",$,[d(m,{name:i.strings.robotsSetting},{content:s(()=>[d(f,{options:e.options.advanced.robotsMeta,mainOptions:e.options},null,8,["options","mainOptions"])]),_:1},8,["name"]),e.showBulk?(o(),r(m,{key:0,name:i.strings.bulkEditing,align:""},{content:s(()=>[d(g,{modelValue:e.options.advanced.bulkEditing,"onUpdate:modelValue":a[0]||(a[0]=p=>e.options.advanced.bulkEditing=p),name:`${e.object.name}BulkEditing`,options:[{label:t.$constants.GLOBAL_STRINGS.disabled,value:"disabled"},{label:t.$constants.GLOBAL_STRINGS.enabled,value:"enabled"},{label:i.strings.readOnly,value:"read-only"}]},null,8,["modelValue","name","options"])]),_:1},8,["name"])):n("",!0),e.type==="taxonomies"&&e.object.name==="category"?(o(),r(m,{key:1,align:""},{name:s(()=>[_(c(i.strings.removeCatBase)+" ",1),t.isUnlicensed?(o(),r(v,{key:0})):n("",!0)]),content:s(()=>[d(g,{disabled:t.isUnlicensed,modelValue:u.removeCatBase,"onUpdate:modelValue":a[1]||(a[1]=p=>u.removeCatBase=p),name:"removeCatBase",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},null,8,["disabled","modelValue","options"]),t.isUnlicensed?(o(),r(b,{key:0,class:"inline-upsell",type:"blue"},{default:s(()=>[w("div",{innerHTML:i.strings.removeCatBaseUpsell},null,8,U)]),_:1})):n("",!0)]),_:1})):n("",!0),!e.noMetaBox&&(!t.isUnlicensed||e.type!=="taxonomies")?(o(),r(m,{key:2,name:i.strings.otherOptions},{content:s(()=>[w("div",N,[d(h,{modelValue:e.options.advanced.showMetaBox,"onUpdate:modelValue":a[2]||(a[2]=p=>e.options.advanced.showMetaBox=p)},{default:s(()=>[_(c(u.showMetaBox),1)]),_:1},8,["modelValue"])])]),_:1},8,["name"])):n("",!0),t.mainOptions.searchAppearance.advanced.useKeywords&&e.includeKeywords?(o(),r(m,{key:3,name:i.strings.keywords,align:""},{content:s(()=>[d(V,{multiple:"",taggable:"",options:t.getJsonValue(e.options.advanced.keywords)||[],modelValue:t.getJsonValue(e.options.advanced.keywords)||[],"onUpdate:modelValue":a[3]||(a[3]=p=>e.options.advanced.keywords=t.setJsonValue(p)),"tag-placeholder":i.strings.tagPlaceholder},null,8,["options","modelValue","tag-placeholder"])]),_:1},8,["name"])):n("",!0)])}const de=k(R,[["render",P]]),E={components:{BaseRadioToggle:B,CoreAlert:T,CoreGoogleSearchPreview:I,CoreHtmlTagsEditor:D,CoreSettingsRow:C},mixins:[S,L],props:{type:{type:String,required:!0},object:{type:Object,required:!0},separator:{type:String,required:!0},options:{type:Object,required:!0},edit:{type:Boolean,default(){return!0}}},data(){return{titleCount:0,descriptionCount:0,strings:{showInSearchResults:this.$t.__("Show in Search Results",this.$td),clickToAddTitle:this.$t.__("Click on the tags below to insert variables into your title.",this.$td),metaDescription:this.$t.__("Meta Description",this.$td),clickToAddDescription:this.$t.__("Click on the tags below to insert variables into your meta description.",this.$td)}}},watch:{show(t){if(t){this.options.advanced.robotsMeta.noindex=!1,this.options.advanced.robotsMeta.nofollow===!1&&this.options.advanced.robotsMeta.noarchive===!1&&this.options.advanced.robotsMeta.notranslate===!1&&this.options.advanced.robotsMeta.noimageindex===!1&&this.options.advanced.robotsMeta.nosnippet===!1&&this.options.advanced.robotsMeta.noodp===!1&&parseInt(this.options.advanced.robotsMeta.maxSnippet)===-1&&parseInt(this.options.advanced.robotsMeta.maxVideoPreview)===-1&&this.options.advanced.robotsMeta.maxImagePreview.toLowerCase()==="large"&&(this.options.advanced.robotsMeta.default=!0);return}this.options.advanced.robotsMeta.default=!1,this.options.advanced.robotsMeta.noindex=!0}},computed:{title(){return this.$t.sprintf(this.$t.__("%1$s Title",this.$td),this.object.singular)},show(){return this.options.show},noIndexDescription(){return this.$t.sprintf(this.$t.__('Choose whether your %1$s should be included in search results. If you select "No", then your %1$s will be noindexed and excluded from the sitemap so that search engines ignore them.',this.$td),this.object.label)},noindexAlertDescription(){return this.$t.sprintf(this.$t.__("Your %1$s will be noindexed and excluded from the sitemap so that search engines ignore them. You can still control how their page title looks like below.",this.$td),this.object.label)}},methods:{}},q={class:"aioseo-sa-ct-title-description"},J={class:"aioseo-description"},K={key:0};function H(t,a,e,O,i,u){const f=l("base-radio-toggle"),m=l("core-alert"),g=l("core-settings-row"),v=l("core-google-search-preview"),b=l("core-html-tags-editor");return o(),y("div",q,[d(g,{name:i.strings.showInSearchResults,align:""},{content:s(()=>[e.edit?(o(),r(f,{key:0,modelValue:e.options.show,"onUpdate:modelValue":a[0]||(a[0]=h=>e.options.show=h),name:`${e.object.name}ShowInSearch`,options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","name","options"])):n("",!0),e.edit?n("",!0):(o(),r(f,{key:1,modelValue:!0,name:`${e.object.name}ShowInSearch`,options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},null,8,["name","options"])),w("div",J,[e.options.show?(o(),y("span",K,c(u.noIndexDescription),1)):n("",!0),e.options.show?n("",!0):(o(),r(m,{key:1,type:"blue"},{default:s(()=>[_(c(u.noindexAlertDescription),1)]),_:1}))])]),_:1},8,["name"]),e.edit?(o(),r(g,{key:0,name:t.$constants.GLOBAL_STRINGS.preview},{content:s(()=>[d(v,{title:t.parseTags(e.options.title),separator:e.separator,description:t.parseTags(e.options.metaDescription)},null,8,["title","separator","description"])]),_:1},8,["name"])):n("",!0),d(g,{name:u.title},{content:s(()=>[e.edit?(o(),r(b,{key:0,modelValue:e.options.title,"onUpdate:modelValue":a[1]||(a[1]=h=>e.options.title=h),"line-numbers":!1,single:"","tags-context":`${e.object.name}Title`,"default-tags":t.$tags.getDefaultTags(e.type,e.object.name,"title")},{"tags-description":s(()=>[_(c(i.strings.clickToAddTitle),1)]),_:1},8,["modelValue","tags-context","default-tags"])):n("",!0),e.edit?n("",!0):(o(),r(b,{key:1,"line-numbers":!1,single:"","tags-context":`${e.object.name}Title`,"default-tags":t.$tags.getDefaultTags(e.type,e.object.name,"title")},{"tags-description":s(()=>[_(c(i.strings.clickToAddTitle),1)]),_:1},8,["tags-context","default-tags"]))]),_:1},8,["name"]),e.options.show?(o(),r(g,{key:1,name:i.strings.metaDescription},{content:s(()=>[e.edit?(o(),r(b,{key:0,modelValue:e.options.metaDescription,"onUpdate:modelValue":a[2]||(a[2]=h=>e.options.metaDescription=h),"line-numbers":!1,description:"","tags-context":`${e.object.name}Description`,"default-tags":t.$tags.getDefaultTags(e.type,e.object.name,"description")},{"tags-description":s(()=>[_(c(i.strings.clickToAddDescription),1)]),_:1},8,["modelValue","tags-context","default-tags"])):n("",!0),e.edit?n("",!0):(o(),r(b,{key:1,"line-numbers":!1,"tags-context":`${e.object.name}Description`,"default-tags":t.$tags.getDefaultTags(e.type,e.object.name,"description")},{"tags-description":s(()=>[_(c(i.strings.clickToAddDescription),1)]),_:1},8,["tags-context","default-tags"]))]),_:1},8,["name"])):n("",!0)])}const ce=k(E,[["render",H]]);export{de as A,ce as T};
