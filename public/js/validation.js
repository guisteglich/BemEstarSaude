var count_error = 0
function is_valid_name(){
    let name = document.getElementById("nome")
    let error = document.getElementById('name_error')
    let name_value = name.value
    if (name_value.length < 3){
        count_error += 1
        error.innerHTML = "Nome inválido"
        return false
    }else{
        error.style = "display: none;"
        error.innerHTML = ""
        return true
    }
}

function is_valid_address(){
    let error = document.getElementById('address_error')
    let address = document.getElementById("endereco")
    let address_value = address.value
    if (!address_value.length){
        count_error += 1
        error.innerHTML = "Endereço inválido"
        return false
    }else{
        error.style = "display: none;"
        error.innerHTML = ""
        return true
    }
}

function mascara(o,f){
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}
function execmascara(){
    v_obj.value= v_fun(v_obj.value)
}
function mtel(v){
    v = v.replace(/\D/g,""); // Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g,"($1) $2"); // Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/,"$1-$2"); // Coloca hífen entre o quarto e o quinto dígitos
    return v;
}

function id( el ){
	return document.getElementById( el );
}

window.onload = function(){
	id('telefone').onkeyup = function(){
		mascara( this, mtel );
	}
}

function is_valid_email(){
    let email = document.getElementById("email").value
    var emailPattern =  /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    let error = document.getElementById('email_error')
    if (!emailPattern.test(email)){
        error.innerHTML = "E-mail inválido"
        return false
    }else{
        error.style = "display: none;"
        error.innerHTML = ""
        return true
    }
}

function is_empty(field){
    if(!field.value.length){
        alert(`O campo ${field.name} precisa ser preenchido!`)
        return false
    }else{
        return true
    }
}

function is_cpf(){
    let cpf = document.getElementById('cpf').value
    let cpf_desformatado = cpf.replace(".", "").replace(".", "").replace("-", "")
    if(cpf_desformatado.length != 11){
        alert(`O CPF é invalido!`)
        return false
    }else{
        return true
    }
}

function is_cnpj(){
    let cnpj = document.getElementById('cnpj')
    if(cnpj.value.length != 14){
        alert(`O campo CNPJ é invalido!`)
        return false
    }else{
        return true
    }
}

function send_form(){
    let form = document.forms[0].elements
    let empty = false
    document.forms[0].onsubmit = function() {
        let btn = document.getElementsByClassName('btn_submit')
        for (field of form) {
            if (field.value == ''){
                alert('Você precisa preencher os campos do formulário.')
                return false
            }
        }
        if (empty){
            return true
        }
    };
}
