var Web3 = require("web3")
var fs = require("fs");
if (typeof web3 !== 'undefined') {
    web3 = new Web3(web3.currentProvider);
} else {
    // set the provider you want from Web3.providers
    web3 = new Web3('https://mainnet.infura.io/JLEYzEEavNnSni91CvPF');
}

//转账
var from = '0x4DCC2e5113E84Fb83324579466E4409bE6259218';
var amount = 100;
var to = '0x144920C18B04B159278e48622B0ba496a20037BD';

if(!web3.utils.isAddress(to)){
    console.log('钱包地址不正确！');
    return false;
}

//执行转币
web3.eth.getTransactionCount(from, function(err, count){
    if(!err){
        var tcount = count;
        contract.methods.balanceOf(from).call( function(err, tkns){
            if (!err) {
                var balance = web3.utils.fromWei(tkns, 'ether');
                var b = new web3.utils.BN(balance)
                if(b.toNumber() < amount){
                    console.log('钱包中SWX不够此次转账！');
                    return false;
                }
                amount = web3.utils.toWei(amount);

                web3.eth.getGasPrice().then(function(gasPrice){

                    var rawTransaction = {
                        "from": from,
                        "nonce": "0x" + tcount.toString(16),
                        "gasPrice": web3.utils.toHex(gasPrice),
                        "gasLimit": web3.utils.toHex(66000),
                        "to": contractAddress,
                        "value": "0x0",
                        "data": contract.methods.transfer(to, amount).encodeABI()
                    };

                    var privKey = '0x4A810CE25DE510682777DFBA67A0A6E60BF4C3E9D749631C084C712638A7CE38';

                    web3.eth.accounts.signTransaction(rawTransaction, privKey, function(err,signed){

                        if(err){
                            console.log(err);
                            return ;
                        }

                        web3.eth.sendSignedTransaction(signed.rawTransaction, function(err, result){
                            if(!err){
                                console.log(result);
                            }else{
                                console.log(err);
                            }
                        })
                    })
                })
            }else{
                console.log(err)
            }
        })
    }else{
        console.log(error);
    }
});

