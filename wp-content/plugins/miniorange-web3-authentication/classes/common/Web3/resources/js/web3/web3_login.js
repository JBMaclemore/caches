let userLoginData={state:"loggedOut",ethAddress:"",buttonText:"Log in",publicName:"",config:{headers:{"Content-Type":"application/x-www-form-urlencoded"}}};var isTesting,publicAddress,is_testing_wallet_address=!1,ajaxurl=mo_web3_utility_object.ajax_url,wp_nonce=mo_web3_utility_object.wp_nonce;function checkMetamask(){if(window.ethereum){let a=document.getElementById("buttonText");a.style.cursor="not-allowed",a.disabled=!0;let b="To login, first install a Web3 wallet like the Metamask browser extension or mobile app";return showMessage("<strong>Error:</strong> "+b),1}return 0}const ethEnabled=async()=>{if(window.ethereum){try{await window.ethereum.request({method:"eth_requestAccounts"}),window.web3=new Web3(window.ethereum),ethInit()}catch(a){return showMessage(a.message,"msg"),console.log("inside ethenabled ",a),!1}return!0}};function ethInit(){ethereum.on("accountsChanged",b=>a());async function a(){try{let a=(await window.ethereum.request({method:"eth_requestAccounts"}))[0];a=a.toLowerCase()}catch(b){console.log(b)}}}async function userLoginOut(b=1,c=!1){let a="";if(isTesting=b,(a=await onConnectLoadWeb3Modal()).err){console.log("userLoginOut ",a.err);return}if(web3ModalProv){window.web3=web3ModalProv;try{userLogin(c)}catch(d){console.log("inside userLoginOut",d);return}}}async function userLogin(d){let b;try{b=await web3.eth.getAccounts()}catch(c){console.error("error ",c.message)}let a=b[0];if(null==(a=a.toLowerCase())){showMessage("<strong>Error:</strong> No wallet address found");return}jQuery.post(ajaxurl,{action:"type_of_request",request:"login",address:a,mo_web3_verify_nonce:wp_nonce},function(b){if("Error"!=b.substring(0,5)){var c,e;(c=b,e=publicAddress=a,new Promise((a,b)=>{showMessage("Waiting for your signature","msg"),web3.eth.personal.sign(web3.utils.utf8ToHex(c),e,(c,d)=>c?(console.log("",c),b({msg:c.message})):a({publicAddress:e,signature:d}))})).then(function({publicAddress:b,signature:c}){var e={action:"type_of_request",address:b,request:"auth",signature:c,mo_web3_verify_nonce:wp_nonce};jQuery.post(ajaxurl,e,async function(c){if(c.isSignatureVerified){if(isTesting)openModal(b);else{let k=c.newUserRegisteration,g=c.adminNftSetting?c.adminNftSetting:null,h=c.roleMappingSetting?c.roleMappingSetting:null,l=c.inlineFormSetting?c.inlineFormSetting:null,f=b,i=null,j=c.custom_profile_completion_redirect_url;is_testing_wallet_address&&(f=is_testing_wallet_address);let e={address:b,nonce:c.nonce};g&&(i=await checkAllNfts(f,g),e.checkNft=JSON.stringify(i)),h&&(userContract=await checkAllContracts(f,h),e.contracts=JSON.stringify(userContract)),d&&(e.redirectionUrl=d),k?(null!==j?window.location.replace(j):await getUserDetails(l),document.getElementById("userDetailSubmit").addEventListener("click",async()=>{for(var b in l)e[l[b].meta_key]=document.getElementsByName(l[b].meta_key)[0].value;if(void 0!=e.user_email){let c={action:"type_of_request",request:"emailCheck",address:a,email:e.user_email,mo_web3_verify_nonce:wp_nonce};jQuery.post(ajaxurl,c,function(a){"success"==a?(console.log("response",a),post_to_url("",e,"post")):document.getElementById("emailError").style.display="block"})}else post_to_url("",e,"post")})):post_to_url("",e,"post")}}})}).catch(a=>{console.log("error",a),showMessage("<strong>Error:</strong> "+a.msg)})}else console.log("Error: "+b)})}function openModal(a){document.getElementById("wallet_address").innerText=a,document.getElementById("moweb3_test_modal").style.display="block",document.getElementById("moweb3_display_modal").click()}function post_to_url(f,c,d){d=d||"post";var b=document.createElement("form");for(var e in b.setAttribute("method",d),b.setAttribute("action",f),c)if(c.hasOwnProperty(e)){var a=document.createElement("input");a.setAttribute("type","hidden"),a.setAttribute("name",e),a.setAttribute("value",c[e]),b.appendChild(a)}var a=document.createElement("input");a.setAttribute("type","hidden"),a.setAttribute("name","mo_web3_hiddenform_nonce"),a.setAttribute("value",wp_nonce),b.appendChild(a),document.body.appendChild(b),b.submit()}function showMessage(c,b="error"){let a;a=elementExist()?createElement():document.getElementById("customErrorMsg"),"msg"==b?a.style.borderLeftColor="#72aee6":"success"==b?a.style.borderLeftColor="#198754":a.style.borderLeftColor="#d63638",a.innerHTML=c}function elementExist(a="customErrorMsg"){return null==document.getElementById(a)}function createElement(){let a=document.createElement("p");a.setAttribute("id","customErrorMsg");let b=document.getElementsByTagName("h1")[0];return b||(b=document.getElementsByTagName("body")[0]),insertAfter(a,b),a}function insertAfter(b,a){a.parentNode.insertBefore(b,a.nextSibling)}async function getUserDetails(b){let a="";for(var c in a+='<div class="modal" id="modalWindow"  aria-labelledby="exampleModalLabel" aria-hidden="true">',a+='<div class="modal-dialog">',a+='<div class="modal-content">',a+='<div class="modal-header">',a+='<h5 class="modal-title" >Please Enter Your Details to Verify Your Account</h5>',a+="</div>",a+='<div class="modal-body">',b)required="",b[c].required&&(required="required"),a+='<div class="mb-3">',a+='<label for="'+b[c].meta_key+'" class="col-form-label">'+b[c].label+"</label>",a+='<input type="'+b[c].type+'" class="form-control" name="'+b[c].meta_key+'" '+required+">","user_email"==b[c].meta_key&&(a+='<div id="emailError" style="color:red;display:none">This email is already associated with an account</div>'),a+="</div>";a+='<button type="button" id="userDetailSubmit" class="btn btn-primary">Submit</button>',a+="</div>",a+="</div>",a+="</div>",a+="</div>",jQuery(document.body).append(a),jQuery("#modalWindow").modal()}