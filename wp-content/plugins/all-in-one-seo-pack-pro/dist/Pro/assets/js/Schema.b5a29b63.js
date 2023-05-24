import{B as S}from"./Textarea.33898a18.js";import{C as y}from"./SettingsRow.010c4bbe.js";import{_ as m,q as a,o as u,c as g,z as i,k as l,a as v,x as b,t as P,j as p,b as d}from"./_plugin-vue_export-helper.a2c961b3.js";import{b as w}from"./vuex.esm-bundler.2b955043.js";import{B as f}from"./RadioToggle.3b298d3e.js";import{C as A}from"./Blur.ff94edf5.js";import{C as k}from"./Index.d2a7b6fb.js";const j={components:{BaseTextarea:S,CoreSettingsRow:y},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data(){return{strings:{customFields:this.$t.__("Custom Fields",this.$tdPro),customFieldsDescription:this.$t.__("List of custom field names to include as post content for tags and the SEO Page Analysis. Add one per line.",this.$tdPro)}}},methods:{getSchemaTypeOption(t){return this.schemaTypes.find(o=>o.value===t)}}},C={class:"aioseo-sa-ct-custom-fields"},B={class:"aioseo-description"},O=["innerHTML"];function V(t,o,e,$,s,r){const c=a("base-textarea"),n=a("core-settings-row");return u(),g("div",C,[i(n,{name:s.strings.customFields,align:""},{content:l(()=>[i(c,{modelValue:e.options.customFields,"onUpdate:modelValue":o[0]||(o[0]=h=>e.options.customFields=h),"min-height":200},null,8,["modelValue"]),v("div",B,[b(P(s.strings.customFieldsDescription)+" ",1),v("span",{innerHTML:t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"customFields",!0)},null,8,O)])]),_:1},8,["name"])])}const X=m(j,[["render",V]]);const x={components:{BaseRadioToggle:f,CoreSettingsRow:y},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0}},data(){return{schemaTypes:{post:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$tdPro)},{value:"Dataset",label:this.$t.__("Dataset",this.$tdPro)},{value:"Movie",label:this.$t.__("Movie",this.$tdPro)},{value:"Person",label:this.$t.__("Person",this.$tdPro)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$tdPro)},{value:"Service",label:this.$t.__("Service",this.$tdPro)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],page:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$tdPro)},{value:"Dataset",label:this.$t.__("Dataset",this.$tdPro)},{value:"Movie",label:this.$t.__("Movie",this.$tdPro)},{value:"Person",label:this.$t.__("Person",this.$tdPro)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$tdPro)},{value:"Service",label:this.$t.__("Service",this.$tdPro)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}],attachment:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)}],cpt:[{value:"none",label:this.$t.__("None",this.$tdPro)},{value:"Article",label:this.$t.__("Article",this.$tdPro)},{value:"Course",label:this.$t.__("Course",this.$tdPro)},{value:"Dataset",label:this.$t.__("Dataset",this.$tdPro)},{value:"Movie",label:this.$t.__("Movie",this.$tdPro)},{value:"Person",label:this.$t.__("Person",this.$tdPro)},{value:"Product",label:this.$t.__("Product",this.$tdPro)},{value:"Recipe",label:this.$t.__("Recipe",this.$tdPro)},{value:"Service",label:this.$t.__("Service",this.$tdPro)},{value:"SoftwareApplication",label:this.$t.__("Software Application",this.$tdPro)},{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)}]},webPageTypes:{cpt:[{value:"WebPage",label:this.$t.__("Web Page",this.$tdPro)},{value:"CollectionPage",label:this.$t.__("Collection Page",this.$tdPro)},{value:"ProfilePage",label:this.$t.__("Profile Page",this.$tdPro)},{value:"ItemPage",label:this.$t.__("Item Page",this.$tdPro)},{value:"FAQPage",label:this.$t.__("FAQ Page",this.$tdPro)},{value:"RealEstateListing",label:this.$t.__("Real Estate Listing",this.$tdPro)}]},strings:{schemaType:this.$t.__("Schema Type",this.$tdPro),webPageType:this.$t.__("Web Page Type",this.$tdPro),articleType:this.$t.__("Article Type",this.$tdPro),article:this.$t.__("Article",this.$tdPro),blogPost:this.$t.__("Blog Post",this.$tdPro),newsArticle:this.$t.__("News Article",this.$tdPro)}}},methods:{getSelectOptions(t){return typeof this[t][this.object.name]<"u"?this[t][this.object.name]:this[t].cpt},getCurrentOption(t,o){return typeof this[t][this.object.name]<"u"?this[t][this.object.name].find(e=>e.value===o):this[t].cpt.find(e=>e.value===o)}}},N={class:"aioseo-sa-ct-schema"};function U(t,o,e,$,s,r){const c=a("base-select"),n=a("core-settings-row"),h=a("base-radio-toggle");return u(),g("div",N,[i(n,{name:s.strings.schemaType,align:""},{content:l(()=>[i(c,{size:"medium",class:"schema-type",options:r.getSelectOptions("schemaTypes"),modelValue:r.getCurrentOption("schemaTypes",e.options.schemaType),"onUpdate:modelValue":o[0]||(o[0]=_=>e.options.schemaType=_.value)},null,8,["options","modelValue"])]),_:1},8,["name"]),e.options.schemaType==="WebPage"?(u(),p(n,{key:0,name:s.strings.webPageType,align:""},{content:l(()=>[i(c,{size:"medium",class:"webpage-type",options:r.getSelectOptions("webPageTypes"),modelValue:r.getCurrentOption("webPageTypes",e.options.webPageType),"onUpdate:modelValue":o[1]||(o[1]=_=>e.options.webPageType=_.value)},null,8,["options","modelValue"])]),_:1},8,["name"])):d("",!0),e.options.schemaType==="Article"?(u(),p(n,{key:1,name:s.strings.articleType,align:""},{content:l(()=>[i(h,{modelValue:e.options.articleType,"onUpdate:modelValue":o[2]||(o[2]=_=>e.options.articleType=_),name:`${e.object.name}articleType`,options:[{label:s.strings.article,value:"Article"},{label:s.strings.blogPost,value:"BlogPosting"},{label:s.strings.newsArticle,value:"NewsArticle"}]},null,8,["modelValue","name","options"])]),_:1},8,["name"])):d("",!0)])}const R=m(x,[["render",U]]);const q={components:{BaseRadioToggle:f,CoreBlur:A,CoreSettingsRow:y,Cta:k},props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data(){return{schemaTypes:[{value:"none",label:this.$t.__("None",this.$td)},{value:"Article",label:this.$t.__("Article",this.$td)}],strings:{schemaType:this.$t.__("Schema Type",this.$td),articleType:this.$t.__("Article Type",this.$td),article:this.$t.__("Article",this.$td),blogPost:this.$t.__("Blog Post",this.$td),newsArticle:this.$t.__("News Article",this.$td),ctaDescription:this.$t.__("Easily generate unlimited schema markup for your content to help you rank higher in search results. Our schema validator ensures your schema works out of the box.",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Schema Generator",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Schema Generator is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")},features:[this.$t.__("Unlimited Schema",this.$td),this.$t.__("Validate with Google",this.$td),this.$t.__("Increase Rankings",this.$td),this.$t.__("Additional Schema Types",this.$td)]}},methods:{getSchemaTypeOption(t){return this.schemaTypes.find(o=>o.value===t)}}},D={class:"aioseo-sa-ct-schema-lite"};function F(t,o,e,$,s,r){const c=a("base-select"),n=a("core-settings-row"),h=a("base-radio-toggle"),_=a("core-blur"),T=a("cta");return u(),g("div",D,[i(_,null,{default:l(()=>[i(n,{name:s.strings.schemaType,align:""},{content:l(()=>[i(c,{size:"medium",class:"schema-type",options:s.schemaTypes,modelValue:r.getSchemaTypeOption("Article")},null,8,["options","modelValue"])]),_:1},8,["name"]),i(n,{name:s.strings.articleType,align:""},{content:l(()=>[i(h,{name:`${e.object.name}articleType`,modelValue:"BlogPosting",options:[{label:s.strings.article,value:"Article"},{label:s.strings.blogPost,value:"BlogPosting"},{label:s.strings.newsArticle,value:"NewsArticle"}]},null,8,["name","options"])]),_:1},8,["name"])]),_:1}),i(T,{"cta-link":t.$links.getPricingUrl("schema-markup","schema-markup-upsell"),"button-text":s.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("schema-markup",null,"home"),"feature-list":s.features},{"header-text":l(()=>[b(P(s.strings.ctaHeader),1)]),description:l(()=>[b(P(s.strings.ctaDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link","feature-list"])])}const L=m(q,[["render",F]]),W={components:{Schema:R,SchemaLite:L},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:{...w(["isUnlicensed"])}},M={class:"aioseo-sa-ct-schema-view"};function I(t,o,e,$,s,r){const c=a("schema",!0),n=a("schema-lite");return u(),g("div",M,[t.isUnlicensed?d("",!0):(u(),p(c,{key:0,type:e.type,object:e.object,options:e.options,"show-bulk":e.showBulk},null,8,["type","object","options","show-bulk"])),t.isUnlicensed?(u(),p(n,{key:1,type:e.type,object:e.object,options:e.options,"show-bulk":e.showBulk},null,8,["type","object","options","show-bulk"])):d("",!0)])}const Y=m(W,[["render",I]]);export{X as C,Y as S};
