import{s as P,i as R,u as O,d as E,a as g,j as L,v as d}from"./isArrayLikeObject.5b92a7d2.js";import{b as A}from"./_baseIsEqual.26ab8620.js";import{k as I}from"./_getAllKeys.203cd19c.js";import{c as M,t as o,i as h,g as x,a as C}from"./cleanForSlug.d1b7ba11.js";var w=1,D=2;function G(n,r,t,i){var e=t.length,s=e,f=!i;if(n==null)return!s;for(n=Object(n);e--;){var u=t[e];if(f&&u[2]?u[1]!==n[u[0]]:!(u[0]in n))return!1}for(;++e<s;){u=t[e];var a=u[0],l=n[a],p=u[1];if(f&&u[2]){if(l===void 0&&!(a in n))return!1}else{var _=new P;if(i)var c=i(l,p,a,n,r,_);if(!(c===void 0?A(p,l,w|D,i,_):c))return!1}}return!0}function m(n){return n===n&&!R(n)}function F(n){for(var r=I(n),t=r.length;t--;){var i=r[t],e=n[i];r[t]=[i,e,m(e)]}return r}function y(n,r){return function(t){return t==null?!1:t[n]===r&&(r!==void 0||n in Object(t))}}function v(n){var r=F(n);return r.length==1&&r[0][2]?y(r[0][0],r[0][1]):function(t){return t===n||G(t,n,r)}}function S(n,r){return n!=null&&r in Object(n)}function U(n,r,t){r=M(r,n);for(var i=-1,e=r.length,s=!1;++i<e;){var f=o(r[i]);if(!(s=n!=null&&t(n,f)))break;n=n[f]}return s||++i!=e?s:(e=n==null?0:n.length,!!e&&O(e)&&E(f,e)&&(g(n)||L(n)))}function K(n,r){return n!=null&&U(n,r,S)}var N=1,T=2;function $(n,r){return h(n)&&m(r)?y(o(n),r):function(t){var i=x(t,n);return i===void 0&&i===r?K(t,n):A(r,i,N|T)}}function q(n){return function(r){return r==null?void 0:r[n]}}function H(n){return function(r){return C(r,n)}}function B(n){return h(n)?q(o(n)):H(n)}function Y(n){return typeof n=="function"?n:n==null?d:typeof n=="object"?g(n)?$(n[0],n[1]):v(n):B(n)}export{Y as b,K as h};
