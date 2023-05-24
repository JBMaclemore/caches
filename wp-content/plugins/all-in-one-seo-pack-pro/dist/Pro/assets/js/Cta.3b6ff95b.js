import{A as y}from"./WpTable.4156f8c9.js";import"./default-i18n.ab92175e.js";import"./constants.145da60f.js";import{_,q as o,o as l,c as b,z as e,k as r,a as u,t as p,x as C,j as d,l as x}from"./_plugin-vue_export-helper.a2c961b3.js";import"./index.a915b491.js";import"./SaveChanges.6857467d.js";import{C as w}from"./Blur.ff94edf5.js";import{C as S}from"./DisplayInfo.4de81241.js";import{C as $}from"./SettingsRow.010c4bbe.js";import{C as P}from"./index.24cd8e71.js";import{C as v}from"./Card.3fe33c7e.js";import{C as A}from"./Index.d2a7b6fb.js";const T={components:{CoreBlur:w,CoreDisplayInfo:S,CoreSettingsRow:$},data(){return{strings:{description:this.$t.__("Integrating with Google Maps will allow your users to find exactly where your business is located. Our interactive maps let them see your Google Reviews and get directions directly from your site. Create multiple maps for use with multiple locations.",this.$td),apiKey:this.$t.__("API Key",this.$td),mapPreview:this.$t.__("Map Preview",this.$td)},displayInfo:{block:{copy:"",desc:""}}}}},B={class:"aioseo-maps-blur"},I={class:"aioseo-settings-row"},k={class:"apikey-description"};function O(i,m,n,g,t,a){const c=o("base-input"),s=o("core-settings-row"),h=o("core-display-info"),f=o("core-blur");return l(),b("div",B,[e(f,null,{default:r(()=>[u("div",I,[u("p",k,p(t.strings.description),1)]),e(s,{name:t.strings.apiKey,align:""},{content:r(()=>[e(c,{size:"medium"})]),_:1},8,["name"]),e(h,{options:t.displayInfo},null,8,["options"]),e(s,{name:t.strings.mapPreview,align:""},{content:r(()=>[C(p(t.strings.description),1)]),_:1},8,["name"])]),_:1})])}const L=_(T,[["render",O]]),E={mixins:[y],components:{Blur:L,CoreAlert:P,CoreCard:v,Cta:A},props:{cardSlug:{type:String,required:!0},headerText:{type:String,required:!0},alignTop:Boolean},data(){return{addonSlug:"aioseo-local-business",strings:{locationSeoHeader:this.$t.__("Enable Local SEO on your Site",this.$tdPro),ctaDescription:this.$t.__("The Local SEO module is a premium feature that enables businesses to tell Google about their business, including their business name, address and phone number, opening hours and price range.  This information may be displayed as a Knowledge Graph card or business carousel in the search engine sidebar.",this.$tdPro),learnMoreText:this.$t.__("Learn more about Local SEO",this.$tdPro),showOpeningHours:this.$t.__("Show Opening Hours",this.$tdPro),googleMaps:this.$t.__("Google Maps",this.$tdPro),businessType:this.$t.__("Type",this.$tdPro),businessContact:this.$t.__("Contact Info",this.$tdPro),paymentInfo:this.$t.__("Payment Info",this.$tdPro),image:this.$t.__("Image",this.$tdPro)}}},computed:{ctaButtonText(){return this.shouldShowUpdate?this.$t.__("Update Local SEO",this.$tdPro):this.$t.__("Activate Local SEO",this.$tdPro)}},methods:{addonActivated(){window.location.reload()}}};function M(i,m,n,g,t,a){const c=o("blur"),s=o("core-card");return l(),d(s,{slug:n.cardSlug,"header-text":n.headerText,noSlide:!0},{default:r(()=>[e(c),(l(),d(x(i.ctaComponent),{"addon-slug":t.addonSlug,"cta-header":t.strings.locationSeoHeader,"cta-description":t.strings.ctaDescription,"cta-button-text":a.ctaButtonText,"learn-more-text":t.strings.learnMoreText,"learn-more-link":i.$links.getDocUrl("localSeo"),"feature-list":[t.strings.businessType,t.strings.businessContact,t.strings.paymentInfo,t.strings.image,t.strings.showOpeningHours,t.strings.googleMaps],onAddonActivated:a.addonActivated,"align-top":n.alignTop},null,40,["addon-slug","cta-header","cta-description","cta-button-text","learn-more-text","learn-more-link","feature-list","onAddonActivated","align-top"]))]),_:1},8,["slug","header-text"])}const J=_(E,[["render",M]]);export{L as B,J as C};