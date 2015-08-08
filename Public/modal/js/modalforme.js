/**
 * modalEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {
				
			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.md-close' );

			function removeModal( hasPerspective ) {

				classie.remove( modal, 'md-show' );

				if( hasPerspective ) {	
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
				

			//自己修改的地放/////////////////////////////////////////
			
				if($(this).attr("items_id"))
				{
				id=$(this).attr("items_id");
				$("#model_content").text("数据加载ing!");
				$.ajax({
					url:mysupportItem_repay_ajax,
					datatype:"json",
					type:"post",
					data:{id:id},//ajax取得评论的范围
					success:function(data)
					{
						//alert(data[0]["content"]);
						
						//$("#repay_id").text(data[0]["content"]);
						$("#model_content").text(data[0]["content"]);
						//window.location.replace(location.href);
						//alert("success")
					},
					error:function()
					{
						alert("error!");
					}
				});
				}
				else
				{
				
				address_id=$(this).attr("repay_id");
				$("#model_content").text("数据加载ing");

				$.ajax({
					url:mysupportItem_address_ajax,
					datatype:"json",
					type:"post",
					data:{address_id:address_id},//ajax取得评论的范围
					success:function(data)
					{
						//alert(data[0]["content"]);
						var str="";
						str+=data[0]["province"];
						str+=data[0]["town"];
						str+=data[0]["district"];
						str+=data[0]["detail_address"];
						$("#model_content").text(str);
						//$("#address").text();
						//window.location.replace(location.href);
						//alert("success")
					},
					error:function()
					{
						alert("error!");
					}
					});
				}
				
				

			
			
			///////////////////////////////执行ajax////////////////////////
			
				classie.add( modal, 'md-show' );
				overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

})();