function senhaForca(){
	var senha = document.getElementById('senha').value;
	var forca = 0;
		if((senha.length >= 4)  && (senha.length<= 7)){
			forca += 10;
		}else if (senha.length > 7){
			forca += 25;
		}
		

		if((senha.length >= 5) && (senha.match(/[a-z]+/))){
			forca +=25;
		}

		if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
			forca +=20;
		}

		if((senha.length>=7) && (senha.match(/[@#$%;*]/))){
			forca+=25;
		}
		mostrarForca(forca);
}

function mostrarForca(forca){
	//document.getElementById("impForcaSenha").innerHTML = "forca:" +forca;
	if(forca==0){
		document.getElementById("erroSenhaForca").innerHTML ='<div class="progress"><div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>';
	}
	else if(forca < 30){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
	}else if((forca >= 30) && (forca < 50)){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
	}else if((forca >= 50) && (forca < 60)){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
	}
}


function mostrarSenha(){
			var tipo =document.getElementById("senha");
				if(tipo.type =="password"){
					tipo.type = "text"
					document.getElementById('imagem').style.display = 'none';
					document.getElementById('imagem2').style.display = 'block';
					
				
				}else{
					tipo.type = "password"
					document.getElementById('imagem').style.display = 'block';
					document.getElementById('imagem2').style.display = 'none';
				}
			}