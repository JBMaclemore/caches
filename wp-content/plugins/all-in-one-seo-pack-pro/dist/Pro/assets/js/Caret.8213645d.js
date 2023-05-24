import{_ as s,c,B as f,o,a as l,j as d,k as v,l as C,q as h,m as u,b as p}from"./_plugin-vue_export-helper.a2c961b3.js";const b={props:{dark:Boolean}},y=l("div",{class:"double-bounce1"},null,-1),w=l("div",{class:"double-bounce2"},null,-1),B=[y,w];function x(t,n,e,i,g,L){return o(),c("div",{class:f(["aioseo-loading-spinner",{dark:e.dark}])},B,2)}const k=s(b,[["render",x]]);const $={name:"base-button",components:{CoreLoader:k},props:{color:String,tag:{type:String,default:"button",description:"Button html tag"},block:Boolean,loading:Boolean,wide:Boolean,disabled:Boolean,type:{type:String,default:"default",description:"Button type (blue|black|green|red|gray|wp-blue)"},nativeType:{type:String,default:"button",description:"Button native type (e.g button, input etc)"},size:{type:String,default:"",description:"Button size (small-table|small|medium|large)"},link:{type:Boolean,description:"Whether button is a link (no borders or background)"},to:{type:[Object,String],description:"The router link object or string"}}};function S(t,n,e,i,g,L){const m=h("core-loader");return o(),d(C(e.tag),{type:e.tag==="button"?e.nativeType:"",disabled:e.disabled||e.loading,to:e.tag==="router-link"?e.to:"",onMouseenter:n[0]||(n[0]=a=>t.$emit("mouseenter",a)),onMouseleave:n[1]||(n[1]=a=>t.$emit("mouseleave",a)),class:f(["aioseo-button",[{[e.type]:e.type},{[e.size]:e.size},{"btn-link":e.link},{disabled:e.disabled&&e.tag!=="button"},{color:e.color},{loading:e.loading}]])},{default:v(()=>[u(t.$slots,"loading",{},()=>[e.loading?(o(),d(m,{key:0,dark:e.type==="gray"},null,8,["dark"])):p("",!0)]),u(t.$slots,"default")]),_:3},40,["type","disabled","to","class"])}const te=s($,[["render",S]]),M={},Z={viewBox:"0 0 12 12",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-close"},T=l("path",{d:"M11.8211 1.3415L10.6451 0.166504L5.98305 4.82484L1.32097 0.166504L0.14502 1.3415L4.80711 5.99984L0.14502 10.6582L1.32097 11.8332L5.98305 7.17484L10.6451 11.8332L11.8211 10.6582L7.159 5.99984L11.8211 1.3415Z",fill:"currentColor"},null,-1),z=[T];function j(t,n){return o(),c("svg",Z,z)}const ne=s(M,[["render",j]]),A={},V={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-circle-check"},N=l("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM10 14.17L16.59 7.58L18 9L10 17L6 13L7.41 11.59L10 14.17Z",fill:"currentColor"},null,-1),P=[N];function q(t,n){return o(),c("svg",V,P)}const oe=s(A,[["render",q]]),D={},E={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-circle-close"},H=l("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M12 2.00006C6.47 2.00006 2 6.47006 2 12.0001C2 17.5301 6.47 22.0001 12 22.0001C17.53 22.0001 22 17.5301 22 12.0001C22 6.47006 17.53 2.00006 12 2.00006ZM14.59 8.00006L12 10.5901L9.41 8.00006L8 9.41006L10.59 12.0001L8 14.5901L9.41 16.0001L12 13.4101L14.59 16.0001L16 14.5901L13.41 12.0001L16 9.41006L14.59 8.00006ZM4 12.0001C4 16.4101 7.59 20.0001 12 20.0001C16.41 20.0001 20 16.4101 20 12.0001C20 7.59006 16.41 4.00006 12 4.00006C7.59 4.00006 4 7.59006 4 12.0001Z",fill:"currentColor"},null,-1),O=[H];function R(t,n){return o(),c("svg",E,O)}const se=s(D,[["render",R]]),U={},W={viewBox:"0 0 12 12",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-pencil"},F=l("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M9.71515 0.919167L11.0802 2.28417C11.3077 2.51167 11.3077 2.87917 11.0802 3.10667L10.0126 4.17417L7.82515 1.98667L8.89265 0.919167C9.00348 0.808333 9.14932 0.75 9.30098 0.75C9.45265 0.75 9.59848 0.8025 9.71515 0.919167ZM0.749268 11.25V9.06252L7.20093 2.61086L9.38843 4.79836L2.93677 11.25H0.749268Z",fill:"currentColor"},null,-1),G=[F];function I(t,n){return o(),c("svg",W,G)}const le=s(U,[["render",I]]);let _,r;const ce=(t,n)=>((...e)=>{const i=()=>t(...e);clearTimeout(_),_=setTimeout(i,n)}).call(),ie=function(t,n){r&&clearTimeout(r),r=setTimeout(t,n)},J={},K={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-caret"},Q=l("path",{d:"M16.59 8.29492L12 12.8749L7.41 8.29492L6 9.70492L12 15.7049L18 9.70492L16.59 8.29492Z",fill:"currentColor"},null,-1),X=[Q];function Y(t,n){return o(),c("svg",K,X)}const ae=s(J,[["render",Y]]);export{te as B,k as C,ne as S,oe as a,ae as b,se as c,ie as d,le as e,ce as f};
