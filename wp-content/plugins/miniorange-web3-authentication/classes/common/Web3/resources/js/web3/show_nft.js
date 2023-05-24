// console.log("inside show NFT js");
 
var cardCount =0;

    

async function showNftOwnByUser(){
    let contractAddress = '0x45DB714f24f5A313569c41683047f1d49e78Ba07';
    let walletAddress = '0xb7A8A7A8a7dC0a18057D4e41D389165f64f17b5f';

    let blockchain = "Ethereum";
    const contract = getWeb3ContractObject(TokenABIType1,contractAddress,blockchain);
    contract.defaultAccount = walletAddress;


    let Balance; 

    try {

      Balance = await contract.methods.balanceOf(walletAddress).call();
      for(let i = 0; i < Balance; i++) {
        let tokenId;
        let tokenMetadataURI;
        try {
          tokenId = await contract.methods.tokenOfOwnerByIndex(walletAddress, i).call()
          try {
            tokenMetadataURI = await contract.methods.tokenURI(tokenId).call()
            if (tokenMetadataURI.startsWith("ipfs://")) {
              tokenMetadataURI = `https://ipfs.io/ipfs/${tokenMetadataURI.split("ipfs://")[1]}`
            }
          } catch (error) {
            console.log(error);
          }
          
        } catch (error) {
          console.log(error);
        }
      }
    } catch (error) {
      console.log(error);
    }
}



async function getAdminConfiguredNftData(){
  let adminConfiguredData={
    'action':'type_of_request', 
    'request':'getAdminConfiguredNftData',
    'mo_web3_verify_nonce':wp_nonce
  };

  let adminNftSetting;
  await jQuery.post(ajaxurl,adminConfiguredData,function(response) {

    adminNftSetting = response;
  });
  
  return adminNftSetting;
}

async function showNftOwnByUserUsingApi(){

  cardCount =0;
  const adminNftSetting=await getAdminConfiguredNftData();
  // console.log("adminNftSetting",adminNftSetting);
  if(!adminNftSetting)return;

  for (const [key, value] of Object.entries(adminNftSetting)) {

    
    let blockchain        = value["blockchain"];
    let contractAddresses = value["contractAddress"];


    for(let i=0;i<contractAddresses.length;i++){

      let contractAddress = contractAddresses[i];

      let getUserHoldNFTData={
        'action':'type_of_request', 
        'request':'getUserHoldNFTData',
        'blockchain':blockchain,
        'contractAddresses':contractAddress,
        'mo_web3_verify_nonce':wp_nonce
      };
       await jQuery.post(ajaxurl,getUserHoldNFTData,function(response) {

        let nftsData=JSON.parse(response);
        let nfts =nftsData.nfts;
        let balance = nftsData.total;
        getNftData(nfts,balance,blockchain);
      });
      
    }
  }
  document.getElementById('nftLoadMsg').innerText='';
}

function isImage(url) {
  return /\.(jpg|jpeg|png|webp|avif|gif|svg)$/.test(url);
}

async function getNftData(nfts,Balance,blockchain){
  for(let i = 0; i < Balance; i++) {
    const tokenId = nfts[i].token_id;
    const contractAddress = nfts[i].contract_address;
    const contract = getWeb3ContractObject(TokenABIType1,contractAddress,blockchain);
    // console.log("getNftData",tokenId,contractAddress,contract);
    
    let tokenMetadataURI;
    
    

    try {
      tokenMetadataURI =await contract.methods.tokenURI(tokenId).call();
    } catch (error) {
      console.log(error);
      try {
        tokenMetadataURI =await contract.methods.uri(tokenId).call();
      } catch (error) {
        console.log(error);
      }
    }
    
    
    if (tokenMetadataURI.startsWith("ipfs://")) {
      tokenMetadataURI = `https://ipfs.io/ipfs/${tokenMetadataURI.split("ipfs://")[1]}`
    }
    let showNftData={
      'action':'type_of_request', 
      'request':'showNftData',
      'nftDataUri':tokenMetadataURI,
      'mo_web3_verify_nonce':wp_nonce
    };
    jQuery.post(ajaxurl,showNftData,function(response) {

      // preserve newlines, etc - use valid JSON
      response = response.replace(/\\n/g, "\\n")  
      .replace(/\\'/g, "\\'")
      .replace(/\\"/g, '\\"')
      .replace(/\\&/g, "\\&")
      .replace(/\\r/g, "\\r")
      .replace(/\\t/g, "\\t")
      .replace(/\\b/g, "\\b")
      .replace(/\\f/g, "\\f");
      // remove non-printable and other non-valid JSON chars
      response = response.replace(/[\u0000-\u0019]+/g,""); 

      const nftMetaData = JSON.parse(response);
      // console.log(tokenMetadataURI,nftMetaData);

      displayNftData(nftMetaData,contractAddress,tokenId);

    });

  }
}


function displayNftData(nftMetaData,contractAddress,tokenId){

  let mediaUrl=nftMetaData.image;
  let nftName =nftMetaData.name;
  
  if (mediaUrl.startsWith("ipfs://")) {
    mediaUrl = `https://ipfs.io/ipfs/${mediaUrl.split("ipfs://")[1]}`
  }

  let mediaHTML =`<img class="card-img-top" src="${mediaUrl}" alt="">`;;

  if(!isImage(mediaUrl)){
    mediaHTML +=   `<video class="card-img-top">`
    mediaHTML +=		`<source  src="${mediaUrl}" type="video/mp4">`;
    mediaHTML +=   `</video>`
  }

  // console.log("media url ",mediaUrl);
  let html = '';


  if(cardCount==0){
    const div = document.createElement('div');
    div.classList.add('row','mb-3');
    document.getElementById("nfts").appendChild(div);
  }


  const openseaUrl=`https://opensea.io/assets/${contractAddress}/${tokenId}`;
  html +=`<div class="card col-sm-3 m-1" style="width: 12 rem;">`;
  html +=	`<a href=${openseaUrl} target='_blank'>`;
  html +=   mediaHTML;
  html +=	`</a>`;
  html +=	`<div class="card-body">`
  html +=		`<h6 class="card-title">${nftName}</h6>`;
  html +=	`</div>`;
  html +=`</div>`;


  let container = document.getElementById("nfts");
  let lastchild = container.lastChild;
  lastchild.innerHTML+=html;

  cardCount++;
  if(cardCount%3 == 0){
    cardCount=0;
  }

}


