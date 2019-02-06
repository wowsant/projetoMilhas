$(function () {
	$( "#tipoVeiculo" ).change(function(e) {
        e.preventDefault();
        const dados = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "/tipoVeiculo",
            async: true,
            data: dados,
            dataType: 'json',
            headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
        }).done(function(resposta) {
         	$('#marcas').empty();
            $.each(resposta.dados, function(i, dados){
            	if (dados != '' && dados != ' ') {
	                $('#marcas').append($('<option>', {
	                    value: dados,
	                    text : dados
	                }));
	        	}
            });
        });
    });

	$('#getCrawler').submit(function(e) {
    	e.preventDefault();
        const dados = $(this).serialize();
        $('tbody').empty();
        $.ajax({
            type: 'POST',
            url: "/listar",
            async: true,
            data: dados,
            dataType: 'json',
            headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
        }).done(function(resposta) {
        	if (resposta.codigo == 404) {
        		alert(resposta.dados);
        	} else {
	        	var id = 0;
	            $.each(resposta.dados, function(i, dados){
	            	id = i++;
					if (dados.modelo !== '' && dados.preco !== '' && dados.ano !== '' && dados.km !== '' && dados.acessorio !== '' && dados.cor !== '' && dados.combustivel !== '') {
						$('#dadosVeiculos tbody').append("<tr><td>" +  i + 
							"</td><td>" + dados.modelo + 
							"</td><td>" + dados.preco + 
							"</td><td>" + dados.ano + 
							"</td><td>" + dados.km + 
							"</td><td>" + dados.acessorio + 
							"</td><td>" + dados.cor + 
							"</td><td>" + dados.combustivel + 
							"</td></tr>"
						);
					} 
		        });	
        	}
        });        
    });
});