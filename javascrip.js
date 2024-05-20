function number(){
    var num=document.getElementById("textt").addEventListener("input",function(event){
        var x=event.target.value
        var filter=x.replace(/[^A-Z,a-z]/g, '');
        event.target.value=filter
    }
    
    )
}

function phonenumber(){
    var num=document.getElementById("nnumber").value;
    var pattern=/^[0-9]{10}$/;
    var numError=document.getElementById("numError");
    if(pattern.test(num)){
        numError.textContent="";
    } else{
        numError.textContent="enter valid number";
    }
}

function emailValidation(){
    var email=document.getElementById("emailv").value ;
    var emailpattern=/^[^\d][^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailpattern.test(email)){
       emailError.textContent=""

    }
    else{

        emailError.textContent="enter valid email"
    }

}

function pasward(){
    const paswardinput=document.getElementById("pasward");
    paswardinput.addEventListener("input",function(){
        const password=paswardinput.value;
        const strength=checkstrength(password);
        document.getElementById("paswardstrength").textContent="password Strength:"+strength;
    });

    function checkstrength(password){
        if (password.length>=8){
            return "Strong";
        }else if(password.length>=5){
            return "Medium";
        }else{
            return "Weak";
        }
    }
}
