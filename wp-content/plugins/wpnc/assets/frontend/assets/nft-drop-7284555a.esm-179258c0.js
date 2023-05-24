import{w as p,C as d,_ as e,a as m,Q as u,b as g,c as C,d as w,R as f,i as v,G as A,f as W,j as T,K as y,U as b,V as E,k as R,l as k,P as S,v as h,m as N,A as U}from"./thirdweb-checkout-3c43aa10.esm-5b75fbdb.js";import{B as o}from"./ethers-9af4ab57.js";import"./DropERC20_V2-40dbda2a.js";import"./DropERC721_V3-f9d09195.js";import"./DropERC1155_V2-35cc7479.js";class c extends p{constructor(t,r,a){let n=arguments.length>3&&arguments[3]!==void 0?arguments[3]:{},s=arguments.length>4?arguments[4]:void 0,i=arguments.length>5?arguments[5]:void 0,l=arguments.length>6&&arguments[6]!==void 0?arguments[6]:new d(t,r,s,n);super(l,a,i),e(this,"abi",void 0),e(this,"encoder",void 0),e(this,"estimator",void 0),e(this,"metadata",void 0),e(this,"sales",void 0),e(this,"platformFees",void 0),e(this,"events",void 0),e(this,"roles",void 0),e(this,"interceptor",void 0),e(this,"royalties",void 0),e(this,"claimConditions",void 0),e(this,"revealer",void 0),e(this,"checkout",void 0),e(this,"erc721",void 0),e(this,"owner",void 0),this.abi=s,this.metadata=new m(this.contractWrapper,u,this.storage),this.roles=new g(this.contractWrapper,c.contractRoles),this.royalties=new C(this.contractWrapper,this.metadata),this.sales=new w(this.contractWrapper),this.claimConditions=new f(this.contractWrapper,this.metadata,this.storage),this.encoder=new v(this.contractWrapper),this.estimator=new A(this.contractWrapper),this.events=new W(this.contractWrapper),this.platformFees=new T(this.contractWrapper),this.erc721=new y(this.contractWrapper,this.storage,i),this.revealer=new b(this.contractWrapper,this.storage,E.name,()=>this.erc721.nextTokenIdToMint()),this.interceptor=new R(this.contractWrapper),this.owner=new k(this.contractWrapper),this.checkout=new S(this.contractWrapper)}onNetworkUpdated(t){this.contractWrapper.updateSignerOrProvider(t)}getAddress(){return this.contractWrapper.readContract.address}async totalSupply(){const t=await this.totalClaimedSupply(),r=await this.totalUnclaimedSupply();return t.add(r)}async getAllClaimed(t){const r=o.from((t==null?void 0:t.start)||0).toNumber(),a=o.from((t==null?void 0:t.count)||h).toNumber(),n=Math.min((await this.contractWrapper.readContract.nextTokenIdToClaim()).toNumber(),r+a);return await Promise.all(Array.from(Array(n).keys()).map(s=>this.get(s.toString())))}async getAllUnclaimed(t){const r=o.from((t==null?void 0:t.start)||0).toNumber(),a=o.from((t==null?void 0:t.count)||h).toNumber(),n=o.from(Math.max((await this.contractWrapper.readContract.nextTokenIdToClaim()).toNumber(),r)),s=o.from(Math.min((await this.contractWrapper.readContract.nextTokenIdToMint()).toNumber(),n.toNumber()+a));return await Promise.all(Array.from(Array(s.sub(n).toNumber()).keys()).map(i=>this.erc721.getTokenMetadata(n.add(i).toString())))}async totalClaimedSupply(){return this.erc721.totalClaimedSupply()}async totalUnclaimedSupply(){return this.erc721.totalUnclaimedSupply()}async isTransferRestricted(){return!await this.contractWrapper.readContract.hasRole(N("transfer"),U)}async createBatch(t,r){return this.erc721.lazyMint(t,r)}async getClaimTransaction(t,r){let a=arguments.length>2&&arguments[2]!==void 0?arguments[2]:!0;return this.erc721.getClaimTransaction(t,r,{checkERC20Allowance:a})}async claimTo(t,r){let a=arguments.length>2&&arguments[2]!==void 0?arguments[2]:!0;return this.erc721.claimTo(t,r,{checkERC20Allowance:a})}async claim(t){let r=arguments.length>1&&arguments[1]!==void 0?arguments[1]:!0;return this.claimTo(await this.contractWrapper.getSignerAddress(),t,r)}async burn(t){return this.erc721.burn(t)}async get(t){return this.erc721.get(t)}async ownerOf(t){return this.erc721.ownerOf(t)}async balanceOf(t){return this.erc721.balanceOf(t)}async balance(){return this.erc721.balance()}async isApproved(t,r){return this.erc721.isApproved(t,r)}async transfer(t,r){return this.erc721.transfer(t,r)}async setApprovalForAll(t,r){return this.erc721.setApprovalForAll(t,r)}async setApprovalForToken(t,r){return{receipt:await this.contractWrapper.sendTransaction("approve",[t,r])}}async call(t){for(var r=arguments.length,a=new Array(r>1?r-1:0),n=1;n<r;n++)a[n-1]=arguments[n];return this.contractWrapper.call(t,...a)}}e(c,"contractRoles",["admin","minter","transfer"]);export{c as NFTDrop};