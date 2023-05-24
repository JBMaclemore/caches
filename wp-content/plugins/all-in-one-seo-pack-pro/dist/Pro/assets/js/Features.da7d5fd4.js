import{W}from"./WpTable.4156f8c9.js";import"./default-i18n.ab92175e.js";import"./constants.145da60f.js";import{_ as N,c as h,z as s,k as n,q as t,o as c,a as u,x as p,t as o,F as B,E as S,j as $,b as F,B as O}from"./_plugin-vue_export-helper.a2c961b3.js";import"./index.a915b491.js";import"./SaveChanges.6857467d.js";import{m as w,c as E,a as I}from"./vuex.esm-bundler.2b955043.js";import{B as L}from"./Checkbox.8db0d2b3.js";import{C as T}from"./ProBadge.267c3a94.js";import{G as U,a as q}from"./Row.f8e3a585.js";import{W as R,a as G,b as M}from"./Header.b3b592d9.js";import{W as j,a as D}from"./Steps.89b7a1d2.js";import"./index.24cd8e71.js";import"./Caret.8213645d.js";import"./Index.d2a7b6fb.js";import"./helpers.ad3850ca.js";import"./RequiresUpdate.fe231e49.js";import"./postContent.ce215f52.js";import"./cleanForSlug.d1b7ba11.js";import"./isArrayLikeObject.5b92a7d2.js";import"./html.c2b89264.js";import"./Index.e14a5090.js";import"./_commonjsHelpers.f84db168.js";import"./Checkmark.1fb57726.js";import"./Logo.772357e2.js";const H={components:{BaseCheckbox:L,CoreProBadge:T,GridColumn:U,GridRow:q,WizardBody:R,WizardCloseAndExit:j,WizardContainer:G,WizardHeader:M,WizardSteps:D},mixins:[W],data(){return{loading:!1,stage:"features",strings:{whichFeatures:this.$t.__("Which SEO features do you want to enable?",this.$td),description:this.$t.__("We have already selected our recommended features based on your site category, but you can use the following features to fine-tune your site.",this.$td)}}},computed:{...w(["options"]),...w("wizard",{additionalInformation:"additionalInformation",presetFeatures:"features"}),showPluginsAll(){return(this.presetFeatures.includes("analytics")||this.presetFeatures.includes("conversion-tools"))&&(this.presetFeatures.includes("image-seo")||this.presetFeatures.includes("news-sitemap")||this.presetFeatures.includes("video-sitemap")||this.presetFeatures.includes("local-seo")||this.presetFeatures.includes("redirects")||this.presetFeatures.includes("index-now")||this.presetFeatures.includes("link-assistant")||this.presetFeatures.includes("rest-api"))},showPluginsAddons(){return(!this.presetFeatures.includes("analytics")||!this.presetFeatures.includes("conversion-tools"))&&(this.presetFeatures.includes("image-seo")||this.presetFeatures.includes("news-sitemap")||this.presetFeatures.includes("video-sitemap")||this.presetFeatures.includes("local-seo")||this.presetFeatures.includes("redirects")||this.presetFeatures.includes("index-now")||this.presetFeatures.includes("link-assistant")||this.presetFeatures.includes("rest-api"))},showPluginsOnly(){return(this.presetFeatures.includes("analytics")||this.presetFeatures.includes("conversion-tools"))&&!this.presetFeatures.includes("image-seo")&&!this.presetFeatures.includes("news-sitemap")&&!this.presetFeatures.includes("video-sitemap")&&!this.presetFeatures.includes("local-seo")&&!this.presetFeatures.includes("redirects")&&!this.presetFeatures.includes("index-now")&&!this.presetFeatures.includes("link-assistant")&&!this.presetFeatures.includes("rest-api")},getPluginsText(){return this.showPluginsOnly?this.$t.sprintf(this.$t.__("The following plugins will be installed: %1$s",this.$td),this.getPluginNames):this.showPluginsAddons?this.$t.sprintf(this.$t.__("The following %1$s addons will be installed: %2$s",this.$td),"AIOSEO",this.getPluginNames):this.showPluginsAll?this.$t.sprintf(this.$t.__("The following plugins and %1$s addons will be installed: %2$s",this.$td),"AIOSEO",this.getPluginNames):null},getPluginNames(){const e=[];return this.presetFeatures.includes("analytics")&&e.push("MonsterInsights Free"),this.presetFeatures.includes("conversion-tools")&&e.push("OptinMonster"),this.presetFeatures.includes("image-seo")&&e.push("Image SEO"),this.presetFeatures.includes("local-seo")&&e.push("Local Business SEO"),this.presetFeatures.includes("video-sitemap")&&e.push("Video Sitemap"),this.presetFeatures.includes("news-sitemap")&&e.push("News Sitemap"),this.presetFeatures.includes("redirects")&&e.push("Redirects"),this.presetFeatures.includes("index-now")&&e.push("Index Now"),this.presetFeatures.includes("link-assistant")&&e.push("Link Assistant"),this.presetFeatures.includes("rest-api")&&e.push("REST API"),e.join(", ")},getFeatures(){return this.features.filter(e=>e.value!=="breadcrumbs").map(e=>(e.selected=!1,this.presetFeatures.includes(e.value)&&(e.selected=!0),e))}},methods:{...E("wizard",["updateFeatures"]),...I("wizard",["saveWizard"]),preventUncheck(e,d){d.required&&(e.preventDefault(),e.stopPropagation())},getValue(e){return this.presetFeatures.includes(e.value)},updateValue(e,d){const l=[...this.presetFeatures];if(e){l.push(d.value),this.updateFeatures(l);return}const m=l.findIndex(r=>r===d.value);m!==-1&&l.splice(m,1),this.updateFeatures(l)},saveAndContinue(){this.loading=!0,this.saveWizard("features").then(()=>{this.$router.push(this.getNextLink)})}}},J={class:"aioseo-wizard-features"},K={class:"header"},Q={class:"description"},X={class:"settings-name"},Y={class:"name small-margin"},Z={class:"aioseo-description-text"},ee={class:"go-back"},se=u("div",{class:"spacer"},null,-1),te={key:0,class:"plugins"};function ie(e,d,l,m,r,a){const v=t("wizard-header"),y=t("wizard-steps"),k=t("core-pro-badge"),g=t("grid-column"),x=t("base-checkbox"),b=t("grid-row"),f=t("router-link"),z=t("base-button"),P=t("wizard-body"),C=t("wizard-close-and-exit"),A=t("wizard-container");return c(),h("div",J,[s(v),s(A,null,{default:n(()=>[s(P,null,{footer:n(()=>[u("div",ee,[s(f,{to:e.getPrevLink,class:"no-underline"},{default:n(()=>[p("←")]),_:1},8,["to"]),p("   "),s(f,{to:e.getPrevLink},{default:n(()=>[p(o(r.strings.goBack),1)]),_:1},8,["to"])]),se,s(z,{type:"blue",loading:r.loading,onClick:a.saveAndContinue},{default:n(()=>[p(o(r.strings.saveAndContinue)+" →",1)]),_:1},8,["loading","onClick"])]),default:n(()=>[s(y),u("div",K,o(r.strings.whichFeatures),1),u("div",Q,o(r.strings.description),1),(c(!0),h(B,null,S(a.getFeatures,(i,V)=>(c(),h("div",{key:V,class:"feature-grid small-padding medium-margin"},[s(b,null,{default:n(()=>[s(g,{xs:"11"},{default:n(()=>[u("div",X,[u("div",Y,[p(o(i.name)+" ",1),e.needsUpsell(i)?(c(),$(k,{key:0})):F("",!0)]),u("div",Z,o(i.description),1)])]),_:2},1024),s(g,{xs:"1"},{default:n(()=>[s(x,{round:"",class:O({"no-clicks":i.required}),type:i.required?"green":"blue",modelValue:i.required?!0:a.getValue(i),"onUpdate:modelValue":_=>a.updateValue(_,i),onClick:_=>a.preventUncheck(_,i)},null,8,["class","type","modelValue","onUpdate:modelValue","onClick"])]),_:2},1024)]),_:2},1024)]))),128))]),_:1}),a.getPluginsText?(c(),h("div",te,o(a.getPluginsText),1)):F("",!0),s(C)]),_:1})])}const Ve=N(H,[["render",ie]]);export{Ve as default};
