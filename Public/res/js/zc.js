
function indexOF(string,tar){
    for(var i=0;i<string.length;i++){
        if(string[i]==tar)
          return i;
        else
          return 1;
    }
}
 
// $("#t_login").click();
function getck(objname){
  var ck=document.cookie.split(';');
for(var i=0;i<ck.length;i++){
  temp=ck[i].split("=");
   // alert("c!"+temp[0]+"...."+objname+temp[1])
  if(temp[0].substr(1)==objname) return unescape(temp[1]);
  // if(temp[0]==objname) return unescape(temp[1]);
}
}
function setc(name,value,day)
{
    var exp = new Date();
    exp.setTime(exp.getTime() +3600*24*day);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function delc(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() -3600);
    if(getck(name))
    document.cookie = name + "="+ getck(name) + ";expires=" + exp.toGMTString();
}
var items;
$(function(){
 // $(".items").mouseover(function(){
 //  $(this).css({
 //    "box-shadow": " 0px 5px 10px #888888"
 //  });
 // });

 // $(".items").mouseout(function(){
 //  $(this).css({
 //    "box-shadow": "0px 0px 0px 0px #888888"
 //  });
 // });
$.ajax({
  url:sort_url,
  type:'post',
  success:function(data){
    items=data;
    sort1();

  }
});
});

function sort1(sort){
  var items0;
  if(sort=="0"){
    items0=items[0];
  }else{
    if(sort=="1"){
    items0=items[1];
  }else{
    if(sort=="2"){
    items0=items[2];
  }else{
    if(sort=="3"){
    items0=items[3];
  }else{
    items0=items[0];
  }
  }
  }
  }
  $(".cg").text("");
    for(var i=0;items0[i];i++){
      if(items0[i].prise>10000) 
        items0[i].prise="1w+";
      $(".cg").append("   <div class=' items '>  "+

 "          <a href='/detail/"+ items0[i].id+"  ' target='_blank'><img  style='width:400px;height:240px' src='"+PUBLIC+"/res/images/index/"+ items0[i].new_img+"' ></a>"+
"        <div class= 'm_left '>"+
           "  <a class='_prise'   disbaled style='text-decoration:none;font-size:12px;' href='javascript:;' title='赞'><img style='width:15px;margin-left:2px;' src='"+PUBLIC+"/res/images/small_pic/zan.png'><span style='display:none' >"+items0[i].id+"</span><span style='padding-left:2px;padding-right:4px;'>"+items0[i].prise+"</span> </a> "+
               "<div class='item_title'><a href='/detail/"+ items0[i].id+"' target='_blank'  >"+ items0[i].title+"</a></div>  "+
               "<p class='item_intro'>"+ items0[i].items_description+"</p>   "+
               " <div class= 'lpro '>"+
                  "<div class='progress   progress_position'  style= 'width:60% '>  "+
                "  <div class='progress progress-striped active'>  "+
                  " <div class='progress-bar progress-bar-success'  role='progressbar'   "+
                  "  aria-valuenow='60' aria-valuemin='0' aria-valuemax='100'   "+
                   "  style='width:"+ items0[i].gained+"%;'>  "+
        
                  "</div>  "+

                "  </div>"+
             
             "  </div> "+
              " <div class= 'ing ' style= 'width:40% '>"+
              " </div>"+
               " </div>"+
           "  <table class='index_detail' >"+  
             "  <tr class='condition1'>  "+
              "   <td > "+ items0[i].gained+"%</td>  "+
               "  <td class='condition1_'>￥"+ items0[i].gain+"</td>"+  
               "  <td class='condition1_'> "+ items0[i].remaining_day+" 天</td>"+  
               "</tr>  "+
              " <tr class='condition2'>  "+
              "   <td>已达</td>  "+
               "  <td class='condition2_'>已筹集</td>  "+
              "  <td class='condition2_'>剩余时间</td>"+  
             "  </tr>  "+
            " </table>  "+
           "  <p class='opnion'>  "+
            " <!--最多显示五位数-->  "+
             "  <input type='hidden'  value=  data[i].id   />  "+
              " <span><a  class='sup' style='padding:0px;margin:0px;style=text-decoration: none; 'href=/detail/"+ items0[i].id+" ' title='支持' target='_blank'>支持:<span style='padding:0px;margin:0px;' title='sup'> "+ items0[i].sup+"  </span></a></span>"+  
              " <span><a  class='attention'style='text-decoration: none;' disabled href='javascript:;'title='关注'>关注:<span style='display:none' >"+ items0[i].id+"</span> <span>"+ items0[i].attention+" </span> </a></span> "+ 
            " </p> "+
           "  </div>"+
           "</div>");
      
      }
      $("a").click(function(){
  $(this).blur();
});
      $("._prise").mouseover(function(){
$(this).find("img").prop("src",$(this).find("img").prop("src").replace(".png","1.png"));
});
$("._prise").mouseout(function(){
$(this).find("img").prop("src",$(this).find("img").prop("src").replace("1.png",".png"));
});
        $("._prise").click(function(){
          var cur_=$(this);
        
//与详细页面的赞相吻合      
if(localStorage[cur_.find("span:first").text()+"prise"]==1)
        {
          alert("请不要重复点赞");
          return 0;
        }

//与详细页面的赞相吻合   
          if(getck("prise"+cur_.find("span:first").text())) {//存在
                alert("您已经赞过了哦");
          }else{
            // alert("111111111");
            setc("prise"+cur_.find("span:first").text(),cur_.find("span:first").text(),36500);
            cur_.find("span:last").text(parseInt(cur_.find("span:last").text())+1);            
            $.ajax({
              url:opnion_url,
              type:'post',
              data:"id="+cur_.find("span:first").text(),
              success:function(data){
                  if(data.status!=1){
                      cur_.find("span:last").text(parseInt($(this).find("span:last").text())-1);
                  }
              },
              fail:function(){
                 cur_.find("span:last").text(parseInt($(this).find("span:last").text())-1);
              }
            });
          }
       });
        $(".attention").click(function(){
         var cur=$(this);
    //  alert(cur.find("span:first").text());
     if(getck("attention"+cur.find("span:first").text())) {//存在
                alert("您已经关注过了哦");
                // alert(getck("attention"+cur.find("span:first").text()));
                // alert(getc("attention"+cur.find("span:first").text()));

          }else{
            setc("attention"+$(this).find("span:first").text(),cur.find("span:first").text(),36500);
            $(this).find("span:last").text(parseInt(cur.find("span:last").text())+1);    
            //alert(cur.find("span:first").text());        
            $.ajax({
              url:att_url,
              type:'post',
              data:"items_id="+cur.find("span:first").text(),
              success:function(data){
                if(data.status==3){
                   delc("attention"+cur.find("span:first").text());
                   cur.find("span:last").text(parseInt(cur.find("span:last").text())-1);
                  $("#t_login").click();
                  return;
                }
                  if(data.status!=1){
                      cur.find("span:last").text(parseInt(cur.find("span:last").text())-1);
                      alert("您已经关注过了哦");
                  }
              },
              fail:function(){
                 cur.find("span:last").text(parseInt(cur.find("span:last").text())-1);
              }
            });
          }
  });
 
}
function delc(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() -3600);
    if(getck(name))
    document.cookie = name + "="+ getck(name) + ";expires=" + exp.toGMTString();
}

function complaint(){
          $.ajax({
            url:complaint_url,
            type:'post',
            data:'content='+$('.contents textarea').val(),
            success:function(data,textStatus){
                    if(data.status==1) {
                     alert('您的吐槽小萌已经收到');
                      $('.contents textarea').val('');
                    }
                    else{
                    if(data.status==0) alert('数据更新失败');
                      else{
                    if(data.status==2) alert('两次吐槽时间间隔请大于5分钟哦');
                    
                       
                      }
                    }
            },
            error:function(){
                        alert("服务器发生错误，连接失败");
            }
          });
}