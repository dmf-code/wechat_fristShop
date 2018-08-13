/**
 * Created by DMF on 2017/12/21.
 */

function sleep(num){
    var start =  (new Date()).getTime(), end = start;
    while(end - start >num){
        end = (new Date()).getTime();
    }
}
function deleteButton(t){
    var mytime = $(t).data('time');
    $('.'+mytime).remove();
}

jQuery.fn.extend({
    'addMenu':function(myId,data){
        var buttons = data.menu.button;
        var length = buttons.length;
        var trNum = $('#addMenu').children('tr').length;
        if(trNum>=6){
            $('#myModal').modal('show');
            return;
        }
        for(var i=0;i<length;++i){

            var date = new Date();
            var time = date.getTime()+i;
            var html="<tr style='margin-bottom: 1em;' class='"+time+"'>"+
                "<td>"+
                    "<ul class='sui-nav nav-list'>" +
                        "<li>" +
                            "<span >type：</span>" +
                            "<input type='text' name='menu[type][]' value="+buttons[i].type+">" +
                        "</li>"+
                        "<li>" +
                            "<span >key：</span>" +
                            "<input type='text' name='menu[key][]' value="+buttons[i].key+">" +
                        "</li>"+
                        "<li>" +
                            "<span >url：</span>" +
                            "<input type='text' name='menu[url][]' value="+buttons[i].url+">" +
                        "</li>"+
                        "<li>" +
                            "<span >name：</span>" +
                            "<input value='"+buttons[i].name+"' type='text' id='inputMenu"+time+"' name=menu[name][] placeholder='菜单' data-rules='required|minlength=1|maxlength=5' data-error-msg='菜单必须是1-5位' data-empty-msg='亲，菜单别忘记填了'>"+
                            "<input type='hidden' name=menu[time][] value='"+time+"'>"+
                            "<button onclick='deleteButton(this)' data-time='"+time+"' type='button' class='sui-btn btn-large'>删除</button>" +
                            "<button id='childMenu_"+time+"_1'"+"data-time="+time+" data-id='childMenu_"+time+"_2' type='button' class='sui-btn btn-large'>添加子菜单</button>" +
                        "</li>"+
                    "</ul>"+
                "</td>"+

                "<td id='childMenu_"+time+"_2'>"+
                "</td>"+
                "</tr>"+
                "<tr class='"+time+"'><td><hr/></td><td><hr/></td></tr>";

            $('#'+myId).append(html);
            $('#childMenu_'+time+'_2').data('index','childmenu'+time);

            $('#childMenu_'+time+'_1').click(function(){
                var time = $(this).data('time');
                $('#childMenu_'+time+'_2').addChildMenu(time,{'name':''});
            });

            //添加子button
            var len = buttons[i].sub_button.length;
            console.log(len);
            for(var j=0;j<len;++j) {
                console.log(buttons[i].sub_button[j]);
                this.addChildMenu(time, buttons[i].sub_button[j]);
            }

        }

    },
    'addChildMenu':function(time,subData){

                var id = $('#childMenu_'+time+'_1').data('id');
                var divCount = $('#'+id).children('div').length;
                //超过可创建次数禁止创建
                if(divCount>=5){
                    $('#myModal').modal('show');
                    return;
                }
                var firstTime = $('#childMenu_'+time+'_1').data('time');
                var mytime = (new Date()).getTime()+divCount+time;
                var html =
                    "<div class='control-group' id='"+mytime+"'>"+
                    "<div class='controls'>"+
                    "<input value='"+subData.name+"' type='text' id='inputMenu"+mytime+"' name='childmenu"+firstTime+"[]' placeholder='填写自定义子菜单' data-rules='required|minlength=1|maxlength=20' data-error-msg='子菜单必须是1-20位' data-empty-msg='亲，子菜单别忘记填了'>"+
                    "<button id='childMenu_"+mytime+"_1' data-id='childMenu_"+mytime+"_2' type='button' class='sui-btn btn-large'>删除</button>" +
                    "</div>"+
                    "</div>";
                $('#'+id).append(html);
                $('#childMenu_'+mytime+'_1').click(function(){
                    $('#'+mytime).remove();
                });

    }

});