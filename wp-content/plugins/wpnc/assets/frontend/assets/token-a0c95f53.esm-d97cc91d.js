import{a6 as h,C as p,_ as r,a as d,a8 as g,b as m,d as u,f as l,a9 as w,i as f,G as W,j as y,k as C,aa as v,m as T,A as b}from"./thirdweb-checkout-3c43aa10.esm-5b75fbdb.js";import"./ethers-9af4ab57.js";import"./DropERC20_V2-40dbda2a.js";import"./DropERC721_V3-f9d09195.js";import"./DropERC1155_V2-35cc7479.js";class s extends h{constructor(t,e,n){let a=arguments.length>3&&arguments[3]!==void 0?arguments[3]:{},i=arguments.length>4?arguments[4]:void 0,o=arguments.length>5?arguments[5]:void 0,c=arguments.length>6&&arguments[6]!==void 0?arguments[6]:new p(t,e,i,a);super(c,n,o),r(this,"abi",void 0),r(this,"metadata",void 0),r(this,"roles",void 0),r(this,"encoder",void 0),r(this,"estimator",void 0),r(this,"history",void 0),r(this,"events",void 0),r(this,"platformFees",void 0),r(this,"sales",void 0),r(this,"signature",void 0),r(this,"interceptor",void 0),this.abi=i,this.metadata=new d(this.contractWrapper,g,this.storage),this.roles=new m(this.contractWrapper,s.contractRoles),this.sales=new u(this.contractWrapper),this.events=new l(this.contractWrapper),this.history=new w(this.contractWrapper,this.events),this.encoder=new f(this.contractWrapper),this.estimator=new W(this.contractWrapper),this.platformFees=new y(this.contractWrapper),this.interceptor=new C(this.contractWrapper),this.signature=new v(this.contractWrapper,this.roles)}async getVoteBalance(){return await this.getVoteBalanceOf(await this.contractWrapper.getSignerAddress())}async getVoteBalanceOf(t){return await this.erc20.getValue(await this.contractWrapper.readContract.getVotes(t))}async getDelegation(){return await this.getDelegationOf(await this.contractWrapper.getSignerAddress())}async getDelegationOf(t){return await this.contractWrapper.readContract.delegates(t)}async isTransferRestricted(){return!await this.contractWrapper.readContract.hasRole(T("transfer"),b)}async mint(t){return this.erc20.mint(t)}async mintTo(t,e){return this.erc20.mintTo(t,e)}async mintBatchTo(t){return this.erc20.mintBatchTo(t)}async delegateTo(t){return{receipt:await this.contractWrapper.sendTransaction("delegate",[t])}}async burn(t){return this.erc20.burn(t)}async burnFrom(t,e){return this.erc20.burnFrom(t,e)}async call(t){for(var e=arguments.length,n=new Array(e>1?e-1:0),a=1;a<e;a++)n[a-1]=arguments[a];return this.contractWrapper.call(t,...n)}}r(s,"contractRoles",["admin","minter","transfer"]);export{s as Token};