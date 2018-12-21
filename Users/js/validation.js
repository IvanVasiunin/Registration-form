let dontUse = [' ',',','.','`','~','!','@','#','$','%','^',':',';','&','*','(',')','+','=','/','|','<','>'];
let counter = 0;


function validation(elem){
	let firstCheck = true;
	$(elem).keyup(function(e){
		for (var i = 0; i < dontUse.length; i++) 
		{
			if($(elem).val().indexOf(dontUse[i]) != -1)
			{
				console.log(dontUse[i]);
				if(elem == 'input[name="email"]' && (dontUse[i] == '@' || dontUse[i] == '.'))
				{
					continue;
				}
				$(elem).css({
						'outline':'1px solid #b8072b',
						'outline-offset': '-1px',
						'color': '#b8072b'
					});
				$('.message').css({
					display: 'block'
				});
				
				
				$('input[type="submit"]').prop('disabled',true);
				if(firstCheck == true)
				{
					counter++;
					firstCheck = false;
				}
				
				break;
			}
			else
			{
				$(elem).css({
						'outline':'1px solid #187a00',
						'outline-offset': '-1px',
						'color': '#187a00'
					});
				if($(elem).val() == "")
				{
					$(elem).css({
						'outline':'none'
					})
				}
				if(counter > 0 && firstCheck != true)
				{
					counter--;
					firstCheck = true;
				}
										
				if(counter == 0)
				{
					$('input[type="submit"]').prop('disabled',false);
					$('.message').css({
						display: 'none'
					});
				}
			}
		}
	})
};

validation('input[name="login"]');
validation('input[name="password"]');
validation('input[name="email"]');

$('#ok').click(function(){
	$('.wrap').remove();
})