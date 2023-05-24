import{m as P,b as T,a as L}from"./vuex.esm-bundler.2b955043.js";import{C as I}from"./Card.3fe33c7e.js";import{C as M}from"./GettingStarted.f2422fd3.js";import{C as S}from"./SettingsRow.010c4bbe.js";import{N as A,b as B}from"./WpTable.4156f8c9.js";import"./default-i18n.ab92175e.js";import"./constants.145da60f.js";import{_ as f,q as l,o,c as p,z as _,k as c,a as s,t as a,x as h,j as u,b as d,B as U,C as w,P as x}from"./_plugin-vue_export-helper.a2c961b3.js";import{D as E}from"./index.a915b491.js";import"./SaveChanges.6857467d.js";import{C}from"./Table.88dc73dc.js";import{C as z}from"./Index.d2a7b6fb.js";import{S as D}from"./CheckSolid.b2a7a87b.js";import{L as H}from"./License.71d42311.js";import{C as K}from"./index.24cd8e71.js";import{u as W}from"./index.f643f0fb.js";import{a as V,b as F}from"./helpers.ad3850ca.js";import{S as q}from"./Rocket.7f9e7f29.js";import"./Tooltip.876fbafa.js";import"./Caret.8213645d.js";import"./Slide.170b1e50.js";import"./Row.f8e3a585.js";import"./Book.f077effd.js";import"./RequiresUpdate.fe231e49.js";import"./postContent.ce215f52.js";import"./cleanForSlug.d1b7ba11.js";import"./isArrayLikeObject.5b92a7d2.js";import"./html.c2b89264.js";import"./Index.e14a5090.js";import"./_commonjsHelpers.f84db168.js";import"./client.4d177be2.js";const R={mixins:[A],components:{CoreWpTable:C,Cta:z,SvgCircleCheckSolid:D},data(){return{bulkOptions:[{label:this.$t.__("Activate License",this.$td),value:"activate-license"},{label:this.$t.__("Deactivate License",this.$td),value:"deactivate-license"}],strings:{activate:this.$t.__("Activate",this.$td),deactivate:this.$t.__("Deactivate",this.$td),visitSite:this.$t.__("Visit Site",this.$td),dashboard:this.$t.__("Dashboard",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("This feature is not available in your current plan.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade Your Plan and Unlock Network Tools",this.$td),networkDatabaseToolsDescription:this.$t.__("Unlock network-level tools to manage all your sites from one easy-to-use location. Manage your license key activations for each individual domain.",this.$td)}}},computed:{columns(){return[{slug:"domain",label:this.$t.__("Domain",this.$td)},{slug:"path",label:this.$t.__("Path",this.$td)},{slug:"primary_domain",label:this.$t.__("Alias Of",this.$td)},{slug:"activated",label:this.$t.__("Activated",this.$td),width:"90px"}]},rows(){return[{blog_id:1,path:"/",domain:"aioseo.com"},{blog_id:2,path:"/",domain:"wpbeginner.com"},{blog_id:3,path:"/",domain:"wpforms.com"},{blog_id:4,path:"/",domain:"optinmonster.com"},{blog_id:5,path:"/",domain:"monsterinsights.com"},{blog_id:8,path:"/",domain:"seedprod.com"},{blog_id:10,path:"/",domain:"easydigitaldownloads.com"}]},totals(){return{total:this.rows.length,pages:1,page:1}},filters(){return[{slug:"all",name:this.$t.__("All",this.$td)},{slug:"activated",name:this.$t.__("Activated",this.$td)},{slug:"deactivated",name:this.$t.__("Deactivated",this.$td)}]}}},G={class:"aioseo-settings-network-sites-activation"},Y={class:"row-actions"},Z={class:"activate",href:"#"},j={class:"view-site",href:"#",target:"_blank"},J={class:"dashboard",href:"#",target:"_blank"};function Q(e,r,g,k,t,n){const m=l("svg-circle-check-solid"),v=l("cta"),$=l("core-wp-table");return o(),p("div",G,[_($,{columns:n.columns,rows:n.rows,totals:n.totals,filters:n.filters,"bulk-options":t.bulkOptions,"blur-rows":"","disable-table":""},{domain:c(({row:y})=>[s("span",null,a(y.domain),1),s("div",Y,[s("span",null,[s("a",Z,[s("span",null,a(t.strings.activate),1)]),h(" | ")]),s("span",null,[s("a",j,[s("span",null,a(t.strings.visitSite),1)]),h(" | ")]),s("span",null,[s("a",J,[s("span",null,a(t.strings.dashboard),1)])])])]),activated:c(()=>[s("span",null,[_(m)])]),cta:c(()=>[_(v,{"cta-link":e.$links.getPricingUrl("network-tools","network-sites-activation"),"button-text":t.strings.ctaButtonText,"learn-more-link":e.$links.getUpsellUrl("network-tools","network-sites-activation","home")},{"header-text":c(()=>[h(a(t.strings.ctaHeader),1)]),description:c(()=>[h(a(t.strings.networkDatabaseToolsDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link"])]),_:1},8,["columns","rows","totals","filters","bulk-options"])])}const X=f(R,[["render",Q]]);const ee={components:{CoreAlert:K,CoreSettingsRow:S},mixins:[H],data(){return{loading:!1,deactivating:!1,error:null,localLicenseKey:null,strings:{purchasedBoldText:this.$t.sprintf("<strong>%1$s %2$s</strong>","All in One SEO","Pro"),licenseKey:this.$t.__("License Key",this.$tdPro),licenseKeyDescription:this.$t.__("Your license key provides access to updates and addons.",this.$tdPro),placeholder:this.$t.__("Paste your license key here",this.$tdPro),connect:this.$t.__("Connect",this.$tdPro),deactivate:this.$t.__("Deactivate this license key",this.$tdPro),aValidLicenseIsRequired:this.$t.__("A valid license key is required in order to enable Pro features and continue to receive automatic updates.",this.$tdPro),purchaseLicense:this.$t.__("Purchase License",this.$tdPro),errors:{licenseKey:{invalid:this.$t.__("The license key provided is invalid. Please use a different key to continue receiving automatic updates.",this.$tdPro),disabled:this.$t.__("The license key provided is disabled. Please use a different key to continue receiving automatic updates.",this.$tdPro),maxReached:this.$t.__("This license key has reached the maximum number of activations. Please deactivate it from another site or purchase a new license to continue receiving automatic updates.",this.$tdPro),apiError:this.$t.__("There was an error connecting to the licensing API. Please try again later.",this.$tdPro),unknown:this.$t.__("An unknown error occurred, please try again later.",this.$tdPro)}},networkPlanIsActive:this.$t.sprintf(this.$t.__("Your license key has been set at the network level of your %1$s. If you would like to use a different license for this subsite, you can enter it below.",this.$tdPro)+" 🙂","WordPress Multisite")}}},computed:{...P({stateInternalOptions:"internalOptions",stateNetworkOptions:"internalNetworkOptions",options:"options",license:"license"}),...T(["licenseKey"]),internalOptions(){return this.$aioseo.data.isNetworkAdmin?this.stateNetworkOptions:this.stateInternalOptions},enterKey(){return this.$t.sprintf(this.$t.__("Enter your license key below to activate %1$s!",this.$tdPro),this.strings.purchasedBoldText)},planIsActive(){return this.$t.sprintf(this.$t.__("Your %1$s plan is active!",this.$tdPro)+" 🙂",this.strings.purchasedBoldText)},licenseKeyTypeExpiration(){const e=this.internalOptions.internal.license.expires?E.fromMillis(this.internalOptions.internal.license.expires*1e3).toFormat("MM/dd/yyyy"):null,r=this.internalOptions.internal.license.expires?this.$t.sprintf(this.$t.__("(expires: %1$s)",this.$tdPro),"<strong>"+e+"</strong>"):"",g="<strong>"+W(this.internalOptions.internal.license.level)+"</strong>";return this.$t.sprintf(this.$t.__("Your license level is %1$s %2$s",this.$tdPro),g,r)},licenseKeyExpired(){return this.$t.sprintf(this.$t.__("The license key provided has expired. Please %1$srenew your license%2$s to continue receiving automatic updates.",this.$tdPro),'<a href="'+this.$links.utmUrl("general-settings","license-box-error")+'">',"</a>")}},methods:{...L(["activate","deactivate"]),processActivateLicense(){if(this.error=null,this.loading=!0,/[^\w\s-]/.test(this.licenseKey)){this.error=this.strings.errors.licenseKey.invalid,this.loading=!1;return}this.activate(this.localLicenseKey).then(()=>{this.loading=!1,this.$aioseo.internalOptions.internal.license.expired=!1}).catch(e=>{if(this.localLicenseKey=null,this.loading=!1,!e||!e.response||!e.response.body||!e.response.body.error||!e.response.body.licenseData){this.error=this.strings.errors.licenseKey.unknown;return}const r=e.response.body.licenseData;r.invalid?this.error=this.strings.errors.licenseKey.invalid:r.disabled?this.error=this.strings.errors.licenseKey.disabled:r.expired?this.error=this.licenseKeyExpired:r.activationsError?this.error=this.strings.errors.licenseKey.maxReached:(r.connectionError||r.requestError)&&(this.error=this.strings.errors.licenseKey.apiError)})},processDeactivate(){this.loading=!0,this.deactivating=!0,this.error=null,this.$store.commit("updateInternalOption",{groups:["internal","license"],key:"expired",value:!1}),this.$aioseo.internalOptions.internal.license.expired=!1,this.deactivate().then(()=>this.localLicenseKey=null).then(()=>this.deactivating=!1).then(()=>this.loading=!1)}},mounted(){this.localLicenseKey=this.licenseKey}},te=["innerHTML"],se=["innerHTML"],ie={class:"buttons"},ne={class:"license-key"},oe=s("input",{type:"text",name:"username",autocomplete:"username",style:{display:"none"}},null,-1),ae=["innerHTML"];function re(e,r,g,k,t,n){const m=l("core-alert"),v=l("base-button"),$=l("base-input"),y=l("core-settings-row");return o(),u(y,{name:t.strings.licenseKey},{description:c(()=>[h(a(t.strings.licenseKeyDescription),1)]),content:c(()=>[!e.licenseKey&&(!e.$aioseo.data.isNetworkLicensed||e.$aioseo.data.isNetworkAdmin)?(o(),p("div",{key:0,innerHTML:n.enterKey},null,8,te)):d("",!0),e.license.isActive&&(!e.$aioseo.data.isNetworkLicensed||e.$aioseo.data.isNetworkAdmin)?(o(),p("div",{key:1,innerHTML:n.planIsActive},null,8,se)):d("",!0),!e.licenseKey&&!e.$aioseo.data.isNetworkAdmin&&e.$aioseo.data.isNetworkLicensed?(o(),u(m,{key:2,class:"license-key-alert",type:"green",innerHTML:t.strings.networkPlanIsActive},null,8,["innerHTML"])):d("",!0),e.licenseKey&&!e.license.isActive?(o(),u(m,{key:3,class:"license-key-alert",type:"red"},{default:c(()=>[s("strong",null,a(e.yourLicenseIsText),1),h(" "+a(t.strings.aValidLicenseIsRequired)+" ",1),s("div",ie,[_(v,{type:"green",size:"small",tag:"a",target:"_blank",href:e.$links.getUpsellUrl("feature-manager-upgrade","no-license-key","pricing")},{default:c(()=>[h(a(t.strings.purchaseLicense),1)]),_:1},8,["href"])])]),_:1})):d("",!0),s("form",ne,[oe,_($,{type:"password",class:U({"aioseo-active":e.licenseKey,"aioseo-error":t.error&&!e.licenseKey||e.licenseKey&&!e.license.isActive}),placeholder:t.strings.placeholder,readonly:!!e.licenseKey,disabled:!!e.licenseKey,"append-icon":"circle-check",modelValue:t.localLicenseKey,"onUpdate:modelValue":r[0]||(r[0]=i=>t.localLicenseKey=i),autocomplete:"new-password"},null,8,["class","placeholder","readonly","disabled","modelValue"]),!e.licenseKey||t.deactivating?(o(),u(v,{key:0,type:"green",onClick:w(n.processActivateLicense,["prevent"]),loading:t.loading,disabled:!t.localLicenseKey},{default:c(()=>[h(a(t.strings.connect),1)]),_:1},8,["onClick","loading","disabled"])):d("",!0)]),t.error?(o(),u(m,{key:4,class:"license-key-error",type:"red",innerHTML:t.error},null,8,["innerHTML"])):d("",!0),n.internalOptions.internal.license.level?(o(),p("div",{key:5,innerHTML:n.licenseKeyTypeExpiration,class:"aioseo-description"},null,8,ae)):d("",!0),e.licenseKey&&e.$allowed("aioseo_admin")?(o(),p("a",{key:6,class:"deactivate-license",href:"#",onClick:r[1]||(r[1]=w((...i)=>n.processDeactivate&&n.processDeactivate(...i),["prevent"]))},a(t.strings.deactivate),1)):d("",!0)]),_:1},8,["name"])}const le=f(ee,[["render",re]]),ce={},de={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-circle-close-solid"},he=s("path",{d:"M8.4748 17.0008L11.9998 13.4758L15.5248 17.0008L16.9998 15.5258L13.4748 12.0008L16.9998 8.47578L15.5248 7.00078L11.9998 10.5258L8.4748 7.00078L6.9998 8.47578L10.5248 12.0008L6.9998 15.5258L8.4748 17.0008ZM11.9998 22.2008C10.5831 22.2008 9.2538 21.9341 8.0118 21.4008C6.77047 20.8674 5.69147 20.1424 4.7748 19.2258C3.85814 18.3091 3.13314 17.2301 2.5998 15.9888C2.06647 14.7468 1.7998 13.4174 1.7998 12.0008C1.7998 10.5841 2.06647 9.25478 2.5998 8.01278C3.13314 6.77145 3.85814 5.69245 4.7748 4.77578C5.69147 3.85911 6.77047 3.13411 8.0118 2.60078C9.2538 2.06745 10.5831 1.80078 11.9998 1.80078C13.4165 1.80078 14.7458 2.06745 15.9878 2.60078C17.2291 3.13411 18.3081 3.85911 19.2248 4.77578C20.1415 5.69245 20.8665 6.77145 21.3998 8.01278C21.9331 9.25478 22.1998 10.5841 22.1998 12.0008C22.1998 13.4174 21.9331 14.7468 21.3998 15.9888C20.8665 17.2301 20.1415 18.3091 19.2248 19.2258C18.3081 20.1424 17.2291 20.8674 15.9878 21.4008C14.7458 21.9341 13.4165 22.2008 11.9998 22.2008Z",fill:"currentColor"},null,-1),ue=[he];function pe(e,r){return o(),p("svg",de,ue)}const _e=f(ce,[["render",pe]]);const me={mixins:[A,B],components:{CoreAlert:K,CoreWpTable:C,SvgCircleCheckSolid:D,SvgCircleCloseSolid:_e},data(){return{tableId:"network-site-activations-wp-table",changeItemsPerPageSlug:"networkDomains",bulkOptions:[{label:this.$t.__("Activate License",this.$tdPro),value:"activate-license"},{label:this.$t.__("Deactivate License",this.$tdPro),value:"deactivate-license"}],strings:{selectSites:this.$t.__("By default, your license key is activated on the primary domain for this network. To activate the license key on additional sites, select them below.",this.$tdPro),activate:this.$t.__("Activate",this.$tdPro),deactivate:this.$t.__("Deactivate",this.$tdPro),visitSite:this.$t.__("Visit Site",this.$tdPro),dashboard:this.$t.__("Dashboard",this.$tdPro)}}},computed:{...P(["networkData"]),columns(){return[{slug:"domain",label:this.$t.__("Domain",this.$tdPro),sortable:!0,sortDir:this.orderBy==="domain"?this.orderDir:"asc",sorted:this.orderBy==="domain"},{slug:"path",label:this.$t.__("Path",this.$tdPro),sortable:!0,sortDir:this.orderBy==="path"?this.orderDir:"asc",sorted:this.orderBy==="path"},{slug:"primary_domain",label:this.$t.__("Alias Of",this.$tdPro)},{slug:"activated",label:this.$t.__("Activated",this.$tdPro),width:"95px"}]},rows(){return this.getSites.map(e=>(this.isMainSite(e.domain,e.path)&&(e.preventBulkAction=!0),e.rowIndex="uniqueId",e.uniqueId=this.getUniqueSiteId(e),e))},totals(){return{total:this.networkData.sites.total,pages:Math.ceil(this.networkData.sites.total/this.networkData.sites.limit)||1,page:this.pageNumber}},filters(){return[{slug:"all",name:this.$t.__("All",this.$tdPro),active:this.filter==="all"},{slug:"activated",name:this.$t.__("Activated",this.$tdPro),active:this.filter==="activated"},{slug:"deactivated",name:this.$t.__("Deactivated",this.$tdPro),active:this.filter==="deactivated"}]}},methods:{...L({multisite:"multisite",fetchData:"fetchNetworkSites"}),activateDomain(e){this.wpTableLoading=!0,this.multisite({activate:[e]}).then(()=>{this.wpTableLoading=!1})},deactivateDomain(e){this.wpTableLoading=!0,this.multisite({deactivate:[e]}).then(()=>{this.wpTableLoading=!1})},maybeDoBulkAction({action:e,selectedRows:r}){this.wpTableLoading=!0;const g=e==="activate-license"?V(r,this.activeSitesIds):[],k=e==="deactivate-license"?F(r,this.activeSitesIds):[];if(!g.length&&!k.length){this.wpTableLoading=!1;return}this.multisite({activate:this.parseSiteValue(g),deactivate:this.parseSiteValue(k)}).then(()=>{this.wpTableLoading=!1})}}},ge={class:"aioseo-settings-network-sites-activation"},ve={class:"row-actions"},$e={key:0},ye=["onClick"],ke={key:1},fe=["onClick"],be=["href"],we=["href"],Pe={key:0};function Te(e,r,g,k,t,n){const m=l("core-alert"),v=l("svg-circle-check-solid"),$=l("svg-circle-close-solid"),y=l("core-wp-table");return o(),p("div",ge,[_(m,{type:"blue"},{default:c(()=>[h(a(t.strings.selectSites),1)]),_:1}),_(y,{id:t.tableId,"bulk-options":t.bulkOptions,columns:n.columns,filters:n.filters,"initial-items-per-page":e.$aioseo.settings.tablePagination.networkDomains,"initial-page-number":e.pageNumber,loading:e.wpTableLoading,rows:n.rows,totals:n.totals,"show-items-per-page":"",onFilterTable:e.processFilterTable,onPaginate:e.processPagination,onProcessBulkAction:n.maybeDoBulkAction,onProcessChangeItemsPerPage:e.processChangeItemsPerPage,onSearch:e.processSearch,onSortColumn:e.processSort},{domain:c(({row:i})=>[s("span",null,a(i.domain),1),s("div",ve,[!e.isSiteActive(i)&&!e.isMainSite(i.domain,i.path)?(o(),p("span",$e,[s("a",{class:"activate",href:"#",onClick:w(b=>n.activateDomain(i),["stop","prevent"]),target:"_blank"},[s("span",null,a(t.strings.activate),1)],8,ye),h(" | ")])):d("",!0),e.isSiteActive(i)&&!e.isMainSite(i.domain,i.path)?(o(),p("span",ke,[s("a",{class:"deactivate",href:"#",onClick:w(b=>n.deactivateDomain(i),["stop","prevent"]),target:"_blank"},[s("span",null,a(t.strings.deactivate),1)],8,fe),h(" | ")])):d("",!0),s("span",null,[s("a",{class:"view-site",href:i.homeUrl,target:"_blank"},[s("span",null,a(t.strings.visitSite),1)],8,be),h(" | ")]),s("span",null,[s("a",{class:"dashboard",href:i.adminUrl,target:"_blank"},[s("span",null,a(t.strings.dashboard),1)],8,we)])])]),activated:c(({row:i})=>[s("span",null,[e.isSiteActive(i)?(o(),u(v,{key:0})):d("",!0),e.isSiteActive(i)?d("",!0):(o(),u($,{key:1}))])]),primary_domain:c(({row:i})=>[i.parentDomain?(o(),p("span",Pe,a(i.parentDomain+i.parentPath),1)):d("",!0)]),_:1},8,["id","bulk-options","columns","filters","initial-items-per-page","initial-page-number","loading","rows","totals","onFilterTable","onPaginate","onProcessBulkAction","onProcessChangeItemsPerPage","onSearch","onSortColumn"])])}const Le=f(me,[["render",Te]]);const Se={components:{CoreCard:I,CoreGettingStarted:M,CoreSettingsRow:S,LiteSettingsNetworkSitesActivation:X,SettingsLicenseKey:le,SettingsNetworkSitesActivation:Le,SvgRocket:q},data(){return{strings:{license:this.$t.__("License",this.$td),boldText:this.$t.sprintf("<strong>%1$s %2$s</strong>","All in One SEO",this.$t.__("Free",this.$td)),purchasedBoldText:this.$t.sprintf("<strong>%1$s %2$s</strong>","All in One SEO","Pro"),linkText:this.$t.sprintf(this.$t.__("upgrading to %1$s",this.$td),"Pro"),moreBoldText:this.$t.sprintf("<strong>%1$s</strong>",this.$constants.DISCOUNT_PERCENTAGE+" "+this.$t.__("off",this.$td)),setupWizard:this.$t.__("Setup Wizard",this.$td),relaunchSetupWizard:this.$t.__("Relaunch Setup Wizard",this.$td),setupWizardText:this.$t.sprintf(this.$t.__("Use our configuration wizard to properly set up %1$s with your WordPress website.",this.$td),"All in One SEO"),domainActivations:this.$t.__("Domain Activations",this.$td)}}},computed:{...T(["settings","isUnlicensed"]),link(){return this.$t.sprintf('<strong><a href="%1$s" target="_blank">%2$s</a></strong>',this.$links.utmUrl("general-settings","license-box-tooltip"),this.strings.linkText)},tooltipText(){return this.$t.sprintf(this.$t.__("To unlock more features, consider %1$s.",this.$td),this.link)},moreToolTipText(){return this.$t.sprintf(this.$t.__("As a valued user you receive %1$s, automatically applied at checkout!",this.$td),this.strings.moreBoldText)}}},Ae={class:"aioseo-general-settings"},Ce=["innerHTML"],De=s("br",null,null,-1),Ke=["innerHTML"],Oe={class:"aioseo-description"};function Ne(e,r,g,k,t,n){const m=l("core-getting-started"),v=l("settings-license-key"),$=l("svg-rocket"),y=l("base-button"),i=l("core-settings-row"),b=l("core-card"),O=l("settings-network-sites-activation"),N=l("lite-settings-network-sites-activation");return o(),p("div",Ae,[e.settings.showSetupWizard&&e.$allowed("aioseo_setup_wizard")&&!e.$aioseo.data.isNetworkAdmin?(o(),u(m,{key:0})):d("",!0),_(b,{slug:"license","header-text":t.strings.license},x({default:c(()=>[_(v),!e.settings.showSetupWizard&&e.$allowed("aioseo_setup_wizard")&&!e.$aioseo.data.isNetworkAdmin?(o(),u(i,{key:0,name:t.strings.setupWizard},{content:c(()=>[_(y,{type:"blue",size:"medium",tag:"a",href:e.$aioseo.urls.aio.wizard},{default:c(()=>[_($),h(" "+a(t.strings.relaunchSetupWizard),1)]),_:1},8,["href"]),s("p",Oe,a(t.strings.setupWizardText),1)]),_:1},8,["name"])):d("",!0)]),_:2},[e.$isPro?void 0:{name:"tooltip",fn:c(()=>[s("div",{innerHTML:n.tooltipText},null,8,Ce),De,s("div",{class:"more-tooltip-text",innerHTML:n.moreToolTipText},null,8,Ke)]),key:"0"}]),1032,["header-text"]),e.$aioseo.data.isNetworkAdmin?(o(),u(b,{key:1,slug:"domainActivations","header-text":t.strings.domainActivations},{default:c(()=>[!e.isUnlicensed&&e.$license.hasCoreFeature(e.$aioseo,"tools","network-tools-site-activation")?(o(),u(O,{key:0})):d("",!0),e.isUnlicensed||!e.$license.hasCoreFeature(e.$aioseo,"tools","network-tools-site-activation")?(o(),u(N,{key:1})):d("",!0)]),_:1},8,["header-text"])):d("",!0)])}const ht=f(Se,[["render",Ne]]);export{ht as default};
