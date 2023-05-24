import{m as g,a as b}from"./vuex.esm-bundler.2b955043.js";import{A as f,T as A}from"./TitleDescription.93f64e81.js";import{C as v}from"./Card.3fe33c7e.js";import{C as y}from"./Tabs.33846a24.js";import{_ as C,c as r,F as T,E as $,q as i,o as t,j as c,k as s,a as p,B as D,t as k,z as l,l as x,T as B}from"./_plugin-vue_export-helper.a2c961b3.js";import"./default-i18n.ab92175e.js";import"./_commonjsHelpers.f84db168.js";import"./WpTable.4156f8c9.js";import"./index.24cd8e71.js";import"./Caret.8213645d.js";import"./Index.d2a7b6fb.js";import"./Row.f8e3a585.js";import"./helpers.ad3850ca.js";import"./RequiresUpdate.fe231e49.js";import"./postContent.ce215f52.js";import"./index.a915b491.js";import"./isArrayLikeObject.5b92a7d2.js";import"./cleanForSlug.d1b7ba11.js";import"./constants.145da60f.js";import"./html.c2b89264.js";import"./Index.e14a5090.js";import"./JsonValues.870a4901.js";import"./MaxCounts.12b45bab.js";import"./SaveChanges.6857467d.js";import"./RadioToggle.3b298d3e.js";import"./ProBadge.267c3a94.js";import"./RobotsMeta.03a16901.js";import"./Checkbox.8db0d2b3.js";import"./Checkmark.1fb57726.js";import"./SettingsRow.010c4bbe.js";import"./GoogleSearchPreview.3c1aa703.js";import"./HtmlTagsEditor.6beeae44.js";import"./Editor.d117041b.js";import"./UnfilteredHtml.fc538563.js";import"./Tooltip.876fbafa.js";import"./Slide.170b1e50.js";import"./TruSeoScore.76897846.js";import"./Information.342d90e5.js";const S={components:{Advanced:f,CoreCard:v,CoreMainTabs:y,TitleDescription:A},data(){return{internalDebounce:null,tabs:[{slug:"title-description",name:this.$t.__("Title & Description",this.$td),access:"aioseo_search_appearance_settings",pro:!1},{slug:"advanced",name:this.$t.__("Advanced",this.$td),access:"aioseo_search_appearance_settings",pro:!1}],archives:[{label:"Author Archives",name:"author",singular:"Author",icon:"dashicons-admin-users"},{label:"Date Archives",name:"date",singular:"Date",icon:"dashicons-calendar-alt"},{label:"Search Page",name:"search",singular:"Search Page",icon:"dashicons-search"}]}},computed:{...g(["options","dynamicOptions","settings"]),getArchives(){return this.archives.concat(this.$aioseo.postData.archives.map(e=>({label:`${e.label} Archives`,name:`${e.name}Archive`,icon:"dashicons-category",singular:e.singular,dynamic:!0})))}},methods:{...b(["changeTab"]),processChangeTab(e,o){this.internalDebounce||(this.internalDebounce=!0,this.changeTab({slug:`${e}Archives`,value:o}),setTimeout(()=>{this.internalDebounce=!1},50))},getOptions(e){return e.dynamic?this.dynamicOptions.searchAppearance.archives[e.name.replace("Archive","")]:this.options.searchAppearance.archives[e.name]}}},w={class:"aioseo-search-appearance-archives"};function O(e,o,j,L,m,n){const u=i("core-main-tabs"),h=i("core-card");return t(),r("div",w,[(t(!0),r(T,null,$(n.getArchives,(a,d)=>(t(),c(h,{key:d,slug:`${a.name}Archives`},{header:s(()=>[p("div",{class:D(["icon dashicons",`${a.icon||"dashicons-admin-post"}`])},null,2),p("div",null,k(a.label),1)]),tabs:s(()=>[l(u,{tabs:m.tabs,showSaveButton:!1,active:e.settings.internalTabs[`${a.name}Archives`],internal:"",onChanged:_=>n.processChangeTab(a.name,_)},null,8,["tabs","active","onChanged"])]),default:s(()=>[l(B,{name:"route-fade",mode:"out-in"},{default:s(()=>[(t(),c(x(e.settings.internalTabs[`${a.name}Archives`]),{object:a,separator:e.options.searchAppearance.global.separator,options:n.getOptions(a),type:"archives","show-bulk":!1,"no-meta-box":"","include-keywords":""},null,8,["object","separator","options"]))]),_:2},1024)]),_:2},1032,["slug"]))),128))])}const fe=C(S,[["render",O]]);export{fe as default};
