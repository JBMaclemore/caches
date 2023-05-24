import{a6 as h,C as d,_ as a,a as p,a7 as l,b as g,i as m,G as u,f as w,d as f,j as C,k as W,R as v,m as y,A as R}from"./thirdweb-checkout-3c43aa10.esm-5b75fbdb.js";import"./ethers-9af4ab57.js";import"./DropERC20_V2-40dbda2a.js";import"./DropERC721_V3-f9d09195.js";import"./DropERC1155_V2-35cc7479.js";class s extends h{constructor(t,e,r){let n=arguments.length>3&&arguments[3]!==void 0?arguments[3]:{},i=arguments.length>4?arguments[4]:void 0,o=arguments.length>5?arguments[5]:void 0,c=arguments.length>6&&arguments[6]!==void 0?arguments[6]:new d(t,e,i,n);super(c,r,o),a(this,"abi",void 0),a(this,"metadata",void 0),a(this,"roles",void 0),a(this,"encoder",void 0),a(this,"estimator",void 0),a(this,"sales",void 0),a(this,"platformFees",void 0),a(this,"events",void 0),a(this,"claimConditions",void 0),a(this,"interceptor",void 0),this.abi=i,this.metadata=new p(this.contractWrapper,l,this.storage),this.roles=new g(this.contractWrapper,s.contractRoles),this.encoder=new m(this.contractWrapper),this.estimator=new u(this.contractWrapper),this.events=new w(this.contractWrapper),this.sales=new f(this.contractWrapper),this.platformFees=new C(this.contractWrapper),this.interceptor=new W(this.contractWrapper),this.claimConditions=new v(this.contractWrapper,this.metadata,this.storage)}async getVoteBalance(){return await this.getVoteBalanceOf(await this.contractWrapper.getSignerAddress())}async getVoteBalanceOf(t){return await this.erc20.getValue(await this.contractWrapper.readContract.getVotes(t))}async getDelegation(){return await this.getDelegationOf(await this.contractWrapper.getSignerAddress())}async getDelegationOf(t){return await this.contractWrapper.readContract.delegates(t)}async isTransferRestricted(){return!await this.contractWrapper.readContract.hasRole(y("transfer"),R)}async claim(t){let e=arguments.length>1&&arguments[1]!==void 0?arguments[1]:!0;return this.claimTo(await this.contractWrapper.getSignerAddress(),t,e)}async claimTo(t,e){let r=arguments.length>2&&arguments[2]!==void 0?arguments[2]:!0;return this.erc20.claimTo(t,e,{checkERC20Allowance:r})}async delegateTo(t){return{receipt:await this.contractWrapper.sendTransaction("delegate",[t])}}async burnTokens(t){return this.erc20.burn(t)}async burnFrom(t,e){return this.erc20.burnFrom(t,e)}async call(t){for(var e=arguments.length,r=new Array(e>1?e-1:0),n=1;n<e;n++)r[n-1]=arguments[n];return this.contractWrapper.call(t,...r)}}a(s,"contractRoles",["admin","transfer"]);export{s as TokenDrop};
