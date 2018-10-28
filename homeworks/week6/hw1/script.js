document.addEventListener('DOMContentLoaded', ()=>{
	
	let container = document.querySelector('.wrapper');
	container.addEventListener('click', e =>{

		
		//刪除留言按鍵處理
		if(e.target.className === 'cmmt__delete'){
			var content = e.target.parentNode.parentNode.parentNode.nextElementSibling;
			var cmmt_id = content.nextElementSibling;
			
			
				let req = new XMLHttpRequest();

				req.onload = () =>{
					if( req.status >= 200 && req.status < 400 ){
						if( req.responseText === 'deleted' ){

							window.location.reload();
						}

					}

				req.open( 'POST', 'delete_cmmt.php', true );
				req.setRequestHeader( 'Content-type', 'application/json' );
				req.send( 'cmmt_id=' + cmmt_id.innerText );

			}

		}


	})
})
