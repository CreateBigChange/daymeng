        $(function(){
          var drag;//用来控制是否拖动
          var x,y;//元素位置
          //鼠标点下去时发生的事件
          $(".wishs").mousedown(function(e){
              drag=true;
              $(".wishs").removeClass("current_wish");
              $(this).addClass("current_wish");
              //得到鼠标到div元素左边的距离
              x=e.pageX-parseInt($(this).css("left"));
              //得到鼠标到div元素上边的距离
              y=e.pageY-parseInt($(this).css("top"));
              $(this).fadeTo(20,0.5);
            });
          $(".wall").mousemove(
            function(e){
              if (drag) {
                var _x=e.pageX-x;
                var _y=e.pageY-y;
                //元素新位置
               // $(".wishs").css("left:_x,top:_y");
               $(".current_wish").css({left:_x,top:_y});

              }
            }
            );

          $(".wall").mouseup(
              function(e){
           	       drag=false;
                  $(".current_wish").fadeTo("fast",1);
              
              }
            );
        });
